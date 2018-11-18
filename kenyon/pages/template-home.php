<?php
/*
Template Name: Home Template
*/
get_header(); ?>


<?php get_template_part('blocks/home/banner-hero'); ?>
<?php get_template_part('blocks/home/home-section-two'); ?>
<?php get_template_part('blocks/home/home-shop'); ?>


<section class="home-review">
    <div class="container">
        <div class="row">
        	<?php the_field('yotpo_review');?>
         </div>
    </div>
</section>
<?php get_template_part('blocks/home/home-build-grill'); ?>

<?php get_template_part('blocks/home/instagram-section'); ?>



<?php get_footer(); ?>