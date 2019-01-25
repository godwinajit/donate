<?php
get_header ();
$bannerImageurl = get_template_directory_uri().'/images/template-banner.jpg';
$jsUrl = get_template_directory_uri().'/js/isotope.pkgd.min.js'; /* mila */
$jsUrl2 = get_template_directory_uri().'/js/filtering.js'; /* mila */
$searchList = array();
$duplicateCheckSearchList = array();

if ( have_posts() ) : 
	while (have_posts() ) : the_post();
		
		$searchValue['label'] = get_field('city') . ' ( City )';
		$searchValue['value'] = get_field('city');
		if( !array_key_exists(get_field('city'), $duplicateCheckSearchList) && get_field('city') ){ $searchList[] = $searchValue; }
		$duplicateCheckSearchList[get_field('city')] = get_field('city');

		$searchValue['label'] = get_field('zip') . ' ( Zip )';
		$searchValue['value'] = get_field('zip');
		if( !array_key_exists(get_field('zip'), $duplicateCheckSearchList) && get_field('zip') ){ $searchList[] = $searchValue; }
		$duplicateCheckSearchList[get_field('zip')] = get_field('zip');

		$searchValue['label'] = getCategoryNamesString(get_the_ID(), 'support_group_states') . ' ( State )';
		$searchValue['value'] = getCategoryNamesString(get_the_ID(), 'support_group_states');
		if( !array_key_exists(getCategoryNamesString(get_the_ID(), 'support_group_states'), $duplicateCheckSearchList) && getCategoryNamesString(get_the_ID(), 'support_group_states') ){ $searchList[] = $searchValue; }
		$duplicateCheckSearchList[getCategoryNamesString(get_the_ID(), 'support_group_states')] = getCategoryNamesString(get_the_ID(), 'support_group_states');

	endwhile; 
endif;

$bannerurlId = get_field ( 'support_groups_header', 'option' );
$bannerImage = wp_get_attachment_image_src ( $bannerurlId, 'banner-top' ) [0];

$supportGroupsContent = get_pages('meta_key=_wp_page_template&meta_value=templates/support-groups-template.php');
$supportGroupsContent = array_shift($supportGroupsContent);

$bannerImage = wp_get_attachment_url( get_post_thumbnail_id($supportGroupsContent->ID) );

/*if (! $bannerImage || $bannerImage == ''){
	$bannerImage = $bannerImageurl;
}*/
?>


