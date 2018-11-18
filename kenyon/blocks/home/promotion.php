<?php

$promotion_title = get_field('promotion_title');
$promotion_subtitle = get_field('promotion_sub_title');

$featured_query = new WP_Query(array(
    'post_type' => 'product',
    'meta_key' => '_featured',
    'meta_value' => 'yes',
    'posts_per_page' => 1
));

?>
<?php if ($featured_query->have_posts()) : ?>

    <?php while ($featured_query->have_posts()) :
        $featured_query->the_post();
        $product = get_product( $featured_query->post->ID ); ?>

        <div class="promo-box promo-box-alt">
            <?php if ($promotion_title || $promotion_subtitle) : ?>
            <h2>
                <a href="<?php the_permalink(); ?>">
                    <?php if ($promotion_subtitle) : ?>
                        <span><?php echo $promotion_subtitle; ?></span> <br>
                    <?php endif; ?>
                    <?php if ($promotion_title) : ?>
                        <?php echo $promotion_title; ?>
                    <?php endif; ?>
                </a>
            </h2>
            <?php endif; ?>

            <div class="clearfix">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('shop_promotion'); ?>
                <?php elseif ( wc_placeholder_img_src() ) : ?>
                    <img src="<?php echo wc_placeholder_img_src() ?>" width="149" height="200" alt="thumbnail">
                <?php endif; ?>
                <div class="description">
                    <p><?php the_title(); ?></p>
                    <a class="btn btn-default" href="<?php the_permalink(); ?>"><?php _e('Shop now', 'kenyon') ;?></a>
                </div>
            </div>
        </div>

    <?php endwhile; ?>

<?php endif; ?>
<?php wp_reset_query(); ?>