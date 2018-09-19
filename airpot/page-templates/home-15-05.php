<?php 
/*
		Template Name:Home Page
	*/
?>
	<?php get_header ();
	
	?>	
	<section class="intro carousel slide text-middle" data-ride="carousel" id="carousel">
		<div class="carousel-inner">
			<?php 
			$first_slide_item = true;
			if( have_rows('slide_images') ): 	
					    while ( have_rows('slide_images') ) : the_row();
					$bg_image=get_sub_field('bg_image');
					$small_image=get_sub_field('small_image');
					$header_text=get_sub_field('header_text');
				 	$sub_text1=get_sub_field('sub_text1');
				 	$sub_text2=get_sub_field('sub_text2');
				 	$read_story_text=get_sub_field('read_story_text');
				 	$read_story_link=get_sub_field('read_story_link');
				 	?>
				<div class="item <?php if($first_slide_item) { echo "active"; } ?>">
				<div class="img-block">
					<div class="holder"><img src="<?php echo $bg_image; ?>"  alt="image description"></div>
				</div>
				<div class="text-block">
					<div class="container">
						<div class="row">
							<div class="col-lg-offset-3 col-lg-9">
								<div class="block-holder">
			
									<?php if($header_text):?><div><div class="holder white"><?php echo preg_replace('~<p>(.*?)</p>~is', '$1', $header_text, /* limit */ 1);?></div></div><?php endif;?>							
									<?php if($sub_text1):?><div><div class="holder red"><?php echo preg_replace('~<p>(.*?)</p>~is', '$1', $sub_text1, /* limit */ 1);?></div></div><?php endif;?>									
									<?php if($sub_text2):?><div><div class="holder"><?php echo preg_replace('~<p>(.*?)</p>~is', '$1', $sub_text2, /* limit */ 1);?></div></div><?php endif;?>
									<?php if($read_story_text):?><a href="<?php echo $read_story_link;?>" class="btn btn-default"><?php echo $read_story_text;?></a><?php endif;?>
				</div>
								<img src="<?php echo $small_image; ?>"  alt="image description" class="img">
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				$first_slide_item = false;
					    endwhile;
					endif;
					?>	
			</div>
		<ol class="carousel-indicators">
			<li data-target="#carousel" data-slide-to="0" class="active"></li>
			<li data-target="#carousel" data-slide-to="1"></li>
			<li data-target="#carousel" data-slide-to="2"></li>
		</ol>
		<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">prev</a>
		<a class="right carousel-control" href="#carousel" role="button" data-slide="next">next</a>
	</section>
	<main>
		<div class="link-group">
			<a href="/product-lines"><span>Product Lines</span></a>
			<a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a>
		</div>
		
		<?php if ( is_active_sidebar( 'sidebar-homeapplications' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-homeapplications' );?>
		<?php endif;?>
		
		<section class="section-3dmodel text-middle">
			<?php the_field('3dmodelcontent');?>
		</section>
		
		<section class="product-list text-center" id="products">
			<div class="container">
		<?php if ( is_active_sidebar( 'sidebar-homeproducts' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-homeproducts' );?>
		<?php endif;?>
		
					<div class="col-sm-4">
						<div class="block">
							<img src="<?php echo get_field('home_page_promo_image_one'); ?>" width="370" height="329" alt="image description">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="block">
							<img src="<?php //echo get_field('home_page_promo_image_two'); ?>" width="916" height="300" alt="image description">
						</div>
					</div>
				</div>
				
					<?php the_field('brands_logo')?>
			</div>
		</section>
		<section class="video-section text-middle">
			<div class="img-block">
				<div class="holder"><img src="<?php echo get_template_directory_uri(); ?>/images/img05.jpg" width="1800" height="726" alt="image description"></div>
			</div>
			<div class="text-block text-center">
				<div class="container">
					<?php the_field('video_section_title')?>
					<a href="<?php the_field('video__section_video_link')?>" class="link iframe" data-rel="iframe" rel=""><span class="fa icon-play"></span>WATCH THE VIDEO</a>
				</div>
			</div>
		</section>
		<section class="container text-section">
			<?php the_field('airpot_corporation_company_history')?>
		</section>
		<section class="container text-section">
			<div class="row">
				<div class="col-sm-8 col-sm-push-4">
					<section class="slideshow carousel slide" data-ride="carousel" id="slideshow">
						<h2><?php the_field('our_people_section_slider_title');?></h2>
						<div class="carousel-inner">
							<?php if( have_rows('our_people_section_slider') ):
									$rows = get_field('our_people_section_slider' ); // get all the rows
									$rowcount=count($rows);										
									$i=1;						
								 		while( have_rows('our_people_section_slider') ): the_row(); ?>								 		
								 		<div class="<?php if($i == '1') { echo 'item active';} else{ echo 'item'; }?>">
								 		<img src="<?php echo get_sub_field('slider_image');  ?>" width="767" height="458" alt="image description">
								 		</div>
							<?php 	$i++; endwhile;?>
					      <?php endif; ?>						
						</div>
						<ol class="carousel-indicators">
							<?php if( have_rows('our_people_section_slider') ):
									$rows = get_field('our_people_section_slider' ); // get all the rows
									$rowcount=count($rows);										
									$i=0;						
								 		while( have_rows('our_people_section_slider') ): the_row(); ?>								 		
								 		<li data-target="#slideshow" data-slide-to="<?php echo $i;?>"  class="<?php if($i == '0') { echo 'active';}?>"><img src="<?php echo get_sub_field('thumbnail_image');?>" width="156" height="98" alt="image description"></li>
							<?php 	$i++; endwhile;?>
					      <?php endif; ?>		
						</ol>						
					</section>
				</div>		
				<div class="col-sm-4 col-sm-pull-8">
					<?php 	$post_objects = get_field('our_people_section_post_display');
			                if( $post_objects ): ?>
					    <ul class="posts list-unstyled">
						    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
						        <?php setup_postdata($post); ?>
						        <li>      
						            <div class="info"><time datetime="2014-06-24"><?php the_time('d F Y');?></time> | <?php the_author(); ?></div>
									<h3><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h3>
									<p><?php $content = get_the_content(); echo mb_strimwidth($content, 0, 130, ' [...]');?></p>
										<?php the_tags( '<ul class="tags list-inline list-unstyled"><li>', '</li>,<li>', '</li></ul>' ); ?>
						        </li>						
							    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					    <?php endif;?>					
				</div>
			</div>
		</section>
		<?php dynamic_sidebar( 'sidebar-contactus' );?>
	</main>
<?php get_footer ();?>