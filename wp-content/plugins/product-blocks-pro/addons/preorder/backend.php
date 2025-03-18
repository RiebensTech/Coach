<?php
defined( 'ABSPATH' ) || exit;

/**
 * Preorder Addons Initial Configuration
 * @since v.1.0.4
 */
add_filter( 'wopb_addons_config', 'wopb_preorder_config' );
function wopb_preorder_config( $config ) {
	$configuration = array(
        'name'  => __( 'Pre-Orders', 'product-blocks-pro' ),
        'desc'  => __( 'Display upcoming products as regular products to get orders for those not released yet.', 'product-blocks-pro' ),
        'live'  => 'https://www.wpxpo.com/wowstore/woocommerce-pre-order/live_demo_args',
        'docs'  => 'https://wpxpo.com/docs/wowstore/add-ons/pre-order-addon/addon_doc_args',
        'is_pro'=> true,
        'type' => 'sales',
        'priority' => 50
	);
	$config['wopb_preorder'] = $configuration;
	return $config;
}

/**
 * Preorder Addons Default Settings Parameters
 *
 * @param ARRAY | Default Settings Congiguration
 * @return ARRAY
 * @since v.1.0.4
 */
add_filter( 'wopb_settings', 'get_preorder_settings', 10, 1 );
function get_preorder_settings( $config ) {
    $arr = array(
        'wopb_preorder' => array(
            'label' => __('Pre-order', 'product-blocks-pro'),
            'attr' => array(
                'preorder_heading' => array(
                    'type' => 'heading',
                    'label' => __('Pre-order Settings', 'product-blocks-pro'),
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
                                        'wopb_preorder' => array(
                                            'type' => 'toggle',
                                            'value' => 'true',
                                            'label' => __('Enable Preorder', 'product-blocks-pro'),
                                            'desc' => __("Enable preorder on your website", 'product-blocks-pro')
                                        ),
                                        'preorder_counter_disable' => array(
                                            'type' => 'toggle',
                                            'label' => __('Disable Counter', 'product-blocks-pro'),
                                            'default' => '',
                                            'desc' => __('Enable switch if you want to hide counter.', 'product-blocks-pro')
                                        ),
                                        'preorder_button_text' => array(
                                            'type' => 'text',
                                            'label' => __('Pre-order Label/Text', 'product-blocks-pro'),
                                            'default' => __('Pre-order', 'product-blocks-pro')
                                        ),
                                        'preorder_add_to_cart_button_text' => array(
                                            'type' => 'text',
                                            'label' => __('Pre-order Add to Cart Text', 'product-blocks-pro'),
                                            'default' => __('Pre-order Now', 'product-blocks-pro')
                                        ),
                                        'preorder_message_text' => array(
                                            'type' => 'text',
                                            'label' => __('Availability Message', 'product-blocks-pro'),
                                            'default' => __('Available On', 'product-blocks-pro')
                                        ),
                                        'preorder_coming_soon_text' => array(
                                            'type' => 'text',
                                            'label' => __('Pre-Release Message', 'product-blocks-pro'),
                                            'default' => __('Coming Soon', 'product-blocks-pro')
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
                                        'preorder_available_typo' => array (
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
                                        'preorder_duration_typo' => array (
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
                                        'preorder_remain_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Remaining Label Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'preorder_count_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Remaining Count Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => true,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#333333',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'preorder_timer_bg' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Timer Background', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#191924',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Background Color', 'product-blocks-pro'),
                                        ),
                                        'preorder_time_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Time Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 20,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#ffffff',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'preorder_time_label_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Timer Label Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 12,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#ffffff',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'preorder_time_separator_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Time Separator Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 24,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#ffffff',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'preorder_badge_typo' => array (
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
                                        'preorder_badge_bg' => array (
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
                                        'preorder_badge_padding' => array (
                                            'type'=> 'dimension',
                                            'label'=> __('Badge Padding', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'top' => 5,
                                                'bottom' => 5,
                                                'left' => 5,
                                                'right' => 5,
                                            ),
                                        ),
                                        'preorder_badge_border' => array (
                                            'type'=> 'border',
                                            'label'=> __('Badge Border', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'border' => 0,
                                                'color' => '',
                                            ),
                                        ),
                                        'preorder_badge_radius' => array (
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