<?php

namespace FutureActivities\Api\Model\Quote\GuestCart;

use FutureActivities\Api\Api\Quote\GuestAddressesManagementInterface;
use FutureActivities\Api\Api\Quote\AddressesManagementInterface;
use Magento\Quote\Model\QuoteIdMask;
use Magento\Quote\Model\QuoteIdMaskFactory;
use Magento\Quote\Model\QuoteAddressValidator;

/**
 * Billing address management service for guest carts.
 */
class GuestAddressesManagement implements GuestAddressesManagementInterface
{
    /**
     * @var QuoteIdMaskFactory
     */
    private $quoteIdMaskFactory;

    /**
     * @var AddressesManagementInterface
     */
    private $billingAddressManagement;

    /**
     * Constructs a quote billing address service object.
     *
     * @param AddressesManagementInterface $billingAddressManagement
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     */
    public function __construct(
        AddressesManagementInterface $billingAddressManagement,
        QuoteIdMaskFactory $quoteIdMaskFactory
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->billingAddressManagement = $billingAddressManagement;
    }

    /**
     * {@inheritDoc}
     */
    public function assign($cartId, \Magento\Quote\Api\Data\AddressInterface $billingAddress, \Magento\Quote\Api\Data\AddressInterface $shippingAddress)
    {
        /** @var $quoteIdMask QuoteIdMask */
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->billingAddressManagement->assign($quoteIdMask->getQuoteId(), $billingAddress, $shippingAddress);
    }
    
    /**
     * {@inheritDoc}
     */
    public function get($cartId)
    {
        /** @var $quoteIdMask QuoteIdMask */
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->billingAddressManagement->get($quoteIdMask->getQuoteId());
    }
}
