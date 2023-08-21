<?php

namespace Droxic\InsuranceClaimForm\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class AddInsuranceIdObserver implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        // Rasgele sigorta kimliği oluşturma
        $insuranceId = 'INS' . rand(1000000, 9999999); // Örnek: INS1234

        // Oluşturulan sigorta kimliğini siparişe ekleyin
        $order->setData('insurance_id', $insuranceId);
    }
}
