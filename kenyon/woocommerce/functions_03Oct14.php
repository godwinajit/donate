<?php

add_action( 'widgets_init', array( $this, 'addmy_widgets' ) );
	
add_filter('woocommerce_enqueue_styles', '__return_false');

add_filter('wc_product_enable_dimensions_display', '__return_false' );

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);

remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

//add_action('woocommerce_after_main_content', 'woocommerce_output_related_products', 20);
add_action('woocommerce_after_main_content', 'theme_product_cross_sell_display', 30);

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


add_filter('woocommerce_output_related_products_args', 'theme_related_products_args');

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');


function theme_related_products_args($args) {
    $args['posts_per_page'] = 3;

    return $args;
}

function theme_product_cross_sell_display( $posts_per_page = 3, $columns = 3, $orderby = 'rand' ) {
	wc_get_template( 'single-product/cross-sells.php', array(
		'posts_per_page' => $posts_per_page,
		'orderby'        => $orderby,
		'columns'        => $columns
	));
}

/* remove quantity fields from single product
add_action('wp', 'theme_remove_quantity');
function theme_remove_quantity() {
    if (is_singular('product')) {
        add_filter( 'woocommerce_is_sold_individually', 'theme_remove_all_quantity_fields', 10, 2 );
    }
}

function theme_remove_all_quantity_fields( $return, $product ) {
    return( true );
}
*/

add_filter( 'woocommerce_breadcrumb_defaults', 'theme_woocommerce_breadcrumbs');

function theme_woocommerce_breadcrumbs($args) {
    $args['wrap_before'] = '<nav><ul class="breadcrumb">';
    $args['wrap_after'] = '</ul></nav>';
    $args['delimiter'] = '';
    $args['before'] = '<li>';
    $args['after'] = '</li>';

    return $args;
}

add_action('widgets_init', 'theme_replace_wc_widgets', 20);

