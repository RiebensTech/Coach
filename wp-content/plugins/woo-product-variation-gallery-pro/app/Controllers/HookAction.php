<?php

namespace Rtwpvgp\Controllers;

use Rtwpvg\Helpers\Functions;

class HookAction {

	public function __construct() {
		add_action( 'woocommerce_admin_after_product_gallery_item', [ &$this, 'admin_after_product_gallery_item' ], 10, 2 );
		add_action( 'wp_ajax_save-attachment-compat', [ $this, 'save_compat_video_field_via_ajax' ], 0, 1 );
		add_action( 'edit_attachment', [ $this, 'save_compat_video_field' ], 1 );
		add_action('wp_footer', array($this, 'thumbnail_template_js'));

	}

	function thumbnail_template_js() {

		$thumbnail_style = apply_filters('rtwpvg_thumbnail_position', 'bottom');
		if( is_admin() || 'grid' !== $thumbnail_style ){
			return;
		}
		$template = rtwpvg()->get_template_file_path( 'template-grid-layout', RTWPVGP_PATH );
		if( file_exists( $template ) ){
			 require_once $template;
		}

	}

	public function admin_after_product_gallery_item( $thepostid, $attachment_id ) {
		$has_video = Functions::gallery_has_video( $attachment_id ); // trim( get_post_meta( $attachment_id, 'rtwpvg_video_link', true ) );
		if ( $has_video ) {
			echo '<span class="has-video"></span>';
		}
	}

	public function save_compat_video_field_via_ajax() {
		$post_id = $_POST['id'];
		if ( isset( $_POST['attachments'][ $post_id ]['rtwpvg_video_link'] ) ) {
			$link = $_POST['attachments'][ $post_id ]['rtwpvg_video_link'];
			update_post_meta( $post_id, 'rtwpvg_video_link', $link );

			clean_post_cache( $post_id );
		}
	}
	/**
	 * Update media custom field from edit media page (non ajax).
	 *
	 * @param $post_id
	 */

	public function save_compat_video_field( $post_id ) {
		if ( isset( $_POST['attachments'][ $post_id ]['rtwpvg_video_link'] ) ) {
			$video = $_POST['attachments'][ $post_id ]['rtwpvg_video_link'];
			update_post_meta( $post_id, 'rtwpvg_video_link', $video );
		}
		return;
	}
}
