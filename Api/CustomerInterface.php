<?php
namespace FutureActivities\Api\Api;
 
interface CustomerInterface
{
   /**
    * Merges a guest cart with the customers logged in cart
    *
    * @api
    * @param string $customerId
    * @param string $guestCartId
    * @return boolean
    */
   public function mergeCarts($customerId, $guestCartId);
   
   /**
    * Returns a list of available downloads for a customer
    *
    * @api
    * @param string $customerId
    * @return \FutureActivities\Api\Api\Data\Customer\DownloadInterface[]
    */
   public function getDownloadsList($customerId);
}