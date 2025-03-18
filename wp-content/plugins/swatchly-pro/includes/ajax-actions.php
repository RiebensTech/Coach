<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Ajax WooCommerce notices.
 */
function swatchly_pro_ajax_add_to_cart_notice() {
    wc_print_notices();
    wp_die();
}

if( swatchly_pro_get_option('pl_enable_ajax_add_to_cart') && swatchly_pro_get_option('pl_enable_cart_popup_notice') ){
    // generate ajax add to cart notice
    add_action( 'wp_ajax_swatchly_pro_ajax_add_to_cart_notice', 'swatchly_pro_ajax_add_to_cart_notice' );
    add_action( 'wp_ajax_nopriv_swatchly_pro_ajax_add_to_cart_notice', 'swatchly_pro_ajax_add_to_cart_notice' );
}

/**
 * AJAX add to cart.
 */
function swatchly_pro_ajax_add_to_cart() {
    if ( ! isset( $_POST['product_id'] ) ) {
        return;
    }

    $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    $product_title     = get_the_title( $product_id );
    $quantity          = ! empty( $_POST['quantity'] ) ? wc_stock_amount( absint( $_POST['quantity'] ) ) : 1;
    $product_status    = get_post_status( $product_id );
    $variation_id      = ! empty( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
    $variation         = ! empty( $_POST['variation'] ) ? array_map( 'sanitize_text_field', $_POST['variation'] ) : array();
    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variation );
    $cart_page_url     = wc_get_cart_url();

    if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation ) && 'publish' === $product_status ) {

        do_action( 'woocommerce_ajax_added_to_cart', $product_id );

        if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
            wc_add_to_cart_message( array( $product_id => $quantity ), true );
        } else {
            $added_to_cart_notice = sprintf(
                /* translators: %s: Product title */
                esc_html__( '"%1$s" has been added to your cart. %2$s', 'swatchly-pro' ),
                esc_html( $product_title ),
                '<a href="' . esc_url( $cart_page_url ) . '">' . esc_html__( 'View Cart', 'swatchly-pro' ) . '</a>'
            );

            wc_add_notice( $added_to_cart_notice );
        }

        WC_AJAX::get_refreshed_fragments();

    } else {

        // If there was an error adding to the cart, redirect to the product page to show any errors.
        $data = array(
            'error'       => true,
            'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
        );

        wp_send_json( $data );
    }
}
add_action( 'wp_ajax_swatchly_pro_ajax_add_to_cart', 'swatchly_pro_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_swatchly_pro_ajax_add_to_cart', 'swatchly_pro_ajax_add_to_cart' );

/**
 * Reload metabox data on variation update
 */
function swatchly_pro_ajax_reload_metabox_panel(){
    // Verify nonce
    $nonce = sanitize_text_field($_REQUEST['nonce']);
    if ( !wp_verify_nonce( $nonce, 'swatchly_pro_product_metabox_save_nonce' ) ) {
        wp_send_json_error(array(
            'message' => esc_html__( 'No naughty business please!', 'swatchly-pro' )
        ));
    }

    $product_id = absint($_REQUEST['product_id']);

    // Panel inner HTML
    ob_start();
    \SwatchlyPro\Admin\Product_Metabox::metabox_panel_inner_html($product_id);
    $html = ob_get_clean();
    
    wp_send_json_success($html);
}
add_action( 'wp_ajax_swatchly_pro_ajax_reload_metabox_panel', 'swatchly_pro_ajax_reload_metabox_panel' );

/**
 * Save product metabox data (ajax)
 */
function swatchly_pro_ajax_save_product_meta(){
    // verify nonce
    $nonce = sanitize_text_field($_REQUEST['nonce']);
    if ( !wp_verify_nonce( $nonce, 'swatchly_pro_product_metabox_save_nonce' ) ) {
        wp_send_json_error(array(
            'message' => esc_html__( 'No naughty business please!', 'swatchly-pro' )
        ));
    }

    // check current user privilege
    if ( !current_user_can( 'edit_products' ) ) {
        wp_die( -1 );
    }

    // print_r($_REQUEST);
    // wp_die();

    $product_id = absint($_REQUEST['product_id']);
    $meta_data  = map_deep( wp_unslash( $_REQUEST['input_fields']['swatchly_product_meta'] ), 'sanitize_text_field' );
    $updated    = update_post_meta( $product_id, '_swatchly_product_meta', $meta_data );

    wp_send_json_success(array(
        'message' => esc_html__('Saved!', 'swatchly-pro')
    ));
}
add_action( 'wp_ajax_swatchly_pro_ajax_save_product_meta', 'swatchly_pro_ajax_save_product_meta' );

/**
 * Reset product metabox data (ajax)
 */
function swatchly_pro_ajax_reset_product_meta(){
    // verify nonce
    $nonce = sanitize_text_field($_REQUEST['nonce']);
    if ( !wp_verify_nonce( $nonce, 'swatchly_pro_product_metabox_save_nonce' ) ) {
        wp_send_json_error(array(
            'message' => esc_html__( 'No naughty business please!', 'swatchly-pro' )
        ));
    }

    // check current user privilege
    if ( !current_user_can( 'edit_products' ) ) {
        wp_die( -1 );
    }

    $product_id = absint($_REQUEST['product_id']);
    $updated    = update_post_meta( $product_id, '_swatchly_product_meta', '' );

    wp_send_json_success(array(
        'message' => esc_html__('Reset Done!', 'swatchly-pro')
    ));
}
add_action( 'wp_ajax_swatchly_pro_ajax_reset_product_meta', 'swatchly_pro_ajax_reset_product_meta' );