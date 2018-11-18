<?php

$fields = theme_get_fields(null, array(
	'promo_image',
	'promo_image_title',
	'promo_image_sub_title',
	'promo_image_description',
	'promo_image_link',
));

if (!empty($fields)) : ?>
<div class="promo-box">
	<?php if (isset($fields['promo_image_link']) || isset($fields['promo_image_sub_title']) || isset($fields['promo_image_title'])) : ?>
	<h2>
		<a href="<?php echo $fields['promo_image_link'] ?>">
			<span><?php echo $fields['promo_image_sub_title'] ?></span> <br>
			<?php echo $fields['promo_image_title'] ?>
		</a>
	</h2>
	<?php endif; ?>
	<div class="clearfix">
		<?php if (isset($fields['promo_image'])) : ?>
			<?php echo wp_get_attachment_image($fields['promo_image'], 'homepage-promo-image'); ?>
		<?php endif; ?>
		<?php if (isset($fields['promo_image_description'])) : ?>
		<div class="description">
			<?php echo $fields['promo_image_description'] ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>