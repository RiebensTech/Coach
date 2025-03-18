<?php
namespace WOPB_PRO;

defined( 'ABSPATH' ) || exit;

/**
 * Plugin Notice
 */
class Notice {

	/**
     * Notice Constructor
     */
    public function __construct() {
        add_action( 'admin_init', array( $this, 'admin_init_callback' ) );
        add_action( 'admin_action_woob_install', array( wopb_pro_function(), 'wowstore_activate' ) );
        add_action( 'admin_action_wopb_activate', array( wopb_pro_function(), 'wowstore_activate' ) );
		add_action( 'wp_ajax_wopb_dismiss_notice', array( $this, 'set_dismiss_notice_callback' ) );
	}

	/**
	 * Dismiss Notice Callback
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
	public function set_dismiss_notice_callback() {
		if (! (isset($_POST['wpnonce']) && wp_verify_nonce(sanitize_key(wp_unslash($_POST['wpnonce'])), 'wopb-nonce'))) {
			return ;
		}
		update_option( 'wopb_dismiss_notice', 'yes' );
	}

    /**
     * Notice Show for Install/Activate
     *
     * @since v.1.3.11
     * @return NULL
     */
    public function admin_init_callback() {
        if (!file_exists(WP_PLUGIN_DIR.'/product-blocks/product-blocks.php')) {
            add_action('admin_notices', array($this, 'installation_notice_callback'));
        } else if (file_exists(WP_PLUGIN_DIR.'/product-blocks/product-blocks.php') && ! is_plugin_active('product-blocks/product-blocks.php')) {
            add_action('admin_notices', array($this, 'activation_notice_callback'));
        }
    }

	/**
	 * Installation Notice HTML
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
	public function installation_notice_callback() {
		if (!get_option('wopb_dismiss_notice')) {
			$this->notice_css();
			$this->notice_js();
			$button_text = file_exists( WP_PLUGIN_DIR . '/product-blocks/product-blocks.php' ) ? __( 'Activate WowStore', 'product-blocks-pro' ) : __( 'Install & Activate WowStore', 'product-blocks-pro' );
			?>
			<div class="wc-install wopb-installer notice">
				<img width="150" src="<?php echo esc_url(WOPB_PRO_URL.'assets/img/wopb.png'); ?>" alt="logo" />
				<div class="wc-install-body">
					<a class="wc-dismiss-notice" data-security="<?php echo esc_attr( wp_create_nonce('wopb-nonce') ); ?>"  data-ajax="<?php echo esc_url( admin_url('admin-ajax.php')); ?>" href="#"><span class="dashicons dashicons-no-alt"></span> <?php esc_html_e('Dismiss', 'product-blocks-pro'); ?></a>
					<h3><?php esc_html_e('Welcome to WowStore Pro.', 'product-blocks-pro'); ?></h3>
					<div class="wopb-pro-active-instruction"><?php esc_html_e('WowStore Pro is a block plugin. To use this plugins you have to install and activate WowStore.', 'product-blocks-pro'); ?></div>
					<a class="wopb-install-btn button button-primary button-hero" href="<?php echo esc_url(add_query_arg(array('action' => 'woob_install'), admin_url())); ?>"><span class="dashicons dashicons-image-rotate"></span><?php echo $button_text; ?></a>
				</div>
			</div>
			<?php
		}
	}

    /**
     * Activation Notice HTML
     *
     * @since v.1.3.11
     * @return NULL
     */
    public function activation_notice_callback() {
        if (!get_option('wopb_dismiss_notice')) {
            $this->notice_css();
            $this->notice_js();
            ?>
            <div class="wc-install notice">
                <img width="150" src="<?php echo esc_url(WOPB_PRO_URL.'assets/img/wopb.png'); ?>" alt="logo" />
                <div class="wc-install-body">
                    <a class="wc-dismiss-notice" data-security="<?php echo esc_attr(wp_create_nonce('wopb-nonce')); ?>"  data-ajax="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" href="#"><span class="dashicons dashicons-no-alt"></span> <?php esc_html_e('Dismiss', 'product-blocks-pro'); ?></a>
                    <h3><?php esc_html_e('Welcome to WowStore Pro.', 'product-blocks-pro'); ?></h3>
                    <div class="wopb-pro-active-instruction"><?php esc_html_e('WowStore Pro is a Block plugin. To use this plugins you have to install and activate WowStore.', 'product-blocks-pro'); ?></div>
                    <a class="button button-primary button-hero" href="<?php echo esc_url(add_query_arg(array('action' => 'wopb_activate'), admin_url())); ?>"><?php esc_html_e('Activate WowStore', 'product-blocks-pro'); ?></a>
                </div>
            </div>
            <?php
        }
    }

