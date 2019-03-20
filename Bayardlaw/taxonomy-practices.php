<?php 
get_header();
$currentPractice = get_term_by('name', single_cat_title("",false), 'practices');
$parePractice = get_term_by('id', $currentPractice->parent, 'practices');
$banner_image = get_field('banner_image', $currentPractice);
 ?>
 
 	<div class="container">
		<ol class="breadcrumb">
			<li><?php echo $parePractice->name;?></li>
			<li class="active"><?php echo single_cat_title( '', false );?></li>
		</ol>
	</div>
	<section class="visual-section">
		<div class="bg-stretch">
		<?php if(!empty($banner_image)):?>
		<img src="<?php echo $banner_image;?>" alt="">
		<?php else:?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/img-visual-02.jpg" alt="">
		<?php endif;?>
		</div>
		<div class="container">
			<div class="frame">
			
				<div class="text-block center-block text-center">
					<div class="divider"><div></div></div>
					<h1><?php echo single_cat_title( '', false );?></h1>
				</div>
			</div>
		</div>
	</section>
	<main role="main" id="main">

		<div class="container content-container">
			<div class="sub-nav clearfix">
				<div class="tabset-holder">
					<ul class="tabset">
						<?php 	
								/** getting custom field values : tab contents */
								$title_count=1;
								if( have_rows('tab_content',$currentPractice) ):	
								while ( have_rows('tab_content',$currentPractice) ) : the_row();	
																
										$title = get_sub_field('title',$currentPractice);
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
								if( have_rows('tab_content',$currentPractice) ):	
								while ( have_rows('tab_content',$currentPractice) ) : the_row();	
										$title = get_sub_field('title',$currentPractice);
										$sku = str_replace(' ', '_', $title);
										$sku = preg_replace('/[^A-Za-z0-9\-]/', '', $sku); // remove all special chars
										$content = get_sub_field('content',$currentPractice);
										?>
										
										<div id="<?php echo $sku;?>">
											<article class="tab-article">
												<h2><?php echo $title;?></h2>
												<div class="content-columns">
													<div class="article-box">
														<?php echo $content;?>
													</div>
												</div>
											</article>
										</div>
										<?php
								endwhile;
								 endif;
								 ?>
								 
					<?php 
					$attorneys = get_posts(array(
							'post_type' => 'attorney',
							'numberposts' => -1,
							'tax_query' => array(
									array(
											'taxonomy' => 'practices',
											'field' => 'id',
											'terms' => $currentPractice->term_id, // Where term_id of Term 1 is "1".
											'include_children' => false
									)
							),
							
							'meta_key'			=> 'designation',
							'orderby'			=> 'meta_value meta_value_num',
							'order'				=> 'DESC'
					));

					if ( $attorneys ) :
					// This is a temporary fix for the attorney custom sorting. 
					if($currentPractice->slug == 'business-restructuring-liquidations'){
						$tempAttorneys = $attorneys[1];
						$attorneys[1]  = $attorneys[3];
						$attorneys[3]  = $tempAttorneys;
					}
					?>
				<div class="staff-section clearfix">
					<h3>Our Team</h3>
					<div class="row">
						<?php foreach ($attorneys as $attorney) :
							$attorney_image = wp_get_attachment_image_src( get_post_thumbnail_id( $attorney->ID ), 'full' );
						?>
						<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12">
							<section class="person-box alt same-height-left" style="height: 464px;">
								<figure class="img-box">
									<img width="360" height="365" alt="" src="<?php echo $attorney_image[0];?>">
									<figcaption>
										<h3><?php echo $attorney->post_title;?></h3>
										<span class="post"><?php $attorneydesignation= get_field_object('designation',$attorney->ID); 
										echo $attorneydesignation['value']?></span>
									</figcaption>
								</figure>
								<footer>
									<a class="btn btn-primary" href="<?php echo get_permalink($attorney->ID);?>"><span><span>Read Bio</span></span></a>
								</footer>
							</section>
						</div>
						<?php endforeach;?>
					</div>
				</div>
				<?php endif;
				if( have_rows('associated_professionals',$currentPractice) ): 
				?>
				<div class="staff-section clearfix">
					<h3>Associated Professionals</h3>
					<div class="row">
					
					<?php 
					while ( have_rows('associated_professionals',$currentPractice) ) : the_row();
					$title = get_sub_field('name',$currentPractice);
					?>
						<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12">
							<section class="person-box alt same-height-left same-height-right" style="height: 398px;">
								<figure class="img-box">
									<img width="360" height="365" alt="" src="<?php echo get_sub_field('profile_picture',$currentPractice);?>">
									<figcaption>
										<h3><?php echo $title;?></h3>
										<span class="post"><?php echo get_sub_field('title',$currentPractice);?></span>
									</figcaption>
								</figure>
							</section>
						</div>
					<?php endwhile;?>
						</div>
				</div>
				<?php endif;?>
			</div>
		</div>
		<?php 
			$tabCategories = get_field('news_articles',$currentPractice);
			if($tabCategories) :
		?>
		<div class="container">
			<div aria-multiselectable="true" id="accordion" role="tablist" class="accordion">
				<div class="panel panel-default">
			<?php foreach ($tabCategories as $tabCategory) :
			$categoryObj = get_term_by('id', $tabCategory, 'category');
			
			?>
			<?php 
					$args_news = array('post_type' => 'post',
							'posts_per_page' => 5,
							'orderby'   => 'date',
							'order'     => 'DESC',
							'cat' =>$categoryObj->term_id, 
							'meta_key' => 'practices_tag', 
							'meta_value' => $currentPractice->term_id, 
							'meta_compare' => 'like');
					$postList = new WP_Query( $args_news );
					
					if ($postList->have_posts()) :
					?>
				<div class="panel-heading" role="tab" id="collapseListGroupHeading<?php echo $tabCategory;?>">
						<h3 class="panel-title">
							<a data-parent="#accordion" role="button" data-toggle="collapse" href="#collapseListGroup<?php echo $tabCategory;?>" aria-expanded="false" aria-controls="collapseListGroup<?php echo $tabCategory;?>" class="opener"><?php echo $categoryObj->name;?></a>
						</h3>
					</div>
					
					<div aria-expanded="false" id="collapseListGroup<?php echo $tabCategory;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading<?php echo $tabCategory;?>">
						<ul class="list-group">
						<?php while ( $postList->have_posts() ) : $postList->the_post();  ?>						
							<li class="list-group-item">
								<h4><a href="<?php echo get_permalink($post->ID);?>"><?php echo get_the_title($post->ID);?></a></h4>
								<?php $source= get_field('source');
								$source="";
								if(!empty($source))
								{
									echo $source;
								}
								?>
								<span> <?php echo wp_trim_words(get_the_content($post->ID), 25, '...');?></span>
								<a class="btn btn-link" href="<?php echo get_permalink($post->ID);?>">Read More</a>
							</li>
						<?php endwhile;?>
						</ul>
					</div>
				<?php endif;
				
				endforeach;?>
					</div>
			</div>
		</div>
		<?php endif;?>
		<a class="back-to-top anchor-link" href="#wrapper"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>
	<?php get_footer();?>