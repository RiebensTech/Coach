<?php
defined( 'ABSPATH' ) || exit;

/**
 * Require Main File
 * @since v.3.2.0
 */
add_action( 'wp_loaded', 'wopb_sticky_cart_init' );
function wopb_sticky_cart_init() {
	if ( wopb_function()->get_setting( 'wopb_sticky_cart' ) == 'true' ) {
		require_once WOPB_PRO_PATH . '/addons/sticky_cart/StickyCart.php';
		new \WOPB_PRO\StickyCart();
	}
}