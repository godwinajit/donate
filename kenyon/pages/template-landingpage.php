<?php
/*
Template Name: Landing Page Template
*/
get_header('landing'); ?>



<?php get_template_part('blocks/lp/lp-hero'); ?>
<?php get_template_part('blocks/lp/lp-section-two'); ?>
<?php get_template_part('blocks/lp/lp-section-three'); ?>
<?php get_template_part('blocks/lp/best-recipes'); ?>
<?php get_template_part('blocks/lp/lp-video'); ?>

<?php get_template_part('blocks/lp/product-slider'); ?>


<?php get_footer('landing'); ?>