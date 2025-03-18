<?php
namespace WOPB_PRO;

defined( 'ABSPATH' ) || exit;

class License {
    private $server_url  = 'https://account.wpxpo.com';
    private $item_id     = 1263;
    private $name        = 'WowStore Pro - Gutenberg Product Blocks for WooCommerce';
    private $version     = WOPB_PRO_VER;
    private $slug        = 'product-blocks-pro/product-blocks-pro.php';

    public function __construct() {
        add_action( 'admin_init', array( $this, 'edd_license_updater' ) );
    }
    
    public function edd_license_updater() {

        if ( ! class_exists( 'EDD_SL_Plugin_Updater' ) ) {
            require_once WOPB_PRO_PATH . 'classes/updater/EDD_SL_Plugin_Updater.php';
        }

        $license_key = trim( get_option( 'edd_wopb_license_key' ) );

        $edd_updater = new \EDD_SL_Plugin_Updater(
            $this->server_url,
            $this->slug,
            array(
                'version' => $this->version,
                'license' => $license_key,
                'item_id' => $this->item_id,
                'author'  => $this->name,
                'url'     => home_url(),
                'beta'    => false
            )
        );
    }
}