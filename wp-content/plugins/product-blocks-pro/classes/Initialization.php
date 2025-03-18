<?php
namespace WOPB_PRO;

defined( 'ABSPATH' ) || exit;

/**
 * Plugin Initialization
 */
class Initialization {

    /**
     * Plugin Constructor
     */
    public function __construct() {
        add_filter( 'plugin_action_links_' . WOPB_PRO_BASE, array( $this, 'plugin_action_links_callback' ) );
        add_action( 'activated_plugin', array( $this, 'activation_redirect' ) );
        add_action( 'plugins_loaded', array($this, 'requires') );
    }

    /**
	 * Require File for WowStore
     * 
     * @since v.2.0.7
	 * @return NULL
	 */
    public function requires() {
        if ( defined( 'WOPB_VER' ) ) {
            if ( wopb_function()->get_setting( 'is_wc_ready' ) ) {
                $this->include_addons();
            }
        } else {
            require_once WOPB_PRO_PATH . 'classes/Notice.php';
            new \WOPB_PRO\Notice();
        }

        // Pro Plugin Updater Class
        require_once WOPB_PRO_PATH . 'classes/updater/License.php';
        new \WOPB_PRO\License();
    }

    /**
	 * Add Settings Link to in plugin.php Page
     * 
     * @since v.1.3.7
	 * @return ARRAY
	 */
    public function plugin_action_links_callback( $links ) {
        $setting_link = array();
        if ( defined( 'WOPB_VER' ) ) {
            $setting_link['wopb_settings'] = '<a href="'. esc_url( admin_url( 'admin.php?page=wopb-settings#settings' ) ) .'">' . esc_html__( 'Settings', 'product-blocks-pro' ) . '</a>';
        }
        return array_merge( $setting_link, $links );
    }

    /**
	 * Redirect after Plugin is Activated to License Page
     * 
     * @since v.2.0.7
	 * @return NULL
	 */
    public function activation_redirect( $plugin ) {
        if ( $plugin == 'product-blocks-pro/product-blocks-pro.php' ) {
            return wopb_pro_function()->wowstore_activate();
        }
    }

    /**
	 * Include Addons directory
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
	public function include_addons() {
        if ( wopb_function()->get_setting( 'is_wc_ready' ) ) {
            $is_admin = is_admin();
            $addons_dir = array_filter( glob( WOPB_PRO_PATH . 'addons/*' ), 'is_dir' );
            $_page = isset( $_GET['page'] ) ? sanitize_text_field( $_GET['page'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            foreach ( $addons_dir as $key => $value ) {
                $addon_dir_name = str_replace( dirname( $value ) . '/', '', $value );
                $file_name = WOPB_PRO_PATH . 'addons/' . $addon_dir_name;
                if ( $is_admin && $_page == 'wopb-settings' ) { // Only include in settings page
                    if ( file_exists( $file_name . '/backend.php' ) ) {
                        include_once $file_name . '/backend.php';
                    }
                } else {
                    if ( file_exists( $file_name . '/frontend.php' ) ) { // include if is not in settings
                        include_once $file_name . '/frontend.php';
                    }
                }
            }
        }
    }
}