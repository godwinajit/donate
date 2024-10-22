<?php 
/*
		Template Name:Engineering guides Page
	*/
?>
	<?php get_header ();?>	
		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>Support</h1>
					</div>
					<div class="row">
						<div class="col-sm-9 col-md-9 col-sm-push-3" id="content">
							<div class="content-section">
								<?php the_field('page_description');?>								
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									
										<?php if( have_rows('pannel_title') ):
													$rows = get_field('pannel_title' ); // get all the rows
													$rowcount=count($rows);										
													$i=1;						
												 		while( have_rows('pannel_title') ): the_row();
												 		$download_section_pannel_id = "collapse".$i;
												 		$pannel_title_id= "heading".$i;
												 		
												 		?>
												 		<div class="panel panel-primary">								 		
												 		<div class="panel-heading" role="tab" id="<?php echo $pannel_title_id; ?>">
															<h4 class="panel-title">
															<?php if($i == '1') { $a_collapse_class = "collapse";}else { $a_collapse_class = "collapsed";} ?>
																<a class="<?php echo $a_collapse_class;?>" data-toggle="collapse" data-parent="#accordion" href="<?php echo "#".$download_section_pannel_id; ?>" aria-expanded="false" aria-controls="<?php echo $download_section_pannel_id; ?>">
																<?php echo get_sub_field('pannel_name');?>
																</a>
															</h4>
														</div>													
												
									<?php if($i == '1') { $pannel_collapse_class = "panel-collapse collapse in";}else { $pannel_collapse_class = "panel-collapse collapse";} ?>
										<div id="<?php echo $download_section_pannel_id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $pannel_title_id; ?>">
											<div class="panel-body">
												<ul class="list-unstyled download-list">
									<?php if( have_rows('pannel_download_list') ):
													$rows = get_sub_field('pannel_download_list' ); // get all the rows
													$rowcount=count($rows);										
													$j=1;						
												 		while( have_rows('pannel_download_list') ): the_row(); ?>								 		
												 		<li>
														<div class="holder">
															<a href="<?php the_sub_field('download_link');?>"><?php the_sub_field('download_list_name');?></a>
															<?php if($j == '1') {
																//echo '<i class="fa icon-link"></i>';
																echo"";
												 			}else {  echo '<i class="fa fa-file-pdf-o"></i>';} ?>
														 </div>
													</li>									
													<?php 	$j++; endwhile;?>
											   <?php endif; ?>	
										
												</ul>
											</div>
										</div>
										</div>	
										<?php 	$i++; endwhile;?>
											<?php endif; ?>		
																	
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
			<?php dynamic_sidebar( 'footer-section1' );?>
		</main>
		<?php get_footer ();?>