<?php

if (!isset($_REQUEST['ajax'])) return;

$paged = isset($_REQUEST['start']) ? intval($_REQUEST['start']) : 1;

theme_related_events_build_query();

?>

<?php if(have_posts()): ?>
	<div class="row">
		<?php while(have_posts()): the_post(); ?>
		
			<?php
				$start_date = get_post_meta(get_the_ID(), '_start', true);
				$cutOff_date = get_post_meta(get_the_ID(), '_cutOff', true);
				$end_date = get_post_meta(get_the_ID(), '_end', true);
				$sefUrl = get_post_meta(get_the_ID(), '_sefUrl', true); 
			?>
	   
			<?php theme_print_each(3, '</div><div class="row">'); ?>
			<article class="item col-sm-4">
				<div class="holder">
					<?php get_template_part('blocks/events/content') ?>
				</div>
			</article>
				
		<?php endwhile; ?>
	</div>
	
	<?php if(get_next_posts_link()): ?>
		<a class="more-link" href="<?php echo add_query_arg(array('ajax' => 1, 'start' => ($paged+1))); ?>"><?php _e('SHOW MORE EVENTS', 'subculture'); ?></a>
	<?php else: ?>
		<a class="hidden" href="<?php the_permalink(); ?>"><?php _e('SHOW MORE EVENTS', 'subculture'); ?></a>
	<?php endif; ?>

	<?php wp_reset_query();?>

<?php endif; ?>

<?php die(); ?>