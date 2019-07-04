<?php

$logo_text = get_sub_field('logo_text');
$logo_2nd_line = get_sub_field('logo_2nd_line');
$image = get_sub_field('image');

?>
<?php if ($logo_text || $logo_2nd_line || $image) : ?>
<div class="section">
    <?php if ($logo_text || $logo_2nd_line) : ?>
    <a class="logo-box" href="#">
        <?php if ($logo_text) : ?>
        <strong class="logo"><?php echo $logo_text ?></strong>
        <?php endif; ?>

        <?php if ($logo_2nd_line) : ?>
        <span class="logo-txt"><span><?php echo $logo_2nd_line ?></span></span>
        <?php endif; ?>
    </a>
    <?php endif; ?>

    <?php if ($image) : ?>
    <div class="bg-holder">
        <div class="bg-frame">
            <?php echo wp_get_attachment_image($image, '1925px') ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>