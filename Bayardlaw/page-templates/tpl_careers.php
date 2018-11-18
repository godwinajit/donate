<?php 

/*

  Template Name: Careers Page Template

 */

get_header('menubanner');
 ?>
	<main id="main" role="main">
		<div class="container content-container">
			<div class="sub-nav clearfix">
				<div class="tabset-holder tabset-autowidth">
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
								 ?>
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
										
										
										?>
										
										<div id="<?php echo $sku;?>">
											<article class="tab-article">
												<h3><?php echo $title;?></h3>
												
														<?php echo $content;?>
													
												
											</article>
										</div>
										
										
										
										<?php
								endwhile;
								 endif;
								 ?>
			</div>
		</div>
		<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>
	<?php get_footer();?>