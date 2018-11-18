<?php

$logo = get_sub_field('logo');
$title = get_sub_field('title');
$image = get_sub_field('image');
$video = get_sub_field('youtube_video_id');

?>
<div class="img-section intro<?php if($video){?> video<?php } ?>">
    <?php if ($image) : ?>
    <div class="img-holder">
        <div class="img-frame">
            <?php echo wp_get_attachment_image($image, 'full') ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($logo || $title) : ?>
    <div class="text-block">
        <div class="block-holder">
            <?php echo $title; ?> <?php echo wp_get_attachment_image($logo, 'full') ?>
        </div>
		<?php if($video){?>
		<div class="video-placeholder">
			<iframe width="768" height="440" src="https://www.youtube.com/embed/<?php echo $video ?>" frameborder="0" allowfullscreen></iframe>
		</div><?php } ?>
    </div>
    <?php endif; ?>
</div>
