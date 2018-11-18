<?php 

/*

 Template Name: Front Page Template

 */

get_header('frontpage');

/** getting custom field values :Meet our Attorneys */
$title = get_field('title');
$description = get_field('description');
$view_all_button_text = get_field('view_all_button_text');
$view_all_button_link = get_field('view_all_button_link');

 ?>

<main id="main" role="main">
<section class="content-section">
	<div class="container">
		<div class="center-block intro-info-box text-center">
			<div class="heading">
				<div class="heading-frame">
					<h2><?php if($title) echo $title; ?></h2>
					<div class="divider style-dark">
						<div></div>
					</div>
				</div>
			</div>
			<p><?php if($description) echo $description; ?></p>
			<a
				href="<?php if($view_all_button_link) echo $view_all_button_link; ?>"
				class="btn btn-primary"><span><span><?php if($view_all_button_text) echo $view_all_button_text; ?></span></span></a>
		</div>
	</div>
	<div class="items-slider">
		<div class="mask">
			<div class="slideset">
					
					<?php
					/** getting custom field values :Meet our Attorneys profiles */
								$attroney_list = get_field('attorney_details');
								if( $attroney_list ):	
								foreach( $attroney_list as $attroney):			
								setup_postdata($attroney);
								$attorney_name = $attroney->post_title;
								$attorney_image = wp_get_attachment_image_src( get_post_thumbnail_id( $attroney->ID ),array( 819, 1024) );
								$attorney_image = $attorney_image[0];
								$attorney_designation = get_field('designation', $attroney->ID);
								$attorney_description = get_sub_field('attorney_description');
								$attorney_read_more_text = 'Read More';
								$attorney_read_more_link = get_permalink($attroney->ID);
							?>
				<section class="slide js-hover-item">
					<div class="flipper">
						<figure class="slide-frame photo-box">
							<div class="bg-stretch">
								<img src="<?php if($attorney_image) echo $attorney_image; ?>"
									height="560" width="408" alt="" class="photo">
							</div>
							<figcaption class="caption-text">
								<strong class="title"><?php if($attorney_name) echo $attorney_name; ?></strong>
								<p class="add-info"><?php if($attorney_designation) echo $attorney_designation; ?></p>
							</figcaption>
						</figure>
						<div class="hover-box">
							<div class="holder">
								<h3><?php if($attorney_name) echo $attorney_name; ?></h3>
								<p><?php if($attorney_description) echo $attorney_description; ?></p>
								<a href="<?php if($attorney_read_more_link) echo $attorney_read_more_link; ?>"
									class="btn btn-default"><span><span><?php if($attorney_read_more_text) echo $attorney_read_more_text; ?></span></span></a>
							</div>
						</div>
					</div>
				</section>
				<?php   endforeach;
				wp_reset_postdata();
				endif;
				?>						
			</div>
		</div>
		<div class="slider-nav">
			<a class="btn-prev" href="#"><span></span></a> <a class="btn-next"
				href="#"><span></span></a>
		</div>
	</div>
