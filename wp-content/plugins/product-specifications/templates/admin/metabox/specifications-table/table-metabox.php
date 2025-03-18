<?php

declare (strict_types=1);
/* namespace { PHP-SCOPER: Namespace removed intentionally */
    \defined('ABSPATH') || exit;
    /**
     * @var WP_Post $post
     * @var array<WP_Term> $groups
     * @var array<WP_Term> $selectedGroups
     * @var array $data
     */
    ['post' => $post, 'groups' => $groups, 'selectedGroups' => $selectedGroups] = $data;
    ?>

<div class="dwsp-meta-wrap">
    <strong class="title"><?php 
    echo \esc_html__('Attribute Groups : ', 'product-specifications');
    ?></strong>
    <span class="hint">
        <?php 
    echo \esc_html__('Select attribute groups you want to load in this table : ', 'product-specifications');
    ?>
    </span>

    <div class="dwsp-meta-item">
        <?php 
    if (\count($groups) > 0) {
        ?>
            <?php 
        foreach ($groups as $term) {
            $slug = \dwspecs_spec_group_has_duplicates($term->name) ? " ({$term->slug})" : "";
            $isChecked = \count(\array_filter($selectedGroups, static fn(\WP_Term $selectedGroup) => $selectedGroup->term_id === $term->term_id)) > 0;
            ?>
                <p>
                    <label>
                        <input
                            type="checkbox"
                            value="<?php 
            echo \esc_attr((string) $term->term_id);
            ?>"
                            <?php 
            \checked($isChecked);
            ?>
                        >
                        <span><?php 
            echo \esc_html($term->name);
            echo \esc_html(\urldecode($slug));
            ?></span>
                    </label>
                </p>
            <?php 
        }
        ?>
        <?php 
    } else {
        ?>
            <?php 
        echo \esc_html__('No Group found, Please define some groups first', 'product-specifications');
        ?>
        <?php 
    }
    ?>

        <ul class="table-groups-list dpws-sortable">
            <?php 
    foreach ($selectedGroups as $group) {
        $slug = \dwspecs_spec_group_has_duplicates($group->name) ? " ({$group->slug})" : "";
        ?>
                    <li>
                        <input
                            checked
                            type="checkbox"
                            name="groups[]"
                            value="<?php 
        echo \esc_attr((string) $group->term_id);
        ?>"
                            readonly
                        >
                        <?php 
        echo \esc_html($group->name);
        ?>
                        <?php 
        echo \esc_html($slug);
        ?>
                    </li>
            <?php 
    }
    ?>
        </ul>
    </div>
</div>
<?php 
/* } PHP-SCOPER: Namespace removed intentionally */