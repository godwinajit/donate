<?php

$address = get_field('address', 'option');
$phone = get_field('phone', 'option');
$fax = get_field('fax', 'option');
$email = get_field('email', 'option');

if ($address || $phone || $fax || $email) : ?>
    <div class="col-md-2 col-sm-2">
        <strong class="title"><?php _e('Contact us', 'kenyon') ;?></strong>
        <address>
            <?php if ($address) : ?>
                <?php echo $address; ?>
                <br><br>
            <?php endif; ?>

            <?php if ($phone) : ?>
            <a href="tel:<?php echo theme_filter_digits($phone) ?>" class="phone-link"><?php _e('Phone', 'kenyon') ;?> <?php echo $phone ?></a> <br>
            <?php endif; ?>

            <?php if ($fax) : ?>
                <?php _e('Fax', 'kenyon') ;?> <?php echo $fax ?> <br>
            <?php endif; ?>

            <?php if ($email) : ?>
            <a href="mailto:<?php echo shortcode_email(null, $email) ?>"><?php echo shortcode_email(null, $email) ?></a>
            <?php endif; ?>
        </address>
    </div>
<?php endif; ?>