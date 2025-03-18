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
 * Product Video Addons Default Settings
 *
 * @since v.3.2.0
 * @param ARRAY | Default Congiguration
 * @return ARRAY
 */
add_filter( 'wopb_settings', 'get_product_video_settings', 10, 1 );
function get_product_video_settings( $config ) {
    $arr = array(
        'wopb_product_video' => array(
            'label' => __('Product Video Settings', 'product-blocks-pro'),
            'attr' => array(
                'container_1' => array(
                    'type'=> 'container',
                    'attr' => array(
                        'wopb_product_video' => array(
                            'type' => 'toggle',
                            'value' => 'true',
                            'label' => __('Enable Product Video', 'product-blocks-pro'),
                            'desc' => __("Enable product video on your website", 'product-blocks-pro')
                        ),
                        'product_video_archive' => array(
                            'type' => 'toggle',
                            'label' => __('Show on Shop & Archive', 'product-blocks-pro'),
                            'default' => 'yes',
                            'desc' => __('Show Video on Shop & Archive Page', 'product-blocks-pro')
                        ),
                        'product_video_single' => array(
                            'type' => 'toggle',
                            'label' => __('Show on Single Product Page', 'product-blocks-pro'),
                            'default' => 'yes',
                            'desc' => __('Show video on Product Single Page', 'product-blocks-pro')
                        ),
                        'product_video_display' => array(
                            'type' => 'radio',
                            'display' => 'inline-box',
                            'label' => __('Display', 'product-blocks-pro'),
                            'options' => array(
                                'video' => __('Direct Video Embedded', 'product-blocks-pro'),
                                'icon' => __('Icon On Image', 'product-blocks-pro')
                            ),
                            'default' => 'icon',
                            'desc' => __("Select Display Type", 'product-blocks-pro'),
                        ),
                        'product_video_icon' => array(
                            'type' => 'radio',
                            'label' => __('Icon', 'product-blocks-pro'),
                            'display' => 'inline-box',
                            'options' => array(
                                'play_1' => wopb_function()->svg_icon('play_1'),
                                'play_2' => wopb_function()->svg_icon('play_2'),
                                'play_3' => wopb_function()->svg_icon('play_3'),
                                'play_4' => wopb_function()->svg_icon('play_4'),
                            ),
                            'default' => 'play_2',
                            'desc' => __("Play Icon on Feature Image", 'product-blocks-pro'),
                            'depends' => array(
                                'key' =>'product_video_display',
                                'condition' => '==',
                                'value' => 'icon'
                            )
                        ),
                    )
                ),
            )
        )
    );
    return array_merge( $config, $arr );
}