<?php
namespace FutureActivities\Api\Model\Rates;

use FutureActivities\Api\Api\Data\RateResultInterface;

class Rate implements RateResultInterface
{
    protected $taxClassId;
    protected $rate;
    
    /**
     * {@inheritdoc}
     */
    public function setTaxClassId($id)
    {
        $this->taxClassId = $id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTaxClassId()
    {
        return $this->taxClassId;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRate()
    {
        return $this->rate;
    }
}