	/**
	 * Installation Notice CSS
     * 
     * @since v.1.0.0
	 * @return STRING || CSS
	 */
	public function notice_css() {
		?>
		<style type="text/css">
            .wc-install {
                display: -ms-flexbox;
                display: flex;
                align-items: center;
                background: #fff;
                margin-top: 40px;
                width: calc(100% - 50px);
                border: 1px solid #ccd0d4;
                padding: 15px;
                border-radius: 4px;
            }
            .wc-install img {
                margin-right: 10px;
            }
            .wc-install-body {
                -ms-flex: 1;
                flex: 1;
            }
            .wc-install-body > div.wopb-pro-active-instruction {
                max-width: 450px;
                margin-bottom: 20px;
            }
            .wc-install-body h3 {
                margin-top: 0;
                font-size: 24px;
                margin-bottom: 15px;
            }
            .wopb-install-btn {
                margin-top: 15px;
                display: inline-block;
            }
			.wc-install .dashicons{
				display: none;
				animation: dashicons-spin 1s infinite;
				animation-timing-function: linear;
			}
			.wc-install.loading .dashicons {
				display: inline-block;
				margin-top: 12px;
				margin-right: 5px;
			}
			.wc-dismiss-notice {
				position: relative;
				text-decoration: none;
				float: right;
				right: 26px;
			}
			.wc-dismiss-notice .dashicons{
				display: inline-block;
    			text-decoration: none;
				animation: none;
			}
			@keyframes dashicons-spin {
				0% {
					transform: rotate( 0deg );
				}
				100% {
					transform: rotate( 360deg );
				}
			}
		</style>
		<?php
	}

	/**
	 * Installation Notice JS
     * 
     * @since v.1.0.0
	 * @return STRING | JS
	 */
	public function notice_js() {
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				'use strict';
				// $(document).on('click', '.wopb-install-btn', function(e){
				// 	e.preventDefault();
				// 	const $that = $(this);
				// 	const wcInstall = $that.parents('.wc-install:first');
				// 	$.ajax({
				// 		type: 'POST',
				// 		url: ajaxurl,
				// 		data: { action: 'wopb_install' },
				// 		beforeSend: function(){
				// 		    $that.parents('.wc-install').addClass('loading');
                //         },
				// 		success: function (res) {
				// 			console.log( 'res >', res );
				// 			$that.parents('.wopb-installer').remove();
				// 			if ( res.data ) {
				// 				window.location.replace( res.data );
				// 			} else {
				// 				window.location.reload();
				// 			}
				// 		},
				// 		complete: function () {
				// 			wcInstall.removeClass('loading');
				// 		}
				// 	});
				// });
				// Dismiss notice
				$(document).on('click', '.wc-dismiss-notice', function(e){
					e.preventDefault();
					const that = $(this);
					console.log( 'Here!!!' );
					$.ajax({
						url: that.data('ajax'),
						type: 'POST',
						data: {
							action: 'wopb_dismiss_notice',
							wpnonce: that.data('security')
						},
						success: function (data) {
							that.parents('.wc-install').hide("slow", function() { that.parents('.wc-install').remove(); });
						},
						error: function(xhr) {
							console.log( 'Here3!!!' );
							console.log('Error occured. Please try again' + xhr.statusText + xhr.responseText );
						},
					});
				});

			});
		</script>
		<?php
	}
}