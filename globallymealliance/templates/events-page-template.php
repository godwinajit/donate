<?php

/* Template Name: Events Page Template */

get_header('home'); ?>



<div class="inner-pages">

  <?php 

	if (has_post_thumbnail()) {

		$post_page_id = get_option( 'page_for_posts' );

		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post_page_id) ); 

	}else {

		$banneurl = get_template_directory_uri().'/images/template-banner.jpg';

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

  <div class="container-section blog-pages">

    <div class="main main1196">

      <div class="content-left content-section-height">

        <h1 class="page-title">

         Upcoming Events asdf

        </h1>

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

?>

          <div class="blog-list-container">

            <?php 

														$myposts = get_posts( $args );

														foreach( $myposts as $post ) :	setup_postdata($post); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

              <div class="blog-list-left">

                <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>

                <a href="<?php the_permalink(); ?>" rel="bookmark">

                <?php the_post_thumbnail('blog-list-thumb'); ?>

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

                <div class="entry-content">

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

      <div class="aside-right content-section-height">

        <?php dynamic_sidebar('blogvideo-sidebar'); ?>

        <?php dynamic_sidebar('ga-sidebar'); ?>

      </div>

    </div>

    <!-- #content --> 

  </div>

  <!-- #primary -->
     <!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>

</div>

<?php get_footer(); ?>