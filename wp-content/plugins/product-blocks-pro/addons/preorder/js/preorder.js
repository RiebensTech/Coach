(function($) {
    'use strict';

    preorderCheckboxCheck();

    $('._wopb_preorder_price_manage').each(function () {
        preorderPriceCheck($(this))
    });

    $(document).on('click', '._wopb_preorder_price_manage', function () {
        preorderPriceCheck($(this))
    });

    $("#_wopb_preorder_simple").change(function () {
        if ($(this).prop('checked') == true) {
            $('ul.product_data_tabs .productx_options a').trigger('click')
        }
        preorderCheckboxCheck();
    });

    //when variable product load in admin panel
    $(document).on('woocommerce_variations_loaded', function() {
        $('._wopb_preorder_variable').each(function () {
            let preorderGroup = $(this).closest('div.woocommerce_variable_attributes').find('.wopb-woocommerce-variable-preorder-field-group');
            if ($(this).prop('checked') == true) {
                preorderGroup.show();
                preorderGroup.find('.wopb_required').attr("required", "required");
            } else {
                preorderGroup.hide();
                preorderGroup.find('.wopb_required').removeAttr("required");
            }
        });

        $('._wopb_preorder_price_manage').each(function () {
            preorderPriceCheck($(this))
        });
    });

    //when click pre order checkbox in variant product
    $(document).on('click', '._wopb_preorder_variable', function () {
        let preorderGroup = $(this).closest('div.woocommerce_variable_attributes').find('.wopb-woocommerce-variable-preorder-field-group');
        if($(this).prop('checked') == true){
            preorderGroup.show();
            preorderGroup.find('.wopb_required').attr("required", "required");
        }else{
            preorderGroup.hide();
            preorderGroup.find('.wopb_required').removeAttr("required");
        }
    });


    //change add to cart text if variation pre-order
    $('form.variations_form').each( function(){
        let variationForm = $(this);
        let cartText = variationForm.find('.single_add_to_cart_button').text();
        $(variationForm).on('show_variation', function (event, variation) {
            let pre_order_text = $(this).find('.woocommerce-variation-description').find('.wopb-single-variation-pre-order-text').val();
            $('.single_add_to_cart_button').text(pre_order_text ? pre_order_text : cartText);
        })
        .on('hide_variation', function (event) {
            $('.single_add_to_cart_button').text(cartText);
        });
    })


    function preorderCheckboxCheck() {
        if ($("#_wopb_preorder_simple").prop('checked') == true) {
            $("#wopb-woocommerce-preorder-field-group").show();
            $("#wopb-woocommerce-preorder-field-group").find('.wopb_required').attr("required", "required");
            $("#wopb-preorder-select-instruction").hide();
        } else {
            $("#wopb-woocommerce-preorder-field-group").hide();
            $("#wopb-woocommerce-preorder-field-group").find('.wopb_required').removeAttr("required");
            $("#wopb-preorder-select-instruction").show();
        }
    }

    function preorderPriceCheck(this_object){
        const priceCheck = this_object.parent('p').parent().find('.wopb_preorder_manage_price_depend_required');
        if (this_object.prop('checked') == true) {
            priceCheck.parent('p').show()
            priceCheck.attr("required", "required")
        } else {
            priceCheck.parent('p').hide()
            priceCheck.removeAttr("required")
        }
    }
    const countDown = $('.wopb-singlepage-preorder-countdown');
    const countDownDate = new Date(countDown.data('pre-order-date'));
    setInterval(function() {
        countTimer();
    }, 1000);

    function countTimer() {
        const currentTime = Date.now();
        const distance = countDownDate - currentTime;
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countDown.find('.wopb-count-days').text( String(days).padStart(2, '0') )
        countDown.find('.wopb-count-hours').text( String(hours).padStart(2, '0') )
        countDown.find('.wopb-count-minutes').text( String(minutes).padStart(2, '0') )
        countDown.find('.wopb-count-seconds').text( String(seconds).padStart(2, '0') )
    }
    
})( jQuery );