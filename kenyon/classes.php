<?php

//Custom Menu Walker
class Theme_Walker_Nav_Top extends Walker_Nav_Menu {
	var $cart_page_id = null;
	
	function __construct() {
		
		$this->cart_page_id = wc_get_page_id('cart');
		$this->myaccount_page_id = wc_get_page_id('myaccount');
		
	}
	
    protected  $item = null;

	function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul class="dropdown-menu" aria-labelledby="drop' . $this->item->ID . '" role="menu">';
	}

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $woocommerce;
		
        $this->item = $item;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$cart_items = '';
		if ($item->object == 'page') {
			if ($this->cart_page_id == $item->object_id) {
				$cart_items = $woocommerce->cart->cart_contents_count;
				
				$classes[] = 'menu-item-cart';
				
				if (!$cart_items) {
					$classes[] = 'menu-item-cart-empty';
				} else {
					$classes[] = 'menu-item-cart-not-empty';
				}
				
				$cart_items = '<span class="badge pull-right">' . $cart_items . '</span>';
			} elseif ($this->myaccount_page_id == $item->object_id) {
				if (!is_user_logged_in()) {
					$item->title = __('Log In', 'kenyon');
				}
			}
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        if (!$depth && in_array('menu-item-has-children', $item->classes)) {
            $attributes .= ' class="dropdown-toggle" data-toggle="dropdown" role="button" id="drop' . $item->ID . '"';
        }
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $cart_items . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';

        if ($depth && $item->description) {
            $item_output .= apply_filters('the_content', $item->description);
        }

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}
}


class Theme_Walker_Nav_Mega_Dropdown extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= '<div class="drop"><ul>';
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= '</ul></div>';
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';

        /* custom structure for dropdown menu */
        if ($depth) {
            $image = false;

            if ($item->type == 'post_type') {
                $image = get_the_post_thumbnail($item->object_id, 'full');
            } elseif ($item->type == 'taxonomy') {

                // TODO: maybe also need support for common categories
                if ($item->object == 'product_cat') {
                    if (function_exists('get_term_meta')) {
                        if ($image_id = get_term_meta( $item->object_id, 'thumbnail_id', true )) {
                            $image = wp_get_attachment_image($image_id, 'full');
                        }
                    }
                }

            } else {

            }

            if ($image) {
                $item_output .= $image;
            }

            $item_output .= '<span class="text-block"><span>'.apply_filters( 'the_title', $item->title, $item->ID ).'</span></span>';
        } else {
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        }

        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}


class Theme_Walker_Sub_Nav extends Walker_Nav_Menu {
    protected  $item = null;

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<div id="open' . $this->item->ID . '" class="collapse'.($this->parent_collapsed ? '' : ' in').'"><ul>';
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul></div>';
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $this->item = $item;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		
		$collapsed = true;
		
		if (in_array('active', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ))) {
			$collapsed = false;
		}
		
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        if (!$depth) {
            if (in_array('menu-item-has-children', $item->classes)) {
                $item_output = '<button type="button" class="opener'.($collapsed ? ' collapsed' : '').'" data-toggle="collapse" data-target="#open' . $item->ID . '">' . apply_filters( 'the_title', $item->title, $item->ID ) . ' <span class="caret"></span></button>';
            } else {
                $item_output .= '<a'. $attributes .' class="btn opener">';
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                $item_output .= '</a>';
            }

        } else {
            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }


        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
		$this->parent_collapsed = $collapsed;
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}