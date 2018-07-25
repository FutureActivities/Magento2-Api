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
}
