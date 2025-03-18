<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Assets;

use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ExecutableModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Package;
use Psr\Container\ContainerInterface;
final class Module implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\Assets\AssetHelper::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\Assets\AssetHelper($container->get(Package::PROPERTIES)->basePath() . 'assets', (string) $container->get(Package::PROPERTIES)->baseUrl() . 'assets')];
    }
    public function run(ContainerInterface $container): bool
    {
        return \true;
    }
}
