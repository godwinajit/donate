<?php
/**
 * Template Name: Ideas
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */
get_header(); ?>
<div class="top-section">
	<div class="video-section">
		<div class="holder inner">
			<div class="container">
				<div class="row">
					<h1>Fueled by Passion</h1>
					<hr>
					<h2>Culture, Values, &amp; Team.</h2>
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


Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                       </div>
                 </div>
            </div>           
         </section>
<?php get_footer();	?>