<?php
/**
 * Partial Payment Addons Core.
 *
 * @package WOPB_PRO\Partial Payment
 * @since v.1.0.8
 */

namespace WOPB_PRO;

use WC_Order_Item_Product;
require_once WOPB_PRO_PATH.'/addons/partial_payment/DepositOrder.php';

defined('ABSPATH') || exit;

/**
 * Partial Payment class.
 */
class PartialPayment
{
    /**
     * Setup class.
     *
     * @since v.1.0.8
     */

    public function __construct()
    {
        // Add Script for Addons
        add_action('wp_enqueue_scripts', [$this, 'add_partial_payment_scripts']);
        add_action('admin_enqueue_scripts', [$this, 'add_partial_payment_scripts']);

        //Register Order Type for Partial Payment
        $this->order_type_register();

        //Partial Payment Tab
        add_filter('woocommerce_product_data_tabs', [$this, 'product_data_tabs'], 10, 1);
        add_action('woocommerce_product_data_panels', [$this,'product_data_panels']);

        //Simple Product Data Save
        add_action('woocommerce_process_product_meta', [$this, 'process_product_meta'], 10, 2);

        //Add Custom Field in Variable Product
        add_action('woocommerce_product_after_variable_attributes', [$this, 'product_after_variable_attributes'], 10, 3);
        //Variable Product Data Save
        add_action('woocommerce_save_product_variation', [$this, 'save_product_variation'], 10, 2);

        //Add To Cart Text and link Change in Product Grid
        add_filter( 'woocommerce_loop_add_to_cart_link', [ $this, 'loop_add_to_cart_link' ], 100, 3 );
		add_action( 'woocommerce_product_add_to_cart_text', [ $this, 'product_add_to_cart_text' ], 100, 2 );

        //Partial Payment Section Before Add To Cart Button
        add_action( 'woocommerce_before_add_to_cart_button', [$this, 'before_add_to_cart_button' ], 10,2 );

        //Partial Payment Section in Variable Product
        add_filter('woocommerce_available_variation', [$this, 'available_variation'], 10, 3);

        //Save Deposit Data To Cart
        add_filter('woocommerce_add_cart_item_data', [$this, 'add_cart_item_data'], 10, 3);

        //Add To Cart Validation
        add_filter( 'woocommerce_add_to_cart_validation', [$this, 'add_to_cart_validation'], 20, 5 );

        //Cart Item Name
        add_filter('woocommerce_cart_item_name', [$this, 'cart_item_name'], 10, 4);

        //Modify Subtotal
        add_filter( 'woocommerce_cart_item_subtotal', [ $this, 'cart_item_subtotal' ], 99, 3 );

        //Show Total Partial Amount After Cart Total in Cart Page
        add_action( 'woocommerce_cart_totals_after_order_total', [$this, 'cart_totals_after_order_total'] );

        //Show Total Partial Amount After Cart Total in Checkout Page
        add_action( 'woocommerce_review_order_after_order_total', [$this, 'cart_totals_after_order_total'] );

        // Add Deposit Meta When Checkout
        add_filter('woocommerce_checkout_create_order_line_item', [$this, 'checkout_create_order_line_item'], 10, 4);

        //Get Payment Gateway List
        add_filter( 'woocommerce_available_payment_gateways', [$this, 'available_payment_gateways'], 20, 1 );

        //Add Deposit Data in Order Meta
        add_action( 'woocommerce_checkout_update_order_meta', [$this, 'checkout_update_order_meta'], 10, 2 );

        //Create Order
        add_action( 'woocommerce_create_order', array( $this, 'create_order' ), 10, 2 );

        //Change Status When Order Complete
        add_action( 'woocommerce_thankyou', [$this ,'change_order_status'], 10, 2 );

        //Show Partial Paid And Due After Order Total in Order Details
        add_filter( 'woocommerce_get_order_item_totals', [$this, 'get_order_item_totals'], 10, 2 );

        //Generate Deposit Order When Payment Order Status Check
        add_filter( 'woocommerce_cod_process_payment_order_status', [$this, 'payment_order_status'], 10, 2 );
        add_filter( 'woocommerce_bacs_process_payment_order_status', [$this, 'payment_order_status'], 10, 2 );
        add_filter( 'woocommerce_cheque_process_payment_order_status', [$this, 'payment_order_status'], 10, 2 );
        add_filter( 'woocommerce_payment_complete_order_status', [$this, 'payment_complete_order_status'], 10, 3 );

        //Deposit Order Details of Partial Payment for Customer Account
        add_action( 'woocommerce_after_order_details', [$this, 'deposit_order_details'], 10, 1 );

        // Order Item Formatted Meta Data
        add_filter('woocommerce_order_item_get_formatted_meta_data', [$this, 'order_item_get_formatted_meta_data'], 10, 4);

        //add column to order table in admin panel
        add_filter('manage_edit-shop_order_columns', [$this, 'add_column_in_order_listing_page'], 10, 1);
        add_action('manage_shop_order_posts_custom_column', [$this, 'set_order_type_column_value'], 10, 2);

        //Deposit Order Metabox fot Admin
        add_action( 'add_meta_boxes', [$this, 'deposit_order_metabox'] );

        //Deposit Payment Order Table in Admin Side
        add_filter( 'manage_wopb_deposit_order_posts_columns', [$this, 'wopb_deposit_order_posts_columns'] );
        add_action( 'manage_wopb_deposit_order_posts_custom_column', [$this, 'wopb_deposit_order_posts_custom_column'], 10, 2 );
        add_action( 'pre_get_posts', [$this, 'show_all_deposit_orders'], 10, 1 );

        //Change Status When Deposit Order Status Completed
        add_action( 'woocommerce_order_status_completed', [$this, 'deposit_order_status_completed'], 10, 1 );

        //Track and update order when due amount paid
        add_action( 'woocommerce_order_status_changed', array($this, 'due_amount_payment_complete'), 10, 4 );
    }

