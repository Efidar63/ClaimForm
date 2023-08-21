<?php

declare(strict_types=1);

namespace Droxic\InsuranceClaimForm\Model\ResourceModel;

class Claim extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('drx_claim', 'entity_id');
    }
    public function loadByFirstnameLastnameInsuranceId($claimModel, $firstname, $lastname, $insuranceId)
    {
        $connection = $this->getConnection();
        $select = $connection->select()->from($this->getMainTable())
            ->where('claim_firstname = ?', $firstname)
            ->where('claim_lastname = ?', $lastname)
            ->where('claim_ins_id = ?', $insuranceId)
            ->limit(1);

        $data = $connection->fetchRow($select);
  
        return $data;
    }
}
