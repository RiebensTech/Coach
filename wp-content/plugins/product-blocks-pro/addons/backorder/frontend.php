<?php
defined( 'ABSPATH' ) || exit;

/**
 * Require Main File
 * @since v.1.0.7
 */
add_action( 'wp_loaded', 'wopb_backorder_init' );
function wopb_backorder_init() {
    $settings = wopb_function()->get_setting();
	if ( isset( $settings['wopb_backorder'] ) && $settings['wopb_backorder'] == 'true' ) {
		require_once WOPB_PRO_PATH.'/addons/backorder/Backorder.php';
		$obj = new \WOPB_PRO\backorder();
		if ( ! isset( $settings['backorder_badge_radius'] ) ) {
			$obj->initial_setup();
		}
	}
}
