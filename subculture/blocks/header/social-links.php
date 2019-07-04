<ul class="social-networks">
    <?php if ($link = get_field('facebook_page', 'option')) : ?>
    <li><a target="_blank" href="<?php echo $link ?>"><span class="fa fa-facebook"></span></a></li>
    <?php endif; ?>

    <?php if ($link = get_field('twitter_page', 'option')) : ?>
    <li><a target="_blank" href="<?php echo $link ?>"><span class="fa fa-twitter"></span></a></li>
    <?php endif; ?>

    <?php if ($link = get_field('instagram_page', 'option')) : ?>
    <li><a target="_blank" href="<?php echo $link ?>"><span class="fa fa-instagram"></span></a></li>
    <?php endif; ?>

    <li><a target="_blank" href="<?php bloginfo('rss2_url'); ?>"><span class="fa fa-rss"></span></a></li>
</ul>