function theme_replace_wc_widgets() {
	if (!class_exists('WC_Widget_Layered_Nav')) return;
	
    class Theme_Widget_Layered_Nav extends WC_Widget_Layered_Nav {
        public function init_settings() {
            parent::init_settings();
            $this->settings['display_type']['options']['radio'] = __( 'Radio buttons', 'kenyon' );
        }

        public function widget( $args, $instance ) {
            global $_chosen_attributes;

            extract( $args );

            if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) )
                return;

            $current_term 	= is_tax() ? get_queried_object()->term_id : '';
            $current_tax 	= is_tax() ? get_queried_object()->taxonomy : '';
            $title 			= apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
            $taxonomy 		= isset( $instance['attribute'] ) ? wc_attribute_taxonomy_name($instance['attribute']) : '';
            $query_type 	= isset( $instance['query_type'] ) ? $instance['query_type'] : 'and';
            $display_type 	= isset( $instance['display_type'] ) ? $instance['display_type'] : 'list';

            if ( ! taxonomy_exists( $taxonomy ) )
                return;

            $get_terms_args = array( 'hide_empty' => '1' );

            $orderby = wc_attribute_orderby( $taxonomy );

            switch ( $orderby ) {
                case 'name' :
                    $get_terms_args['orderby']    = 'name';
                    $get_terms_args['menu_order'] = false;
                    break;
                case 'id' :
                    $get_terms_args['orderby']    = 'id';
                    $get_terms_args['order']      = 'ASC';
                    $get_terms_args['menu_order'] = false;
                    break;
                case 'menu_order' :
                    $get_terms_args['menu_order'] = 'ASC';
                    break;
            }

            $terms = get_terms( $taxonomy, $get_terms_args );

            if ( count( $terms ) > 0 ) {

                ob_start();

                $found = false;

                echo $before_widget . $before_title . $title . $after_title;

                // Force found when option is selected - do not force found on taxonomy attributes
                if ( ! is_tax() && is_array( $_chosen_attributes ) && array_key_exists( $taxonomy, $_chosen_attributes ) )
                    $found = true;

                if ( $display_type == 'dropdown' ) {

                    // skip when viewing the taxonomy
                    if ( $current_tax && $taxonomy == $current_tax ) {

                        $found = false;

                    } else {

                        $taxonomy_filter = str_replace( 'pa_', '', $taxonomy );

                        $found = false;

                        echo '<select id="dropdown_layered_nav_' . $taxonomy_filter . '">';

                        echo '<option value="">' . sprintf( __( 'Any %s', 'woocommerce' ), wc_attribute_label( $taxonomy ) ) .'</option>';

                        foreach ( $terms as $term ) {

                            // If on a term page, skip that term in widget list
                            if ( $term->term_id == $current_term )
                                continue;

                            // Get count based on current view - uses transients
                            $transient_name = 'wc_ln_count_' . md5( sanitize_key( $taxonomy ) . sanitize_key( $term->term_id ) );

                            if ( false === ( $_products_in_term = get_transient( $transient_name ) ) ) {

                                $_products_in_term = get_objects_in_term( $term->term_id, $taxonomy );

                                set_transient( $transient_name, $_products_in_term, YEAR_IN_SECONDS );
                            }

                            $option_is_set = ( isset( $_chosen_attributes[ $taxonomy ] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) );

                            // If this is an AND query, only show options with count > 0
                            if ( $query_type == 'and' ) {

                                $count = sizeof( array_intersect( $_products_in_term, WC()->query->filtered_product_ids ) );

                                if ( $count > 0 )
                                    $found = true;

                                if ( $count == 0 && ! $option_is_set )
                                    continue;

                                // If this is an OR query, show all options so search can be expanded
                            } else {

                                $count = sizeof( array_intersect( $_products_in_term, WC()->query->unfiltered_product_ids ) );

                                if ( $count > 0 )
                                    $found = true;

                            }

                            echo '<option value="' . esc_attr( $term->term_id ) . '" '.selected( isset( $_GET[ 'filter_' . $taxonomy_filter ] ) ? $_GET[ 'filter_' .$taxonomy_filter ] : '' , $term->term_id, false ) . '>' . $term->name . '</option>';
                        }

                        echo '</select>';
						
                        wc_enqueue_js("

							jQuery('#dropdown_layered_nav_$taxonomy_filter').change(function(){

								location.href = '" . esc_url_raw( preg_replace( '%\/page/[0-9]+%', '', add_query_arg('filtering', '1', remove_query_arg( array( 'page', 'filter_' . $taxonomy_filter ) ) ) ) ) . "&filter_$taxonomy_filter=' + jQuery('#dropdown_layered_nav_$taxonomy_filter').val();

							});

						");

                    }

                } elseif ( $display_type == 'radio' ) {

                    // skip when viewing the taxonomy
                    if ( $current_tax && $taxonomy == $current_tax ) {

                        $found = false;

                    } else {

                        $taxonomy_filter = str_replace( 'pa_', '', $taxonomy );

                        $found = false;

                        echo '<ul class="check-list">';
						
									
                        echo '<li><input id="dropdown_layered_nav_' . $taxonomy_filter . '_all" name="dropdown_layered_nav_' . $taxonomy_filter . '" type="radio" value="" '. ((!isset( $_GET[ 'filter_' . $taxonomy_filter ] ) || empty($_GET[ 'filter_' . $taxonomy_filter ])) ? ' checked="checked"' : '') . ' /> <label for="dropdown_layered_nav_' . $taxonomy_filter . '_all">' . sprintf( __( 'Any %s', 'woocommerce' ), wc_attribute_label( $taxonomy ) ) .'</label></li>';

                        foreach ( $terms as $term ) {

                            // If on a term page, skip that term in widget list
                            if ( $term->term_id == $current_term )
                                continue;

                            // Get count based on current view - uses transients
                            $transient_name = 'wc_ln_count_' . md5( sanitize_key( $taxonomy ) . sanitize_key( $term->term_id ) );

                            if ( false === ( $_products_in_term = get_transient( $transient_name ) ) ) {

                                $_products_in_term = get_objects_in_term( $term->term_id, $taxonomy );

                                set_transient( $transient_name, $_products_in_term, YEAR_IN_SECONDS );
                            }

                            $option_is_set = ( isset( $_chosen_attributes[ $taxonomy ] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) );

                            // If this is an AND query, only show options with count > 0
                            if ( $query_type == 'and' ) {

                                $count = sizeof( array_intersect( $_products_in_term, WC()->query->filtered_product_ids ) );

                                if ( $count > 0 )
                                    $found = true;

                                if ( $count == 0 && ! $option_is_set )
                                    continue;

                                // If this is an OR query, show all options so search can be expanded
                            } else {

                                $count = sizeof( array_intersect( $_products_in_term, WC()->query->unfiltered_product_ids ) );

                                if ( $count > 0 )
                                    $found = true;

                            }
							
							//Skip Marine Use only
							$class = "" ;
							if( strtoupper($term->name) ==  strtoupper("Marine Use Only") )
							{
								$class = "style=display:none;";
							}
							
                            echo '<li '. $class .'><input id="dropdown_layered_nav_' . $taxonomy_filter . '_'.$term->term_id.'" name="dropdown_layered_nav_' . $taxonomy_filter . '" type="radio" value="' . esc_attr( $term->term_id ) . '" '.checked( isset( $_GET[ 'filter_' . $taxonomy_filter ] ) ? $_GET[ 'filter_' .$taxonomy_filter ] : '' , $term->term_id, false ) . ' /> <label for="dropdown_layered_nav_' . $taxonomy_filter . '_'.$term->term_id.'">' . $term->name . '</label></li>';
                        }

                        echo '</ul>';

                        wc_enqueue_js("

						jQuery('input[name=dropdown_layered_nav_" . $taxonomy_filter . "]').change(function(){
						
							location.href = '" . esc_url_raw( preg_replace( '%\/page/[0-9]+%', '', add_query_arg('filtering', '1', remove_query_arg( array( 'page', 'filter_' . $taxonomy_filter ) ) ) ) ) . "&filter_$taxonomy_filter=' + jQuery(this).val();

						});

					    ");

                    }

                } else {

                    // List display
                    echo "<ul>";

                    foreach ( $terms as $term ) {

                        // Get count based on current view - uses transients
                        $transient_name = 'wc_ln_count_' . md5( sanitize_key( $taxonomy ) . sanitize_key( $term->term_id ) );

                        if ( false === ( $_products_in_term = get_transient( $transient_name ) ) ) {

                            $_products_in_term = get_objects_in_term( $term->term_id, $taxonomy );

                            set_transient( $transient_name, $_products_in_term );
                        }

                        $option_is_set = ( isset( $_chosen_attributes[ $taxonomy ] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) );

                        // skip the term for the current archive
                        if ( $current_term == $term->term_id )
                            continue;

                        // If this is an AND query, only show options with count > 0
                        if ( $query_type == 'and' ) {

                            $count = sizeof( array_intersect( $_products_in_term, WC()->query->filtered_product_ids ) );

                            if ( $count > 0 && $current_term !== $term->term_id )
                                $found = true;

                            if ( $count == 0 && ! $option_is_set )
                                continue;

                            // If this is an OR query, show all options so search can be expanded
                        } else {

                            $count = sizeof( array_intersect( $_products_in_term, WC()->query->unfiltered_product_ids ) );

                            if ( $count > 0 )
                                $found = true;

                        }

                        $arg = 'filter_' . sanitize_title( $instance['attribute'] );

                        $current_filter = ( isset( $_GET[ $arg ] ) ) ? explode( ',', $_GET[ $arg ] ) : array();

                        if ( ! is_array( $current_filter ) )
                            $current_filter = array();

                        $current_filter = array_map( 'esc_attr', $current_filter );

                        if ( ! in_array( $term->term_id, $current_filter ) )
                            $current_filter[] = $term->term_id;

                        // Base Link decided by current page
                        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
                            $link = home_url();
                        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
                            $link = get_post_type_archive_link( 'product' );
                        } else {
                            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
                        }

                        // All current filters
                        if ( $_chosen_attributes ) {
                            foreach ( $_chosen_attributes as $name => $data ) {
                                if ( $name !== $taxonomy ) {

                                    // Exclude query arg for current term archive term
                                    while ( in_array( $current_term, $data['terms'] ) ) {
                                        $key = array_search( $current_term, $data );
                                        unset( $data['terms'][$key] );
                                    }

                                    // Remove pa_ and sanitize
                                    $filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );

                                    if ( ! empty( $data['terms'] ) )
                                        $link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );

                                    if ( $data['query_type'] == 'or' )
                                        $link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
                                }
                            }
                        }

                        // Min/Max
                        if ( isset( $_GET['min_price'] ) )
                            $link = add_query_arg( 'min_price', $_GET['min_price'], $link );

                        if ( isset( $_GET['max_price'] ) )
                            $link = add_query_arg( 'max_price', $_GET['max_price'], $link );

                        // Orderby
                        if ( isset( $_GET['orderby'] ) )
                            $link = add_query_arg( 'orderby', $_GET['orderby'], $link );

                        // Current Filter = this widget
                        if ( isset( $_chosen_attributes[ $taxonomy ] ) && is_array( $_chosen_attributes[ $taxonomy ]['terms'] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) ) {

                            $class = 'class="chosen"';

                            // Remove this term is $current_filter has more than 1 term filtered
                            if ( sizeof( $current_filter ) > 1 ) {
                                $current_filter_without_this = array_diff( $current_filter, array( $term->term_id ) );
                                $link = add_query_arg( $arg, implode( ',', $current_filter_without_this ), $link );
                            }

                        } else {

                            $class = '';
                            $link = add_query_arg( $arg, implode( ',', $current_filter ), $link );

                        }

                        // Search Arg
                        if ( get_search_query() )
                            $link = add_query_arg( 's', get_search_query(), $link );

                        // Post Type Arg
                        if ( isset( $_GET['post_type'] ) )
                            $link = add_query_arg( 'post_type', $_GET['post_type'], $link );

                        // Query type Arg
                        if ( $query_type == 'or' && ! ( sizeof( $current_filter ) == 1 && isset( $_chosen_attributes[ $taxonomy ]['terms'] ) && is_array( $_chosen_attributes[ $taxonomy ]['terms'] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) ) )
                            $link = add_query_arg( 'query_type_' . sanitize_title( $instance['attribute'] ), 'or', $link );

                        echo '<li ' . $class . '>';

                        echo ( $count > 0 || $option_is_set ) ? '<a href="' . esc_url( apply_filters( 'woocommerce_layered_nav_link', $link ) ) . '">' : '<span>';

                        echo $term->name;

                        echo ( $count > 0 || $option_is_set ) ? '</a>' : '</span>';

                        echo ' <small class="count">' . $count . '</small></li>';

                    }

                    echo "</ul>";

                } // End display type conditional

                echo $after_widget;

                if ( ! $found )
                    ob_end_clean();
                else
                    echo ob_get_clean();
            }
        }
    }

    unregister_widget('WC_Widget_Layered_Nav');
    register_widget('Theme_Widget_Layered_Nav');

    class Theme_Widget_Price_Filter extends WC_Widget_Price_Filter {

        public function widget( $args, $instance ) {
            global $_chosen_attributes, $wpdb, $woocommerce, $wp_query, $wp;

            extract( $args );

            if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) )
                return;

            if ( sizeof( WC()->query->unfiltered_product_ids ) == 0 )
                return; // None shown - return

            $min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '';
            $max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '';

            wp_enqueue_script( 'wc-price-slider' );

            $title  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

            // Remember current filters/search
            $fields = '';

            if ( get_search_query() )
                $fields .= '<input type="hidden" name="s" value="' . get_search_query() . '" />';

            if ( ! empty( $_GET['post_type'] ) )
                $fields .= '<input type="hidden" name="post_type" value="' . esc_attr( $_GET['post_type'] ) . '" />';

            if ( ! empty ( $_GET['product_cat'] ) )
                $fields .= '<input type="hidden" name="product_cat" value="' . esc_attr( $_GET['product_cat'] ) . '" />';

            if ( ! empty( $_GET['product_tag'] ) )
                $fields .= '<input type="hidden" name="product_tag" value="' . esc_attr( $_GET['product_tag'] ) . '" />';

            if ( ! empty( $_GET['orderby'] ) )
                $fields .= '<input type="hidden" name="orderby" value="' . esc_attr( $_GET['orderby'] ) . '" />';

            if ( $_chosen_attributes ) foreach ( $_chosen_attributes as $attribute => $data ) {

                $taxonomy_filter = 'filter_' . str_replace( 'pa_', '', $attribute );

                $fields .= '<input type="hidden" name="' . esc_attr( $taxonomy_filter ) . '" value="' . esc_attr( implode( ',', $data['terms'] ) ) . '" />';

                if ( $data['query_type'] == 'or' )
                    $fields .= '<input type="hidden" name="' . esc_attr( str_replace( 'pa_', 'query_type_', $attribute ) ) . '" value="or" />';
            }

            $min = $max = 0;
            $post_min = $post_max = '';

            if ( sizeof( WC()->query->layered_nav_product_ids ) === 0 ) {
                $min = floor( $wpdb->get_var(
                    $wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE ( meta_key = \'%3$s\' OR meta_key = \'%4$s\' )
					AND meta_value != ""
				', $wpdb->posts, $wpdb->postmeta, '_price', '_min_variation_price' )
                ) );
                $max = ceil( $wpdb->get_var(
                    $wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key = \'%3$s\'
				', $wpdb->posts, $wpdb->postmeta, '_price' )
                ) );
            } else {
                $min = floor( $wpdb->get_var(
                    $wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE ( meta_key =\'%3$s\' OR meta_key =\'%4$s\' )
					AND meta_value != ""
					AND (
						%1$s.ID IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
						OR (
							%1$s.post_parent IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta, '_price', '_min_variation_price'
                    ) ) );
                $max = ceil( $wpdb->get_var(
                    $wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key =\'%3$s\'
					AND (
						%1$s.ID IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
						OR (
							%1$s.post_parent IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta, '_price'
                    ) ) );
            }

            if ( $min == $max )
                return;

            echo $before_widget . $before_title . $title . $after_title;

            if ( get_option( 'permalink_structure' ) == '' )
                $form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
            else
                $form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );

            echo '<form method="get" action="' . esc_attr( $form_action ) . '">
			<div class="price_slider_wrapper">
			    <div class="slider-wrap">
				    <div class="price_slider" style="display:none;"></div>
				</div>
				<div class="price_slider_amount">
					<input type="text" id="min_price" name="min_price" value="' . esc_attr( $min_price ) . '" data-min="'.esc_attr( $min ).'" placeholder="'.__('Min price', 'woocommerce' ).'" />
					<input type="text" id="max_price" name="max_price" value="' . esc_attr( $max_price ) . '" data-max="'.esc_attr( $max ).'" placeholder="'.__( 'Max price', 'woocommerce' ).'" />
					<button type="submit" class="button">'.__( 'Filter', 'woocommerce' ).'</button>
					<div class="price_label" style="display:none;">
						'.__( 'Price:', 'woocommerce' ).' <span class="from"></span> &mdash; <span class="to"></span>
					</div>
					' . $fields . '
					<div class="clear"></div>
				</div>
			</div>
		</form>';

            echo $after_widget;
        }
    }

    unregister_widget('WC_Widget_Price_Filter');
    register_widget('Theme_Widget_Price_Filter');
}

