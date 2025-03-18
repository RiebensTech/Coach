<?php
defined( 'ABSPATH' ) || exit;

/**
 * Require Main File
 * @since v.3.2.0
 */
add_action( 'wp_loaded', 'wopb_size_chart_init' );
function wopb_size_chart_init() {
	if ( wopb_function()->get_setting( 'wopb_size_chart' ) == 'true' ) {
		require_once WOPB_PRO_PATH . '/addons/size_chart/SizeChart.php';
		new \WOPB_PRO\SizeChart();
	}
}