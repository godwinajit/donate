<?php

$icons = array(
	'twitter' => 'fa fa-twitter',
	'facebook' => 'fa fa-facebook',
	'instagram' => 'fa fa-instagram',
	'default' => 'fa fa-link',
);



?><ul class="social-networks">
	<?php for($i=1; $i<20; $i++): ?>
		<?php 
			$link_title = get_post_meta(get_the_ID(), 'link_title_'.$i, true);
			$link_content = strip_tags(get_post_meta(get_the_ID(), 'link_content_'.$i, true));
			$link_class = $icons['default'];

			if($link_title && $link_content) : 

				foreach ($icons as $find => $class) {
					if (strpos(strtolower($link_content), $find) !== false) {
						$link_class = $class;
						break;
					}
				}


				?>
				<li>
					<a href="<?php echo $link_content; ?>">
						<i class="<?php echo $link_class; ?>"></i> 
						<?php echo $link_title; ?>
					</a>
				</li>
			<?php endif; 
		?>
	<?php endfor; ?>
</ul>
