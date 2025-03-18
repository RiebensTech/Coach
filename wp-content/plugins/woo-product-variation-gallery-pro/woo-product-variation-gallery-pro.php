<?php
/**
 * Plugin Name:         Variation Images Gallery for WooCommerce Pro
 * Plugin URI:          https://radiustheme.com
 * Description:         This is a Pro plugin of Variation Images Gallery for WooCommerce
 * Version:             2.3.9
 * Author:              RadiusTheme
 * Author URI:          https://radiustheme.com
 * Requires at least:   4.8
 * Tested up to:        6.4
 * WC requires at least:3.2
 * WC tested up to:     8.2.1
 * Domain Path:         /languages
 * Text Domain:         woo-product-variation-gallery-pro
 */

if ( !defined('ABSPATH') ) {
    exit;
}

// Define PLUGIN_FILE.
if ( !defined('RTWPVGP_PLUGIN_FILE') ) {
    define('RTWPVGP_PLUGIN_FILE', __FILE__);
}

// Define VERSION.
if ( !defined('RTWPVGP_VERSION') ) { 
    define('RTWPVGP_VERSION', '2.3.9');
}

define( 'RTWPVGP_PATH', plugin_dir_path(__FILE__ ) );

// HPOS
add_action( 'before_woocommerce_init', function() {
	if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	}
} );

add_action( 'admin_notices', function() {
    // Makes sure the plugin is defined before trying to use it
    $is_active = in_array( 'woo-product-variation-gallery/woo-product-variation-gallery.php', apply_filters('active_plugins', get_option('active_plugins') ) );
    if( is_multisite() ){
        $is_active = is_plugin_active_for_network( 'woo-product-variation-gallery/woo-product-variation-gallery.php' ) || $is_active;
    }
    if ( ! $is_active ) { 
        $class = 'notice notice-error'; 
        $text = esc_html__('Variation Images Gallery for WooCommerce', 'woo-product-variation-gallery-pro');
        $link = esc_url(
            add_query_arg(
                array(
                    'tab' => 'plugin-information',
                    'plugin' => 'woo-product-variation-gallery',
                    'TB_iframe' => 'true',
                    'width' => '640',
                    'height' => '500',
                ), admin_url('plugin-install.php')
            )
        );
        $link_pro = 'https://www.radiustheme.com/downloads/woocommerce-variation-images-gallery';

        printf('<div class="%1$s"><p><a target="_blank" href="%3$s"><strong>Variation Images Gallery for WooCommerce Pro</strong></a> is not working, You need to install and activate <a class="thickbox open-plugin-details-modal" href="%2$s"><strong>%4$s</strong></a> free version to get the pro features.</p></div>', $class, $link, $link_pro, $text);
    }
});
add_action('rtwpvg_loaded', function() {  
    if ( !class_exists('Rtwpvgp') ) {
        require_once("app/Rtwpvgp.php");
    } 
} );   

// TODO: Next version need add video in product main gallery. ( Client recommendation  )