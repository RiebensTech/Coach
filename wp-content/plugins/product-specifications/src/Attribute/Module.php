<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Attribute;

use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
final class Module implements ServiceModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\Attribute\AttributeFieldFactory::class => static fn() => new \Amiut\ProductSpecs\Attribute\AttributeFieldFactory()];
    }
}
