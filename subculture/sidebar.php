<?php if (is_active_sidebar('default-sidebar')) : ?>
<div id="sidebar">
	<h2><?php _e('Default Sidebar', 'subculture'); ?></h2>
	<?php dynamic_sidebar('default-sidebar'); ?>	
</div>
<?php endif; ?>