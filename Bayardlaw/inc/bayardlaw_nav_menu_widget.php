<?php
/**
 * Bayardlaw Navigation Menu widget class
 *
 */
class Bayardlaw_Nav_Menu_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array (
				'description' => __ ( 'Add Main Navigation to your site.' ) 
		);
		parent::__construct ( 'Bayardlaw_nav_menu', __ ( 'Bayardlaw Main Navigation' ), $widget_ops );
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
		$airpot_nav_menu = wp_get_nav_menu_object ( $instance ['Bayardlaw_nav_menu'] );	
		
		if (! $airpot_nav_menu)
			return;
		
		$menu_items = wp_get_nav_menu_items ( $airpot_nav_menu->term_id );

		echo $this->getMenuContent($menu_items, $instance, $args);
	}
	
	/**
	 * Header top menu * /
	 * @param unknown $menu_items
	 * @param unknown $instance
	 * @param unknown $args
	 * @return string
	 * 
	 */
	function getMenuContent($menu_items, $instance, $args) {
		$menu_content = '';				
		
		if( $args['id'] == 'sidebar-3'){$menu_content .= '<ul id="main-nav" class="nav navbar-nav navbar-right">';
			foreach ( $menu_items as $menu_item ){
				$ChildMenuArr = array();
				if( ( !self::hasChildMenu($menu_items, $menu_item->ID) ) && ( $menu_item->menu_item_parent == 0 ) ){
					$activeClass = "";
					if(get_queried_object_id() == $menu_item->object_id) $activeClass = "active"; 
					$menu_content .= '<li class="'.$activeClass.'"><a class="" href="'.$menu_item->url.'"> '.$menu_item->title.'  </a></li>'. "\n";
				}elseif ( ( self::hasChildMenu($menu_items, $menu_item->ID) ) && ( $menu_item->menu_item_parent == 0 ) ) {
					$menu_content .= '<li>'. "\n";
					
					$menu_content .= '<a aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" href="'.$menu_item->url.'" id='.$menu_item->ID.' class="has-drop-down">'.$menu_item->title.'</a>'. "\n";
					
					$ChildMenuArr = self::getChildMenus($menu_items, $menu_item->ID);
					
					$childmenu_counts = count($ChildMenuArr);
					
					$childmenu_half_count = round($childmenu_counts/2);
					
					$menu_content.='						
							<div aria-labelledby="'.$menu_item->ID.'" class="dropdown-menu">
								<div class="container">
									<div class="row">
										<div class="col-lg-offset-1 col-md-4 col-xs-12 hidden-xs">
											<h3>'.$menu_item->title.':</h3>
										</div>
										<div class="col-lg-7 col-md-8 col-xs-12">
											<div class="row links-holder">';
												$menu_content.='<ul class="links-col">';
												$item_count=1;
												
				foreach ($ChildMenuArr as $childMenu){
						if($childMenu->menu_item_parent == $menu_item->ID)
							$menu_content .= '<li><a href="'.$childMenu->url.'">'.$childMenu->title.'</a></li>'. "\n";
						
							if($item_count==$childmenu_half_count)
							{
								$menu_content.='</ul><ul class="links-col">';
							}
							$item_count++;						
					}												
												
											$menu_content.='	</ul>
												<div class="divider vertical style-dark hidden-xs"><div></div></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						';
					
					$menu_content .= '</li>'. "\n";
				}
			}
			$menu_content .="</ul>";		
		}
		
		
		elseif( $args['id'] == 'sidebar-hometopmenu'){
			$menu_content .= '<ul class="list-inline text-right">';
			foreach ( $menu_items as $menu_item ){
				$ChildMenuArr = array();
				if( ( !self::hasChildMenu($menu_items, $menu_item->ID) ) && ( $menu_item->menu_item_parent == 0 ) ){
					$menu_content .= '<li><a class="btn btn-primary" href="'.$menu_item->url.'"> '.$menu_item->title.'  <i class="fa fa-caret-right"></i></a></li>'. "\n";
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
			$menu_content .="</ul>";
		}
		
		
		
		
		else {
			$menu_content = '<ul>';
			foreach ( $menu_items as $menu_item ){
				$ChildMenuArr = array();
				if( ( !self::hasChildMenu($menu_items, $menu_item->ID) ) && ( $menu_item->menu_item_parent == 0 ) ){
					$menu_content .= '<li><a  href="'.$menu_item->url.'"> '.$menu_item->title.'  </a></li>'. "\n";
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
			$menu_content .="</ul>";
		}		
		return $menu_content;	
	}
	
	function update($new_instance, $old_instance) {		
		$instance ['Bayardlaw_nav_menu'] = ( int ) $new_instance ['Bayardlaw_nav_menu'];
		return $instance;
	}
	
	function form($instance) {		
		$airpot_nav_menu = isset ( $instance ['Bayardlaw_nav_menu'] ) ? $instance ['Bayardlaw_nav_menu'] : '';
		
		// Get menus
		$menus = wp_get_nav_menus ( array (
				'orderby' => 'name' 
		) );
		
		// If no menus exists, direct the user to go and create some.
		if (! $menus){
			echo '<p>' . sprintf ( __ ( 'No menus have been created yet. <a href="%s">Create some</a>.' ), admin_url ( 'nav-menus.php' ) ) . '</p>';
			return;
		}
		?>
<p>
	<label for="<?php echo $this->get_field_id('Bayardlaw_nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
	<select id="<?php echo $this->get_field_id('Bayardlaw_nav_menu'); ?>"
		name="<?php echo $this->get_field_name('Bayardlaw_nav_menu'); ?>">
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