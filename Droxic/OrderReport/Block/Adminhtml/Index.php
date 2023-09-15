<?php
declare(strict_types=1);

namespace Droxic\OrderReport\Block\Adminhtml;

use Droxic\OrderReport\Model\Model;
use Magento\Backend\Block\Template;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends Template
{
    protected $model;

    protected $context;

    protected $formKey;
    protected $priceHelper;

    protected $scopeConfig;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param Model $model 
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Model $model, 
        \Magento\Framework\Data\Form\FormKey $formKey,
        PriceHelper $priceHelper, // PriceHelper'ı ekleyin
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->model = $model; 
        $this->context = $context;
        $this->formKey = $formKey;
        parent::__construct($context, $data);
        $this->priceHelper = $priceHelper;
        $this->scopeConfig = $scopeConfig;
    }
    

    public function getReport() {
        $dateFrom = $this->context->getRequest()->getParam('start_date');
        $dateTo = $this->context->getRequest()->getParam('end_date');
        $affiliateId = $this->context->getRequest()->getParam('affiliate_id');
        
        if ($dateFrom && $dateTo && $affiliateId) {
            return  $this->model->getReportData($dateTo, $dateFrom, $affiliateId);
        }
        return [];
    }
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

    public function getFormUrl()
    {
        return $this->context->getUrlBuilder()->getUrl('drx_order_report/report/index');

    }

    public function getAffiliateIds()
    {
        return  $this->model->getAffiliateIds();
    }

    public function currencyFormatter($value, $sign = true)
    {
        return $this->priceHelper->currency($value, $sign, false);
    }
    public function getAffiliatePercentage()
    {
         return  $this->scopeConfig->getValue(
            "droxic_config/general/percentage",
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
         );
    }

    public function getAffiliateCommission($totals)
    {
        if ($percentage = $this->getAffiliatePercentage()) {

            $commission = (float)($percentage/100* (float)$totals);
            return $this->currencyFormatter($commission);

        }
        return $this->currencyFormatter($totals);
    }
}