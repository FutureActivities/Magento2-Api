<?php
namespace FutureActivities\Api\Api\Data\Search;

/**
 * @api
 */
interface DataInterface 
{
    /**
     * Set the products
     * 
     * @param \FutureActivities\Api\Api\Data\Search\ProductInterface[] $products
     * @return $this
     */
    public function setProducts($products);
    
    /**
     * Get the products
     * 
     * @return \FutureActivities\Api\Api\Data\Search\ProductInterface[]
     */
    public function getProducts();
    
    /**
     * Set the categories
     * 
     * @param \FutureActivities\Api\Api\Data\Search\CategoryInterface[] $categories
     * @return $this
     */
    public function setCategories($categories);
    
    /**
     * Get the categories
     * 
     * @return \FutureActivities\Api\Api\Data\Search\CategoryInterface[]
     */
    public function getCategories();
    
    /**
     * Set the pages
     * 
     * @param \FutureActivities\Api\Api\Data\Search\PageInterface[] $pages
     * @return $this
     */
    public function setPages($pages);
    
    /**
     * Get the pages
     * 
     * @return \FutureActivities\Api\Api\Data\Search\PageInterface[]
     */
    public function getPages();
}
