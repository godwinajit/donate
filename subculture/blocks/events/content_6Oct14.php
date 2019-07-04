<?php
$cutOff_date = (get_post_meta(get_the_ID(), '_cutOff', true)); //This reflects eastern time.
$start_date = (get_post_meta(get_the_ID(), '_start', true)); //This reflects eastern time.
$end_date = get_post_meta(get_the_ID(), '_end', true);
$sefUrl = get_post_meta(get_the_ID(), '_sefUrl', true); ?>

<a href="<?php the_permalink(); ?>">
<?php if (has_post_thumbnail()) : ?>
	<?php the_post_thumbnail('events-thumb-358x151') ?>
<?php else : ?>
	<img src="<?php echo get_template_directory_uri() ?>/images/placeholder-358x151.png" alt="placeholder" width="358" height="151" />
<?php endif; ?>
</a>

<div class="item-content">
	<div class="heading">
		<?php if ($start_date) : ?>
			<div class="date"><span><?php echo strtoupper(theme_ts_event_date('D', $start_date)) ?><strong><?php echo theme_ts_event_date('j', $start_date) ?></strong><?php echo strtoupper(theme_ts_event_date('M', $start_date)) ?></span></div>
		<?php endif; ?>

		<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
	</div>

	<?php echo get_excerpt(140, 'content'); ?>

	<?php if ($start_date) : ?>
		<time datetime="<?php echo theme_ts_event_date('Y-m-d', $start_date) ?>"><?php echo strtoupper(theme_ts_event_date('D', $start_date)) ?> - <?php echo theme_ts_event_date('m/d/y', $start_date) ?></time>
	<?php endif; ?>

	<span class="works-time"> <?php if($cutOff_date): ?>Doors: <?php echo theme_ts_event_date('h:i a', $cutOff_date) ?> <?php endif; ?><?php if ($start_date) : ?>/ Show: <?php echo theme_ts_event_date('h:i a', $start_date) ?><?php endif; ?></span>

	<div class="btn-holder">
		<?php /*<button type="button" onclick="window.location.href=' https://secure.subculturenewyork.com/event/<?php echo $sefUrl; ?>'" class="btn btn-default btn-find">FIND TICKETS</button> */ ?>
		<a href="<?php the_permalink() ?>" class="btn btn-default btn-find" >FIND TICKETS</a>
		<a href="<?php the_permalink() ?>" class="link-more">MORE INFO <span class="fa fa-chevron-right"></span></a>
	</div>
</div>