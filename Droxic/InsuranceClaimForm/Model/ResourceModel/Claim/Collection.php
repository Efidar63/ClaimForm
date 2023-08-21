<?php

namespace Droxic\InsuranceClaimForm\Model\ResourceModel\Claim;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'entity_id';

	protected function _construct()
    {
        $this->_init(
            \Droxic\InsuranceClaimForm\Model\Claim::class,
            \Droxic\InsuranceClaimForm\Model\ResourceModel\Claim::class
        );
    }

	public function loadByFirstnameLastnameInsuranceId($firstname, $lastname, $insuranceId)
    {
        return  $this->getResource()->loadByFirstnameLastnameInsuranceId($this, $firstname, $lastname, $insuranceId);
    }
}
