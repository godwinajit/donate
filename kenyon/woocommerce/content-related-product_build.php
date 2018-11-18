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

global $product, $woocommerce_loop;

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

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

<div class="image-block">
    <div class="holder">
        <a href="<?php the_permalink(); ?>" target="_blank">
            <?php woocommerce_template_loop_product_thumbnail() ?>
        </a>
    </div>
</div>

<h3>
    <a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
</h3>

<p>
	<!-- Hide Explode View Option -->
	<div style="display:none;"><a href="#" class="view-explode">Explode view</a></div>
	<?php 	
		woocommerce_template_single_rating(); 
		get_template_part('blocks/shop/ajax-product-view360-link');
	?>
</p>

<p><?php echo theme_excerpt()//apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></p>

<p><?php woocommerce_template_loop_price() ?></p>

<a class="btn btn-default add_to_cart_button product_type_<?php echo $product->product_type;?>" target="_blank" href="<?php echo the_permalink().'?add-to-cart='. $product->id . getAddToCartUrl($product); ?>"><?php _e('Add to cart', 'kenyon') ?></a>

<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>


