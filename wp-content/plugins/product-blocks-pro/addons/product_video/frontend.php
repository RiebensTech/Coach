<?php
defined( 'ABSPATH' ) || exit;

/**
 * Product Video Addons Initial Configuration
 * @since v.3.2.0
 */
add_filter( 'wopb_addons_config', 'wopb_product_video_config' );
function wopb_product_video_config( $config ) {
	$configuration = array(
		'name' => __( 'Product Video', 'product-blocks-pro' ),
        'desc' => __( "Display product-featured videos instead of featured images and grab users' attention to specific products.", 'product-blocks-pro' ),
        'is_pro' => true,
        'live' => 'https://www.wpxpo.com/wowstore/woocommerce-product-video/live_demo_args',
        'docs' => 'https://wpxpo.com/docs/wowstore/add-ons/product-video/addon_doc_args',
        'type' => 'exclusive',
        'priority' => 60
	);
	$config['wopb_product_video'] = $configuration;
	return $config;
}

/**
 * Require Main File
 * @since v.3.2.0
 */
add_action( 'wp_loaded', 'wopb_product_video_init' );
function wopb_product_video_init() {
	if ( wopb_function()->get_setting( 'wopb_product_video' ) == 'true' ) {
		require_once WOPB_PRO_PATH . '/addons/product_video/ProductVideo.php';
		new \WOPB_PRO\ProductVideo();
	}
}