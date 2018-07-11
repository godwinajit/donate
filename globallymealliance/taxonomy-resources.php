<?php
get_header ();
$bannerImageurl = '/wp-content/uploads/2015/12/Reading-Resources-hero.jpg';

$bannerurlId = get_field( 'resources_header', 'option');
$bannerImage = wp_get_attachment_image_src($bannerurlId, 'banner-top')[0];

if (!$bannerImage)
$bannerImage = $bannerImageurl;
global $wp_query;
$args = array_merge( $wp_query->query_vars, ['posts_per_page' => 8] );
query_posts( $args );
?>
<main class="mains">
<div class="inner-pages common-content-page">
	<div class="inner-banner" style="background-image:url(<?php echo $bannerImage; ?>)"></div>
	<div class="container-section resources-cat-container">
		<div class="wrapper container-fluid">
			<div class="row center-xs">
				<div class="col-xs-12 col-sm-11 col-md-10">
					<div class="boards resources-cat-page">
						<div class="inline">
							<h1 class="page-title">Resources</h1>
							<div class="resources-cat-filter">
								<ul>
									<li id="categories-li" class="blog-categories-select">
										<?php
											$args = array(
												'show_option_none' => __( 'Select category' ),
												'option_none_value'  => '',
												'show_count'       => 0,
												'orderby'          => 'name',
												'selected'	=> get_queried_object()->slug,
												'taxonomy' => 'resources',
												'value_field' => 'slug',
												'echo'             => 0,
												);
											?>
											<?php $select  = wp_dropdown_categories( $args ); ?>
											<?php $replace = "<select$1 onchange=\"window.location = '".esc_url( home_url( '/resources/' ) )."'+this.options
																    [this.selectedIndex].value\">"; ?>
											<?php $select  = preg_replace( '#<select([^>]*)>#', $replace, $select ); ?>
											<?php echo $select; ?>
									  </li>
								</ul>
							</div>
						</div>
						<div class="resources-cat-con-contain page">
							<div class="resources-cat-list-container resources-cat-masonary cols4-per-row">
							<?php if ( have_posts() ) : ?>
								<?php while (have_posts() ) : the_post(); ?>
									<article class="resources-cat-article">
									<?php if ( ! post_password_required() && ! is_attachment() ) : ?>
										<div class="resources-cat-image">
											<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
                  <?php the_post_thumbnail('blog-list-thumb'); ?>
                 <?php else : ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/images/post-default.jpg" class="attachment-blog-list-thumb wp-post-image" alt="<?php the_title(); ?>" height="304" width="304">
                 <?php endif; ?>
										</div>
										<div class="resources-cat-content">
											<div class="resources-cat-title">
												<?php 
												$termName = '';
													$terms = wp_get_object_terms( get_the_ID(), 'resources' );
														if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
															foreach ( $terms as $term ) {
        														$termName .= '<a href="'.esc_url( home_url( '/resources/' ) ).''.$term->slug . '">'.$term->name.'</a>, ';
														      }
													    }
														$termName = rtrim($termName,', ');
														echo $termName;
												?>
											</div>
												<h4><?php echo mb_strimwidth( get_the_title(), 0, 50, '...' ); ?></h4>
											<div class="resources-cat-desc">
												<?php echo mb_strimwidth( get_the_content(), 0, 250, '...' ); ?>
											</div>
											<div class="resources-cat-readmore">
												<a class="read-more" href="<?php the_permalink() ?>" title="Read More">READ MORE</a>
											</div>
										</div>
										<?php endif; ?>
									</article>
								<?php endwhile; ?>
							<?php endif; ?>
							</div>
								<?php wp_pagenavi(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Subscribe CTA -->
	<section class="section-subscribe">
		<div class="wrapper container-fluid">
			<div class="row center-xs">
				<div class="col-xs-12 col-sm-11 col-md-10">
					<div class="subscribe-form">
						<span class="icon icon-mail sm-visible"></span>
						<h2><?php echo get_field('newsletter_text', 2); ?></h2>
						<div class="form-row">
	                                         <?php echo do_shortcode('[ctct form="7979"]'); ?> 
                                    </div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</main>
<?php get_footer(); ?>
