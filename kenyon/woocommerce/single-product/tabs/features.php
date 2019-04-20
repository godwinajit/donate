<div id="features">
    <div class="features-block">
        <strong class="title"><?php _e('Why You\'ll Love It...', 'kenyon') ?></strong>
        <ul>
            <?php foreach ($features as $feature) : ?>
                <li><?php echo $feature['feature'] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php
if( have_rows('intelliken_features') ): ?>
	<div class="features-block">
		<strong class="title"><?php _e('Why You\'ll Love the IntelliKEN Version...', 'kenyon') ?></strong>
		<ul>
		<?php
     	// loop through the rows of data
        while ( have_rows('intelliken_features') ) : the_row();
            ?>
			<li><?php the_sub_field('intelliken_feature'); ?></li>
			<?php
        endwhile;
    	?>
		</ul>
	</div>
	<?php
endif;
?>
</div>
