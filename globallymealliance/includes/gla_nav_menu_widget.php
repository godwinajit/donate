<?php
/**
 * GLA Navigation Menu widget class
 *
 */
class GLA_Nav_Menu_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array (
				'description' => __ ( 'Add Main Navigation to your site.' ) 
		);
		parent::__construct ( 'gla_nav_menu', __ ( 'GLA Main Navigation' ), $widget_ops );
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

	function getSubChildMenus($menu_items, $menuId){
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
		$gla_nav_menu = wp_get_nav_menu_object ( $instance ['GLA_nav_menu'] );	
		
		if (! $gla_nav_menu)
			return;
		
		$menu_items = wp_get_nav_menu_items ( $gla_nav_menu->term_id );

		echo $this->getMenuContent($menu_items, $instance, $args);
	}
	
	function getMenuContent($menu_items, $instance, $args) {
		$menu_content = '';	
				
		if( $args['id'] == 'sidebar-mainmenu'){	
			$menu_content .= '<ul class="nav-list">'. "\n"; 
			foreach ( $menu_items as $menu_item ) {
			$ChildMenuArr = array();
			if ( ( self::hasChildMenu($menu_items, $menu_item->ID) ) && ( $menu_item->menu_item_parent == 0 ) ) {
				$activeClass = '';
				$item = '';

				if (!empty(explode('/', $_SERVER['REQUEST_URI'])[1])) {
					$item = explode('/', $_SERVER['REQUEST_URI'])[1];
				}
				if (!empty($item) && strpos($menu_item->url, $item) !== false && $_SERVER['REQUEST_URI'] !== '/') {
					$activeClass = 'active';
				}
				$menu_content .= '<li class="' . $activeClass . '"><a class="accordion-opener" href="'.$menu_item->url.'"><span>'.$menu_item->title.'</span></a>'. "\n";
				$menu_content .= '<div class="accordion-slide">'. "\n";

				$menu_content .= '<ul>'. "\n";
				$ChildMenuArr = self::getChildMenus($menu_items, $menu_item->ID);
					foreach ($ChildMenuArr as $childMenu){
						if($childMenu->menu_item_parent == $menu_item->ID)
						$SubChildMenuArr = self::getSubChildMenus($menu_items, $childMenu->ID);

						$activeClass = '';
						if (!empty($item) && strpos($childMenu->url, $item) !== false && $_SERVER['REQUEST_URI'] !== '/') {
							$activeClass = 'active';
						}

						if(count($SubChildMenuArr)  > 0){
							$menu_content .= '<li><a class="' .$activeClass. ' accordion-opener" href="'.$childMenu->url.'">'.$childMenu->title.'</a>'. "\n";
						}else{
							$menu_content .= '<li><a class="' .$activeClass. '" href="'.$childMenu->url.'"><span>'.$childMenu->title.'</span></a>'. "\n";
						}

						foreach ($SubChildMenuArr as $subchildMenu){
							$activeClass = '';
							if (!empty($item) && strpos($subchildMenu->url, $item) !== false && $_SERVER['REQUEST_URI'] !== '/') {
								$activeClass = 'class="active"';
							}

								$menu_content .= '<div class="accordion-slide">'. "\n";
								$menu_content .= '<ul>'. "\n";
								$menu_content .= '<li><a ' .$activeClass. 'href="'.$subchildMenu->url.'">'.$subchildMenu->title.'</a></li>'. "\n";
								$menu_content .= '</ul>'. "\n";
								$menu_content .= '</div>'. "\n";
						}
					$menu_content .= '</li>'. "\n";	
					}
				$menu_content .= '</ul>'. "\n";	
				$menu_content .= '</div>'. "\n";				
				$menu_content .= '</li>'. "\n";
			}
		}
		$menu_content .= '</ul>'. "\n";	
		
		return $menu_content;
	}
	}
	
	function update($new_instance, $old_instance) {		
		$instance ['GLA_nav_menu'] = ( int ) $new_instance ['GLA_nav_menu'];
		return $instance;
	}
	
	function form($instance) {		
		$gla_nav_menu = isset ( $instance ['GLA_nav_menu'] ) ? $instance ['GLA_nav_menu'] : '';
		
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
	<label for="<?php echo $this->get_field_id('GLA_nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
	<select id="<?php echo $this->get_field_id('GLA_nav_menu'); ?>"
		name="<?php echo $this->get_field_name('GLA_nav_menu'); ?>">
		<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
		<?php
		foreach ( $menus as $menu ) {
			echo '<option value="' . $menu->term_id . '"' . selected ( $gla_nav_menu, $menu->term_id, false ) . '>' . esc_html ( $menu->name ) . '</option>';
		}
		?>
	</select>
</p>
<?php
	}
}