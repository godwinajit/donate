<?php

/**

 * The template for displaying all single posts

 *

 * @package WordPress

 * @subpackage Twenty_Thirteen

 * @since Twenty Thirteen 1.0

 */



get_header(); 





 $event_date = get_field('event_date');

 $date2 = date("Y-m-d");

?>



<div class="mains inner-pages<?php if(strtotime($event_date ) < strtotime($date2)){ echo ' recent-events';}else { echo ' upcoming-events';} ?>">

 <?php 

	if (has_post_thumbnail()) {

		//$post_page_id = 472;

		$banneurl = wp_get_attachment_url( get_post_thumbnail_id() );  

	}else {

		$banneurl = get_template_directory_uri().'/images/upcoming-event-banner.jpg';

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

  <?php



 

 //$event_date  = '2015-12-30';



if(strtotime($event_date ) < strtotime($date2))

{?>

<div class="container-section blog-pages">

  <div class="main main1196">

   <h1 class="page-title">Past Event <?php //get_the_title(); ?>

   </h1>

   <div class="content-left content-section-height">

    <?php		

		 		

		 		/* $d = date("Y-m-d");

				$args=array(

				 'post_type' => 'events',

				 'post_status' => 'publish',

				 'posts_per_page' => 1,

				 'meta_key' => 'event_date',

				 'orderby' => 'meta_value_num',

				 'order' => 'DESC',

				 'meta_query' => array(

							array(

									'key' => 'event_date',

									'value' => $d,

									'type' => 'date',

									'compare' => '<='

							)

					)

				 );

		 	 */

				//$args = array( 'posts_per_page' => 4, 'post_type'=> 'events',  'meta_key' => 'event_date', 'orderby' => 'meta_value_num', 'order' => 'DESC');					

				//$myposts = get_posts( $args );

				//foreach( $myposts as $post ) :	setup_postdata($post); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="recent-event-img-title cf">

    <div class="event-right mobile-event-right">

      <h3>

       <?php the_title(); ?>

      </h3>

      <div class="date-n-share cf"><span class="dateofevent">

       <?php $event_date = get_field('event_date');

								echo date('F j, Y',strtotime($event_date));

							?>

       </span>

       <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

      </div>

     </div>

     <figure class="event-left">

      <?php //the_post_thumbnail('full');

				$thumbnail_image = get_field('thumbnail_image');

					if($thumbnail_image){

						echo '<img src="'.$thumbnail_image['url'].'" alt="'.$thumbnail_image['alt'].'">';	

					}

				 ?>

			 

     </figure>

     <div class="event-right desk-event-right">

      <h3>

       <?php the_title(); ?>

      </h3>

      <div class="date-n-share cf"><span class="dateofevent">

       <?php $event_date = get_field('event_date');

								echo date('F j, Y',strtotime($event_date));

							?>

       </span>

       <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

      </div>

     </div>

    </div>

    <div class="entry-content"> <?php echo the_content(); ?> </div>

    

  <div class="comment-section cf"> 

  <?php

	

	 if ( ! is_user_logged_in() ) {

		echo '<div class="left-comment-form cf">'.do_shortcode('[wordpress_social_login]').'<div class="comment-login-head">or Pick a name</div></div>';

	 }

	

			comments_template( '/includes/comments.php');

			if ( ! is_user_logged_in() ) { // Display WordPress login form:

			$url = wp_login_url( get_permalink() );

			echo '<div class="right-comment-form"><div class="comment-login-head">Pick a name</div>';

			$args = array(

					'label_username' => __( 'User Name' ),

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

    <?php //endforeach; 

					wp_reset_postdata();

				?>

   </div>

   

   <!-- aside section -->

   <div class="aside-right content-section-height">

    <?php dynamic_sidebar('blogvideo-sidebar'); ?>

    <?php dynamic_sidebar('ga-sidebar'); ?>

    <?php dynamic_sidebar('aboutgrant-sidebar'); ?>

   </div>

  </div>

 </div>

<?php

	

}else

{ ?>

	<div class="container-section blog-pages">

  <div class="main main1196">

  <!-- <h1 class="page-title">Upcoming Events</h1>-->

   <div class="content-left content-section-height">

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



      <?php /*?><?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>

      <div class="single-thumbnail">

       <?php the_post_thumbnail('full'); ?>

      </div>

      <?php endif; ?><?php */?>

    

      <h1 class="page-title">

       <?php the_title(); ?>

      </h1>

 

     <!-- <div class="entry-meta">

       <div class="date-n-share cf"> <span class="dateofevent">

         <?php $event_date = get_field('event_date');

								echo date('F j, Y',strtotime($event_date));

							?>

        </span>

        <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

        <?php //twentythirteen_entry_meta(); ?>

        <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

       </div>

      </div>-->

      <!-- .entry-meta --> 

    

     

     <div class="entry-content">

      <?php

			/* translators: %s: Name of current post */

			

				the_content( sprintf(

				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),

				the_title( '<span class="screen-reader-text">', '</span>', false )

			) );

			$turn_off_form = get_field('turn_off_form');

			if(!$turn_off_form){

				echo '<div class="content-form cf">'.do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]').'</div>';

				echo '<div class="bottom-event-address bottom-event-address-html">'.$main_bottom_event_address = get_field('main_bottom_event_address', $post->ID).'</div>';	

			}

			

			$notification_email_address = get_field('notification_email_address');

			$user_info = get_userdata(1);

			$user_email = $user_info->user_email;

			

			if($notification_email_address){

				echo '<input type="hidden" id="notification_email_address" value="'.$notification_email_address.'" />';	

			}else{

				echo '<input type="hidden" id="notification_email_address" value="'.$user_email.'" />';	

			}

			

			

		?>

     </div>

     <!-- .entry-content -->

     

     <!-- .entry-meta --> 

    <!--  <div class="comment-section">-->

  <?php

/*comments_template( '/includes/comments.php');

			if ( ! is_user_logged_in() ) { // Display WordPress login form:

			$url = wp_login_url( get_permalink() );

			echo '<h3>Please login here to post a comment.</h3>';

			$args = array(

					'label_username' => __( 'User Name' ),

					'label_password' => __( 'Password' ),

					'label_log_in' => __( 'Log In' ),

					'remember' => false

					);

			wp_login_form($args);

			//echo '<a href="' . wp_lostpassword_url( $redirect ) . '">Lost Password?</a> | <a href="' . wp_registration_url() . '">Register</a>';

	} else { 

		

		 comments_template();

	}*/?>  

<!--</div>-->

    </article>

    

    <!-- #post -->    

    <?php endwhile; ?>

   </div>

   

   

   <div class="aside-right content-section-height">

   

    <?php //dynamic_sidebar('blogvideo-sidebar'); ?>

    <?php dynamic_sidebar('ga-sidebar'); ?>

    

    

    

   

   </div>

  </div>

  <!-- #content --> 

 </div>

<?php }

 ?>

</div>
  <!-- Subscribe CTA -->
<?php get_template_part( 'newsletter', 'form' ); ?>

 <?php //get_sidebar(); ?>

</div>

<?php get_footer(); ?>

