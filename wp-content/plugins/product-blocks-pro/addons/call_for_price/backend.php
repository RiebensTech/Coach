<?php
defined( 'ABSPATH' ) || exit;

/**
 * Call fo Price Addons Initial Configuration
 * @since v.1.0.6
 */
add_filter( 'wopb_addons_config', 'wopb_call_for_price_config' );
function wopb_call_for_price_config( $config ) {
    $configuration = array(
        'name'  => __( 'Call for Price', 'product-blocks-pro' ),
        'desc'  => __( "Display a calling button instead of the Add to Cart button for the products that don't have prices.", 'product-blocks-pro' ),
        'live'  => 'https://www.wpxpo.com/wowstore/woocommerce-call-for-price/live_demo_args',
        'docs'  => 'https://wpxpo.com/docs/wowstore/add-ons/call-for-price-addon/addon_doc_args',
        'is_pro'=> true,
        'type' => 'sales',
        'priority' => 30
    );
    $config['wopb_call_for_price'] = $configuration;
    return $config;
}

/**
 * Call for Price Addons Default Settings Param
 *
 * @since v.1.0.8
 * @param ARRAY | Default Filter Congiguration
 * @return ARRAY
 */
add_filter( 'wopb_settings', 'get_call_price_settings', 10, 1 );
function get_call_price_settings( $config ) {
    $arr = array(
        'wopb_call_for_price' => array(
            'label' => __('Call for Price', 'product-blocks-pro'),
            'attr' => array(
                'call_for_price_heading' => array(
                    'type' => 'heading',
                    'label' => __('Call for Price Settings', 'product-blocks-pro'),
                ),
                'tab' => array(
                    'type'  => 'tab',
                    'options'  => array(

                        'settings' => array(
                            'label' => __('Settings', 'product-blocks-pro'),
                            'attr' => array(
                                'container-1' => array(
                                    'type' => 'container',
                                    'attr' => array(
                                        'wopb_call_for_price' => array(
                                            'type' => 'toggle',
                                            'value' => 'true',
                                            'label' => __('Enable Call for Price', 'product-blocks-pro'),
                                            'desc' => __("Enable call for price on your website", 'product-blocks-pro')
                                        ),
                                        'call_type' => array(
                                            'type' => 'select',
                                            'label' => __('Type', 'product-blocks-pro'),
                                            'options' => array(
                                                'phone'   => __( 'Phone Call','product-blocks-pro' ),
                                                'skype' => __( 'Skype','product-blocks-pro' ),
                                                'whatsapp' => __( 'Whatsapp','product-blocks-pro' ),
                                                'email' => __( 'Email','product-blocks-pro' ),
                                                'link' => __( 'Custom Link','product-blocks-pro' ),
                                            ),
                                            'default' => 'phone',
                                        ),
                                        'call_link' => array(
                                            'type' => 'text',
                                            'required' => true,
                                            'default' => '',
                                            'label' => __('Recipient Number / ID / Email / Link', 'product-blocks-pro'),
                                            'desc' => __('<strong>Note:</strong> Add number with country code for direct calling and WhatsApp. Add ID for skype.', 'product-blocks-pro'),
                                        ),
                                        'call_for_price_text' => array(
                                            'type' => 'text',
                                            'label' => __('Button Text', 'product-blocks-pro'),
                                            'default' => __('Call for Price', 'product-blocks-pro'),
                                            'desc' => __('Write your preferable text to show on Call/Email For Price button', 'product-blocks-pro')
                                        ),
                                        'call_price_icon_enable' => array(
                                            'type' => 'toggle',
                                            'label' => __('Enable Icon in Button', 'product-blocks-pro'),
                                            'default' => 'yes',
                                            'desc' => __("Enable call for price icon on your website", 'product-blocks-pro')
                                        ),
                                        'call_icon_position' => array(
                                            'type' => 'radio',
                                            'label' => __('Icon Position', 'product-blocks-pro'),
                                            'display' => 'inline-box',
                                            'depends' => ['key' =>'call_price_icon_enable', 'condition' => '==', 'value' => 'yes'],
                                            'options' => array(
                                                'before' => __( 'Before Text','product-blocks-pro' ),
                                                'after' => __( 'After Text','product-blocks-pro' ),
                                            ),
                                            'default' => 'before',
                                        ),
                                        'call_btn_position' => array(
                                            'type' => 'select',
                                            'label' => __('Button Position On Single Product Page', 'product-blocks-pro'),
                                            'options' => array(
                                                'title_bottom'   => __( 'Below Product Title','product-blocks-pro' ),
                                                'description_bottom' => __( 'Below Short Description','product-blocks-pro' ),
                                                'meta_bottom' => __( 'Below Meta','product-blocks-pro' )
                                            ),
                                            'default' => 'title_bottom',
                                            'desc' => __('Choose where will place Call/Email For Price button on single product page', 'product-blocks-pro'),
                                        ),
                                        'call_on_shop' => array(
                                            'type' => 'toggle',
                                            'label' => __('Show Button On Shop Page', 'product-blocks-pro'),
                                            'default' => '',
                                            'desc' => __('Enable Call/Email For Price button for shop page', 'product-blocks-pro')
                                        ),
                                        'call_all_product' => array(
                                            'type' => 'toggle',
                                            'label' => __('Show On All Products', 'product-blocks-pro'),
                                            'default' => '',
                                            'desc' => __('Enable Call/Email For Price for all products.', 'product-blocks-pro')
                                        ),
                                        'call_out_stock' => array(
                                            'type' => 'toggle',
                                            'label' => __('Out Of Stock', 'product-blocks-pro'),
                                            'default' => '',
                                            'desc' => __('Enable Call/Email For Price for all out Of stock product.', 'product-blocks-pro')
                                        ),
                                    ),
                                ),
                            )
                        ),

                        'design' => array(
                            'label' => __('Design', 'product-blocks-pro'),
                            'attr' => array(
                                'call_price_single_style' => array(
                                    'type' => 'section',
                                    'label' => __('Single Product Page Button Style', 'product-blocks-pro'),
                                    'attr' => array(
                                        'call_btn_typo_single' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#000000',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'call_btn_bg_single' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Background Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#FFDC5E',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Background Color', 'product-blocks-pro'),
                                        ),
                                        'call_icon_color_single' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'color',
                                            'field2'=> 'hover_color',
                                            'label'=> __('Icon Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'color' => '#000000',
                                                'hover_color' => '',
                                            ),
                                            'tooltip'=> __('Icon Color', 'product-blocks-pro'),
                                        ),
                                        'call_btn_padding_single' => array (
                                            'type'=> 'dimension',
                                            'label'=> __('Padding', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'top' => 10,
                                                'bottom' => 10,
                                                'left' => 16,
                                                'right' => 16,
                                            ),
                                        ),
                                        'call_btn_margin_single' => array (
                                            'type'=> 'dimension',
                                            'label'=> __('Margin', 'product-blocks'),
                                            'default'=> (object)array(
                                                'top' => 5,
                                                'bottom' => 5,
                                                'left' => 0,
                                                'right' => 0,
                                            ),
                                        ),
                                        'call_btn_border_single' => array (
                                            'type'=> 'border',
                                            'label'=> __('Border', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'border' => 0,
                                                'color' => '',
                                            ),
                                        ),
                                        'call_btn_radius' => array (
                                            'type'=> 'number',
                                            'label'=> __('Border Radius', 'product-blocks-pro'),
                                            'default'=> 4,
                                        ),
                                        'call_icon_size_single' => array (
                                            'type'=> 'number',
                                            'label'=> __('Icon Size', 'product-blocks'),
                                            'default'=> 16,
                                        ),
                                    )
                                ),
                                'call_price_shop_style' => array(
                                    'type' => 'section',
                                    'label' => __('Shop Page Button Style', 'product-blocks-pro'),
                                    'attr' => array(
                                        'call_btn_typo_shop' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#000000',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'call_btn_bg_shop' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Background Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#FFDC5E',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Background Color', 'product-blocks-pro'),
                                        ),
                                        'call_icon_color_shop' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'color',
                                            'field2'=> 'hover_color',
                                            'label'=> __('Icon Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'color' => '#000000',
                                                'hover_color' => '',
                                            ),
                                            'tooltip'=> __('Icon Color', 'product-blocks-pro'),
                                        ),
                                        'call_btn_padding_shop' => array (
                                            'type'=> 'dimension',
                                            'label'=> __('Padding', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'top' => 10,
                                                'bottom' => 10,
                                                'left' => 16,
                                                'right' => 16,
                                            ),
                                        ),
                                        'call_btn_margin_shop' => array (
                                            'type'=> 'dimension',
                                            'label'=> __('Margin', 'product-blocks'),
                                            'default'=> (object)array(
                                                'top' => 0,
                                                'bottom' => 0,
                                                'left' => 0,
                                                'right' => 0,
                                            ),
                                        ),
                                        'call_btn_border_shop' => array (
                                            'type'=> 'border',
                                            'label'=> __('Border', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'border' => 0,
                                                'color' => '',
                                            ),
                                        ),
                                        'call_btn_radius_shop' => array (
                                            'type'=> 'number',
                                            'label'=> __('Border Radius', 'product-blocks-pro'),
                                            'default'=> 4,
                                        ),
                                        'call_icon_size_shop' => array (
                                            'type'=> 'number',
                                            'label'=> __('Icon Size', 'product-blocks'),
                                            'default'=> 16,
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