add_filter('woocommerce_product_tabs', 'theme_change_product_tabs');

function theme_change_product_tabs($tabs) {
    if (isset($tabs['additional_information'])) {
        $tabs['additional_information']['title'] = __('Specifications', 'kenyon');
    }

    if (isset($tabs['description'])) {
        $tabs['description']['title'] = __('Overview', 'kenyon');
    }

    if ( theme_has_product_features() ) {
        $tabs['features'] = array(
            'title'    => __( 'Features', 'kenyon' ),
            'priority' => 25,
            'callback' => 'theme_product_features'
        );
    }

    if ( theme_has_product_downloads() ) {
        $tabs['downloads'] = array(
            'title'    => __( 'Downloads', 'kenyon' ),
            'priority' => 26,
            'callback' => 'theme_product_downloads'
        );
    }

    return $tabs;
}

function theme_has_product_overview_gallery() {
    global $post;

    if (!is_singular('product')) return false;

    $gallery = get_field('overview_gallery', $post->ID);

    return !empty($gallery) ? true : false;
}

function theme_product_overview_gallery() {
    if (is_singular('product')) {
        global $post;
        $gallery = get_field('overview_gallery', $post->ID);

        if (!empty($gallery)) {
            wc_get_template('single-product/tabs/overview-gallery.php', array(
                'gallery' => $gallery,
            ));
        }
    }
}

