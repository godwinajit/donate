<?php 
/*
		Template Name:Videos Page
	*/
?>
	<?php get_header ();?>
		<main role="main" id="main">
			<div class="link-group inner">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri () ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>Support</h1>
					</div>
					<div class="row">
						<div class="col-sm-9 col-md-9 col-sm-push-3" id="content">
							<div class="content-section">
								<?php the_field('video_page_title');?>
								<div class="slide-carousel">
									<div class="mask">
										<div class="slideset">
											<?php if( have_rows('video_slider') ):
													$rows = get_field('video_slider' ); // get all the rows
													$rowcount=count($rows);										
													$i=1;						
												 		while( have_rows('video_slider') ): the_row(); 
												 		$video_link=get_sub_field('video_link');
												 		$video_link_flv=get_sub_field('video_link_flv');												 		
												 		$slider_image=get_sub_field('slider_image');												 		
												 		if(!empty($video_link_flv)):
												 		$flielink=$video_link."?file=".$video_link_flv."&amp;autoStart=true";
														else:
														$flielink=$video_link;
														endif;
												 		
												 		?>								 		
												 		<div class="slide">
															 <a href="<?php echo $flielink;?>" class="btn-play iframe"  data-rel="iframe" rel="lightbox">
															 <i class="icon-play"></i></a>
															 <img src="<?php echo $slider_image;  ?>" alt="image description" >
															<!-- <iframe name="iframeanimfx" scrolling="no" frameborder="12" width="869" height="486" src="<?php echo get_sub_field('video_link_new')."?autoplay=0";  ?>"  ></iframe>-->

																<?php 
																
																
															
																//echo do_shortcode('[videojs width="869" height="486" poster="'.$slider_image.'"  mp4="'.$video_link.'"]'); ?>
														</div>
													
													<?php 	$i++; endwhile;?>
									      <?php endif; ?>									
										</div>
									</div>
									<div class="carousel-nav">
										<div class="mask-inner">
											<div class="slideset-inner">
												<?php if( have_rows('video_slider') ):
													$rows = get_field('video_slider' ); // get all the rows
													$rowcount=count($rows);										
													$i=1;						
												 		while( have_rows('video_slider') ): the_row(); ?>								 		
												 		<div class="slide-inner">
															<span class="btn-play"><i class="icon-play"></i></span>
																<img src="<?php echo get_sub_field('thumbnail_image');  ?>" alt="image description" width="257" height="162">
														</div>													
													<?php 	$i++; endwhile;?>
									      		<?php endif; ?>												
											</div>											
										</div>
										<a class="button-prev" href="#"><i class="fa fa-chevron-left"></i></a>
										<a class="button-next" href="#"><i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<aside class="col-sm-3 col-sm-pull-9">
							<?php wp_nav_menu(array(
							'container'       => 'nav',
							'container_class' => 'add-nav',
							'container_id'    => '',
								'menu' => 'Left Menu', 	
								'menu_class'      => 'list-unstyled'						
							)); ?>
						</aside>
					</div>
				</div>
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
		<style>
	#fancybox-content{
		width:560px!important;
		height:340px!important;
	}
	#fancybox-close{
		right:-10px!important;
	}
	/*.icon-play {
	  /*left: 370px;*/
	  left:360px;
	  position: absolute;
	  top: 170px;
	}*/
	</style>
<?php get_footer ();?>