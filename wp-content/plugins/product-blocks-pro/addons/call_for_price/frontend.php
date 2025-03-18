<?php
defined( 'ABSPATH' ) || exit;

/**
 * Require Main File
 * @since v.1.0.6
 */
add_action( 'wp_loaded', 'wopb_call_for_price_init' );
function wopb_call_for_price_init() {
    $settings = wopb_function()->get_setting();
    if ( isset( $settings['wopb_call_for_price'] ) && $settings['wopb_call_for_price'] == 'true' ) {
        require_once WOPB_PRO_PATH . '/addons/call_for_price/CallForPrice.php';
        $obj = new \WOPB_PRO\CallForPrices();
        if ( ! isset( $settings['call_btn_radius_shop'] ) ) {
            $obj->initial_setup();
        }
    }
}