    /**
	 * Partial Payment JS & CSS Script
     * 
     * @since v.1.0.8
	 * @return NULL
	 */
    public function add_partial_payment_scripts() {
        wp_enqueue_style('wopb-partial-payment-style', WOPB_PRO_URL . 'addons/partial_payment/css/partial_payment.css', array(), WOPB_PRO_VER);
        wp_enqueue_script('wopb-partial-payment-script', WOPB_PRO_URL . 'addons/partial_payment/js/partial_payment.js', array('jquery'), WOPB_PRO_VER, true);
    }

    /**
     * Partial Payment Addons Initial Setup Action
     *
     * @return NULL
     * @since v.1.0.8
     */
    public function initial_setup()
    {
        $initial_data = array(
            'partial_payment_heading' => 'yes',
            'partial_payment_label_text' => __('Partial Payment', 'product-blocks-pro'),
            'deposit_payment_text' => __('First Payment', 'product-blocks-pro'),
            'full_payment_text' => __('Full Payment', 'product-blocks-pro'),
            'deposit_to_pay_text' => __('To Pay', 'product-blocks-pro'),
            'deposit_paid_text' => __('Paid', 'product-blocks-pro'),
            'deposit_amount_text' => __('Deposit', 'product-blocks-pro'),
            'due_payment_text' => __('Due Payment', 'product-blocks-pro'),
            'deposit_paid_status' => __('wc-completed', 'product-blocks-pro'),
        );
        foreach ($initial_data as $key => $val) {
            wopb_function()->set_setting($key, $val);
        }
    }

    public function order_type_register() {
		wc_register_order_type(
			'wopb_deposit_order',
			[
				'labels' => [
					'name'      => __( 'Deposit Payments', 'product-blocks-pro' ),
					'menu_name' => _x( 'Deposit Payments', 'Admin menu name', 'product-blocks-pro' ),
				],
				'description'                      => __( 'Deposit Payments List', 'product-blocks-pro' ),
				'public'                           => false,
				'show_ui'                          => true,
				'capability_type'                  => 'shop_order',
				'map_meta_cap'                     => true,
				'publicly_queryable'               => false,
				'exclude_from_search'              => true,
				'show_in_menu'                     => current_user_can( 'manage_woocommerce' ) ? 'woocommerce' : true,
				'hierarchical'                     => false,
				'show_in_nav_menus'                => true,
				'capabilities'                     => array(
					'create_posts' => 'do_not_allow',
				),
				'query_var'                        => false,
				'supports'                         => array( 'title', 'custom-fields' ),
				'has_archive'                      => false,

				'exclude_from_orders_screen'       => true,
				'add_order_meta_boxes'             => true,
				'exclude_from_order_count'         => true,
				'exclude_from_order_views'         => true,
				'exclude_from_order_webhooks'      => true,
				'exclude_from_order_reports'       => true,
				'exclude_from_order_sales_reports' => false,

			]
		);
	}

    /**
     * Partial Payment Tab
     *
     * @return ARRAY
     * @since v.1.0.8
     */
    public function product_data_tabs( $product_data_tabs ) {
        $product_data_tabs['partial_payment'] = array(
            'label'  => __( 'Partial Payment', 'product-blocks-pro' ),
            'class'  => array( 'show_if_simple', 'hidden', 'wopb_product_tab' ),
            'target' => 'partial_payment_tab_data',
            'priority' => 15.2,
        );
        return $product_data_tabs;
    }

    /**
     * Partial Payment Custom Field to Simple Product
     *
     * @since v.1.0.8
     * @return HTML
     */
    public function product_data_panels(){
        global $post;
        $product = wc_get_product($post->ID);
        if($product->is_type('simple')){
            $html = '';
            $html .= '<div class="panel woocommerce_options_panel hidden" id="partial_payment_tab_data">';
                $html .= $this->generate_field($post->ID, '');
            $html .= '</div>';

            echo $html; //phpcs:ignore
        }
    }

    /**
     * Partial Payment Custom Field to Variable Product
     *
     * @return HTML
     * @since v.1.0.8
     */
    public function product_after_variable_attributes($loop, $variation_data, $variation)
    {
        if ( wopb_function()->get_setting( 'is_lc_active' ) ) {
            $product = wc_get_product($variation->ID);
            $html = $this->generate_field($variation->ID, $loop);
            echo $html; //phpcs:ignore
        }
    }

    /**
     * Generate Custom Field
     *
     * @return HTML
     * @since v.1.0.8
     */
    public function generate_field($post_id, $loop = '') {
        $html = '';
        $product = wc_get_product($post_id);
        $loop = $loop !== '' ? '['.$loop.']' : '';

        $html .= '<div class="wopb-partial-payment-field-group">';
            $html .= '<h4 class="wopb-partial-payment-title">' . __('WowStore Partial Payment Information', 'product-blocks-pro') . '</h4>';

            ob_start();
            woocommerce_wp_checkbox([
                'id' => '_wopb_partial_payment_enable'.$loop,
                'class' => 'wopb-partial-payment-enable',
                'label' => __('Enable/Disable', 'product-blocks-pro'),
                'type' => 'checkbox',
                'value' => $product->get_meta('_wopb_partial_payment_enable'),
                'description' => __('Enable partial payment for this product', 'product-blocks-pro'),
            ]);

            echo '<div class="wopb-admin-deposit-section">';
                woocommerce_wp_select([
                    'id' => '_wopb_partial_payment_deposit_type'.$loop,
                    'class' => 'select short wopb-required',
                    'label' => __('Deposit Type', 'product-blocks-pro'),
                    'options' => array(
                        '' => __('Select Type', 'product-blocks-pro'),
                        'fixed' => __('Fixed', 'product-blocks-pro'),
                        'percentage' => __('Percentage', 'product-blocks-pro'),
                    ),
                    'value' => $product->get_meta('_wopb_partial_payment_deposit_type'),
                    'desc_tip' => true,
                    'description' => __("Set the deposit type", 'product-blocks-pro'),
                ]);

                woocommerce_wp_text_input([
                    'id' => '_wopb_partial_amount'.$loop,
                    'class' => 'short wopb-required',
                    'label' => __('Deposit Amount', 'product-blocks-pro'),
                    'type' => 'number',
                    'value' => $product->get_meta('_wopb_partial_amount'),
                    'desc_tip' => true,
                    'description' => __("Enter first deposit amount", 'product-blocks-pro')
                ]);
            echo '</div>';
            $html .= ob_get_clean();

        $html .= '</div>';

        return $html;
    }

