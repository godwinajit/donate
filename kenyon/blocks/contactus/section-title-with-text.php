<?php

$content = get_sub_field('contactus'); //print_r($content); exit; ?>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <aside class="contact-block">
        <div class="row same-height">
        	<?php  $Address = array_pop($content); ?>
			<?php foreach ($content as $row) : ?>
                <?php if ($row['title']) : ?>
                    <h3><?php echo $row['title'] ?></h3>
                <?php endif ?>
                <?php echo $row['content'] ?>
            <?php endforeach; ?>
			<?php if ($Address['title']) : ?>
                <h3><?php echo $Address['title'] ?></h3>
            <?php endif ?>
            <address><?php echo $Address['content'] ?></address>
        </div>
    </aside>
</div>
