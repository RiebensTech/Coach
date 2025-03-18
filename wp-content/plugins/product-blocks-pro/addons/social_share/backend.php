<?php
defined( 'ABSPATH' ) || exit;

/**
 * Social Share Addons Initial Configuration
 * @since v.3.2.0
 */
add_filter( 'wopb_addons_config', 'wopb_social_share_config' );
function wopb_social_share_config( $config ) {
	$configuration = array(
		'name' => __( 'Quick Social Share', 'product-blocks-pro' ),
        'desc' => __( 'Display social share icons and let your shoppers share products with their social profiles instantly.', 'product-blocks-pro' ),
        'is_pro' => true,
        'live' => 'https://www.wpxpo.com/wowstore/woocommerce-social-share/live_demo_args',
        'docs' => 'https://wpxpo.com/docs/wowstore/add-ons/quick-social-share/addon_doc_args',
        'type' => 'exclusive',
        'priority' => 20
	);
	$config['wopb_social_share'] = $configuration;
	return $config;
}

/**
 * Social Share Addons Default Settings
 *
 * @since v.3.2.0
 * @param ARRAY | Default Congiguration
 * @return ARRAY
 */
add_filter( 'wopb_settings', 'get_social_share_settings', 10, 1 );
function get_social_share_settings( $config ) {
    $arr = array(
        'wopb_social_share' => array(
            'label' => __('Social Share Settings', 'product-blocks-pro'),
            'attr' => array(
                'tab' => array(
                    'type'  => 'tab',
                    'options'  => array(
                        'settings' => array(
                            'label' => __('Settings', 'product-blocks-pro'),
                            'attr' => array(
                                'wopb_social_share' => array(
                                    'type' => 'toggle',
                                    'value' => 'true',
                                    'label' => __('Enable Social Share', 'product-blocks-pro'),
                                    'desc' => __("Enable social share on your website", 'product-blocks-pro')
                                ),
                                'container_1' => array(
                                    'type'=> 'container',
                                    'attr' => array(
                                        'social_share_media' => array(
                                            'type' => 'select_item',
                                            'label' => __('Select Share Item', 'product-blocks-pro'),
                                            'desc' => __('Select the item you want to display. To rearrange these fields, you can also drag and drop. You can also customize the label name according to your preferences.', 'product-blocks-pro'),
                                            'options' => array(
                                                ['key' => '','label' => __( 'Select Item','product-blocks-pro' )],
                                                ['key' => 'facebook','label' => __( 'Facebook','product-blocks-pro' )],
                                                ['key' => 'twitter','label' => __( 'Twitter','product-blocks-pro' )],
                                                ['key' => 'messenger','label' => __( 'Messenger','product-blocks-pro' )],
                                                ['key' => 'linkedin','label' => __( 'LinkedIn','product-blocks-pro' )],
                                                ['key' => 'reddit','label' => __( 'Reddit','product-blocks-pro' )],
                                                ['key' => 'mail','label' => __( 'Mail','product-blocks-pro' )],
                                                ['key' => 'whatsapp','label' => __( 'WhatsApp','product-blocks-pro' )],
                                                ['key' => 'skype','label' => __( 'Skype','product-blocks-pro' )],
                                                ['key' => 'pinterest','label' => __( 'Pinterest','product-blocks-pro' )],
                                            ),
                                            'default' => array(
                                                ['key' => 'facebook','label' => 'Facebook'],
                                                ['key' => 'twitter','label' => 'Twitter'],
                                                ['key' => 'messenger','label' => 'Messenger'],
                                                ['key' => 'linkedin','label' => 'LinkedIn'],
                                                ['key' => 'reddit','label' => 'Reddit'],
                                            )
                                        ),
                                        'social_share_icon_show' => array(
                                            'type' => 'toggle',
                                            'label' => __('Show Icon', 'product-blocks-pro'),
                                            'default' => 'yes',
                                            'desc' => __('Show Default Icon with the Button.', 'product-blocks-pro')
                                        ),
                                        'social_share_label_show' => array(
                                            'type' => 'toggle',
                                            'label' => __('Show Label', 'product-blocks-pro'),
                                            'default' => '',
                                            'desc' => __('Show Default Label with the Button.', 'product-blocks-pro')
                                        ),
                                        'social_share_count_show' => array(
                                            'type' => 'toggle',
                                            'label' => __('Show Share Count', 'product-blocks-pro'),
                                            'default' => '',
                                            'desc' => __('Show Share Count in the Social Share.', 'product-blocks-pro')
                                        ),
                                        'social_share_count_lvl' => array(
                                            'type' => 'text',
                                            'label' => __('Share Count Label', 'product-blocks-pro'),
                                            'default' => 'Share',
                                            'depends' => array(
                                                array(
                                                    'key' =>'social_share_label_show',
                                                    'condition' => '==',
                                                    'value' => 'yes'
                                                ),
                                                array(
                                                    'key' =>'social_share_count_show',
                                                    'condition' => '==',
                                                    'value' => 'yes'
                                                ),
                                            )
                                        ),
                                        'social_share_position_type' => array(
                                            'type' => 'radio',
                                            'label' => __('Position Type', 'product-blocks-pro'),
                                            'display' => 'inline-box',
                                            'options' => array(
                                                'inside' => __('Inside Element', 'product-blocks-pro'),
                                                'sticky' => __('Sticky', 'product-blocks-pro')
                                            ),
                                            'default' => 'inside'
                                        ),
                                        'social_share_inside_position' => array(
                                            'type' => 'radio',
                                            'label' => __('Inside Position', 'product-blocks-pro'),
                                            'display' => 'inline-box',
                                            'options' => array(
                                                'before_meta' => __('Before Meta', 'product-blocks-pro'),
                                                'after_meta' => __('After Meta', 'product-blocks-pro'),
                                            ),
                                            'default' => 'after_meta',
                                            'depends' => array(
                                                'key' =>'social_share_position_type',
                                                'condition' => '==',
                                                'value' => 'inside'
                                            )
                                        ),
                                        'social_share_sticky' => array(
                                            'type' => 'radio',
                                            'label' => __('Sticky Position', 'product-blocks-pro'),
                                            'display' => 'inline-box',
                                            'options' => array(
                                                'left' => __('Left', 'product-blocks-pro'),
                                                'right' => __('Right', 'product-blocks-pro')
                                            ),
                                            'default' => 'left',
                                            'depends' => array(
                                                'key' =>'social_share_position_type',
                                                'condition' => '==',
                                                'value' => 'sticky'
                                            )
                                        )
                                    )
                                ),
                            )
                        ),
                        'design' => array(
                            'label' => __('Design', 'product-blocks-pro'),
                            'attr' => array(
                                'container_2' => array(
                                    'type'=> 'container',
                                    'attr' => array(
                                        'social_share_brand_show' => array(
                                            'type' => 'toggle',
                                            'label' => __('Show Brand Color', 'product-blocks-pro'),
                                            'default' => 'yes',
                                            'desc' => __('Show Brand Color in the Button.', 'product-blocks-pro')
                                        ),
                                        'social_share_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#ffffff',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'social_share_icon_size' => array(
                                            'type' => 'number',
                                            'label' => __('Icon Size', 'product-blocks-pro'),
                                            'default' => 20
                                        ),
                                        'social_share_bg' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Background Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#000000',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Background Color', 'product-blocks-pro'),
                                            'depends' => array(
                                                'key' =>'social_share_brand_show',
                                                'condition' => '==',
                                                'value' => ''
                                            )
                                        ),
                                        'social_share_padding' => array (
                                            'type'=> 'dimension',
                                            'label'=> __('Padding', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'top' => 5,
                                                'bottom' => 5,
                                                'left' => 10,
                                                'right' => 10,
                                            ),
                                        ),
                                        'social_share_border' => array (
                                            'type'=> 'border',
                                            'label'=> __('Border', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'border' => 0,
                                                'color' => '',
                                            ),
                                        ),
                                        'social_share_radius' => array(
                                            'type' => 'number',
                                            'plus_minus' => true,
                                            'label' => __('Border Radius', 'product-blocks-pro'),
                                            'default' => 3
                                        ),
                                        'social_share_gap' => array(
                                            'type' => 'number',
                                            'plus_minus' => true,
                                            'label' => __('Button Gap Between', 'product-blocks-pro'),
                                            'default' => 10
                                        ),
                                    )
                                )
                            )
                        )
                    )
                )
            )
        )
    );
    return array_merge( $config, $arr );
}