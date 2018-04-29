<?php

/**

 * The template for displaying all single posts

 *

 * @package WordPress

 * @subpackage Twenty_Thirteen

 * @since Twenty Thirteen 1.0

 */



get_header(); ?>
<div class="mains">
    <div class="main">
      <div class="breadcrumbs-nav" typeof="BreadcrumbList" vocab="http://schema.org/">
      <?php bcn_display(); ?>
    </div>
   </div>
</div>

<div class="blog inner-pages">


 <?php 

	if (has_post_thumbnail()) {

		$post_page_id = get_option( 'page_for_posts' );
		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post_page_id) );  

	}

  if (has_post_thumbnail('thumbnail')) {
        $banneurl = get_template_directory_uri().'/images/post-banner-bug.png';
  }
  else {
    
		$banneurl = get_template_directory_uri().'/images/post-banner-bug.png';

	}


?>


 <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)" >

<div class="ipad-share">
                 <div class="share-div">
                  <?php echo do_shortcode("[apss_share counter='1']"); 
                    //echo do_shortcode('[sharethis]'); ?>
                </div>
                </div>
  <div class="main">

  </div>

 </div>





 <?php //echo do_shortcode('[IconSlider]'); ?>

 <div class="container-section blog-pages single">

  <div class="main blogmain">


   <!--h1 class="page-title"> <?php //echo apply_filters( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) ); ?> </h1-->

   <div class="content-left">

    <?php /* The loop */ ?>

    <?php while ( have_posts() ) : the_post(); 

			

			$redirect_url = get_field('redirect_url'); 

	 		if( ($redirect_url) &&  ($redirect_url !="")) wp_redirect($redirect_url);

	 

		 $event_date = get_field('event_date');

     $date2 = date("Y-m-d");

	 if(strtotime($event_date ) < strtotime($date2))

	 {

	?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="mobile-post-title-date  post-title-date">

	  <?php if ( is_single() ) : ?>
            <span class="byauthor">By: <?php the_author(); ?> </span>
             <span class="dateofevent"><?php the_time('F j, Y'); ?></span>



      <h2 class="search-title">

       <?php the_title(); ?>

      </h2>

      <?php else : ?>

      <h2 class="search-title"> <a href="<?php the_permalink(); ?>" rel="bookmark">

       <?php the_title(); ?>

       </a> </h2>

      <?php endif; // is_single() ?>

      <div class="entry-meta">


       <div class="date-n-share cf"> 

      


        <?php //twentythirteen_entry_meta(); ?>

        <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

       </div>

      </div>

      <!-- .entry-meta --> 

    </div>



      <div class="desktop-post-title-date post-title-date">

    <?php if ( is_single() ) : ?>
      <div>
           
      <span class="byauthor">By: <?php the_author(); ?> </span>


      <span class="dateofevent">

        <?php the_time('F j, Y'); ?>

        </span>
    </div>
      <h2>

       <?php the_title(); ?>

      </h2>

      <?php else : ?>

      <h2> <a href="<?php the_permalink(); ?>" rel="bookmark">

       <?php the_title(); ?>

       </a> </h2>

      <?php endif; // is_single() ?>
    
    
      <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>

	      <div class="single-thumbnail">

	       <?php the_post_thumbnail('full'); ?>

	      </div>

	    <?php else : ?>

	    	<div class="single-thumbnail">

	    		<img src="<?php echo get_template_directory_uri(); ?>/images/post-default.jpg" class="attachment-full wp-post-image" alt="<?php the_title(); ?>" height="304" width="304">  

	    	</div>	

      <?php endif; ?>
  <div class="share-div">
            <?php echo do_shortcode("[apss_share counter='1']"); 
              //echo do_shortcode('[sharethis]'); ?>
            </div>



      <div class="entry-meta">


   

        <?php //twentythirteen_entry_meta(); ?>

        <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>


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

       <!-- Gallery -->

       <?php     
       $blog_image_gallery = get_field('blog_image_gallery');
          if($blog_image_gallery){
          foreach($blog_image_gallery as $blog_gallery){
            if($blog_gallery['image_1']){
              echo '<div class="masonary-gallery">
                           <div class="column-1">
                            <img src="'.$blog_gallery['image_1'].'" />
                            <img src="'.$blog_gallery['image_3'].'" />
                            </div>
                            <div class="column-2">
                            <img src="'.$blog_gallery['image_2'].'" />
                            <img src="'.$blog_gallery['image_4'].'" />
                            </div>
                        </div>';
              } else {

            //display nothing
     echo '';
      }
      echo '';
          
      } 
    }
   ?>

     
       <!-- text content -->
       <?php 
          $add_text_after_images = get_field('add_text_after_images');
       ?>
       <div class="after-gallery">
       <?php echo $add_text_after_images; ?>
       </div>

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

 <?php  //  get_all_post_archive_category();  ?>

   <!--Doctor Side Bar -->

      <?php 
    $doctor_blurb_box = get_field('doctor_blurb_box'); 

    if($doctor_blurb_box){
      foreach($doctor_blurb_box as $doctor_blurb_boxs){
        if($doctor_blurb_boxs['doctor_image']){
          echo '<div class="doctor-box">
                      <img src="' . $doctor_blurb_boxs['doctor_image'] .'" alt="">
                        <h3 class="doctor-title">' . $doctor_blurb_boxs['doctor-about-title'] . '</h3>
                        <p>' . $doctor_blurb_boxs['add_about_doctor_description'] . '</p>
                    </div>';
          } else {
            //Nothing
        } 
    }
  }
   ?>
    <?php dynamic_sidebar('blogvideo-sidebar'); ?>

    <?php dynamic_sidebar('ga-sidebar'); ?>

   </div>

  </div>

  <!-- #content --> 

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
      </div>
    </section>


</div>
</main>

<?php get_footer(); ?>