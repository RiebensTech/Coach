<?php
defined( 'ABSPATH' ) || exit;

/**
 * Partial Payment Addons Initial Configuration
 * @since v.1.0.8
 */
add_filter( 'wopb_addons_config', 'wopb_partial_payment_config' );
function wopb_partial_payment_config( $config ) {
	$configuration = array(
        'name'  => __( 'Partial Payment', 'product-blocks-pro' ),
        'desc'  => __( 'Split product prices into parts and let the customers place orders by paying only a deposit amount.', 'product-blocks-pro' ),
        'live'  => 'https://www.wpxpo.com/wowstore/woocommerce-partial-payment/live_demo_args',
        'docs'  => 'https://wpxpo.com/docs/wowstore/add-ons/partial-payment/addon_doc_args',
        'is_pro'=> true,
        'type' => 'sales',
        'priority' => 70
	);
	$config['wopb_partial_payment'] = $configuration;
	return $config;
}

/**
 * Partial Payment Addons Default Settings Parameters
 *
 * @param ARRAY | Default Settings Configuration
 * @return ARRAY
 * @since v.1.0.8
 */
add_filter( 'wopb_settings', 'get_partial_payment_settings', 10, 1 );
function get_partial_payment_settings( $config ) {
    $arr = array(
        'wopb_partial_payment' => array(
            'label' => __('Partial Payment', 'product-blocks-pro'),
            'attr' => array(
                'partial_payment_heading' => array(
                    'type' => 'heading',
                    'label' => __('Partial Payment Settings', 'product-blocks-pro'),
                ),
                'wopb_partial_payment' => array(
                    'type' => 'toggle',
                    'value' => 'true',
                    'label' => __('Enable Partial Payment', 'product-blocks-pro'),
                    'desc' => __("Enable partial payment on your website", 'product-blocks-pro')
                ),
                'container_1' => array(
                    'type'=> 'container',
                    'attr' => array(
                        'partial_payment_label_text' => array(
                            'type' => 'text',
                            'label' => __('Partial Payment Label/Text', 'product-blocks-pro'),
                            'default' => __('Partial Payment', 'product-blocks-pro')
                        ),
                        'deposit_payment_text' => array(
                            'type' => 'text',
                            'label' => __('Deposit/First Payment Text', 'product-blocks-pro'),
                            'default' => __('First Payment', 'product-blocks-pro')
                        ),
                        'full_payment_text' => array(
                            'type' => 'text',
                            'label' => __('Full Payment Text', 'product-blocks-pro'),
                            'default' => __('Full Payment', 'product-blocks-pro')
                        ),
                        'deposit_to_pay_text' => array(
                            'type' => 'text',
                            'label' => __('To Pay', 'product-blocks-pro'),
                            'default' => __('To Pay', 'product-blocks-pro')
                        ),
                        'deposit_paid_text' => array(
                            'type' => 'text',
                            'label' => __('Paid', 'product-blocks-pro'),
                            'default' => __('Paid', 'product-blocks-pro')
                        ),
                        'deposit_amount_text' => array(
                            'type' => 'text',
                            'label' => __('Deposit Amount Text', 'product-blocks-pro'),
                            'default' => __('Deposit', 'product-blocks-pro')
                        ),
                        'due_payment_text' => array(
                            'type' => 'text',
                            'label' => __('Due Payment', 'product-blocks-pro'),
                            'default' => __('Due Payment', 'product-blocks-pro')
                        ),
                        'deposit_paid_status' => array(
                            'type'    => 'select',
                            'default' => 'wc-processing',
                            'options' => wc_get_order_statuses(),
                            'label'   => __( 'Deposit Paid Status', 'product-blocks-pro' ),
                            'desc'    => __( 'Set order status when deposits are paid', 'product-blocks-pro' ),
                        ),
                        'disable_payment_method' => array(
                            'type' => 'multiselect',
                            'label' => __( 'Disable Payment Methods	', 'product-blocks-pro' ),
                            'options' => payment_gateway_list(),
                            'desc' => 'Test',
                        ),
                    )
                ),
            )
        )
    );
    return array_merge( $config, $arr );
}

/**
 * Payment Gateway List
 *
 * @return ARRAY
 * @since v.1.0.8
 */
 function payment_gateway_list() {
    $active_gateways = array();
    $gateways = WC()->payment_gateways->payment_gateways();
    foreach ( $gateways as $id => $gateway ) {
        if ( $gateway->enabled == 'yes' ) {
            $active_gateways[$id] = $gateway->title;
        }
    }
    return $active_gateways;
}