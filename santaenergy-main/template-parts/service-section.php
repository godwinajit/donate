<?php
	if( have_rows('service_list') ):
?>
<section class="cards bg-gray mt-80 ptb-80">
  <div class="container container-wider">
    <div class="headline icon-logo text-center">
      <h2><?php the_field('services_section_title'); ?></h2>
    </div>
    <div class="row mobile-gallery justify-content-md-center">
	<?php
		while ( have_rows('service_list') ) : the_row();
	?>
      <div class="col-md-4">
        <div class="card">
		<?php if(get_sub_field('services_link')) {?>
          <a href="<?php the_sub_field('services_link'); ?>" class="card-link" <?php echo trim(get_sub_field('select_form_option')) ? 'data-selectval="'.trim(get_sub_field('select_form_option')).'"' : '';?>>
        <?php }else{ ?>
          <div class="card-frame">
		<?php  }?>
			<div class="card-content">
              <h3><?php the_sub_field('services_title'); ?></h3>
				<?php the_sub_field('services_content'); ?>
            </div>
			<?php if(get_sub_field('services_link')) {?>
				<?php if( get_sub_field('services_link_type') == 'yes' ){?>
	            <i class="icon-next"></i>
				<?php } ?>
				<?php if( get_sub_field('services_link_type') == 'no' ){?>
					<span class="more"><?php the_sub_field('services_button_text'); ?></span>
				<?php } ?>
			<?php } ?>
          <?php if(get_sub_field('services_link')) {?>
		  </a>
        <?php }else{ ?>
		  </div>
		<?php } ?>
		</div>
      </div>
	<?php
		endwhile;
	?>
    </div>
  </div>
</section>
<?php
	endif;
?>
