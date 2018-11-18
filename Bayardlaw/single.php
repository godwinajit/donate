<?php
/**
 * The template for displaying all single posts

 */
$category_detail = get_the_category( get_the_ID() );
get_header(); ?>
	 <?php if(function_exists('bcn_display_list')): ?>
        <div class="container">
			<ol class="breadcrumb">
                <?php //bcn_display_list(); ?>
                <li><a href="<?php echo get_site_url(); ?>/news/?category=<?php echo $category_detail[0]->slug; ?>"><?php echo $category_detail[0]->name; ?></a></li>
				<li class="active"><?php the_title(); ?></li>           
            </ol>
		</div>
        <?php endif; ?>
	<main id="main" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'newssingle' ); ?>
				<?php //bayardlaw_post_nav(); ?>
				<?php //comments_template(); ?>
			<?php endwhile; ?>
		<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>