<?php
namespace FutureActivities\Api\Api\Data\Search;

/**
 * @api
 */
interface ProductInterface 
{
    /**
     * Set the id
     * 
     * @param int $id
     * @return $this
     */
    public function setId($id);
    
    /**
     * Get the id
     * 
     * @return int
     */
    public function getId();
    
    /**
     * Set the sku
     * 
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);
    
    /**
     * Get the sku
     * 
     * @return string
     */
    public function getSku();
    
    /**
     * Set the name
     * 
     * @param string $name
     * @return $this
     */
    public function setName($name);
    
    /**
     * Get the name
     * 
     * @return string
     */
    public function getName();
    
    /**
     * Set the url
     * 
     * @param string $url
     * @return $this
     */
    public function setUrl($url);
    
    /**
     * Get the url
     * 
     * @return string
     */
    public function getUrl();
    
    /**
     * Set the keywords
     * 
     * @param string $keywords
     * @return $this
     */
    public function setKeywords($keywords);
    
    /**
     * Get the Keywords
     * 
     * @return string
     */
    public function getKeywords();
    
    /**
     * Set the price
     * 
     * @param string $price
     * @return $this
     */
    public function setPrice($price);
    
    /**
     * Get the price
     * 
     * @return string
     */
    public function getPrice();
    
    /**
     * Get special price
     * 
     * @return string
     */
    public function getSpecialPrice();
    
    /**
     * Set special price
     * 
     * @param string $price
     * @return $this
     */
    public function setSpecialPrice($price);
    
    /**
     * Get special from date
     * 
     * @return string
     */
    public function getSpecialFromDate();
    
    /**
     * Set special from date
     * 
     * @param string $date
     * @return $this
     */
    public function setSpecialFromDate($date);
    
    /**
     * Get special to date
     * 
     * @return string
     */
    public function getSpecialToDate();
    
    /**
     * Set special to date
     * 
     * @param string $date
     * @return $this
     */
    public function setSpecialToDate($date);
    
    /**
     * Set the tax class id
     * 
     * @param int $id
     * @return $this
     */
    public function setTaxClassId($id);
    
    /**
     * Get the tax class id
     * 
     * @return int
     */
    public function getTaxClassId();
    
    /**
     * Set the image
     * 
     * @param string $image
     * @return $this
     */
    public function setImage($image);
    
    /**
     * Get the image
     * 
     * @return string
     */
    public function getImage();
    
    /**
     * Set the categories
     * 
     * @param array $categories
     * @return $this
     */
    public function setCategories($categories);
    
    /**
     * Get the categories
     * 
     * @return array
     */
    public function getCategories();
}