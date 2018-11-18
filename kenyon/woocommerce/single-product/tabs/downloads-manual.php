<a href="<?php echo $item['file']['url'] ?>" class="clearfix" target="_blank">
    <div class="image-area">
        <img src="<?php echo get_template_directory_uri(); ?>/images/ico-manual.png" width="73" height="90" alt="manual">
        <img class="hover" src="<?php echo get_template_directory_uri(); ?>/images/ico-manual-hover.png" width="73" height="90" alt="manual">
    </div>
    <div class="description">
        <strong class="title"><?php _e('Manual', 'kenyon') ?></strong>
        <?php echo apply_filters('the_content', $item['file']['caption']); ?>
    </div>
</a>