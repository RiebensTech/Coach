<?php
/**
 * Plugin Name: Swatchly Pro - Variation Swatches for WooCommerce Products
 * Plugin URI:  https://plugindemo.hasthemes.com/swatchly/
 * Description: Variation Swatches for WooCommerce Products
 * Version:     1.3.0
 * Author:      HasThemes
 * Author URI:  https://hasthemes.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: swatchly-pro
 * Domain Path: /languages
 */

// If this file is accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main class
 *
 * @since 1.0.0
 */
final class Swatchly_Pro {

    /**
     * Version
     *
     * @since 1.0.0
     */
    public $version = '1.3.0';

    /**
     * The single instance of the class
     *
     * @since 1.0.0
     */
    protected static $_instance = null;

    /**
     * Main Instance
     *
     * Ensures only one instance of this pluin is loaded
     *
     * @since 1.0.0
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    private function __construct() {
        $this->define_constants();
        $this->includes();
        $this->run();
    }

    /**
     * Define the required constants
     *
     * @since 1.0.0
     */
    private function define_constants() {
        define( 'SWATCHLY_PRO_VERSION', $this->version );
        define( 'SWATCHLY_PRO_FILE', __FILE__ );
        define( 'SWATCHLY_PRO_PATH', __DIR__ );
        define( 'SWATCHLY_PRO_URL', plugins_url( '', SWATCHLY_PRO_FILE ) );
        define( 'SWATCHLY_PRO_ASSETS', SWATCHLY_PRO_URL . '/assets' );
    }

    /**
     * Include required core files
     *
     * @since 1.0.0
     */
    public function includes() {
        /**
         * Including Codestar Framework.
         */
        if ( ! class_exists( 'CSF' ) ) {
            require_once SWATCHLY_PRO_PATH .'/libs/codestar-framework/codestar-framework.php';
        }
        
        /**
         * Composer autoload file.
         */
        require_once SWATCHLY_PRO_PATH . '/vendor/autoload.php';

        /**
         * Including plugin file for secutiry purpose
         */
        if ( !function_exists( 'is_plugin_active' ) ) {
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        if ( !function_exists( 'get_current_screen' ) ) { 
            require_once ABSPATH . '/wp-admin/includes/screen.php'; 
        } 

        if( is_admin() ){
            require_once SWATCHLY_PRO_PATH .'/includes/Admin/license/SwatchlyPro.php';
            require_once SWATCHLY_PRO_PATH .'/includes/Admin/Diagnostic_Data.php';
        }
    }

    /**
     * First initialization of the plugin
     *
     * @since 1.0.0
     */
    private function run() {
        register_activation_hook( __FILE__, array( $this, 'register_activation_hook_cb' ) );

        if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            add_action( 'admin_notices', array( $this, 'build_dependencies_notice' ) );
        } else {
            // Set up localisation.
            add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

            // Finally initialize this plugin
            add_action( 'plugins_loaded', array( $this, 'init' ) );
        }
    }

    /**
     * Do stuff upon plugin activation
     *
     * @since 1.0.0
     */
    public function register_activation_hook_cb() {
        // deactivate the free plugin if active
        if( is_plugin_active('swatchly/swatchly.php') ){
            add_action('update_option_active_plugins', function(){
                deactivate_plugins('swatchly/swatchly.php');
            });
        }

        $installed = get_option( 'swatchly_pro_installed' );

        if ( ! $installed ) {
            update_option( 'swatchly_pro_installed', time() );
        }

        update_option( 'swatchly_pro_version', SWATCHLY_PRO_VERSION );
    }

    /**
     * Load the plugin textdomain
     *
     * @since 1.0.0
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( 'swatchly-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    /**
     * Initialize this plugin
     *
     * @since 1.0.0
     */
    public function init() {
        new SwatchlyPro\Helper();
        new SwatchlyPro\Admin\Global_Settings();
        new SwatchlyPro\Frontend\Woo_Config();

        if ( is_admin() ) {
            new SwatchlyPro\Admin();
        } elseif( !swatchly_pro_get_option('disable_plugin') ) {
            new SwatchlyPro\Frontend();
            new SwatchlyPro\Compatibility\Elementor();
        }
    }

    /**
     * Output a admin notice when build dependencies not met
     *
     * @since 1.0.0
     */
    public function build_dependencies_notice() {
        $message = sprintf(
            /*
             * translators:
             * 1: Swatchly Pro.
             * 2: WooCommerce.
             */
            esc_html__( '%1$s plugin requires the %2$s plugin to be installed and activated in order to work.', 'swatchly-pro' ),
            '<strong>' . esc_html__( 'Swatchly Pro', 'swatchly-pro' ) . '</strong>',
            '<strong>' . esc_html__( 'WooCommerce', 'swatchly-pro' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning"><p>%1$s</p></div>', wp_kses_post($message) );
    }

}

/**
 * Returns the main instance of Swatchly Pro
 *
 * @since 1.0.0
 */

function swatchly_pro() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
    return Swatchly_Pro::instance();
}

// Kick-off the plugin
swatchly_pro();