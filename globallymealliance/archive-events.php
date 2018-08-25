<?php

/**

 * The template for displaying Archive pages

 *

 * Used to display archive-type pages if nothing more specific matches a query.

 * For example, puts together date-based pages if no date.php file exists.

 *

 * If you'd like to further customize these archive views, you may create a

 * new template file for each specific one. For example, Twenty Thirteen

 * already has tag.php for Tag archives, category.php for Category archives,

 * and author.php for Author archives.

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package WordPress

 * @subpackage Twenty_Thirteen

 * @since Twenty Thirteen 1.0

 */



get_header(); ?>



<div class="mains inner-pages archive-eventslist">

  <?php 

	if (has_post_thumbnail('547')) {

		$banneurl = wp_get_attachment_url( get_post_thumbnail_id('547') ); 

	}else {

		$banneurl = get_template_directory_uri().'/images/template-banner.jpg';

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

        <h1 class="page-title">

          <?php

					if ( is_day() ){

						printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );

					}elseif ( is_month() ){

						printf( __( 'Monthly aa Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );

					}elseif ( is_year() ){

						//printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );

						//$year = get_the_date();

						//if(empty($year)) {

								$data = explode('/', $_SERVER["REQUEST_URI"]);

								end($data);

								$year = prev($data);

								echo 'Yearly Archives: '.$year;

						//} 

					}else{

						_e( 'Upcoming Events', 'twentythirteen' );

					}

				?>

        </h1>

        <?php 

    if(is_day() || is_month() || is_year()){ ?>

        

        <!-- .archive-header -->

        <?php //if ( have_posts() ) : ?>

        <?php /* The loop */ ?>

        <div class="blog-list-container">

        <?php

				global $query_string;

				$year = get_the_time('Y');

				if(empty($year)) {

					$data = explode('/', $_SERVER["REQUEST_URI"]);

					end($data);

					$year = prev($data);

				}

				$from = $year."-01-01";

				//$todate = $year.date("-m-d");

				$todate = $year."-12-31";

						

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

										'value' => array($from,$todate),

										'type' => 'DATE',

										'compare' => 'BETWEEN'

												)

								)

						 );

        //print_r($args);

                query_posts( $args );?>

          <?php while ( have_posts() ) : the_post(); 

		  

	

	

		  ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="blog-list-left">

              <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>

              <a href="<?php the_permalink(); ?>" rel="bookmark">

              <?php the_post_thumbnail('blog-list-thumb'); ?>

              </a>

              <?php endif; ?>

            </div>

            <div class="blog-list-right">

              <?php if ( is_single() ) : ?>

              <h3>

                <?php the_title(); ?>

              </h3>

              <?php else : ?>

              <h3> <a href="<?php the_permalink(); ?>" rel="bookmark">

                <?php the_title(); ?>

                </a> </h3>

              <?php endif; // is_single() ?>

              <div class="entry-meta">

                <div class="date-n-share cf"><span class="dateofevent">

                  <?php //the_time('F j, Y');

				   echo $event_date = get_field('event_date');

				   ?>

                  </span>

                  <div class="share-div">

                    <?php echo do_shortcode('[sharethis]'); ?>

                  </div>

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

              

                  the_excerpt();

                  /*the_content( sprintf(

                  __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),

                  the_title( '<span class="screen-reader-text">', '</span>', false )

                ) );*/

          

              /*	wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); 	*/

              

                

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

        <?php //wp_pagenavi(); ?>

        <?php //else : ?>

        <?php //get_template_part( 'content', 'none' ); ?>

        <?php //endif; ?>

        <?php }else{ ?>



          <?php		

														

														$d = date("Y-m-d");

														$args=array(

														 'post_type' => 'events',

														 'post_status' => 'publish',

														 'posts_per_page' => -1,

														 'meta_key' => 'event_date',

														 'orderby' => 'meta_value_num',

														 'order' => 'ASC',

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

                <h3><a href="<?php the_permalink(); ?>" rel="bookmark">
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



        <?php		}  ?>

      </div>

      <div class="aside-right content-section-height">

        <?php dynamic_sidebar('blogvideo-sidebar'); ?>

        <?php dynamic_sidebar('ga-sidebar'); ?>

      </div>

    </div>

    <!-- #content --> 

  </div>

  <!-- #primary -->
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

<?php get_footer(); ?>

