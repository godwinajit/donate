<?php

/**
 * Santa Main Navigation Menu widget class
 *
 */
class Santa_Main_Nav_Menu_Widget extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array(
            'description' => __('Add Menu Navigation to your site.')
        );
        parent::__construct('santa_main_nav_menu', __('Santa Menu Navigation'), $widget_ops);
    }

    function hasChildMenu($menu_items, $menuId)
    {
        $hasChildMenu = false;
        foreach ($menu_items as $menu_item) {
            if (($menu_item->menu_item_parent == $menuId)) {
                $hasChildMenu = true;
            }
        }
        return $hasChildMenu;
    }

    function getChildMenus($menu_items, $menuId)
    {
        $childMenus = array();
        foreach ($menu_items as $menu_item) {
            if (($menu_item->menu_item_parent == $menuId)) {
                $childMenus[] = $menu_item;
            }
        }
        return $childMenus;
    }

    function getSubChildMenus($menu_items, $menuId)
    {
        $childMenus = array();
        foreach ($menu_items as $menu_item) {
            if (($menu_item->menu_item_parent == $menuId)) {
                $childMenus[] = $menu_item;
            }
        }
        return $childMenus;
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];
        $title = apply_filters('widget_title', $instance['title']);
        // if title is present
        if (! empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        
        // Get menu
        $santa_main_nav_menu = wp_get_nav_menu_object($instance['Santa_Main_nav_menu']);
        
        if (! $santa_main_nav_menu)
            return;
        
        $menu_items = wp_get_nav_menu_items($santa_main_nav_menu->term_id);
        
        echo $this->getMenuContent($menu_items, $instance, $args);        
        echo $args['after_widget'];
    }

    function getMenuContent($menu_items, $instance, $args)
    {
        $menu_content = '';
        
        if ($instance['Santa_Main_nav_type'] == 'dropdown') {
            $menu_content .= '<ul class="navbar-nav">' . "\n";
            foreach ($menu_items as $menu_item) {
                $ChildMenuArr = array();
                if ((self::hasChildMenu($menu_items, $menu_item->ID)) && ($menu_item->menu_item_parent == 0)) {
                    $activeClass = '';
                    $item = '';
                    
                    if (! empty(explode('/', $_SERVER['REQUEST_URI'])[1])) {
                        $item = explode('/', $_SERVER['REQUEST_URI'])[1];
                    }
                    if (! empty($item) && strpos($menu_item->url, $item) !== false && $_SERVER['REQUEST_URI'] !== '/') {
                        $activeClass = 'active';
                    }
                    $menu_content .= '<li class="' . $activeClass . ' nav-item dropdown"><a class="nav-link" id="navbarDropdown' . $menu_item->ID . '" role="button" href="' . $menu_item->url . '">' . $menu_item->title . '<i class="icon"></i></a>' . "\n";
                    $menu_content .= '<div class="nav-dropdown">' . "\n";
                    
                    $ChildMenuArr = self::getChildMenus($menu_items, $menu_item->ID);
                    
					if( count($ChildMenuArr) ){
						$menu_content .= '<ul class="navbar-nav">' . "\n";
					}
					
					foreach ($ChildMenuArr as $childMenu) {
                        
                        $activeClass = '';
                        if (! empty($item) && strpos($childMenu->url, $item) !== false && $_SERVER['REQUEST_URI'] !== '/') {
                            $activeClass = 'active';
                        }
                        
                        $menu_content .= '<li class="' . $activeClass . ' nav-item"><a class="dropdown-item fs-14 ' . $activeClass . '" href="' . $childMenu->url . '">' . $childMenu->title . '<i class="icon"></i></a></li>' . "\n";
                    }

					if( count($ChildMenuArr) ){
						$menu_content .= '</ul>' . "\n";
					}

                    $menu_content .= '</div>' . "\n";
                    $menu_content .= '</li>' . "\n";
                }
            }
            $menu_content .= '</ul>' . "\n";
            
            return $menu_content;
        } else {
            foreach ($menu_items as $menu_item) {
                $ChildMenuArr = array();
                if ((self::hasChildMenu($menu_items, $menu_item->ID)) && ($menu_item->menu_item_parent == 0)) {
                    $activeClass = '';
                    $item = '';
                    
                    if (! empty(explode('/', $_SERVER['REQUEST_URI'])[1])) {
                        $item = explode('/', $_SERVER['REQUEST_URI'])[1];
                    }
                    if (! empty($item) && strpos($menu_item->url, $item) !== false && $_SERVER['REQUEST_URI'] !== '/') {
                        $activeClass = 'active';
                    }
                    // $menu_content .= '<h5><a id="navbarDropdown' . $menu_item->ID . '" href="' . $menu_item->url . '">' . $menu_item->title . '</a></h5>' . "\n";
                    if ($instance['Santa_Main_nav_hierarchy'] == 'yes') {
                        $menu_content .= '<h5>' . $menu_item->title . '</h5>' . "\n";
                        $menu_content .= '<ul>' . "\n";
                        $ChildMenuArr = self::getChildMenus($menu_items, $menu_item->ID);
                        foreach ($ChildMenuArr as $childMenu) {
                            
                            $activeClass = '';
                            if (! empty($item) && strpos($childMenu->url, $item) !== false && $_SERVER['REQUEST_URI'] !== '/') {
                                $activeClass = 'active';
                            }
                            
                            $menu_content .= '<li class="' . $activeClass . '"><a href="' . $childMenu->url . '">' . $childMenu->title . '</a></li>' . "\n";
                        }
                        $menu_content .= '</ul>' . "\n";
                    } else {
                        $menu_content .= '<ul>' . "\n";
                        $activeClass = '';
                        if (! empty($item) && strpos($menu_item->url, $item) !== false && $_SERVER['REQUEST_URI'] !== '/') {
                            $activeClass = 'active';
                        }
                        
                        $menu_content .= '<li class="' . $activeClass . '"><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>' . "\n";
                        
                        $ChildMenuArr = self::getChildMenus($menu_items, $menu_item->ID);
                        foreach ($ChildMenuArr as $childMenu) {
                            
                            $activeClass = '';
                            if (! empty($item) && strpos($childMenu->url, $item) !== false && $_SERVER['REQUEST_URI'] !== '/') {
                                $activeClass = 'active';
                            }
                            
                            $menu_content .= '<li class="' . $activeClass . '"><a href="' . $childMenu->url . '">' . $childMenu->title . '</a></li>' . "\n";
                        }
                        $menu_content .= '</ul>' . "\n";
                    }
                }
            }
        }
        
        return $menu_content;
}

