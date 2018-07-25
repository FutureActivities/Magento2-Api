<?php
namespace FutureActivities\Api\Model\Customer;

use FutureActivities\Api\Api\Data\Customer\DownloadInterface;

class Download implements DownloadInterface
{
    protected $title = null;
    protected $orderUrl = null;
    protected $downloadUrl = null;
    protected $remaining = -1;
    protected $date = null;
    protected $status = null;

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTitle() 
    {
        return $this->title;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOrderUrl()
    {
        return $this->orderUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setOrderUrl($url)
    {
        $this->orderUrl = $url;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDownloadUrl()
    {
        return $this->downloadUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setDownloadUrl($url)
    {
        $this->downloadUrl = $url;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRemainingDownloads()
    {
        return $this->remaining;
    }

    /**
     * {@inheritdoc}
     */
    public function setRemainingDownloads($total)
    {
        $this->remaining = $total;   
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * {@inheritdoc}
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    
}