</section>
<section class="content-section">
	<?php 
	/** getting custom field values  */
	$our_practice_areas_title = get_field('our_practice_areas_title');
	$corporate_practices_description_text = get_field('corporate_practices_description_text');
	?>
	<div class="container">
		<div class="heading">
			<div class="heading-frame">
				<h2><?php if($our_practice_areas_title) echo $our_practice_areas_title; ?></h2>
				<div class="divider style-dark">
					<div></div>
				</div>
			</div>
		</div>
	</div>
	<div class="tabs-area" role="tabpanel">
		<ul class="nav nav-tabs nav-justified practice-areas-tabs"	role="tablist">
		 <?php 
			// parent practices
			$taxonomy='practices';
			$taxonomies_terms = get_terms ( $taxonomy, array ('orderby' => 'count','order' => 'DESC','parent' => 0 ) );
			if ($taxonomies_terms) {
				$taxonomies_term_count = 1;
				foreach ( $taxonomies_terms as $taxonomies_term ) {
				$show_on_frontend = get_field ( 'show_on_front_page', $taxonomies_term );
				if ($show_on_frontend == 1) {
				$parent_ids[]=$taxonomies_term->term_id;?>
				<li class="<?php if($taxonomies_term_count == 1) echo 'active'?>"><a href="#tab-<?php echo $taxonomies_term_count;?>" aria-controls="tab-<?php echo $taxonomies_term_count;?>" role="tab"
		data-toggle="tab"><span><?php if($taxonomies_term->name) echo $taxonomies_term->name; ?></span></a></li>
		<?php
		$taxonomies_term_count++;} }}?>
		</ul>
		<div class="tab-content">
		<?php 		
			$taxonomies_child_count = 1;
			foreach ( $parent_ids as $parent_id ) {?>
			<div role="tabpanel" class="tab-pane fade <?php if($taxonomies_child_count ==1 ) echo 'in active';?>" id="tab-<?php echo $taxonomies_child_count?>">
			<div class="container-fluid practices-slider">
			<div class="row mask">
			<div class="box-holder slideset">
			<?php $taxonomies_terms_child = get_terms ( $taxonomy, array (							
							'order' => 'DESC',
							'hide_empty' => false,
							'child_of'          => $parent_id,
					) );
			
				if ($taxonomies_terms_child) 
					{
					foreach ( $taxonomies_terms_child as $taxonomies_term_child ) {	

					$show_on_frontend = get_field ( 'show_on_front_page', $taxonomies_term_child );
					$image_class = get_field ( 'image_class_text', $taxonomies_term_child );
					
					if ($show_on_frontend == 1) {

					?>			
										
																	
													<div class="box js-hover-item col-lg-3 col-md-4 col-sm-6 col-xs-12">
														<div class="holder">
															<div class="text-box">
																<div class="frame">
																	<i class="icon <?php if($image_class) echo $image_class; ?>"></i>
																	<h3><?php if($taxonomies_term_child->name) echo str_replace(" ","<br> ",$taxonomies_term_child->name); ?></h3>
																</div>
															</div>
															<div class="hover-box">
																<div class="frame">
																	
																	<h4>Description</h4>
																	<p><?php if($taxonomies_term_child->description) echo $taxonomies_term_child->description; ?></p>
																	<?php $termlink = get_term_link( $taxonomies_term_child); ?>
																	<a href="<?php echo esc_url( $termlink );?>" class="btn btn-link"><?php echo "Read More";?></a>
															
																</div>
															</div>
														</div>
													</div>
														
															
											
							<?php
							
							
							} //  check whether its allowed to front page or not.
																} // foreach																
																?>																
																	</div>
																	</div>											
																</div>
															</div>	
															<?php 		}
			$taxonomies_child_count++;
			
}
			?>


		</div>
	</div>

	<!-- Start: Slider area -->
	
	<?php 
		/** getting custom field values  */
		$slider_image = get_field('slider_image');
		
		?>
		
	<div class="quote-slideshow parallax-section">
		<div class="bg-frame">
			<img
				src="<?php if($slider_image) echo $slider_image; ?>"
				height="1200" width="1600" alt="">
		</div>
		<div class="slideset">
	 <?php 		 
	 if( have_rows('slider_content_repeater_field') ):
	 while ( have_rows('slider_content_repeater_field') ) : the_row();
	$slider_content_field = get_sub_field('slider_content_field');
	 $name = get_sub_field('slider_by_name');	 
	 ?>
		
			<div class="slide">
				<div class="container">
					<blockquote>
						<?php if($slider_content_field) echo $slider_content_field; ?> <?php if($name) echo '<cite>'.$name.'</cite>'; ?>
					</blockquote>
				</div>
			</div>			
			<?php 			
			endwhile;
			endif;			
			?>
			
		</div>
		<div class="pagination"></div>
	</div>
	<!-- End: Slider area -->


</section>
<section class="content-section">
	<div class="container">
		<div class="heading">
			<div class="heading-frame">
				<h2>Latest News</h2>
				<div class="divider style-dark">
					<div></div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="news-gallery">
					<div class="mask">
							
							
							<?php $related_news = new WP_Query(array(
							    'post_type' => 'post',
								'post_count' => 10,
								'category_name' => article
							));
						setup_postdata( $related_news );
						
						if ( $related_news->have_posts() ) :
						?>						
								<div class="slideset">
							<div class="slide">
								<?php 
								$news_count=1;
								while ( $related_news->have_posts() ) : $related_news->the_post(); ?>
									
										<section class="news-box">
									<h3>
										<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
									</h3>
									<p><?php 
											
											$content=get_the_content();
											echo wp_trim_words($content, 50, '')."...";
											
											?></p>
									<a href="<?php the_permalink();?>" class="btn btn-link">Read
										Article</a>
								</section>	
									<?php 
									if($news_count==5)
									{
										echo "</div><div class='slide'>";
									}
									$news_count++;
									if( $news_count > 10 ) break;
									endwhile; wp_reset_postdata();?>
									</div>
						</div>		
								
								<?php   endif;?>								
								
							</div>
					<div class="pagination-holder">
						<a class="btn-prev" href="#">Previous</a>
						<div class="pagination">
							<!-- pagination generated here -->
						</div>
						<a class="btn-next" href="#">Next</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<a href="#wrapper" class="back-to-top anchor-link"><i
	class="glyphicon glyphicon-menu-up"></i>Scroll to top</a> </main>
<?php get_footer();?>

