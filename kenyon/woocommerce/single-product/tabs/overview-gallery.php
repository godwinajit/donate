<div class="image-holder">
    <?php foreach ($gallery as $image) : ?>
        <a class="lightbox" href="<?php list($full_url) = wp_get_attachment_image_src($image['id'], 'full'); echo $full_url; ?>"><?php echo wp_get_attachment_image($image['id'], 'shop_product_overview_gallery') ?></a>
    <?php endforeach; ?>
</div>
