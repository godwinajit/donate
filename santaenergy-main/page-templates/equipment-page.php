<?php

/* Template Name: Equipment Page */

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
      <div class="col-md-8 offset-lg-1" id="equipment-list-section">
		<?php
			$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'santa-main-thumb-774-282');
			if($featured_img_url){?>
				<img src="<?php echo $featured_img_url; ?>" alt="<?php the_title();?>">
			<?php }?>
			<?php if(get_field('show_page_title_in_page') == 'yes'): ?><h2><?php the_title();?></h2><?php endif;?>
			<?php the_content();?>
		<p><?php the_field('equipment_list_title'); ?></p>
		<?php
			if( have_rows('equipment_list') ):
		?>
        <div class="post-grid" id="equipment-product-list">
		<?php
			while ( have_rows('equipment_list') ) : the_row();
			$equipment_image = get_sub_field('equipment_image');
			$equipment_image_size = 'santa-main-thumb-100-115';
		?>
          <div class="post">
            <a href="<?php the_sub_field('equipment_page_link'); ?>" class="p-link">
			<?php if( $equipment_image ) {?>
              <div class="p-pic">
                <img class="product-img" src="<?php echo $equipment_image['sizes'][ $equipment_image_size ];?>" alt="<?php the_sub_field('equipment_title'); ?>">
              </div>
			 <?php }?>
              <div class="p-content">
                <strong class="p-category"><?php the_sub_field('equipment_name'); ?></strong>
                <h3><?php the_sub_field('equipment_title'); ?></h3>
              </div>
              <i class="icon-next"></i>
            </a>
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
