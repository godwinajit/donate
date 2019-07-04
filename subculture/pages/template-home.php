<?php

/*
Template Name: Home Template
*/

theme_wrapper_class('home');

get_header(); ?>

 
<?php get_template_part('blocks/home/slider') ?>

<?php get_template_part('blocks/home/preview-boxes') ?>


<?php get_footer(); ?>