<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(isset($_POST['ajax'])) {
    while ( have_posts() ) : the_post(); 
        wc_get_template_part( 'content', 'product' );
    endwhile; 
    
    woocommerce_pagination();
    
    die();
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

        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

            <!-- <h1 class="page-title"><?php woocommerce_page_title(); ?></h1> -->

        <?php endif; ?>
    </div>

        <?php get_template_part('blocks/shop/category-header-image') ?>
        
        <?php $category_top_content = get_field('category_top_content', 'product_cat_' . get_queried_object_id()); ?>
        <?php if($category_top_content): ?>
        <div class="container">
            <?php echo $category_top_content; ?>
        </div>
        <?php endif; ?>
        
        <?php do_action( 'woocommerce_archive_description' ); ?>

        <?php if ( have_posts() ) : ?>

            <?php
                /**
                 * woocommerce_before_shop_loop hook
                 *
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
            ?>

            <?php woocommerce_product_loop_start(); ?>

            <?php ob_start() ?>
            <?php woocommerce_product_subcategories(array(
                'before' => '<nav class="container category-nav"><div class="row">',
                'after' => '</div></nav>',
            )); ?>
            <?php $subcats_html = trim(ob_get_clean()) ?>
            <?php echo $subcats_html; ?>

            <?php if (empty($subcats_html)) : ?>
            <div id="two-columns">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 filter-results filter-results-heading  ">
                        <div class="heading">
                                    <?php woocommerce_catalog_ordering(); ?>
                                    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                                        <h2><?php woocommerce_page_title(); ?>  <span><?php woocommerce_result_count() ?> <?php _e('Products Match Your Selection', 'kenyon') ?></span></h2>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <div class="col-md-9 col-sm-9 col-sm-push-3">
                            <div class="filter-results same-height">
                                
                                <div class="sort-holder two-col-pro-wrapper">
                                    <?php while ( have_posts() ) : the_post(); ?>

                                        <?php wc_get_template_part( 'content', 'product' ); ?>

                                    <?php endwhile; // end of the loop. ?>

                                    <?php
                                    /**
                                     * woocommerce_after_shop_loop hook
                                     *
                                     * @hooked woocommerce_pagination - 10
                                     */
                                    do_action( 'woocommerce_after_shop_loop' );
                                    ?>

                                </div>
                                <a class="btn-top" href="#"><?php _e('back to top', 'kenyon'); ?></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-sm-pull-9">
                            <aside class="form-holder same-height">
                                <?php do_action( 'woocommerce_sidebar' ) ?>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <?php woocommerce_product_loop_end(); ?>
            
            <?php $category_bottom_content = get_field('category_bottom_content', 'product_cat_' . get_queried_object_id()); ?>
            <?php if($category_bottom_content): ?>
            <div class="container">
                <?php echo $category_bottom_content; ?>
            </div>
            <?php endif; ?>

        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

            <?php wc_get_template( 'loop/no-products-found.php' ); ?>

        <?php endif; ?>

    <?php
        /**
         * woocommerce_after_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
    ?>


<?php get_footer( 'shop' );