<?php if(has_nav_menu('footer_1')) : ?>
    <div class="col-md-2 col-sm-2 col-xs-6">
        <strong class="title"><?php theme_menu_name('footer_1'); ?></strong>
        <?php wp_nav_menu( array(
            'container' => false,
            'fallback_cb' => false,
            'theme_location' => 'footer_1',
            'items_wrap' => '<ul class="footer-nav">%3$s</ul>',
            'depth' => 1,
        )); ?>
    </div>
<?php endif; ?>

<?php if(has_nav_menu('footer_2')) : ?>
    <div class="col-md-2 col-sm-2 col-xs-6">
        <strong class="title"><?php theme_menu_name('footer_2'); ?></strong>
        <?php wp_nav_menu( array(
            'container' => false,
            'fallback_cb' => false,
            'theme_location' => 'footer_2',
            'items_wrap' => '<ul class="footer-nav">%3$s</ul>',
            'depth' => 1,
        )); ?>
    </div>
<?php endif; ?>