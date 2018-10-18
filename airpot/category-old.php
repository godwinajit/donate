<?php get_header ();?>
		<main id="main">
			<div class="bg-stretch bg-fixed"><img src="<?php echo get_template_directory_uri ();?>/images/Universe-Background.jpg" width="1715" height="800" alt="image description"></div>
			<div class="container content-holder">
				<div class="row">
					<div class="col-sm-7 col-md-8 content" id="cat_post_list">
						<?php while (have_posts()) : the_post();
									  $category_detail=get_the_category($post->ID);
                                      $featured_video = the_field('Featured_video',$post->ID);
                                      $featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
									  ?>
									  <?php if($featured_video != "" ) {?>									  			
									  <a href="" class="lightbox"><?php echo $featured_video; ?></a>
									 <?php } elseif($featured_image != "") { ?>
									<a href="<?php echo $featured_image; ?>" class="lightbox"><img src="<?php echo $featured_image; ?>" width="897" height="356" alt="<?php the_title();?>"></a>
								    <?php } 
								    else {?>
								    <a href="" class="lightbox"><img src="" width="897" height="356" alt=""></a>
								    <?php }?>
								    <div class="article-holder">
								    <aside class="meta">
											<dl>
												<dt class="date sr-only">Post date:</dt>
												<dd>
													<time datetime="<?php echo get_the_date(); ?>" class="entry-date time-date"><?php echo get_the_date('d'); ?><span><?php echo get_the_date('M'); ?></span></time>
												</dd>
												
											</dl>
											
										</aside>
										<h2 style="padding-top: 25px;"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
										</div>
										<?php endwhile;?>
			            							
					</div>
					
					<aside class="col-sm-5 col-md-4 sidebar">
						<div class="widget panel panel-default">
							<?php dynamic_sidebar( 'sidebar-right-1' );?>	
						</div>
						<div class="widget panel panel-default">
							<?php dynamic_sidebar( 'sidebar-right-2' );?>
						</div>
					</aside>
				</div>
			</div>
		</main>
<?php get_footer ();?>