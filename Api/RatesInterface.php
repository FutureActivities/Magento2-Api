<?php
namespace FutureActivities\Api\Api;
 
interface RatesInterface
{
   /**
    * Get all the available tax rates by class id
    *
    * @api
    * @return \FutureActivities\Api\Api\Data\RateResultInterface[]
    */
   public function getDefaultList();
   
   /**
    * Get all the available tax rates by class id
    *
    * @api
    * @param string $customerId
    * @return \FutureActivities\Api\Api\Data\RateResultInterface[]
    */
   public function getListByCustomer($customerId);
}