<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Repository;

use Amiut\ProductSpecs\Attribute\AttributeFieldFactory;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use Psr\Container\ContainerInterface;
final class Module implements ServiceModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\Repository\EntityCollectionFactory::class => static fn() => new \Amiut\ProductSpecs\Repository\EntityCollectionFactory(), \Amiut\ProductSpecs\Repository\AttributesRepository::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\Repository\AttributesRepository($container->get(\Amiut\ProductSpecs\Repository\EntityCollectionFactory::class)), \Amiut\ProductSpecs\Repository\SpecificationsTableRepository::class => static fn() => new \Amiut\ProductSpecs\Repository\SpecificationsTableRepository(), \Amiut\ProductSpecs\Repository\AttributeFieldRepository::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\Repository\AttributeFieldRepository($container->get(AttributeFieldFactory::class), $container->get(\Amiut\ProductSpecs\Repository\AttributesRepository::class)), \Amiut\ProductSpecs\Repository\AttributeGroupsRepository::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\Repository\AttributeGroupsRepository($container->get(\Amiut\ProductSpecs\Repository\EntityCollectionFactory::class))];
    }
}
