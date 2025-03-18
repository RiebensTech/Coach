<?php

declare (strict_types=1);
/* namespace { PHP-SCOPER: Namespace removed intentionally */
    use Amiut\ProductSpecs\Attribute\AttributeFieldGroup;
    use Amiut\ProductSpecs\Attribute\AttributeFieldText;
    use Amiut\ProductSpecs\Template\TemplateRenderer;
    \defined('ABSPATH') || exit;
    /**
     * @var AttributeFieldText $attribute
     * @var AttributeFieldGroup $group
     * @var TemplateRenderer $renderer
     * @var array $data
     */
    ['attribute' => $attribute, 'group' => $group, 'renderer' => $renderer] = $data;
    ?>

<label for="<?php 
    echo \esc_attr($attribute->slug());
    ?>">
    <?php 
    echo \esc_html($attribute->name());
    ?> :
</label>

<input
    type="text"
    name="<?php 
    echo \esc_attr(\sprintf("dw-attr[%s][%s]", $group->id(), $attribute->id()));
    ?>"
    id="<?php 
    echo \esc_attr($attribute->slug());
    ?>"
    value="<?php 
    echo \esc_attr((string) ($attribute->value() ?? $attribute->default()));
    ?>"
>
<?php 
/* } PHP-SCOPER: Namespace removed intentionally */