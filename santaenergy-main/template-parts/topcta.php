	<?php if(get_field('banner_title')){?>
	    <h1><?php the_field('banner_title')?></h1>
	<?php }else{?>
		<h1><?php the_title()?></h1>
	<?php }?>
	<?php if(get_field('banner_sub_title')){?>
	    <p><?php the_field('banner_sub_title')?></p>
	<?php }?>
	<?php if(get_field('banner_cta_text')){?>
		<a href="<?php the_field('banner_cta_link')?>" class="button" 
			<?php echo trim(get_field('select_form_option_1')) ? 'data-selectval="'.trim(get_field('select_form_option_1')).'"' : '';?>
			<?php echo get_field('banner_cta_link_new_window') == 'yes' ? 'target="_blank"' : '';?>>
			<?php the_field('banner_cta_text')?>
		</a>
	<?php }?>