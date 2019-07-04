<address class="address">
    <?php bloginfo('name'); ?>,
    <?php if ($email = get_field('email', 'option')) : ?>
    <a href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a><br>
    <?php endif ?>
    <?php the_field('address', 'option') ?>
</address>