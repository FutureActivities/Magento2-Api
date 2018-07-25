<?php
namespace FutureActivities\Api\Model;

use FutureActivities\Api\Api\CategoryInterface;
use FutureActivities\Api\Model\Category\Result;
use FutureActivities\Api\Model\Category\Item;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;

class Category implements CategoryInterface
{
    /**
     * @var CollectionFactory
     */
    private $categoryCollectionFactory;

    /**
     * @var JoinProcessorInterface
     */
    private $extensionAttributesJoinProcessor;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param CollectionFactory $categoryCollectionFactory
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CollectionFactory $categoryCollectionFactory,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getList($values, $field = 'entity_id')
    {
        $collection = $this->categoryCollectionFactory->create();
        $this->extensionAttributesJoinProcessor->process($collection);
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter($field, array('in' => $values));

        $items = [];
        foreach ($collection as $category) {
            $items[] = $this->generateItem($category);
        }

        $result = new Result();
        $result->setItems($items);
        return $result;
    }
    
    /**
     * Recursive function to generate the category item
     * 
     * @param Magento\Catalog\Model\Category\Interceptor $category
     */
    private function generateItem($category)
    {
        $item = new Item();
        $item->setId($category->getId());
        $item->setName($category->getName());
        
        // Optional Featured Product SKU
        if ($featured = $category->getFeaturedProduct()) {
            try {
                $product = $this->productRepository->get($featured);
                $item->setFeaturedProduct($product);
            } catch (\Exception $e) {}
        }
        
        // Custom Attributes
        $attributes = [];
        foreach ($category->getData() AS $key=>$value) {
            $attribute = new \Magento\Framework\Api\AttributeValue();
            $attribute->setAttributeCode($key);
            $attribute->setValue($value);
            
            $attributes[] = $attribute;
        }
        $item->setCustomAttributes($attributes);
        
        // Process category children
        if ($children = $category->getChildrenCategories()) {
            $children->addAttributeToSelect('*');
            $childrenItems = [];
            foreach ($children AS $child)
                $childrenItems[] = $this->generateItem($child);
                
            $item->setChildren($childrenItems);
        }
        
        return $item;
    }
}
