<?php
/**
 * Plugin Name: WowStore Pro
 * Description: It is a Pro version of the WowStore Gutenberg WooCommerce Blocks.
 * Version:     2.1.1
 * Author:      wpxpo
 * Author URI:  https://wpxpo.com/
 * Text Domain: product-blocks-pro
 * License:     GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Requires Plugins: woocommerce
**/

defined( 'ABSPATH' ) || exit;

// Define
define( 'WOPB_PRO_VER', '2.1.1' );
define( 'WOPB_PRO_URL', plugin_dir_url( __FILE__ ) );
define( 'WOPB_PRO_BASE', plugin_basename( __FILE__ ) );
define( 'WOPB_PRO_PATH', plugin_dir_path( __FILE__ ) );

// Language Load
add_action( 'init', 'wopb_pro_language_load' );
function wopb_pro_language_load() {
    load_plugin_textdomain( 'product-blocks-pro', false, basename( dirname( __FILE__ ) ) . "/languages/" );
}

// Common Function
if ( ! function_exists( 'wopb_pro_function' ) ) {
    function wopb_pro_function() {
        require_once WOPB_PRO_PATH . 'classes/Functions.php';
        return new \WOPB_PRO\Functions();
    }
}

// Plugin Initialization
require_once WOPB_PRO_PATH . 'classes/Initialization.php';
new \WOPB_PRO\Initialization();