<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Settings;

use Amiut\ProductSpecs\Template\TemplateRenderer;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ExecutableModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use Psr\Container\ContainerInterface;
final class Module implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\Settings\SettingsPage::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\Settings\SettingsPage($container->get(TemplateRenderer::class)), \Amiut\ProductSpecs\Settings\SettingsRegistrar::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\Settings\SettingsRegistrar()];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action('admin_menu', function () use ($container) {
            $this->registerAdminMenuPage($container);
        });
        add_action('admin_init', [$container->get(\Amiut\ProductSpecs\Settings\SettingsRegistrar::class), 'register']);
        return \true;
    }
    public function registerAdminMenuPage(ContainerInterface $container): void
    {
        add_submenu_page('dw-specs', __('Product specifications settings', 'product-specifications'), __('Settings', 'product-specifications'), 'manage_options', 'dw-specs-settings', [$container->get(\Amiut\ProductSpecs\Settings\SettingsPage::class), 'render']);
    }
}
