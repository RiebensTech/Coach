<?php
defined( 'ABSPATH' ) || exit;

/**
 * Require Main File
 * @since v.1.0.4
 */
add_action( 'wp_loaded', 'wopb_preorder_init' );
function wopb_preorder_init() {
    $settings = wopb_function()->get_setting();
    if ( isset( $settings['wopb_preorder'] ) && $settings['wopb_preorder'] == 'true' ) {
		require_once WOPB_PRO_PATH.'/addons/preorder/Preorder.php';
		$obj = new \WOPB_PRO\preorder();
        if ( ! isset( $settings['preorder_badge_radius'] ) ) {
			$obj->initial_setup();
		}
	}
}