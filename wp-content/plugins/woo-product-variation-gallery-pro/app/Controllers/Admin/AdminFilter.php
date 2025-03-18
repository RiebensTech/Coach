<?php

namespace Rtwpvgp\Controllers\Admin;

use Rtwpvg\Helpers\Functions;

class AdminFilter {

	function __construct() {
		add_filter( 'rtwpvg_settings_fields', array( &$this, 'license_tab' ) );

		add_filter( 'rtwpvg_thumbnail_style', array( &$this, 'thumbnail_style' ) );

		add_filter( 'attachment_fields_to_edit', array( $this, 'add_media_video_meta' ), 10, 2 );
		add_filter( 'attachment_fields_to_save', array( $this, 'save_media_video_meta' ), 10, 2 );

		add_filter( 'wp_prepare_attachment_for_js', array( $this, 'update_attachment_for_js' ), 10, 3 );

	}

	/**
	 * @param $style
	 *
	 * @return mixed|null
	 */
	function thumbnail_style( $style ) {
		$style['left']  = esc_html__( 'Position Left', 'woo-product-variation-gallery' );
		$style['right'] = esc_html__( 'Position Right', 'woo-product-variation-gallery' );
		$style['grid']  = esc_html__( 'Grid Style', 'woo-product-variation-gallery' );

		return $style;
	}


	function license_tab( $default ) {
		$new = array(
			'license' => array(
				'id'     => 'license',
				'title'  => esc_html__( 'License', 'woo-product-variation-gallery-pro' ),
				'desc'   => esc_html__( 'Add your licence code here', 'woo-product-variation-gallery-pro' ),
				'active' => apply_filters( 'rtwpvg_tools_setting_active', false ),
				'fields' => apply_filters( 'rtwpvg_tools_setting_fields', array(
					array(
						'id'    => 'license_key',
						'type'  => 'text',
						'title' => esc_html__( 'Licence key', 'woo-product-variation-gallery-pro' ),
						'desc'  => esc_html__( "Enter your licence key here", "woo-product-variation-gallery-pro" )
					)
				) )
			),
		);

		$extended = array_merge( array_slice( $default, 0, 4 ), $new, array_slice( $default, 4 ) );

		return apply_filters( 'rtwpvgp_settings_fields', $extended );
	}

	function add_media_video_meta( $form_fields, $post ) {

		$form_fields['rtwpvg_video_link_label'] = array(
			'tr' => "<tr>
                            <td colspan='2'>
                                " . __( '<h2>VARIATION GALLERY VIDEO</h2>', "woo-product-variation-gallery" ) . "
                            </td>
                        </tr>",
		);
		$form_fields['rtwpvg_video_link']       = array(
			'value' => get_post_meta( $post->ID, 'rtwpvg_video_link', true ),
			'label' => __( 'Video URL', "woo-product-variation-gallery" ),
			'helps' => __( 'Youtube or vimeo video url<br> <a href="#" class="rtwpvg-media-video-popup">Upload your video <span class="dashicons dashicons-video-alt3"></span></a>', "woo-product-variation-gallery" ),
			'input' => 'url'
		);
		$form_fields['rtwpvg_video_width']      = array(
			'label' => esc_html__( 'Width', 'woo-product-variation-gallery' ),
			'input' => 'text',
			//'show_in_edit' => false,
			'value' => get_post_meta( $post->ID, 'rtwpvg_video_width', true ),
			'helps' => esc_html__( 'Video Width. px or %. Empty for default', 'woo-product-variation-gallery' )
		);

		$form_fields['rtwpvg_video_height'] = array(
			'label' => esc_html__( 'Height', 'woo-product-variation-gallery' ),
			'input' => 'text',
			//'show_in_edit' => false,
			'value' => get_post_meta( $post->ID, 'rtwpvg_video_height', true ),
			'helps' => esc_html__( 'Video Height. px or %. Empty for default', 'woo-product-variation-gallery' )
		);

		return $form_fields;
	}

	function save_media_video_meta( $post, $attachment ) {
		$post_id = $post['ID'];
		if ( isset( $attachment['rtwpvg_video_link'] ) ) {
			$rtwpvg_video_link = trim( $attachment['rtwpvg_video_link'] );
			update_post_meta( $post_id, 'rtwpvg_video_link', $rtwpvg_video_link );
		}

		if ( isset( $attachment['rtwpvg_video_width'] ) ) {
			update_post_meta( $post_id, 'rtwpvg_video_width', trim( $attachment['rtwpvg_video_width'] ) );
		}

		if ( isset( $attachment['rtwpvg_video_height'] ) ) {
			update_post_meta( $post_id, 'rtwpvg_video_height', trim( $attachment['rtwpvg_video_height'] ) );
		}

		if ( ! empty( $post['post_parent'] ) ) {
			Functions::delete_transients( $post['post_parent'] );
		}

		return $post;
	}

	function update_attachment_for_js( $response, $attachment, $meta ) {
		$id        = absint( $attachment->ID );
		$has_video = trim( get_post_meta( $id, 'rtwpvg_video_link', true ) ?? '' );

		$response['rtwpvg_video_link'] = $has_video;

		return $response;
	}
} 