<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.6.0
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
<div class="row two-col-products-item">

    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <div class="col-md-12 col-sm-12">
        <div class="meta-block clearfix">
                <div class="title-section-product">
                    <h3>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
            </div>
            <div class=" title-icons-cat">
                <?php get_template_part('blocks/shop/product-destination') ?>
            </div>
            </div>

        <div class="image-block">
            <div class="holder">
                <a href="<?php the_permalink(); ?>">
                    <?php woocommerce_template_loop_product_thumbnail() ?>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="product-info">
            
            <p><?php echo theme_excerpt() ?></p>
            <?php woocommerce_template_loop_price() ?>
            <a class="btn btn-default btn-block" href="<?php the_permalink(); ?>"><?php _e('View details', 'kenyon') ?></a>
        </div>
    </div>

    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>