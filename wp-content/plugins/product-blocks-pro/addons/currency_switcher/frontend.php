<?php
defined( 'ABSPATH' ) || exit;

/**
 * Require Main Files
 * @since v.1.1.9
 */
add_action( 'wp_loaded', 'wopb_currency_switcher_init' );
function wopb_currency_switcher_init() {
    wp_enqueue_script('wopb-currency_switcher', WOPB_PRO_URL.'addons/currency_switcher/js/currency_switcher.js', array('jquery'), WOPB_PRO_VER, true);
	$settings = wopb_function()->get_setting();
	if ( isset( $settings['wopb_currency_switcher'] ) && $settings['wopb_currency_switcher'] == 'true' ) {
		require_once WOPB_PRO_PATH.'/addons/currency_switcher/Currency_Switcher.php';
		require_once WOPB_PRO_PATH.'/addons/currency_switcher/Currency_Switcher_Action.php';
		require_once WOPB_PRO_PATH.'/addons/currency_switcher/Currency_Switcher_Admin_Action.php';

		$obj = new \WOPB_PRO\Currency_Switcher();
		if( !isset($settings['currency_switcher_heading']) ){
			$obj->initial_setup();
		}
		if(is_admin()) {
			new \WOPB_PRO\Currency_Switcher_Admin_Action();
		}
		if(!is_admin() || (defined( 'DOING_AJAX' ) && DOING_AJAX )) {
			new \WOPB_PRO\Currency_Switcher_Action();
		}
	}
}