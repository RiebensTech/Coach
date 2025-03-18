<?php
defined( 'ABSPATH' ) || exit;

/**
 * Cart Reserved Timer Addons Initial Configuration
 * @since v.3.2.0
 */
add_filter( 'wopb_addons_config', 'wopb_cart_reserved_config' );
function wopb_cart_reserved_config( $config ) {
	$configuration = array(
		'name' => __( 'Cart Reserved Timer', 'product-blocks-pro' ),
        'desc' => __( 'Display a countdown timer and show a FOMO message once someone adds products to the cart.', 'product-blocks-pro' ),
        'is_pro' => true,
        'live' => 'https://www.wpxpo.com/wowstore/woocommerce-cart-reserved-timer/live_demo_args',
        'docs' => 'https://wpxpo.com/docs/wowstore/add-ons/cart-reserved-timer/addon_doc_args',
        'type' => 'checkout_cart',
        'priority' => 10
	);
	$config['wopb_cart_reserved'] = $configuration;
	return $config;
}

/**
 * Cart Reserved Timer Addons Default Settings
 *
 * @since v.3.2.0
 * @param ARRAY | Default Congiguration
 * @return ARRAY
 */
add_filter( 'wopb_settings', 'get_cart_reserved_settings', 10, 1 );
function get_cart_reserved_settings( $config ) {
    $arr = array(
        'wopb_cart_reserved' => array(
            'label' => __('Cart Reserved Timer Settings', 'product-blocks-pro'),
            'attr' => array(
                
                'tab' => array(
                    'type'  => 'tab',
                    'options'  => array(
                        'settings' => array(
                            'label' => __('Settings', 'product-blocks-pro'),
                            'attr' => array(
                                'wopb_cart_reserved' => array(
                                    'type' => 'toggle',
                                    'value' => 'true',
                                    'label' => __('Enable Cart Reserved', 'product-blocks-pro'),
                                    'desc' => __("Enable cart reserved on your website", 'product-blocks-pro')
                                ),
                                'container_1' => array(
                                    'type'=> 'container',
                                    'attr' => array(
                                        'cart_reserved_time' => array(
                                            'type' => 'number',
                                            'label' => __('Countdown Duration Minutes', 'product-blocks-pro'),
                                            'default' => 10,
                                        ),
                                        'cart_reserved_msg' => array(
                                            'type' => 'text',
                                            'label' => __('Cart Reserved Message', 'product-blocks-pro'),
                                            'default' => 'An item of your cart is in high demand.',
                                        ),
                                        'cart_reserved_time_msg' => array(
                                            'type' => 'text',
                                            'label' => __('Timer Message', 'product-blocks-pro'),
                                            'default' => 'Your cart is saved for {time} minutes!'
                                        ),
                                        'cart_reserved_expire' => array(
                                            'type' => 'radio',
                                            'label' => __('What to do after the timer expires?', 'product-blocks-pro'),
                                            'options' => array(
                                                'hide' => __('Hide Timer', 'product-blocks-pro'),
                                                'clear' => __('Clear Cart', 'product-blocks-pro')
                                            ),
                                            'default' => 'hide'
                                        ),
                                        'cart_reserved_icon' => array(
                                            'type' => 'radio',
                                            'label' => __('Choose An Icon', 'product-blocks-pro'),
                                            'display' => 'inline-box',
                                            'options' => array(
                                                'fire' => '🔥',
                                                'watch' => '⏱️',
                                                'bell' => '🔔',
                                                'timer' => '⏳',
                                                'rocket' => '🚀',
                                                'bomb' => '🧨',
                                                'blast' => '💥'
                                            ),
                                            'default' => 'fire',
                                        )
                                    ),
                                ),
                            )
                        ),
                        'design' => array(
                            'label' => __('Design', 'product-blocks-pro'),
                            'attr' => array(
                                'container_2' => array(
                                    'type' => 'container',
                                    'attr' => array(
                                        'cart_reserved_bg' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'bg',
                                            'field2'=> 'hover_bg',
                                            'label'=> __('Background Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'bg' => '#F8F9FA',
                                                'hover_bg' => '',
                                            ),
                                            'tooltip'=> __('Background Color', 'product-blocks-pro'),
                                        ),
                                        'cart_reserved_padding' => array(
                                            'type' => 'number',
                                            'label' => __('Padding', 'product-blocks-pro'),
                                            'default' => 10
                                        ),
                                        'cart_reserved_border' => array (
                                            'type'=> 'border',
                                            'label'=> __('Border', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'border' => 1.6,
                                                'color' => '#DDDDDD',
                                                'border_style' => 'dashed',
                                            ),
                                        ),
                                        'cart_reserved_radius' => array(
                                            'type' => 'number',
                                            'label' => __('Border Radius', 'product-blocks-pro'),
                                            'default' => 4
                                        ),
                                        'cart_reserved_msg_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Message Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 14,
                                                'bold' => false,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#000000',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'cart_reserved_typo' => array (
                                            'type'=> 'typography',
                                            'label'=> __('Reserved Typography', 'product-blocks-pro'),
                                            'default'=> (object)array(
                                                'size' => 16,
                                                'bold' => true,
                                                'italic' => false,
                                                'underline' => false,
                                                'color' => '#000000',
                                                'hover_color' => '',
                                            ),
                                        ),
                                        'cart_reserved_timer_color' => array (
                                            'type'=> 'color2',
                                            'field1'=> 'color',
                                            'field2'=> 'hover_color',
                                            'label'=> __('Timer Color', 'product-blocks-pro'),
                                            'default'=>  (object)array(
                                                'color' => '#ff176b',
                                                'hover_color' => '',
                                            ),
                                            'tooltip'=> __('Label Color', 'product-blocks-pro'),
                                        ),
                                        'cart_reserved_icon_size' => array(
                                            'type' => 'number',
                                            'label' => __('Icon Size', 'product-blocks-pro'),
                                            'default' => 25
                                        ),
                                    ),
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