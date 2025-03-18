<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Content;

use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use Psr\Container\ContainerInterface;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ExecutableModule;
final class Module implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\Content\PostType\SpecificationsTable::class => static fn() => new \Amiut\ProductSpecs\Content\PostType\SpecificationsTable(), \Amiut\ProductSpecs\Content\Taxonomy\AttributeGroup::class => static fn() => new \Amiut\ProductSpecs\Content\Taxonomy\AttributeGroup(), \Amiut\ProductSpecs\Content\Taxonomy\Attribute::class => static fn() => new \Amiut\ProductSpecs\Content\Taxonomy\Attribute()];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action('init', static function () use ($container) {
            $specificationsTablePostType = $container->get(\Amiut\ProductSpecs\Content\PostType\SpecificationsTable::class);
            register_post_type($specificationsTablePostType->key(), $specificationsTablePostType->args());
            $attributGroupTaxonomy = $container->get(\Amiut\ProductSpecs\Content\Taxonomy\AttributeGroup::class);
            $attributeTaxonomy = $container->get(\Amiut\ProductSpecs\Content\Taxonomy\Attribute::class);
            register_taxonomy($attributGroupTaxonomy->key(), $specificationsTablePostType->key(), $attributGroupTaxonomy->args());
            register_taxonomy($attributeTaxonomy->key(), $specificationsTablePostType->key(), $attributeTaxonomy->args());
        });
        return \true;
    }
}
