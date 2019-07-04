<?php

/*
Template Name: About Us Template
*/

theme_wrapper_class('about-us');

get_header(); ?>

<?php if (have_posts()) : the_post(); ?>

<?php get_template_part('blocks/header/header-image', 'about') ?>

<?php if (have_rows('content')) : ?>
<div class="main-holder">
    <div class="main-frame">
        <?php while (have_rows('content')) : the_row(); ?>
            <?php get_template_part('blocks/about/section', get_row_layout()) ?>
        <?php endwhile; ?>
    </div>
</div>
<?php endif; ?>


<?php endif; ?>

<?php get_footer(); ?>