<?php
/* Template Name: Recent Events Page Template */
get_header();
?>
<!-- Top banner -->

<div class="inner-pages recent-events">
 <?php 
	if (has_post_thumbnail()) {
		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  
	}else {
		$banneurl = get_template_directory_uri().'/images/recent-events-banner.jpg';
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
   <h1 class="page-title">Recent Events
    <?php //get_the_title(); ?>
   </h1>
   <div class="content-left content-section-height">
    <?php		
		 		
		 		$d = date("Y-m-d");
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
		 	
				//$args = array( 'posts_per_page' => 4, 'post_type'=> 'events',  'meta_key' => 'event_date', 'orderby' => 'meta_value_num', 'order' => 'DESC');					
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
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
      <?php the_post_thumbnail('full'); ?>
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
    
  <div class="comment-section">
  <?php
comments_template( '/includes/comments.php');
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
	}?>  
</div>
    
    <?php endforeach; 
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
