<?php

namespace Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Entity\Repo;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Debug\ExceptionHandler;

/**
 * Sample controller
 * Class BaseController
 * @package Controller
 */
class BaseController implements ControllerProviderInterface {
    
    /**
     * Route settings
     * @param Application $app
     * @return mixed
     */
    public function connect(Application $app) {
        $indexController = $app['controllers_factory'];
        $indexController->get("/", array($this, 'index'))->bind('index');
        $indexController->match("/show/{id}", array($this, 'show'))->bind('show');
        $indexController->match("/update", array($this, 'update'))->bind('update');
        return $indexController;
    }
    
    /**
     * List all entities
     * @param Application $app
     * @return mixed
     */
    public function index(Application $app) {
        
        $em = $app['db.orm.em'];
        $entities = $em->getRepository('Entity\Repo')->findAll();

        return $app['twig']->render('index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Show entity
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function show(Application $app, $id) {
        
        $em = $app['db.orm.em'];
        $entity = $em->getRepository('Entity\Repo')->find($id);

        if (!$entity) {
            $app->abort(404, 'No entity found for id '.$id);
        }

        return $app['twig']->render('show.html.twig', array(
            'entity' => $entity
        ));
    }

    /**
     * Update entity
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function update(Application $app) {
        
        if($repos = $this->getMostStarredRepos($app)){
            $this->saveRepoData($app, $repos);
        }

        return $app->redirect($app['url_generator']->generate('index'));
    }
    
    /**
     * @param Application $app
     * @param $repositories
     */
    private function saveRepoData(Application $app, $repositories)
    {
        $em = $app['db.orm.em'];

        foreach ($repositories as $phpRepo)
        {
            if(!($repo = $em->getRepository('Entity\Repo')->findOneByRepoId($phpRepo->id))){
                $repo = new Repo();
            }

            $repo->setRepoId($phpRepo->id);
            $repo->setCreatedDate($this->convertToDateTime($phpRepo->created_at));
            $repo->setName($phpRepo->name);
            $repo->setUrl($phpRepo->url);
            $repo->setLastPushDate($this->convertToDateTime($phpRepo->pushed_at));
            $repo->setDescription((string) $phpRepo->description);
            $repo->setNumOfStars($phpRepo->stargazers_count);

            $em->merge($repo);
        }

        $em->flush();
        $em->clear();

        $app['session']->getFlashBag()->add('success', 'Github update successfull!');
    }
    
    /**
     * Gets most starred github repo's for any given language.
     * @param Application $app
     * @param string $language
     * @return null
     * @throws \Exception
     */
    private function getMostStarredRepos(Application $app, $language = 'php')
    {
        $repositories = NULL;
        $request = $app['guzzle']->get("repositories?q=language:$language&sort=stars&order=desc");
        if ($request->getStatusCode() == '200') {
            $repositories = json_decode($request->getBody()->getContents())->items;
        }

        return $repositories;
    }
    
    /**
     * Converts ISO 8601 to Datetime
     * @param $isoTime
     * @return \DateTime
     */
    private function convertToDateTime($isoTime)
    {
        date_default_timezone_set('UTC');
        return new \DateTime($isoTime);
    }

}