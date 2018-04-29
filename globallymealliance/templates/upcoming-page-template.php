<?php

/* Template Name: Upcomng Events Page Template */

get_header();

?>

<!-- Top banner -->



<div class="inner-pages upcoming-events">

 <?php 

	if (has_post_thumbnail()) {

		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  

	}else {

		$banneurl = get_template_directory_uri().'/images/upcoming-event-banner.jpg';

	}

?>

 <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)">

  <div class="main">

   <div class="breadcrumb">

    <?php //bcn_display();?>

   </div>

  </div>

 </div>

 <?php echo do_shortcode('[IconSlider]'); ?> 

 <!-- conatiner section -->

 <div class="container-section">

  <div class="main main1196">

   <h1 class="page-title">

    <?php the_title(); ?>

   </h1>

   <div class="content-left content-section-height">

    <?php		

		 		

		 		$d = date("Y-m-d");

				$args=array(

				 'post_type' => 'events',

				 'post_status' => 'publish',

				 'posts_per_page' => -1,

				 'meta_key' => 'event_date',

				 'orderby' => 'meta_value_num',

				 'order' => 'DESC',

				 'meta_query' => array(

							array(

									'key' => 'event_date',

									'value' => $d,

									'type' => 'date',

									'compare' => '>'

							)

					)

				 );

		 	

				//$args = array( 'posts_per_page' => 4, 'post_type'=> 'events',  'meta_key' => 'event_date', 'orderby' => 'meta_value_num', 'order' => 'DESC');					

				$myposts = get_posts( $args );

				foreach( $myposts as $post ) :	setup_postdata($post); ?>

    <h3 class="event-title">

     <?php the_title(); ?>

    </h3>

    <!--<div class="entry-meta">

     <div class="date-n-share cf"> <span class="dateofevent">

      <?php the_time('F j, Y'); ?>

      </span>

      <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

      <?php //twentythirteen_entry_meta(); ?>

      <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

     </div>

    </div>-->

    <!-- .entry-meta -->

    

    <div class="entry-content"> <?php echo the_content(); ?>

     <?php

		 

		 $turn_off_form = get_field('turn_off_form');

			if(!$turn_off_form){

				echo '<div class="content-form cf">'.do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]').'</div>';

				echo '<div class="bottom-event-address bottom-event-address-html">'.get_field('main_bottom_event_address').'</div>';	

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

    <?php endforeach; 

					wp_reset_postdata();

				?>

   </div>

   

   <!-- aside section -->

   <div class="aside-right content-section-height">

    <?php dynamic_sidebar('blogvideo-sidebar'); ?>

    <?php dynamic_sidebar('ga-sidebar'); ?>

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

<?php get_footer(); ?>