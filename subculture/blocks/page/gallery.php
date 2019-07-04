<?php

$gallery = get_field('gallery', get_queried_object_id());

if (!$gallery) return;

?>

<div class="row">
	<section class="gallery-section">
		<?php foreach ($gallery as $image) : ?>
		<article class="col-sm-4">
			<div class="image-holder">
				<?php echo wp_get_attachment_image($image['id'], 'page-gallery-thumbs-750x456', false, array('class' => 'img-responsive')) ?>
			</div>
		</article>
		<?php endforeach; ?>
	</section>
</div>