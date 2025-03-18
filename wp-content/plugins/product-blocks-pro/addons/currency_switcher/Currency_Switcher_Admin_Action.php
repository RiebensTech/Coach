<?php
/**
 * Currency Switcher Addons.
 * @since v.1.1.9
 */
namespace WOPB_PRO;
defined('ABSPATH') || exit;

/**
 * Currency_Switcher_Admin_Action Class
 * * @since v.1.1.9
 */
class Currency_Switcher_Admin_Action {

    private $wopb_default_currency;
    /**
     * Setup Class
     * @since v.1.1.9
     */
    public function __construct() {
        $this->set_currency();
        add_filter('woocommerce_currency', array($this, 'change_admin_currency_code'));
        add_filter( 'woocommerce_general_settings', array($this,'change_woocommerce_general_settings'));
    }
    /**
	 * Set Default currency data
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function set_currency() {
		$this->wopb_default_currency = wopb_function()->get_setting('wopb_default_currency') ? wopb_function()->get_setting('wopb_default_currency') : get_woocommerce_currency();
	}
       
    /**
     *  Update Woocommerce General Setting for Currency Switcher Addons
     *
     * @since v.1.1.9
     * @param ARRAY | Default Filter Congiguration
     * @return ARRAY
     */

    public function change_woocommerce_general_settings ($settings) {

        $wopb_remove_general_setting = array('woocommerce_currency', 'woocommerce_price_num_decimals', 'woocommerce_currency_pos');
        foreach($settings as $key => $value) {
            if( isset($value['id'])) {
                if( in_array($value['id'] , $wopb_remove_general_setting)) {
                    unset($settings[$key]);
                }
                if( $value['id']=='pricing_options' ) {
                    $settings[$key]['desc'] = esc_html__('WowStore Pro Currency Switcher Addon is enabled. Set the default currency from ', 'product-blocks-pro'). '<a href="'.get_admin_url().'/admin.php?page=wopb-settings'.'" target="blank">'. esc_html__( 'Addon Setting page', 'product-blocks-pro' ).'</a>';
                }
            }
        }
        return $settings;
    }
    /**
	 * Change Currency Code For Admin
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_admin_currency_code() {
		return strtoupper( $this->wopb_default_currency );
	}
}