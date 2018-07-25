<?php

namespace FutureActivities\Api\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\Locale\Resolver;
use \Magento\UrlRewrite\Model\ResourceModel\UrlRewriteCollection;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Directory\Model\CurrencyFactory;

class Http extends AbstractHelper
{
    protected $_locale;
    protected $_storeManager;
    protected $_rewrites;
    protected $_currency;
  
    public function __construct(Resolver $locale, StoreManagerInterface $storeManager, UrlRewriteCollection $rewrites, CurrencyFactory $currency) 
    {
        $this->_locale = $locale;
        $this->_storeManager = $storeManager;
        $this->_rewrites = $rewrites;
        $this->_currency = $currency;
    }
    
    /**
     * Sets the store code
     */
    public function setStore($storeCode)
    {
        $this->_storeManager->setCurrentStore($storeCode);
    }
    
    /**
     * Get the store code from the URL
     */
    public function getStoreFromUrl()
    {
        // Check for full locale first
        if (preg_match('~^/[a-z]{2}_[a-z]{2}(?:/|$)~', $_SERVER['REQUEST_URI'], $matches))
            return trim($matches[0], '/');
            
        // Otherwise check for just the lang code
        if (preg_match('~^/[a-z]{2}(?:/|$)~', $_SERVER['REQUEST_URI'], $matches))
            return trim($matches[0], '/');
            
        return;
    }
    
    /**
     * Returns the Magento store lang if not found.
     */
    public function getLanguage()
    {
        $locale = $this->_locale->emulate($this->getStoreCode());
            
        $split = explode('_', $locale);
        
        return $split[0];
    }
    
    /**
     * Get the store object
     */
    public function getStore()
    {
        return $this->_storeManager->getStore($this->getStoreCode());
    }
    
    /**
     * Get the store code
     */
    public function getStoreCode()
    {
        return $this->_storeManager->getStore()->getCode();
    }
    
    /**
     * Returns the currency code being used for this store
     */
    public function getCurrencyCode()
    {
        return $this->getStore()->getCurrentCurrencyCode();
    }
    
    /**
     * Returns the currency symbol being used for this store
     */
    public function getCurrencySymbol()
    {
        $currency = $this->_currency->create()->load($this->getCurrencyCode());
        return $currency->getCurrencySymbol();
    }
    
    /**
     * Returns the media base URL
     */
    public function getMediaBaseUrl()
    {
        return $this->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
    
    /**
     * Checks to make sure the requested URL is valid and won't return a 404
     * 
     * @param array $customRoutes Optionally specify any other defined routes
     */
    public function isValidRequest($customRoutes = [])
    {
        // Get URL request
        $urlParts = parse_url($_SERVER['REQUEST_URI']);
        $request = trim($urlParts['path'], '/');
        
        // Remove any language param
        if ($lang = $this->getStoreFromUrl())
            $request = str_replace($lang, '', $request);
            
        // Clean up
        $request = trim($request, '/');
        if (empty($request) || $request == 'index.php') $request = 'home';
        
        // Check if url exists in Magento
        $url = $this->_rewrites->addFieldToFilter('request_path', $request);
        
        // Check if the url is in the defined custom routes
        $filtered = array_filter($customRoutes, function($value) use ($request) {
            if ($value == $request) return true;
            
            $value = str_replace('/','\/', $value);
            $value = str_replace('*', '.*?', $value);
            
            return preg_match('/^'.$value.'$/', $request);
        });
        
        if (count($url) == 0 && count($filtered) == 0)
            return false;
            
        return true;
    }
}