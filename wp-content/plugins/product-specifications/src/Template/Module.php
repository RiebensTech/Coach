<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Template;

use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Package;
use Psr\Container\ContainerInterface;
final class Module implements ServiceModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\Template\TemplateRenderer::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\Template\PhpTemplateRenderer(new \Amiut\ProductSpecs\Template\Context([$container->get(Package::PROPERTIES)->basePath() . 'templates']))];
    }
}
