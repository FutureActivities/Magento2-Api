<?php

namespace FutureActivities\Api\Plugin;

class Category
{
    protected $eavAttribute;
    protected $categoryItem;
    protected $categoryCollectionFactory;
    
    public function __construct(\Magento\Eav\Model\ResourceModel\Entity\Attribute $eavAttribute,
        \FutureActivities\Api\Model\Category\ItemFactory $categoryItem)
    {
        $this->eavAttribute = $eavAttribute;
        $this->categoryItem = $categoryItem;
        // $this->categoryCollectionFactory = $categoryCollectionFactory;
    }
    
    public function afterGet($subject, $result)
    {
        $extensionAttributes = $result->getExtensionAttributes();
        
        $children = $result->getChildrenCategories();
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