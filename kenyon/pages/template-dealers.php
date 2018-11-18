<?php

/*
Template Name: Dealers Template
*/

get_header(); 

?>

<div class="container">
	<?php if (isset($_GET['id'])) : ?>
		<?php get_template_part('blocks/dealers/single-dealer') ?>
	<?php else : ?>
	
		<?php the_title('<h1>', '</h1>'); ?>
		<ul class="nav nav-tabs dealers-tabs">
			<li class="active"><a data-toggle="tab" href="#local-dealers"><?php _e( 'LOCAL DEALERS', 'dealers' ) ?></a></li>
			<li><a data-toggle="tab" href="#online-dealers"><?php _e( 'ONLINE DEALERS', 'dealers' ) ?></a></li>
			<li><a data-toggle="tab" href="#international-dealers"><?php _e( 'INTERNATIONAL DEALERS', 'dealers' ) ?></a></li>
		</ul>
		<div class="dealers-content tab-content">
			<div id="back-to-online-dealers"><?php _e('Back To Online Dealers','kenyon')?></div>
			<div id="local-dealers" class="tab-pane active">
				<?php echo do_shortcode( '[slplus]' ); ?>
			</div>
			<?php wc_get_template('blocks/dealers/international-dealers.php') ?>
			<?php wc_get_template('blocks/dealers/online-dealers.php') ?>
		</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>