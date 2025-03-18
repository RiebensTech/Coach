<?php
defined( 'ABSPATH' ) || exit;

/**
 * Require Main File
 * @since v.1.0.8
 */
add_action( 'wp_loaded', 'wopb_partial_payment_init' );
function wopb_partial_payment_init() {
	if ( wopb_function()->get_setting( 'wopb_partial_payment' ) == 'true' ) {
		require_once WOPB_PRO_PATH.'/addons/partial_payment/PartialPayment.php';
		$obj = new \WOPB_PRO\PartialPayment();
		if ( ! wopb_function()->get_setting( 'partial_payment_heading' ) ) {
			$obj->initial_setup();
		}
	}
}