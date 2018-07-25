<?php
namespace FutureActivities\Api\Api\Data;

/**
 * @api
 */
interface PageResultInterface
{
    /**
     * Set the result type
     * 
     * @param string $type
     * @return string
     */
    public function setType($type);
    
    /**
     * Get the result type
     * 
     * @return string
     */
    public function getType();
    
    /**
     * Get the result ID
     * 
     * @return int
     */
    public function getId();

    /**
     * Set the data
     * 
     * @param int $id
     * @return null
     */
    public function setId($id);
}
