<?php
namespace FutureActivities\Api\Api\Data\Category;

/**
 * @api
 */
interface ResultInterface
{
    /**
     * Get categories
     *
     * @return \FutureActivities\Api\Api\Data\Category\ItemInterface[]
     */
    public function getItems();

    /**
     * Set categories
     *
     * @param \FutureActivities\Api\Api\Data\Category\ItemInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}