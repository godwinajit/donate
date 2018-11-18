<?php

$address = get_sub_field('address');
$logo = get_sub_field('logo');
$popup = get_sub_field('popup');


if ($address) : ?>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="row same-height">
            <div class="map-holder google-map-field" id="map-canvas" data-lat="<?php echo $address['lat'] ?>" data-lng="<?php echo $address['lng'] ?>">
				<?php if ($popup) : ?>
				<div class="address-block google-map-field-popup">
					<?php echo wp_get_attachment_image($logo, 'about-map-logo') ?>
					<address><?php echo $popup ?></address>
				</div>
				<?php endif; ?>
			</div>
        </div>
    </div>
<?php endif; ?>