    /**
     * Partial Payment Simple Product Custom Data Save
     *
     * @return NULL
     * @since v.1.0.8
     */
    public function process_product_meta($post_id)
    {
        $product = wc_get_product($post_id);
        if (isset($_POST['_wopb_partial_payment_enable'])) {
            $product->update_meta_data('_wopb_partial_payment_enable', 'yes');
            $product->update_meta_data('_wopb_partial_payment_deposit_type', isset($_POST['_wopb_partial_payment_deposit_type'])?sanitize_text_field($_POST['_wopb_partial_payment_deposit_type']):'');
            $product->update_meta_data('_wopb_partial_amount', isset($_POST['_wopb_partial_amount'])?sanitize_text_field($_POST['_wopb_partial_amount']):'' );
        }else {
            $product->update_meta_data('_wopb_partial_payment_enable', '');
        }
        $product->save();
    }

    /**
     * Partial Payment Variable Product Custom Data Save
     *
     * @return NULL
     * @since v.1.0.8
     */
    public function save_product_variation($variation_id, $a)
    {
        $product = wc_get_product($variation_id);
        if (isset($_POST['_wopb_partial_payment_enable'][$a])) {
            $product->update_meta_data('_wopb_partial_payment_enable', 'yes');
            $product->update_meta_data('_wopb_partial_payment_deposit_type', isset($_POST['_wopb_partial_payment_deposit_type'][$a])?sanitize_text_field($_POST['_wopb_partial_payment_deposit_type'][$a]):'' );
            $product->update_meta_data('_wopb_partial_amount', isset($_POST['_wopb_partial_amount'][$a])?sanitize_text_field($_POST['_wopb_partial_amount'][$a]):'');
        }else {
            $product->update_meta_data('_wopb_partial_payment_enable', '');
        }
        $product->save();
    }

    /**
     * Add To Cart Link
     *
     * @return LINK
     * @since v.1.0.8
     */
	public function loop_add_to_cart_link($link, $product, $args) {
		if ( $product->get_meta('_wopb_partial_payment_enable') ) {
			return str_replace(
				[ 'href="?add-to-cart=' . $product->get_id() . '"', 'add_to_cart_button', 'ajax_add_to_cart' ],
				[ 'href="' . get_permalink($product->get_id())  . '"', '', '' ],
				$link );
		}
		return $link ;
	}

    /**
     * Add To Cart Text
     *
     * @return STRING
     * @since v.1.0.8
     */
	public function product_add_to_cart_text( $text, $product ) {
		if ( $product->get_meta('_wopb_partial_payment_enable') ) {
			return  esc_html( wopb_function()->get_setting('partial_payment_label_text') );
		}
		return $text;
	}

    /**
     * Partial Payment HTML Content for Simple Product
     *
     * @return HTML
     * @since v.1.0.8
     */
    public function before_add_to_cart_button(){
        global $product;
        if($product->is_type('simple') && $product->get_meta('_wopb_partial_payment_enable')) {
            echo $this->partial_payment_section_html($product); //phpcs:ignore
        }
    }

    /**
     * Partial Payment HTML Content for Variable Product
     *
     * @return HTML
     * @since v.1.0.8
     */
    public function available_variation($data, $product, $variation)
    {
        if ($product->is_type('variable') && $variation->get_meta('_wopb_partial_payment_enable')) {
            $data['price_html'] .= $this->partial_payment_section_html($variation);
        }
        return $data;
    }

