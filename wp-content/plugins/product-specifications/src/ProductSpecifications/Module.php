<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\ProductSpecifications;

use Amiut\ProductSpecs\Metabox\Metaboxes;
use Amiut\ProductSpecs\Repository\AttributeFieldRepository;
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
        return [\Amiut\ProductSpecs\ProductSpecifications\ProductSpecificationsMetabox::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\ProductSpecifications\ProductSpecificationsMetabox($container->get(TemplateRenderer::class), $container->get(AttributeFieldRepository::class)), \Amiut\ProductSpecs\ProductSpecifications\AjaxTablesHandler::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\ProductSpecifications\AjaxTablesHandler($container->get(TemplateRenderer::class), $container->get(AttributeFieldRepository::class))];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action(Metaboxes::ACTION_SETUP, static function (Metaboxes $metaboxes) use ($container) {
            $metaboxes->add($container->get(\Amiut\ProductSpecs\ProductSpecifications\ProductSpecificationsMetabox::class));
        });
        add_action('wp_ajax_' . \Amiut\ProductSpecs\ProductSpecifications\AjaxTablesHandler::ACTION_LOAD_TABLE, [$container->get(\Amiut\ProductSpecs\ProductSpecifications\AjaxTablesHandler::class), 'loadTable']);
        return \true;
    }
}
