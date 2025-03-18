(function($) {
    'use strict';

    $('.wopb-partial-payment-enable').each(function () {
        enablePartialPayment($(this))
    });
    $(document).on('click', '.wopb-partial-payment-enable', function () {
        enablePartialPayment($(this))
    })

    //when variable product load in admin panel
    $(document).on('woocommerce_variations_loaded', function() {
        $('.wopb-partial-payment-enable').each(function () {
            enablePartialPayment($(this))
        });
    });

    //common function of enable partial payment
    function enablePartialPayment(object){
        let depositSection = object.parent().parent().find('.wopb-admin-deposit-section');
        if(object.prop('checked') == true){
            depositSection.show(400);
            depositSection.find('.wopb-required').prop('required',true);
        }else{
            depositSection.hide(400);
            depositSection.find('.wopb-required').prop('required',false);
        }
    }

    //show/hide partial payment section in product details page
    depositOptionCheck($('input[name="_wopb_deposit_option"]'));
    $(document).on('found_variation', function(e, t) {
        depositOptionCheck($('input[name="_wopb_deposit_option"]'));
    })
    $(document).on('change','input[name="_wopb_deposit_option"]', function() {
        depositOptionCheck($(this));
    })

    function depositOptionCheck(object){
        if(object.val() == 'partial'){
            $('.wopb-partial-amount-section').show(400)
        }else {
            $('.wopb-partial-amount-section').hide(400)
        }
    }

})( jQuery );