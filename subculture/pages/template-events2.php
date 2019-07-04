<?php

/*
Template Name: Events 2 Template
*/


get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
	<?php get_template_part('blocks/events/filters') ?>

	<?php theme_events_query() ?>

	<?php if (have_posts()) : ?>
	<section class="container items">
		<div class="items-holder">
			<div class="row">
				<?php theme_print_each(); ?>
				<?php while (have_posts()) : the_post(); ?>
					<?php theme_print_each(3, '</div><div class="row">'); ?>
					<article class="item col-sm-4">
						<div class="holder">
							<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('events-thumb-358x151') ?>
							<?php else : ?>
								<img src="<?php echo get_template_directory_uri() ?>/images/placeholder-358x151.png" alt="placeholder" width="358" height="151" />
							<?php endif; ?>
							<div class="item-content">
								<div class="heading">
									<div class="date"><span>FRI<strong>9</strong></span></div>
									<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
								</div>
								<?php //the_excerpt() ?>
								<h3>Vibrant. Majestic. Loud.</h3>
								<time datetime="2014-07-12">FRI - 7/12/14</time>
								<span class="works-time">Doors: 7:00 pm / Show: 7:30 pm</span>
								<div class="btn-holder">
									<button type="button" class="btn btn-default btn-find">FIND TICKETS</button>
									<a href="<?php the_permalink() ?>" class="link-more">MORE INFO <span class="fa fa-chevron-right"></span></a>
								</div>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<div class="show-more-link">
				<a href="#">SHOW MORE EVENTS</a>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php wp_reset_query() ?>
</div>

<?php get_footer(); ?>