<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package santaenergy-main
 */

get_header();
?>
<div class="page-header text-center bg-red">
  <div class="container">
	<?php get_template_part('template-parts/breadcrumbs'); ?>
	<?php get_template_part('template-parts/topcta'); ?>
  </div>
</div>
<div class="main-cols">
  <div class="container container-wider">
    <div class="row">
      <div class="col-md-7 col-lg-8">
        <?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_type() );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
		?>
<?php
// Get most recent posts from the same category as the current post
$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 2, 'post__not_in' => array($post->ID) ) );
if( $related )  {
?>
        <section class="recommended">
          <h2>Recommended Posts</h2>
          <div class="blog-grid">
            <div class="row mobile-slider">
			<?php
				foreach( $related as $post ) {
					setup_postdata($post);
					$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'santa-main-thumb-370-180'); 
					?>
		              <div class="col-md-6">
				        <article class="blog">
						  <a href="#" class="blog-link">
		                    <div class="blog-pic">
				             <div class="bg-stretch">
						     <?php if($featured_img_url){?>
								<span data-srcset="<?php echo $featured_img_url; ?>"></span>
							<?php }else{?>
								<span data-srcset="/wp-content/uploads/2013/07/comm_petro_products.jpg"></span>
							<?php }?>
		                     </div>
							<?php santa_get_post_tags();?>
							</div>
	                    <div class="blog-content">
		                 <h3><?php the_title();?></h3>
			              <p><?php echo wp_trim_words( get_the_excerpt(), 30, '...' );?></p>
				          <i class="icon-next"></i>
					   </div>
	                  </a>
		            </article>
			      </div>
			<?php }?>
            </div>
          </div>
        </section>
<?php
}
wp_reset_postdata(); ?>
      </div>
      <aside class="col-md-5 col-lg-4 aside">
        <?php dynamic_sidebar('blog-details');?>
      </aside>
    </div>
  </div>
</div>
<?php get_footer();
