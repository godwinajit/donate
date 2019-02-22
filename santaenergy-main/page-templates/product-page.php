<?php

/* Template Name: Product Page */

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
  <?php if(get_field('show_page_title_in_page') == 'yes'): ?><h2><?php the_title();?></h2><?php endif;?>
    <div class="row align-items-center">
		<?php the_content();?>
    </div>
  </div>
</section>
<?php
	if( have_rows('statistics_repeater') ):
?>
<section class="stats mt-80 fs-sm">
  <div class="container container-wider">
    <div class="stats-area bg-darkblue">
      <div class="stats-list">
        <div class="row gap-54">
  				<?php
  				while ( have_rows('statistics_repeater') ) : the_row();
  				?>
  				<div class="col-sm-6 col-md-3 stats-box">
  				<strong class="title"> <?php the_sub_field('statistics_number'); ?> </strong>
  				<?php the_sub_field('statistics_description'); ?>
  				</div>
  				<?php
  				endwhile;
  				?>
    		</div>
      </div>
    </div>
  </div>
</section>
<?php
	endif;
?>
<?php get_template_part('template-parts/aside'); ?>

<?php get_footer();