    /**
     * Partial Payment HTML
     *
     * @return HTML
     * @since v.1.0.8
     */
    public function partial_payment_section_html($product){
        $html = '<div class="wopb-deposit-section">';
            $html .= '<div class="wopb-partial-pay-section">';
                $html .= '<label for="wopb-partial-payment">';
                    $html .= '<input type="radio" name="_wopb_deposit_option" id="wopb-partial-payment" value="partial" checked /> ' . wopb_function()->get_setting( 'partial_payment_label_text' );
                $html .= '</label>';
                $html .= '<div class="wopb-partial-amount-section">';
                    $html .= '<span class="wopb-partial-amount-title">' . wopb_function()->get_setting( 'deposit_payment_text' ) . ': </span> <strong class="wopb-partial-amount">' . wc_price( $this->get_partial_first_payment( $product ) ) . '</strong>';
                    $html .= '<input type="hidden" name="_wopb_partial_amount" value="' . $product->get_meta( '_wopb_partial_amount' ) . '">';
                $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="wopb-full-pay-section">';
                $html .= '<label for="wopb-full-payment">';
                    $html .= '<input type="radio" name="_wopb_deposit_option" id="wopb-full-payment" value="full"/>' . wopb_function()->get_setting( 'full_payment_text' );
                $html .= '</label>';
            $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Add Custom Data To Cart
     *
     * @return ARRAY
     * @since v.1.0.8
     */
    public function add_cart_item_data($cart_item_data, $product_id, $variation_id) {
        $product_id = $variation_id ? $variation_id : $product_id;
        $product = wc_get_product($product_id);
        if(wopb_pro_function()->is_partial_payment($product) &&  isset($_POST['_wopb_deposit_option']) && $_POST['_wopb_deposit_option'] == 'partial'){
            if($_POST['_wopb_partial_amount']){
                $cart_item_data[ 'wopb_deposit_option' ] = isset($_POST['_wopb_deposit_option'])?sanitize_text_field($_POST['_wopb_deposit_option']):'';
            }
        }
        return $cart_item_data;
    }

    /**
     * Add To Cart Validation
     *
     * @return BOOLEAN
     * @since v.1.0.8
     */
    public function add_to_cart_validation( $passed, $product_id, $quantity, $variation_id = '',  $variations = null) {
        $product = wc_get_product($variation_id ? $variation_id : $product_id);
        if ( !WC()->cart->is_empty() && $this->cart_have_deposit_item() && !wopb_pro_function()->is_partial_payment($product) ) {
             wc_add_notice( __( 'We detect that in your cart already has deposit item. Please remove them before being able to add this product', 'product-blocks-pro' ), 'error' );
            $passed = false;
            return $passed;
        }
        if ( !WC()->cart->is_empty() && !$this->cart_have_deposit_item() && wopb_pro_function()->is_partial_payment($product) ) {
             wc_add_notice( __( 'We detect that in your cart already has regular item. Please remove them before being able to add this product', 'product-blocks-pro' ), 'error' );
            $passed = false;
            return $passed;
        }
        return $passed;
    }

    /**
     * Show Partial Payment Label in Cart
     *
     * @return HTML
     * @since v.1.0.8
     */
    public function cart_item_name($name, $cart_item, $cart_item_key) {
        $product = $cart_item['data'];
        if ($cart_item['variation_id']) {
            $product = wc_get_product($cart_item['variation_id']);
        }
        if ($product->get_meta('_wopb_partial_payment_enable') && isset($cart_item['wopb_deposit_option'])) {
            $html = '<div class="wopb-partial-payment-badge"> ' . wopb_function()->get_setting('partial_payment_label_text') . '</div>';
            if($product->get_meta('_wopb_partial_amount')){
                $html .= '<div class="wopb-order-deposit-payment">';
                    $html .= '<span>'.wopb_function()->get_setting('deposit_amount_text').': </span>'. wc_price($this->get_partial_first_payment($product) * $cart_item['quantity']);
                $html .= '</div>';
                $html .= '<div class="wopb-order-due-payment">';
                    $html .= '<span>'.wopb_function()->get_setting('due_payment_text').': </span>'. wc_price($this->get_partial_due_payment($product) * $cart_item['quantity']);
                $html .= '</div>';
            }
            return $name . $html;

        }
        return $name;
    }

    /**
     * Show Partial Payment Subtotal
     *
     * @param $subtotal
     * @param $cart_item
     * @param $cart_item_key
     * @return string
     * @since v.2.0.1
     */
    public function cart_item_subtotal( $subtotal, $cart_item, $cart_item_key ) {
        $product = $cart_item['data'];
        if (
            $product->get_meta('_wopb_partial_payment_enable') === 'yes' &&
            $product->get_meta('_wopb_partial_amount') &&
            ! empty( $cart_item['quantity'] )
        ) {
            $subtotal = wc_price( $product->get_meta('_wopb_partial_amount') * $cart_item['quantity'] );
        }

        return $subtotal;
    }

    /**
     * Show Partial Deposit After Cart Total
     *
     * @return HTML
     * @since v.1.0.8
     */
    public function cart_totals_after_order_total(){
        $deposit_calculate = $this->get_cart_deposit_total();

        if ( array_filter( $deposit_calculate['cart_deposit_items'] ) ) {
            $html = "<tr>";
                $html .= "<th>".wopb_function()->get_setting('deposit_to_pay_text')."</th>";
                $html .= "<td>".wc_price($deposit_calculate['total_deposit'])."</td>";
            $html .= "</tr>";

            $html .= "<tr>";
                $html .= "<th>".wopb_function()->get_setting('due_payment_text')."</th>";
                $html .= "<td>".wc_price($deposit_calculate['total_due'])."</td>";
            $html .= "</tr>";

            echo $html; //phpcs:ignore
        }
    }

    /**
     * Add Meta When Checkout Order for Partial Payment
     *
     * @return NULL
     * @since v.1.0.8
     */
    public function checkout_create_order_line_item(WC_Order_Item_Product $item, $cart_item_key, $values, $order) {
        $cart_item = WC()->cart->get_cart()[$cart_item_key];
        $product_id = $cart_item['variation_id'] ? $cart_item['variation_id'] : $item['product_id'];
        $product = wc_get_product($product_id);
        if (isset($cart_item['wopb_deposit_option']) && $product->get_meta('_wopb_partial_payment_enable')) {
            $item->update_meta_data('wopb_partial_payment_item', 'yes');
            $item->update_meta_data('wopb_partial_item_deposit_amount', $this->get_partial_first_payment($product) * $cart_item['quantity']);
            $item->update_meta_data('wopb_partial_item_due_amount', $this->get_partial_due_payment($product) * $cart_item['quantity']);
        }
    }

    /**
     * Payment Gateway Check for Disable
     *
     * @return ARRAY
     * @since v.1.0.8
     */
    public function available_payment_gateways( $availableGateways ) {
        if ( is_admin() || !is_checkout() ) {
            return $availableGateways;
        }

        if ( $this->cart_have_deposit_item() ) {
            if(wopb_function()->get_setting('disable_payment_method')) {
                foreach (wopb_function()->get_setting('disable_payment_method') as $key => $gateway ) {
                    unset( $availableGateways[$gateway] );
                }
            }

        }
        return $availableGateways;
    }

    /**
     * Add Order Meta for Partial Payment
     *
     * @return NULL
     * @since v.1.0.8
     */
    public function checkout_update_order_meta( $orderId, $data ) {
        $order = wc_get_order( $orderId );
        $deposit_calculate = $this->get_cart_deposit_total();

        if(array_filter($deposit_calculate['cart_deposit_items'])){
            $order->update_meta_data( 'wopb_total_deposit', $deposit_calculate['total_deposit'], true );
            $order->update_meta_data( 'wopb_total_due', $deposit_calculate['total_due'], true );
        }
        $order->save();
    }

    public function partial_payment_in_cart(){
        $status = false;
        if ( WC()->cart ) {
            foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
                $product = $cart_item['data'];
                if (
                    $product->get_meta('_wopb_partial_payment_enable') === 'yes' &&
                    $product->get_meta('_wopb_partial_amount') &&
                    ! empty( $cart_item['quantity'] )
                ) {
                    $status = true;
                    break;
                }
            }
        }
        return $status;
    }

