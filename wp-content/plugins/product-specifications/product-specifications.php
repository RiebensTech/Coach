<?php

/**
 * Plugin Name: Product Specifications for WooCommerce
 * Plugin URI: https://github.com/dornaweb/product-specifications/
 * Description: This plugin adds a product specifications table to your woocommerce products.
 * Version: 0.8.7
 * Author: Amin Abdolrezapoor
 * Author URI: https://amin.nz
 * License: GPL-2.0+
 * Requires Plugins: woocommerce
 * Requires PHP: 7.4
 * Requires at least: 5.9
 * WC tested up to: 9.3.3
 * WC requires at least: 8.0.0
 */
declare (strict_types=1);
namespace Amiut\ProductSpecs;

// phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols
use ProductSpecifications\Vendor\Inpsyde\Modularity\Package;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Properties\PluginProperties;
use Throwable;
defined('ABSPATH') || exit;
if (!defined('DWSPECS_PLUGIN_FILE')) {
    define('DWSPECS_PLUGIN_FILE', __FILE__);
}
function handleFailure(Throwable $throwable): void
{
    add_action('all_admin_notices', static function () use ($throwable) {
        $class = 'notice notice-error';
        printf('<div class="%s"><p>%s</p></div>', esc_attr($class), wp_kses_post(sprintf('<strong>Error:</strong> %s <br><pre>%s</pre>', $throwable->getMessage(), $throwable->getTraceAsString())));
    });
}
function setupAutoLoader(): void
{
    if (class_exists(\Amiut\ProductSpecs\Content\Module::class)) {
        return;
    }
    if (is_readable(__DIR__ . '/vendor/autoload.php')) {
        require_once __DIR__ . '/vendor/autoload.php';
    }
}
function bootstrap(): void
{
    try {
        setupAutoLoader();
        $plugin = Package::new(PluginProperties::new(__FILE__));
        \Amiut\ProductSpecs\App::instance();
        $plugin->addModule(new \Amiut\ProductSpecs\Assets\Module())->addModule(new \Amiut\ProductSpecs\Template\Module())->addModule(new \Amiut\ProductSpecs\Repository\Module())->addModule(new \Amiut\ProductSpecs\Content\Module())->addModule(new \Amiut\ProductSpecs\Admin\Module())->addModule(new \Amiut\ProductSpecs\AttributesListUi\Module())->addModule(new \Amiut\ProductSpecs\AttributeGroupsListUi\Module())->addModule(new \Amiut\ProductSpecs\ImportExport\Module())->addModule(new \Amiut\ProductSpecs\Settings\Module())->addModule(new \Amiut\ProductSpecs\Integration\Module())->addModule(new \Amiut\ProductSpecs\Attribute\Module())->addModule(new \Amiut\ProductSpecs\Shortcode\Module())->addModule(new \Amiut\ProductSpecs\Metabox\Module())->addModule(new \Amiut\ProductSpecs\EntityUpdater\Module())->addModule(new \Amiut\ProductSpecs\EntityUpdaterUi\Module())->addModule(new \Amiut\ProductSpecs\ProductSpecifications\Module())->addModule(new \Amiut\ProductSpecs\SpecificationsTable\Module())->boot();
    } catch (Throwable $throwable) {
        handleFailure($throwable);
    }
}
add_action('plugins_loaded', __NAMESPACE__ . '\bootstrap');
