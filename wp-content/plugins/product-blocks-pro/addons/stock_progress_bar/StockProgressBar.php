<?php
/**
 * Stock Progress Bar Addons Core.
 * 
 * @package WOPB_PRO\Stock Progress Bar
 * @since v.1.0.5
 */

namespace WOPB_PRO;

defined('ABSPATH') || exit;

/**
 * Stock Progress Bar class.
 */
class StockProgressBar {

    /**
	 * Setup class.
	 *
	 * @since v.1.0.5
	 */
    public function __construct(){
        add_action( 'wp_enqueue_scripts', array( $this, 'add_stock_progress_bar_scripts' ) );
        add_filter( 'woocommerce_get_stock_html', array( $this ,'wopb_woocommerce_get_stock_html' ), 10, 2 ); // show stock progress bar after in stock text in product details page
        add_action( 'wopb_save_settings', array( $this, 'generate_css' ), 10, 1 ); // CSS Generator
    }

    /**
	 * Stock Progress Bar JS Script Add
     * 
     * @since v.1.0.5
	 * @return NULL
	 */
    public function add_stock_progress_bar_scripts() {
        wp_enqueue_style( 'wopb-stock-progress-bar-style', WOPB_PRO_URL.'addons/stock_progress_bar/css/stock_progress_bar.css', array(), WOPB_PRO_VER );
        wp_enqueue_script( 'wopb-stock-progress-bar', WOPB_PRO_URL.'addons/stock_progress_bar/js/stock_progress_bar.js', array('jquery'), WOPB_PRO_VER, true );
    }

    /**
	 * Stock Progress Bar Addons Initial Setup Action
     * 
     * @since v.1.0.5
	 * @return NULL
	 */
    public function initial_setup() {
        $settings = wopb_function()->get_setting();
        // Set Default Value
        $initial_data = array(
            'stock_progress_bar_heading' => 'yes',
            'total_sell_count_text'      => 'Total Sold',
            'available_item_count_text'  => 'Available Item',

            'stock_progress_label_typo'  => array(
                'size' => 16,
                'bold' => false,
                'italic' => false,
                'underline' => false,
                'color' => '#656565',
                'hover_color' => '',
            ),
            'stock_progress_count_typo'  => array(
                'size' => 16,
                'bold' => true,
                'italic' => false,
                'underline' => false,
                'color' => '#000000',
                'hover_color' => '',
            ),
            'stock_progress_bg'  => array(
                'bg' => '#e2e2e2',
                'hover_bg' => '',
            ),
            'stock_progress_active_bg'  => array(
                'bg' => '#25b064',
                'hover_bg' => '',
            ),
        );
        foreach ($initial_data as $key => $val) {
            if ( ! isset( $settings[$key] ) ) {
                wopb_function()->set_setting($key, $val);
            }
        }
        $this->generate_css('wopb_stock_progress_bar');
    }

    public function wopb_woocommerce_get_stock_html( $html, $product ) {
        if ( is_product() ) {
            if ( $product->managing_stock() ) {
                $product_id = $product->get_id();
                $parent_id = $product->get_parent_id();
                $total_order_count = $parent_id ? $this->total_order_count( $parent_id, $product_id ) : $this->total_order_count( $product_id );
                $available_stock = $product->get_stock_quantity();
                $total_stock_count = ( $total_order_count ? $total_order_count : 0 ) + ( $available_stock ? $available_stock : 0 );
                $progress_bar_active_limit = $total_order_count ? round( ( $total_order_count * 100 ) / $total_stock_count ) : 0;
    
                if ( $available_stock >= 0 ){
                    $html .= '<div class="wopb-stock-progress-bar-section">';
                        $html .= '<div class="wopb-stock-progress-title">';
                            $html .= '<div>';
                                $html .= '<span class="wopb-stock-progress-label">' . wopb_function()->get_setting( 'total_sell_count_text' ) . ': </span>';
                                $html .= '<span class="wopb-stock-progress-count">' . $total_order_count . '</span>';
                            $html .= '</div>';

                            $html .= '<div>';
                                $html .= '<span class="wopb-stock-progress-label">' . wopb_function()->get_setting( 'available_item_count_text' ) . ': </span>';
                                $html .= '<span class="wopb-stock-progress-count">' . $available_stock . '</span>';
                            $html .= '</div>';
                        $html .= '</div>';
                        $html .= '<div class="wopb-stock-progress-bar">';
                            $html .= '<div class="wopb-stock-progress" data-order-progress="' . $progress_bar_active_limit . '"></div>';
                        $html .= '</div>';
                    $html .= '</div>';
                }
            }
        }
        return $html;
    }

    public function total_order_count( $product_id, $variation_id = null ) {
        global $wpdb;
        $variation_statement = $variation_id ? " AND order_product.variation_id = ".intval($variation_id) : "";
        $result = $wpdb->get_results("
            SELECT sum(order_product.product_qty) as total_order_count
            FROM {$wpdb->prefix}wc_order_product_lookup as order_product
            INNER JOIN {$wpdb->prefix}wc_order_stats AS order_stat
                ON order_product.order_id = order_stat.order_id
            WHERE order_product.product_id = {$product_id} {$variation_statement}
                AND order_stat.status NOT IN ('wc-cancelled', 'wc-refunded')
        ");

        return $result[0]->total_order_count ?? 0;
    }

    /**
     * Dynamic CSS
     *
     * @param $key
     * @return void
     * @since v.4.0.0
     */
    public function generate_css( $key ) {
        if ( $key == 'wopb_stock_progress_bar' && method_exists(wopb_function(), 'convert_css') ) {
            $settings = wopb_function()->get_setting();

            $css = '.wopb-stock-progress-label{';
                $css .= wopb_function()->convert_css('general', $settings['stock_progress_label_typo']);
            $css .= '}';
            $css .= '.wopb-stock-progress-label:hover{';
                $css .= wopb_function()->convert_css('hover', $settings['stock_progress_label_typo']);
            $css .= '}';

            $css .= '.wopb-stock-progress-count{';
                $css .= wopb_function()->convert_css('general', $settings['stock_progress_count_typo']);
            $css .= '}';
            $css .= '.wopb-stock-progress-count:hover{';
                $css .= wopb_function()->convert_css('hover', $settings['stock_progress_count_typo']);
            $css .= '}';

            $css .= '.wopb-stock-progress-bar{';
                $css .= 'background-color: ' . ( ! empty( $settings['stock_progress_bg']['bg'] ) ? $settings['stock_progress_bg']['bg'] : '#e2e2e2' ) . ';';
            $css .= '}';
            $css .= '.wopb-stock-progress-bar:hover{';
                $css .= isset( $settings['stock_progress_bg']['hover_bg'] ) ? ( 'background-color: ' . $settings['stock_progress_bg']['hover_bg'] . ';' ) : '';
            $css .= '}';
            $css .= '.wopb-stock-progress-bar .wopb-stock-progress{';
                $css .= 'background-color: ' . ( ! empty( $settings['stock_progress_active_bg']['bg'] ) ? $settings['stock_progress_active_bg']['bg'] : '#25b064' ) . ';';
            $css .= '}';
            $css .= '.wopb-stock-progress-bar .wopb-stock-progress:hover{';
                $css .= isset( $settings['stock_progress_active_bg']['hover_bg'] ) ? ( 'background-color: ' . $settings['stock_progress_active_bg']['hover_bg'] . ';' ) : '';
            $css .= '}';

            wopb_function()->update_css( $key, 'add', $css );
        }
    }
}