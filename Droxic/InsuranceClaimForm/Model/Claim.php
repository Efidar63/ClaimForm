<?php

namespace Droxic\InsuranceClaimForm\Model;

class Claim extends \Magento\Framework\Model\AbstractModel
{
    const STATUSES = [
          1  => 'Received',
          2 => 'Proccesssing',
          3 => 'Declined',
          4 =>'Approved',
          5 =>'Finished'
    ];
    public function _construct()
    {
        $this->_init(\Droxic\InsuranceClaimForm\Model\ResourceModel\Claim::class);
    }
    public function loadByFirstnameLastnameInsuranceId($firstname, $lastname, $insuranceId)
    {
        
        return $this->getResource()->loadByFirstnameLastnameInsuranceId($this, $firstname, $lastname, $insuranceId);
    }
}
