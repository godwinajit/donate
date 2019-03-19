<?php

/* Template Name: Support Groups Map Template */

get_header();


$online_support_groups = get_posts(
    array(
        'posts_per_page' => -1,
        'post_type' => 'support_group',
        'tax_query' => array(
            array(
                'taxonomy' => 'support_group_states',
                'field' => 'slug',
                'terms' => 'online-groups',
            )
        )
    )
);

$support_groups = get_posts(
    array(
        'posts_per_page' => -1,
        'post_type' => 'support_group',
        'tax_query' => array(
            array(
                'taxonomy' => 'support_group_states',
                'field' => 'slug',
                'terms' => 'online-groups',
		        'operator' => 'NOT IN'
            )
        )
    )
);

$support_groups_json_data =  array();

foreach( $support_groups as $post ):
	$support_group	= array();
	setup_postdata( $post );

	$contactHtml = '';
	$location_address	= get_field('map_address');

	$support_group['name'] = get_the_title();;
	$support_group['address'] = $location_address['address'];
	//$support_group['address2'] = get_field('address');
	$support_group['city'] = '';//get_field('city');
	$support_group['state'] = '';//getCategoryNamesString(get_the_ID(), 'support_group_states');
	$support_group['zip'] = '';//get_field('zip');
	$support_group['country'] = '';//get_field('additional_address');
	$support_group['lat'] = $location_address['lat'];
	$support_group['lng'] = $location_address['lng'];
	$support_group['dates'] = get_field('dates');
	$support_group['time'] = get_field('time');
	$support_group['website'] = get_field('website');
	$support_group['phone'] = get_field('phone');

	if( have_rows('support_contact_repeater') ):
	    while ( have_rows('support_contact_repeater') ) : the_row();
			$support_contact_name = get_sub_field('support_contact_name');
			if(strpos($support_contact_name, "http") !== false){
				$url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
				$support_contact_name = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $support_contact_name);
				$support_contact_name = addslashes($support_contact_name);
			}

			if(get_sub_field('support_contact_name')) $contactHtml .= '<br>'.$support_contact_name;
			if(get_sub_field('support_contact_email')) $contactHtml .= '<br><a href=\"mailto:'.get_sub_field('support_contact_email').'\">'.get_sub_field('support_contact_email').'</a>';
			if(get_sub_field('support_contact_phone')) $contactHtml .= '<br><a href=\"tel:'.get_sub_field('support_contact_phone').'\">'.get_sub_field('support_contact_phone').'</a>';
		endwhile;
	endif;

	$support_group['contact'] = $contactHtml;

	$support_groups_json_data['response'][] = $support_group;
	wp_reset_postdata();

endforeach;

$support_groups_json_data = "'".json_encode($support_groups_json_data)."'";
?>
<main class="mains">
	<div class="inner-pages common-content-page">
		<?php
			if (has_post_thumbnail()) {
				$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  
			}else {
				$banneurl = get_template_directory_uri().'/images/template-banner.jpg';
			}
		?>
		<!-- <div class="inner-banner" style="background-image: url(<?php // echo $banneurl; ?>;)"></div> -->
		<div class="container-section support-groups-cat-container">
			<div class="wrapper container-fluid">
				<div class="row center-xs">
					<div class="col-xs-12 col-sm-11 col-md-10">
						<div class="boards d-flex">
							<div class="content-left">
								<h1 class="page-title"><?php the_title(); ?></h1>
								<div class="main-content">
									<?php the_content();?>
								</div>
							</div>
							<div class="aside-right">
								<?php dynamic_sidebar('ga-sidebar'); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row center-xs">
					<div class="col-xs-12 col-sm-11 col-md-10">
						<!-- start group finder -->
						<div class="map-section">
							<div class="column">
								<div class="tabs-panel">
									<ul class="tabset">
										<li><a href="#tab1">ALL GROUPS</a></li>
										<li><a href="#tab2">ONLINE GROUPS</a></li>
									</ul>
									<div class="tab-holder" id="tab1">
										<div class="form-optional group-search-form">
											<form id="group-search-form">
												<fieldset>
													<div class="row">
														<div class="col-xs-12">
															<div class="input-holder">
																<input type="text" name="address">
															</div>
														</div>
														<div class="col-xs-6">
															<div class="input-holder">
																<select name="distance">
																	<option value="10">10 miles</option>
																	<option value="25">25 miles</option>
																	<option value="50">50 miles</option>
																	<option value="100">100 miles</option>
																	<option selected value="200">200 miles</option>
																	<option value="500">500 miles</option>
																</select>
															</div>
														</div>
														<div class="col-xs-6">
															<div class="actions">
																<input type="submit" value="Find" title="Find Locations">
															</div>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
										<div class="locations-box"
											style="opacity: 0; visibility: hidden;">
											<div class="jcf-scrollable">
												<ul id="group-locations-list" class="group-locations-list"></ul>
												<p class="map-note" style="display: none;">No support groups were found please expand your search</p>
											</div>
										</div>
									</div>
									<div class="tab-holder online-options" id="tab2">
										<div class="locations-box">
											<ul class="group-locations-list">
												<?php foreach( $online_support_groups as $post ):
													setup_postdata( $post );
												?>
												<li>
													<?php 
														echo '<strong>'.get_the_title().'</strong><br>';

														if (get_field('address')){
															echo get_field('address').'<br>';
			                                            }													
														if (get_field('website')){
															echo 'Website: <a target="_blank" href="'.get_field('website').'">'.get_field('website').'</a>';
														}
													?>
												</li>
												<?php endforeach;
													wp_reset_postdata();
												?>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="column">
								<div id="group-map" class="group-map">
									<!-- map here -->
								</div>
							</div>
						</div>
						<!-- end group finder -->
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	var support_groups_json_data = <?php echo $support_groups_json_data; ?>;
</script>
</main>
<div class="popup-holder">
	<div class="lightbox lightbox-download" id="popup-widget2">
		<div class="visual"
				style="background-image: url(/wp-content/themes/globallymealliance/images/bg-popup.jpg);"></div>
		<div class="lightbox-content"><?php echo do_shortcode('[gravityform id="17" title="false" description="false" ajax="true" tabindex="147"]'); ?></div>
	</div>
</div>
<?php get_footer(); ?>
