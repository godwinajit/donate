<?php

/* Template Name: Equipment Listing Page */

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
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
      <div class="col-md-4 col-lg-3">
        <?php get_sidebar();?>
      </div>
	 <?php } ?>
      <div class="col-md-8 offset-lg-1">
	  <?php if(get_field('show_page_title_in_page') == 'yes'): ?><h2><?php the_title();?></h2><?php endif;?>
      <?php the_content();?>
		<p><?php the_field('equipment_detail_list_title'); ?></p>
		<?php
			if( have_rows('equipment_detail_list') ):
		?>
	        <div class="post-list">
			<?php
				while ( have_rows('equipment_detail_list') ) : the_row();
				$equipment_detail_image = get_sub_field('equipment_detail_image');
				$equipment_detail_image_size = 'santa-main-thumb-100-125';
			?>
			  <div class="post">
				<div class="p-pic">
	              <a href="<?php the_sub_field('equipment_detail_page_link'); ?>"><img class="product-img" src="<?php echo $equipment_detail_image['sizes'][ $equipment_detail_image_size ];?>" alt="<?php	the_sub_field('equipment_detail_title'); ?>"></a>
	            </div>
		        <div class="p-content">
			      <h3><a href="<?php the_sub_field('equipment_detail_page_link'); ?>"><?php the_sub_field('equipment_detail_title'); ?></a></h3>
				  <?php the_sub_field('equipment_detail_content'); ?>
	            </div>
		      </div>
			<?php
				endwhile;
			?>
		    </div>
		<?php
			endif;
		?>
        <h2><?php the_field('accessories_detail_list_title'); ?></h2>
		<?php
			if( have_rows('accessories_detail_list') ):
		?>
	        <div class="post-list">
			<?php
				while ( have_rows('accessories_detail_list') ) : the_row();
				$equipment_detail_image = get_sub_field('accessories_detail_image');
				$equipment_detail_image_size = 'santa-main-thumb-100-125';
			?>
			  <div class="post">
				<div class="p-pic">
	              <a href="<?php the_sub_field('accessories_detail_page_link'); ?>"><img class="product-img" src="<?php echo $equipment_detail_image['sizes'][ $equipment_detail_image_size ];?>" alt="<?php	the_sub_field('accessories_detail_title'); ?>"></a>
	            </div>
		        <div class="p-content">
			      <h3><a href="<?php the_sub_field('accessories_detail_page_link'); ?>"><?php the_sub_field('accessories_detail_title'); ?></a></h3>
				  <?php the_sub_field('accessories_detail_content'); ?>
	            </div>
		      </div>
			<?php
				endwhile;
			?>
		    </div>
		<?php
			endif;
		?>        
      </div>
    </div>
  </div>
</div>

<?php get_template_part('template-parts/aside'); ?>

<?php get_footer();
