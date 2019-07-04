<?php

$image = get_field('header_image', get_queried_object_id());
if (!$image) {
    $image = '<img src="' . get_bloginfo('template_url') . '/images/img-12.jpg' . '" alt="header image" width="1925" height="698" />';
} else {
    $image = wp_get_attachment_image($image, '1925px');
}

$slogan = get_field('slogan');
$slogan_2nd_line = get_field('slogan_2nd_line');

?>
<div class="intro">
    <div class="img-w">
        <div class="img-w1">
            <div class="img-w2">
                <?php echo $image; ?>
            </div>
        </div>
    </div>

    <?php if ($slogan || $slogan_2nd_line) : ?>
    <div class="title-holder">
        <div class="title-frame">
		<nav class="breadcrumbs"></nav>
            <?php if ($slogan) : ?>
            <h1><?php echo $slogan ?></h1>
            <?php endif; ?>

            <?php if ($slogan_2nd_line) : ?>
            <strong class="slogan"><?php echo $slogan_2nd_line ?></strong>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
