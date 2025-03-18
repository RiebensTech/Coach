<?php

declare (strict_types=1);
/* namespace { PHP-SCOPER: Namespace removed intentionally */
    \defined('ABSPATH') || exit;
    /**
     * @var \Amiut\ProductSpecs\Attribute\AttributeField $attribute
     * @var \Amiut\ProductSpecs\Attribute\AttributeFieldGroup $group
     * @var \Amiut\ProductSpecs\Template\TemplateRenderer $renderer
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

<textarea
    name="<?php 
    echo \esc_attr(\sprintf("dw-attr[%d][%d]", (string) $group->id(), $attribute->id()));
    ?>"
    id="<?php 
    echo \esc_attr($attribute->slug());
    ?>"><?php 
    echo \esc_html((string) ($attribute->value() ?? $attribute->default()));
    ?></textarea>
<?php 
/* } PHP-SCOPER: Namespace removed intentionally */