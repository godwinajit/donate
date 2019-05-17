<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
	get_header ();
?>

<main class="mains">
<div class="inner-pages common-content-page">

 <?php
	if (has_post_thumbnail ()) {
		$banneurl = wp_get_attachment_url ( get_post_thumbnail_id ( $post->ID ) );
	} else {
		$banneurl = get_template_directory_uri () . '/images/template-banner.jpg';
	}
	
	// Add the pageID which should not show the Hero Banner images 
	$pagesToExcludeBannerImage = array(9856);
	$current_page_id = get_queried_object_id();
	if (!in_array($current_page_id, $pagesToExcludeBannerImage)) {
?>
	 <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)"></div>
<?php }?>

 <?php echo do_shortcode('[IconSlider]'); ?> 

 <!-- conatiner section -->

	<div class="container-section">

		<div class="wrapper container-fluid">
			<div class="row center-xs">
				<div class="col-xs-12 col-sm-11 col-md-10">
					<div class="boards">



<?php the_content();?>

<?php 
	$today = date('Y-m-d H:i:s');
	$args = array(
		'post_status'=>'publish',
		'post_type'=>array(TribeEvents::POSTTYPE),
		'posts_per_page'=>3,
		//order by startdate from newest to oldest
		'meta_key'=>'_EventStartDate',
		'tribe_events_cat'=>'GLA Fundraiser',
		'orderby'=>'_EventStartDate',
		'order'=>'ASC',
		//required in 3.x
		'eventDisplay'=>'custom',
		'meta_query' => array(
			array(
				'key'     => '_EventStartDate',
				'value'   => $today,
				'compare' => '>=',
				'type'	  => 'DATETIME'
			)
		)
	);

	$get_posts = null;
	$get_posts = new WP_Query();
	$get_posts->query($args);
?>

<div class="row">&nbsp;</div>

<div id="tribe-events-pg-template" class="tribe-events-pg-template">
	<div id="tribe-events">
		<div id="tribe-events-content-wrapper" class="tribe-clearfix">

			<div id="tribe-events-content" class="tribe-events-list">

				<!-- List Title -->
				<h2 class="tribe-events-page-small-title"><?php echo tribe_get_events_title() ?></h2>


				<div class="tribe-events-loop">
					<?php
						if($get_posts->have_posts()) : while($get_posts->have_posts()) : $get_posts->the_post(); ?>
							<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">

								<!-- Event Image -->
								<?php echo tribe_event_featured_image( null, 'large' ); ?>

								<div class="tribe-event-content">

									<!-- Event Content -->
									<?php do_action( 'tribe_events_before_the_content' ); ?>

										<!-- title holder -->
										<div class="tribe-events-title">

											<!-- Event Title -->
											<?php do_action( 'tribe_events_before_the_event_title' ) ?>
											<h2 class="tribe-events-list-event-title">
												<?php $urlEvent = esc_url( tribe_get_event_link() ); ?>
												<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
													<?php the_title() ?>
												</a>
											</h2>
											<?php do_action( 'tribe_events_after_the_event_title' ) ?>

											<!-- Event Meta -->
											<?php do_action( 'tribe_events_before_the_meta' ) ?>
												<div class="tribe-events-event-meta">
													<div class="author <?php echo esc_attr( $has_venue_address ); ?>">

														<!-- Schedule & Recurrence Details -->
														<div class="tribe-event-schedule-details">
															<?php echo tribe_events_event_schedule_details() ?>
														</div>

														<?php if ( $venue_details ) : ?>
															<!-- Venue Display Info -->
															<div class="tribe-events-venue-details">
																<?php
																	$address_delimiter = empty( $venue_address ) ? ' ' : ', ';

																	// These details are already escaped in various ways earlier in the process.
																	echo implode( $address_delimiter, $venue_details );

																	if ( tribe_show_google_map_link() ) {
																		echo tribe_get_map_link_html();
																	}
																?>
															</div> <!-- .tribe-events-venue-details -->
														<?php endif; ?>

													</div>
												</div><!-- .tribe-events-event-meta -->
											</div><!-- .title -->

											<?php do_action( 'tribe_events_after_the_meta' ) ?>

												<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
													
													<!--  -->
													<!--  -->
													<?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?>

													<a href="<?php echo $urlEvent; ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'the-events-calendar' ) ?> &raquo;</a>
													
													<!-- <a href="<?php //echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'the-events-calendar' ) ?> &raquo;</a> -->

												</div><!-- .tribe-events-list-event-description -->
												</div>
									<?php do_action( 'tribe_events_after_the_content' ); ?>

								</div><!-- postID -->
				
							<?php
								endwhile; endif;
								wp_reset_query();
							?>
						</div><!-- tribe-events-loop -->


			</div><!-- tribe-events-content -->
			<div class="tribe-clear"></div>

		</div><!-- tribe-events-content-wrapper -->
	</div><!-- tribe-events -->
</div><!-- tribe-events-pg-template -->



















   
   <?php
while ( the_flexible_field ( 'add_flexible_content' ) ) {
	if (get_row_layout () == 'three_blocks_section') {
		
		$three_blocks = get_sub_field ( 'three_blocks' );
		?>
<section class="posts-panel">
                                            <ul class="posts-grid pics">
											<?php foreach ( $three_blocks as $row ) {
											$thumpNailURLFlex = wp_get_attachment_image_src( $row ['image'] ['ID'], 'post-thumbnail' );
											?>
                                                <li>
                                                    <a href="<?php echo $row ['link_url'];?>">
                                                        <span class="pic"><img src="<?php echo $thumpNailURLFlex[0];?>" alt="<?php echo $row ['title'];?>"></span>
                                                        <span class="descript">
                                                            <strong class="title" title="<?php echo $row ['title'];?>"><?php echo $row ['title'];?></strong>
                                                            <em class="txt"><?php echo $row ['description'];?></em>
                                                            <strong class="more">Learn more</strong>
                                                        </span>
                                                    </a>
                                                </li>
											 <?php }?>
                                            </ul>
                                        </section>

                                        <?php 
	}
}
?>

					</div><!-- boards -->

				</div><!-- col-xs-12 col-sm-11 col-md-10 -->
			</div><!-- row center-xs -->

		</div><!-- wrapper container-fluid -->

	</div><!-- container-section -->
</div><!-- inner-pages common-content-page -->

<!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>
</main>

<?php get_footer(); ?>

