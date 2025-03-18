(function ($) {
	"use strict"
    
    $(document).on('click', '.wopb-set-default-currency .wopb-select-container li', function(e) {
        e.preventDefault();
        const selected_currency = $(this).attr('value');
        $('.wp-block-product-blocks-currency-switcher').addClass('wopb-block-loading');
        $.ajax({
            url: wopb_currency_switcher.ajax,
            type: 'POST',
            data: {
                action: 'wopb_current_currency_save',
                data: selected_currency,
                wpnonce: wopb_currency_switcher.security
            },
            success: function(data) {
                $('.wp-block-product-blocks-currency-switcher').removeClass('wopb-block-loading');
                location.reload();
            },
            error: function(xhr) {
                $('.wp-block-product-blocks-currency-switcher').removeClass('wopb-block-loading');
                console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
            },
        });
    });

})(jQuery);