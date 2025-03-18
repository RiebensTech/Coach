<?php
namespace SwatchlyPro\Admin;

/**
 * Global_Settings class
 */
class Global_Settings {

    /**
     * Constructor
     */
    public function __construct() {
        $this->settings();
    }

    /**
     * All the global settings of this plugin
     */
    public function settings() {
        $prefix = 'swatchly_options';

        // Create Settings Wrapper
        \CSF::createOptions( $prefix, array(
            'menu_title'         => esc_html__( 'Swatchly', 'swatchly-pro' ),
            'menu_slug'          => 'swatchly-admin',
            'menu_icon'          => 'dashicons-ellipsis',
            'framework_title'    => esc_html__( 'Swatchly Settings', 'swatchly-pro' ),
            'theme'              => 'light',
            'sticky_header'      => false,
            'class'              => 'swatchly_global_options',
            'show_sub_menu'      => false,
            'menu_position'      => 56,
            'output_css'         => true,
            'show_search'        => false,
            'show_reset_all'     => true,
            'show_reset_section' => true,
            'show_bar_menu '     => false,
            'footer_credit'      => esc_html__('Made with Love by HasThemes', 'swatchly-pro'),
            'defaults'           => array(
                'enable_swatches'                    => 1,
                'auto_convert_dropdowns_to_label'    => 1,
                'swatch_width'                       => '',
                'swatch_height'                      => '',
                'tooltip'                            => 1,
                'shape_style'                        => 'squared',
                'enable_shape_inset'                 => '',
                'shape_inset_size'                   => '',
                'deselect_on_click'                  => 1,
                'show_selected_attribute_name'       => 1,
                'variation_label_separator'          => ' : ',
                'disabled_attribute_type'            => '',
                'disable_out_of_stock'               => '',
                'sp_override_global'                 => '',
                'sp_enable_swatches'                 => '',
                'sp_auto_convert_dropdowns_to_label' => 1,
                'sp_swatch_width'                    => '',
                'sp_swatch_height'                   => '',
                'sp_tooltip'                         => 1,
                'sp_show_swatch_image_in_tooltip'    => 1,
                'sp_shape_style'                     => 'squared',
                'sp_enable_shape_inset'              => '',
                'sp_shape_inset_size'                => '',
                'sp_deselect_on_click'               => 1,
                'sp_show_selected_attribute_name'    => 1,
                'sp_disabled_attribute_type'         => '',
                'sp_disable_out_of_stock'            => '',
                'pl_override_global'                 => 1,
                'pl_enable_swatches'                 => '',
                'pl_auto_convert_dropdowns_to_label' => 1,
                'pl_swatch_width'                    => '',
                'pl_swatch_height'                   => '',
                'pl_tooltip'                         => 1,
                'pl_show_swatch_image_in_tooltip'    => 1,
                'pl_shape_style'                     => 'squared',
                'pl_enable_shape_inset'              => '',
                'pl_shape_inset_size'                => '',
                'pl_deselect_on_click'               => 1,
                'pl_disabled_attribute_type'         => '',
                'pl_disable_out_of_stock'            => '',
                'pl_show_swatches_label'             => '',
                'pl_show_clear_link'                 => 0,
                'variation_url'                      => 0,
                'sp_variation_url'                   => 0,
                'pl_variation_url'                   => 0,
                'pl_align'                           => 'center',
                'pl_position'                        => 'after_title',
                'pl_custom_position_hook_name'       => '',
                'pl_custom_position_hook_priority'   => '',
                'pl_enable_ajax_add_to_cart'         => '',
                'pl_hide_wc_forward_button'          => 0,
                'pl_enable_cart_popup_notice'        => 1,
                'pl_enable_swatch_limit'             => '',
                'pl_limit'                           => '',
                'pl_more_text_type'                  => 'icon',
                'pl_more_icon_enable_tooltip'        => '',
                'pl_more_icon_tooltip_text'          => '',
                'pl_more_text'                       => '',
                'pl_more_text_link'                  => '',

                'ajax_variation_threshold'           => '',
                'pl_enable_catalog_mode'             => '',
                'pl_catalog_global_attributes'       => array(),
                'pl_catalog_custom_attributes'       => '',
                'auto_convert_dropdowns_to_image'    => '',
                'sp_convert_dropdowns_to_image'    => '',
                'pl_convert_dropdowns_to_image'    => '',
                'auto_convert_dropdowns_to_image_condition'    => '',
                'sp_auto_convert_dropdowns_to_image_condition'    => '',
                'pl_auto_convert_dropdowns_to_image_condition'    => '',
            )
        ) );

        // General Options
        \CSF::createSection( $prefix, array(
            'id'     => 'genearl_settings',
            'title'  => esc_html__( 'General Settings', 'swatchly-pro' ),
            'icon'  => 'fas fa-sliders-h',
        ) );

        // Global
        \CSF::createSection( $prefix, array(
            'parent' => 'genearl_settings',
            'title'  => esc_html__( 'Global', 'swatchly-pro' ),
            'fields' => array(
                array(
                    'type'  => 'submessage',
                    'style' => 'success',
                    'content' => __('<b>Read Me!</b> <br><br> All of the Global options below will be applied for the both "Product Details" & "Product List/Shop" page. <br> But all the settings of this page will be unused if you enable settings from the "For Product Details Page" or "For Product List/Shop page" Tab differently.', 'swatchly-pro'),
                ),
                // enable_swatches
                array(
                    'id'    => 'enable_swatches',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Enable Swatches', 'swatchly-pro'),
                    'label' => esc_html__('Enable', 'swatchly-pro'),
                ),
                // auto_convert_dropdowns_to_label
                array(
                    'id'    => 'auto_convert_dropdowns_to_label',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Auto Convert Dropdowns To Label', 'swatchly-pro'),
                    'label' => esc_html__('Automatically convert dropdowns to "label swatch" by default.', 'swatchly-pro'),
                ),
                // auto_convert_dropdowns_to_image
                array(
                    'id'    => 'auto_convert_dropdowns_to_image',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Auto Convert Dropdowns To Image', 'swatchly-pro'),
                    'label' => esc_html__('Automatically convert dropdowns to "Image Swatch" if variation has an image.', 'swatchly-pro'),
                ),
                // auto_convert_dropdowns_to_image_condition
                array(
                    'id'    => 'auto_convert_dropdowns_to_image_condition',
                    'type'  => 'select',
                    'title' => esc_html__('Enable Image Type Attribute For', 'swatchly-pro'),
                    'options' => array(
                        'first_attribute' => esc_html__('The First attribute', 'swatchly-pro'),
                        'maximum' => esc_html__('The attribute with Maximum variations count', 'swatchly-pro'),
                        'minimum' => esc_html__('The attribute with Minimum variations count', 'swatchly-pro'),
                    ),
                    'dependency'  => array('auto_convert_dropdowns_to_image', '==', '1')
                ),
                // variation_url
                array(
                    'id'    => 'variation_url',
                    'type'  => 'checkbox',
                    'title' =>  esc_html__('Variation URL', 'swatchly'),
                    'label' =>  esc_html__('Yes', 'swatchly-pro'),
                    'desc'    => __( 'Generate URL based on selected variation attributes.', 'swatchly' ),
                ), 
                // swatch_width
                array(
                    'id'     => 'swatch_width',
                    'type'   => 'dimensions',
                    'title'  => esc_html__('Swatch Minimum Width', 'swatchly-pro'),
                    'desc'  => esc_html__('Default: 33px', 'swatchly-pro'),
                    'height' => false,
                    'units'  => array( 'px' ),
                    'width_icon' => '',
                    'output' => '.swatchly-swatch',
                    'output_prefix' => 'min',
                ),
                // swatch_height
                array(
                    'id'     => 'swatch_height',
                    'type'   => 'dimensions',
                    'title'  => esc_html__('Swatch Minimum Height', 'swatchly-pro'),
                    'desc'  => esc_html__('Default: 33px', 'swatchly-pro'),
                    'width' => false,
                    'height_icon' => '',
                    'units'  => array( 'px' ),
                    'output' => '.swatchly-swatch',
                    'output_prefix' => 'min',
                ),
                // tooltip
                array(
                    'id'    => 'tooltip',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Tooltip', 'swatchly-pro'),
                    'label' => esc_html__('Enable Tooltip', 'swatchly-pro'),
                ),
                // ajax_variation_threshold
                array(
                    'id'    => 'ajax_variation_threshold',
                    'type'  => 'number',
                    'title' => esc_html__('Ajax Variation Threshold', 'swatchly-pro'),
                    'desc'  => __('Default: 30 <br> When your variable product has more than 30 variations. You won\'t be able to visualize which combinations are unavailable to purchase, so the Customers need to choose each combination, if unavailable then choose another one and so on. You can increase the threshold to avoid that but keep in mind that, when your product has lot of variations the default way is faster than increasing the threshold.', 'swatchly-pro'),
                ),
                // show_swatch_image_in_tooltip
                array(
                    'id'    => 'show_swatch_image_in_tooltip',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Swatch Image as Tooltip', 'swatchly-pro'),
                    'label' => esc_html__('Show Swatch Image into The Tooltip', 'swatchly-pro'),
                    'after' => esc_html__('If you check this options. When a watch type is "image" and has an image. The image will be shown into the tooltip.', 'swatchly-pro'),
                ),
                // shape_style
                array(
                    'id'    => 'shape_style',
                    'type'  => 'image_select',
                    'title' => esc_html__('Shape Style', 'swatchly-pro'),
                    'label' => '',
                    'options' => array(
                        'squared' => SWATCHLY_PRO_ASSETS . '/images/sqared.png',
                        'rounded' => SWATCHLY_PRO_ASSETS . '/images/rounded.png',
                        'circle' => SWATCHLY_PRO_ASSETS . '/images/circle.png',
                    )
                ),
                // enable_shape_inset
                array(
                    'id'    => 'enable_shape_inset',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Enable Shape Inset', 'swatchly-pro'),
                    'label' => esc_html__('Enable', 'swatchly-pro'),
                    'desc' => esc_html__('Shape inset is the empty space around the swatch.', 'swatchly-pro'),
                ),
                // shape_inset_size
                array(
                    'id'          => 'shape_inset_size',
                    'type'        => 'number',
                    'title'       => esc_html__('Shape Inset Size', 'swatchly-pro'),
                    'desc'        => esc_html__('Default: 2px', 'swatchly-pro'),
                    'unit'        => 'px',
                    'max'         => 10,
                    'output'      => '.swatchly-inset .swatchly-swatch:before',
                    'output_mode' => 'border-width',
                ),
                // deselect_on_click
                array(
                    'id'    => 'deselect_on_click',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Deselect on Click', 'swatchly-pro'),
                    'label' => esc_html__('If a swatch is selected, clicking on it will deselect it.', 'swatchly-pro'),
                ),
                // show_selected_attribute_name
                array(
                    'id'    => 'show_selected_attribute_name',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Show Selected Variation Name', 'swatchly-pro'),
                    'label' => esc_html__('Yes', 'swatchly-pro'),
                ),
                // variation_label_separator
                array(
                    'id'         => 'variation_label_separator',
                    'type'       => 'text',
                    'title'      => esc_html__('Variation Label Separator', 'swatchly-pro'),
                    'default'    => esc_html__(' : ', 'swatchly-pro'),
                    'after'      => '',
                    'dependency' => array( 'show_selected_attribute_name', '==', '1' ),
                ),
                // disabled_attribute_type
                array(
                    'id'    => 'disabled_attribute_type',
                    'type'  => 'select',
                    'title' => esc_html__('Disabled Attribute Type', 'swatchly-pro'),
                    'options' => array(
                        ''                => esc_html__('Cross Sign', 'swatchly-pro'),
                        'blur_with_cross' => esc_html__('Blur With Cross', 'swatchly-pro'),
                        'blur'            => esc_html__('Blur', 'swatchly-pro'),
                        'hide'            => esc_html__('Hide', 'swatchly-pro'),
                    ),
                    'desc' => esc_html__('Note: It will not effective when you have large number of variations but the "Ajax Variation Threshold" value is less than the number of variations.', 'swatchly-pro'),
                ),
                // disable_out_of_stock
                array(
                    'id'    => 'disable_out_of_stock',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Disable Variation Form For The "Out of Stock" Products', 'swatchly-pro'),
                    'label' => esc_html__('Yes', 'swatchly-pro'),
                    'desc'  => esc_html__('If disabled, an out of stock message will be shown instead of showing the variations form / swatches.', 'swatchly-pro'),
                ),
            )
        ) );

        \CSF::createSection( $prefix, array(
            'parent' => 'genearl_settings',
            'title'  => esc_html__( 'For Product Details Page', 'swatchly-pro' ),
            'fields' => array(
                // sp_override_global
                array(
                    'id'    => 'sp_override_global',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Want to control the "Global" settings for Product Details page differently?', 'swatchly-pro'),
                    'label' => esc_html__('Yes', 'swatchly-pro'),
                    'desc' => esc_html__('By checking this box, the Settings in the "Global" tab will not work for the Product Details page. Instead you can control all "Global" settings for the product details page below.', 'swatchly-pro'),
                ),
                // sp_enable_swatches
                array(
                    'id'    => 'sp_enable_swatches',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Enable Swatches', 'swatchly-pro'),
                    'label' => esc_html__('Swatches will be enabled for the product details page.', 'swatchly-pro'),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_auto_convert_dropdowns_to_label
                array(
                    'id'    => 'sp_auto_convert_dropdowns_to_label',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Auto Convert Dropdowns To Label', 'swatchly-pro'),
                    'label' => esc_html__('Automatically convert dropdowns to "label swatch" by default.', 'swatchly-pro'),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_auto_convert_dropdowns_to_image
                array(
                    'id'    => 'sp_auto_convert_dropdowns_to_image',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Auto Convert Dropdowns To Image', 'swatchly-pro'),
                    'label' => esc_html__('Automatically convert dropdowns to "Image Swatch" if variation has an image.', 'swatchly-pro'),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_auto_convert_dropdowns_to_image_condition
                array(
                    'id'    => 'sp_auto_convert_dropdowns_to_image_condition',
                    'type'  => 'select',
                    'title' => esc_html__('Enable Image Type Attribute For', 'swatchly-pro'),
                    'options' => array(
                        'first_attribute' => esc_html__('The First attribute', 'swatchly-pro'),
                        'maximum' => esc_html__('The attribute with Maximum variations count', 'swatchly-pro'),
                        'minimum' => esc_html__('The attribute with Minimum variations count', 'swatchly-pro'),
                    ),
                    'dependency'  => array('sp_override_global|sp_auto_convert_dropdowns_to_image', '==|==', '1|1')
                ),
                // sp_variation_url
                array(
                    'id'    => 'sp_variation_url',
                    'type'  => 'checkbox',
                    'title' =>  esc_html__('Variation URL', 'swatchly'),
                    'label' =>  esc_html__('Yes', 'swatchly-pro'),
                    'desc'    => __( 'Generate URL based on selected variation attributes.', 'swatchly' ),
                    'dependency' => array('sp_override_global', '==', '1'),
                ), 
                // sp_swatch_width
                array(
                    'id'     => 'sp_swatch_width',
                    'type'   => 'dimensions',
                    'title'  => esc_html__('Swatch Minimum Width', 'swatchly-pro'),
                    'desc'  => esc_html__('Default: 33px', 'swatchly-pro'),
                    'height' => false,
                    'units'  => array( 'px' ),
                    'width_icon' => '',
                    'output' => '.single-product .swatchly-swatch',
                    'output_prefix' => 'min',
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_swatch_height
                array(
                    'id'     => 'sp_swatch_height',
                    'type'   => 'dimensions',
                    'title'  => esc_html__('Swatch Minimum Height', 'swatchly-pro'),
                    'desc'  => esc_html__('Default: 33px', 'swatchly-pro'),
                    'width' => false,
                    'height_icon' => '',
                    'units'  => array( 'px' ),
                    'output' => '.single-product .swatchly-swatch',
                    'output_prefix' => 'min',
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_tooltip
                array(
                    'id'    => 'sp_tooltip',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Tooltip', 'swatchly-pro'),
                    'label' => esc_html__('Enable Tooltip', 'swatchly-pro'),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_show_swatch_image_in_tooltip
                array(
                    'id'    => 'sp_show_swatch_image_in_tooltip',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Swatch Image as Tooltip', 'swatchly-pro'),
                    'label' => esc_html__('Show Swatch Image into The Tooltip', 'swatchly-pro'),
                    'after' => esc_html__('If you check this options. When a watch type is "image" and has an image. The image will be shown into the tooltip.', 'swatchly-pro'),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_shape_style
                array(
                    'id'    => 'sp_shape_style',
                    'type'  => 'image_select',
                    'title' => esc_html__('Shape Style', 'swatchly-pro'),
                    'label' => '',
                    'options' => array(
                        'squared' => SWATCHLY_PRO_ASSETS . '/images/sqared.png',
                        'rounded' => SWATCHLY_PRO_ASSETS . '/images/rounded.png',
                        'circle' => SWATCHLY_PRO_ASSETS . '/images/circle.png',
                    ),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_enable_shape_inset
                array(
                    'id'    => 'sp_enable_shape_inset',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Enable Shape Inset', 'swatchly-pro'),
                    'label' => esc_html__('Enable', 'swatchly-pro'),
                    'desc' => esc_html__('Shape inset is the empty space around the swatch.', 'swatchly-pro'),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_shape_inset_size
                array(
                    'id'          => 'sp_shape_inset_size',
                    'type'        => 'number',
                    'title'       => esc_html__('Shape Inset Size', 'swatchly-pro'),
                    'desc'        => esc_html__('Default: 2px', 'swatchly-pro'),
                    'unit'        => 'px',
                    'max'         => 10,
                    'output'      => '.swatchly-inset .swatchly-swatch:before',
                    'output_mode' => 'border-width',
                    'dependency'  => array('sp_override_global|sp_enable_shape_inset',  '==|==', '1|1')
                ),
                // sp_deselect_on_click
                array(
                    'id'    => 'sp_deselect_on_click',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Deselect on Click', 'swatchly-pro'),
                    'label' => esc_html__('If a swatch is selected, clicking on it will deselect it.', 'swatchly-pro'),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_show_selected_attribute_name
                array(
                    'id'    => 'sp_show_selected_attribute_name',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Show Selected Variation Name', 'swatchly-pro'),
                    'label' => esc_html__('Yes', 'swatchly-pro'),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_variation_label_separator
                array(
                    'id'         => 'sp_variation_label_separator',
                    'type'       => 'text',
                    'title'      => esc_html__('Variation Label Separator', 'swatchly-pro'),
                    'default'    => esc_html__(' : ', 'swatchly-pro'),
                    'after'      => '',
                    'dependency'  => array('sp_override_global|sp_show_selected_attribute_name',  '==|==', '1|1')
                ),
                // sp_disabled_attribute_type
                array(
                    'id'    => 'sp_disabled_attribute_type',
                    'type'  => 'select',
                    'title' => esc_html__('Disabled Attribute Type', 'swatchly-pro'),
                    'options' => array(
                        ''                => esc_html__('Cross Sign', 'swatchly-pro'),
                        'blur_with_cross' => esc_html__('Blur With Cross', 'swatchly-pro'),
                        'blur'            => esc_html__('Blur', 'swatchly-pro'),
                        'hide'            => esc_html__('Hide', 'swatchly-pro'),
                    ),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
                // sp_disable_out_of_stock
                array(
                    'id'    => 'sp_disable_out_of_stock',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Disable Variation Form For The "Out of Stock" Products', 'swatchly-pro'),
                    'label' => esc_html__('Yes', 'swatchly-pro'),
                    'desc'  => esc_html__('If disabled, an out of stock message will be shown instead of showing the variations form / swatches.', 'swatchly-pro'),
                    'dependency' => array('sp_override_global', '==', '1')
                ),
            )
        ) );

        \CSF::createSection( $prefix, array(
            'parent' => 'genearl_settings',
            'title'  => esc_html__( 'For Product List/Shop page', 'swatchly-pro' ),
            'fields' => array(
                // pl_override_global
                array(
                    'id'    => 'pl_override_global',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Want to control the "Global" settings for shop page differently?', 'swatchly-pro'),
                    'label' => esc_html__('Yes', 'swatchly-pro'),
                    'desc' => esc_html__('By checking this box, the Settings in the "Global" tab will not work for the Product List/Shop page. Instead you can control all "Global" settings for the Product List/Shop page below.', 'swatchly-pro'),
                ),
                // pl_enable_swatches
                array(
                    'id'    => 'pl_enable_swatches',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Enable Swatches', 'swatchly-pro'),
                    'label' => esc_html__('Swatches will be enabled for the product list/shop page.', 'swatchly-pro'),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_auto_convert_dropdowns_to_label
                array(
                    'id'    => 'pl_auto_convert_dropdowns_to_label',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Auto Convert Dropdowns To Label', 'swatchly-pro'),
                    'label' => esc_html__('Automatically convert dropdowns to "label swatch" by default.', 'swatchly-pro'),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_auto_convert_dropdowns_to_image
                array(
                    'id'    => 'pl_auto_convert_dropdowns_to_image',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Auto Convert Dropdowns To Image', 'swatchly-pro'),
                    'label' => esc_html__('Automatically convert dropdowns to "Image Swatch" if variation has an image.', 'swatchly-pro'),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_auto_convert_dropdowns_to_image_condition
                array(
                    'id'    => 'pl_auto_convert_dropdowns_to_image_condition',
                    'type'  => 'select',
                    'title' => esc_html__('Enable Image Type Attribute For', 'swatchly-pro'),
                    'options' => array(
                        'first_attribute' => esc_html__('The First attribute', 'swatchly-pro'),
                        'maximum' => esc_html__('The attribute with Maximum variations count', 'swatchly-pro'),
                        'minimum' => esc_html__('The attribute with Minimum variations count', 'swatchly-pro'),
                    ),
                    'dependency'  => array('pl_override_global|pl_auto_convert_dropdowns_to_image', '==|==', '1|1')
                ),
                // pl_variation_url
                array(
                    'id'    => 'pl_variation_url',
                    'type'  => 'checkbox',
                    'title' =>  esc_html__('Variation URL', 'swatchly'),
                    'label' =>  esc_html__('Yes', 'swatchly-pro'),
                    'desc'    => __( 'Generate URL based on selected variation attributes.', 'swatchly' ),
                    'dependency' => array('pl_override_global', '==', '1'),
                ), 
                // pl_swatch_width
                array(
                    'id'     => 'pl_swatch_width',
                    'type'   => 'dimensions',
                    'title'  => esc_html__('Swatch Minimum Width', 'swatchly-pro'),
                    'desc'  => esc_html__('Default: 33px', 'swatchly-pro'),
                    'height' => false,
                    'units'  => array( 'px' ),
                    'width_icon' => '',
                    'output' => '.swatchly_loop_variation_form .swatchly-swatch',
                    'output_prefix' => 'min',
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_swatch_height
                array(
                    'id'     => 'pl_swatch_height',
                    'type'   => 'dimensions',
                    'title'  => esc_html__('Swatch Minimum Height', 'swatchly-pro'),
                    'desc'  => esc_html__('Default: 33px', 'swatchly-pro'),
                    'width' => false,
                    'height_icon' => '',
                    'units'  => array( 'px' ),
                    'output' => '.swatchly_loop_variation_form .swatchly-swatch',
                    'output_prefix' => 'min',
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_tooltip
                array(
                    'id'    => 'pl_tooltip',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Tooltip', 'swatchly-pro'),
                    'label' => esc_html__('Enable Tooltip', 'swatchly-pro'),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_show_swatch_image_in_tooltip
                array(
                    'id'    => 'pl_show_swatch_image_in_tooltip',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Swatch Image as Tooltip', 'swatchly-pro'),
                    'label' => esc_html__('Show Swatch Image into The Tooltip', 'swatchly-pro'),
                    'after' => esc_html__('If you check this options. When a watch type is "image" and has an image. The image will be shown into the tooltip.', 'swatchly-pro'),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_shape_style
                array(
                    'id'    => 'pl_shape_style',
                    'type'  => 'image_select',
                    'title' => esc_html__('Shape Style', 'swatchly-pro'),
                    'label' => '',
                    'options' => array(
                        'squared' => SWATCHLY_PRO_ASSETS . '/images/sqared.png',
                        'rounded' => SWATCHLY_PRO_ASSETS . '/images/rounded.png',
                        'circle' => SWATCHLY_PRO_ASSETS . '/images/circle.png',
                    ),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_enable_shape_inset
                array(
                    'id'         => 'pl_enable_shape_inset',
                    'type'       => 'checkbox',
                    'title'      => esc_html__('Enable Shape Inset', 'swatchly-pro'),
                    'label'      => esc_html__('Enable', 'swatchly-pro'),
                    'desc'       => esc_html__('Shape inset is the empty space around the swatch.', 'swatchly-pro'),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_shape_inset_size
                array(
                    'id'          => 'pl_shape_inset_size',
                    'type'        => 'number',
                    'title'       => esc_html__('Shape Inset Size', 'swatchly-pro'),
                    'desc'        => esc_html__('Default: 2px', 'swatchly-pro'),
                    'unit'        => 'px',
                    'max'         => 10,
                    'output'      => '.swatchly-inset .swatchly-swatch:before',
                    'output_mode' => 'border-width',
                    'dependency'  => array('pl_override_global|pl_enable_shape_inset', '==|==', '1|1')
                ),
                // pl_deselect_on_click
                array(
                    'id'         => 'pl_deselect_on_click',
                    'type'       => 'checkbox',
                    'title'      => esc_html__('Deselect on Click', 'swatchly-pro'),
                    'label'      => esc_html__('If a swatch is selected, clicking on it will deselect it.', 'swatchly-pro'),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_disabled_attribute_type
                array(
                    'id'    => 'pl_disabled_attribute_type',
                    'type'  => 'select',
                    'title' => esc_html__('Disabled Attribute Type', 'swatchly-pro'),
                    'options' => array(
                        ''                => esc_html__('Cross Sign', 'swatchly-pro'),
                        'blur_with_cross' => esc_html__('Blur With Cross', 'swatchly-pro'),
                        'blur'            => esc_html__('Blur', 'swatchly-pro'),
                        'hide'            => esc_html__('Hide', 'swatchly-pro'),
                    ),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
                // pl_disable_out_of_stock
                array(
                    'id'         => 'pl_disable_out_of_stock',
                    'type'       => 'checkbox',
                    'title'      => esc_html__('Disable Variation Form For The "Out of Stock" Products', 'swatchly-pro'),
                    'label'      => esc_html__('Yes', 'swatchly-pro'),
                    'desc'       => esc_html__('If disabled, an out of stock message will be shown instead of showing the variations form / swatches.', 'swatchly-pro'),
                    'dependency' => array('pl_override_global', '==', '1')
                ),
            )
        ) );

        // Product Loop / Shop
        \CSF::createSection( $prefix, array(
            'icon'   => 'fas fa-th',
            'title'  => esc_html__( 'Product List / Shop', 'swatchly-pro' ),
            'fields' => array(
                // pl_show_swatch_label
                array(
                    'id'    => 'pl_show_swatches_label',
                    'type'  => 'checkbox',
                    'title' =>  esc_html__('Show Swatches Label', 'swatchly-pro'),
                    'label' =>  esc_html__('Yes', 'swatchly-pro'),
                ), 
                // pl_show_clear_link
                array(
                    'id'    => 'pl_show_clear_link',
                    'type'  => 'checkbox',
                    'title' =>  esc_html__('Show Clear Link', 'swatchly-pro'),
                    'label' =>  esc_html__('Yes', 'swatchly-pro'),
                ),           
                // pl_align
                array(
                    'id'    => 'pl_align',
                    'type'  => 'select',
                    'title' => esc_html__('Swatches Align', 'swatchly-pro'),
                    'options' => array(
                        'left'   => esc_html__('Left', 'swatchly-pro'),
                        'center' => esc_html__('Center', 'swatchly-pro'),
                        'right'  => esc_html__('Right', 'swatchly-pro'),
                    ),
                    'default' => 'center'
                ),
                // pl_position
                array(
                    'id'    => 'pl_position',
                    'type'  => 'select',
                    'title' => esc_html__('Swatches Position', 'swatchly-pro'),
                    'options' => array(
                        'before_title'    => esc_html__('Before Title', 'swatchly-pro'),
                        'after_title'     => esc_html__('After Title', 'swatchly-pro'),
                        'before_price'    => esc_html__('Before Price', 'swatchly-pro'),
                        'after_price'     => esc_html__('After Price', 'swatchly-pro'),
                        'before_cart'     => esc_html__('Before Cart', 'swatchly-pro'),
                        'after_cart'      => esc_html__('After Cart', 'swatchly-pro'),
                        'custom_position' => esc_html__('Custom Position', 'swatchly-pro'),
                        'shortcode'       => esc_html__('Use Shortcode', 'swatchly-pro'),
                    ),
                    'default' => 'center'
                ),
                // pl_custom_position_notice
                array(
                    'type'       => 'submessage',
                    'style'      => 'danger',
                    'content'    => esc_html__( 'Some themes remove the above positions. In that case, custom position is useful. Here you can place the custom/default hook name & priority to inject & adjust the swatches for the product loop.', 'swatchly-pro' ),
                    'dependency' => array( 'pl_position', '==', 'custom_position' )
                ),
                array(
                    'type'       => 'notice',
                    'style'      => 'info',
                    'content'    => __( '<code>[swatchly_pl_swatches]</code> Use this shortcode into your theme/child theme to place the swatches.', 'swatchly-pro' ),
                    'dependency' => array( 'pl_position', '==', 'shortcode' )
                ),
                // pl_custom_position_hook_name
                array(
                    'id'         => 'pl_custom_position_hook_name',
                    'type'       => 'text',
                    'title'      =>  esc_html__('Hook Name', 'swatchly-pro'),
                    'desc'       =>  esc_html__('e.g: woocommerce_after_shop_loop_item_title', 'swatchly-pro'),
                    'dependency' => array( 'pl_position', '==', 'custom_position' )
                ), 
                // pl_custom_position_hook_priority
                array(
                    'id'         => 'pl_custom_position_hook_priority',
                    'type'       => 'text',
                    'title'      =>  esc_html__('Hook Priority', 'swatchly-pro'),
                    'desc'       =>  esc_html__('Default: 10', 'swatchly-pro'),
                    'dependency' => array( 'pl_position', '==', 'custom_position' )
                ), 
                // pl_product_thumbnail_selector
                array(
                    'id'         => 'pl_product_thumbnail_selector',
                    'type'       => 'text',
                    'title'      =>  esc_html__('Product Thumbnail Selector', 'swatchly-pro'),
                    'desc'       =>  esc_html__('Note: Some themes remove the default product image. In this case, variation image will not be changed after choose a variation. Here you can place the CSS selector of the product thumbnail, so the product image will be changed once a variation is chosen.', 'swatchly-pro'),
                    'placeholder' => esc_html__('Example: img.attachment-woocommerce_thumbnail', 'swatchly-pro')
                ), 
                // pl_enable_swatch_limit
                array(
                    'id'    => 'pl_enable_swatch_limit',
                    'type'  => 'checkbox',
                    'title' =>  esc_html__('Enable Swatch Limit', 'swatchly-pro'),
                    'label' =>  esc_html__('Yes', 'swatchly-pro'),
                ), 
                // pl_limit
                array(
                    'id'         => 'pl_limit',
                    'type'       => 'number',
                    'title'      =>  esc_html__('Number of Swatch to Show', 'swatchly-pro'),
                    'dependency' => array('pl_enable_swatch_limit', '==', '1')
                ),
                // pl_more_text_type
                array(
                    'id'    => 'pl_more_text_type',
                    'type'  => 'select',
                    'title' => esc_html__('More Text Type', 'swatchly-pro'),
                    'options' => array(
                        'icon'  => esc_html__('Icon', 'swatchly-pro'),
                        'text'  => esc_html__('Text', 'swatchly-pro'),
                    ),
                    'dependency' => array('pl_enable_swatch_limit', '==', '1')
                ),
                // pl_more_icon_enable_tooltip
                array(
                    'id'         => 'pl_more_icon_enable_tooltip',
                    'type'       => 'checkbox',
                    'title'      =>  esc_html__('Tooltip', 'swatchly-pro'),
                    'label'      =>  esc_html__('Enable Tooltip For More Icon', 'swatchly-pro'),
                    'dependency' => array('pl_enable_swatch_limit|pl_more_text_type', '==|==', '1|icon')
                ), 
                // pl_more_icon_tooltip_text
                array(
                    'id'         => 'pl_more_icon_tooltip_text',
                    'type'       => 'text',
                    'title'      => esc_html__('Tooltip Text', 'swatchly-pro'),
                    'dependency' => array('pl_more_icon_enable_tooltip', '==', '1')
                ),
                // pl_more_text
                array(
                    'id'         => 'pl_more_text',
                    'type'       => 'text',
                    'title'      => esc_html__('More Text Label', 'swatchly-pro'),
                    'dependency' => array('pl_more_text_type', '==', 'text')
                ),
                // pl_more_text_link
                array(
                    'id'         => 'pl_more_text_link',
                    'type'       => 'link',
                    'title'      => esc_html__('More Text Link', 'swatchly-pro'),
                    'dependency' => array('pl_enable_swatch_limit', '==', '1')
                ),
                // pl_user_input_condition
                array(
                    'id'         => 'pl_user_input_condition',
                    'type'       => 'text',
                    'title'      => esc_html__('Conditionally Enable/Disable swatches for the product listing pages', 'swatchly-pro'),
                    'placeholder' => esc_html__('Place the condition code here', 'swatchly-pro'),
                    'after'      => __('Leave it empty, if you are not a technical person or don\'t have any coding knowledge.<br>
                        Using any invalid code you may experience fatal error in your site but no worries! You can still access to this page & removing the condition code from here will solve the error. <br>
                        Reference: <a href="https://codex.wordpress.org/Conditional_Tags" target="_blank">WordPress conditional tags</a> |  <a href="https://docs.woocommerce.com/document/conditional-tags/" target="_blank">WooCommerce conditional tags</a>', 'swatchly-pro'),
                    'desc'      => __('Example uses:<br>
                        <code>is_page(array(32,50))</code> -> Using this code, the swatch will be enable only for the pages with id 32 & 50 <br>
                        <code>is_shop() || is_product_category(array(\'clothing\'))</code> -> Using this code, the swatch will be enable for the main shop page & "clothing" category page.', 'swatchly-pro'),
                ),
                // pl_enable_catalog_mode
                array(
                    'id'         => 'pl_enable_catalog_mode',
                    'type'       => 'checkbox',
                    'title'      => esc_html__('Enable Catalog Mode', 'swatchly-pro'),
                    'label' =>  esc_html__('Yes', 'swatchly-pro'),
                ),
                // pl_more_text
                array(
                    'id'         => 'pl_catalog_more_text',
                    'type'       => 'text',
                    'title'      => esc_html__('More Text Label', 'swatchly-pro'),
                    'dependency' => array('pl_enable_catalog_mode', '==', '1')
                ),
                // notice
                array(
                  'type'        => 'content',
                  'content'        => __( 'Select & add the <strong>global/custom</strong> attributes below, that you want to show into the shop page. <br> If more than one attribute from the below attributes match with a product, then the first attribute from the product will be used. <br>The first attribute can be changed from the product edit page by drag & drop the position of the attributes.', 'swatchly-pro' ),
                  'button_title' => esc_html__('Add New Attribute', 'swatchly-pro'),
                  'dependency'  => array('pl_enable_catalog_mode', '==', '1')
                ),
                // pl_catalog_global_attributes
                array(
                  'id'          => 'pl_catalog_global_attributes',
                  'type'        => 'repeater',
                  'title'       => esc_html__('Select Global Attributes', 'swatchly-pro'),
                  'fields'      => array(
                        array(
                          'id'          => 'pl_catalog_global_attribute',
                          'type'        => 'select',
                          'placeholder' => esc_html__( 'Select', 'swatchly-pro' ),
                          'options'     => wc_get_attribute_taxonomy_labels(),
                        ),
                  ),
                  'dependency'  => array('pl_enable_catalog_mode', '==', '1')
                ),
                // pl_catalog_custom_attributes
                array(
                  'id'          => 'pl_catalog_custom_attributes',
                  'type'        => 'textarea',
                  'title'       => esc_html__('Custom Attributes', 'swatchly-pro'),
                  'desc'        => __( 'Write each attribute per line. Note: The custom attributes values are <b>Case Sensitive</b>', 'swatchly-pro' ),
                  'button_title' => esc_html__('Add New Attribute', 'swatchly-pro'),
                  'dependency'  => array('pl_enable_catalog_mode', '==', '1')
                ),
                array(
                    'type'       => 'submessage',
                    'style'      => 'info',
                    'content'    => '<strong>' . __( 'Ajax Add to Cart Behavior', 'swatchly-pro' ) . '</strong>',
                    'dependency'  => array('pl_enable_catalog_mode', '!=', '1')
                ),
                array(
                    'id'    => 'pl_enable_ajax_add_to_cart',
                    'type'  => 'checkbox',
                    'title' =>  esc_html__('Enable Ajax Add to Cart', 'swatchly-pro'),
                    'label' =>  esc_html__('Yes', 'swatchly-pro'),
                    'dependency'  => array('pl_enable_catalog_mode', '!=', '1')
                ),
                // pl_add_to_cart_text
                array(
                    'id'         => 'pl_add_to_cart_text',
                    'type'       => 'text',
                    'title'      =>  esc_html__('Add to Cart Text', 'swatchly-pro'),
                    'desc'       =>  esc_html__('Leave it empty for default.', 'swatchly-pro'),
                    'dependency' => array('pl_enable_ajax_add_to_cart|pl_enable_catalog_mode', '==|!=', '1|1')
                ),
                // pl_hide_wc_forward_button 
                array(
                    'id'         => 'pl_hide_wc_forward_button',
                    'type'       => 'checkbox',
                    'title'      =>  esc_html__('Hide "View Cart" button after Added to Cart', 'swatchly-pro'),
                    'label'      =>  esc_html__('Yes', 'swatchly-pro'),
                    'desc'       =>  esc_html__('After successfully add to cart, a new button shows linked to the cart page. You can control of that button from here. Note: If redirect option is enable from WooCommerce it will not work.', 'swatchly-pro'),
                    'dependency' => array('pl_enable_ajax_add_to_cart|pl_enable_catalog_mode', '==|!=', '1|1')
                ),
                // pl_enable_cart_popup_notice
                array(
                    'id'         => 'pl_enable_cart_popup_notice',
                    'type'       => 'checkbox',
                    'title'      =>  esc_html__('Enable Popup Notice', 'swatchly-pro'),
                    'label'      =>  esc_html__('Enable poupup notice after added to cart', 'swatchly-pro'),
                    'desc'       =>  esc_html__('After successfully add to cart, a pupup notice will be generated containing a button linked to the cart page. Note: If redirect option is enable from WooCommerce it will not work.', 'swatchly-pro'),
                    'dependency' => array('pl_enable_ajax_add_to_cart|pl_enable_catalog_mode', '==|!=', '1|1')
                ),
            )
        ) );

        // Featured Attribute
        \CSF::createSection( $prefix, array(
            'icon'   => 'dashicons-before dashicons-superhero',
            'title'  => esc_html__( 'Featured Attribute', 'swatchly-pro' ),
            'fields' => array(
                // enable_featured_attribute
                array(
                    'id'         => 'enable_featured_attribute',
                    'type'       => 'checkbox',
                    'label'      => esc_html__('Yes', 'swatchly-pro'),
                    'title'      => esc_html__('Enable Featured Attribute', 'swatchly-pro'),
                    'desc'       => __('Only applicable for Product Details page. <br> After enabling this option, you can set a different width/height for an attribute to represent it as a special attribute.', 'swatchly-pro'),
                ),
                // featured_attribute_global
                array(
                    'id'         => 'featured_attribute_global',
                    'type'       => 'select',
                    'title'      => esc_html__('Global Attribute', 'swatchly-pro'),
                    'options'    => wc_get_attribute_taxonomy_labels(),
                    'after'      => esc_html__('Select the attribute you want to represents as featured / special.', 'swatchly-pro'),
                    'placeholder'=> esc_html__('Select Attribute', 'swatchly-pro'),
                    'dependency' => array('enable_featured_attribute', '==', '1')
                ),
                // featured_attribute_custom
                array(
                    'id'         => 'featured_attribute_custom',
                    'type'       => 'text',
                    'title'      => esc_html__('Custom Attribute', 'swatchly-pro'),
                    'desc'       => __('Write the custom attribute name you want to represents as featured / special.<br> Custom attribute name is <b>Case Sensitive</b>', 'swatchly-pro'),
                    'dependency' => array('enable_featured_attribute', '==', '1')
                ),
                // swatch_width
                array(
                    'id'            => 'featured_swatch_width',
                    'type'          => 'dimensions',
                    'title'         => esc_html__('Swatch Minimum Width', 'swatchly-pro'),
                    'desc'          => esc_html__('Default: 33px', 'swatchly-pro'),
                    'height'        => false,
                    'units'         => array( 'px' ),
                    'width_icon'    => '',
                    'output'        => '.variations_form:not(.swatchly_loop_variation_form) .swatchly-featured .swatchly-swatch',
                    'output_prefix' => 'min',
                    'dependency'    => array('enable_featured_attribute', '==', '1')
                ),
                // swatch_height
                array(
                    'id'            => 'featured_swatch_height',
                    'type'          => 'dimensions',
                    'title'         => esc_html__('Swatch Minimum Height', 'swatchly-pro'),
                    'desc'          => esc_html__('Default: 33px', 'swatchly-pro'),
                    'width'         => false,
                    'height_icon'   => '',
                    'units'         => array( 'px' ),
                    'output'        => '.variations_form:not(.swatchly_loop_variation_form) .swatchly-featured  .swatchly-swatch',
                    'output_prefix' => 'min',
                    'dependency'    => array('enable_featured_attribute', '==', '1')
                ),
            )
        ));

        // Design
        \CSF::createSection( $prefix, array(
            'id'    => 'design',
            'title' => esc_html__( 'Design', 'swatchly-pro' ),
            'icon'  => 'fas fa-eye-dropper',
        ) );

        // Single product design options
        \CSF::createSection( $prefix, array(
            'parent' => 'design',
            'id'     => 'sp_design',
            'title'  => esc_html__( 'For Swatches', 'swatchly-pro' ),
            'fields' => array(
                // sp_design_tab
                array(
                    'id'    => 'sp_design_tab',
                    'type'  => 'tabbed',
                    'title' => esc_html__('Customize Swatches', 'swatchly-pro'),
                    'after' => esc_html__('These customizations will be applied for the swatches which is located in "Single Product" and "Product List" Page.', 'swatchly-pro'),
                    'tabs'  => array(
                        array(
                            'title'  => esc_html__('Normal','swatchly-pro'),
                            'fields' => array(
                                // sp_swatch_text_color
                                array(
                                    'id'         => 'sp_swatch_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Text Color', 'swatchly-pro'),
                                    'output'     => '.swatchly-content .swatchly-text'
                                ),
                                // sp_swatch_text_font_size
                                array(
                                    'id'         => 'sp_swatch_text_font_size',
                                    'type'       => 'number',
                                    'title'      => esc_html__('Swatch Text Font Size', 'swatchly-pro'),
                                    'unit'       => 'px',
                                    'output'     => '.swatchly-swatch',
                                    'output_mode' => 'font-size'
                                ),
                                array(
                                    'id'         => 'sp_swatch_text_line_height',
                                    'type'       => 'number',
                                    'title'      => esc_html__('Swatch Text Line Height', 'swatchly-pro'),
                                    'unit'       => 'px',
                                    'output'     => '.swatchly-swatch',
                                    'output_mode' => 'line-height'
                                ),
                                // sp_swatch_bg_color
                                array(
                                    'id'         => 'sp_swatch_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Background Color', 'swatchly-pro'),
                                    'output'     => '.swatchly-swatch',
                                    'output_mode'=> 'background-color'
                                ),
                                // sp_swatch_border
                                array(
                                    'id'         => 'sp_swatch_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Swatch Border', 'swatchly-pro'),
                                    'output'     => '.swatchly-swatch',
                                    'all'        => true
                                ),
                                array(
                                    'type'       => 'submessage',
                                    'content'    => __( '<strong>Radio</strong><br>Customize the radio selector of the "Radio" type swatch.', 'swatchly-pro'),
                                ),

                                // sp_swatch_radio_bg_color
                                array(
                                    'id'         => 'sp_swatch_radio_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Background Color', 'swatchly-pro'),
                                    'output'     => '.swatchly-type-radio',
                                    'output_mode'=> '--bg'
                                ),

                                // sp_swatch_radio_border
                                array(
                                    'id'         => 'sp_swatch_radio_border',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Border Color', 'swatchly-pro'),
                                    'output'     => '.swatchly-type-radio',
                                    'output_mode'=> '--border'
                                ),

                                array(
                                    'type'       => 'submessage',
                                    'content'    => __( '<strong>Margin & Padding</strong> <br> Swatch Item -> represents each individual swatch item. <br> Swatches Wrapper -> represents the container for the group of swatches.', 'swatchly-pro'),
                                ),
                                // sp_swatch_item_margin
                                array(
                                    'id'          => 'sp_swatch_item_margin',
                                    'type'        => 'spacing',
                                    'title'       => esc_html__('Swatch Item Margin', 'swatchly-pro'),
                                    'output'      => '.swatchly-swatch',
                                    'output_mode' => 'margin',
                                    'top_icon'    => '',
                                    'right_icon'  => '',
                                    'bottom_icon' => '',
                                    'left_icon'   => '',
                                ),
                                // sp_swatch_item_padding
                                array(
                                    'id'          => 'sp_swatch_item_padding',
                                    'type'        => 'spacing',
                                    'title'       => esc_html__('Swatch Item Padding', 'swatchly-pro'),
                                    'output'      => '.swatchly-swatch',
                                    'output_mode' => 'padding',
                                    'top_icon'    => '',
                                    'right_icon'  => '',
                                    'bottom_icon' => '',
                                    'left_icon'   => '',
                                ),
                                // sp_swatches_wrapper_margin
                                array(
                                    'id'          => 'sp_swatches_wrapper_margin',
                                    'type'        => 'spacing',
                                    'title'       => esc_html__('Swatches Wrapper Margin', 'swatchly-pro'),
                                    'output'      => '.swatchly-type-wrap',
                                    'output_mode' => 'margin',
                                    'top_icon'    => '',
                                    'right_icon'  => '',
                                    'bottom_icon' => '',
                                    'left_icon'   => '',
                                ),
                                // sp_swatches_wrapper_padding
                                array(
                                    'id'          => 'sp_swatches_wrapper_padding',
                                    'type'        => 'spacing',
                                    'title'       => esc_html__('Swatches Wrapper Padding', 'swatchly-pro'),
                                    'output'      => '.swatchly-type-wrap',
                                    'output_mode' => 'padding',
                                    'top_icon'    => '',
                                    'right_icon'  => '',
                                    'bottom_icon' => '',
                                    'left_icon'   => '',
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Hover','swatchly-pro'),
                            'fields' => array(
                                // sp_swatch_hover_text_color
                                array(
                                    'id'         => 'sp_swatch_hover_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Text Color', 'swatchly-pro'),
                                    'output'     => array(
                                        '.swatchly-swatch:hover .swatchly-content .swatchly-text',
                                        '.swatchly-selected .swatchly-content .swatchly-text',
                                    ),
                                ),
                                // sp_swatch_hover_bg_color
                                array(
                                    'id'         => 'sp_swatch_hover_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Background Color', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly-swatch:hover',
                                        '.swatchly-swatch.swatchly-selected',
                                    ),
                                    'output_mode'=> 'background-color'
                                ),
                                // sp_swatch_hover_border
                                array(
                                    'id'         => 'sp_swatch_hover_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Swatch Border', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly-swatch:hover',
                                        '.swatchly-swatch.swatchly-selected',
                                    ),
                                    'all'        => true
                                ),

                                array(
                                    'type'       => 'submessage',
                                    'content'    => __( '<strong>Radio</strong><br>Customize the radio selector of the "Radio" type swatch.', 'swatchly-pro'),
                                ),

                                // sp_swatch_radio_selected_color
                                array(
                                    'id'         => 'sp_swatch_radio_hover_border',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Border Color', 'swatchly-pro'),
                                    'output'     => '.swatchly-type-radio',
                                    'output_mode'=> '--hover'
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Selected','swatchly-pro'),
                            'fields' => array(
                                // sp_swatch_selected_text_color
                                array(
                                    'id'         => 'sp_swatch_selected_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Text Color', 'swatchly-pro'),
                                    'output'     => array(
                                        '.swatchly-selected .swatchly-content .swatchly-text',
                                    )
                                ),
                                // sp_swatch_selected_bg_color
                                array(
                                    'id'         => 'sp_swatch_selected_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Background Color', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly-swatch.swatchly-selected',
                                    ),
                                    'output_mode'=> 'background-color'
                                ),
                                // sp_swatch_selected_border
                                array(
                                    'id'         => 'sp_swatch_selected_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Swatch Border', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly-swatch.swatchly-selected',
                                    ),
                                    'all'        => true
                                ),

                                array(
                                    'type'       => 'submessage',
                                    'content'    => __( '<strong>Radio</strong><br>Customize the radio selector of the "Radio" type swatch.', 'swatchly-pro'),
                                ),

                                // sp_swatch_radio_selected_color
                                array(
                                    'id'         => 'sp_swatch_radio_selected_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Color', 'swatchly-pro'),
                                    'output'     => '.swatchly-type-radio',
                                    'output_mode'=> '--active'
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Disabled','swatchly-pro'),
                            'fields' => array(
                                // sp_swatch_disabled_text_color
                                array(
                                    'id'         => 'sp_swatch_disabled_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Text Color', 'swatchly-pro'),
                                    'output'     => array(
                                        '.swatchly-disabled .swatchly-content .swatchly-text',
                                    )
                                ),
                                // sp_swatch_disabled_bg_color
                                array(
                                    'id'         => 'sp_swatch_disabled_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Background Color', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly-swatch.swatchly-disabled',
                                    ),
                                    'output_mode'=> 'background-color'
                                ),
                                // sp_swatch_disabled_border
                                array(
                                    'id'         => 'sp_swatch_disabled_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Swatch Border', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly-swatch.swatchly-disabled',
                                    ),
                                    'all'        => true
                                ),
                            ),
                        ),
                    ),
                ),
                // pl_design_tab
                array(
                    'id'    => 'pl_design_tab',
                    'type'  => 'tabbed',
                    'title' => esc_html__('Customize Swatches (Product List)', 'swatchly-pro'),
                    'after' => esc_html__('These customizations will be applied only for the "Product List" page\'s swatches.', 'swatchly-pro'),
                    'tabs'  => array(
                        array(
                            'title'  => esc_html__('Normal','swatchly-pro'),
                            'fields' => array(
                                // pl_swatch_text_color
                                array(
                                    'id'         => 'pl_swatch_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Text Color', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-content .swatchly-text'
                                ),
                                // pl_swatch_bg_color
                                array(
                                    'id'         => 'pl_swatch_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Background Color', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch',
                                    'output_mode'=> 'background-color'
                                ),
                                // pl_swatch_border
                                array(
                                    'id'         => 'pl_swatch_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Swatch Border', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch',
                                    'all'        => true
                                ),
                                array(
                                    'type'       => 'submessage',
                                    'content'     => __( '<strong>Margin & Padding</strong> <br> Swatch Item -> represents each individual swatch item. <br> Swatches Wrapper -> represents the container for the group of swatches.', 'swatchly-pro'),
                                ),
                                // pl_swatch_item_margin
                                array(
                                    'id'          => 'pl_swatch_item_margin',
                                    'type'        => 'spacing',
                                    'title'       => esc_html__('Swatch Item Margin', 'swatchly-pro'),
                                    'output'      => '.swatchly_loop_variation_form .swatchly-swatch',
                                    'output_mode' => 'margin',
                                    'top_icon'    => '',
                                    'right_icon'  => '',
                                    'bottom_icon' => '',
                                    'left_icon'   => '',
                                ),
                                // pl_swatch_item_padding
                                array(
                                    'id'          => 'pl_swatch_item_padding',
                                    'type'        => 'spacing',
                                    'title'       => esc_html__('Swatch Item Padding', 'swatchly-pro'),
                                    'output'      => '.swatchly_loop_variation_form .swatchly-swatch',
                                    'output_mode' => 'padding',
                                    'top_icon'    => '',
                                    'right_icon'  => '',
                                    'bottom_icon' => '',
                                    'left_icon'   => '',
                                ),
                                // pl_swatches_wrapper_margin
                                array(
                                    'id'          => 'pl_swatches_wrapper_margin',
                                    'type'        => 'spacing',
                                    'title'       => esc_html__('Swatches Wrapper Margin', 'swatchly-pro'),
                                    'output'      => '.swatchly_loop_variation_form .swatchly-type-wrap',
                                    'output_mode' => 'margin',
                                    'top_icon'    => '',
                                    'right_icon'  => '',
                                    'bottom_icon' => '',
                                    'left_icon'   => '',
                                ),
                                // pl_swatches_wrapper_padding
                                array(
                                    'id'          => 'pl_swatches_wrapper_padding',
                                    'type'        => 'spacing',
                                    'title'       => esc_html__('Swatches Wrapper Padding', 'swatchly-pro'),
                                    'output'      => '.swatchly_loop_variation_form .swatchly-type-wrap',
                                    'output_mode' => 'padding',
                                    'top_icon'    => '',
                                    'right_icon'  => '',
                                    'bottom_icon' => '',
                                    'left_icon'   => '',
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Hover','swatchly-pro'),
                            'fields' => array(
                                // pl_swatch_hover_text_color
                                array(
                                    'id'         => 'pl_swatch_hover_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Text Color', 'swatchly-pro'),
                                    'output'     => array(
                                        '.swatchly_loop_variation_form .swatchly-swatch:hover .swatchly-content .swatchly-text',
                                        '.swatchly_loop_variation_form .swatchly-selected .swatchly-content .swatchly-text',
                                    )
                                ),
                                // pl_swatch_hover_bg_color
                                array(
                                    'id'         => 'pl_swatch_hover_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Background Color', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly_loop_variation_form .swatchly-swatch:hover',
                                        '.swatchly_loop_variation_form .swatchly-swatch.swatchly-selected',
                                    ),
                                    'output_mode'=> 'background-color'
                                ),
                                // pl_swatch_hover_border
                                array(
                                    'id'         => 'pl_swatch_hover_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Swatch Border', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly_loop_variation_form .swatchly-swatch:hover',
                                        '.swatchly_loop_variation_form .swatchly-swatch.swatchly-selected',
                                    ),
                                    'all'        => true
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Selected','swatchly-pro'),
                            'fields' => array(
                                // pl_swatch_selected_text_color
                                array(
                                    'id'         => 'pl_swatch_selected_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Text Color', 'swatchly-pro'),
                                    'output'     => array(
                                        '.swatchly_loop_variation_form .swatchly-selected .swatchly-content .swatchly-text',
                                    )
                                ),
                                // pl_swatch_selected_bg_color
                                array(
                                    'id'         => 'pl_swatch_selected_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Background Color', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly_loop_variation_form .swatchly-swatch.swatchly-selected',
                                    ),
                                    'output_mode'=> 'background-color'
                                ),
                                // pl_swatch_selected_border
                                array(
                                    'id'         => 'pl_swatch_selected_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Swatch Border', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly_loop_variation_form .swatchly-swatch.swatchly-selected',
                                    ),
                                    'all'        => true
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Disabled','swatchly-pro'),
                            'fields' => array(
                                // pl_swatch_disabled_text_color
                                array(
                                    'id'         => 'pl_swatch_disabled_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Text Color', 'swatchly-pro'),
                                    'output'     => array(
                                        '.swatchly_loop_variation_form .swatchly-disabled .swatchly-content .swatchly-text',
                                    )
                                ),
                                // pl_swatch_disabled_bg_color
                                array(
                                    'id'         => 'pl_swatch_disabled_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Swatch Background Color', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly_loop_variation_form .swatchly-swatch.swatchly-disabled',
                                    ),
                                    'output_mode'=> 'background-color'
                                ),
                                // pl_swatch_disabled_border
                                array(
                                    'id'         => 'sp_swatch_disabled_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Swatch Border', 'swatchly-pro'),
                                    'output'     => array( 
                                        '.swatchly_loop_variation_form .swatchly-swatch.swatchly-disabled',
                                    ),
                                    'all'        => true
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ) );

        // Single product design options
        \CSF::createSection( $prefix, array(
            'parent' => 'design',
            'id'     => 'pl_design',
            'title'  => esc_html__( 'For Tooltip', 'swatchly-pro' ),
            'fields' => array(

                array(
                    'id'    => 'sp_tooltip_design_tab',
                    'type'  => 'tabbed',
                    'title' => esc_html__('Tooltip Customize', 'swatchly-pro'),
                    'after' => esc_html__('These customizations will be applied for the swatches which is located in "Single Product" and "Product List" Page.', 'swatchly-pro'),
                    'tabs'  => array(
                        array(
                            'title'  => esc_html__('Tooltip','swatchly-pro'),
                            'fields' => array(
                                // sp_tooltip_width.
                                array(
                                    'id'         => 'sp_tooltip_width',
                                    'type'       => 'dimensions',
                                    'title'      => esc_html__('Tooltip Width', 'swatchly-pro'),
                                    'height'     => false,
                                    'width_icon' => '',
                                    'output'     => '.swatchly-swatch .swatchly-tooltip',
                                ),
                                // sp_tooltip_max_width
                                array(
                                    'id'         => 'sp_tooltip_max_width',
                                    'type'       => 'dimensions',
                                    'title'      => esc_html__('Tooltip Maximum Width', 'swatchly-pro'),
                                    'height'     => false,
                                    'width_icon' => '',
                                    'output'     => '.swatchly-swatch .swatchly-tooltip',
                                    'output_prefix' => 'max',
                                ),
                                // sp_tooltip_bg_color
                                array(
                                    'id'         => 'sp_tooltip_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Tooltip Background Color', 'swatchly-pro'),
                                    'output'     => '.swatchly-swatch .swatchly-tooltip',
                                    'output_mode' => 'background-color'
                                ),
                                // sp_tooltip_border
                                array(
                                    'id'         => 'sp_tooltip_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Tooltip Border', 'swatchly-pro'),
                                    'output'     => '.swatchly-swatch .swatchly-tooltip',
                                    'all'        => true
                                ),
                                // sp_tooltip_spacing
                                array(
                                    'id'          => 'sp_tooltip_spacing',
                                    'type'        => 'spinner',
                                    'title'       => esc_html__('Tooltip Spacing', 'swatchly-pro'),
                                    'desc'        => esc_html__('Control the spacing between swatch item & tooltip. Default: 130%', 'swatchly-pro'),
                                    'unit'        => '%',
                                    'min'         => '-100',
                                    'max'         => '100',
                                    'output'      => '.swatchly-swatch .swatchly-tooltip',
                                    'output_mode' => 'bottom',
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Tooltip Text','swatchly-pro'),
                            'fields' => array(
                                // sp_tooltip_text_color
                                array(
                                    'id'         => 'sp_tooltip_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Tooltip Text Color', 'swatchly-pro'),
                                    'output'     => '.swatchly-swatch .swatchly-tooltip',
                                ),
                                // sp_tooltip_text_font_size
                                array(
                                    'id'         => 'sp_tooltip_text_font_size',
                                    'type'       => 'number',
                                    'title'      => esc_html__('Tooltip Text Font Size', 'swatchly-pro'),
                                    'unit'       => 'px',
                                    'output'     => '.swatchly-swatch .swatchly-tooltip-text',
                                    'output_mode' => 'font-size'
                                ),
                                // sp_tooltip_text_line_height
                                array(
                                    'id'         => 'sp_tooltip_text_line_height',
                                    'type'       => 'number',
                                    'title'      => esc_html__('Tooltip Text Line Height', 'swatchly-pro'),
                                    'unit'       => 'px',
                                    'output'     => '.swatchly-swatch .swatchly-tooltip-text',
                                    'output_mode' => 'line-height'
                                ),
                                // sp_tooltip_text_padding
                                array(
                                    'id'         => 'sp_tooltip_text_padding',
                                    'type'       => 'spacing',
                                    'title'      => esc_html__('Tooltip Text Padding', 'swatchly-pro'),
                                    'output'     => '.swatchly-swatch .swatchly-tooltip-text',
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Tooltip Arrow','swatchly-pro'),
                            'fields' => array(
                                // sp_tooltip_arrow_color
                                array(
                                    'id'         => 'sp_tooltip_arrow_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Tooltip Arrow Color', 'swatchly-pro'),
                                    'output'     => '.swatchly-swatch .swatchly-tooltip::after',
                                    'output_mode' => 'border-left-color'
                                ),
                                // sp_tooltip_arrow_size
                                array(
                                    'id'         => 'sp_tooltip_arrow_size',
                                    'type'       => 'number',
                                    'unit'       => 'px',
                                    'title'      => esc_html__('Tooltip Arrow Size', 'swatchly-pro'),
                                    'output'     => '.swatchly-swatch .swatchly-tooltip::after',
                                    'output_mode' => 'border-width'
                                ),
                                // sp_tooltip_arrow_spacing
                                array(
                                    'id'          => 'sp_tooltip_arrow_spacing',
                                    'type'        => 'spinner',
                                    'title'       => esc_html__('Tooltip Arrow Spacing', 'swatchly-pro'),
                                    'desc'        => esc_html__('Minus value is also allowed.', 'swatchly-pro'),
                                    'unit'        => 'px',
                                    'min'         => '-100',
                                    'max'         => '100',
                                    'output'      => '.swatchly-swatch .swatchly-tooltip::after',
                                    'output_mode' => 'bottom'
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Tooltip Image','swatchly-pro'),
                            'fields' => array(
                                // sp_tooltip_image_border
                                array(
                                    'id'         => 'sp_tooltip_image_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Tooltip Image Border', 'swatchly-pro'),
                                    'output'     => '.swatchly-swatch .swatchly-tooltip img',
                                    'all'        => true
                                ),
                            ),
                        ),
                    ),
                ),

                array(
                    'id'    => 'pl_tooltip_design_tab',
                    'type'  => 'tabbed',
                    'title' => esc_html__('Tooltip Customize (Product List)', 'swatchly-pro'),
                    'after' => esc_html__('These customizations will be applied only for the "Product List" page\'s swatches.', 'swatchly-pro'),
                    'tabs'  => array(
                        array(
                            'title'  => esc_html__('Tooltip','swatchly-pro'),
                            'fields' => array(
                                // pl_tooltip_width.
                                array(
                                    'id'         => 'pl_tooltip_width',
                                    'type'       => 'dimensions',
                                    'title'      => esc_html__('Tooltip Width', 'swatchly-pro'),
                                    'height'     => false,
                                    'width_icon' => '',
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip',
                                ),
                                // pl_tooltip_max_width
                                array(
                                    'id'         => 'pl_tooltip_max_width',
                                    'type'       => 'dimensions',
                                    'title'      => esc_html__('Tooltip Maximum Width', 'swatchly-pro'),
                                    'height'     => false,
                                    'width_icon' => '',
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip',
                                    'output_prefix' => 'max',
                                ),
                                // pl_tooltip_bg_color
                                array(
                                    'id'         => 'pl_tooltip_bg_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Tooltip Background Color', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip',
                                    'output_mode' => 'background-color'
                                ),
                                // pl_tooltip_border
                                array(
                                    'id'         => 'pl_tooltip_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Tooltip Border', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip',
                                    'all'        => true
                                ),
                                // pl_tooltip_spacing
                                array(
                                    'id'          => 'pl_tooltip_spacing',
                                    'type'        => 'spinner',
                                    'title'       => esc_html__('Tooltip Spacing', 'swatchly-pro'),
                                    'desc'        => esc_html__('Control the spacing between swatch item & tooltip. Default: 130%', 'swatchly-pro'),
                                    'unit'        => '%',
                                    'min'         => '-100',
                                    'max'         => '100',
                                    'output'      => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip',
                                    'output_mode' => 'bottom',
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Tooltip Text','swatchly-pro'),
                            'fields' => array(
                                // sp_tooltip_text_color
                                array(
                                    'id'         => 'sp_tooltip_text_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Tooltip Text Color', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip',
                                ),
                                // sp_tooltip_text_font_size
                                array(
                                    'id'         => 'sp_tooltip_text_font_size',
                                    'type'       => 'number',
                                    'title'      => esc_html__('Tooltip Text Font Size', 'swatchly-pro'),
                                    'unit'       => 'px',
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip-text',
                                    'output_mode' => 'font-size'
                                ),
                                // sp_tooltip_text_line_height
                                array(
                                    'id'         => 'sp_tooltip_text_line_height',
                                    'type'       => 'number',
                                    'title'      => esc_html__('Tooltip Text Line Height', 'swatchly-pro'),
                                    'unit'       => 'px',
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip-text',
                                    'output_mode' => 'line-height'
                                ),
                                // sp_tooltip_text_padding
                                array(
                                    'id'         => 'sp_tooltip_text_padding',
                                    'type'       => 'spacing',
                                    'title'      => esc_html__('Tooltip Text Padding', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip-text',
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Tooltip Arrow','swatchly-pro'),
                            'fields' => array(
                                // sp_tooltip_arrow_color
                                array(
                                    'id'         => 'sp_tooltip_arrow_color',
                                    'type'       => 'color',
                                    'title'      => esc_html__('Tooltip Arrow Color', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip::after',
                                    'output_mode' => 'border-left-color'
                                ),
                                // sp_tooltip_arrow_size
                                array(
                                    'id'         => 'sp_tooltip_arrow_size',
                                    'type'       => 'number',
                                    'unit'       => 'px',
                                    'title'      => esc_html__('Tooltip Arrow Size', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip::after',
                                    'output_mode' => 'border-width'
                                ),
                                // sp_tooltip_arrow_spacing
                                array(
                                    'id'          => 'sp_tooltip_arrow_spacing',
                                    'type'        => 'spacing',
                                    'title'       => esc_html__('Tooltip Arrow Spacing', 'swatchly-pro'),
                                    'desc'        => esc_html__('Minus value is also allowed.', 'swatchly-pro'),
                                    'top'         => false,
                                    'left'        => false,
                                    'right'       => false,
                                    'output'      => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip::after',
                                    'output_mode' => 'bottom'
                                ),
                            ),
                        ),
                        array(
                            'title'  => esc_html__('Tooltip Image','swatchly-pro'),
                            'fields' => array(
                                // sp_tooltip_image_border
                                array(
                                    'id'         => 'sp_tooltip_image_border',
                                    'type'       => 'border',
                                    'title'      => esc_html__('Tooltip Image Border', 'swatchly-pro'),
                                    'output'     => '.swatchly_loop_variation_form .swatchly-swatch .swatchly-tooltip img',
                                    'all'        => true
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ) );

        // Other Options
        \CSF::createSection( $prefix, array(
            'icon'  => 'fas fa-wrench',
            'title'  => esc_html__( 'Other Settings', 'swatchly-pro' ),
            'fields' => array(
                // disable_plugin
                array(
                    'id'    => 'disable_plugin',
                    'type'  => 'checkbox',
                    'title' => esc_html__('Disable Plugin', 'swatchly-pro'),
                    'label' => esc_html__('If you check this option. This plugin will stop working until you uncheck this.', 'swatchly-pro'),
                ),
                // backup
                array(
                    'id'    => 'backup',
                    'title' => esc_html__('Import / Export Settings', 'swatchly-pro'),
                    'type'  => 'backup',
                ),
            )
        ) );

    }

}