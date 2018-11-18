<?php

/*
Template Name: About Template
*/

wp_enqueue_script('kenyon-google-maps', 'http://maps.google.com/maps/api/js?v=3.exp&sensor=false&language=en', array('jquery'));

get_header(); ?>

<?php while (have_rows('content')) : the_row(); ?>
    <?php get_template_part('blocks/about/section', get_row_layout()) ?>
<?php endwhile; ?>

<?php get_footer(); ?>