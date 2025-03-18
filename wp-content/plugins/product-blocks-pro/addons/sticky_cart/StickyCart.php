<?php
/**
 * Sticky Add to Cart Addons Core.
 *
 * @package WOPB\StickyCart
 * @since v.3.2.0
 */

namespace WOPB_PRO;

defined('ABSPATH') || exit;

/**
 * StickyCart class.
 */
class StickyCart {

    /**
     * Setup class.
     *
     * @since v.3.2.0
     */
    public function __construct() {
        add_action( 'wp_footer', array( $this, 'sticky_cart_callback' ) );
        add_action( 'wopb_save_settings', array( $this, 'generate_css' ), 10, 1 ); // CSS Generator
    }

    /**
     * Sticky Add to Cart for Shop & Archive Page
     *
     * @return void
     * @since v.3.2.0
     */
    public function sticky_cart_callback() {
        global $woocommerce_loop;
        $woocommerce_loop['name'] = 'wopb_single_product_sticky_cart';
        if ( wopb_function()->get_setting( 'sticky_cart_mobile' ) == 'yes' && wp_is_mobile() ) {
            return;
        }
        
        if ( is_product() ) {
            global $product;
            if ( $product->is_in_stock() ) {
                $is_partial = wopb_pro_function()->is_partial_payment( $product );
                $cart_url = $product->add_to_cart_url();
                $product_type = wopb_function()->get_setting( 'sticky_cart_product_type' );
                if ( is_array( $product_type ) && !in_array( $product->get_type() , $product_type ) ) {
                    return;
                }
                $button_class = $product->is_type('simple') ? ' ajax_add_to_cart' : '';
                if( $product->is_type('variable') || $product->is_type('grouped') || $is_partial ) {
                    $button_class .= ' wopb-sticky-slide-up';
                }

                $style = '';
                $cart_position = wopb_function()->get_setting( 'sticky_cart_position' );
                if ( is_admin_bar_showing() && $cart_position == 'top' ) {
                    $style .= 'top: 32px;';
                } else {
                    $style .= $cart_position == 'top' ? 'top: 0;' : 'bottom: 0;';
                }
                if( $is_partial ) {
                    $cart_url = $product->get_permalink();
                }

                $output = '<div class="wopb-sticky-cart" data-scroll="' . wopb_function()->get_setting( 'sticky_cart_scroll' ) . '" style="' . $style .'">';
                    $output .= '<div class="wopb-sticky-cart-content">';
                        $output .= '<div class="wopb-sticky-content-left">';
                            $output .= '<div class="wopb-sticky-thumbnail">'. $product->get_image( 'thumbnail' ) . '</div>';
                            $output .= '<div class="wopb-product-details">';
                                $output .= '<div class="wopb-sticky-title">';
                                    if ( wopb_function()->get_setting( 'sticky_cart_link' )  === 'yes' ) {
                                        $output .= '<a href="' . $product->get_permalink() . '">' . $product->get_title() . '</a>';
                                    } else {
                                        $output .= $product->get_title();
                                    }
                                $output .= '</div>';
                                $output .= '<div class="wopb-product-info">';
                                    $status = $product->get_stock_status();
                                    if( $status == 'instock' ) {
                                        $output .= '<span class="wopb-stock-status wopb-stock-in">' . __('In Stock', 'product-blocks-pro') . '</span>';
                                    }elseif( $status == 'outofstock' ) {
                                        $output .= '<span class="wopb-stock-status wopb-stock-out">' . __('Out Of Stock', 'product-blocks-pro') . '</span>';
                                    }elseif( $status == 'onbackorder' ) {
                                        $output .= '<span class="wopb-stock-status wopb-stock-backorder">' . __('On Backorder', 'product-blocks-pro') . '</span>';
                                    }
                                    if ( wopb_function()->get_setting( 'sticky_cart_review' ) === 'yes' ) {
                                        $rating_count = $product->get_rating_count();
                                        $output .= '<span class="wopb-separator"></span>';
                                        $output .= '<div class="wopb-sticky-review">';
                                            if ( 0 == $rating_count ) {
                                                $output  .= '<div class="star-rating">';
                                                    $output .= wc_get_star_rating_html( $product->get_average_rating(), $rating_count );
                                                $output .= '</div>';
                                            } else {
                                                $output .= wc_get_rating_html( $product->get_average_rating(), $rating_count );
                                            }
                                        $output .= '</div>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                        $output .= '<div class="wopb-sticky-content-right">';
                            $output .= '<div class="wopb-sticky-cart-price">' . $product->get_price_html() . '</div>';
                            if( $product->is_type('simple') && ! $is_partial ) {
                                $output .= '<input type="number" class="wopb-sticky-cart-qty" value="1" />';
                            }
                            $output .= '<div class="wopb-sticky-add-to-cart">';
                                $output .= '<a ';
                                    $output .= 'href="' . esc_url( $cart_url ) . '" ';
                                    $output .= $product->is_type('external') ? 'target="_blank" ' : '';
                                    $output .= 'class="add_to_cart_button button' . $button_class . '" ';
                                    $output .= 'data-quantity="1" data-product_id="' . $product->get_id() . '">';
                                    $output .= esc_attr( $product->add_to_cart_text() );
                                $output .= '</a>';
                            $output .= '</div>';
                        $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';

                echo $output;  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }
    }

    /**
	 * CSS Generator
     * 
     * @since v.3.2.0
	 * @return NULL
	 */
    public function generate_css( $key ) {
        if ( $key == 'wopb_sticky_cart' && method_exists(wopb_function(), 'convert_css') ) {
            $settings = wopb_function()->get_setting();
            $btn_style = array_merge($settings['sticky_cart_btn_typo'], $settings['sticky_cart_btn_bg'] );

            $css = '.wopb-sticky-cart {';
                $css .= isset( $settings['sticky_cart_bg']['bg'] ) ? 'background-color: ' . $settings['sticky_cart_bg']['bg'] . ';' : '';
                $css .= 'padding: ' . wopb_function()->convert_css('dimension', $settings['sticky_cart_padding']) . ';';
            $css .= '}';
            $css .= '.wopb-sticky-cart:hover {';
                $css .= isset( $settings['sticky_cart_bg']['hover_bg'] ) ? 'background-color: ' . $settings['sticky_cart_bg']['hover_bg'] . ';' : '';
            $css .= '}';
            $css .= '.wopb-sticky-cart-content{ max-width: ' . wopb_function()->get_setting( 'sticky_cart_width' ) . 'px; }';

            $css .= '.wopb-sticky-title a {';
                $css .= wopb_function()->convert_css('general', $settings['sticky_cart_title_typo']);
            $css .= '}';
            $css .= '.wopb-sticky-title a:hover {';
                $css .= wopb_function()->convert_css('hover', $settings['sticky_cart_title_typo']);
            $css .= '}';

            $css .= '.wopb-sticky-cart-content .wopb-stock-status {';
                $css .= wopb_function()->convert_css('general', $settings['sticky_cart_stock_typo']);
            $css .= '}';
            $css .= '.wopb-sticky-cart-content .wopb-stock-status:hover {';
                $css .= wopb_function()->convert_css('hover', $settings['sticky_cart_stock_typo']);
            $css .= '}';
            $css .= '.wopb-sticky-cart-content .wopb-separator {';
                $css .= isset( $settings['sticky_cart_separator_bg'] ) ? 'background-color: ' . $settings['sticky_cart_separator_bg'] . ';' : '';
            $css .= '}';
            $css .= 'body .wopb-sticky-review > .star-rating {';
                $css .= ! empty( $settings['sticky_cart_rating_typo']['size'] ) ? 'font-size: ' . $settings['sticky_cart_rating_typo']['size'] . 'px;' : '';
            $css .= '}';
            $css .= 'body .wopb-sticky-review > .star-rating:before {';
                $css .= !empty( $settings['sticky_cart_rating_typo']['color'] ) ? 'color: ' . $settings['sticky_cart_rating_typo']['color'] . ';' : '';
            $css .= '}';
            $css .= 'body .wopb-sticky-review > .star-rating:hover:before {';
                $css .= !empty( $settings['sticky_cart_rating_typo']['hover_color'] ) ? 'color: ' . $settings['sticky_cart_rating_typo']['hover_color'] . ';' : '';
            $css .= '}';
            $css .= 'body .wopb-sticky-review .star-rating span:before {';
                $css .= !empty( $settings['sticky_cart_rating_fill_color']['color'] ) ? 'color: ' . $settings['sticky_cart_rating_fill_color']['color'] . ';' : '';
            $css .= '}';
            $css .= 'body .wopb-sticky-review .star-rating:hover span:before {';
                $css .= !empty( $settings['sticky_cart_rating_fill_color']['hover_color'] ) ? 'color: ' . $settings['sticky_cart_rating_fill_color']['hover_color'] . ';' : '';
            $css .= '}';


            $css .= '.wopb-sticky-cart-price {';
                $css .= wopb_function()->convert_css('general', $settings['sticky_cart_price_typo']);
            $css .= '}';
            $css .= '.wopb-sticky-cart-price:hover {';
                $css .= wopb_function()->convert_css('hover', $settings['sticky_cart_price_typo']);
            $css .= '}';

            $css .= '.woocommerce .wopb-sticky-add-to-cart .add_to_cart_button, .woocommerce .wopb-sticky-add-to-cart .added_to_cart {';
                $css .= wopb_function()->convert_css('general',  $btn_style);
                $css .= 'padding: ' . wopb_function()->convert_css('dimension', $settings['sticky_cart_btn_padding']) . ' !important;';
                $css .= 'border: ' .
                    ( ! empty( $settings['sticky_cart_btn_border']['border'] )
                        ? $settings['sticky_cart_btn_border']['border']
                        : 0
                    ) . 'px solid ' .
                    ( ! empty( $settings['sticky_cart_btn_border']['color'] )
                        ? $settings['sticky_cart_btn_border']['color']
                        : ''
                    ) . ';';
                $css .= ! empty( $settings['sticky_cart_btn_radius'] ) ? 'border-radius: ' . $settings['sticky_cart_btn_radius'] . 'px;' : '';
                $css .= 'line-height: normal;';
            $css .= '}';
            $css .= '.woocommerce .wopb-sticky-add-to-cart .add_to_cart_button:hover, .woocommerce .wopb-sticky-add-to-cart .added_to_cart:hover {';
                $css .= wopb_function()->convert_css('hover', $btn_style);
            $css .= '}';

            wopb_function()->update_css( $key, 'add', $css );
        }
    }
}