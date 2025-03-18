<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
global $wt_wishlist_table_settings_options;
$wishlist_text = apply_filters('wishlist_table_heading','Products added in my wishlist');
?>
<h4><?php esc_html_e($wishlist_text, 'wt-woocommerce-wishlist'); ?></h4>
<?php if ($products) { ?>
    <form action="">
        <?php if(isset($wt_wishlist_table_settings_options['add_all_to_cart'])==1){
            $redirect_to_cart = isset($wt_wishlist_table_settings_options['redirect_to_cart']) ? $wt_wishlist_table_settings_options['redirect_to_cart'] : '';
        ?>
        <button id="bulk-add-to-cart" data-redirect_to_cart="<?php esc_attr_e($redirect_to_cart); ?>" class="button" style="background: #2EA3F2;border-radius: 5px;color: white;border: none;padding: 10px 18px; float: right; margin-bottom: 20px;"> <?php esc_html_e('Add all to cart', 'wt-woocommerce-wishlist'); ?></button>
        <?php } ?>
        <table class="wt_frontend_wishlist_table" >
            <tr>
                <th></th>
                <th colspan="2" ><?php esc_html_e('Product name', 'wt-woocommerce-wishlist'); ?></th> 
                <?php if(isset($wt_wishlist_table_settings_options['wt_enable_unit_price_column'])==1){ ?> <th><?php esc_html_e('Unit price', 'wt-woocommerce-wishlist'); ?></th> <?php } ?>
                <?php if(isset($wt_wishlist_table_settings_options['wt_enable_wishlisted_date_column']) && $wt_wishlist_table_settings_options['wt_enable_wishlisted_date_column'] ==1){ ?> <th><?php esc_html_e('Added on', 'wt-woocommerce-wishlist'); ?></th> <?php } ?>
                <?php if(isset($wt_wishlist_table_settings_options['wt_enable_stock_status_column'])==1){ ?> <th><?php esc_html_e('Stock', 'wt-woocommerce-wishlist'); ?></th> <?php } ?>
                <?php if(isset($wt_wishlist_table_settings_options['wt_enable_add_to_cart_option_column'])==1){ ?> <th></th> <?php } ?>
            </tr>
            <?php
            foreach ($products as $product) {
                $product_data = wc_get_product($product['product_id']);
                if ($product_data) {
                    ?>
                    <tr>
                        <td>
                            <?php  $icon_url = WEBTOFFEE_WISHLIST_BASEURL .'public/images/delete_icon.png';
                            ?>
                    <center><div > <a href='#' > <i class='remove_wishlist_single'  data-product_id="<?php echo absint( $product['product_id'] ); ?>" data-variation_id="<?php echo absint( $product['variation_id'] ); ?>" data-product_type="<?php echo $product_data->is_type( 'variable' ); ?>"  ><img src='<?php echo esc_url($icon_url); ?>'></i> </a></div></center>
                        </td>
                        <td style="width:11%;"><?php 
                            if($product_data->is_type( 'variable' )){
                                if($product['variation_id'] !=0){
                                    $product_data = wc_get_product($product['variation_id']);
                                }
                            }
                            echo $product_data->get_image('woocommerce_gallery_thumbnail'); ?> 
                        </td>
                        <td> <a href="<?php echo esc_url( $product_data->get_permalink() ); ?>"><?php esc_html_e( $product_data->get_title() );  ?></a>
                            <?php 
                            if( (isset($wt_wishlist_table_settings_options['wt_enable_product_variation_column'])==1) && $product_data->is_type( 'variation' ) ){ 
                              echo wc_get_formatted_variation( $product_data );
                            }
                            ?>  
                        </td>
                        <?php if(isset($wt_wishlist_table_settings_options['wt_enable_unit_price_column'])==1){ ?>
                        <td>
                            <?php 
                            $base_price = $product_data->is_type( 'variable' ) ? $product_data->get_variation_regular_price( 'max' ) : $product_data->get_price();
                            echo $product_data->get_price_html().' ('. get_woocommerce_currency().')'; ?>
                       </td>
                        <?php } ?>
                        <?php if(isset($wt_wishlist_table_settings_options['wt_enable_wishlisted_date_column'])&& $wt_wishlist_table_settings_options['wt_enable_wishlisted_date_column'] ==1){ ?>  
                        <td>
                            <?php echo date_i18n('F j, Y', strtotime($product['date'])) ; ?>
                        </td> 
                        <?php } ?>
                        <?php if(isset($wt_wishlist_table_settings_options['wt_enable_stock_status_column'])==1){ ?>  
                        <td><?php
                            if ($product_data->is_in_stock() == 1) {
                                $instock = esc_html__('In Stock', 'wt-woocommerce-wishlist');
                                echo "<div class='stock_column' style='background: rgba(0, 206, 45, 0.1); border-radius: 40px; padding: 4px 0px;width: 82px; height: 31px;'><span style='color: #00CE2D;'><center style='font-size: 14px;'> $instock </center></span></div>";
                                // echo "<span style=\"color: red\">$instock</span>";
                            } else {
                                $outstock = esc_html__('Out of Stock', 'wt-woocommerce-wishlist');
                                echo "<span style=\"color: red\">$outstock</span>";
                            };
                            ?>
                        </td>
                        <?php } ?>
                        <?php if(isset($wt_wishlist_table_settings_options['wt_enable_add_to_cart_option_column'])==1){ 
                            $id = ($product_data->is_type( 'variation' )) ? $product['variation_id'] : $product['product_id'] ;
                            $redirect_to_cart = isset($wt_wishlist_table_settings_options['redirect_to_cart']) ? $wt_wishlist_table_settings_options['redirect_to_cart'] : '';
                        ?>  
                        <td style="padding: 7px !important">
                            <button  class="button single-add-to-cart" data-product_id="<?php esc_attr_e($id); ?>" data-redirect_to_cart="<?php esc_attr_e($redirect_to_cart); ?>" style="background: #2EA3F2;border-radius: 5px;color: white;border: none;padding: 10px 18px;font-size: 11px;width: 120px"> <?php ( ! empty($wt_wishlist_table_settings_options['wt_add_to_cart_text']) ? esc_html_e($wt_wishlist_table_settings_options['wt_add_to_cart_text'], 'wt-woocommerce-wishlist')  :  esc_html_e('Add to cart', 'wt-woocommerce-wishlist') ); ?></button>
                        </td>
                        <?php } ?>
                    </tr>
                <?php
                }
            }
            ?>
        </table>
    </form>
<?php } else { ?>
<h3 style="text-align: center"><?php esc_html_e('No Wishlists yet!', 'wt-woocommerce-wishlist'); ?></h3>
<?php } ?>

<?php 

/**
 * 
 * @since 2.0.8
 * 
 * Compatability with in Twenty-Twenty-Two & Twenty-Twenty-Three Themes
 * 
 */

if(strstr(wp_get_theme()->get('Name'),'Twenty Twenty-Two') || strstr(wp_get_theme()->get('Name'),'Twenty Twenty-Three')  )
{
    
    if(is_cart())
    {
        ?>

        <style>
            .woocommerce .quantity input[type=number] { width: 5em !important;  }

        </style>
        <?php
    }
    ?>

    <style>
        .wt_frontend_wishlist_table td{  padding: 10px; }
        .wt_frontend_wishlist_table { padding: 10px; }

    </style>

    <?php

} 

?>

