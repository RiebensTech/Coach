<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\AttributesListUi;

use Amiut\ProductSpecs\Repository\AttributesRepository;
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
        return [\Amiut\ProductSpecs\AttributesListUi\AttributeListPage::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\AttributesListUi\AttributeListPage($container->get(TemplateRenderer::class), $container->get(AttributesRepository::class))];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action('admin_menu', function () use ($container) {
            $this->registerAdminMenuPage($container);
        });
        return \true;
    }
    public function registerAdminMenuPage(ContainerInterface $container): void
    {
        add_submenu_page('dw-specs', esc_html__('Attributes', 'product-specifications'), esc_html__('Attributes', 'product-specifications'), 'edit_pages', 'dw-specs-attrs', [$container->get(\Amiut\ProductSpecs\AttributesListUi\AttributeListPage::class), 'render']);
    }
}
