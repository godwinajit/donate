<?php
/**
 * joelbeckerman Navigation Menu widget class
 *
 */
class AB_Nav_Menu_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array (
				'description' => __ ( 'Add Main Navigation to your site.' ) 
		);
		parent::__construct ( 'ab_nav_menu', __ ( 'AB Main Navigation' ), $widget_ops );
	}
	
	function widget($args, $instance) {
	
		 $ab_nav_menu = wp_get_nav_menu_object ( $instance ['ab_nav_menu'] );
		
		if (! $ab_nav_menu)
			return;
		
		$menu_items = wp_get_nav_menu_items ( $ab_nav_menu->term_id );

		echo $this->getMenuContent($menu_items, $instance, $args);
	}
	
	function getMenuContent($menu_items, $instance, $args) {
		$menu_content = '';
		
		
		if( $args['id'] == 'sidebar-topmenu'){
			$active_menu="";
			
		$current_page= get_permalink( $post->ID );
		$menu_content .= '<div class="collapse navbar-collapse" id="navbar-collapse">'. "\n";
			$menu_content .= '<ul class="nav navbar-nav pull-right">'. "\n";

			foreach ( $menu_items as $menu_item ) {
				if($menu_item->url==$current_page)
				{
					$active_menu="active";
				}
				else{ $active_menu="";}
				$menu_content .= '<li class="'.$active_menu.'" ><a href="'.$menu_item->url.'" class="'.str_replace('#', '', $menu_item->url).'">'.$menu_item->title.'</a></li>'. "\n"; 
			}
			$menu_content .= '</ul>'. "\n";
			$menu_content .= '</div>'. "\n";
		}
		
		elseif( $args['id'] == 'sidebar-bottommenu'){			
		
		$menu_content .= '<div class="col-sm-8" >'. "\n";
			$menu_content .= '<ul class="copyright">'. "\n";
			$menu_content .= '<li><a href="'. home_url( '/' ) .'"><img src="'. get_template_directory_uri () .'/images/logo-mindtrust-labs-white.svg" alt="MindTrust Labs" class="logo" /></a></li>'. "\n";
			$menu_content .= '<li>&copy; '. date('Y').' MindTrust Labs, LLC</li>'. "\n";
			foreach ( $menu_items as $menu_item ) {			
				$menu_content .= '<li><a href="'.$menu_item->url.'" >'.$menu_item->title.'</a></li>'. "\n"; 
			}
			$menu_content .= '</ul>'. "\n";
			$menu_content .= '</div>'. "\n";
		
		}
		
		return $menu_content;
	}
	
	function update($new_instance, $old_instance) {
		$instance ['footer-text'] = strip_tags ( stripslashes ( $new_instance ['footer-text'] ) );
		$instance ['ab_nav_menu'] = ( int ) $new_instance ['ab_nav_menu'];
		return $instance;
	}

	
	function form($instance) {
		$footer_text = isset ( $instance ['footer-text'] ) ? $instance ['footer-text'] : '';
		$ab_nav_menu = isset ( $instance ['ab_nav_menu'] ) ? $instance ['ab_nav_menu'] : '';
	
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
		<label for="<?php echo $this->get_field_id('footer-text'); ?>"><?php _e('Footer Text:') ?></label>
		<input type="text" class="widefat"
			id="<?php echo $this->get_field_id('footer-text'); ?>"
			name="<?php echo $this->get_field_name('footer-text'); ?>"
			value="<?php echo $footer_text; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('ab_nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
		<select id="<?php echo $this->get_field_id('ab_nav_menu'); ?>"
			name="<?php echo $this->get_field_name('ab_nav_menu'); ?>">
			<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
			<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"' . selected ( $ab_nav_menu, $menu->term_id, false ) . '>' . esc_html ( $menu->name ) . '</option>';
			}
			?>
		</select>
	</p>
	<?php
		}
	}