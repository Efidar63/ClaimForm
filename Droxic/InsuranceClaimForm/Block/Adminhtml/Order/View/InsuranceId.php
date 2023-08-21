<?php

namespace Droxic\InsuranceClaimForm\Block\Adminhtml\Order\View;
class InsuranceId extends \Magento\Framework\View\Element\Template
{
    /**
     * Get insurance id for the order
     *
     * @return string|null
     */
    public function getInsuranceId()
    {
        $order = $this->getParentBlock()->getOrder();
        return $order->getInsuranceId();
    }
}