<main class="mains">
<div class="inner-pages common-content-page">
	<?php if($bannerImage){?>
		<div class="inner-banner" style="background-image:url(<?php echo $bannerImage; ?>)"></div>
	<? }?>
	<div class="container-section support-groups-cat-container">
		<div class="wrapper container-fluid">
			<div class="row center-xs">
				<div class="col-xs-12 col-sm-11 col-md-10">
					<div class="boards">
						<div class="content-left content-section-height">
						<h1 class="page-title"><?php echo apply_filters('the_title', $supportGroupsContent->post_title );?></h1>
						<div class="main-content">
							<?php echo apply_filters('the_content', $supportGroupsContent->post_content );?>
						</div>
						<div class="btn-row"></div>
						<!-- <div class="row btn-row">
							<div class="col-xs-12">
								<p>
									<a class="btn btn-default open-lightbox"
										title="ADD YOUR SUPPORT GROUP" href="#popup-widget2">ADD YOUR SUPPORT GROUP</a>
								</p>
							</div>
						</div> -->
							<div class="row select-row">
								<div class="col-xs-12">
									<div class="filter-bar">
										<div class="filter-row">
											<label for="quicksearch">Search by</label>
											<div class="quicksearch-holder">
												<input data-filter="" type="text" class="quicksearch" placeholder="city, zip or state" />
												<div class="filter-list"></div>
												<?php if ( count($searchList) ) : ?>
													<select class="filters-select">
														<option value="">Show All</option>
														<?php foreach ( $searchList as $searchContent ) {?>
															<option value="<?php echo '.'.sanitize_title($searchContent['value']);?>"><?php echo $searchContent['value'];?></option>
														<?php } ?>
													</select>
			                                    <?php endif; ?>
											</div>
										</div>
										<div class="filter-row">
											<label>Find support groups in</label>
											<ul class="select-box">
												<li id="categories-li" class="blog-categories-select">
												<?php
													$args = array (
														'show_option_none' => __ ( 'Select an option' ),
														'option_none_value' => '',
														'show_count' => 0,
														'hide_empty' => 0,
														'orderby' => 'name',
														'selected' => get_queried_object ()->slug,
														'taxonomy' => 'support_group_states',
														'value_field' => 'slug',
														'exclude' => 0,
														'parent' => 0,
														'echo' => 0 
													);
												?>
												<?php $select  = wp_dropdown_categories( $args ); ?>
												<?php $replace = "<select$1 onchange=\"window.location = '" . esc_url ( home_url ( '/support-groups/' ) ) . "'+this.options
																		    [this.selectedIndex].value\">"; ?>
												<?php $select  = preg_replace( '#<select([^>]*)>#', $replace, $select ); ?>
												<?php
												/*
													$addFirstOption = '<option class="level-0" value="online-groups">Online groups</option><option class="level-0" value="alabama">Alabama</option>';
													$replaceFirstOption = '<option class="level-0" value="alabama">Alabama</option>';
													if(get_queried_object ()->slug == 'online-groups'){
														$addFirstOption = '<option class="level-0" selected="selected" value="online-groups">Online groups</option><option class="level-0" value="alabama">Alabama</option>';
													}
													if(get_queried_object ()->slug == 'alabama'){
														$replaceFirstOption = '<option class="level-0" value="alabama" selected="selected">Alabama</option>';
														$addFirstOption = '<option class="level-0" value="online-groups">Online groups</option><option selected="selected"  class="level-0" value="alabama">Alabama</option>';
													}
													*/
												?>
												<?php //$select  = str_replace( $replaceFirstOption, $addFirstOption, $select ); ?>
												<?php echo $select; ?>
											  </li>
											</ul>
										</div>
										<div class="filter-row filter-actions">
											<a href="#" class="btn btn-default js-find">Find</a>
										</div>
									</div>
								</div>
							</div>
							<div class="group-not-available nodisplay">
								Please expand your search area
							</div>
						<div class="js-isotope hide">
							<?php if ( have_posts() ) : ?>
					            <?php while (have_posts() ) : the_post(); ?>
								<div class="support-groups-cat-article <?php echo sanitize_title(getCategoryNamesString(get_the_ID(), 'support_group_states'));?> <?php echo sanitize_title(get_field('city'));?> <?php echo sanitize_title(get_field('zip'));?>">
											<?php if (get_field('show_title') == 'yes') {?>
												<div><?php echo mb_strimwidth( get_the_title(), 0, 50, '...' ); ?></div>
										    <?php }?>
													<?php if (get_field('address')){?>
                                                        <div><?php the_field('address');?></div>
                                                    <?php }?>
                                                    <?php if (get_field('city')){ ?>
                                                        <span>City: </span>
                                                        <?php the_field('city');?>
                                                    <?php }?>
													<?php if (getCategoryNamesString(get_the_ID(), 'support_group_states')){ ?>
                                                        <br> <span>State: </span>
                                                        <?php echo getCategoryNamesString(get_the_ID(), 'support_group_states');?>
                                                    <?php }?>
													<?php if (get_field('zip')){ ?>
		                                                    <br> <span>Zip: </span>
		                                                    <?php the_field('zip');?>
													<?php }?>
                                                    <?php if (get_field('dates')){ ?>
                                                        <br> <span>Dates:</span>
                                                        <?php the_field('dates');?>
                                                    <?php }?>
                                                    <?php if (get_field('time')){ ?>
                                                        <br> <span>Time:</span>
                                                        <?php the_field('time');?>
                                                    <?php }?>
                                                    <?php if (get_field('contacts')){ ?>
                                                        <br> <span class="contact-info">Contacts:</span>
                                                        <?php the_field('contacts');?><br>
                                                    <?php }?>
													<?php if (!get_field('contacts')){ ?>
                                                        <br>
                                                    <?php }?>
                                                    <?php if (get_field('website')){ ?>
                                                        <span>Website:</span> 
															<a target="_blank" href="<?php the_field('website');?>"><?php the_field('website');?></a>
                                                    <?php }?>
									</div>
                                        <?php endwhile; ?>
									<?php else:?>
										No Support Groups available.
                                    <?php endif; ?>
                                </div>
                                <?php wp_pagenavi(); ?>
                        </div>
					</div>
					<div class="aside-right content-section-height">
						<?php dynamic_sidebar('ga-sidebar'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>
</div>
</main>
<div class="popup-holder">
		<div class="lightbox lightbox-download" id="popup-widget2">
			<div class="visual"
				style="background-image: url(/wp-content/themes/globallymealliance/images/bg-popup.jpg);"></div>
			<div class="lightbox-content"><?php echo do_shortcode('[gravityform id="17" title="false" description="false" ajax="true" tabindex="147"]'); ?></div>
		</div>
	</div>
<script>
var searchList = <?php echo json_encode($searchList);?>;
</script>
<script src="<?php echo $jsUrl; ?>"></script> <!-- mila -->
<script src="<?php echo $jsUrl2; ?>"></script> <!-- mila -->
<?php get_footer(); ?>