function update($new_instance, $old_instance)
{
    $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['Santa_Main_nav_menu'] = (int) $new_instance['Santa_Main_nav_menu'];
    $instance['Santa_Main_nav_hierarchy'] = $new_instance['Santa_Main_nav_hierarchy'];
    $instance['Santa_Main_nav_type'] = $new_instance['Santa_Main_nav_type'];
    return $instance;
}

function form($instance)
{
    if (isset($instance['title']))
        $title = $instance['title'];
    $santa_main_nav_menu = isset($instance['Santa_Main_nav_menu']) ? $instance['Santa_Main_nav_menu'] : '';
    $Santa_Main_nav_hierarchy = isset($instance['Santa_Main_nav_hierarchy']) ? $instance['Santa_Main_nav_hierarchy'] : '';
    $Santa_Main_nav_type = isset($instance['Santa_Main_nav_type']) ? $instance['Santa_Main_nav_type'] : '';
    
    // Get menus
    $menus = wp_get_nav_menus(array(
        'orderby' => 'name'
    ));
    
    // If no menus exists, direct the user to go and create some.
    if (! $menus) {
        echo '<p>' . sprintf(__('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php')) . '</p>';
        return;
    }
    ?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	<input class="widefat"
		id="<?php echo $this->get_field_id( 'title' ); ?>"
		name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
		value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('Santa_Main_nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
	<select id="<?php echo $this->get_field_id('Santa_Main_nav_menu'); ?>"
		name="<?php echo $this->get_field_name('Santa_Main_nav_menu'); ?>">
		<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
		<?php
    foreach ($menus as $menu) {
        echo '<option value="' . $menu->term_id . '"' . selected($santa_main_nav_menu, $menu->term_id, false) . '>' . esc_html($menu->name) . '</option>';
    }
    ?>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id('Santa_Main_nav_type'); ?>"><?php _e('Select Type:'); ?></label>
	<select id="<?php echo $this->get_field_id('Santa_Main_nav_type'); ?>"
		name="<?php echo $this->get_field_name('Santa_Main_nav_type'); ?>">
		<option value="dropdown"
			<?php echo $Santa_Main_nav_type == 'dropdown' ? 'selected' : '' ?>>Drop
			down</option>
		<option value="list"
			<?php echo $Santa_Main_nav_type == 'list' ? 'selected' : ''  ?>>List</option>
	</select>
</p>
<p>
	<label
		for="<?php echo $this->get_field_id('Santa_Main_nav_hierarchy'); ?>"><?php _e('Hierarchy:'); ?></label>
	<select
		id="<?php echo $this->get_field_id('Santa_Main_nav_hierarchy'); ?>"
		name="<?php echo $this->get_field_name('Santa_Main_nav_hierarchy'); ?>">
		<option value="yes"
			<?php echo $Santa_Main_nav_hierarchy == 'yes' ? 'selected' : '' ?>>Yes</option>
		<option value="no"
			<?php echo $Santa_Main_nav_hierarchy == 'no' ? 'selected' : ''  ?>>No</option>
	</select>
</p>
<?php
}
}


// Class for Santa Fuel Header Menu

class CSS_Menu_Maker_Walker extends Walker {

  var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<div class='drop'><ul>\n";
  }

  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul></div>\n";
  }

  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = '';        
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    /* Add active class */
    if(in_array('current-menu-item', $classes)) {
      $classes[] = 'active';
      unset($classes['current-menu-item']);
    }

    /* Check for children */
    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
    if (!empty($children)) {
      $classes[] = 'dropdown-li';
    }

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    //$output .= $indent . '<li' . $id . $value . $class_names .'>';
	$liattributes .= ! empty($children)        ? ' class="'   . esc_attr( 'dropdown-li'        ) .'"' : '';
	$output .= $indent . '<li' . $liattributes .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	$attributes .= ! empty($children)        ? ' class="'   . esc_attr( 'dropdown-link'        ) .'"' : '';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}
