<a href="<?php echo $item['file']['url'] ?>" class="clearfix" target="_blank">
    <div class="image-area">
        <img src="<?php echo get_template_directory_uri(); ?>/images/ico-bim.png" width="73" height="90" alt="bim">
        <img class="hover" src="<?php echo get_template_directory_uri(); ?>/images/ico-bim-hover.png" width="73" height="90" alt="bim">
    </div>
    <div class="description">
        <strong class="title"><?php _e('BIM Object', 'kenyon') ?></strong>
        <?php echo apply_filters('the_content', $item['file']['caption']); ?>
    </div>
</a>