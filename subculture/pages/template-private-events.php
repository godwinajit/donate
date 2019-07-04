<?php

/*
Template Name: Private Events Template
*/


get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
	<div class="showcase-section">
        <div class="main-text">
            <?php echo apply_filters('the_content',get_field('header_text')); ?>
        </div>
        <?php query_posts('post_type=packages&showposts=-1'); ?>
        <?php if (have_posts()) : ?>
        <section class="container items">
            <div class="items-holder items">
                <div class="row">
                    <?php theme_print_each(); ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php theme_print_each(3, '</div><div class="row">'); ?>
                        <article class="item col-sm-4">
                            <div class="holder">
                                <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('package-post-thumbs-350x167') ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri() ?>/images/placeholder-350x167.png" alt="placeholder" width="350" height="167" />
                                <?php endif; ?>
                                <div class="item-content">
                                    <div class="heading">									
                                        <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                                    </div>
                                    <?php theme_the_excerpt(); ?>
                                    <div class="btn-holder">									
                                        <a href="<?php the_permalink() ?>" class="link-more">MORE INFO <span class="fa fa-chevron-right"></span></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>			
            </div>
        </section>
        <?php endif; wp_reset_query(); ?>
    </div>
</div>

<?php get_footer(); ?>