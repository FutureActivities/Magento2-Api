<?php

namespace FutureActivities\Api\Plugin;

class LinkManagement
{
    protected $productRepository;
    protected $productFactory;
    protected $dataObjectHelper;
    
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, 
        \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory, 
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper)
    {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }
    
    /**
     * Override this function to ensure that the media gallery gets set for the children products
     */
    public function aroundGetChildren($subject, callable $proceed, $sku)
	{
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $this->productRepository->get($sku);
        if ($product->getTypeId() != \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE) {
            return [];
        }

        /** @var \Magento\ConfigurableProduct\Model\Product\Type\Configurable $productTypeInstance */
        $productTypeInstance = $product->getTypeInstance();
        $productTypeInstance->setStoreFilter($product->getStoreId(), $product);

        $childrenList = [];
        /** @var \Magento\Catalog\Model\Product $child */
        foreach ($productTypeInstance->getUsedProducts($product) as $child) {
            $attributes = [];
            foreach ($child->getAttributes() as $attribute) {
                $attrCode = $attribute->getAttributeCode();
                $value = $child->getDataUsingMethod($attrCode) ?: $child->getData($attrCode);
                if (null !== $value) {
                    $attributes[$attrCode] = $value;
                }
            }
            $attributes['store_id'] = $child->getStoreId();
            /** @var \Magento\Catalog\Api\Data\ProductInterface $productDataObject */
            $productDataObject = $this->productFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $productDataObject,
                $attributes,
                \Magento\Catalog\Api\Data\ProductInterface::class
            );
            
            // PLUGIN EDIT: Add Gallery to result
            if ($gallery = $child->getMediaGalleryEntries())
                $productDataObject->setMediaGalleryEntries($gallery);
                
            // PLUGIN EDIT: Add Extension Attributes to result
            $childProduct = $this->productRepository->get($child->getSku());
            if ($extensionAttributes = $childProduct->getExtensionAttributes())
                $productDataObject->setExtensionAttributes($extensionAttributes);
                
            $childrenList[] = $productDataObject;
        }
        
        return $childrenList;
        
	}
}
