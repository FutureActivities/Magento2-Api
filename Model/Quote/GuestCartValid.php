<?php

namespace FutureActivities\Api\Model\Quote;

use FutureActivities\Api\Api\Quote\GuestCartValidInterface;
use Magento\Quote\Model\QuoteIdMask;
use Magento\Quote\Model\QuoteIdMaskFactory;
use Magento\Quote\Model\QuoteAddressValidator;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Billing address management service for guest carts.
 */
class GuestCartValid implements GuestCartValidInterface
{
    /**
     * @var QuoteIdMaskFactory
     */
    private $quoteIdMaskFactory;
    
    private $quoteRepository;

    /**
     * Constructor
     *
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->quoteRepository = $quoteRepository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function isValid($cartId)
    {
        /** @var $quoteIdMask QuoteIdMask */
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        
        if (!$quoteIdMask->getQuoteId())
            throw new NoSuchEntityException();
        
        return true;
    }
}
