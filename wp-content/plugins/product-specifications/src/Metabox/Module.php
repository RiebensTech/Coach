<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Metabox;

use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ExecutableModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use Psr\Container\ContainerInterface;
final class Module implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\Metabox\Metaboxes::class => static fn() => new \Amiut\ProductSpecs\Metabox\Metaboxes()];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action('init', $container->get(\Amiut\ProductSpecs\Metabox\Metaboxes::class));
        add_action('add_meta_boxes', [$container->get(\Amiut\ProductSpecs\Metabox\Metaboxes::class), 'setup'], 10, 2);
        add_action('wp_insert_post', [$container->get(\Amiut\ProductSpecs\Metabox\Metaboxes::class), 'save'], 10, 2);
        return \true;
    }
}
