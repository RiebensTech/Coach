<?php

namespace Rtwpvgp\Controllers\Admin; 

use Rtwpvgp\Helpers\Functions;

class ScriptLoader {

	private $suffix;
	private $version;
	private $ajaxurl;
	private static $wp_localize_scripts = [];

	function __construct() {

		$this->suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';    
		$this->version = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? time() : rtwpvgp()->version();

		$this->ajaxurl = admin_url( 'admin-ajax.php' ); 

		add_action( 'wp_enqueue_scripts', array( $this, 'register_script' ), 99 );  
	}  

	function register_script_both_end() { 
 
	}

	function register_script() {
		$this->register_script_both_end();   

		if (apply_filters('rtwpvg_disable_enqueue_scripts', false)) {
            return;
        } 

        $this->add_inline_style();
	}  
 

	public function add_inline_style() {
        if (apply_filters('rtwpvg_disable_inline_style', false)) {
            return;
        }

        $arrow_bg_color = apply_filters('rtwpvg_arrow_bg_color', rtwpvg()->get_option('arrow_bg_color'));
        $arrow_bg_hover_color = apply_filters('rtwpvg_arrow_bg_hover_color', rtwpvg()->get_option('arrow_bg_hover_color'));
        $arrow_text_color = apply_filters('rtwpvg_arrow_text_color', rtwpvg()->get_option('arrow_text_color'));
        $arrow_text_hover_color = apply_filters('rtwpvg_arrow_text_hover_color', rtwpvg()->get_option('arrow_text_hover_color'));
        ob_start();
        ?>
        <style type="text/css">

            /* style */
            <?php if( $arrow_bg_color || $arrow_text_color): ?>
            .rtwpvg-images.rtwpvg-has-product-thumbnail .rtwpvg-wrapper .rtwpvg-slider-wrapper .rtwpvg-slider-prev-arrow,
            .rtwpvg-images.rtwpvg-has-product-thumbnail .rtwpvg-wrapper .rtwpvg-slider-wrapper .rtwpvg-slider-next-arrow,
            .rtwpvg-images.rtwpvg-has-product-thumbnail .rtwpvg-wrapper .rtwpvg-thumbnail-wrapper .rtwpvg-thumbnail-prev-arrow,
            .rtwpvg-images.rtwpvg-has-product-thumbnail .rtwpvg-wrapper .rtwpvg-thumbnail-wrapper .rtwpvg-thumbnail-next-arrow {
            <?php if($arrow_bg_color){ ?> background: <?php echo $arrow_bg_color; ?>;
            <?php } ?><?php if($arrow_text_color){ ?> color: <?php echo $arrow_text_color; ?>;
            <?php } ?>
            }

            <?php endif; ?>
            <?php if( $arrow_bg_hover_color || $arrow_text_hover_color): ?>
            .rtwpvg-images.rtwpvg-has-product-thumbnail .rtwpvg-wrapper .rtwpvg-slider-wrapper .rtwpvg-slider-next-arrow:hover,
            .rtwpvg-images.rtwpvg-has-product-thumbnail .rtwpvg-wrapper .rtwpvg-slider-wrapper .rtwpvg-slider-prev-arrow:hover,
            .rtwpvg-images.rtwpvg-has-product-thumbnail .rtwpvg-wrapper .rtwpvg-thumbnail-wrapper .rtwpvg-thumbnail-slider .rtwpvg-thumbnail-prev-arrow:hover,
            .rtwpvg-images.rtwpvg-has-product-thumbnail .rtwpvg-wrapper .rtwpvg-thumbnail-wrapper .rtwpvg-thumbnail-slider .rtwpvg-thumbnail-next-arrow:hover {
            <?php if($arrow_bg_hover_color){ ?> background: <?php echo $arrow_bg_hover_color; ?>;
            <?php } ?><?php if($arrow_text_hover_color){ ?> color: <?php echo $arrow_text_hover_color; ?>;
            <?php } ?>
            }

            <?php endif; ?>

        </style>
        <?php
        $css = ob_get_clean();
        $css = str_ireplace(array('<style type="text/css">', '</style>'), '', $css);

        $css = apply_filters('rtwpvg_inline_style', $css);
        wp_add_inline_style('rtwpvg', $css);
    }
}
