<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

if (empty($product)) return;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

    <section class="related-products">
        <div class="container">
            <div class="row">

                <?php woocommerce_product_loop_start(); ?>

                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                        <div class="col-md-4 col-sm-4">
                            <?php wc_get_template_part( 'content', 'related-product' ); ?>
                        </div>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

            </div>
        </div>

	</section>

<?php endif;

wp_reset_postdata();
