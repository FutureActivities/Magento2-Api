<?php
namespace FutureActivities\Api\Model;

use FutureActivities\Api\Api\SearchInterface;
use FutureActivities\Api\Model\Search\DataFactory;
use FutureActivities\Api\Model\Search\ProductFactory;
use FutureActivities\Api\Model\Search\CategoryFactory;
use FutureActivities\Api\Model\Search\PageFactory;

class Search implements SearchInterface
{
    protected $storeManager;
    
    protected $productCollectionFactory;
    protected $categoryCollectionFactory;
    protected $categoryRepository;
    protected $pageCollectionFactory;
    protected $pageHelper;
    
    protected $dataFactory;
    protected $productFactory;
    protected $categoryFactory;
    protected $pageFactory;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\CategoryRepository $categoryRepository,
        \Magento\Cms\Model\ResourceModel\Page\CollectionFactory $pageCollectionFactory,
        \Magento\Cms\Helper\Page $pageHelper,
        DataFactory $dataFactory,
        ProductFactory $productFactory,
        CategoryFactory $categoryFactory,
        PageFactory $pageFactory
    ) {
        $this->storeManager = $storeManager;  
        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->categoryRepository = $categoryRepository;
        $this->pageCollectionFactory = $pageCollectionFactory;
        $this->pageHelper = $pageHelper;
        $this->dataFactory = $dataFactory;
        $this->productFactory = $productFactory;
        $this->categoryFactory = $categoryFactory;
        $this->pageFactory = $pageFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchData($parentCategory = 2)
    {
        $data = $this->dataFactory->create();
        
        $data->setProducts($this->getProducts());
        $data->setCategories($this->getCategories($parentCategory));
        $data->setPages($this->getPages());
        
        return $data;
    }
    
    protected function getProducts()
    {
        $result = [];
        
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect(['name','price','special_price', 'special_from_date', 'special_to_date', 'price_from','image','visibility','url_key','status','tax_class_id','meta_keyword']);
        $collection->addStoreFilter($this->storeManager->getStore()->getId());
        
        foreach($collection AS $product) {
            // Skip products not visible
            if ($product->getVisibility() == 1 || $product->getStatus() != 1) continue;
            
            $data = $this->productFactory->create();
            $data->setId($product->getId());
            $data->setSku($product->getSku());
            $data->setName($product->getName());
            $data->setKeywords($product->getMetaKeyword());
            $data->setUrl($product->getUrlKey());
            $data->setImage($product->getImage());
            if ($product->getTypeId() == 'configurable')
                $data->setPrice($product->getPriceFrom());
            else 
                $data->setPrice($product->getPrice());
                
            if ($product->getSpecialPrice()) {
                $data->setSpecialPrice($product->getSpecialPrice());
                $data->setSpecialFromDate($product->getSpecialFromDate());
                $data->setSpecialToDate($product->getSpecialToDate());
            }
            
            $data->setTaxClassId($product->getTaxClassId());
            $data->setCategories($product->getCategoryIds());
            
            $result[] = $data;
        }
        
        return $result;
    }
    
    protected function getCategories($parentCategoryId)
    {
        $result = [];
        
        $parent = $this->categoryRepository->get($parentCategoryId);
        
        $collection = $this->categoryCollectionFactory->create();
        $collection->addAttributeToSelect(['name','url_path']);
        $collection->addIsActiveFilter();
        $collection->addFieldToFilter('path', ['like' => $parent->getPath().'/%']);
        
        foreach ($collection AS $category) {
            if ($category->getId() == 2 || empty($category->getUrlPath())) continue;
            
            $data = $this->categoryFactory->create();
            $data->setId($category->getId());
            $data->setName($category->getName());
            $data->setUrl($category->getUrlPath());
            
            $result[] = $data;
        }
        
        return $result;
    }
    
    protected function getPages()
    {
        $result = [];
        
        $collection = $this->pageCollectionFactory->create();
        $collection->addFieldToFilter('is_active', \Magento\Cms\Model\Page::STATUS_ENABLED);
        
        foreach ($collection AS $page) {
            $url = $this->pageHelper->getPageUrl($page->getId());
            
            if (empty($url)) continue;
            
            $data = $this->pageFactory->create();
            $data->setId($page->getId());
            $data->setName($page->getTitle());
            $data->setUrl($url);
            
            $result[] = $data;
        }
        
        return $result;
    }
}