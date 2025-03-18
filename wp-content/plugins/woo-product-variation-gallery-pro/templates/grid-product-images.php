<?php
/**
 * Single Product Images
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     RadiusTheme
 * @package    WooCommerce/Templates
 * @version    8.5.2
 *
 * @var $product WC_Product
 */


use Rtwpvg\Helpers\Functions;

defined('ABSPATH') || exit;

$columns = absint(apply_filters('rtwpvg_thumbnails_columns', rtwpvg()->get_option('thumbnails_columns')));

global $product;

$product_id = $product->get_id();
$default_attributes = Functions::get_product_default_attributes($product_id);
$default_variation_id = Functions::get_product_default_variation_id($product, $default_attributes);
$product_type = $product->get_type();
$post_thumbnail_id = $product->get_image_id();

$attachment_ids = $product->get_gallery_image_ids();
$has_post_thumbnail = $product->get_image_id() ?? true; //has_post_thumbnail(); Shop builder support

if ('variable' === $product_type && $default_variation_id > 0) {

	$product_variation = Functions::get_product_variation($product_id, $default_variation_id);

	if (isset($product_variation['image_id'])) {
		$post_thumbnail_id = $product_variation['image_id'];
		$has_post_thumbnail = true;
	}

	if (isset($product_variation['variation_gallery_images'])) {
		$attachment_ids = wp_list_pluck($product_variation['variation_gallery_images'], 'image_id');
		array_shift($attachment_ids);
	}
}
$has_gallery_thumbnail = ($has_post_thumbnail && (count($attachment_ids) > 0));

$only_has_post_thumbnail = ($has_post_thumbnail && (count($attachment_ids) === 0));

/*
if ( $post_thumbnail_id ) {
	$default_sizes = wp_get_attachment_image_src($post_thumbnail_id, 'woocommerce_single');
	$default_height = $default_sizes[2] ?? null;
	$default_width = $default_sizes[1] ?? null;
}
*/

$thumbnail_position = apply_filters('rtwpvg_thumbnail_position', 'bottom');


$gallery_width = absint(apply_filters('rtwpvg_width', rtwpvg()->get_option('gallery_width')));

$inline_style = apply_filters('rtwpvg_product_inline_style', array());

$wrapper_classes = apply_filters('rtwpvg_image_classes', array(
	'rtwpvg-images',
	'rtwpvg-images-thumbnail-columns-' . absint($columns),
	$has_gallery_thumbnail ? 'rtwpvg-has-product-thumbnail' : ''
));
$post_thumbnail_id = (int)apply_filters('rtwpvg_post_thumbnail_id', $post_thumbnail_id, $attachment_ids, $product);
$attachment_ids = (array)apply_filters('rtwpvg_attachment_ids', $attachment_ids, $post_thumbnail_id, $product);

$columns = absint(apply_filters('rtwpvg_thumbnails_columns', rtwpvg()->get_option('thumbnails_columns')));
$columns_sm = absint(apply_filters('rtwpvg_sm_thumbnails_columns', rtwpvg()->get_option('thumbnails_columns_sm')));
$columns_xs = absint(apply_filters('rtwpvg_xs_thumbnails_columns', rtwpvg()->get_option('thumbnails_columns_xs')));

?>

<div style="<?php echo esc_attr(Functions::generate_inline_style($inline_style)) ?>"
     class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', array_unique($wrapper_classes)))); ?>">

    <div class="<?php echo rtwpvg()->get_option('preloader') ? 'loading-rtwpvg' : ''; ?> rtwpvg-grid-wrapper rtwpvg-thumbnail-position-<?php echo esc_attr($thumbnail_position) ?> rtwpvg-product-type-<?php echo esc_attr($product_type) ?>" data-thumbnail_position='<?php echo esc_attr($thumbnail_position) ?>'>

        <div class="rtwpvg-container rtwpvg-preload-style-<?php echo trim(rtwpvg()->get_option('preload_style') ?? '' ) ?>">

            <?php do_action('rtwpvg_product_badge', $product); ?>


            <div class="rtwpvg-grid-layout rtwpvg-columns-<?php echo esc_attr( $columns ); ?> rtwpvg-sm-columns-<?php echo esc_attr( $columns_sm );?> rtwpvg-xs-columns-<?php echo esc_attr( $columns_xs );?> ">

                <?php
                // Main  Image
                if ($has_post_thumbnail) :
                    echo Functions::get_gallery_image_html($post_thumbnail_id, array(
                        'is_main_thumbnail' => true,
                        'has_only_thumbnail' => $only_has_post_thumbnail
                    ));
                else:
                    echo '<div class="rtwpvg-gallery-image rtwpvg-gallery-image-placeholder">';
                    echo sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'woocommerce'));
                    echo '</div>';
                endif;

                // Gallery attachment Images
                if ($has_gallery_thumbnail) :
                    foreach ($attachment_ids as $attachment_id) :
                        echo Functions::get_gallery_image_html($attachment_id, array(
                            'is_main_thumbnail' => true,
                            'has_only_thumbnail' => $only_has_post_thumbnail
                        ));
                    endforeach;
                endif;
                ?>
            </div>

        </div> <!-- .container -->
    </div> <!-- .rtwpvg-wrapper -->
</div>


