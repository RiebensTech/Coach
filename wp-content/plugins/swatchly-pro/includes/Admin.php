<?php
namespace SwatchlyPro;

/**
 * Admin class.
 */
class Admin {

    public $version = '';
    /**
     * Constructor.
     */
    public function __construct() {
        // Set time as the version for development mode.
        if( defined('WP_DEBUG') && WP_DEBUG ){
            $this->version = time();
        } else {
            $this->version = SWATCHLY_PRO_VERSION;
        }
        new Admin\Woo_Config();
        new Admin\Attribute_Taxonomy_Metabox();
        new Admin\Product_Metabox();

        // Bind admin page link to the plugin action link.
        add_filter( 'plugin_action_links_swatchly-pro/swatchly-pro.php', array($this, 'action_links_add'), 10, 4 );

        // Admin assets hook into action.
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

        // Tewak admin submenu
        add_action( 'admin_menu', array( $this, 'tweak_admin_submenu' ), 30 );
    }

    /**
     * Action link add.
     */
    function action_links_add( $actions, $plugin_file, $plugin_data, $context ){

        $settings_page_link = sprintf(
            /*
             * translators:
             * 1: Settings label
             */
            '<a href="'. esc_url( get_admin_url() . 'admin.php?page=swatchly-admin' ) .'">%1$s</a>',
            esc_html__( 'Settings', 'swatchly-pro' )
        );

        array_unshift( $actions, $settings_page_link );

        return $actions;
    }

    /**
     * Enqueue admin assets.
     */
    public function enqueue_admin_assets() {
        $current_screen = get_current_screen();
        if (
            $current_screen->post_type == 'product' ||
            $current_screen->base == 'toplevel_page_swatchly-admin'
        ) {
            if( $current_screen->base == 'post' ){
                wp_enqueue_style( 'wp-color-picker' );
                wp_enqueue_script( 'wp-color-picker-alpha',  SWATCHLY_PRO_ASSETS . '/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), $this->version, true );
            }

            wp_enqueue_style( 'swatchly-pro-admin', SWATCHLY_PRO_ASSETS . '/css/admin.css', array(), $this->version );
            wp_enqueue_script( 'swatchly-pro-admin', SWATCHLY_PRO_ASSETS . '/js/admin.js', array('jquery'), $this->version, true );


            // inline js for the settings submenu
            $is_swatchly_setting = isset( $_GET['page'] ) ? $_GET['page'] : '';
            $is_swatchly_setting = $is_swatchly_setting == 'swatchly-admin' ? 1 : 0;
            wp_add_inline_script( 'swatchly-pro-admin', 'var swatchly_is_settings_page = '. esc_js( $is_swatchly_setting ) .';');

            $localize_vars = array();
            if(get_post_type() == 'product'){
                $localize_vars['product_id'] = get_the_id();
            } else {
                $localize_vars['product_id'] = '';
            }

            $localize_vars['nonce']                   = wp_create_nonce('swatchly_pro_product_metabox_save_nonce');
            $localize_vars['i18n']['saving']          = esc_html__('Saving...', 'swatchly-pro');
            $localize_vars['i18n']['choose_an_image'] = esc_html__('Choose an image', 'swatchly-pro');
            $localize_vars['i18n']['use_image']       = esc_html__('Use image', 'swatchly-pro');
            $localize_vars['pl_override_global']      = swatchly_pro_get_option('pl_override_global');
            $localize_vars['sp_override_global']      = swatchly_pro_get_option('sp_override_global');
            wp_localize_script( 'swatchly-pro-admin', 'swatchly_pro_params', $localize_vars );
        }
    }

    /**
     * Tewak admin submenu
     */
    function tweak_admin_submenu(){
        global $submenu;
        if ( isset( $submenu['swatchly-admin'] ) ) {
            $submenu['swatchly-admin'][0][0] = esc_html__('Settings', 'swatchly-pro');
        }
    }

}