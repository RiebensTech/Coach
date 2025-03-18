<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\AttributeGroupsListUi;

use Amiut\ProductSpecs\Repository\AttributeGroupsRepository;
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
        return [\Amiut\ProductSpecs\AttributeGroupsListUi\AttributeGroupsListPage::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\AttributeGroupsListUi\AttributeGroupsListPage($container->get(TemplateRenderer::class), $container->get(AttributeGroupsRepository::class))];
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
        add_submenu_page('dw-specs', esc_html__('Attribute Groups', 'product-specifications'), esc_html__('Groups', 'product-specifications'), 'edit_pages', 'dw-specs-groups', [$container->get(\Amiut\ProductSpecs\AttributeGroupsListUi\AttributeGroupsListPage::class), 'render']);
    }
}
