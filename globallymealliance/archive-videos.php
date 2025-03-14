<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<!-- Top banner -->
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


 <?php //echo do_shortcode('[IconSlider]'); ?>
 <div class="container-section blog-pages search-results-view">
  <div class="main main1058">
  <div class="breadcrumbs-nav" typeof="BreadcrumbList" vocab="http://schema.org/">
            <?php bcn_display();   ?>
          </div>
  <div class="page">
    <?php 
      if (is_year()){
        $data = explode('/', $_SERVER["REQUEST_URI"]);
        end($data);
        $year = prev($data);
        echo '<h1 class="search-label">' . 'Yearly Video Archives: ' . '</h1><h2 class="search-title">' .$year .'</h2>';
    ?>
    <?php 
      }  else{
    ?>
     <!-- Title for Videos -->
     <h1 class="title-center">Videos</h1>
    <?php 
      }
    ?>  


        <?php 

if(isset($_GET['category']))

{
   query_posts( array ( 'category_name' => $_GET['category'], 'posts_per_page' => -1 ) );
   $year =  get_the_date( _x( 'Y', '', 'twentythirteen' ));
}
?>

      <section>
        <div class="blognav nav">
        <?php wp_nav_menu(array( 'theme_location' => 'blog-menu', 'menu_class' => 'nav-list' ) ); ?>
      </div>
      </section>
     <section>
        <div class="search-year-menu-container">
            <ul id="ActiveYearMenu" class="search-year-menu">
              <li><label>Filter By Year</label></li>
              <li><a class="current_page_item" href="<?php echo get_post_type_archive_link('videos'); ?>">All</a></li>
				<?php //echo do_shortcode('[SidebarVideosYear]') ?>
			   <?php wp_get_archives( array('post_type' => 'videos','post_status' => 'publish', 'type' => 'yearly','before' => '<ul>','after' => '</ul>', 'format' => 'html', 'show_post_count' => 0 ) ); ?>
                <li> <div class="select-mobile">
                  <select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
                      <option value=""><?php echo esc_attr( __( 'Filter By Year' ) ); ?></option> 
                      <?php wp_get_archives( array('post_type' => 'videos', 'type' => 'yearly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
                 </select>  
            </div></li>     
            </ul>
          </div>
      </section>

      <?php if (!is_paged()) { ?>

<!-- Start Featured Image -->
      <?php  
              $newargs = array(
                  'posts_per_page' => 1,
                  'meta_key' => 'meta-checkbox',
                  'meta_value' => 'yes',
                  'post_type' => 'videos',
              );
              $featured = new WP_Query($newargs);
           
          if ($featured->have_posts()) : while($featured->have_posts()): $featured->the_post(); ?>

       <div class="first-article">
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
             <div class="entry-meta">
              <div class="date-n-share cf">
              <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>
              <span class="dateofevent">
               <?php the_time('F j, Y'); ?>
               </span>
              </div>
             </div>

              <h2> 
              <?php if ( $redirect_url ) : ?>
                <a href="<?php echo $redirect_url; ?>" target="_blank" rel="bookmark">
              <?php else : ?>
                <a href="<?php the_permalink() ?>" rel="bookmark">  
              <?php endif; ?>
                  <?php echo mb_strimwidth( get_the_title(), 0, 50, '...' ); ?>

                </a> 
              </h2>
             <!-- .entry-meta -->
             
             <div class="entry-content">
              <?php
               the_excerpt(); 
              ?>
             </div>
             <!-- .entry-content -->
            </div>
            
            <!-- .entry-meta --> 
           </article>
           </div>
           <?php endwhile; else:
          endif;
          ?>

    <?php } ?>
   
<!-- End Featured Image -->


    <?php if ( have_posts() ) : ?>

    <?php /* The loop */ ?>
        <!-- if paged show this container -->
      <?php 
        echo '<div class="blog-list-container masonary">';
      ?>


    <?php while ( have_posts() ) : the_post(); ?>
           <!-- #post -->
      <!-- show all other articles -->

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
               <div class="entry-meta">
                <div class="date-n-share cf"><span class="dateofevent">
                 <?php the_time('F j, Y'); ?>
                 </span>
                 <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>
                </div>
               </div>

                <h2> 
                <?php if ( $redirect_url ) : ?>
                  <a href="<?php echo $redirect_url; ?>" target="_blank" rel="bookmark">
                <?php else : ?>
                  <a href="<?php the_permalink() ?>" rel="bookmark">  
                <?php endif; ?>
                          <?php echo mb_strimwidth( get_the_title(), 0, 50, '...' ); ?>

                  </a> 
                </h2>
               <!-- .entry-meta -->
               
               <div class="entry-content">
                <?php
                 the_excerpt(); 
                ?>
               </div>
               <!-- .entry-content -->
              </div>
              
              <!-- .entry-meta --> 
             </article>
        
    
             <!-- #post -->
     <?php endwhile; ?>
             <!-- close div if first next page -->
</div>


    <?php //twentythirteen_paging_nav(); ?>
    <?php wp_pagenavi(); ?>
    <?php else : ?>
    <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>
   </div>
   <!--div class="aside-right content-section-height">
    <?php 
    //get_all_post_archive_category(); 
    //echo do_shortcode('[archive_category id=""]');
   ?>
   
    <?php //dynamic_sidebar('blogvideo-sidebar'); ?>
    <?php //dynamic_sidebar('ga-sidebar'); ?>
   </div-->
   </div>
  <!-- #content --> 
 </div>
 </div>
   <!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>
</div>
</main>
<?php get_footer(); ?>
