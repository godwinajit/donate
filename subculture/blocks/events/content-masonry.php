<?php

$start_date = get_post_meta(get_the_ID(), '_start', true);
$cutOff_date = get_post_meta(get_the_ID(), '_cutOff', true);
$end_date = get_post_meta(get_the_ID(), '_end', true);
$sefUrl = get_post_meta(get_the_ID(), '_sefUrl', true);

?>

<?php the_post_thumbnail('events-thumb-358') ?>

<div class="item-content">
	<div class="heading">
		<?php if ($start_date) : ?>
			<div class="date"><span><?php echo strtoupper(date('D', $start_date)) ?><strong><?php echo date('j', $start_date) ?></strong></span></div>
		<?php endif; ?>

		<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
	</div>

	<!--<h3>Vibrant. Majestic. Loud.</h3>-->
	<?php the_excerpt() ?>

	<?php if ($start_date) : ?>
		<time datetime="<?php echo date('Y-m-d', $start_date) ?>"><?php echo strtoupper(date('D', $start_date)) ?> - <?php echo date('m/d/y', $start_date) ?></time>
	<?php endif; ?>

	<span class="works-time">Doors: 7:00 pm <?php if ($start_date) : ?>/ Show: <?php echo date('h:i a', $start_date) ?><?php endif; ?></span>

	<div class="btn-holder">
		<button type="button" class="btn btn-default btn-find">FIND TICKETS</button>
		<a href="<?php the_permalink() ?>" class="link-more">MORE INFO <span class="fa fa-chevron-right"></span></a>
	</div>
</div>