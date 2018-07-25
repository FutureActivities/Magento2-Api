<?php
namespace FutureActivities\Api\Model;

use FutureActivities\Api\Api\Data\PageResultInterface;

class PageResult implements PageResultInterface
{
    protected $type = null;
    protected $id = null;

    /**
     * Set the result type
     * 
     * @param string $type
     * @return string
     */
    public function setType($type)
    {
        $this->type = $type;
        
        return $type;
    }
    
    /**
     * Get the result type
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Get the result ID
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the data
     * 
     * @param int $id
     * @return null
     */
    public function setId($id) 
    {
        $this->id = $id;
    }
    
}