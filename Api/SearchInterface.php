<?php
namespace FutureActivities\Api\Api;
 
interface SearchInterface
{
   /**
    * Returns a brief summary of all products, categories and CMS pages.
    * Intended to be used for searching.
    * 
    * @api
    * @param int $parantCategory
    * @return \FutureActivities\Api\Api\Data\Search\DataInterface
    */
   public function getSearchData(int $parentCategory = 2);
}