<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<!-- Top banner -->

<div class="mains inner-pages">
 <?php 
	if (has_post_thumbnail()) {
		$post_page_id = get_option( 'page_for_posts' );
		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post_page_id) ); 
	}else {
		$banneurl = get_template_directory_uri().'/images/blog-banner-top.jpg';
	}
?>
 <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)">
  <div class="main">
   <div class="breadcrumb">
    <?php /* bcn_display(); */ ?>
   </div>
  </div>
 </div>
 <?php echo do_shortcode('[IconSlider]'); ?>
 <div class="container-section blog-pages">
  <div class="main main1196">
   <div class="content-left content-section-height">
    <h1 class="page-title"> <?php echo apply_filters( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) ); ?> </h1>
    <?php if ( have_posts() ) : ?>
    <?php /* The loop */ ?>
    <div class="blog-list-container">
     <?php while ( have_posts() ) : the_post(); ?>
     <?php 
	     $redirect_url = get_field('redirect_url'); 
     ?>
     <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="blog-list-left">
       <?php if ( ! post_password_required() && ! is_attachment() ) : ?>
	       <?php if ( $redirect_url ) : ?>
	       	<a href="<?php echo $redirect_url; ?>" target="_blank" rel="bookmark">
	       <?php else : ?>
	       	<a href="<?php the_permalink() ?>" rel="bookmark">	
	       <?php endif; ?>
	       <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
	       	<?php the_post_thumbnail('blog-list-thumb'); ?>
	       <?php else : ?>
	       	<img src="<?php echo get_template_directory_uri(); ?>/images/post-default.jpg" class="attachment-blog-list-thumb wp-post-image" alt="<?php the_title(); ?>" height="304" width="304">
	       <?php endif; ?>
	       </a>
       <?php endif; ?>
      </div>
      <div class="blog-list-right">
       <?php if ( is_single() ) : ?>
       <h3>
        <?php the_title(); ?>
       </h3>
       <?php else : ?>
       <h3> 
       	<?php if ( $redirect_url ) : ?>
       		<a href="<?php echo $redirect_url; ?>" target="_blank" rel="bookmark">
       	<?php else : ?>
       		<a href="<?php the_permalink() ?>" rel="bookmark">	
       	<?php endif; ?>
        <?php the_title(); ?>
        </a> </h3>
       <?php endif; // is_single() ?>
       <div class="entry-meta">
        <div class="date-n-share cf"><span class="dateofevent">
         <?php the_time('F j, Y'); ?>
         </span>
         <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>
         <?php //twentythirteen_entry_meta(); ?>
         <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
       </div>
       <!-- .entry-meta -->
       
       <?php if ( is_search() ) : // Only display Excerpts for Search ?>
       <div class="entry-content">
        <?php the_excerpt(); ?>
       </div>
       <!-- .entry-summary -->
       <?php else : ?>
       <div class="entry-content">
        <?php
			/* translators: %s: Name of current post */
			if(is_home()){
				 the_excerpt();	
			}else{
				the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); 	
			}
			
		?>
       </div>
       <!-- .entry-content -->
       <?php endif; ?>
      </div>
      
      <!-- .entry-meta --> 
     </article>
     <!-- #post -->
     
     <?php endwhile; ?>
    </div>
    <?php //twentythirteen_paging_nav(); ?>
    <?php wp_pagenavi(); ?>
    <?php else : ?>
    <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>
   </div>
   <div class="aside-right content-section-height">
    <?php 
    //get_all_post_archive_category(); 
		//echo do_shortcode('[archive_category id=""]');
   ?>

    <?php //dynamic_sidebar('blogvideo-sidebar'); ?>
    <?php //dynamic_sidebar('ga-sidebar'); ?>

    <h2>Explore More</h2>
        <?php wp_nav_menu( array( 'theme_location' => 'side-menu', 'menu_class' => 'blog-sidemenu' )); ?>

   </div>
  </div>
  <!-- #content --> 
 </div>
 
 
<!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>
</div>
<?php get_footer(); ?>
