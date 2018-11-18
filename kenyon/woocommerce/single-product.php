<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (isset($_GET['view360'])) {
	if($_GET['view360'] == 1 )get_template_part('blocks/shop/product-view360');
	else if($_GET['view360'] == 0 )get_template_part('blocks/shop/product-view360-video');
	return;
}

get_header( 'shop' ); ?>

        <div class="container">
            <?php
                /**
                 * woocommerce_before_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 */
                do_action( 'woocommerce_before_main_content' );
            ?>
        </div>

		<?php while ( have_posts() ) : the_post(); ?>

        <div class="product-holder">
            <div class="container">
                <div class="row" itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>">
			        <?php wc_get_template_part( 'content', 'single-product' ); ?>
                </div>
            </div>
        </div>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>