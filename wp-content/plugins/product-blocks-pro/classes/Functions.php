<?php
namespace WOPB_PRO;

defined( 'ABSPATH' ) || exit;

class Functions {

    public function is_simple_preorder() {
        if ( wopb_function()->get_setting( 'wopb_preorder' ) == 'true' ) {
            global $product;
            $type = $product->get_type();
            if ( $type == 'simple' && !$this->is_preorder_closed( $product ) && $product->get_meta( '_wopb_preorder_simple' ) ) {
                return true;
            }
        }
        return false;
    }

    public function is_simple_backorder() {
        if ( wopb_function()->get_setting( 'wopb_backorder' ) == 'true' ) {
            global $product;
            $type = $product->get_type();
            if ( $type == 'simple' && ! $product->managing_stock() && $product->is_on_backorder() && ! $this->is_backorder_closed( $product ) ) {
                return  true;
            }
        }
        return false;
    }

    /**
     * Preorder Close Check
     *
     * @return BOOLEAN
     * @since v.2.1.9
     */
    public function is_preorder_closed( $product ) {
        $pre_order_date = $product->get_meta( '_wopb_preorder_date' );
        $duration = new \Datetime(date( 'Y-m-d h:i a', strtotime( $pre_order_date ) ));
        $current = new \Datetime(current_time( 'Y-m-d h:i a' ));
        if ( $pre_order_date && $current > $duration ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Backorder Close Check
     *
     * @return BOOLEAN
     * @since v.2.1.9
     */
    public function is_backorder_closed( $product ) {
        $backorder_available_duration = date( 'Y-m-d h:i a', strtotime( $product->get_meta( '_wopb_backorder_date' ) ) );
        if ( $product->get_meta( '_wopb_backorder_date' ) && current_time( 'Y-m-d h:i' ) > $backorder_available_duration ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check Product Partial Payment OR Not
     *
     * @return NUMBER
     * @since v.1.0.8
     */
    public function is_partial_payment( $product ) {
        if ( wopb_function()->get_setting( 'wopb_partial_payment' ) == 'true' && $product->get_meta( '_wopb_partial_payment_enable' ) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Activate WowStore Free Plugin
     *
     * @return NULL
     * @since v.1.3.11
     */
    public function wowstore_activate() {
        if ( ! file_exists( WP_PLUGIN_DIR . '/product-blocks/product-blocks.php' ) ) {
            if( ! function_exists( 'plugins_api' ) ) {
                include ABSPATH . 'wp-admin/includes/plugin-install.php';
            }
            if( ! class_exists('WP_Upgrader') ) {
                include ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
            }
            if ( ! class_exists( 'WP_Ajax_Upgrader_Skin' ) ) {
                include ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
            }
            if ( ! class_exists( 'Plugin_Upgrader' ) ) {
                include ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';
            }
            $plugin = 'product-blocks';
            $api = plugins_api( 'plugin_information', array(
                'slug' => $plugin,
                'fields' => array(
                    'short_description' => false,
                    'sections' => false,
                    'requires' => false,
                    'rating' => false,
                    'ratings' => false,
                    'downloaded' => false,
                    'last_updated' => false,
                    'added' => false,
                    'tags' => false,
                    'compatibility' => false,
                    'homepage' => false,
                    'donate_link' => false,
                ),
            ) );
            $title = sprintf( __( 'Installing Plugin: %s', 'product-blocks-pro' ), $api->name . ' ' . $api->version );
            $nonce = 'install-plugin_' . $plugin;
            $url = 'update.php?action=install-plugin&plugin=' . urlencode( $plugin );
            $upgrader = new \Plugin_Upgrader( new \WP_Ajax_Upgrader_Skin( compact( 'title', 'url', 'nonce', 'plugin', 'api' ) ) );
            $upgrader->install( $api->download_link );
            activate_plugin( 'product-blocks/product-blocks.php' );
        } else if ( file_exists( WP_PLUGIN_DIR . '/product-blocks/product-blocks.php' ) && ! is_plugin_active( 'product-blocks/product-blocks.php' ) ) {
            activate_plugin( 'product-blocks/product-blocks.php' );
        }
        
        wp_redirect( admin_url( 'admin.php?page=wopb-settings' ) );
        exit;
    }
}