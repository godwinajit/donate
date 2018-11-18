<?php

$address = get_sub_field('address');
$logo = get_sub_field('logo');
$popup = get_sub_field('popup');

if ($address) : ?>
<div class="img-section map">
    <div class="map-holder google-map-field" data-lat="<?php echo $address['lat'] ?>" data-lng="<?php echo $address['lng'] ?>">
        <?php if ($popup) : ?>
        <div class="address-block google-map-field-popup">
            <?php echo wp_get_attachment_image($logo, 'about-map-logo') ?>
            <address><?php echo $popup ?></address>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
