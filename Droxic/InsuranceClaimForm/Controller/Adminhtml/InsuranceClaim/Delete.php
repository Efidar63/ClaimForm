<?php

namespace Droxic\InsuranceClaimForm\Controller\Adminhtml\InsuranceClaim;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Droxic\InsuranceClaimForm\Model\Claim;
use Droxic\InsuranceClaimForm\Model\ClaimFactory;

class Delete extends Action
{
    protected $insuranceClaimFactory;
    protected $resultFactory;
     protected $context;

    public function __construct(
        Action\Context $context,
        ResultFactory $resultFactory,
        ClaimFactory $insuranceClaimFactory
    )
    {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
        $this->insuranceClaimFactory = $insuranceClaimFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        if ($id) {
            try {
                // Claim modelini yükle
                $insuranceClaim = $this->insuranceClaimFactory->create();
                $insuranceClaim->load($id);
                
                // Veriyi sil
                $insuranceClaim->delete();

                // Başarılı olduğu varsayılan bir sonuç döndür
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setPath('*/*/index');
                return $resultRedirect;
            } catch (\Exception $e) {
                // Hata durumunda bir hata sonucu döndür
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setPath('*/*/edit', ['id' => $id]);
                $this->messageManager->addErrorMessage(__('Silme hatası: %1', $e->getMessage()));
                return $resultRedirect;
            }
        }
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Droxic_InsuranceClaimForm::delete');
    }
}