    public function create_order( $order_id, $checkout ) {
        if ( ! $this->partial_payment_in_cart() ) {
            return null;
        }
        $data = $checkout->get_posted_data();
        try {
            $order_id           = absint( WC()->session->get( 'order_awaiting_payment' ) );
            $cart_hash          = WC()->cart->get_cart_hash();
            $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
            $order              = $order_id ? wc_get_order( $order_id ) : null;

            /**
             * If there is an order pending payment, we can resume it here so
             * long as it has not changed. If the order has changed, i.e.
             * different items or cost, create a new order. We use a hash to
             * detect changes which is based on cart items + order total.
             */
            if ( $order && $order->has_cart_hash( $cart_hash ) && $order->has_status( array( 'pending', 'failed' ) ) ) {
                /**
                 * Indicates that we are resuming checkout for an existing order (which is pending payment, and which
                 * has not changed since it was added to the current shopping session).
                 *
                 * @since 3.0.0 or earlier
                 *
                 * @param int $order_id The ID of the order being resumed.
                 */
                do_action( 'woocommerce_resume_order', $order_id );

                // Remove all items - we will re-add them later.
                $order->remove_order_items();
            } else {
                $order = new \WC_Order();
            }

            $fields_prefix = array(
                'shipping' => true,
                'billing'  => true,
            );

            $shipping_fields = array(
                'shipping_method' => true,
                'shipping_total'  => true,
                'shipping_tax'    => true,
            );
            foreach ( $data as $key => $value ) {
                if ( is_callable( array( $order, "set_{$key}" ) ) ) {
                    $order->{"set_{$key}"}( $value );
                    // Store custom fields prefixed with wither shipping_ or billing_. This is for backwards compatibility with 2.6.x.
                } elseif ( isset( $fields_prefix[ current( explode( '_', $key ) ) ] ) ) {
                    if ( ! isset( $shipping_fields[ $key ] ) ) {
                        $order->update_meta_data( '_' . $key, $value );
                    }
                }
            }

            if ( isset( $data['billing_email'] ) ) {
                $order->hold_applied_coupons( $data['billing_email'] );
            }

            $order->set_created_via( 'checkout' );
            $order->set_cart_hash( $cart_hash );
            /**
             * This action is documented in woocommerce/includes/class-wc-checkout.php
             *
             * @since 3.0.0 or earlier
             */
            $order->set_customer_id( apply_filters( 'woocommerce_checkout_customer_id', get_current_user_id() ) );
            $order->set_currency( get_woocommerce_currency() );
            $order->set_prices_include_tax( 'yes' === get_option( 'woocommerce_prices_include_tax' ) );
            $order->set_customer_ip_address( \WC_Geolocation::get_ip_address() );
            $order->set_customer_user_agent( wc_get_user_agent() );
            $order->set_customer_note( isset( $data['order_comments'] ) ? $data['order_comments'] : '' );
            $order->set_payment_method( isset( $available_gateways[ $data['payment_method'] ] ) ? $available_gateways[ $data['payment_method'] ] : $data['payment_method'] );
            $checkout->set_data_from_cart( $order );

            $partial_total = 0;
            foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
                $product = $cart_item['data'];
                if (
                    $product->get_meta('_wopb_partial_payment_enable') === 'yes' &&
                    $product->get_meta('_wopb_partial_amount') &&
                    ! empty( $cart_item['quantity'] )
                ) {
                    $partial_total = $partial_total + (  $product->get_meta('_wopb_partial_amount') * $cart_item['quantity'] );
                }

            }

            if( $partial_total ) {
                $order->set_total( $partial_total );
            }

            /**
             * Action hook to adjust order before save.
             *
             * @since 3.0.0
             */
            do_action( 'woocommerce_checkout_create_order', $order, $data );

            // Save the order.
            $order_id = $order->save();

            /**
             * Action hook fired after an order is created used to add custom meta to the order.
             *
             * @since 3.0.0
             */
            do_action( 'woocommerce_checkout_update_order_meta', $order_id, $data );

            /**
             * Action hook fired after an order is created.
             *
             * @since 4.3.0
             */
            do_action( 'woocommerce_checkout_order_created', $order );

            return $order_id;
        } catch ( \Exception $e ) {
            if ( $order && $order instanceof \WC_Order ) {
                $order->get_data_store()->release_held_coupons( $order );
                /**
                 * Action hook fired when an order is discarded due to Exception.
                 *
                 * @since 4.3.0
                 */
                do_action( 'woocommerce_checkout_order_exception', $order );
            }
            return new \WP_Error( 'checkout-error', $e->getMessage() );
        }
    }

    /**
     * Change Order Status if Deposit Amount
     *
     * @return NULL
     * @since v.1.0.8
     */
    public function change_order_status( $order_id ){
        if( ! $order_id ) return;
        $order = wc_get_order( $order_id );
        $total_deposit_paid = $order->get_meta('wopb_total_deposit');
        if(!empty($total_deposit_paid)){
            $order->update_status( 'wc-processing' );
        }
    }

    /**
     * Create Deposit Order for Partial Payment
     *
     * @return NULL
     * @since v.1.0.8
     */
    private function create_deposit_order( $order ) {
        $order_id = $order->get_id();
        $total_deposit = $order->get_meta('wopb_total_deposit');
        if($total_deposit){
            $offline_payment_method_ids = ['bacs', 'cheque', 'cod'];
            $first_deposit_order_status = 'completed';
            if( in_array($order->get_payment_method(), $offline_payment_method_ids)){
                $first_deposit_order_status = 'wc-processing';
            }

            $order_total = $order->get_total();
            // Fee items
            $item = new \WC_Order_Item_Fee();
            $item->set_name( wopb_function()->get_setting('due_payment_text').' for #' . $order->get_id());
            $item->set_total( $order_total - $total_deposit );
            $item->set_total_tax( 0 );
            $item->save();

            // Create Deposit Due Order
            $due_order = new DepositOrder();
            $due_order->set_customer_id( $order->get_user_id() );
            $due_order->set_parent_id( $order->get_id() );
            $due_order->add_item( $item );
            $due_order->calculate_totals( apply_filters( 'wopb_calculate_tax_totals', false ) );
            $due_order->update_meta_data( 'wopb_deposit_id', $due_order->get_id(), true );
            $due_order->set_status( 'pending' );
            $due_order->save();

            // Fee items
            $item = new \WC_Order_Item_Fee();
            $item->set_name( wopb_function()->get_setting('deposit_amount_text').' for #' . $order->get_id() );
            $item->set_total( $total_deposit );
            $item->set_total_tax( 0 );
            $item->save();

            // Create New Deposit Paid Order
            $deposit_order = new DepositOrder();
            $deposit_order->set_customer_id( $order->get_user_id() );
            $deposit_order->set_payment_method( $order->get_payment_method() );
            $deposit_order->set_parent_id( $order->get_id() );
            $deposit_order->add_item( $item );
            $deposit_order->calculate_totals(apply_filters( 'wopb_calculate_tax_totals', false ));
            $deposit_order->update_meta_data( 'wopb_deposit_id', $deposit_order->get_id(), true );
            $deposit_order->set_status( $first_deposit_order_status );
            $deposit_order->save();

            $due_ammount = $order->get_total() - $order->get_meta('wopb_total_deposit');
            update_post_meta( $order_id, 'wopb_total_due', $due_ammount );
            $order->update_meta_data( 'wopb_create_deposit_order', '1', true );
        }
    }

    /**
     * Partial Payment Label Add to Order Item
     *
     * @return ARRAY
     * @since v.1.0.8
     */
    public function order_item_get_formatted_meta_data($formatted_meta, $item) {
        add_filter( 'woocommerce_display_item_meta', function ($html, $item) {
            $html = str_replace( '<ul class="wc-item-meta">', '<ul class="wc-item-meta wopb-partial-item-meta">', $html );

            return $html;
        }, 10, 2 );

        foreach ($formatted_meta as $key => $meta) {
            if ($meta->key == 'wopb_partial_payment_item') {
                $meta->display_key = '<span class="wopb-partial-payment-badge">' . wopb_function()->get_setting('partial_payment_label_text') . '</span>';
            }
            if ($meta->key == 'wopb_partial_item_deposit_amount') {
                $meta->display_value = wc_price($meta->value);
                $meta->display_key = '<span>'.wopb_function()->get_setting('deposit_amount_text').' </span>';
            }
            if ($meta->key == 'wopb_partial_item_due_amount') {
                $meta->display_value = wc_price($meta->value);
                $meta->display_key = '<span>'.wopb_function()->get_setting('due_payment_text').' </span>';
            }
        }
        return $formatted_meta;
    }

    /**
     * Show Partial Paid And Due Row After Order Total
     *
     * @return ARRAY
     * @since v.1.0.8
     */
    public function get_order_item_totals( $total_rows, $order ) {
        remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );
        $total_deposit_paid = $order->get_meta('wopb_total_deposit');
        $total_deposit_due = $order->get_meta('wopb_total_due');
        if($total_deposit_paid || $total_deposit_due){
            $total_rows['total_deposit_paid'] = array(
                'label' => __( wopb_function()->get_setting('deposit_paid_text').':', 'product-blocks-pro' ),
                'value' => wc_price($total_deposit_paid),
            );
            $total_rows['total_deposit_due'] = array(
                'label' => __( wopb_function()->get_setting('due_payment_text').':', 'product-blocks-pro' ),
                'value' => wc_price($total_deposit_due),
            );
        }
        return $total_rows;
    }

    /**
     * Some Payment Method Order Status
     *
     * @return STRING
     * @since v.1.0.8
     */
    public function payment_order_status( $status, $order ) {
        $order_id = $order->get_id();
        if ( $order->get_meta('wopb_total_deposit') ) {

            $due_ammount = $order->get_total() - $order->get_meta('wopb_total_deposit');
            update_post_meta( $order_id, 'wopb_total_due', $due_ammount );
            $order->save();

            $order->calculate_shipping();
            $order->calculate_totals();
        }

        if ( $order->get_meta('wopb_total_deposit') && $order->get_meta('wopb_create_deposit_order') != 1 ) {
            // create deposit orders based on parent order
            $this->create_deposit_order( $order );
        }
        return $status;
    }

    /**
     * Some Different Payment Method Order Status
     *
     * @return STRING
     * @since v.1.0.8
     */
    public function payment_complete_order_status( $status, $orderId, $order ) {
        $total_deposit = $order->get_meta('wopb_total_deposit');
        if ( $total_deposit ) {
            $due_ammount = $order->get_total() - $total_deposit;
            update_post_meta( $orderId, 'wopb_total_due', $due_ammount );
            $order->save();

            $order->calculate_shipping();
            $order->calculate_totals();
        }

        if ( $total_deposit && $order->get_meta('wopb_create_deposit_order') != 1 ) {
            // create deposit orders based on parent order
            $this->create_deposit_order( $order );
        }
        return $status;
    }

    /**
     * Inserting "Order Type" Column Before Last Elements
     *
     * @return ARRAY
     * @since v.1.0.8
     */
    public function add_column_in_order_listing_page($columns) {
        $reordered_columns = [];
        foreach ($columns as $key => $column) {
            $reordered_columns[$key] = $column;
            if ($key == 'order_status') {
                $reordered_columns['wopb_order_page_order_type'] = __('Order Type', 'product-blocks-pro');
            }
        }
        return $reordered_columns;
    }

    /**
     * Show Partial Payment Label to Order Table Column
     *
     * @return HTML
     * @since v.1.0.8
     */
    public function set_order_type_column_value($column) {
        global $the_order;
        if ($column == 'wopb_order_page_order_type') {
            $has_item = false;
            $items = $the_order->get_items();
            foreach ($the_order->get_items() as $item) {
                if ($item->get_meta('wopb_partial_payment_item') == 'yes') {
                    $has_item = true;
                }
            }
            if ($has_item) {
                echo '<span class="wopb-partial-payment-badge">'. esc_html( wopb_function()->get_setting('partial_payment_label_text')).'</span>';
            }
        }
    }

    /**
     * Partial Payment First Payment
     *
     * @return NUMBER
     * @since v.1.0.8
     */
    public function get_partial_first_payment($product) {
        $price = '';
        if($product->get_meta('_wopb_partial_payment_deposit_type') == 'percentage'){
            $price = ($product->get_price() * $product->get_meta('_wopb_partial_amount') / 100);
        }elseif ($product->get_meta('_wopb_partial_payment_deposit_type') == 'fixed') {
            $price = $product->get_meta('_wopb_partial_amount');
        }

        return round($price);
    }

    /**
     * Partial Payment Future Payment
     *
     * @return NUMBER
     * @since v.1.0.8
     */
    public function get_partial_due_payment($product) {
        if($product->get_meta('_wopb_partial_payment_deposit_type') == 'percentage'){
            $deposit_amount = ($product->get_price() * $product->get_meta('_wopb_partial_amount') / 100);
        }elseif ($product->get_meta('_wopb_partial_payment_deposit_type') == 'fixed') {
            $deposit_amount = $product->get_meta('_wopb_partial_amount');
        }

        $due_amount = $product->get_price() - round($deposit_amount);
        return round($due_amount);
    }

    /**
     * Check Deposit Item Exist in Cart
     *
     * @return BOOLEAN
     * @since v.1.0.8
     */
    public function cart_have_deposit_item() {
        $deposit_calculate = $this->get_cart_deposit_total();

        if ( array_filter( $deposit_calculate['cart_deposit_items'] ) ) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Get Cart Deposit Total
     *
     * @return ARRAY
     * @since v.1.0.8
     */
    public function get_cart_deposit_total(){
        $cart_deposit_items = [];
        $total_deposit = 0;
        $total_due = 0;
        foreach ( WC()->cart->get_cart() as $cart_item ) {
            $product_id  = ( $cart_item['variation_id'] ) ? $cart_item['variation_id'] : $cart_item['product_id'];
            $product = wc_get_product($product_id);
            if(wopb_pro_function()->is_partial_payment($product) && isset( $cart_item['wopb_deposit_option'] )){
                $cart_deposit_items[] = $cart_item['wopb_deposit_option'];
                $total_deposit += $this->get_partial_first_payment($product) * $cart_item['quantity'];
            }
        }

        $data = [
                'cart_deposit_items' => $cart_deposit_items,
                'total_deposit' => $total_deposit,
                'total_due' => WC()->cart->get_total( 'f' ) - $total_deposit,
            ];
        return $data;
    }

    /**
     * Deposit Payment Order Table Column in Admin Side
     *
     * @return ARRAY
     * @since v.1.0.8
     */
    public function wopb_deposit_order_posts_columns( $columns ) {
        unset( $columns['title'] );
        unset( $columns['date'] );
        $columns['wopb_deposit']        = __( 'Deposit Order', 'product-blocks-pro' );
        $columns['wopb_deposit_date']   = __( 'Date', 'product-blocks-pro' );
        $columns['wopb_deposit_status'] = __( 'Status', 'product-blocks-pro' );
        $columns['wopb_deposit_total']          = __( 'Total', 'product-blocks-pro' );
        $columns['wopb_deposit_parent_order']   = __( 'Parent Order', 'product-blocks-pro' );

        return $columns;
    }

    /**
     * Deposit Payment Order Table Column Data in Admin Side
     *
     * @return ARRAY
     * @since v.1.0.8
     */
    public function wopb_deposit_order_posts_custom_column( $column, $post_id ) {
        $deposit_order = new DepositOrder( $post_id );

        switch ( $column ) {
            case 'wopb_deposit':
                echo '<a href="' . esc_url( admin_url( 'post.php?post=' . $post_id ) . '&action=edit' ) . '" class="order-view"><strong>#' . esc_html(get_post_meta( $post_id, 'wopb_deposit_id', true )) . '</strong></a>';
                break;

            case 'wopb_deposit_date':
                if ( get_post_meta( $deposit_order->get_id(), 'wopb_create_from_shop_order', true ) == 1 ) {
                    echo get_the_date( 'F j Y' );
                    return;
                }

                $deposit_date_human_readable = ( $deposit_order->get_date_paid() ) ? human_time_diff( $deposit_order->get_date_paid()->date( 'U' ), current_time( 'U' ) ) : human_time_diff( get_the_date( 'U' ), current_time( 'U' ) );
                $deposit_date = ( $deposit_order->get_date_paid() ) ? $deposit_order->get_date_paid()->date( 'U' ) : get_the_date( 'U' );
                if ( $deposit_date > current_time( 'U' ) - 86400 ) {
                    echo esc_html( $deposit_date_human_readable );
                } else {
                    echo ( $deposit_order->get_date_paid() ) ? $deposit_order->get_date_paid()->date( 'F j Y' ) : get_the_date( 'F j Y' ); //phpcs:ignore
                }
                break;

            case 'wopb_deposit_status':
                $deposit_status = $deposit_order->get_status(); // order status
                echo sprintf( '<mark class="order-status %s tips"><span>%s</span></mark>', esc_attr( sanitize_html_class( 'status-' . $deposit_status ) ), wc_get_order_status_name( $deposit_status ) );
                break;

            case 'wopb_deposit_total':
                echo wc_price( $deposit_order->get_total() );
                break;

            case 'wopb_deposit_parent_order':
                $parent_id = $deposit_order->get_parent_id(); // order parent
                echo '<a href="' . esc_url( admin_url( 'post.php?post=' . $parent_id ) . '&action=edit' ) . '" class="order-view">#' . esc_html($parent_id) . '</a>';
                break;
        }
    }

    /**
     * Show All Deposit Order for All Tab
     *
     * @return NULL
     * @since v.1.0.8
     */
    public function show_all_deposit_orders( $query ) {
        if ( is_admin() && $query->is_main_query() && $query->get( 'post_type' ) == "wopb_deposit_order" ) {
            if ( !isset( $_GET['post_status'] ) ) {
                $query->set( 'post_status', 'any' );
            }
        }
    }

    /**
     * Parent Order Status Change When Deposit Status Completed
     *
     * @return NULL
     * @since v.1.0.8
     */
    public function deposit_order_status_completed( $orderId ) {
        $order = wc_get_order($orderId);
        if ( $order->get_type() == 'wopb_deposit_order' ) {
            $deposit_order  = new DepositOrder( $orderId );
            $parent_id      = $deposit_order->get_parent_id();
            $completed_args = array(
                'post_parent' => $parent_id,
                'post_type'   => 'wopb_deposit_order',
                'post_status' => 'wc-completed',
            );

            $args = array(
                'post_parent' => $parent_id,
                'post_type'   => 'wopb_deposit_order',
            );

            if ( count( get_children( $completed_args ) ) == count( get_children( $args ) ) ) {
                $parent_order = wc_get_order( $parent_id );
                $parent_order->update_status( wopb_function()->get_setting('deposit_paid_status') );
                $parent_order->update_meta_data( 'wopb_total_due', 0 );
                $parent_order->save();
            }
        }
        return;
    }

    /**
     * Deposit Order Table in Customer Side
     *
     * @return HTML
     * @since v.1.0.8
     */
    public function deposit_order_details( $order ) {
        $total_deposit_paid = $order->get_meta('wopb_total_deposit');
        if ( empty($total_deposit_paid) || !$order) {
            return;
        }

        $deposit_order_list = wc_get_orders( array(
            'parent' => $order->get_id(),
            'post_type' => 'wopb_deposit_order',
        ) );;
        ?>
        <h4><strong><?php esc_html_e( wopb_function()->get_setting('partial_payment_label_text').' Details', 'product-blocks-pro' )?></strong></h4>
        <table class="woocommerce-table  wopb_deposit_order_details">
            <thead>
                <tr>
                    <th><?php esc_html_e( 'Payment', 'product-blocks-pro' )?></th>
                    <th><?php esc_html_e( 'Payment ID', 'product-blocks-pro' )?></th>
                    <th><?php esc_html_e( 'Status', 'product-blocks-pro' )?></th>
                    <th><?php esc_html_e( 'Amount', 'product-blocks-pro' )?></th>
                    <th><?php esc_html_e( 'Action', 'product-blocks-pro' )?></th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach ( $deposit_order_list as $deposit ) {
                        $deposit_order = new DepositOrder( $deposit->get_id() );
                        $deposit_status = $deposit_order->get_status();
                        if ( $deposit_status == 'pending' ) {
                            $payment_status = wopb_function()->get_setting('due_payment_text');
                        } else {
                            $payment_status = wopb_function()->get_setting('deposit_amount_text');
                        }
                ?>
                    <tr>
                        <td><?php echo esc_html($payment_status); ?></td>
                        <td>#<?php echo esc_html( $deposit_order->get_id() ); ?></td>
                        <td>
                            <?php
                                echo wc_get_order_status_name( $deposit_status );
                            ?>
                        </td>
                        <td><?php echo wc_price($deposit_order->get_total()); ?></td>
                        <td>
                            <?php
                                if ( $deposit_status == 'pending' ) {
                                    $link = '<a href="' . esc_url( $deposit_order->get_checkout_payment_url() ) . '" class="woocommerce-button button wopb-deposit-payment"> ' . esc_html__( 'Make Payment', 'product-blocks-pro' ) . ' </a>';
                                    echo $link; //phpcs:ignore
                                }else{
                                    echo "-----";
                                }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
<?php
    }

    public function deposit_order_metabox() {
        if ( empty( get_post_meta( get_the_id(), 'wopb_total_deposit', true ) ) ) {
            return; // return if not deposit
        }

        add_meta_box( 'wopb-deposit-order', __( 'Deposit Payments', 'product-blocks-pro' ), [$this, 'depositOrderMarkupBox'], 'shop_order' );
    }

    public function depositOrderMarkupBox()
    {
        $args = array(
            'post_type' => 'wopb_deposit_order',
            'post_parent' => get_the_id(),
        );

        $deposit_order_list = get_children($args);
?>
        <table class="wp-list-table widefat fixed striped table-view-excerpt ">
        <thead>

            <tr>
            <th><?php esc_html_e( '#', 'product-blocks-pro' );?></th>
            <th><?php esc_html_e( 'Payment', 'product-blocks-pro' );?></th>
            <th><?php esc_html_e( 'Status', 'product-blocks-pro' );?></th>
            <th><?php esc_html_e( 'Total', 'product-blocks-pro' );?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ( $deposit_order_list as $deposit ) {
                    $deposit_order = new DepositOrder( $deposit->ID );
                    $deposit_status = $deposit_order->get_status();
                    if ( $deposit_status == 'completed' ) {
                        $payment_status = __( 'Deposit', 'product-blocks-pro' );
                    } else {
                        $payment_status = __( 'Due Payment', 'product-blocks-pro' );
                    } ?>
                    <tr>
                        <td>
                            <?php
                                echo '<a href="' . esc_url( admin_url( 'post.php?post=' . $deposit_order->get_id() ) . '&action=edit' ) . '" class="order-view">
                                        <strong>#' . $deposit_order->get_id() . '</strong>
                                       </a>';
                                ?>
                        </td>
                        <td><?php echo esc_html( $payment_status ); ?></td>
                        <td>
                            <?php
                                echo sprintf( '<mark class="order-status %s tips"><span>%s</span></mark>', esc_attr( sanitize_html_class( 'status-' . $deposit_status ) ), wc_get_order_status_name( $deposit_status ) ); //phpcs:ignore
                            ?>
                        </td>
                        <td><?php echo wc_price( $deposit_order->get_total() ); ?></td>
                    </tr>
            <?php } ?>
        </tbody>

<?php
    }

    public function due_amount_payment_complete ( $order_id, $old_status, $new_status, $order ) {
      if(
        $order->get_meta('wopb_deposit_id') &&
        $order->get_meta('wopb_deposit_id') == $order_id &&
        $order->get_type() != 'wopb_deposit_order'
      ) {
          global $wpdb;
          $wpdb->update(
              $wpdb->prefix . 'wc_orders',
              array( 'type' => 'wopb_deposit_order' ),
              array( 'id' => $order_id ),
              array( '%s' ),
              array( '%d' )
          );
      }
    }
}
?>