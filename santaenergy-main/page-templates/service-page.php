<?php

/* Template Name: Service Page */

get_header();

?>
<div class="page-header text-center bg-red">
  <div class="container">
	<?php get_template_part('template-parts/breadcrumbs'); ?>
	<?php get_template_part('template-parts/topcta'); ?>
  </div>
</div>

<section class="intro">
  <div class="container">
  <center><?php if(get_field('show_page_title_in_page') == 'yes'): ?><h2><?php the_title();?></h2><?php endif;?></center>
    <div class="row align-items-center">
	  <?php the_content();?>
    </div>
  </div>
</section>

<div class="main-cols mt-80">
  <div class="container container-wider">
    <div class="row">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
      <div class="col-md-4 col-lg-3">
		<?php get_sidebar();?>
      </div>
	  <?php }?>
      <div class="col-md-8 offset-lg-1">

          <?php the_field('secondary_content');?>
      </div>
    </div>
  </div>
</div>

<?php if( (is_active_sidebar( 'sidebar-2' )) || (have_rows('plans')) ){?>
<div class="main-cols bg-gray ptb-80 mt-80">
  <div class="container container-wider">
    <div class="row">
	  <?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
      <div class="col-md-4 col-lg-3">
        <?php dynamic_sidebar('sidebar-2');?>
      </div>
	  <?php }?>

	  <?php
		if( have_rows('plans') ):
	  ?>
      <div class="col-md-8 offset-lg-1">
          <div class="row mobile-slider">
			<?php
				while ( have_rows('plans') ) : the_row();
				$plan_image = get_sub_field('plan_image');
				$plan_image_size = 'santa-main-thumb-742-360';
			?>
              <div class="col-md-6">
                  <div class="section-cat">
				  <?php if( $plan_link) {?>
                    <a href="<?php the_sub_field('plan_link'); ?>">
						<?php
						}
					    ?>
					  <?php if( $about_image ) {?>
                      <div class="section-cat-img" style="background-image: url('<?php echo $plan_image['sizes'][ $plan_image_size ];?>');"></div>
					  <?php
						}
					  ?>
                      <div class="news-det pb-30">
                        <h3><?php the_sub_field('plan_title'); ?></h3>
                        <?php the_sub_field('plan_description'); ?>
						<?php if( $plan_link) {?>
                        <span class="news-link">page link</span>
						<?php
						}
					    ?>
                      </div>
                    </a>
                  </div>
              </div>
			<?php
				endwhile;
			?>
          </div>
		  <div>  
		  <?php 
			$additional_content = get_field('additional_content');
			if( $additional_content ):
				echo $additional_content;
			endif;
		  ?>
		  </div>
      </div>
	  <?php
		endif;
	  ?>

    </div>
  </div>
</div>
<?php
	}
?>

<?php
    get_template_part( 'template-parts/service', 'section' );
?>

<?php
    get_template_part( 'template-parts/testimony', 'section' );
?>

<div class="protect text-center"  style="margin-top: 50px;">  
<?php 
$protect_link = get_field('protect_link');
$protect_text=get_field('protect_text');
if( $protect_link ): ?>
	
	<a class="button" href="<?php echo $protect_link; ?>" <?php echo trim(get_field('protect_select_option')) ? 'data-selectval="'.trim(get_field('protect_select_option')).'"' : '';?>> <?php echo $protect_text; ?></a>

<?php endif; ?>

</div>

<section class="product-explanation mt-80">
  <div class="container">
    <div class="product-panel bg-darkblue">
      <?php the_field('bottom_content');?>
    </div>
  </div>
</section>

<section class="news-section bg-darkblue mt-80">
	<?php get_template_part('template-parts/latestNewsPosts'); ?>
</section>

<?php get_footer();
