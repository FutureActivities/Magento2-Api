<?php

namespace FutureActivities\Api\Plugin;

class Category
{
    protected $eavAttribute;
    protected $categoryItem;
    
    public function __construct(\Magento\Eav\Model\ResourceModel\Entity\Attribute $eavAttribute,
        \FutureActivities\Api\Model\Category\ItemFactory $categoryItem)
    {
        $this->eavAttribute = $eavAttribute;
        $this->categoryItem = $categoryItem;
    }
    
    public function afterGet($subject, $result)
    {
        $extensionAttributes = $result->getExtensionAttributes();
        
        // Add next level category children
        $children = $result->getChildrenCategories()->addAttributeToSelect('*');

        $categories = [];
        
        foreach ($children AS $child) {
            
            $category = $this->categoryItem->create();
            $category->setId($child->getId());
            $category->setName($child->getName());
        
            $attributes = [];
            foreach ($child->getData() AS $key=>$value) {
                $attribute = new \Magento\Framework\Api\AttributeValue();
                $attribute->setAttributeCode($key);
                $attribute->setValue($value);
                
                $attributes[] = $attribute;
            }
            $category->setCustomAttributes($attributes);
        
            $categories[] = $category;
        }
        
        $extensionAttributes->setCategoryChildren($categories);
        
        $result->setExtensionAttributes($extensionAttributes);
        
        return $result;
    }
}