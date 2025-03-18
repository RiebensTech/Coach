<?php
defined( 'ABSPATH' ) || exit;

/**
 * Backorder Addons Initial Configuration
 * @since v.1.0.7
 */
add_filter( 'wopb_addons_config', 'wopb_backorder_config' );
function wopb_backorder_config( $config ) {
	$configuration = array(
        'name'  => __( 'Backorder', 'product-blocks-pro' ),
        'desc'  => __( 'Keep getting orders for the products that are currently out of stock and will be restocked soon.', 'product-blocks-pro' ),
        'live'  => 'https://www.wpxpo.com/wowstore/woocommerce-backorder/live_demo_args',
        'docs'  => 'https://wpxpo.com/docs/wowstore/add-ons/back-order-addon/addon_doc_args',
        'is_pro'=> true,
        'type' => 'sales',
        'priority' => 40
	);
	$config['wopb_backorder'] = $configuration;
	return $config;
}

/**
 * Backorder Addons Default Settings Parameters
 *
 * @param ARRAY | Default Settings Congiguration
 * @return ARRAY
 * @since v.1.0.7
 */
add_filter( 'wopb_settings', 'get_backorder_settings', 10, 1 );
function get_backorder_settings( $config ) {
    $arr = array(
        'wopb_backorder' => array(
            'label' => __('Backorder', 'product-blocks-pro'),
            'attr' => array(
                'backorder_heading' => array(
                    'type' => 'heading',
                    'label' => __('Backorder Settings', 'product-blocks-pro'),
                ),
                'tab' => (object)array(
                    'type'  => 'tab',
                    'options'  => array(
                        'settings' => (object)array(
                            'label' => __('Settings', 'product-blocks-pro'),
                            'attr' => array(
                                'container_1' => array(
                                    'type'=> 'container',
                                    'attr' => array(
                                        'wopb_backorder' => array(
                                            'type' => 'toggle',
                                            'value' => 'true',
                                            'label' => __('Enable Backorder', 'product-blocks-pro'),
                                            'desc' => __("Enable backorder on your website", 'product-blocks-pro')
                                        ),
                                        'backorder_button_text' => array(
                                            'type' => 'text',
                                            'label' => __('Backorder Label/Text', 'product-blocks-pro'),
                                            'default' => __('Backorder', 'product-blocks-pro')
                                        ),
                                        'backorder_add_to_cart_button_text' => array(
                                            'type' => 'text',
                                            'label' => __('Backorder Add to Cart Text', 'product-blocks-pro'),
                                            'default' => __('Backorder Now', 'product-blocks-pro')
                                        ),
                                        'backorder_message_text' => array(
                                            'type' => 'text',
                                            'label' => __('Availability Message', 'product-blocks-pro'),
                                            'default' => __('Available On', 'product-blocks-pro')
                                        ),
                                    )
                                ),
                            )
                        ),
                        'design' => (object)array(
                            'label' => __('Design', 'product-blocks-pro'),
                            'attr' => array(
                                'container_2' => array(
                                    'type'=> 'container',
                                    'attr' => array(
                                        'backorder_available_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Available Label Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => true,
                                                'italic' => true,
                                                'underline' => false,
                                                'color' => '#398e29',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'backorder_duration_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Duration Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => true,
                                                'italic' => true,
                                                'underline' => false,
                                                'color' => '#398e29',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'backorder_remain_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Remaining Label Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#000000',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'backorder_count_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Remaining Count Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => true,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#000000',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'backorder_badge_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Badge Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 12,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#ffffff',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'backorder_badge_bg' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Badge Background', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#007cba',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Background Color', 'product-blocks-pro'),
                                        ),
                                        'backorder_badge_padding' => array (
                                            'type'=> 'dimension',
                                            'label'=> __('Badge Padding', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'top' => 5,
                                                'bottom' => 5,
                                                'left' => 5,
                                                'right' => 5,
                                            ),
                                        ),
                                        'backorder_badge_border' => array (
                                            'type'=> 'border',
                                            'label'=> __('Badge Border', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'border' => 0,
                                                'color' => '',
                                            ),
                                        ),
                                        'backorder_badge_radius' => array (
                                            'type'=> 'number',
                                            'label'=> __('Badge Border Radius', 'product-blocks-pro'),
                                            'default'=> '',
                                        ),
                                    )
                                ),
                            )
                        ),
                    )
                ),
            )
        )
    );
    return array_merge( $config, $arr );
}