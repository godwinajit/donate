<?php

$title = get_sub_field('title');
$text = get_sub_field('text');

if ($title || $text) : ?>
<div class="history-section">
    <div class="container">
        <div class="block">
            <?php if ($title) : ?>
            <h2><?php echo $title ?></h2>
            <?php endif; ?>
            <?php echo $text; ?>
        </div>
    </div>
</div>
<?php endif; ?>