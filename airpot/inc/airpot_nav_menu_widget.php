<?php
/**
 * Airpot Navigation Menu widget class
 *
 */
class Airpot_Nav_Menu_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array (
				'description' => __ ( 'Add Main Navigation to your site.' ) 
		);
		parent::__construct ( 'airpot_nav_menu', __ ( 'Airpot Main Navigation' ), $widget_ops );
	}
	function hasChildMenu($menu_items, $menuId){
		$hasChildMenu = false;
		foreach ( $menu_items as $menu_item ) {
			if( ( $menu_item->menu_item_parent == $menuId) ){
				$hasChildMenu =  true;
			}
		}
		return $hasChildMenu;
	}
	
	function getChildMenus($menu_items, $menuId){
		$childMenus = array();
		foreach ( $menu_items as $menu_item ) {
			if( ( $menu_item->menu_item_parent == $menuId) ){
				$childMenus[] =  $menu_item;
			}
		}
		return $childMenus;
	}
	function widget($args, $instance) {
		// Get menu		
		$airpot_nav_menu = wp_get_nav_menu_object ( $instance ['Airpot_nav_menu'] );	
		
		if (! $airpot_nav_menu)
			return;
		
		$menu_items = wp_get_nav_menu_items ( $airpot_nav_menu->term_id );

		echo $this->getMenuContent($menu_items, $instance, $args);
	}
	
	function getMenuContent($menu_items, $instance, $args) {
		$menu_content = '';	
				
		if( $args['id'] == 'sidebar-header'){	
			$menu_content .= '<ul id="nav">'. "\n"; 
			foreach ( $menu_items as $menu_item ) {
			$ChildMenuArr = array();
			if( ( !self::hasChildMenu($menu_items, $menu_item->ID) ) && ( $menu_item->menu_item_parent == 0 ) ){
				$menu_content .= '<li><a href="'.$menu_item->url.'">'.$menu_item->title.'</a></li>'. "\n";
			}elseif ( ( self::hasChildMenu($menu_items, $menu_item->ID) ) && ( $menu_item->menu_item_parent == 0 ) ) {
				$menu_content .= '<li>'. "\n";
				$menu_content .= '<a href="'.$menu_item->url.'">'.$menu_item->title.'</a>'. "\n";
				
				$menu_content .= '<ul class="default-list">'. "\n";
				$ChildMenuArr = self::getChildMenus($menu_items, $menu_item->ID);
					foreach ($ChildMenuArr as $childMenu){
						if($childMenu->menu_item_parent == $menu_item->ID)
								$menu_content .= '<li><a href="'.$childMenu->url.'">'.$childMenu->title.'</a></li>'. "\n";
					}
				$menu_content .= '</ul>'. "\n";				
				$menu_content .= '</li>'. "\n";
			}
		}
		$menu_content .= '</ul>'. "\n";	
		
		return $menu_content;
	}
	}
	
	function update($new_instance, $old_instance) {		
		$instance ['Airpot_nav_menu'] = ( int ) $new_instance ['Airpot_nav_menu'];
		return $instance;
	}
	
	function form($instance) {		
		$airpot_nav_menu = isset ( $instance ['Airpot_nav_menu'] ) ? $instance ['Airpot_nav_menu'] : '';
		
		// Get menus
		$menus = wp_get_nav_menus ( array (
				'orderby' => 'name' 
		) );
		
		// If no menus exists, direct the user to go and create some.
		if (! $menus) {
			echo '<p>' . sprintf ( __ ( 'No menus have been created yet. <a href="%s">Create some</a>.' ), admin_url ( 'nav-menus.php' ) ) . '</p>';
			return;
		}
		?>
<p>
	<label for="<?php echo $this->get_field_id('Airpot_nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
	<select id="<?php echo $this->get_field_id('Airpot_nav_menu'); ?>"
		name="<?php echo $this->get_field_name('Airpot_nav_menu'); ?>">
		<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
		<?php
		foreach ( $menus as $menu ) {
			echo '<option value="' . $menu->term_id . '"' . selected ( $airpot_nav_menu, $menu->term_id, false ) . '>' . esc_html ( $menu->name ) . '</option>';
		}
		?>
	</select>
</p>
<?php
	}
}