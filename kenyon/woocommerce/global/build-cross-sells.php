<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop;

$meta_query = WC()->query->get_meta_query();

if (empty($cross_sells)) return;

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => -1,
	'orderby'             => 'rand',
	'post__in'            => $cross_sells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>

	<section class="related-products" style="background:none">
    	<div class="container">
        
            <div class="heading">
                <h2><?php _e('Here are some accessories for your grill', 'kenyon') ?></h2>
            </div>
            
            <div class="row">
            
            <?php woocommerce_product_loop_start(); ?>
        
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        
                    <div class="col-md-4 col-sm-4">
                        <?php woocommerce_get_template_part( 'content', 'related-product_build' ); ?>
                    </div>
                    
                <?php endwhile; // end of the loop. ?>
        
            <?php woocommerce_product_loop_end(); ?>
            
            </div>
		</div>
	</section>

<?php endif;

wp_reset_query();