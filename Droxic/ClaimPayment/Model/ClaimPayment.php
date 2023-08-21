<?php
namespace Droxic\ClaimPayment\Model;
class ClaimPayment extends \Magento\Payment\Model\Method\AbstractMethod
{
const PAYMENT_METHOD_CUSTOM_CLAIM_CODE = 'claim_payment';
/**
* Payment method code
*
* @var string
*/
protected $_code = self::PAYMENT_METHOD_CUSTOM_CLAIM_CODE;
}