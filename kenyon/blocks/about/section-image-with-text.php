<?php

$image = get_sub_field('image');
$text = get_sub_field('text');

if ($image || $text) : ?>
<div class="img-section img-section1">
    <?php if ($image) : ?>
    <div class="img-holder">
        <div class="img-frame">
            <?php echo wp_get_attachment_image($image, 'full') ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($text) :?>
    <div class="text-block">
        <div class="block-holder">
            <?php echo $text ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>