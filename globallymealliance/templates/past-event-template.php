<?php

/* Template Name: Past Events Page Template */

get_header();

?>

<!-- Top banner -->

<main class="mains">

<div class="inner-pages recent-events">

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

    <?php /* bcn_display(); */?>

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

																			'compare' => '<'

																	)

															)

														 );

													

//$args = array( 'posts_per_page' => 4, 'post_type'=> 'events',  'meta_key' => 'event_date', 'orderby' => 'meta_value_num', 'order' => 'DESC');					

?>

          <div class="blog-list-container">

            <?php 

														$myposts = get_posts( $args );

														foreach( $myposts as $post ) :	setup_postdata($post); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

              <div class="blog-list-left">

                <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>

                <a href="<?php the_permalink(); ?>" rel="bookmark">

                <?php //the_post_thumbnail('blog-list-thumb');

									$thumbnail_image = get_field('thumbnail_image');

									if($thumbnail_image){

										echo '<img src="'.$thumbnail_image['url'].'" alt="'.$thumbnail_image['alt'].'">';	

									}

								 ?>

                </a>

                <?php endif; ?>

              </div>

              <div class="blog-list-right">

                <h3> <a href="<?php the_permalink(); ?>" rel="bookmark">

                  <?php the_title(); ?>

                  </a> </h3>

                <div class="entry-meta">

                  <div class="date-n-share cf"> <span class="dateofevent">

                     <?php $event_date = get_field('event_date');

								echo date('F j, Y',strtotime($event_date));

							?>

                    </span>

                    <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

                    <?php //twentythirteen_entry_meta(); ?>

                    <?php //edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

                  </div>

                </div>

                <!-- .entry-meta --> 

                <!-- .entry-meta -->

                

                <?php if ( is_search() ) : // Only display Excerpts for Search ?>

                <div class="entry-content">

                  <?php the_excerpt(); ?>

                </div>

                <!-- .entry-summary -->

                <?php else : ?>

                <div class="boards">

                  <?php

               

              

                  the_excerpt();

                  

              

                

              ?>

                </div>

                <!-- .entry-content -->

                <?php endif; ?>

              </div>

            </article>

            <?php endforeach; 

															wp_reset_postdata();

														?>

          </div>

   </div>

   

   <!-- aside section -->

   <div class="aside-right content-section-height">

    <?php dynamic_sidebar('blogvideo-sidebar'); ?>

    <?php dynamic_sidebar('ga-sidebar'); ?>

     <?php dynamic_sidebar('aboutgrant-sidebar'); ?>

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

