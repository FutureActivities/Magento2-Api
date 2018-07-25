<?php
namespace FutureActivities\Api\Api;
 
interface CategoryInterface
{
   /**
     * Get category list
     *
     * @param string[] $values
     * @param string $field
     * @return \FutureActivities\Api\Api\Data\Category\ResultInterface
     * @since 101.1.0
     */
    public function getList($values, $field = 'entity_id');
}