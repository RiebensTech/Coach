<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Attribute;

final class AttributeFieldGroup
{
    private string $name;
    private string $slug;
    private int $id;
    private \Amiut\ProductSpecs\Attribute\AttributeFieldCollection $attributes;
    public function __construct(string $name, string $slug, int $id, \Amiut\ProductSpecs\Attribute\AttributeFieldCollection $attributes)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->id = $id;
        $this->attributes = $attributes;
    }
    public function name(): string
    {
        return $this->name;
    }
    public function id(): int
    {
        return $this->id;
    }
    public function slug(): string
    {
        return $this->slug;
    }
    public function attributes(): \Amiut\ProductSpecs\Attribute\AttributeFieldCollection
    {
        return $this->attributes;
    }
}
