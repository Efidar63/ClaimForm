<?php

namespace Droxic\Affiliate\Block;

use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Session\SessionManagerInterface;

class AffiliateCookie extends Template
{
    /**
     * Cookie key for guest view
     */
    public const COOKIE_NAME = 'affiliate_id';

    /**
     * Cookie path value
     */
    public const COOKIE_PATH = '/';

    /**
     * Cookie lifetime value
     */
    public const COOKIE_LIFETIME = 86400;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var CookieManagerInterface
     */
    protected $cookieManager;

    /**
     * @var CookieMetadataFactory
     */
    protected $cookieMetadataFactory;

        /**
     * @var \Magento\Framework\Session\SessionManagerInterface
     */
    protected $_sessionManager;

    /**
     * @param Context $context
     * @param CookieManagerInterface $cookieManager
     * @param CookieMetadataFactory $cookieMetadataFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CookieManagerInterface $cookieManager,
        CookieMetadataFactory $cookieMetadataFactory,
        SessionManagerInterface $sessionManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->request = $context->getRequest();
        $this->cookieManager = $cookieManager;
        $this->_sessionManager = $sessionManager;
        $this->cookieMetadataFactory = $cookieMetadataFactory;
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $this->setAffilitaeCookie();
        return '';
    }

    /**
     * @return void
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Stdlib\Cookie\CookieSizeLimitReachedException
     * @throws \Magento\Framework\Stdlib\Cookie\FailureToSendException
     */
    public function setAffilitaeCookie()
    {
        $affiliateId = $this->request->getParam('affiliate_id');
        //var_dump($affiliateId);die;
        if ($affiliateId) {
            $metadata = $this->cookieMetadataFactory->createPublicCookieMetadata()
                //->setHttpOnly(false)
                ->setDuration(self::COOKIE_LIFETIME)
                //->setSecure(false);
                ->setPath($this->_sessionManager->getCookiePath())
                ->setDomain($this->_sessionManager->getCookieDomain());
            $this->cookieManager->setPublicCookie(self::COOKIE_NAME, $affiliateId, $metadata);
        }
    }
}
