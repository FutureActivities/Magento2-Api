<?php
namespace FutureActivities\Api\Api;
 
interface ProductInterface
{
   /**
    * Returns a list of all top level product names
    * 
    * @api
    * @return \FutureActivities\Api\Api\Data\Product\BasicInterface[]
    */
   public function getProductNames();
}