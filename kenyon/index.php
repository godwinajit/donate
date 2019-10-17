<?php 
	if (!defined('ABSPATH')) exit;
	get_header(); 
?>

<div class="container">
    <?php get_template_part('blocks/breadcrumbs'); ?>

    <?php if (is_home()) : ?>
    <h1><?php _e('Blog', 'kenyon') ?></h1>
    <?php endif; ?>
</div>

<?php if (!is_paged()) : ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8">
        <?php if (have_posts()) : the_post(); ?>
                <?php get_template_part('blocks/content-featured', get_post_type()); ?>
        <?php else : ?>
            <?php get_template_part('blocks/not_found'); ?>
        <?php endif; ?>
        </div>
        <div class="col-md-4 col-sm-4">
            <?php get_template_part('blocks/blogroll/featured-pages'); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (have_posts()) : theme_print_each(); ?>
<section class="related-posts">
    <div class="container">
        <div class="row">
            <?php while (have_posts()) : the_post() ; ?>
                <?php theme_print_each(3, '</div><div class="row">') ?>
                <div class="col-md-4 col-sm-4">
                    <?php get_template_part('blocks/content', get_post_type()); ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php endif; ?>

<?php get_template_part('blocks/pager'); ?>

<?php get_footer(); ?>