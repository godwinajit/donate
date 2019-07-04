<?php

theme_wrapper_class('contacts');
theme_header_title( __( 'Blog', 'subculture' ));

get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

    <div class="main-holder">
        <div class="container">
            <div class="row">
                <section class="contact-section">
                    <div class="col-sm-12">
                        <div class="boxes">
                            <?php if (have_posts()) : ?>

                                <?php while (have_posts()) : the_post(); ?>
                                    <?php get_template_part('blocks/content', get_post_type()); ?>
                                <?php endwhile; ?>

                                <?php get_template_part('blocks/pager'); ?>

                            <?php else : ?>
                                <?php get_template_part('blocks/not_found'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


<?php get_footer(); ?>