<?php
get_header();
?>
<main class="mains">
	<div class="inner-pages common-content-page">
	<?php
		if (has_post_thumbnail()) {
			$banneurl = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
		} else {
			$banneurl = get_template_directory_uri() . '../../../uploads/2015/12/web-header_researcher9.png';
		}
	?>
		<div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)"></div>
		<div class="container-section">
			<div class="wrapper container-fluid">
				<div class="row center-xs">
					<div class="col-xs-12 col-sm-11 col-md-10">
						<div class="boards">
							<?php get_template_part( 'research', 'searchform' ); ?>
							<div class="search-result">
							<?php if ( have_posts() ) : ?>
								<?php while (have_posts() ) : the_post(); ?>
									<?php get_template_part( 'loops/research', 'content' ); ?>
								<?php endwhile; ?>
							<?php endif; ?>							
							</div>
							<?php wp_pagenavi(); ?>
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
