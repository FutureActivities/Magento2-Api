<?php

namespace FutureActivities\Api\Plugin;

use \Magento\Store\Api\Data\StoreExtensionInterface;
use \Magento\Store\Api\Data\StoreInterface;
use \Magento\Store\Api\Data\StoreExtensionFactory;

/**
 * This plugin will add the store view display currency to the 
 * API endpoint: /rest/V1/store/storeViews
 */
class StoreAttributes
{
    private $extensionFactory;

    public function __construct(StoreExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }

    public function afterGetExtensionAttributes(StoreInterface $entity, StoreExtensionInterface $extension = null) 
    {
        if ($extension === null) {
            $extension = $this->extensionFactory->create();
        }

        return $extension;
    }
}