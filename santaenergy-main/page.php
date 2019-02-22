<?php
get_header();
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'santa-main-thumb-1177-677');
$is_full_width = true;

if ( is_active_sidebar( 'sidebar-1' ) ) {
	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'santa-main-thumb-370-180');
	$is_full_width = false;
}
?>
<div class="page-header text-center bg-red">
  <div class="container">
	<?php get_template_part('template-parts/breadcrumbs'); ?>
    <?php get_template_part('template-parts/topcta'); ?>
  </div>
</div>

<div class="main-cols">
  <div class="container container-wider">
    <div class="row">
	<?php if ( !$is_full_width ) { ?> 
      <div class="col-md-4 col-lg-3">
	    <?php get_sidebar(); ?>
      </div>
    <?php } ?>
      <div class="<?php echo $is_full_width ? 'col-md-12' : 'col-md-8 offset-lg-1';?>">
	    <?php if($featured_img_url){?>
		  <div class="blog-pic">
		  <div class="bg-stretch">
				<span data-srcset="<?php echo $featured_img_url; ?>"></span>
		  </div>
		  </div>
        <?php }?>
		  <?php if(get_field('show_page_title_in_page') == 'yes'): ?><h2><?php the_title();?></h2><?php endif;?>
          <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>

<?php get_template_part('template-parts/aside'); ?>
<?php get_footer();
