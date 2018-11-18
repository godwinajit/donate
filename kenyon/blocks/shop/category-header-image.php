<?php

$header_image = get_field('header_image', 'product_cat_' . get_queried_object_id());

if (!$header_image) {
    $header_image = get_field('default_category_header_image', 'option');
}
if (!$header_image) {
    $header_image = '<img width="1440" height="270" alt="category header image" src="'. get_template_directory_uri() . '/images/img7.jpg">';
} else {
    $header_image = wp_get_attachment_image($header_image, 'full');
}

?>
 <div class="visual-block clearfix">
    <div class="holder">
        <?php echo $header_image; ?>
    </div>
</div> 