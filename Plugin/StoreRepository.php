<?php

namespace FutureActivities\Api\Plugin;

use \Magento\Store\Api\StoreRepositoryInterface;

/**
 * This plugin will add the store view display currency to the 
 * API endpoint: /rest/V1/store/storeViews
 */
class StoreRepository
{
    public function afterGetList(StoreRepositoryInterface $subject, Array $entities) 
    {
        foreach ($entities AS $entity) {
            $currency = $entity->getDefaultCurrencyCode();
            $extensionAttributes = $entity->getExtensionAttributes();
            $extensionAttributes->setDisplayCurrency($currency);
            $entity->setExtensionAttributes($extensionAttributes);
        }
    
        return $entities;
    }
}