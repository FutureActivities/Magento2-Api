<?php

namespace FutureActivities\Api\Plugin;

use \Magento\Store\Api\StoreRepositoryInterface;

/**
 * This will pass the blocks ontent through the template processer which will
 * ensure any WYSIWYG elements, such as images, are correctly rendered in the 
 * REST API response.
 */
class Block
{
    protected $templateProcessor;
    
    public function __construct(\Magento\Cms\Model\Template\FilterProvider $templateProcessor)
    {
        $this->templateProcessor = $templateProcessor;
    }
    
    public function afterGetContent($subject, $result) 
    {
        return $this->templateProcessor->getPageFilter()->filter($result);
    }
}