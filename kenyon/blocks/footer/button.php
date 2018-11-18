<?php

$fields = theme_get_fields('options', array(
    'call_to_action_button_text',
    'call_to_action_button_page',
));

if (is_array($fields) && (count($fields) == 2)) : ?>
<div class="button-block">
    <div class="container">
		<?php 
			$css = '';
			if(is_page("build-a-grill")):
				$css = 'target="_blank"';
			endif;
		?>
        <a class="btn btn-default btn-lg" <?php echo $css; ?> href="<?php echo $fields['call_to_action_button_page'] ?>"><?php echo $fields['call_to_action_button_text'] ?></a>
    </div>
</div>
<?php endif; ?>