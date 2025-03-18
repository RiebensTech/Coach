<?php

declare (strict_types=1);
/* namespace { PHP-SCOPER: Namespace removed intentionally */
    use Amiut\ProductSpecs\Attribute\AttributeFieldGroup;
    use Amiut\ProductSpecs\Template\TemplateRenderer;
    \defined('ABSPATH') || exit;
    /**
     * @var AttributeFieldGroup $group
     * @var TemplateRenderer $renderer
     * @var array $data
     */
    ['group' => $group, 'renderer' => $renderer] = $data;
    ?>

<?php 
    foreach ($group->attributes() as $attribute) {
        ?>
    <li class="dw-table-field-wrap">
        <?php 
        echo $renderer->render(
            // phpcs:ignore
            $attribute->templatePath(),
            ['attribute' => $attribute, 'group' => $group]
        );
        ?>
    </li>
<?php 
    }
/* } PHP-SCOPER: Namespace removed intentionally */