<?php 

$video = get_field('video');

if (!$video) return;

$embed_url = theme_parse_youtube_url($video);

if (!$embed_url) return;

?>
<!-- <div class="product-video-btn-holder text-center">
	<a class="product-video-btn btn btn-primary iframe-lightbox iframe" href="<?php echo $embed_url; ?>"><?php _e('VIEW VIDEO', 'kenyon'); ?></a>
</div> -->
<div class="video-slide">
	<div class="frame-holder">
		<iframe class="yt-player" src="<?php echo $embed_url; ?>?enablejsapi=1&autoplay=0&showinfo=0&rel=0" frameborder="0" "></iframe>
	</div>
</div>