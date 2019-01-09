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

<!-- Top banner -->




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
					<?php if(!empty(get_the_content())){?>
					<div class="content-left content-section-height">
						<?php the_content();?>
						<div class="row">&nbsp;</div>
					</div>
					<?php }?>
   						<?php if(get_field('left_content')){ ?>

   						<div class="content-left content-section-height">

   							<?php echo get_field('left_content');  ?>

    						<?php
										
										while ( the_flexible_field ( 'add_flexible_content' ) ) {
											
											if (get_row_layout () == 'pullout_content_section') {
												
												$pullout_content_title = get_sub_field ( 'pullout_title' );
												
												$pullout_content = get_sub_field ( 'pullout_content' );
												
												echo '<div class="content-pullout-section"><div class="orange-border-title">' . $pullout_content_title . '</div><div class="pullout-text"> ' . $pullout_content . '</div></div>';
											}
											
											if (get_row_layout () == 'two_column_pullout_content_section') {
												
												$two_column_pullout_content_title = get_sub_field ( 'two_column_pullout_title' );
												
												$bod_name_designation = get_sub_field ( 'bod_name_designation' );
												
												$content_left_title = get_sub_field ( 'content_left_title' );
												
												$pullout_content_left = get_sub_field ( 'pullout_content_left' );
												
												$content_right_title = get_sub_field ( 'content_right_title' );
												
												$pullout_content_right = get_sub_field ( 'pullout_content_right' );
												
												echo '<div class="twoclm-section content-pullout-section">';
												
												if ($two_column_pullout_content_title != "") {
													
													echo '<div class="orange-border-title">' . $two_column_pullout_content_title . '</div>';
												}
												
												echo '<div class="pullout-text"><div class="employee-post-title">' . $bod_name_designation . '</div><div class="twocolumn-cont cf"><div class="col-left"><h3>' . $content_left_title . '</h3>

						<div class="equal_height">' . $pullout_content_left . '</div>

						</div><div class="col-right"><h3>' . $content_right_title . '</h3><div class="equal_height">' . $pullout_content_right . '</div></div></div></div></div>';
											}
											
											if (get_row_layout () == 'diagnosis_dilemma_section') {
												
												echo get_sub_field ( 'content' );
											}
											
											if (get_row_layout () == 'videoimage_pullout_section') {
												
												$title = get_sub_field ( 'title' );
												
												$videoURL = get_sub_field ( 'video_url' );
												
												$image = get_sub_field ( 'image' );
												
												$body = get_sub_field ( 'body' );
												
												if ($videoURL != "") {
													
													$imageURL = "";
												} elseif (is_array ( $image ) && isset ( $image ["url"] )) {
													
													$imageURL = $image ["url"];
												}
												
												echo '<div class="clear"></div>

									<div class="videoimage-pullout-section ' . ($imageURL != "" ? "type-image" : "") . ($videoURL != "" ? "type-video" : "") . '">

										<div class="left-content">

											<div class="title">' . $title . '</div>';
												
												if ($videoURL != "") {
													
													echo '<div class="video"><iframe src="' . $videoURL . '?showinfo=0" frameborder="0" allowfullscreen></iframe></div>';
												} elseif ($imageURL != "") {
													
													echo '<div class="image"><img src="' . $imageURL . '" /></div>';
												}
												
												echo '</div><div class="right-content"><div class="inner">' . $body . '</div></div>

										<div id="clear" style="clear:both;"></div>

									</div><div class="clear"></div>';
											}
											
											if (get_row_layout () == '2_column_section') {
												
												$content_left = get_sub_field ( 'content_left' );
												
												$content_right = get_sub_field ( 'content_right' );
												
												echo '<div class="clear"></div><div class="two-column-section"><div class="col-left"><div class="equal_height">' . $content_left . '</div></div><div class="col-right"><div class="equal_height">' . $content_right . '</div></div><div class="clear"></div></div>';
											}
											
											if (get_row_layout () == 'inline_blue_box_section') {
												
												$title = get_sub_field ( 'title' );
												
												$body = get_sub_field ( 'body' );
												
												$button_text = get_sub_field ( 'button_text' );
												
												$button_url = get_sub_field ( 'button_url' );
												
												echo '<div class="inline-blue-box">

										<div class="inline-blue-box-title">' . $title . '</div>

										<div class="inline-blue-box-body">' . $body . '</div>

										<a href="' . $button_url . '" class="inline-blue-box-button">' . $button_text . '</a>

									</div>';
											}
											
											if (get_row_layout () == 'reading_resources') {
												
												$title = get_sub_field ( 'box_title' );
												
												$items = get_sub_field ( 'box_items' );
												
												if ($items) {
													
													$middle = floor ( count ( $items ) / 2 );
													
													$i = 0;
													
													echo '<div class="resources-box">';
													
													echo '<div class="resources-box-title">' . $title . '</div>';
													
													echo '<div class="resources-list">';
													
													echo '<div class="resources-col">';
													
													while ( have_rows ( 'box_items' ) ) {
														
														the_row ();
														
														$i ++;
														
														$title = get_sub_field ( 'box_item_title' );
														
														$description = get_sub_field ( 'box_item_description' );
														
														echo '<div class="resources-item">

											<div class="resources-item-title">' . $title . '</div>

											<div class="resources-item-text">' . $description . '</div>

										</div>';
														
														if ($i == $middle) {
															
															echo '</div><div class="resources-col">';
														}
													}
													
													echo '</div>';
													
													echo '</div>';
													
													echo '</div>';
												}
											}
											
											if (get_row_layout () == 'curriculum_description_section') {
												
												$left_column_title = get_sub_field ( 'left_column_title' );
												
												$right_column_title = get_sub_field ( 'right_column_title' );
												
												$items = get_sub_field ( 'items' );
												
												echo '<div class="twoclm-section content-pullout-section">';
												
												echo '<div class="pullout-text">';
												
												echo '<div class="twocolumn-cont cf curriculum-header">';
												
												echo '<div class="col-left">';
												
												echo '<h3>' . $left_column_title . '</h3>';
												
												echo '</div>';
												
												echo '<div class="col-right">';
												
												echo '<h3>' . $right_column_title . '</h3>';
												
												echo '</div>';
												
												echo '</div>';
												
												if ($items) {
													
													while ( have_rows ( 'items' ) ) {
														
														the_row ();
														
														$curriculum = get_sub_field ( 'curriculum' );
														
														$description = get_sub_field ( 'description' );
														
														echo '<div class="twocolumn-cont cf curriculum-item">';
														
														echo '<div class="col-left">';
														
														echo '<h3>' . $left_column_title . ': </h3>';
														
														echo '<p>' . $curriculum . '</p>';
														
														echo '</div>';
														
														echo '<div class="col-right">';
														
														echo '<h3>' . $right_column_title . ': </h3>';
														
														echo $description;
														
														echo '</div>';
														
														echo '</div>';
													}
												}
												
												echo '</div>';
												
												echo '</div>';
											}
										} // endwhile
										
										?>

    

   </div>

   <?php	} ?>

   

   <!-- aside section -->

						<div class="aside-right content-section-height">

    <?php dynamic_sidebar('ga-sidebar'); ?>

    <?php dynamic_sidebar('aboutgrant-sidebar'); ?>

    <?php dynamic_sidebar('bucket-sidebar'); ?>

   </div>

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

