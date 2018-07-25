<?php
namespace FutureActivities\Api\Model\Category;

use Magento\Framework\Api\AbstractSimpleObject;
use FutureActivities\Api\Api\Data\Category\ItemInterface;

class Item extends AbstractSimpleObject implements ItemInterface
{
    protected $id;
    protected $name;
    protected $children = [];
    protected $product;
    
    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
    
     /**
     * {@inheritdoc}
     */
    public function getCustomAttribute($attributeCode)
    {
        return isset($this->_data[self::CUSTOM_ATTRIBUTES][$attributeCode])
            ? $this->_data[self::CUSTOM_ATTRIBUTES][$attributeCode]
            : null;
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomAttribute($attributeCode, $attributeValue)
    {
        /** @var \Magento\Framework\Api\AttributeInterface[] $attributes */
        $attributes = $this->getCustomAttributes();
        $attributes[$attributeCode] = $attributeValue;
        return $this->setCustomAttributes($attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomAttributes()
    {
        return $this->_get(self::CUSTOM_ATTRIBUTES);
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomAttributes(array $attributes)
    {
        return $this->setData(self::CUSTOM_ATTRIBUTES, $attributes);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFeaturedProduct($product)
    {
        $this->product = $product;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFeaturedProduct()
    {
        return $this->product;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function setChildren(array $items)
    {
        $this->children = $items;
    }
}
