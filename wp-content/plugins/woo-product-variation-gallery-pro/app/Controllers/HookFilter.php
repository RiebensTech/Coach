<?php

namespace Rtwpvgp\Controllers;

use Rtwpvg\Helpers\Functions;
use Rtwpvgp\Helpers\Functions as Fns;
class HookFilter {

	function __construct() {
		add_filter( 'rtwpvg_slider_js_options', [ &$this, 'rtwpvg_slider_js_options' ] );
		//add_filter( 'rtwpvg_js_options', [ &$this, 'rtwpvg_js_options' ], 11 );
		add_filter( 'rtwpvg_thumbnail_position', [ &$this, 'rtwpvg_thumbnail_position' ] );
		add_filter( 'rtwpvg_gallery_image_inner_html', [ &$this, 'gallery_image_inner_html' ], 10, 5 );

		add_filter( 'rtwpvg_image_html_class', [ &$this, 'image_html_class' ], 10, 3 );
		add_filter( 'rtwpvg_thumbnail_image_html_class', [ &$this, 'thumbnail_image_html_class' ], 10, 3 );
		add_filter( 'rtwpvg_gallery_has_video', [ &$this, 'gallery_has_video' ], 10, 2 );
		add_filter( 'rtwpvg_get_image_props', [ $this, 'add_video_props' ], 10, 2 );

		add_filter('rtwpvg_gallery_image_inner_html', [ $this, 'gallery_image_inner_icon_html' ], 15, 5 );

		add_filter( 'rtwpvg_add_locate_template', [ $this, 'rtwpvg_add_locate_template' ], 14 );

		add_filter( 'wc_get_template', [ $this, 'gallery_template_override' ], 65, 2 );

	}

	function gallery_template_override( $template, $template_name ) {
		$old_template = $template;
		if ( apply_filters( 'disable_woo_variation_gallery', false ) ) {
			return $old_template;
		}
		$thumbnail_style = apply_filters('rtwpvg_thumbnail_position', 'bottom');

		$locate_template = rtwpvg()->locate_template( 'grid-product-images' );
        if ( 'grid' === $thumbnail_style && $template_name == 'single-product/product-image.php' && ! file_exists( $locate_template ) ) {
            $plugin_template = rtwpvg()->get_template_file_path( 'grid-product-images', RTWPVGP_PATH );
            if( file_exists( $plugin_template ) ){
                $template = $plugin_template;
            }
		}

		return apply_filters( 'rtwpvg_gallery_template_override_location_pro', $template, $template_name, $old_template );
	}

	function rtwpvg_add_locate_template( $templates) {
		$templates[] = trailingslashit( rtwpvg()->dirname() ) . 'grid-product-images.php';
		$templates[] = trailingslashit( RTWPVGP_PLUGIN_DIRNAME ) . 'grid-product-images.php';
		return $templates;
	}

	function gallery_image_inner_icon_html( $inner_html, $image, $template, $attachment_id, $options) {
		$thumbnail_style = apply_filters('rtwpvg_thumbnail_position', 'bottom');
		if( is_admin() || 'grid' !== $thumbnail_style ){
			return $inner_html;
		}
		ob_start();

        if ( rtwpvg()->get_option('lightbox')): ?>
            <a href="#"  class="rtwpvg-trigger rtwpvg-trigger-position-<?php echo rtwpvg()->get_option('zoom_position'); ?><?php echo rtwpvg()->get_option('lightbox_image_click') ? ' rtwpvg-image-trigger' : '' ?>">
	            <?php ob_start(); ?>
                <span class="dashicons dashicons-search">
                    <span class="screen-reader-text">
                        <?php echo esc_html( 'Zoom' );?>
                    </span>
                </span>
	            <?php
	            $icon_html = ob_get_clean();
	            echo apply_filters( 'rtwpvg_trigger_icon', $icon_html );
	            ?>
            </a>
        <?php endif;

		$icon_html = ob_get_clean();
		return $icon_html . $inner_html;
	}


	function gallery_has_video( $output, $attachment_id ) {
		$has_video = trim( get_post_meta( $attachment_id, 'rtwpvg_video_link', true ) ?? '' ); // The function will change the hooks.
		if ( $has_video ) {
			$output = $has_video;
		}
		return $output;
	}

	function rtwpvg_slider_js_options( $default ) {
		$using_swiper               = rtwpvg()->get_option( 'upgrade_slider_scripts' );
        if( $using_swiper ){
	        if( rtwpvg()->get_option( 'slider_arrow' ) ){
		        $default['navigation']         = [
			        'nextEl' => '.rtwpvg-slider-next-arrow',
			        'prevEl' => '.rtwpvg-slider-prev-arrow',
		        ];
	        }
	        $default['thumbs'] = true;
        } else {
	        $default['arrows']         = rtwpvg()->get_option( 'slider_arrow' ) ? true : false;
        }

		return $default;
	}

	function rtwpvg_thumbnail_position( $default ) {
		return rtwpvg()->get_option( 'thumbnail_position', 'bottom' );
	}

	function gallery_image_inner_html( $inner_html, $image, $template, $attachment_id, $options ) {
		$has_video = Functions::gallery_has_video( $attachment_id );
		if ( ! empty( $has_video ) ) {
			$type  = wp_check_filetype( $has_video );

			$style = 'width: 100%; height: 100%; margin: 0;padding: 0; background-color: #000';

			if ( ! empty( $type['type'] ) ) {
				$inner_html = sprintf(
					'<div class="rtwpvg-single-video-container"><video preload="auto" controls="" controlslist="nodownload" src="%s" style="%s" poster="%s" ></video></div>',
					$has_video,
					$style,
					esc_url( $image['src'] )
				);
			} else {
				$inner_html = sprintf(
					'<div class="rtwpvg-single-video-container"><iframe class="rtwpvg-lightbox-iframe" src="%s" style="%s" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>',
					Functions::get_simple_embed_url( $has_video ),
					$style
				);
			}
		}
		return $inner_html;
	}

	function image_html_class( $classes, $attachment_id, $image ) {
		$has_video = trim( Functions::gallery_has_video( $attachment_id ) );
		if ( $has_video ) {
			$classes[] = 'rtwpvg-gallery-video';
		}
		return $classes;
	}

	function thumbnail_image_html_class( $classes, $attachment_id, $image ) {
		$has_video = trim( Functions::gallery_has_video( $attachment_id ) );
		if ( $has_video ) {
			$classes[] = 'rtwpvg-thumbnail-video';
		}
		return $classes;
	}

	function add_video_props( $props, $attachment_id ) {
		$has_video = Functions::gallery_has_video( $attachment_id );
		if ( $has_video ) {
			$type                       = wp_check_filetype( $has_video );
			$video_width                = trim( get_post_meta( $attachment_id, 'rtwpvg_video_width', true ) ?? '' );
			$video_height               = trim( get_post_meta( $attachment_id, 'rtwpvg_video_height', true ) ?? '' );
			$props['rtwpvg_video_link'] = $has_video;
			// $props['rtwpvg_has_pro']    = rtwpvg()->active_pro();
			if ( ! empty( $has_video ) ) {
				if ( ! empty( $type['type'] ) ) {
					$props['rtwpvg_video_embed_type'] = 'video';
				} else {
					$props['rtwpvg_video_embed_type'] = 'iframe';
					$props['rtwpvg_video_embed_url']  = Functions::get_simple_embed_url( $has_video );
				}

				$props['rtwpvg_video_width'] = $video_width ? $video_width : 'auto';
				$props['rtwpvg_video_width'] = $video_height ? $video_height : '100%';
			}
		}

		return $props;

	}

}
