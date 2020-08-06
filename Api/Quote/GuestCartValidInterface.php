<?php
namespace FutureActivities\Api\Api\Quote;

/**
 * Guest cart management interface
 * @api
 * @since 100.0.2
 */
interface GuestCartValidInterface
{
    /**
     * Check if a guest cart id is still value
     *
     * @param string $cartId The cart ID.
     * @return boolean
     * @throws \Magento\Framework\Exception\NoSuchEntityException The specified cart does not exist.
     */
    public function isValid($cartId);
}
