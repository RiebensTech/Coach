<?php
/**
 * Currency Switcher Addons Core.
 * 
 * @package WOPB_PRO\Currency_Switcher
 * @since v.1.1.9
 */
namespace WOPB_PRO;

defined('ABSPATH') || exit;

/**
 * Currency Switcher class.
 */
class Currency_Switcher {

    /**
	 * Setup class.
	 *
	 * @since v.1.1.9
	 */
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'add_currency_switcher_scripts'));
        add_action('wp_ajax_wopb_current_currency_save', array($this, 'wopb_current_currency_save'));
        add_action('wp_ajax_nopriv_wopb_current_currency_save', array($this, 'wopb_current_currency_save'));
    }

    /**
	 * Currency_Switcher load scripts
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function add_currency_switcher_scripts() {
        wp_enqueue_script('wopb-currency_switcher', WOPB_PRO_URL.'addons/currency_switcher/js/currency_switcher.js', array('jquery'), WOPB_PRO_VER, true);
        wp_localize_script('wopb-currency_switcher', 'wopb_currency_switcher', array(
            'ajax' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('wopb-nonce'),
        ));
    }

    /**
	 * Currency_Switcher Addons Intitial Setup Action
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function initial_setup() {
        $wc_currency = get_woocommerce_currency();
        // Set Default Value
        $initial_data = array(
            'currency_switcher_heading' => 'yes',
            'wopb_default_currency' => $wc_currency,
            'wopb_current_currency' => $wc_currency,
            'wopb_currencies' => array(
                array(
                    'wopb_is_default_currency' => 'yes',
                    'wopb_currency' => $wc_currency,
                    'wopb_currency_decimals' => 2,
                    'wopb_currency_symbol_position' => get_option( 'woocommerce_currency_pos' ),
                    'wopb_currency_rate' => 1,
                )
            ),
        );
        foreach ($initial_data as $key => $val) {
            wopb_function()->set_setting($key, $val);
        }
    }

    /**
	 * Currency_Switcher Addons Save Currency
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function wopb_current_currency_save() {
        if ( ! ( isset( $_REQUEST['wpnonce'] ) && wp_verify_nonce( sanitize_key( wp_unslash( $_REQUEST['wpnonce'] ) ), 'wopb-nonce' ) ) ) {
            return ;
        }
        $data = isset($_POST['data'])? wopb_function()->recursive_sanitize_text_field($_POST['data']):''; //phpcs:ignore
        if ($data) {
            wopb_function()->set_setting('wopb_current_currency', $data);
        }
        wp_send_json_success(__('Settings Data Saved...', 'product-blocks-pro'));
    }
}