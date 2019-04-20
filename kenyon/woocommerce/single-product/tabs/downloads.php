<div id="downloads">
    <ul class="download-list">
        <?php foreach ($downloads as $item) : ?>
        <li>
            <?php wc_get_template(
                'single-product/tabs/downloads-'.$item['type'].'.php',
                array(
                    'item' => $item,
                )
            ) ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php
if( have_rows('intelliken_downloads') ): ?>
<div id="downloads">
	<strong class="title"><?php _e('IntelliKEN Version Downloads', 'kenyon') ?></strong>
	<ul class="download-list">
	<?php
 	// loop through the rows of data
    while ( have_rows('intelliken_downloads') ) : the_row();
		$fileDetails['file'] = get_sub_field('file');
        ?>
		<li>
            <?php wc_get_template(
                'single-product/tabs/downloads-'.get_sub_field('type').'.php',
                array(
                    'item' => $fileDetails,
                )
            ) ?>
        </li>
		<?php
    endwhile; ?>
	</ul>
</div>
<?php
endif;
?>