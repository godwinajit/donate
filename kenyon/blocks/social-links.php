<?php

$links = get_field('social_links', 'option');

if (!empty($links)) : ?>
	<h3 class="social-link-title">share with friends</h3>
    <ul class="social-media-links social-networks">
        <?php foreach ($links as $link) : ?>
            <li><a href="<?php echo $link['url'] ?>" class="<?php echo $link['icon'] ?>" target="_blank"><?php echo $link['label'] ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>