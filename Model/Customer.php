<?php
namespace FutureActivities\Api\Model;

use Magento\Downloadable\Model\Link\Purchased\Item;

class Customer implements \FutureActivities\Api\Api\CustomerInterface
{
    protected $quoteIdMaskFactory;
    protected $quoteRepository;
    protected $quoteFactory;
    protected $cartRepositoryInterface;
    protected $customerRepository;
    protected $urlInterface;
    protected $downloadLinksFactory;
    protected $downloadItemsFactory;
    protected $downloadFactory;
    
    public function __construct(\Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory, 
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository, 
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface,
        \Magento\Quote\Api\CartManagementInterface $cartManagementInterface,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Downloadable\Model\ResourceModel\Link\Purchased\CollectionFactory $downloadLinksFactory,
        \Magento\Downloadable\Model\ResourceModel\Link\Purchased\Item\CollectionFactory $downloadItemsFactory,
        \FutureActivities\Api\Model\Customer\DownloadFactory $downloadFactory)
    {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->quoteRepository = $quoteRepository;
        $this->quoteFactory = $quoteFactory;
        $this->cartRepositoryInterface = $cartRepositoryInterface;
        $this->cartManagementInterface = $cartManagementInterface;
        $this->customerRepository = $customerRepository;
        $this->urlInterface = $urlInterface;
        $this->downloadLinksFactory = $downloadLinksFactory;
        $this->downloadItemsFactory = $downloadItemsFactory;
        $this->downloadFactory = $downloadFactory;
    }
    
    /**
    * {@inheritdoc}
    */
    public function mergeCarts($customerId, $guestCartId)
    {
        // Customer cart
        try {
            $customerCart = $this->quoteRepository->getActiveForCustomer($customerId);
        } catch (\Exception $e) {
            $cartId = $this->cartManagementInterface->createEmptyCartForCustomer($customerId);
            $customerCart = $this->cartRepositoryInterface->get($cartId);
        }
        
        // Get guest cart
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($guestCartId, 'masked_id');
        $guestCart = $this->quoteFactory->create()->load($quoteIdMask->getQuoteId());
        
        try {
            $customerCart->merge($guestCart)->collectTotals()->save();
            $this->quoteRepository->delete($guestCart);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDownloadsList($customerId)
    {
        $purchased = $this->downloadLinksFactory->create()
            ->addFieldToFilter('customer_id', $customerId)
            ->addOrder('created_at', 'desc');
        
        $purchasedIds = [];
        foreach ($purchased as $_item) {
            $purchasedIds[] = $_item->getId();
        }
        
        $purchasedItems = $this->downloadItemsFactory->create()->addFieldToFilter('purchased_id', ['in' => $purchasedIds])
            ->addFieldToFilter('status', ['nin' => [Item::LINK_STATUS_PENDING_PAYMENT, Item::LINK_STATUS_PAYMENT_REVIEW]])
            ->setOrder('item_id', 'desc');
        
        $result = [];
        foreach($purchasedItems AS $item) {
            $purchasedItem = $purchased->getItemById($item->getPurchasedId());
            $downloadsRemaining = $item->getNumberOfDownloadsBought() ? $item->getNumberOfDownloadsBought() - $item->getNumberOfDownloadsUsed() : -1;
            
            $downloadItem = $this->downloadFactory->create();
            $downloadItem->setTitle($purchasedItem->getProductName());
            $downloadItem->setOrderUrl($this->urlInterface->getUrl('sales/order/view', ['order_id' => $purchasedItem->getOrderId()]));
            $downloadItem->setDownloadUrl($this->urlInterface->getUrl('downloadable/download/link', ['id' => $item->getLinkHash(), '_secure' => true]));
            $downloadItem->setRemainingDownloads($downloadsRemaining);
            $downloadItem->setDate($purchasedItem->getCreatedAt());
            $downloadItem->setStatus($item->getStatus());
            
            $result[] = $downloadItem;
        }
            
        return $result;
    }
}