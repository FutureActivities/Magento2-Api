<?php
namespace FutureActivities\Api\Model\Search;

use FutureActivities\Api\Api\Data\Search\CategoryInterface;

class Category implements CategoryInterface
{
    protected $id;
    protected $name;
    protected $url;
    
    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->url;
    }
}
