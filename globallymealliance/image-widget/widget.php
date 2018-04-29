<?php
/**
 * Widget template. This template can be overriden using the "sp_template_image-widget_widget.php" filter.
 * See the readme.txt file for more info.
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

//echo $before_widget;
?>
<div class="aside-get-involved aside-get-involved-single">
<?php
if ( !empty( $title ) ) { echo '<div class="asideget-involved-title">' . $title . '</div>'; }
echo '<ul>';
echo '<li> <a href="'.$instance['link'].'" title="'.$description.'"><div class="get-involved-img">'.$this->get_image_html( $instance, false ).'</div>';

if ( !empty( $description ) ) {
	echo '<div class="get-invol-txt" >';
	echo $description;
	echo "</div></a></li>";
}
//echo $after_widget;
echo '</ul>';
?>
</div>