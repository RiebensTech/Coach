<?php
defined( 'ABSPATH' ) || exit;

/**
 * Stock Progress Bar Addons Initial Configuration
 * @since v.1.0.5
 */
add_filter( 'wopb_addons_config', 'wopb_stock_progress_bar_config' );
function wopb_stock_progress_bar_config( $config ) {
	$configuration = array(
        'name'  => __( 'Stock Progress Bar', 'product-blocks-pro' ),
        'desc'  => __( 'Visually highlight the total and remaining stocks of products to encourage shoppers to create FOMO.', 'product-blocks-pro' ),
        'live'  => 'https://www.wpxpo.com/wowstore/woocommerce-stock-progress-bar/live_demo_args',
        'docs'  => 'https://wpxpo.com/docs/wowstore/add-ons/stock-progress-bar-addon/addon_doc_args',
        'is_pro'=> true,
        'type' => 'sales',
        'priority' => 80
	);
	$config['wopb_stock_progress_bar'] = $configuration;
	return $config;
}

/**
 * Stock Progress Bar Addons Default Settings Param
 *
 * @since v.1.0.5
 * @param ARRAY | Default Filter Congiguration
 * @return ARRAY
 */
add_filter( 'wopb_settings', 'get_stock_progress_settings', 10, 1 );
function get_stock_progress_settings( $config ) {
    $arr = array(
        'wopb_stock_progress_bar' => array(
            'label' => __('Stock Progress Bar', 'product-blocks-pro'),
            'attr' => array(
                'stock_progress_bar_heading' => array(
                    'type' => 'heading',
                    'label' => __('Stock Progress Bar Settings', 'product-blocks-pro'),
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
                                        'wopb_stock_progress_bar' => array(
                                            'type' => 'toggle',
                                            'value' => 'true',
                                            'label' => __('Enable Progress bar', 'product-blocks-pro'),
                                            'default' => '',
                                            'desc' => __("Enable stock progress bar on your website", 'product-blocks-pro')
                                        ),
                                        'total_sell_count_text' => array(
                                            'type' => 'text',
                                            'label' => __('Total Sell Count Text', 'product-blocks-pro'),
                                            'default' => __('Total Sold', 'product-blocks-pro')
                                        ),
                                        'available_item_count_text' => array(
                                            'type' => 'text',
                                            'label' => __('Available Item Count Text', 'product-blocks-pro'),
                                            'default' => __('Available Item', 'product-blocks-pro')
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
                                        'stock_progress_label_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Label Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#656565',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'stock_progress_count_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Count Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => true,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#000000',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'stock_progress_bg' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Progress Bar Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#e2e2e2',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Color', 'product-blocks-pro'),
                                        ),
                                        'stock_progress_active_bg' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Progress Bar Active Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#25b064',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Color', 'product-blocks-pro'),
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