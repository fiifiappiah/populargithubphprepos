<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Repo
 *
 * @Entity 
 * @Table(name="repo", indexes={@Index(name="github_repo_idx", columns={"repo_id"})})
 */
class Repo
{
    /** 
     * @var integer
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue */
    private $id; 
    
    /**
     * @var integer
     *
     * @Column(name="repo_id", type="integer")
     */
    private $repoId;

    /**
     * @var string
     *
     * @Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Column(name="url", type="string", length=2083)
     */
    private $url;

    /**
     * @var string
     * @Column(name="created_date", type="datetime", length=20)
     */
    private $createdDate;

    /**
     * @var string
     * @Column(name="last_push_date", type="datetime", length=20)
     */
    private $lastPushDate;

    /**
     * @var string
     * @Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @var integer
     * @Column(name="num_of_starts", type="integer")
     */
    private $numStars;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @return int
     */
    public function getRepoId()
    {
        return $this->repoId;
    }

    /**
     * @param int $repoId
     * @return Repo
     */
    public function setRepoId($repoId)
    {
        $this->repoId = $repoId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Repo
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Repo
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param string $createdDate
     * @return Repo
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastPushDate()
    {
        return $this->lastPushDate;
    }

    /**
     * @param string $lastPushDate
     * @return Repo
     */
    public function setLastPushDate($lastPushDate)
    {
        $this->lastPushDate = $lastPushDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Repo
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumOfStars()
    {
        return $this->numStars;
    }

    /**
     * @param int $numStars
     * @return Repo
     */
    public function setNumOfStars($numStars)
    {
        $this->numStars = $numStars;
        return $this;
    }
    
}
