<?php
if (! defined ( 'ABSPATH' )) {
	die ( '-1' );
}

/* Template Name: Events New Template */
get_header ();
?>
<main class="mains">
<div class="inner-pages common-content-page">
	<div class="container-section">
		<div class="wrapper container-fluid">
			<div class="row center-xs">
				<div class="col-xs-12 col-sm-11 col-md-10">
					<div class="boards">
						<?php if ( is_active_sidebar( 'ga-events-sidebar' ) ) : ?>
						<div class="content-left content-section-height">
						<?php endif; ?>
							<div id="tribe-events-pg-template" class="tribe-events-pg-template">
								<?php tribe_events_before_html(); ?>
								<?php tribe_get_view(); ?>
								<?php tribe_events_after_html(); ?>
							</div>
							<!-- #tribe-events-pg-template -->
						<?php if ( is_active_sidebar( 'ga-events-sidebar' ) ) : ?>
						</div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'ga-events-sidebar' ) ) : ?>
						<!-- aside section -->
						<div class="aside-right content-section-height">
								<?php dynamic_sidebar('ga-events-sidebar'); ?>
                        </div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>
</main>
<?php get_footer(); ?>