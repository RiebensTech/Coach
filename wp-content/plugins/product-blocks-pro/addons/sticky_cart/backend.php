<?php
defined( 'ABSPATH' ) || exit;

/**
 * Sticky Add to Cart Addons Initial Configuration
 * @since v.3.2.0
 */
add_filter( 'wopb_addons_config', 'wopb_sticky_cart_config' );
function wopb_sticky_cart_config( $config ) {
	$configuration = array(
		'name' => __( 'Sticky Add to Cart', 'product-blocks-pro' ),
        'desc' => __( 'Make the Add to Cart Button Sticky on the top or bottom while shoppers scroll the product pages.', 'product-blocks-pro' ),
        'is_pro' => true,
        'live' => 'https://www.wpxpo.com/wowstore/woocommerce-sticky-add-to-cart/live_demo_args',
        'docs' => 'https://wpxpo.com/docs/wowstore/add-ons/sticky-add-to-cart/addon_doc_args',
        'type' => 'checkout_cart',
        'priority' => 20
	);
	$config['wopb_sticky_cart'] = $configuration;
	return $config;
}

/**
 * Sticky Add to Cart Addons Default Settings
 *
 * @since v.3.2.0
 * @param ARRAY | Default Congiguration
 * @return ARRAY
 */
add_filter( 'wopb_settings', 'get_sticky_cart_settings', 10, 1 );
function get_sticky_cart_settings( $config ) {
    $arr = array(
        'wopb_sticky_cart' => array(
            'label' => __('Sticky Add to Cart Settings', 'product-blocks-pro'),
            'attr' => array(
                'tab' => array(
                    'type'  => 'tab',
                    'options'  => array(
                        'settings' => array(
                            'label' => __('Settings', 'product-blocks-pro'),
                            'attr' => array(
                                'wopb_sticky_cart' => array(
                                    'type' => 'toggle',
                                    'value' => 'true',
                                    'label' => __('Enable Sticky Cart', 'product-blocks-pro'),
                                    'desc' => __("Enable sticky cart on your website", 'product-blocks-pro')
                                ),
                                'container_1' => array(
                                    'type'=> 'container',
                                    'attr' => array(
                                        'sticky_cart_position' => array(
                                            'type' => 'radio',
                                            'label' => __('Display Position', 'product-blocks-pro'),
                                            'display' => 'inline-box',
                                            'options' => array(
                                                'bottom' => __('Bottom', 'product-blocks-pro'),
                                                'top' => __('Top', 'product-blocks-pro')
                                            ),
                                            'default' => 'bottom'
                                        ),
                                        'sticky_cart_review' => array(
                                            'type' => 'toggle',
                                            'label' => __('Enable Review', 'product-blocks-pro'),
                                            'desc' => __('Enable review in sticky cart', 'product-blocks-pro'),
                                            'default' => 'yes',
                                        ),
                                        'sticky_cart_link' => array(
                                            'type' => 'toggle',
                                            'label' => __('Enable Link in Title', 'product-blocks-pro'),
                                            'desc' => __('Enable link in title in sticky cart', 'product-blocks-pro'),
                                            'default' => 'yes',
                                        ),
                                        'sticky_cart_product_type' => array(
                                            'type' => 'checkbox',
                                            'label' => __('Display For Product Type', 'product-blocks-pro'),
                                            'options' => array(
                                                'simple' => __('Simple', 'product-blocks-pro'),
                                                'variable' => __('Variable', 'product-blocks-pro'),
                                                'grouped' => __('Grouped', 'product-blocks-pro'),
                                                'external' => __('External', 'product-blocks-pro'),
                                            ),
                                            'default' => ['simple'],
                                        ),
                                        'sticky_cart_mobile' => array(
                                            'type' => 'toggle',
                                            'label' => __('Hide on Mobile', 'product-blocks-pro'),
                                            'default' => 'yes',
                                            'desc' => __('hide on mobile in sticky cart', 'product-blocks-pro')
                                        )
                                    )
                                )
                            )
                        ),
                        'design' => array(
                            'label' => __('Design', 'product-blocks-pro'),
                            'attr' => array(
                                'general_style' => array(
                                    'type' => 'section',
                                    'label' => __('General Style', 'product-blocks-pro'),
                                    'attr' => array(
                                        'sticky_cart_scroll' => array(
                                            'type' => 'number',
                                            'label' => __('Show After Scroll (Px)', 'product-blocks-pro'),
                                            'default' => 300
                                        ),
                                        'sticky_cart_width' => array(
                                            'type' => 'number',
                                            'label' => __('Max Container Width', 'product-blocks-pro'),
                                            'default' => 1100
                                        ),
                                        'sticky_cart_bg' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Background Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#2B2B2B',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Background Color', 'product-blocks-pro'),
                                        ),
                                        'sticky_cart_padding' => array (
                                            'type'=> 'dimension',
                                            'label'=> __('Padding', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'top' => 5,
                                                'bottom' => 5,
                                                'left' => 0,
                                                'right' => 0,
                                            ),
                                        ),
                                    ),
                                ),
                                'left_style' => array(
                                    'type' => 'section',
                                    'label' => __('Product Details Style', 'product-blocks-pro'),
                                    'attr' => array(
                                        'sticky_cart_title_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Title Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#ffffff',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'sticky_cart_stock_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Stock Status Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 14,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#038F22',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'sticky_cart_separator_bg' => array (
                                            'type'=> 'color',
                                            'label'=> __('Separator Color', 'product-blocks-pro'),
                                            'default'=>  '#979797',
                                            'tooltip'=> __('Color', 'product-blocks-pro'),
                                        ),
                                        'sticky_cart_rating_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Rating Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'color' => '#e37e06',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'sticky_cart_rating_fill_color' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'color',
                                            'field2'=> 'hover_color',
                                            'label'=> __('Rating Fill Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'color' => '#FF8F0B',
                                                'hover_color' => '',
                                            ),
                                            'tooltip'=> __('Color', 'product-blocks-pro'),
                                        ),
                                    )
                                ),
                                'right_style' => array(
                                    'type'=> 'section',
                                    'label'=> __('Button/Price Style', 'product-blocks-pro'),
                                    'attr' => array(
                                        'sticky_cart_price_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Price Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#ffffff',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'sticky_cart_btn_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Button Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 14,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#ffffff',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'sticky_cart_btn_bg' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Button Background', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#FF176B',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Background Color', 'product-blocks-pro'),
                                        ),
                                        'sticky_cart_btn_padding' => array (
                                            'type'=> 'dimension',
                                            'label'=> __('Button Padding', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'top' => 12,
                                                'bottom' => 12,
                                                'left' => 20,
                                                'right' => 20,
                                            ),
                                        ),
                                        'sticky_cart_btn_border' => array (
                                            'type'=> 'border',
                                            'label'=> __('Button Border', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'border' => 0,
                                                'color' => '',
                                            ),
                                        ),
                                        'sticky_cart_btn_radius' => array(
                                            'type' => 'number',
                                            'plus_minus' => true,
                                            'label' => __('Button Border Radius', 'product-blocks-pro'),
                                            'default' => 4
                                        ),
                                    )
                                ),
                            )
                        )
                    )
                )
            )
        )
    );
    return array_merge( $config, $arr );
}