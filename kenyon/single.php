<?php get_header(); ?>

<div class="container">
    <?php get_template_part('blocks/breadcrumbs'); ?>

    <h1><?php echo theme_one_post_category() ?></h1>
</div>


<article class="post-article">

	<?php while (have_posts()) : the_post(); ?>
        <div class="post-frame">
            <div class="container">
                <div class="post">
                    <?php get_template_part('blocks/content-single', get_post_type()); ?>
                </div>
            </div>
        </div>

		<?php get_template_part('blocks/pager-single', get_post_type()); ?>
		
		<?php comments_template(); ?>
		
	<?php endwhile; ?>
	
	
</article>

<?php get_footer(); ?>