<?php

require_once RTWPVGP_PATH . 'vendor/autoload.php';
 
use Rtwpvgp\Traits\SingletonTrait;
   
use Rtwpvgp\Controllers\Admin\AdminController; 
use Rtwpvgp\Controllers\HookFilter;
use Rtwpvgp\Controllers\HookAction;
use Rtwpvgp\Controllers\Licensing;

/**
 * Class Rtwpvgp
 */
final class Rtwpvgp {

    use SingletonTrait;  

    /**
     * Review Schema Constructor.
     */
    public function __construct() { 
        $this->define_constants();   

        $this->init_hooks(); 
    } 

    private function init_hooks() {
 
        add_action('plugins_loaded', [$this, 'on_plugins_loaded'], -1);
 
        add_action('init', [$this, 'init'], 1); 
    }

    public function init() {
        do_action('rtwpvgp_before_init');

        $this->load_plugin_textdomain();
        // Load your all dependency hooks
        new AdminController();   
        new HookFilter();   
        new HookAction();   
        Licensing::init(); 

        do_action('rtwpvgp_init');
    }

    public function on_plugins_loaded() {
        do_action('rtwpvgp_loaded');
    }

    /**
     * Load Localisation files
     */
    public function load_plugin_textdomain() {
         
        $locale = determine_locale();
        $locale = apply_filters('rtwpvgp_plugin_locale', $locale);
        unload_textdomain('woo-product-variation-gallery-pro-pro');
        load_textdomain('woo-product-variation-gallery-pro-pro', WP_LANG_DIR . '/woo-product-variation-gallery-pro-pro/woo-product-variation-gallery-pro-pro-' . $locale . '.mo');
        load_plugin_textdomain('woo-product-variation-gallery-pro-pro', false, plugin_basename(dirname(RTWPVGP_PLUGIN_FILE)) . '/languages');
    } 
 
    private function define_constants() {
        $this->define('RTWPVGP_URL', plugins_url('', RTWPVGP_PLUGIN_FILE));
        $this->define('RTWPVGP_SLUG', basename(dirname(RTWPVGP_PLUGIN_FILE)));
        $this->define('RTWPVGP_TEMPLATE_DEBUG_MODE', false);
	    $this->define('RTWPVGP_PLUGIN_DIRNAME', dirname(plugin_basename(RTWPVGP_PLUGIN_FILE))); // plugin-slug
    }

    /**
     * Define constant if not already set.
     *
     * @param string      $name  Constant name.
     * @param string|bool $value Constant value.
     */
    public function define($name, $value) {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     * Get the plugin path.
     *
     * @return string
     */
    public function plugin_path() {
        return untrailingslashit(plugin_dir_path(RTWPVGP_PLUGIN_FILE));
    }

    /**
     * @return mixed
     */
    public function version() {
        return RTWPVGP_VERSION;
    }

    /**
     * Get the template path.
     *
     * @return string
     */
    public function get_template_path() {
        return apply_filters('rtwpvgp_template_path', 'woo-product-variation-gallery-pro-pro/');
    } 

    /**
     * @param $file
     *
     * @return string
     */
    public function get_assets_uri($file) {
        $file = ltrim($file, '/');

        return trailingslashit(RTWPVGP_URL . '/assets') . $file;
    } 
     
}

/**
 * @return bool|SingletonTrait|Rtwpvgp
 */
function rtwpvgp() { 
    return Rtwpvgp::getInstance();
} 
rtwpvgp(); // Run Rtwpvgp Plugin   

// use at least version 2.0.0 
if ( is_admin() && version_compare(RTWPVG_VERSION, '2.0.0', '<') ) { 

    add_action( 'admin_notices', function() {
        
        $class = 'notice notice-error'; 
        $text = esc_html__('Variation Images Gallery for WooCommerce', 'woo-product-variation-gallery-pro');
        $link = esc_url(
            add_query_arg(
                array(
                    'tab' => 'plugin-information',
                    'plugin' => 'woo-product-variation-gallery',
                    'TB_iframe' => 'true',
                    'width' => '640',
                    'height' => '500',
                ), admin_url('plugin-install.php')
            )
        );
        $link_pro = 'https://www.radiustheme.com/downloads/woocommerce-variation-images-gallery';

        printf('<div class="%1$s"><p><a target="_blank" href="%3$s"><strong>Variation Images Gallery for WooCommerce Pro</strong></a> is not working, You need to install and activate <a class="thickbox open-plugin-details-modal" href="%2$s"><strong>%4$s</strong></a> free version <strong>minimum 2.0.0</strong> to get the pro features.</p></div>', $class, $link, $link_pro, $text);

    } );
} 
 