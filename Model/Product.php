<?php
namespace FutureActivities\Api\Model;

use FutureActivities\Api\Api\ProductInterface;
use FutureActivities\Api\Model\Product\BasicFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Product implements ProductInterface
{
    protected $productCollectionFactory;
    protected $basicFactory;
    
    public function __construct(
        CollectionFactory $productCollectionFactory,
        BasicFactory $basicFactory
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->basicFactory = $basicFactory;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getProductNames()
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect(['name','visibility','url_key']);
        
        $result = [];
        foreach($collection AS $product) {
            // Skip products not visible
            if ($product->getVisibility() == 1 || !$product->getStatus()) continue;
            
            $data = $this->basicFactory->create();
            $data->setId($product->getId());
            $data->setSku($product->getSku());
            $data->setName($product->getName());
            $data->setUrl($product->getUrlKey());
            $result[] = $data;
        }
        
        return $result;
    }
}
