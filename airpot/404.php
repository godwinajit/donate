<?php get_header ();
/**
 * The template for displaying 404 pages (Not Found)
 *
 */
?>
<main role="main" id="main">
			
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1 class="page-title"><?php _e( 'Not Found'); ?></h1>
						<p><?php _e( 'It looks like nothing was found at this location.'); ?></p>
						<a href="<?php echo get_home_url(); ?>"><strong><?php _e( 'Click here to go Home Page'); ?></strong></a>
					</div>
				</div>
			</section>
	</main>

<?php get_footer ();?>
