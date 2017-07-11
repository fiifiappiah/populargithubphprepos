<?php

namespace Provider;

use GuzzleHttp\Client;
use Silex\Application;
use Silex\ServiceProviderInterface;

class GuzzleProvider implements ServiceProviderInterface
{
    CONST GITHUB_SEARCH_API = 'https://api.github.com/search/';
    
    /**
     * @var array
     */
    private $configuration = array();
    
    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
    }
    
    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        $app['guzzle'] = function($app) {
            $this->setConfiguration($app);
            return new Client($this->configuration);
        };
    }
    /** method to catch configuration params throw by $app['guzzle.*]
     * @param $app
     */
    protected function setConfiguration($app)
    {
        $this->configuration['base_uri'] = $this::GITHUB_SEARCH_API;
        
        $this->configuration['timeout'] = 10000;
        
        if (isset($app['guzzle.debug'])) {
            $this->configuration['debug'] = $app['guzzle.debug'];
        }
        if (isset($app['guzzle.request_options']) && is_array($app['guzzle.request_options'])) {
            foreach ($app['guzzle.request_options'] as $valueName => $value) {
                $this->configuration[$valueName] = $value;
            }
        }
    }
    
}