<?php

namespace FutureActivities\Api\Model\Quote;

use Magento\Framework\Exception\InputException;
use Magento\Quote\Model\Quote\Address\BillingAddressPersister;
use Psr\Log\LoggerInterface as Logger;
use FutureActivities\Api\Api\Quote\AddressesManagementInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Quote\Model\QuoteAddressValidator;
use \FutureActivities\Api\Model\Quote\AddressResult;

/**
 * Quote billing address write service object.
 *
 */
class AddressesManagement implements AddressesManagementInterface
{
    /**
     * Validator.
     *
     * @var QuoteAddressValidator
     */
    protected $addressValidator;

    /**
     * Logger.
     *
     * @var Logger
     */
    protected $logger;

    /**
     * Quote repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var \Magento\Customer\Api\AddressRepositoryInterface
     */
    protected $addressRepository;

    /**
     * @var \Magento\Quote\Model\Quote\ShippingAssignment\ShippingAssignmentProcessor
     */
    private $shippingAssignmentProcessor;

    /**
     * @var \Magento\Quote\Api\Data\CartExtensionFactory
     */
    private $cartExtensionFactory;

    /**
     * Constructs a quote billing address service object.
     *
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository Quote repository.
     * @param QuoteAddressValidator $addressValidator Address validator.
     * @param Logger $logger Logger.
     * @param \Magento\Customer\Api\AddressRepositoryInterface $addressRepository
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        QuoteAddressValidator $addressValidator,
        Logger $logger,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository,
        \Magento\Quote\Api\Data\CartExtensionFactory $cartExtensionFactory,
        \Magento\Quote\Model\Quote\ShippingAssignment\ShippingAssignmentProcessor $shippingAssignmentProcessor
    ) {
        $this->addressValidator = $addressValidator;
        $this->logger = $logger;
        $this->quoteRepository = $quoteRepository;
        $this->addressRepository = $addressRepository;
        $this->shippingAssignmentProcessor = $shippingAssignmentProcessor;
        $this->cartExtensionFactory = $cartExtensionFactory;
    }

    /**
     * {@inheritDoc}
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function assign($cartId, \Magento\Quote\Api\Data\AddressInterface $billingAddress, \Magento\Quote\Api\Data\AddressInterface $shippingAddress)
    {
        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $this->quoteRepository->getActive($cartId);
        
        try {
            // Set the billing address
            $quote->removeAddress($quote->getBillingAddress()->getId());
            $quote->setBillingAddress($billingAddress);
        
            // Set the shipping address
            $quote->removeAddress($quote->getShippingAddress()->getId());
            $this->setShippingAddress($quote, $shippingAddress);
            
            // Save changes
            $quote->setDataChanges(true);
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            $this->logger->critical($e);
            throw new InputException(__('Unable to save address. Please check input data.'));
        }
        
        return true;
    }
    
    /**
     * {@inheritDoc}
     */
    public function get($cartId)
    {
        $cart = $this->quoteRepository->getActive($cartId);
        
        $result = new AddressResult();
        $result->setBillingAddress($cart->getBillingAddress());
        $result->setShippingAddress($cart->getShippingAddress());
        
        return $result;
    }
    
    protected function setShippingAddress($quote, $address)
    {
        $address->setSameAsBilling(0);
        $address->setCollectShippingRates(true);

        $quote->setShippingAddress($address);
        $cartExtension = $quote->getExtensionAttributes();
        if ($cartExtension === null) {
            $cartExtension = $this->cartExtensionFactory->create();
        }
        /** @var \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment */
        $shippingAssignment = $this->shippingAssignmentProcessor->create($quote);
        $cartExtension->setShippingAssignments([$shippingAssignment]);
        $quote->setExtensionAttributes($cartExtension);
    }
}
