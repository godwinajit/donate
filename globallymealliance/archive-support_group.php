<?php
get_header ();
$bannerImageurl = get_template_directory_uri().'/images/template-banner.jpg';

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
						<h1 class="page-title"><?php echo apply_filters('the_title', $supportGroupsContent->post_title );?></h1>
						<div class="col-xs-12">
							<?php echo apply_filters('the_content', $supportGroupsContent->post_content );?>
						</div>
						<div class="btn-row"></div>
						<div class="row btn-row">
							<div class="col-xs-12">
								<p>
									<a class="btn btn-default open-lightbox"
										title="ADD YOUR SUPPORT GROUP" href="#popup-widget2">ADD YOUR SUPPORT GROUP</a>
								</p>
							</div>
						</div>
							<div class="row select-row">
								<div class="col-xs-12 col-sm-6 col-md-4">
									<p>Find Support: </p>
									<ul>
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
												'exclude' => 480,
												'echo' => 0 
											);
										?>
										<?php $select  = wp_dropdown_categories( $args ); ?>
										<?php $replace = "<select$1 onchange=\"window.location = '" . esc_url ( home_url ( '/support-groups/' ) ) . "'+this.options
																    [this.selectedIndex].value\">"; ?>
										<?php $select  = preg_replace( '#<select([^>]*)>#', $replace, $select ); ?>
										<?php 
											$addFirstOption = '<option class="level-0" value="online-groups">Online groups</option><option class="level-0" value="alabama">Alabama</option>';
											$replaceFirstOption = '<option class="level-0" value="alabama">Alabama</option>';
											if(get_queried_object ()->slug == 'online-groups'){
												$addFirstOption = '<option class="level-0" selected="selected" value="online-groups">Online groups</option><option class="level-0" value="alabama">Alabama</option>';
											}
											if(get_queried_object ()->slug == 'alabama'){
												$replaceFirstOption = '<option class="level-0" value="alabama" selected="selected">Alabama</option>';
												$addFirstOption = '<option class="level-0" value="online-groups">Online groups</option><option selected="selected"  class="level-0" value="alabama">Alabama</option>';
											}
										?>
										<?php $select  = str_replace( $replaceFirstOption, $addFirstOption, $select ); ?>
										<?php echo $select; ?>
									  </li>
									</ul>
								</div>
							</div>
						<div class="support-groups-cat-masonary">
							<?php if ( have_posts() ) : ?>
					            <?php while (have_posts() ) : the_post(); ?>
									<div class="support-groups-cat-article">
										<div style="display: block; padding: 20px;">
											<?php if (get_field('show_title') == 'yes') {?>
												<h4><?php echo mb_strimwidth( get_the_title(), 0, 50, '...' ); ?></h4>
										    <?php }?>
													<?php if (get_field('address')){ ?>
                                                        <div style="margin-bottom: 0px;"><?php the_field('address');?></div>
                                                    <?php }?>
                                                    <?php if (get_field('city')){ ?>
                                                        <strong>City: </strong>
                                                        <?php the_field('city');?>
                                                    <?php }?>
                                                    <?php if (get_field('dates')){ ?>
                                                        <br> <strong>Dates:</strong>
                                                        <?php the_field('dates');?>
                                                    <?php }?>
                                                    <?php if (get_field('time')){ ?>
                                                        <br> <strong>Time:</strong>
                                                        <?php the_field('time');?>
                                                    <?php }?>
                                                    <?php if (get_field('contacts')){ ?>
                                                        <br> <strong>Contacts:</strong>
                                                        <div style="p margin-bottom: 0px;"><?php the_field('contacts');?></div>
                                                    <?php }?>
													<?php if (!get_field('contacts')){ ?>
                                                        <br>
                                                    <?php }?>
                                                    <?php if (get_field('website')){ ?>
                                                        <strong>Website:</strong> 
															<a href="<?php the_field('website');?>"><?php the_field('website');?></a>
                                                    <?php }?>
                                                 </div>
									</div>
                                        <?php endwhile; ?>
									<?php else:?>
										No Support Groups available.
                                    <?php endif; ?>
                                </div>
                                <?php wp_pagenavi(); ?>
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
<?php get_footer(); ?>
<script>
$('.support-groups-cat-masonary').masonry({
  // options
  itemSelector: '.support-groups-cat-article'
});
</script>
