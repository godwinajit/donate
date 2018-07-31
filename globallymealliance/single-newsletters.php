<?php

/**

 * The template for displaying all single posts

 *

 * @package WordPress

 * @subpackage Twenty_Thirteen

 * @since Twenty Thirteen 1.0

 */



get_header(); ?>



<div class="inner-pages">

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

   <h1 class="page-title">Newsletters</h1>

   <div class="content-left content-section-height">

   	    <?php /* The loop */ ?>

    <?php while ( have_posts() ) : the_post(); 

			

			$redirect_url = get_field('redirect_url'); 

	 		wp_redirect($redirect_url);

	 

		 $event_date = get_field('event_date');

     $date2 = date("Y-m-d");

	 if(strtotime($event_date ) < strtotime($date2))

	 {

	?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="mobile-post-title-date  post-title-date">

	  <?php if ( is_single() ) : ?>

      <h2>

       <?php the_title(); ?>

      </h2>

      <?php else : ?>

      <h2> <a href="<?php the_permalink(); ?>" rel="bookmark">

       <?php the_title(); ?>

       </a> </h2>

      <?php endif; // is_single() ?>

      <div class="entry-meta">

       <div class="date-n-share cf"> <span class="dateofevent">

        <?php the_time('F j, Y'); ?>

        </span>

        <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

        <?php //twentythirteen_entry_meta(); ?>

        <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

       </div>

      </div>

      <!-- .entry-meta --> 

    </div>

    

      <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>

	      <div class="single-thumbnail">

	       <?php the_post_thumbnail('full'); ?>

	      </div>

	    <?php else : ?>

	    	<div class="single-thumbnail">

	    		<img src="<?php echo get_template_directory_uri(); ?>/images/post-default.jpg" class="attachment-full wp-post-image" alt="<?php the_title(); ?>" height="304" width="304">  

	    	</div>	

      <?php endif; ?>

      <div class="desktop-post-title-date post-title-date">

	  <?php if ( is_single() ) : ?>

      <h2>

       <?php the_title(); ?>

      </h2>

      <?php else : ?>

      <h2> <a href="<?php the_permalink(); ?>" rel="bookmark">

       <?php the_title(); ?>

       </a> </h2>

      <?php endif; // is_single() ?>

      <div class="entry-meta">

       <div class="date-n-share cf"> <span class="dateofevent">

        <?php the_time('F j, Y'); ?>

        </span>

        <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

        <?php //twentythirteen_entry_meta(); ?>

        <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

       </div>

      </div>

      <!-- .entry-meta --> 

    </div>

     

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

     

     <!-- .entry-meta --> 

    </article>

    

    <?php } ?>

    <!-- #post -->

    <?php //twentythirteen_post_nav(); ?>

     <div class="comment-section cf"> 

	 <?php

	 

	 if ( ! is_user_logged_in() ) {

		echo '<div class="left-comment-form cf">'.do_shortcode('[wordpress_social_login]').'<div class="comment-login-head">or Pick a name</div></div>';

	 }

			

			if ( ! is_user_logged_in() ) { // Display WordPress login form:

			$url = wp_login_url( get_permalink() );

			echo '<div class="right-comment-form"><div class="comment-login-head">Pick a name</div>';

			$args = array(

					'label_username' => __( 'Name' ),

					'label_password' => __( 'Password' ),

					'label_log_in' => __( 'Log In' ),

					'remember' => false

					);

			wp_login_form($args);

			echo '</div>';

			//echo '<a href="' . wp_lostpassword_url( $redirect ) . '">Lost Password?</a> | <a href="' . wp_registration_url() . '">Register</a>';

	} else { 

		 comments_template();

	}?>

    </div>

    <?php endwhile; ?>

   </div>

  <div class="aside-right content-section-height">

 <?php 

//    get_all_post_archive_category(); 

//   ?>

   

    <?php dynamic_sidebar('blogvideo-sidebar'); ?>

    <?php //dynamic_sidebar('ga-sidebar'); ?>
    <h2>Explore More</h2>
    <?php wp_nav_menu( array( 'theme_location' => 'side-menu', 'menu_class' => 'blog-sidemenu' )); ?>
    <?php dynamic_sidebar('blog-details-sidebar'); ?>



   </div>

  </div>

  <!-- #content --> 

 </div>

   <!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>

 <?php //get_sidebar(); ?>

</div>

<?php get_footer(); ?>

