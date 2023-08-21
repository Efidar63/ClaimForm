define(
    [
        'Magento_Checkout/js/view/payment/default'
    ],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Droxic_ClaimPayment/payment/claimpayment'
            },
            getMailingAddress: function() {
                return window.checkoutConfig.payment.claim_payment.mailingAddress;
            }
        });
    }
);
