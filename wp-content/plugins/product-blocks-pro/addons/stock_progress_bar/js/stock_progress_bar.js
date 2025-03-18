(function ($) {
	"use strict";
	showStockProgress()
	$('form.variations_form').on('show_variation', function (event, variation) {
		showStockProgress()
	})

	function showStockProgress(){
		let order_progress = $('.wopb-stock-progress').attr('data-order-progress')
		$('.wopb-stock-progress').animate({ width: `${order_progress}%` }, 1300);
	}

})(jQuery);