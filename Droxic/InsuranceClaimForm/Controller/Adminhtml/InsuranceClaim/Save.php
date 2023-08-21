<?php

namespace Droxic\InsuranceClaimForm\Controller\Adminhtml\InsuranceClaim;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;
use Droxic\InsuranceClaimForm\Model\Claim;
use Droxic\InsuranceClaimForm\Model\ClaimFactory;

class Save extends Action
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
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            try {
                // Claim modeli oluştur
                $insuranceClaim = $this->insuranceClaimFactory->create();
                
                // Verileri modele ata
                $insuranceClaim->setData($data);

                // Veriyi kaydet
                $insuranceClaim->save();

                // Başarılı olduğu varsayılan bir sonuç döndür
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setPath('*/*/index');
                return $resultRedirect;
            } catch (\Exception $e) {
                // Hata durumunda bir hata sonucu döndür
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setPath('*/*/edit', ['id' => $data['id']]);
                $this->messageManager->addErrorMessage(__('Veritabanına kaydetme hatası: %1', $e->getMessage()));
                return $resultRedirect;
            }
        }
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Droxic_InsuranceClaimForm::save');
    }
}