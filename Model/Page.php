<?php
namespace FutureActivities\Api\Model;

use \FutureActivities\Api\Helper\Data;
use \FutureActivities\Api\Model\PageResult;

class Page implements \FutureActivities\Api\Api\PageInterface
{
    protected $store;
    protected $helper;
    
    public function __construct(Data $helper, \Magento\Store\Model\StoreManagerInterface $store)
    {
        $this->store = $store;
        $this->helper = $helper;
    }
       
   /**
    * Return details about a page using its URL key
    *
    * @api
    * @param string $param
    * @return \FutureActivities\Api\Api\Data\PageResultInterface
    */
    public function getByUrlKey($param)
    {
        // Magento is struggling (2.1) with escaped forward slashes in the parameter
        // So we expect forward slashes as double semi-colons instead.
        $param = str_replace(';;', '/', $param);

        $rewrite = $this->helper->getObjectByKey($param, $this->store->getStore()->getId());
        
        if (!$rewrite)
            throw new \Magento\Framework\Exception\NotFoundException(__('Page not found'));
            
        $result = new PageResult();
        // $result->setType($rewrite->getEntityType());
        // $result->setId($rewrite->getEntityId());
        $result->setType($rewrite['entity_type']);
        $result->setId($rewrite['entity_id']);
        
        return $result;
    }
}