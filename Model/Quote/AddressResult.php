<?php
namespace FutureActivities\Api\Model\Quote;

use FutureActivities\Api\Api\Data\AddressResultInterface;

class AddressResult implements AddressResultInterface
{
    protected $shipping = null;
    protected $billing = null;

    /**
     * Set the shipping address
     * 
     * @param \Magento\Quote\Api\Data\AddressInterface $type
     * @return null
     */
    public function setShippingAddress(\Magento\Quote\Api\Data\AddressInterface $address)
    {
        if ($address->getFirstname())
            $this->shipping = $this->clean($address);
    }
    
    /**
     * Get the shipping address
     * 
     * @return \Magento\Quote\Api\Data\AddressInterface
     */
    public function getShippingAddress()
    {
        return $this->shipping;
    }
    
    /**
     * Get the billing address
     * 
     * @return \Magento\Quote\Api\Data\AddressInterface
     */
    public function getBillingAddress()
    {
        return $this->billing;
    }

    /**
     * Set the billing address
     * 
     * @param \Magento\Quote\Api\Data\AddressInterface $id
     * @return null
     */
    public function setBillingAddress(\Magento\Quote\Api\Data\AddressInterface $address) 
    {
        if ($address->getFirstname())
            $this->billing = $this->clean($address);
    }
    
    /**
     * Removes parameters from the address object that we don't need.
     * 
     * @parem \Magento\Quote\Api\Data\AddressInterface $address
     * @return \Magento\Quote\Api\Data\AddressInterface
     */
    protected function clean(\Magento\Quote\Api\Data\AddressInterface $address)
    {
        $address->setId(null);
        $address->setCustomerId(null);
        $address->setEmail(null);
        $address->setSameAsBilling(null);
        $address->setSaveInAddressBook(null);
        
        return $address;
    }
}