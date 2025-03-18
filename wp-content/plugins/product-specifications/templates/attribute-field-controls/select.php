<?php

declare (strict_types=1);
/* namespace { PHP-SCOPER: Namespace removed intentionally */
    use Amiut\ProductSpecs\Attribute\AttributeFieldGroup;
    use Amiut\ProductSpecs\Attribute\AttributeFieldSelect;
    use Amiut\ProductSpecs\Template\TemplateRenderer;
    \defined('ABSPATH') || exit;
    /**
     * @var AttributeFieldSelect $attribute
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

<select
    name="<?php 
    echo \esc_attr(\sprintf("dw-attr[%d][%d]", $group->id(), $attribute->id()));
    ?>"
    id="<?php 
    echo \esc_attr($attribute->slug());
    ?>"
    <?php 
    if ($attribute->isCustomValue()) {
        ?>
        disabled="disabled"
    <?php 
    }
    ?>
>
    <option value=""><?php 
    echo \esc_html__('Select an option', 'product-specifications');
    ?></option>
    <?php 
    foreach ($attribute->options() as $option) {
        ?>
        <option value="<?php 
        echo \esc_attr($option);
        ?>" <?php 
        \selected($option, (string) $attribute->value());
        ?>>
            <?php 
        echo \esc_html($option);
        ?>
        </option>
    <?php 
    }
    ?>
</select>

<label class="or">
    <?php 
    echo \esc_html__('Or', 'product-specifications');
    ?>
    <input class="customvalue-switch" type="checkbox" <?php 
    \checked($attribute->isCustomValue());
    ?>>
</label>

<input
    type="text"
    value="<?php 
    echo $attribute->isCustomValue() ? \esc_attr((string) $attribute->value()) : '';
    ?>"
    name="<?php 
    echo \esc_attr(\sprintf("dw-attr[%d][%d]", $group->id(), $attribute->id()));
    ?>"
    class="select-custom"
    placeholder="<?php 
    echo \esc_attr__('Custom value', 'product-specifications');
    ?>"
    <?php 
    if (!$attribute->isCustomValue()) {
        ?>
        disabled="disabled"
    <?php 
    }
    ?>
>
<?php 
/* } PHP-SCOPER: Namespace removed intentionally */