<?php
namespace FutureActivities\Api\Api\Data\Category;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * @api
 */
interface ItemInterface extends CustomAttributesDataInterface
{
    /**
     * Set the category id
     * 
     * @param int $id
     * @return $this
     */
    public function setId($id);
    
    /**
     * Get the category id
     * 
     * @return int
     */
    public function getId();
    
    /**
     * Set the category name
     * 
     * @param string $name
     * @return $this
     */
    public function setName($name);
    
    /**
     * Get the category name
     * 
     * @return string
     */
    public function getName();
    
    /**
     * Set an optional featured product for this category.
     * Used for default images etc.
     * 
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return $this
     */
    public function setFeaturedProduct($product);
    
    /**
     * Get the featured product
     * 
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    public function getFeaturedProduct();
    
    /**
     * Get category children
     *
     * @return \FutureActivities\Api\Api\Data\Category\ItemInterface[]
     */
    public function getChildren();

    /**
     * Set category children
     *
     * @param \FutureActivities\Api\Api\Data\Category\ItemInterface[] $items
     * @return $this
     */
    public function setChildren(array $items);
}
