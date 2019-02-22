<?php

/* Template Name: Pricing Page */

get_header();
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'santa-main-thumb-370-180');
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
	  <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?> 
      <div class="col-md-4 col-lg-3">
	    <?php get_sidebar(); ?>
      </div>
    <?php } ?>
      <div class="col-md-8 offset-lg-1">
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

<section class="plans bg-gray">
  <div class="container container-wider">
    <div class="headline icon-logo text-center">
      <h2><?php the_field ('title'); ?></h2>
    </div>
	<div class="plan-grid">
      <div class="row">
	  <?php
		if( have_rows('plan_repeater') ):
			$count = 0;
			while ( have_rows('plan_repeater') ) : the_row();
		?>
		<div class="col-md-4">
			<a href="<?php the_sub_field('button_link'); ?>" class="item">
				<div class="frame">
					<div class="title">
						<i class="icon-spotlight"></i>
						<h3><?php the_sub_field('plan_title'); ?></h3>
					</div>
					<?php the_sub_field('plan_description'); ?>
					<ul>
						<?php while( have_rows('check_repeater') ): the_row(); ?>
						<li><?php the_sub_field('plan_check'); ?></li>
						<?php endwhile;?>
					</ul>
				</div>
				<div class="actions">
					<span class="button"><?php the_sub_field('button_text'); ?></span>
				</div>
			</a>
		</div>
		<?php  
		endwhile;
		endif;
		?>
	  </div>
	 </div>
  </div>
</section>

<?php
    get_template_part( 'template-parts/cta', 'section' );
?>

<?php get_footer();
