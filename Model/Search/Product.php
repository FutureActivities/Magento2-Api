<?php
namespace FutureActivities\Api\Model\Search;

use FutureActivities\Api\Api\Data\Search\ProductInterface;

class Product implements ProductInterface
{
    protected $id;
    protected $sku;
    protected $name;
    protected $url;
    protected $keywords;
    protected $price;
    protected $image;
    protected $taxClassId;
    protected $categories;
    
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
        
    /**
     * {@inheritdoc}
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setTaxClassId($name)
    {
        $this->taxClassId = $name;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTaxClassId()
    {
        return $this->taxClassId;
    }
        
    /**
     * {@inheritdoc}
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCategories() 
    {
        return $this->categories;
    }
}