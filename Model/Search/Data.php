<?php
namespace FutureActivities\Api\Model\Search;

use FutureActivities\Api\Api\Data\Search\DataInterface;

class Data implements DataInterface
{
    protected $products = [];
    protected $categories = [];
    protected $pages = [];
    
    /**
     * {@inheritdoc}
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getProducts()
    {
        return $this->products;
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
    
    /**
     * {@inheritdoc}
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPages()
    {
        return $this->pages;
    }
}
