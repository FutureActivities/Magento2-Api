<?php
namespace FutureActivities\Api\Model\Category;

use FutureActivities\Api\Api\Data\Category\ResultInterface;

class Result implements ResultInterface
{
    protected $total = 0;
    protected $items = [];
    
    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }
}
