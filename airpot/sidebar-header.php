<?php
/**
 * The Header Sidebar
 */
 if (! is_active_sidebar ( 'sidebar-header' )) { return; }
?>
<?php dynamic_sidebar( 'sidebar-header' ); ?>