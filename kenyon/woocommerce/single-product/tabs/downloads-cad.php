<a href="<?php echo $item['file']['url'] ?>" class="clearfix" target="_blank">
    <div class="image-area">
        <img src="<?php echo get_template_directory_uri(); ?>/images/ico-cad.png" width="73" height="90" alt="cad">
        <img class="hover" src="<?php echo get_template_directory_uri(); ?>/images/ico-cad-hover.png" width="73" height="90" alt="cad">
    </div>
    <div class="description">
        <strong class="title"><?php _e('CAD Drawing', 'kenyon') ?></strong>
		<?php echo apply_filters('the_content', $item['file']['caption']); ?>
    </div>
</a>