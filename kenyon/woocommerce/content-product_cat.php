<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;
?>
<div class="col-md-6 col-sm-6 box <?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 )
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	?>">

    <div class="category-block">

        <?php do_action( 'woocommerce_before_subcategory', $category ); ?>

        <strong class="title">
            <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
                <?php echo $category->name; ?>
            </a>
        </strong>
        <div class="holder">
            <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
                <?php woocommerce_subcategory_thumbnail($category) ?>
            </a>
        </div>

        <?php do_action( 'woocommerce_after_subcategory', $category ); ?>
    </div>
</div>