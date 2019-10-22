<?php

namespace FutureActivities\Api\Plugin;

class Product
{
    protected $eavAttribute;
    
    public function __construct(\Magento\Eav\Model\ResourceModel\Entity\Attribute $eavAttribute)
    {
        $this->eavAttribute = $eavAttribute;
    }
    
    public function afterGet($subject, $result)
    {
        $extensionAttributes = $result->getExtensionAttributes();
        
        $extensionAttributes->setStockStatus($result->isSaleable());
        
        if ($result->getTypeId() == 'configurable')
            $extensionAttributes->setConfigurableProductOptionsLabels($this->getOptions($result));
        
        $result->setExtensionAttributes($extensionAttributes);
        
        return $result;
    }
    
    public function afterGetById($subject, $result)
    {
        $extensionAttributes = $result->getExtensionAttributes();
        
        $extensionAttributes->setStockStatus($result->isSaleable());
        
        if ($result->getTypeId() == 'configurable')
            $extensionAttributes->setConfigurableProductOptionsLabels($this->getOptions($result));
        
        $result->setExtensionAttributes($extensionAttributes);
        
        return $result;
    }
    
    private function getOptions($product)
    {
        $data = $product->getTypeInstance()->getConfigurableOptions($product);

        $options = [];
        foreach($data as $attr) {
            if (count($attr) == 0) continue;
            
            $values = [];
            foreach($attr as $p) {
                $values[$p['value_index']] = [
                    'value_index' => (int)$p['value_index'],
                    'label' => $p['option_title']
                ];
            }
            
            $option = [
                'attribute_id' => (int)$this->eavAttribute->getIdByCode('catalog_product', $attr[0]['attribute_code']),
                'attribute_code' => $attr[0]['attribute_code'],
                'label' => $attr[0]['super_attribute_label'],
                'product_id' => (int)$attr[0]['product_id'],
                'values' => array_values($values)
            ];
            
            $options[] = $option;
        }
        
        return $options;
    }
    
    protected function getProductAttribute($code, $product)
    {
        if ($attribute = $product->getResource()->getAttribute($code)) {
            $value = $attribute->getFrontend()->getValue($product);
            if (!is_object($value)) 
                return $value;
        }
            
        return null;
    }
}