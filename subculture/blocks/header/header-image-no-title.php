<?php

$image = get_field('header_image', get_queried_object_id());
if (!$image) {
    $image = '<img src="' . get_bloginfo('template_url') . '/images/bg-header-contacts.jpg' . '" alt="header image" width="1925" height="256" />';
} else {
    $image = wp_get_attachment_image($image, '1925px');
}

?>
<div class="intro">
    <div class="img-w">
        <div class="img-w1">
            <div class="img-w2">
                <?php echo $image; ?>
            </div>
        </div>
    </div>
</div>
