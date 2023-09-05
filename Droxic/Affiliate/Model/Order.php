<?php
namespace Droxic\ClaimPayment\Model;

use Magento\Sales\Model\Order as MagentoOrder;

class Order extends MagentoOrder
{
    public function getAffiliateId()
    {
        return $this->getData('affiliate_id');
    }

    public function setAffiliateId($affiliateId)
    {
        return $this->setData('affiliate_id', $affiliateId);
    }
}
