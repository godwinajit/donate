<?php
get_header ();
$banneurl = '/wp-content/uploads/2015/12/Reading-Resources-hero.jpg';
?>
<main class="mains">
<div class="inner-pages common-content-page">
	<div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)"></div>
	<div class="container-section resources-cat-container">
		<div class="wrapper container-fluid">
			<div class="row center-xs">
				<div class="col-xs-12 col-sm-11 col-md-10">
					<div class="boards resources-cat-page">
						<h1 class="page-title">Resources</h1>
						<div class="resources-cat-filter">
							<ul>
								<li id="categories-li">
										<?php
										$url = site_url( '/resources/', 'https' );
										$args = array (
												'show_option_all' => '',
												'show_option_none' => 'Category',
												'option_none_value' => '',
												'orderby' => 'ID',
												'order' => 'ASC',
												'show_count' => 0,
												'hide_empty' => 1,
												'child_of' => 0,
												'exclude' => '',
												'include' => '',
												'echo' => 1,
												'selected' => get_query_var('term'),
												'hierarchical' => 0,
												'name' => 'resources-cat',
												'id' => 'resources-cat',
												'class' => 'resources-cat',
												'depth' => 0,
												'tab_index' => 0,
												'taxonomy' => 'resources',
												'hide_if_empty' => true,
												'value_field' => 'slug',
												'post_status' => 'publish'
										);
										?>
										<?php wp_dropdown_categories( $args ); ?>
									</li>
							</ul>
						</div>
						<div class="resources-cat-con-contain page">
							<div class="resources-cat-list-container resources-cat-masonary">
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
        														$termName .= '<a href="'.$url.''.$term->slug . '">'.$term->name.'</a>, ';
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
<script>
    $(function(){
		var siteUrl = "<?php echo $url?>";
      // bind change event to select
      $('#resources-cat').on('change', function () {
          var slug = $(this).val(); // get selected value
          if (slug) { // require a slug
              window.location = siteUrl+slug; // redirect
          }
          return false;
      });
    });
</script>
