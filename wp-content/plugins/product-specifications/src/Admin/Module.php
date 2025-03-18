<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Admin;

use Amiut\ProductSpecs\Assets\AssetHelper;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use Psr\Container\ContainerInterface;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ExecutableModule;
final class Module implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\Admin\Assets::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\Admin\Assets($container->get(AssetHelper::class)), \Amiut\ProductSpecs\Admin\AdminPageTopMenuModifier::class => static fn() => new \Amiut\ProductSpecs\Admin\AdminPageTopMenuModifier()];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action('admin_enqueue_scripts', [$container->get(\Amiut\ProductSpecs\Admin\Assets::class), 'load']);
        add_action('admin_menu', function () use ($container) {
            $this->registerMenuPages($container);
        });
        add_action('admin_menu', [$container->get(\Amiut\ProductSpecs\Admin\AdminPageTopMenuModifier::class), 'modify']);
        return \true;
    }
    private function registerMenuPages(ContainerInterface $container): void
    {
        add_menu_page(esc_html__('Product specifications table', 'product-specifications'), esc_html__('Specs. tables', 'product-specifications'), 'edit_pages', 'dw-specs', static function (): void {
        }, 'dashicons-welcome-view-site', 25);
        // Add tables page
        add_submenu_page('dw-specs', esc_html__('Add a new table', 'product-specifications'), esc_html__('New table', 'product-specifications'), 'edit_pages', 'dw-specs-new', static function (): void {
        });
    }
}
