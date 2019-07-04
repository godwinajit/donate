<?php

/*
Template Name: Contact Template
*/

theme_wrapper_class('contacts');

get_header(); ?>

<?php if (have_posts()) : the_post(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
    <div class="container">
        <div class="row">
            <section class="contact-section">
                <?php if ($map = get_field('map')) : ?>
                <div class="col-sm-5">
                    <div class="boxes">
                        <?php the_content() ?>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-offset-1">
                    <div class="map-box">
                        <?php echo $map; ?>
                    </div>
                </div>
                <?php else : ?>
                <div class="col-sm-12">
                    <div class="boxes">
                        <?php the_content() ?>
                    </div>
                </div>
                <?php endif; ?>
            </section>

            <?php get_template_part('blocks/contact/tabbed-content') ?>
        </div>
    </div>
</div>

<?php endif; ?>

<?php get_footer(); ?>