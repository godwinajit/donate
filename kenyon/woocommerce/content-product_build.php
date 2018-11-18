<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>


<div class="product-block clearfix">
    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <ul class="link-list">
         <?php get_template_part('blocks/shop/ajax-product-view360-link'); ?>
        <!-- Hide Explode View Option -->
        <li style="display:none;"><a href="#" class="view-explode">Explode view</a></li>
    </ul>
    <div class="img-box"><a href="<?php the_permalink() ?>" target="_blank"><?php woocommerce_template_loop_product_thumbnail() ?></a></div>
    <div class="text-block">
        <h3><a href="<?php the_permalink() ?>" target="_blank"><?php the_title(); ?></a></h3>
        <div class="meta-block">
            <?php woocommerce_template_single_rating() ?>
        </div>
        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
        <?php woocommerce_template_loop_price() ?>
		
        <?php  do_action( 'woocommerce_before_single_product_summary' ); ?>
		<?php do_action( 'woocommerce_single_product_summary' ); ?>
		<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
			
        <div class="btn-holder">
       		<a class="btn btn-default add_to_cart_button product_type_<?php echo $product->product_type;?>" data-product_id="<?php echo $product->id; ?>" href="<?php echo the_permalink().'?add-to-cart='. $product->id . getAddToCartUrl($product); ?>" target="_blank" class="btn btn-default"><?php _e('Add to cart', 'kenyon') ?></a>
        </div>
        
    </div>

    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
</div>