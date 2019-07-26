<?php

namespace FutureActivities\Api\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

use \Magento\UrlRewrite\Service\V1\Data\UrlRewrite;
use \Magento\UrlRewrite\Model\UrlFinderInterface;
use \Magento\ConfigurableProduct\Model\Product\Type\Configurable;
 
class Data extends AbstractHelper
{
    private $urlFinder;
    private $configurable;
    private $pageFactory;
    private $resource;
    
    const XML_PATH_MAGENTO2API = 'magento2api/general';
    
    public function __construct(\Magento\Framework\App\Helper\Context $context, UrlFinderInterface $urlFinder, Configurable $configurable, \Magento\Framework\App\ResourceConnection $resource) 
    {
        parent::__construct($context);
        
        $this->urlFinder = $urlFinder;
        $this->configurable = $configurable;
        $this->resource = $resource;
    }
    
    /**
     * Returns details about the page requested.
     * 
     * @param string $key The url key of the page to find
     * @param int $storeId Optional. The ID of the store view to filter by.
     */
    public function getObjectByKey($key, $storeId = null)
    {
        $connection = $this->resource->getConnection();
        $sql = $connection->select()->from('url_rewrite')->where('request_path LIKE ?', '%%'.$key.'%%');
        if ($storeId)
            $sql->where('store_id = ?', $storeId);
        $result = $connection->fetchAll($sql);
        
        if (empty($result))
            return false;
            
        if (count($result) == 1)
            return current($result);
            
        // Do any of the result match exactly?
        foreach ($result as $rewrite) {
            if ($rewrite['request_path'] == $key)
                return $rewrite;
        }
        
        // Do any of the results have a partial match?
        foreach ($result as $rewrite) {
            $parts = explode('/', $rewrite['request_path']);
            foreach ($parts AS $part) {
                if ($part === $key)
                    return $rewrite;
            }
        }
        
        return false;
        
        // OLD: Magento URL finder doesn't support wildcard searches
        // $filter = [
        //   UrlRewrite::REQUEST_PATH => $key
        // ];
        
        // if ($storeId)
        //     $filter[UrlRewrite::STORE_ID] = $storeId;
        
        // return $this->urlFinder->findOneByData($filter);
    }
    
    /**
     * Returns value of specified field.
     * 
     * @param string $field The handle for the field you want the value of.
     * @param int $storeId Optional. The ID of the store view to filter by.
     */
	public function getConfigValue($field, $storeId = null)
	{
		return $this->scopeConfig->getValue(
			$field, ScopeInterface::SCOPE_STORE, $storeId
		);
	}

    /**
     * Shorthand version of getConfigalue(), Returns value of specified field.
     * 
     * @param string $code .
     * @param int $storeId Optional. The ID of the store view to filter by.
     */
	public function getGeneralConfig($code, $storeId = null)
	{
		return $this->getConfigValue(self::XML_PATH_MAGENTO2API .'/'. $code, $storeId);
	}
}