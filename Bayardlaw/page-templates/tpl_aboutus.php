<?php 

/*

  Template Name: About Us Page Template

 */

get_header('menubanner');
 ?>
	
	
	<main id="main" role="main">
		<div class="container content-container">
			<div class="sub-nav clearfix">
				<div class="tabset-holder">
					<ul class="tabset">
						<?php 	
								/** getting custom field values : tab contents */
								$title_count=1;
								if( have_rows('tab_content') ):	
								while ( have_rows('tab_content') ) : the_row();	
																
										$title = get_sub_field('title');
										$sku = str_replace(' ', '_', $title);
										$sku = preg_replace('/[^A-Za-z0-9\-]/', '', $sku); // remove all special chars
										if($title_count==1)
										{
											$active="active";
										}
										else {$active="";}
										if($title) echo "<li> <a href='#$sku'  class='$active'>".$title."</a></li>";
										$title_count++;
								endwhile;
								 endif;
								 if( have_rows('ads') ):
								 ?>
								 <li><a href="#tab-ads-gallery">Ads</a></li>
								 <?php endif;?>
					</ul>
				</div>
			</div>
			<div class="content-section">
			
			<?php 	
								/** getting custom field values : tab contents */
								if( have_rows('tab_content') ):	
								while ( have_rows('tab_content') ) : the_row();	
																
										$title = get_sub_field('title');
										$sku = str_replace(' ', '_', $title);
										$sku = preg_replace('/[^A-Za-z0-9\-]/', '', $sku); // remove all special chars
										$content = get_sub_field('content');
										$quote = get_sub_field('quote');		
										
										?>
										
										<div id="<?php echo $sku;?>">
											<article class="tab-article">
												<h2><?php echo $title;?></h2>
												<div class="content-columns">
													<div class="article-box">
														<?php echo $content;?>
													</div>
												</div>
												<blockquote>
													<?php echo $quote;?>
												</blockquote>
											</article>
										</div>
										
										
										
										<?php
								endwhile;
								 endif;
								 ?>
				
				
			<div id="tab-ads-gallery">
					<div class="row">
					
					<?php 	
								/** getting custom field values : tab contents */
							
								if( have_rows('ads') ):	
								while ( have_rows('ads') ) : the_row();	
										$ads_name = get_sub_field('ads_name');						
										$small_image = get_sub_field('small_image');
										$big_image = get_sub_field('big_image');																		
										//$size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
										
										if( $small_image ) {

											$small_image_new= $small_image['sizes']['thumb295_295'];

										}
											if( $big_image ) {

											$big_image_new= $big_image['sizes']['thumb500_667'];

										}
										?>
										<div class="gallery-col col-sm-4 col-xs-6"><a href="<?php echo $big_image_new;?>" data-rel="lightbox" data-fancybox-group="lightbox[ads-gallery]" height="295" width="295"><img class="img-responsive" src="<?php echo $small_image_new;?>" alt=""></a></div>
												<?php 
								endwhile;
								 endif;
								
								 ?>
					</div>
				</div>
			</div>
		</div>
		<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>
	<?php get_footer();?>