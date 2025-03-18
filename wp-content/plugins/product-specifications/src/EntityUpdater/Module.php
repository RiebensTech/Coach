<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\EntityUpdater;

use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ExecutableModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use Psr\Container\ContainerInterface;
final class Module implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\EntityUpdater\AttributeController::class => static fn() => new \Amiut\ProductSpecs\EntityUpdater\AttributeController(), \Amiut\ProductSpecs\EntityUpdater\AttributeGroupController::class => static fn() => new \Amiut\ProductSpecs\EntityUpdater\AttributeGroupController(), \Amiut\ProductSpecs\EntityUpdater\AttributeSyncHandler::class => static fn() => new \Amiut\ProductSpecs\EntityUpdater\AttributeSyncHandler(), \Amiut\ProductSpecs\EntityUpdater\AttributeGroupArrangementUpdater::class => static fn() => new \Amiut\ProductSpecs\EntityUpdater\AttributeGroupArrangementUpdater()];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action('wp_ajax_' . \Amiut\ProductSpecs\EntityUpdater\AttributeController::AJAX_ACTION, $container->get(\Amiut\ProductSpecs\EntityUpdater\AttributeController::class));
        add_action('wp_ajax_' . \Amiut\ProductSpecs\EntityUpdater\AttributeGroupController::AJAX_ACTION, $container->get(\Amiut\ProductSpecs\EntityUpdater\AttributeGroupController::class));
        add_action(\Amiut\ProductSpecs\EntityUpdater\AttributeController::ACTION_ATTRIBUTES_DELETED, [$container->get(\Amiut\ProductSpecs\EntityUpdater\AttributeSyncHandler::class), 'whenDeleted'], 10, 2);
        add_action(\Amiut\ProductSpecs\EntityUpdater\AttributeController::ACTION_ATTRIBUTES_ADDED, [$container->get(\Amiut\ProductSpecs\EntityUpdater\AttributeSyncHandler::class), 'whenAdded']);
        add_action(\Amiut\ProductSpecs\EntityUpdater\AttributeController::ACTION_ATTRIBUTES_UPDATED, [$container->get(\Amiut\ProductSpecs\EntityUpdater\AttributeSyncHandler::class), 'whenAdded']);
        add_action('wp_ajax_dwps_group_rearrange', $container->get(\Amiut\ProductSpecs\EntityUpdater\AttributeGroupArrangementUpdater::class));
        return \true;
    }
}
