<?php
namespace FutureActivities\Api\Api\Quote;

/**
 * Address management interface for guest carts.
 * @api
 * @since 100.0.2
 */
interface GuestAddressesManagementInterface
{
    /**
     * Assign a specified billing & shipping address to a specified cart.
     *
     * @param string $cartId The cart ID.
     * @param \Magento\Quote\Api\Data\AddressInterface $billingAddress Billing address data.
     * @param \Magento\Quote\Api\Data\AddressInterface $shippingAddress Shipping address data.
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException The specified cart does not exist.
     * @throws \Magento\Framework\Exception\InputException The specified cart ID or address data is not valid.
     */
    public function assign($cartId, \Magento\Quote\Api\Data\AddressInterface $billingAddress, \Magento\Quote\Api\Data\AddressInterface $shippingAddress);
    
    /**
     * Return the billing address for a specified quote.
     *
     * @param string $cartId The cart ID.
     * @return \FutureActivities\Api\Api\Data\AddressResultInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException The specified cart does not exist.
     */
    public function get($cartId);
}
