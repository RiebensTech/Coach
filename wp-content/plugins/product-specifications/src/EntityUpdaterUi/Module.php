<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\EntityUpdaterUi;

use Amiut\ProductSpecs\EntityUpdater\AttributeController;
use Amiut\ProductSpecs\EntityUpdater\AttributeGroupController;
use Amiut\ProductSpecs\EntityUpdater\AttributeSyncHandler;
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
        return [\Amiut\ProductSpecs\EntityUpdaterUi\EditFormUi::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\EntityUpdaterUi\EditFormUi($container->get(TemplateRenderer::class)), \Amiut\ProductSpecs\EntityUpdaterUi\GroupReArrangeFormUi::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\EntityUpdaterUi\GroupReArrangeFormUi($container->get(TemplateRenderer::class), $container->get(AttributesRepository::class))];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action('wp_ajax_dwps_edit_form', [$container->get(\Amiut\ProductSpecs\EntityUpdaterUi\EditFormUi::class), 'render']);
        add_action('wp_ajax_dwps_group_rearrange_form', [$container->get(\Amiut\ProductSpecs\EntityUpdaterUi\GroupReArrangeFormUi::class), 'render']);
        return \true;
    }
}
