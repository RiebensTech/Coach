<?php

declare (strict_types=1);
/* namespace { PHP-SCOPER: Namespace removed intentionally */
    use Amiut\ProductSpecs\Attribute\AttributeFieldGroupCollection;
    use Amiut\ProductSpecs\Template\TemplateRenderer;
    \defined('ABSPATH') || exit;
    /**
     * @var AttributeFieldGroupCollection $groupedCollection
     * @var TemplateRenderer $renderer
     * @var array $data
     */
    ['groupedCollection' => $groupedCollection, 'renderer' => $renderer] = $data;
    ?>

<ul class="tabs">
    <?php 
    foreach ($groupedCollection as $index => $group) {
        ?>
        <li
            class="tab <?php 
        echo ($index === 0) ? 'active' : '';
        ?>"
            data-target="#dwps_attrs_<?php 
        echo \esc_attr((string) $group->id());
        ?>"
        >
            <?php 
        echo \esc_html($group->name());
        ?>
        </li>
    <?php 
    }
    ?>
</ul>

<div class="tab-contents">
    <?php 
    foreach ($groupedCollection as $index => $group) {
        ?>
        <div class="tab-content" id="dwps_attrs_<?php 
        echo \esc_attr((string) $group->id());
        ?>">
            <?php 
        if (\count($group->attributes())) {
            ?>
                <ul class="attributes-list">
                    <?php 
            echo $renderer->render(
                // phpcs:ignore
                'admin/metabox/product-specs-table/group-attributes',
                ['group' => $group]
            );
            ?>
                </ul>
            <?php 
        } else {
            ?>
                <?php 
            echo \esc_html__('No attributes defined yet', 'product-specifications');
            ?>
            <?php 
        }
        ?>
        </div>
    <?php 
    }
    ?>
</div>
<?php 
/* } PHP-SCOPER: Namespace removed intentionally */