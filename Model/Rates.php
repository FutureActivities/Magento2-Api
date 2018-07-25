<?php
namespace FutureActivities\Api\Model;

class Rates implements \FutureActivities\Api\Api\RatesInterface
{
    protected $taxClassSource;
    protected $taxCalculation;
    protected $rateItem;
    
    public function __construct(\Magento\Tax\Model\TaxClass\Source\Product $taxClassSource, \Magento\Tax\Api\TaxCalculationInterface $taxCalculation, \FutureActivities\Api\Model\Rates\RateFactory $rateItem)
    {
        $this->taxClassSource = $taxClassSource;
        $this->taxCalculation = $taxCalculation;
        $this->rateItem = $rateItem;
    }
    
    /**
    * {@inheritdoc}
    */
    public function getDefaultList()
    {
        return $this->get();
    }
    
    /**
    * {@inheritdoc}
    */
    public function getListByCustomer($customerId)
    {
        return $this->get($customerId);
    }
    
    protected function get($customerId = null)
    {
        $result = [];
        $taxClasses = $this->taxClassSource->getAllOptions();
        foreach ($taxClasses AS $taxClass) {
            $rate = $this->rateItem->create();
            $rate->setTaxClassId($taxClass['value']);
            $rate->setRate($this->taxCalculation->getCalculatedRate($taxClass['value'], $customerId));
            $result[] = $rate;
        }
        
        return $result;
    }
}