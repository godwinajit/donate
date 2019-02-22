<?php

/* Template Name: Contact Page */

get_header();

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
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
      <div class="col-md-4 col-lg-3">
		<?php get_sidebar();?>
      </div>
	<?php endif; ?>
      <div class="col-md-8">
		<?php if(get_field('show_page_title_in_page') == 'yes'): ?><h2><?php the_title();?></h2><?php endif;?>
          <div class="contact-form">
		  	<?php the_content();?>
          </div>
      </div>
    </div>
  </div>
</div>

<?php
    get_template_part( 'template-parts/testimony', 'section' );
?>

<section id="home-map" class="mt-80">
	<?php dynamic_sidebar('bottom-content-1');?>
</section>

<?php get_footer();
