<?php
namespace FutureActivities\Api\Api\Data\Search;

/**
 * @api
 */
interface PageInterface 
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
}
