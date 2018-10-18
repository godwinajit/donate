<?php
/**
 * Template Name: site map
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */?>
<?php get_header(); ?>
<div class="top-section contact">
	<div class="video-section">
		<div class="holder inner">
			<div class="container">
				<div class="row">
					<h1>Sitemap</h1>
					<hr>
					<h2>Here's How To Get Around Our Site.</h2>					
				</div>
			</div>
		</div>
		<div class="video-frame">
			<div class="video-box" data-width="720" data-height="406">
				<video class="mejs-wmp" width="720" height="406" controls="none"
					preload="none"
					poster="<?php the_field('thumbnail_of_video'); ?>"
					autoplay="autoplay" loop="loop">
				        <source src="<?php the_field('mp4_video_url'); ?>" />
					    <source src="<?php the_field('webm_video_url'); ?>" />
					    <source src="<?php the_field('ogv_video_url'); ?>" /> 
				</video>
			</div>
		</div>
	</div>
</div>
<main role="main" id="main">
		<section class="block">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">

			
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				                <?php the_content(); ?>
				        <?php endwhile; ?>	                       </div>
                 </div>
            </div>           
         </section>

<?php get_footer();	?>