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


<main class="mains">

<div class="inner-pages search-page search-results-view">

 <?php 

	if (has_post_thumbnail()) {

		$post_page_id = get_option( 'page_for_posts' );

		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post_page_id) ); 

	}else {

		$banneurl = get_template_directory_uri().'/images/blog-banner-top.jpg';

	}

?>





 <!--div class="inner-banner" style="background-image:url(<?php //echo $banneurl; ?>)">

  <div class="main">

   <div class="breadcrumb">

    <?php /* bcn_display(); */   ?>

   </div>

  </div>

 </div-->

 <?php //echo do_shortcode('[IconSlider]'); ?>

 <div class="container-section blog-pages search-results-view">
  <div class="main main1058">
  <div class="breadcrumbs-nav" typeof="BreadcrumbList" vocab="http://schema.org/">
        <?php bcn_display();   ?>
      </div>
   <div class="page">

     <?php

					if ( is_day() ) :

						printf( __( '<h1 class="search-label">' . 'Daily Archives:' . '</h1><h2 class="search-title">'.  '%s' . '</h2>', 'twentythirteen' ), get_the_date() );

					elseif ( is_month() ) :

						printf( __( '<h1 class="search-label">' . 'Monthly Archives: ' . '</h1><h2 class="search-title">'.  '  %s' . '</h2>', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );

					elseif ( is_year() ) :

						printf( __( '<h1 class="search-label">' . 'Yearly Archives: ' . '</h1><h2 class="search-title">'.  '%s' . '</h2>', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );

					else :

						_e( '<h2 class="search-title">'.'Archives' . '</h2>', 'twentythirteen' );

					endif;

				?>


    <!-- .archive-header -->

    <?php 
       
      if(isset($_GET['category']))

      {
      	 query_posts( array ( 'category_name' => $_GET['category'], 'posts_per_page' => -1 ) );
      	 $year =  get_the_date( _x( 'Y', '', 'twentythirteen' ));
      }
      ?>


      
      <?php if ( have_posts() ) : ?>
            <section>
              <div class="blognav nav">
              <?php wp_nav_menu(array( 'theme_location' => 'blog-menu', 'menu_class' => 'nav-list' ) ); ?>
            </div>
            </section>
           <section>
              <div class="search-year-menu-container">
                  <ul id="ActiveYearMenu" class="search-year-menu center-xs row">
                    <li><label>Filter By Year</label></li>
                    <!--li><a class="current_page_item" href="<?php //echo get_post_type_archive_link('post'); ?>">All</a></li-->
                       <?php echo do_shortcode('[SidebarBlogYear]') ?>
                      <li> <div class="select-mobile">
                        <select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
                            <option value=""><?php echo esc_attr( __( 'Select Year' ) ); ?></option> 
                            <?php wp_get_archives( array('type' => 'yearly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
                       </select>  
                  </div></li>  
                  </ul>
                </div>
            </section>

                  <?php /* The loop */ ?>

                  <div class="blog-list-container masonary">

                   <?php while ( have_posts() ) : the_post(); ?>


                   <?php 

                      	 if($year == get_the_date('Y'))

                          	 {

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
                           <div class="entry-meta">
                            <span class="dateofevent">

                               <?php the_time('F j, Y'); ?>

                            </span>

                             <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

                        </div>
                             <h2>

                              <?php echo mb_strimwidth( get_the_title(), 0, 50, '...' ); ?>

                             </h2>

                     <?php else : ?>

                            <div class="entry-meta">

                            <span class="dateofevent">

                               <?php the_time('F j, Y'); ?>

                            </span>
                            <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>

                            </div>
                             <h2> <a href="<?php the_permalink(); ?>" rel="bookmark">

                              <?php echo mb_strimwidth( get_the_title(), 0, 50, '...' ); ?>

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

        <?php mb_strimwidth( the_excerpt(), 0, 210, '...' ) ?>

       </div>

       <!-- .entry-content -->

       <?php else : ?>

       <div class="entry-summary">


        <?php

			/* translators: %s: Name of current post */

			if(is_home() || is_archive()){

				 the_excerpt();	

			}else{

				the_content( sprintf(

				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),

				the_title( '<span class="screen-reader-text">', '</span>', false )

			) );



		/*	wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); 	*/

			}

			

		?>

       </div>

       <!-- .entry-content -->

       <?php endif; ?>

      </div>

      

      <!-- .entry-meta --> 

     </article>

     

     <?php }?>

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

    //get_all_post_archive_category(''); 

   ?>

   

    <?php //dynamic_sidebar('blogvideo-sidebar'); ?>

    <?php //dynamic_sidebar('ga-sidebar'); ?>

   </div>

  </div>

  <!-- #content --> 

 </div>

 <!-- #primary -->
  <!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>
</div>
</main>
<?php get_footer(); ?>

