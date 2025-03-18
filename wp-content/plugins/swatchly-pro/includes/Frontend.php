<?php
namespace SwatchlyPro;

/**
 * Frontend class.
 */
class Frontend {

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
        // frontend assets
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );

        // generate blank notice wrapper for ajax add to cart
        if(swatchly_pro_get_option('enable_swatches', null, 'pl')){
            add_action('wp_footer', array( $this, 'popup_notice_blank_div') );
        }

        // add body class
        add_filter( 'body_class', array( $this, 'custom_body_class') );
    }

    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        // Thickbox.
        add_thickbox();

        wp_register_style( 'swatchly-pro-frontend', SWATCHLY_PRO_ASSETS . '/css/frontend.css', array(), $this->version );
        wp_register_script( 'swatchly-pro-add-to-cart-variation', SWATCHLY_PRO_ASSETS . '/js/add-to-cart-variation.js', array('jquery', 'wp-util', 'jquery-blockui' ), $this->version, true );
        wp_register_script( 'swatchly-pro-frontend', SWATCHLY_PRO_ASSETS . '/js/frontend.js', array('jquery'), $this->version, true );

        $enable_swatches = swatchly_pro_get_option('enable_swatches', null, 'pl');

        if( is_product() ){
            $enable_swatches = swatchly_pro_get_option('enable_swatches', null, 'sp');
        }

        if($enable_swatches){
            wp_enqueue_style( 'swatchly-pro-frontend' );
            wp_enqueue_script( 'swatchly-pro-frontend' );
        }

        $enable_swatches                 = swatchly_pro_get_option('enable_swatches', null, 'pl');
        $auto_convert_dropdowns_to_label = swatchly_pro_get_option('auto_convert_dropdowns_to_label', null, 'pl');
        $tooltip                         = swatchly_pro_get_option('tooltip', null, 'pl');
        $deselect_on_click               = swatchly_pro_get_option('deselect_on_click', null, 'pl');
        $show_selected_attribute_name    = swatchly_pro_get_option('show_selected_attribute_name', null, 'pl');
        $variation_label_separator       = swatchly_pro_get_option('variation_label_separator', null, 'pl');
        $product_thumbnail_selector      = swatchly_pro_get_option('pl_product_thumbnail_selector');
        $hide_wc_forward_button          = swatchly_pro_get_option('pl_hide_wc_forward_button');
        $enable_cart_popup_notice        = swatchly_pro_get_option('pl_enable_cart_popup_notice');
        $enable_catalog_mode             = swatchly_pro_get_option('pl_enable_catalog_mode');
        $sp_override_global              = swatchly_pro_get_option('sp_override_global');
        $pl_override_global              = swatchly_pro_get_option('pl_override_global');
        $enable_variation_url            = swatchly_pro_get_option('variation_url');
        $enable_pl_variation_url         = swatchly_pro_get_option('pl_variation_url');
        $enable_sp_variation_url         = swatchly_pro_get_option('sp_variation_url');
        
        $variation_label_separator       = swatchly_pro_get_option('sp_variation_label_separator');
        if(is_product()){
            $enable_swatches                 = swatchly_pro_get_option('enable_swatches', null, 'sp');
            $auto_convert_dropdowns_to_label = swatchly_pro_get_option('auto_convert_dropdowns_to_label', null, 'sp');
            $tooltip                         = swatchly_pro_get_option('tooltip', null, 'sp');
            $deselect_on_click               = swatchly_pro_get_option('deselect_on_click', null, 'sp');
            $show_selected_attribute_name    = swatchly_pro_get_option('show_selected_attribute_name', null, 'sp');
        }

        $localize_vars = array(
            'is_product'                      => is_product(),
            'enable_swatches'                 => $enable_swatches,
            'auto_convert_dropdowns_to_label' => $auto_convert_dropdowns_to_label,
            'tooltip'                         => $tooltip,
            'deselect_on_click'               => $deselect_on_click,
            'show_selected_attribute_name'    => $show_selected_attribute_name,
            'variation_label_separator'       => $variation_label_separator,
            'product_thumbnail_selector'      => $product_thumbnail_selector,
            'hide_wc_forward_button'          => $hide_wc_forward_button,
            'enable_cart_popup_notice'        => $enable_cart_popup_notice,
            'enable_catalog_mode'             => $enable_catalog_mode,
            'sp_override_global'              => $sp_override_global,
            'pl_override_global'              => $pl_override_global,
            'enable_variation_url'            => $enable_variation_url,
            'enable_pl_variation_url'         => $enable_pl_variation_url,
            'enable_sp_variation_url'         => $enable_sp_variation_url,
        );
        wp_localize_script( 'swatchly-pro-frontend', 'swatchly_pro_params', $localize_vars );

        // Localize for WC Variation js
        wc_get_template( 'single-product/add-to-cart/variation.php' );

        $params = array(
            'wc_ajax_url'                      => \WC_AJAX::get_endpoint( '%%endpoint%%' ),
            'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'swatchly-pro' ),
            'i18n_make_a_selection_text'       => esc_attr__( 'Please select some product options before adding this product to your cart.', 'swatchly-pro' ),
            'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'swatchly-pro' ),
        );
        wp_localize_script( 'swatchly-pro-add-to-cart-variation', 'swatchly_add_to_cart_variation_params', $params );
    }

     /**
      * Add custom body class
      */   
    function custom_body_class( $classes ) {
        $show_swatches_label = swatchly_pro_get_option('pl_show_swatches_label');
        $show_clear_link     = swatchly_pro_get_option('pl_show_clear_link');
        if(!is_product() && $show_swatches_label){
            $classes[] = 'swatchly_pl_show_swatches_label_'. $show_swatches_label;
        }

        if(!is_product() && $show_clear_link){
            $classes[] = 'swatchly_pl_show_clear_link_'. $show_clear_link;
        }

        return $classes;
    }

    /**
     * Ajax add to cart notice div
     */
    public function popup_notice_blank_div(){
        ?>
        <div id="swatchly_notice_popup" style="display:none;"></div>
        <?php
    }
}