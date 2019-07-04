<?php
/*
Template Name: Events Template
*/

?>

<?php if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] ==1): ?>

<?php 
	if(isset($_REQUEST['newpaged']))
	{
		$paged = $_REQUEST['newpaged'] ;
	}
	else
	{
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 2;
	}
?>
<?php if(isset($_REQUEST['cat'])): ?>
	<?php query_posts(array('post_type' => 'ts_event', 'meta_key' => '_start','meta_value' => time(), 'meta_compare' => '>=','orderby' => 'meta_value', 'order' => 'ASC' ,'showposts' => 21, 'paged' => $paged,'tax_query' => array( array('taxonomy' => 'event_categories','field' => 'id','terms' =>$_REQUEST['cat'])))); ?>
<?php else: ?>
    <?php query_posts(array('post_type' => 'ts_event', 'meta_key' => '_start','meta_value' => time(), 'meta_compare' => '>=', 'orderby' => 'meta_value', 'order' => 'ASC' ,'showposts' => 21, 'paged' => $paged)); ?>
<?php endif; ?>

<?php if (have_posts()) : ?>
	<?php //theme_print_each(); ?>
	<?php while (have_posts()) : the_post(); ?>
        <?php //theme_print_each(3, '</div><div class="row">'); ?>
        <article class="item col-sm-4">
            <div class="holder">
                <?php get_template_part('blocks/events/content') ?>
            </div>
        </article>
    <?php endwhile; ?>

<?php if(get_next_posts_link()): ?>
        <?php $newpaged = $paged + 1 ; ?>
       <a class="more-link" href="<?php echo add_query_arg(array('ajax' => 1, 'newpaged' => $newpaged)); ?>">SHOW MORE EVENTS</a>
<?php else: ?>
		<a class="hidden" href="#">SHOW MORE EVENTS</a>
<?php endif; ?>

<?php endif; ?>

<?php wp_reset_query() ?>

<?php else: ?>
<?php get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
	<?php get_template_part('blocks/events/filters') ?>

	<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  ?>
	<?php if(isset($_REQUEST['cat'])): ?>
    	<?php query_posts(array('post_type' => 'ts_event', 'meta_key' => '_start','meta_value' => time(), 'meta_compare' => '>=','orderby' => 'meta_value', 'order' => 'ASC' ,'showposts' => 21, 'paged' => $paged,'tax_query' => array( array('taxonomy' => 'event_categories','field' => 'id','terms' =>$_REQUEST['cat']))));
		?>
	<?php else: ?>
		<?php query_posts(array('post_type' => 'ts_event', 'meta_key' => '_start','meta_value' => time(), 'meta_compare' => '>=', 'orderby' => 'meta_value', 'order' => 'ASC' ,'showposts' => 21, 'paged' => $paged)); ?>
    <?php endif; ?>

	<?php if (have_posts()) : ?>
	<section class="container items">
		<div class="items-holder">
			<div class="ajax-items">
				<div class="ajax-container">
					<div class="row">
						<?php //theme_print_each(); ?>
						<?php while (have_posts()) : the_post(); ?>
							<?php //theme_print_each(3, '</div><div class="row">'); ?>
							<article class="item col-sm-4">
								<div class="holder">
									<?php get_template_part('blocks/events/content') ?>
								</div>
							</article>
						<?php endwhile; ?>
					</div>
				</div>
				<?php if(get_next_posts_link()): ?>
					<div class="show-more-link">
						<?php $newpaged = $paged + 1 ; ?>
						<a class="more-link" href="<?php echo add_query_arg(array('ajax' => 1, 'paged' => $newpaged)); ?>">SHOW MORE EVENTS</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php wp_reset_query() ?>
</div>

<?php get_footer(); ?>
<?php endif ; ?>