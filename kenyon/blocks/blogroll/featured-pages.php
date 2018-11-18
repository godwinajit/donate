<?php

$pages = get_field('featured_pages', 'option');

if ($pages) : ?>
<aside class="post-holder">
    <?php foreach ($pages as $page) : ?>
    <section class="post-block">
        <a href="<?php echo get_permalink($page['page']->ID) ?>">
            <?php if ($page['image']) : ?>
            <div class="image-block">
                <?php echo wp_get_attachment_image($page['image'], 'blogroll-featured-pages') ?>
            </div>
            <?php elseif ($thumb_id = get_post_thumbnail_id($page['page']->ID)) : ?>
            <div class="image-block">
                <?php echo wp_get_attachment_image($thumb_id, 'blogroll-featured-pages') ?>
            </div>
            <?php endif ?>
            <strong class="title"><?php echo apply_filters('the_title', $page['page']->post_title) ?></strong>
        </a>
    </section>
    <?php endforeach; ?>
</aside>
<?php endif; ?>