<?php
defined( 'ABSPATH' ) || exit;

/**
 * Require Main File
 * @since v.1.0.5
 */
add_action( 'wp_loaded', 'wopb_stock_progress_bar_init' );
function wopb_stock_progress_bar_init() {
    $settings = wopb_function()->get_setting();
    if ( isset( $settings['wopb_stock_progress_bar'] ) && $settings['wopb_stock_progress_bar'] == 'true' ) {
		require_once WOPB_PRO_PATH.'/addons/stock_progress_bar/StockProgressBar.php';
		$obj = new \WOPB_PRO\StockProgressBar();
        if ( ! isset( $settings['stock_progress_active_bg'] ) ) {
			$obj->initial_setup();
		}
	}
}