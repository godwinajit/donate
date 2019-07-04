<?php

/*
Template Name: Events Template (masonry)
*/


get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
	<?php get_template_part('blocks/events/filters') ?>

	<?php theme_events_query() ?>

	<?php if (have_posts()) : ?>
	<section class="container massonry">
		<div class="row">
			<?php while (have_posts()) : the_post(); ?>
				<article class="item col-sm-4">
					<div class="holder">
						<?php get_template_part('blocks/events/content', 'masonry') ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="show-more-link">
			<a href="#">SHOW MORE EVENTS</a>
		</div>
	</section>
	<?php endif; ?>

	<?php wp_reset_query() ?>
</div>

<?php get_footer(); ?>