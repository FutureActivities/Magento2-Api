<?php
namespace FutureActivities\Api\Api\Data\Customer;

/**
 * @api
 */
interface DownloadInterface
{
    /**
     * Set the download title
     * 
     * @param string $title
     * @return string
     */
    public function setTitle($title);
    
    /**
     * Get the download title
     * 
     * @return string
     */
    public function getTitle();
    
    /**
     * Get the order url
     * 
     * @return string
     */
    public function getOrderUrl();

    /**
     * Set the order url
     * 
     * @param string $url
     * @return null
     */
    public function setOrderUrl($url);
    
    /**
     * Get the download url
     * 
     * @return string
     */
    public function getDownloadUrl();

    /**
     * Set the download url
     * 
     * @param string $url
     * @return null
     */
    public function setDownloadUrl($url);
    
    /**
     * Get the number of remaining downloads
     * 
     * @return int
     */
    public function getRemainingDownloads();

    /**
     * Set the number of remaining downloads
     * 
     * @param int $total
     * @return null
     */
    public function setRemainingDownloads($total);    
    
    /**
     * Get the order date
     * 
     * @return string
     */
    public function getDate();

    /**
     * Set the order date
     * 
     * @param string $date
     * @return null
     */
    public function setDate($date);  
    
    /**
     * Get the order status
     * 
     * @return string
     */
    public function getStatus();

    /**
     * Set the order status
     * 
     * @param string $status
     * @return null
     */
    public function setStatus($status);  
    
}
