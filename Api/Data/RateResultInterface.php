<?php
namespace FutureActivities\Api\Api\Data;

/**
 * @api
 */
interface RateResultInterface
{
    /**
     * Set the tax class id
     * 
     * @param int $id
     * @return $this
     */
    public function setTaxClassId($id);
    
    /**
     * Set the tax rate
     * 
     * @param int $rate
     * @return $this
     */
    public function setRate($rate);
    
    /**
     * Get the tax class ID
     * 
     * @return int
     */
    public function getTaxClassId();
    
    /**
     * Get the tax rate
     * 
     * @return int
     */
    public function getRate();


}
