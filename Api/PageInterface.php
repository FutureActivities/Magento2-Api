<?php
namespace FutureActivities\Api\Api;
 
interface PageInterface
{
   /**
    * Return details about a page using its URL key
    *
    * @api
    * @param string $param
    * @return \FutureActivities\Api\Api\Data\PageResultInterface
    */
   public function getByUrlKey($param);
}