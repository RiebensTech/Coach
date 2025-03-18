<?php

declare (strict_types=1);
/* namespace { PHP-SCOPER: Namespace removed intentionally */
    \defined('ABSPATH') || exit;
    /**
     * @var int $group_id
     * @var array<WP_Term> $attributes
     * @var array $data
     */
    ['id' => $group_id, 'attributes' => $attributes] = $data;
    ?>

<form action="#" method="post" id="dwps_modify_form">
    <ul class="re-arrange-attributes dpws-sortable">
        <?php 
    foreach ($attributes as $attr) {
        ?>
            <li>
                <input
                        type="checkbox"
                        readonly
                        checked
                        value="<?php 
        echo \esc_attr((string) $attr->term_id);
        ?>"
                        name="attr[]"
                >
                <?php 
        echo \esc_html($attr->name);
        ?>
            </li>
        <?php 
    }
    ?>

        <?php 
    if (\count($attributes) === 0) {
        ?>
            <?php 
        echo \esc_html__('This group has no attributes', 'product-specifications');
        ?>
        <?php 
    }
    ?>
    </ul>

    <input name="action" value="dwps_group_rearrange" type="hidden">
    <input name="group_id" value="<?php 
    echo \esc_attr($group_id);
    ?>" type="hidden">

    <?php 
    \wp_nonce_field('dwps_group_rearrange', 'dwps_group_rearange_nonce');
    ?>
    <input value="<?php 
    echo \esc_attr__('Update Arrangement', 'product-specifications');
    ?>" class="button button-primary" type="submit" style="float:left;">
    <div class="clearfix"></div>
</form>
<?php 
/* } PHP-SCOPER: Namespace removed intentionally */