<?php

/**

 * The template for displaying Search Results pages

 *

 * @package WordPress

 * @subpackage Twenty_Thirteen

 * @since Twenty Thirteen 1.0

 */



get_header(); ?>
<main class="mains">
<div class="inner-pages search-page search-results-view searches">

 <?php 

	if (has_post_thumbnail()) {

		$post_page_id = get_option( 'page_for_posts' );

		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post_page_id) ); 

	}else {

		$banneurl = get_template_directory_uri().'/images/template-banner.jpg';

	}

?>

 <!--div class="inner-banner" style="background-image:url(<?php //echo $banneurl; ?>)">

  <div class="main">

   <div class="breadcrumb">

    <?php /* bcn_display(); */ ?>

   </div>

  </div>

 </div-->
 <div class="container-section blog-pages search-results-view">
  <div class="main main1058">
  <div class="page">

    <?php printf( __('<h1 class="search-label">' .'Search Results for:' . '</h1><h2 class="search-title">'. '%s' . '</h2>', 'twentythirteen' ), get_search_query() ); ?>

    <?php if ( have_posts() ) : ?>

<!--
      <section>
        <div class="search-year-menu-container">
            <ul class="search-year-menu center-xs row">
              <li><label>Filter By Year</label></li>
              <li class="current_page_item"><a class="current_page_item" href="<?php echo get_post_type_archive_link('Search'); ?>">All</a></li> -->
              <!-- Need to display by year search results -->
            <?php $args = array(
                'post_type'    => 'any',
                'type'         => 'yearly',
                'echo'         => 1
            );
            echo '<li>'.wp_get_archives($args).'</li>';

             ?>
              <?php //is_search(array('type' => 'yearly')); ?>            
   <!--         </ul>
          </div>
      </section> -->

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
      <span class="dateofevent">

         <?php the_time('F j, Y'); ?>

        </span>
       <h3>
        <?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
        <?php echo $title; ?>

       </h3>

       <?php else : ?>

       <span class="dateofevent">

         <?php the_time('F j, Y'); ?>

        </span>
      

       <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

       <h2> 

       	<?php if ( $redirect_url ) : ?>

       		<a href="<?php echo $redirect_url; ?>" target="_blank" rel="bookmark">

       	<?php else : ?>

       		<a href="<?php the_permalink() ?>" rel="bookmark">	

       	<?php endif; ?>


        <?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
        
        <?php echo $title; ?>

        </a> </h2>

       <?php endif; // is_single() ?>

       <!--div class="entry-meta">

        <div class="date-n-share cf">


         <?php //twentythirteen_entry_meta(); ?>

         <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

        </div>

       </div>

       <!-- .entry-meta -->

       

       <?php if ( is_search() ) : // Only display Excerpts for Search ?>

       <div class="entry-summary">

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

  </div>

  <!-- #content --> 

 </div>

 <!-- #primary -->
  </div>
<!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>

</main>
<?php get_footer(); ?>