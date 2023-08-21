define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'claim_payment',
                component: 'Droxic_ClaimPayment/js/view/payment/method-renderer/claimpayment-method'
            }
        );
        return Component.extend({});
    }
);
//commit
