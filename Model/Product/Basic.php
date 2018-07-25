<?php
namespace FutureActivities\Api\Model\Product;

use FutureActivities\Api\Api\Data\Product\BasicInterface;

class Basic implements BasicInterface
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
    public function setSku($sku)
    {
        $this->sku = $sku;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->sku;
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
