<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package santaenergy-main
 */

get_header();
?>

<div class="page-header text-center bg-red">
  <div class="container">
    <div class="breadcrumbs">
      <a href="<?php echo network_site_url();?>" class="go-back d-md-none"><i class="icon-back"></i>Home</a>
      <ul class="d-none d-md-block">
        <?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}
		?>
      </ul>
    </div>
	<?php if(get_field('banner_title', get_option( 'page_for_posts' ))){?>
	    <h1><?php the_field('banner_title', get_option( 'page_for_posts' ))?></h1>
	<?php }?>
	<?php if(get_field('banner_sub_title', get_option( 'page_for_posts' ))){?>
	    <p><?php the_field('banner_sub_title', get_option( 'page_for_posts' ))?></p>
	<?php }?>
	<?php if(get_field('banner_cta_text', get_option( 'page_for_posts' ))){?>
		<a href="<?php the_field('banner_cta_link', get_option( 'page_for_posts' ))?>" class="button" <?php echo get_field('banner_cta_link_new_window') == 'yes' ? 'target="_blank"' : '';?>><?php the_field('banner_cta_text', get_option( 'page_for_posts' ))?></a>
	<?php }?>
  </div>
</div>

<div class="blogs border-btm">
  <div class="container container-wider">
    <?php get_latest_post_for_archive();?>
    <section class="blog-grid">
      <div class="row">
		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content' );

			endwhile;

			//the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
      </div>
    </section>
	<div class="pager">
      <div class="pager-frame">
		<?php wp_pagenavi(); ?>
      </div>
    </div>
  </div>
</div>

<?php
get_footer();
