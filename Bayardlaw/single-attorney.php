<?php
/**
 * The template for displaying all single posts
 *
 */

get_header(); ?>
<script type="text/javascript">
<!--
jQuery( document ).ready(function() {
	jQuery(".show-confirm-popup").confirm({ text:"<?php echo get_option( 'attorney_disclaimer' );?>"});
});
//-->
</script>
<div class="container">
		<ol class="breadcrumb">
			<li><a href="/our-attorneys/">Our Attorneys</a></li>
			<li class="active"><?php the_title(); ?> </li>
		</ol>
	</div>
	<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

	<main id="main" role="main">
		<header class="page-heading container-fluid text-center">
			<h1><?php the_title(); ?>  / <span><?php the_field('designation'); ?></span></h1>
		</header>
		<div class="content-section">
			<div class="container">
				<?php if(get_field('download_pdf')):?>
				<div class="links-panel clearfix text-right">
					<ul class="list-inline">
						<li><a href="<?php the_field('download_pdf');?>" class="link-download">Download PDF <i class="fa fa-download"></i></a></li>
					</ul>
				</div>
				<?php endif;?>
				<div class="biography-article row">
					<?php if(get_field('bio_image')):?>
					<div class="photo-col col-md-6 col-sm-4 col-xs-6">
					<?php
						$bio_imageId = get_field('bio_image');
						$bio_imageArr = wp_get_attachment_image_src( $bio_imageId, array( 819, 1024) );
					?>
						<img class="img-responsive border-img" src="<?php echo $bio_imageArr[0];?>" height="752" width="551" alt="">
					</div>
					<?php endif;?>
					<div class="description-wrap col-xs-12">
					<?php the_content();?>
					</div>
				</div>
				<article class="biography-details">
					<header class="heading text-center">
						<div class="heading-frame">
							<h2>Professional Biography</h2>
							<div class="divider style-dark"><div></div></div>
						</div>
					</header>
					<div class="row">
						<div class="info-col col-sm-7 col-xs-12">
							<h3><?php the_field('bar_admissions');?></h3>
							<?php if( have_rows('baradmission_content') ):
								?>
							<ul>
							<?php while ( have_rows('baradmission_content') ) : the_row();?>
								<li><?php the_sub_field('baradmissionvalues');?></li>
							<?php  endwhile;?>
							</ul>
							<?php endif; ?>
							<h3><?php the_field('court_admissions_heading');?></h3>
							<?php if( have_rows('court_admissions_content') ):
								?>
							<ul><?php while ( have_rows('court_admissions_content') ) : the_row();?>
								<li><?php the_sub_field('court_admissions_values');?></li>

								<?php  endwhile;?>
							</ul>
							<?php endif; ?>
							<h3><?php the_field('memberships_heading');?></h3>
							<?php if( have_rows('memberships_content') ):
								?>
							<ul><?php while ( have_rows('memberships_content') ) : the_row();?>
								<li><?php the_sub_field('memberships_values');?></li>
								<?php  endwhile;?>
							</ul>
							<?php endif; ?>
							<h3><?php the_field('education_heading');?></h3>
							<?php if( have_rows('education_content') ):
								?>
							<ul><?php while ( have_rows('education_content') ) : the_row();?>
								<li><?php the_sub_field('education_value');?></li>
								<?php  endwhile;?>
							</ul>
							<?php endif; ?>
							<h3><?php the_field('recognition_heading');?></h3>
							<?php if( have_rows('recognition_content') ):
								?>
							<ul class="list-inline"><?php while ( have_rows('recognition_content') ) : the_row();?>
							<?php $recognition_link = get_sub_field('recognition_link');
								  $recognition_image = get_sub_field('recognition_values');
							if(isset($recognition_image['sizes']['thumb200_200'])){
							if(!empty($recognition_link))
							{

								?>
								<li><a href="<?php the_sub_field('recognition_link');?>"><img class="img-responsive" style="display:inline-block;" src="<?php echo $recognition_image['sizes']['thumb200_200'];?>" alt=""></a></li>
							<?php } else {?>
							<li><img class="img-responsive" style="display:inline-block;" src="<?php echo $recognition_image['sizes']['thumb200_200'];?>" alt=""></li>

							<?php }
							}?>
							<?php  endwhile;?>
							</ul>
							<?php endif; ?>
							<?php
								if( have_rows('attorney_custom_content') ):
								    while ( have_rows('attorney_custom_content') ) : the_row(); ?>
								     <h3><?php	the_sub_field('attorney__custom_content_title');  ?></h3>
										<?php	if( have_rows('attorney_custom_inner_content') ): ?>
															<ul><?php while ( have_rows('attorney_custom_inner_content') ) : the_row();?>
																	<li><?php the_sub_field('custom_inner_content_value');?></li>
															<?php  endwhile;?>
															</ul>
									<?php	endif;
									endwhile;
								endif;
							?>
						</div>
						<div class="col-sm-5 col-xs-12">
							<div class="aside-box arrow-left">
								<h3>Practice Focus:</h3>
								<?php $post_categories = wp_get_post_categories( $post->ID );
									$post = &get_post($post->ID);
									// get post type by post
									$post_type = $post->post_type;
									// get post type taxonomies
									$taxonomies = get_object_taxonomies($post_type);

									$terms = get_the_terms( $post->ID, $taxonomies[0] );?>
								<ul class="links-list">
								<?php foreach($terms as $cat){
								if( $cat->parent != 120 ){
									?>
									<li><a href="<?php echo get_term_link( $cat );?>" class="btn btn-link"><?php echo $cat->name; ?></a></li>
									<?php 
								}
									}?>
								</ul>
							</div>
							<?php if(get_field('address')):?>
							<div class="aside-box arrow-left contacts-box">
								<?php the_field('address');?>
							</div>
							<?php endif;?>
						</div>
					</div>
				</article>
				<div class="accordion" role="tablist" class="panel-group" id="accordion" aria-multiselectable="true">
					<div class="panel panel-default">
					<?php $related_articles = new WP_Query(array(
							    'post_type' => 'post',
								'category_name' => 'articles',
							'posts_per_page' => 5,
							'orderby'   => 'date',
							'order'     => 'DESC',
								'meta_query' => array('relation' => 'AND',
										array(
												'key' => 'attorneys_tag', // name of custom field
												'value' => '"'.$post->ID.'"',
  												 'compare' => 'LIKE',
										)

								)
							));
						setup_postdata( $related_articles );

						if ( $related_articles->have_posts() ) : ?>
						<div id="collapseListGroupHeading1" role="tab" class="panel-heading">
							<h3 class="panel-title">
								<a class="opener" aria-controls="collapseListGroup1" aria-expanded="false" href="#collapseListGroup1" data-toggle="collapse" role="button" data-parent="#accordion">Articles</a>
							</h3>
						</div>
						<div aria-labelledby="collapseListGroupHeading1" role="tabpanel" class="panel-collapse collapse" id="collapseListGroup1" aria-expanded="false">
							<ul class="list-group">
							<?php while ( $related_articles->have_posts() ) : $related_articles->the_post(); ?>
								<li class="list-group-item">
									<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
									<a href="<?php the_permalink();?>" class="btn btn-link">Read More</a>
								</li>
								<?php endwhile; wp_reset_postdata();?>
							</ul>
						</div>
						<?php   endif;?>
						<?php $related_news = new WP_Query(array(
							    'post_type' => 'post',
								'category_name' => 'article',
								'posts_per_page' => 5,
								'orderby'   => 'date',
								'order'     => 'DESC',
								'meta_query' => array('relation' => 'AND',
										array(
												'key' => 'attorneys_tag', // name of custom field
												'value' => '"' . $post->ID . '"',
  												 'compare' => 'LIKE',
										)

								)
							));
						setup_postdata( $related_news );

						if ( $related_news->have_posts() ) :

						?>
						<div id="collapseListGroupHeading2" role="tab" class="panel-heading">
							<h3 class="panel-title">
								<a class="opener" aria-controls="collapseListGroup2" aria-expanded="false" href="#collapseListGroup2" data-toggle="collapse" role="button" data-parent="#accordion">News</a>
							</h3>
						</div>
						<div aria-labelledby="collapseListGroupHeading2" role="tabpanel" class="panel-collapse collapse" id="collapseListGroup2" aria-expanded="false">
							<ul class="list-group">
							<?php while ( $related_news->have_posts() ) : $related_news->the_post(); ?>
								<li class="list-group-item">
									<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
									<a href="<?php the_permalink();?>" class="btn btn-link">Read More</a>
								</li>

								<?php endwhile; wp_reset_postdata();?>
							</ul>
						</div>
						<?php   endif;?>
						<?php $related_legalupdate = new WP_Query(array(
							    'post_type' => 'post',
								'category_name' => 'legal-updates',
								'posts_per_page' => 5,
								'orderby'   => 'date',
								'order'     => 'DESC',
								'meta_query' => array('relation' => 'AND',
										array(
												'key' => 'attorneys_tag', // name of custom field
												'value' => '"' . $post->ID . '"',
  												 'compare' => 'LIKE',
										)

								)
							));
						setup_postdata( $related_legalupdate );

						if ( $related_legalupdate->have_posts() ) :

						?>
						<div id="collapseListGroupHeading3" role="tab" class="panel-heading">
							<h3 class="panel-title">
								<a class="opener" aria-controls="collapseListGroup3" aria-expanded="false" href="#collapseListGroup3" data-toggle="collapse" role="button" data-parent="#accordion">Legal Updates</a>
							</h3>
						</div>
						<div aria-labelledby="collapseListGroupHeading3" role="tabpanel" class="panel-collapse collapse" id="collapseListGroup3" aria-expanded="false">
							<ul class="list-group">
							<?php while ( $related_legalupdate->have_posts() ) : $related_legalupdate->the_post(); ?>
								<li class="list-group-item">
									<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
									<?php $source= get_field('source',get_the_ID());
											if(!empty($source))
											{
												echo $source;
											}
									?>
									<a href="<?php the_permalink();?>" class="btn btn-link">Read More</a>
								</li>

								<?php endwhile; wp_reset_postdata();?>
							</ul>
						</div>
						<?php   endif;?>
						<?php $related_publication = new WP_Query(array(
							    'post_type' => 'post',
								'category_name' => 'publications',
								'posts_per_page' => 5,
								'orderby'   => 'date',
								'order'     => 'DESC',
								'meta_query' => array('relation' => 'AND',
										array(
												'key' => 'attorneys_tag', // name of custom field
												'value' => '"' . $post->ID . '"',
  												 'compare' => 'LIKE',
										)

								)
							));
						setup_postdata( $related_publication );

						if ( $related_publication->have_posts() ) :

						?>
						<div id="collapseListGroupHeading4" role="tab" class="panel-heading">
							<h3 class="panel-title">
								<a class="opener" aria-controls="collapseListGroup4" aria-expanded="false" href="#collapseListGroup4" data-toggle="collapse" role="button" data-parent="#accordion">Publications</a>
							</h3>
						</div>
						<div aria-labelledby="collapseListGroupHeading4" role="tabpanel" class="panel-collapse collapse" id="collapseListGroup4" aria-expanded="false">
							<ul class="list-group">
							<?php while ( $related_publication->have_posts() ) : $related_publication->the_post(); ?>
								<li class="list-group-item">
									<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
									<?php $source= get_field('source',get_the_ID());
											if(!empty($source))
											{
												echo $source;
											}
									?>
									<a href="<?php the_permalink();?>" class="btn btn-link">Read More</a>
								</li>

								<?php endwhile; wp_reset_postdata();?>
							</ul>
						</div>
						<?php   endif;?>

					</div>
				</div>
			</div>
		</div>

		<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>
	<?php endwhile;  wp_reset_postdata();?>
<?php get_footer(); ?>