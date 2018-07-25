<?php

namespace FutureActivities\Api\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Geo extends AbstractHelper
{
    protected $_cookieManager;
    protected $_response;
    protected $_httpHelper;
  
    public function __construct(\Magento\Framework\Stdlib\CookieManagerInterface $cookieManager, \Magento\Framework\App\Response\Http $response, Http $httpHelper) 
    {
        $this->_cookieManager = $cookieManager;
        $this->_response = $response;
        $this->_httpHelper = $httpHelper;
    }
    
    public function determineStore()
    {
        $selectedStoreView = $this->_cookieManager->getCookie('storeview');
        $currentStoreCode = $this->_httpHelper->getStoreCode();

        if ($selectedStoreView == $currentStoreCode)
            return;
        
        if ($selectedStoreView) {
            $this->_httpHelper->setStore($selectedStoreView);
            header('Location: /'.$this->_httpHelper->getStoreCode());
            die();
        }
        
        $location = file_get_contents('https://freegeoip.net/json/' . $_SERVER['REMOTE_ADDR']);
        $location = json_decode($location);
        
        return $location->country_code;
    }
}