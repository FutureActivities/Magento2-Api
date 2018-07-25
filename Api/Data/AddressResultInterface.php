<?php
namespace FutureActivities\Api\Api\Data;

/**
 * @api
 */
interface AddressResultInterface
{
    /**
     * Set the shipping address
     * 
     * @param \Magento\Quote\Api\Data\AddressInterface $type
     * @return null
     */
    public function setShippingAddress(\Magento\Quote\Api\Data\AddressInterface $address);
    
    /**
     * Get the shipping address
     * 
     * @return \Magento\Quote\Api\Data\AddressInterface
     */
    public function getShippingAddress();
    
    /**
     * Get the billing address
     * 
     * @return \Magento\Quote\Api\Data\AddressInterface
     */
    public function getBillingAddress();

    /**
     * Set the billing address
     * 
     * @param \Magento\Quote\Api\Data\AddressInterface $id
     * @return null
     */
    public function setBillingAddress(\Magento\Quote\Api\Data\AddressInterface $address);
}