function theme_has_product_features() {
    global $post;

    if (!is_singular('product')) return false;

    $features = get_field('features', $post->ID);

    return !empty($features) ? true : false;
}

function theme_product_features() {
    if (is_singular('product')) {
        global $post;
        $features = get_field('features', $post->ID);

        if (!empty($features)) {
            wc_get_template('single-product/tabs/features.php', array(
                'features' => $features,
            ));
        }
    }
}

function theme_has_product_downloads() {
    global $post;

    if (!is_singular('product')) return false;

    $downloads = get_field('downloads', $post->ID);

    return !empty($downloads) ? true : false;
}

function theme_product_downloads() {
    if (is_singular('product')) {
        global $post;
        $downloads = get_field('downloads', $post->ID);

        if (!empty($downloads)) {
            wc_get_template('single-product/tabs/downloads.php', array(
                'downloads' => $downloads,
            ));
        }
    }
}
function woocommerce_form_field_modified( $key, $args, $value = null ) {
	$defaults = array(
		'type'              => 'text',
		'label'             => '',
		'placeholder'       => '',
		'maxlength'         => false,
		'required'          => false,
		'class'             => array(),
		'label_class'       => array(),
		'input_class'       => array(),
		'return'            => false,
		'options'           => array(),
		'custom_attributes' => array(),
		'validate'          => array(),
		'default'		    => '',
	);

	$args = wp_parse_args( $args, $defaults  );
	
	if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

	if ( $args['required'] ) {
		$args['class'][] = 'validate-required';
		$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
	} else {
		$required = '';
	}

	$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

	if ( is_string( $args['label_class'] ) )
		$args['label_class'] = array( $args['label_class'] );

	if ( is_null( $value ) )
		$value = $args['default'];

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) )
		foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
			if(!empty($attribute_value))
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
		}
	if ( ! empty( $args['validate'] ) )
		foreach( $args['validate'] as $validate )
			$args['class'][] = 'validate-' . $validate;

	switch ( $args['type'] ) {
	case "country" :

		$countries = $key == 'shipping_country' ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

		if ( sizeof( $countries ) == 1 ) {

			$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']  . '</label>';

			$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

			$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" value="' . current( array_keys($countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" />';

			$field .= '</p>' . $after;

		} else {

			$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">'
					. '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required  . '</label>'
					. '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" class="country_to_state country_select" ' . implode( ' ', $custom_attributes ) . '>'
					. '<option value="">'.__( 'Select a country&hellip;', 'woocommerce' ) .'</option>';

			foreach ( $countries as $ckey => $cvalue )
				$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'woocommerce' ) .'</option>';

			$field .= '</select>';

			$field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . __( 'Update country', 'woocommerce' ) . '" /></noscript>';

			$field .= '</p>' . $after;

		}

		break;
	case "state" :

		/* Get Country */
		$country_key = $key == 'billing_state'? 'billing_country' : 'shipping_country';

		if ( isset( $_POST[ $country_key ] ) ) {
			$current_cc = wc_clean( $_POST[ $country_key ] );
		} elseif ( is_user_logged_in() ) {
			$current_cc = get_user_meta( get_current_user_id() , $country_key, true );
			if ( ! $current_cc) {
				$current_cc = apply_filters('default_checkout_country', (WC()->customer->get_country()) ? WC()->customer->get_country() : WC()->countries->get_base_country());
			}
		} elseif ( $country_key == 'billing_country' ) {
			$current_cc = apply_filters('default_checkout_country', (WC()->customer->get_country()) ? WC()->customer->get_country() : WC()->countries->get_base_country());
		} else {
			$current_cc = apply_filters('default_checkout_country', (WC()->customer->get_shipping_country()) ? WC()->customer->get_shipping_country() : WC()->countries->get_base_country());
		}

		$states = WC()->countries->get_states( $current_cc );
		
		if ( is_array( $states ) && empty( $states ) ) {

			$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field" style="display: none">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';
			$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key )  . '" id="' . esc_attr( $key ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';
			$field .= '</p>' . $after;

		} elseif ( is_array( $states ) ) {

			$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';
			$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" class="state_select" '. implode( ' ', $custom_attributes ) .'>
				<option value="">'.__( 'Select a state&hellip;', 'woocommerce' ) .'</option>';

			foreach ( $states as $ckey => $cvalue )
				$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'woocommerce' ) .'</option>';

			$field .= '</select>';
			$field .= '</p>' . $after;

		} else {

			$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';
			$field .= '<input type="text" class="input-text ' . implode( ' ', $args['input_class'] ) .'" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
			$field .= '</p>' . $after;

		}

		break;
	case "textarea" :

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

		if ( $args['label'] )
			$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required  . '</label>';

		$field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . implode( ' ', $args['input_class'] ) .'" id="' . esc_attr( $key ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>'. esc_textarea( $value  ) .'</textarea>
			</p>' . $after;

		break;
	case "checkbox" :

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">
				<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" value="1" '.checked( $value, 1, false ) .' />
				<label for="' . esc_attr( $key ) . '" class="checkbox ' . implode( ' ', $args['label_class'] ) .'" ' . implode( ' ', $custom_attributes ) . '>' . $args['label'] . $required . '</label>
			</p>' . $after;

		break;
	case "password" :

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

		if ( $args['label'] )
			$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';

		$field .= '<input type="password" class="input-text ' . implode( ' ', $args['input_class'] ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />
			</p>' . $after;

		break;
	case "text" :

		$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

		if ( $args['label'] )
			$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';

		$field .= '<input type="text" class="input-text ' . implode( ' ', $args['input_class'] ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />
			</p>' . $after;

		break;
	case "select" :

		$options = '';

		if ( ! empty( $args['options'] ) )
			foreach ( $args['options'] as $option_key => $option_text )
				$options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) .'</option>';

			$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';

			$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" class="select" ' . implode( ' ', $custom_attributes ) . '>
					' . $options . '
				</select>
			</p>' . $after;

		break;
	default :

		$field = apply_filters( 'woocommerce_form_field_' . $args['type'], '', $key, $args, $value );

		break;
	}

	if ( $args['return'] ) return $field; else echo $field;
}

