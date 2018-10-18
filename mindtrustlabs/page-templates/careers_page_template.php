<?php
/**
 * Template Name: Careers
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */
get_header(); ?>
<div class="top-section  contact">
	<div class="video-section">
		<div class="holder inner">
			<div class="container">
				<div class="row">
					<h1>Let's Get Digital</h1>
					<hr>
					<h2>We're expanding our Mind. Are you in?</h2>
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
<main id="main" role="main">
<section class="block current-opportunities">
	<div class="container same-height-holder">
		<header class="heading">
			<h2>Current Opportunities</h2>
			<p>Our culture is built upon collaboration, innovation, and integrity. We're looking for bright individuals who pride themselves on staying ahead of the curve and are motivated to work with high-powered teams that deliver creative solutions to our valued clients.</p>
		</header>
		<div class="items-holder">
		<?php 
		$args = array(
				'post_type'=> 'career',
				'orderby'=>'date',
				'order'=>'DESC',
				'post_status' => 'publish',
		);
		
		$the_query = new WP_Query( $args );
		$careerArticleCount = 0;
		if($the_query->have_posts() ) : 
		while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
		<?php if($careerArticleCount % 2 == 0){?><div class="row"><?php }?>
				<div class="col-sm-6 item">
					<article>
						<a href="<?php the_permalink(); ?>" class="same-height">
							<h3><?php the_title(); ?></h3>
							<p><?php the_field('location'); ?></p> </a>
					</article>
				</div>
		<?php if($careerArticleCount % 2 != 0){?></div><?php }?>
		<?php
		$careerArticleCount++;
		endwhile;
		wp_reset_postdata(); ?>
		<?php else:  ?>
		<p style="min-height: 115px;"><?php _e( 'Sorry, no items available.' ); ?></p>
		<?php endif; ?>
		<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
		</div>
	</div>
</section>
<div class="quote-block">
	<div class="holder">
		<blockquote class="quote">
			<q>“Markets are changing faster than they ever have before.  To stay competitive, businesses today need to collaborate across disciplines, locations and organizations to invent the best solutions, faster.  Integrating multidimensional teams with agile software best-practices leads to new ideas and better products brought to market faster. We can build you a dream team, your “MindTrust”.</q>
			<cite>Chris Errato, Founder/President</cite>
		</blockquote>
		<div class="buttons-holder">
			<a href="https://www.mindtrustlabs.com/contact/"
				class="btn btn-default btn-contact">Learn How</a>
		</div>
	</div>
</div>

<?php get_footer();	?>