<?php

namespace Droxic\Affiliate\Observer\Sales;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Stdlib\CookieManagerInterface;

class OrderSaveAfter implements ObserverInterface
{
       /**
     * @var \Magento\Framework\Stdlib\CookieManagerInterface
     */
    protected $cookieManager;

    public function __construct(
        CookieManagerInterface $cookieManager
    ){
        $this->cookieManager = $cookieManager;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        if ($affiliateId = $this->cookieManager->getCookie('affiliate_id')) {
            $order->setData('affiliate_id', $affiliateId);
        }
        $order->getResource()->saveAttribute($order, "affiliate_id");
    }
}