add_action( 'wp_enqueue_scripts', 'theme_load_scripts', 11 );

function theme_load_scripts() {
	wp_deregister_script('wc-add-to-cart-variation');
	wp_register_script( 'wc-add-to-cart-variation', get_template_directory_uri() . '/woocommerce/js/add-to-cart-variation.js', array( 'jquery' ), WC_VERSION, true );
	wp_localize_script( 'wc-add-to-cart-variation', 'wc_add_to_cart_variation_params', apply_filters( 'wc_add_to_cart_variation_params', array(
			'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'woocommerce' ),
			'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ),
	) ) );
	// Add Custom Javascript On checkout For Shipping Updates
	if(is_checkout())
	{
		wp_register_script('custom-checkout', get_template_directory_uri() . '/woocommerce/js/custom_checkout.js', array( 'jquery' ), WC_VERSION, true );
		wp_localize_script( 'custom-checkout', 'wc_cart_params', apply_filters( 'wc_cart_params', array(
				'ajax_url'                     => WC()->ajax_url(),
				'ajax_loader_url'              => apply_filters( 'woocommerce_ajax_loader_url', $assets_path . 'images/ajax-loader@2x.gif' ),
				'update_shipping_method_nonce' => wp_create_nonce( "update-shipping-method" ),
			) ) );
		wp_enqueue_script('custom-checkout', get_template_directory_uri() . '/woocommerce/js/custom_checkout.js', array( 'jquery' ), WC_VERSION, true);
	}
}

add_action('woocommerce_layered_nav_clear_filter', 'add_clear_filters');

function add_clear_filters() {
    $filterreset = $_SERVER['REQUEST_URI'];
	// Check For Filtering by Price Or Filtering by Options 
	if ( strpos($filterreset,'filtering=1') !== false || strpos($filterreset,'min_price=') !== false ) {
        $filterreset = strtok($filterreset, '?');
        echo '<div class="clear-filters-container"><a id="woo-clear-filters" href="'.$filterreset.'">X &nbsp; Clear All Filters</a></div>';
		echo '<div style="height:10px;"></div>';
    }
}


/*** Get AddToCartUrl For variable product with default variation ***/
function getAddToCartUrl($product){
	
				// Code For default variation selection 
				$tempuri = '';
				switch($product->product_type)
				{
					case "variable":
						$array1 = array();
						$var_id = 0;
						
						$available_variations = $product->get_available_variations();
						$var_attributes = get_post_meta($product->id, '_default_attributes');
						
						foreach ($var_attributes[0] as $key => $attval){
							array_push($array1, $attval);
							
							if($tempuri == '')
								$tempuri .= 'attribute_'.$key.'='.$attval;
							else
								$tempuri .= '&attribute_'.$key.'='.$attval;
						}
							
						foreach($available_variations as $variations){
							
							$is_default=true;
							
							foreach($array1 as $value)
							{
								if (!in_array($value,$variations['attributes']))
									$is_default = false;
									break;		
							}
							if($is_default)
								$var_id = $variations['variation_id'];
								
						}
						if( $var_id > 0 && $tempuri != '' )
							$tempuri = '&variation_id='. $var_id . '&' .$tempuri;
						else
							$tempuri = '';
						break;
				}
        		return $tempuri;
}