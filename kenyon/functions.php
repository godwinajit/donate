<?php
include( get_template_directory() .'/classes.php' );
include( get_template_directory() .'/widgets.php' );
include( get_template_directory() .'/build-a-grill-functions.php' );


include( get_template_directory() .'/woocommerce/functions.php' );

include( get_template_directory() .'/product-attributes-tooltips.php' );


add_action('themecheck_checks_loaded', 'theme_disable_cheks');
function theme_disable_cheks() {
	$disabled_checks = array('TagCheck');
	global $themechecks;
	foreach ($themechecks as $key => $check) {
		if (is_object($check) && in_array(get_class($check), $disabled_checks)) {
			unset($themechecks[$key]);
		}
	}
}

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'woocommerce' );

if ( ! isset( $content_width ) ) $content_width = 900;

remove_action('wp_head', 'wp_generator');

add_action( 'after_setup_theme', 'theme_localization' );
function theme_localization () {
	load_theme_textdomain( 'kenyon', get_template_directory() . '/languages' );
}


if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'id' => 'shop-sidebar',
		'name' => __('Shop Sidebar', 'kenyon'),
		'before_widget' => '<div class="block %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>'
	));

	register_sidebar(array(
		'id' => 'myaccount-sidebar',
		'name' => __('MyAccount Sidebar', 'kenyon'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<strong class="title">',
		'after_title' => '</strong>'
	));

    register_sidebar(array(
        'id' => 'shop-product-sidebar',
        'name' => __('Shop Product Sidebar', 'kenyon'),
        'before_widget' => '<aside class="widget %2$s" id="%1$s">',
        'after_widget' => '</aside>',
        'before_title' => '<strong class="title">',
        'after_title' => '</strong>'
    ));

    register_sidebar(array(
        'id' => 'videos-page-sidebar',
        'name' => __('Videos Page Sidebar', 'kenyon'),
        'before_widget' => '<aside class="block %2$s" id="%1$s">',
        'after_widget' => '</aside>',
        'before_title' => '<strong class="title">',
        'after_title' => '</strong>'
    ));

	 register_sidebar(array(
    'id' => 'header_content',
    'name' => __('Header Content', 'kenyon'),
    'before_widget' => '<aside class="block %2$s" id="header_alert">',
    'after_widget' => '</aside>',
    'before_title' => '<strong class="title">',
    'after_title' => '</strong>'
    		));

}

add_filter('cWCdeveloperClasses','theme_widget_classes');
function theme_widget_classes(){
	$classes['classes']= array(
		array(
			'class'=>'help-section',
			'desc'=>'Need Help Widget',
		),
	);

    return $classes;
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 182, true );
	add_image_size( 'homepage-slideshow', 1440, 403, true );
	add_image_size( 'shop_promotion', 149, 200, true );
	add_image_size( 'homepage-promo-image', 395, 372, true );
    add_image_size( 'homepage-latest-news-image', 207, 120, true );
    add_image_size( 'homepage-latest-recipe-image', 164, 157, true );
    add_image_size( 'blogroll-featured', 413, 400, true );
    add_image_size( 'blogroll-featured-pages', 298, 120, true );
    add_image_size( 'about-map-logo', 192, 51, true );
    add_image_size( 'about-awards-logo', 209, 99999, false );
    add_image_size( 'shop_product_overview_gallery', 261, 99999, false );
	add_image_size( 'build-a-grill-thumbnail', 200, 200, true );
	add_image_size( 'product-image-with-video', 90, 56, true );
}


register_nav_menus( array(
	'top' => __( 'Top', 'kenyon' ),
    'main' => __( 'Main', 'kenyon' ),
    'footer_1' => __( 'Footer 1', 'kenyon' ),
    'footer_2' => __( 'Footer 2', 'kenyon' ),
    'bottom' => __( 'Bottom', 'kenyon' ),
) );


//Add [email]...[/email] shortcode
function shortcode_email($atts, $content) {
	$result = '';
	for ($i=0; $i<strlen($content); $i++) {
		$result .= '&#'.ord($content{$i}).';';
	}
	return $result;
}
add_shortcode('email', 'shortcode_email');

//Register tag [template-url]
function filter_template_url($text) {
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}
add_filter('the_content', 'filter_template_url');
add_filter('get_the_content', 'filter_template_url');
add_filter('widget_text', 'filter_template_url');

//Register tag [site-url]
function filter_site_url($text) {
	return str_replace('[site-url]',get_bloginfo('url'), $text);
}
add_filter('the_content', 'filter_site_url');
add_filter('get_the_content', 'filter_site_url');
add_filter('widget_text', 'filter_site_url');

//Replace standard wp menu classes
function change_menu_classes($css_classes, $item, $args) {

	if (isset($args) && ($args->theme_location == 'main')) {
		return $css_classes;
	}

	$css_classes = str_replace("current-menu-item", "active", $css_classes);
	$css_classes = str_replace("current-menu-parent", "active", $css_classes);
    $css_classes = str_replace("current-menu-ancestor", "active", $css_classes);
    $css_classes = str_replace("menu-item-has-children", "dropdown", $css_classes);

	//$css_classes[] = prinr_r($args)

	return $css_classes;
}
add_filter('nav_menu_css_class', 'change_menu_classes', null, 3);

//Replace standard wp body classes and post classes
function theme_body_class($classes) {
	if (is_array($classes)) {
		foreach ($classes as $key => $class) {
			$classes[$key] = 'body-class-' . $classes[$key];
		}
	}

	return $classes;
}
//add_filter('body_class', 'theme_body_class', 9999);

function theme_post_class($classes) {
	if (is_array($classes)) {
		foreach ($classes as $key => $class) {
			$classes[$key] = 'post-class-' . $classes[$key];
		}
	}

	return $classes;
}
add_filter('post_class', 'theme_post_class', 9999);

//Allow tags in category description
$filters = array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description');
foreach ( $filters as $filter ) {
    remove_filter($filter, 'wp_filter_kses');
}


//Make wp admin menu html valid
function wp_admin_bar_valid_search_menu( $wp_admin_bar ) {
	if ( is_admin() )
		return;

	$form  = '<form action="' . esc_url( home_url( '/' ) ) . '" method="get" id="adminbarsearch"><div>';
	$form .= '<input class="adminbar-input" name="s" id="adminbar-search" tabindex="10" type="text" value="" maxlength="150" />';
	$form .= '<input type="submit" class="adminbar-button" value="' . __('Search', 'kenyon') . '"/>';
	$form .= '</div></form>';

	$wp_admin_bar->add_menu( array(
		'parent' => 'top-secondary',
		'id'     => 'search',
		'title'  => $form,
		'meta'   => array(
			'class'    => 'admin-bar-search',
			'tabindex' => -1,
		)
	) );
}

function fix_admin_menu_search() {
	remove_action( 'admin_bar_menu', 'wp_admin_bar_search_menu', 4 );
	add_action( 'admin_bar_menu', 'wp_admin_bar_valid_search_menu', 4 );
}

add_action( 'add_admin_bar_menus', 'fix_admin_menu_search' );

//Disable comments on pages by default
function theme_page_comment_status($post_ID, $post, $update) {
	if (!$update) {
		remove_action('save_post_page', 'theme_page_comment_status', 10);
		wp_update_post(array(
			'ID' => $post->ID,
			'comment_status' => 'closed',
		));
		add_action('save_post_page', 'theme_page_comment_status', 10, 3);
	}
}
add_action('save_post_page', 'theme_page_comment_status', 10, 3);

//custom excerpt
function theme_the_excerpt() {
	global $post;

	if (trim($post->post_excerpt)) {
		the_excerpt();
	} elseif (strpos($post->post_content, '<!--more-->') !== false) {
		the_content();
	} else {
		the_excerpt();
	}
}

/* advanced custom fields settings*/

//theme options tab in appearance
if(function_exists('acf_add_options_sub_page')) {
	acf_add_options_sub_page(array(
		'title' => __('Theme Options', 'kenyon'),
		'parent' => 'themes.php',
	));
}

//acf theme functions placeholders
if(!class_exists('acf') && !is_admin()) {
	function get_field_reference( $field_name, $post_id ) {return '';}
	function get_field_objects( $post_id = false, $options = array() ) {return false;}
	function get_fields( $post_id = false) {return false;}
	function get_field( $field_key, $post_id = false, $format_value = true )  {return false;}
	function get_field_object( $field_key, $post_id = false, $options = array() ) {return false;}
	function the_field( $field_name, $post_id = false ) {}
	function have_rows( $field_name, $post_id = false ) {return false;}
	function the_row() {}
	function reset_rows( $hard_reset = false ) {}
	function has_sub_field( $field_name, $post_id = false ) {return false;}
	function get_sub_field( $field_name ) {return false;}
	function the_sub_field($field_name) {}
	function get_sub_field_object( $child_name ) {return false;}
	function acf_get_child_field_from_parent_field( $child_name, $parent ) {return false;}
	function register_field_group( $array ) {}
	function get_row_layout() {return false;}
	function acf_form_head() {}
	function acf_form( $options = array() ) {}
	function update_field( $field_key, $value, $post_id = false ) {return false;}
	function delete_field( $field_name, $post_id ) {}
	function create_field( $field ) {}
	function reset_the_repeater_field() {}
	function the_repeater_field($field_name, $post_id = false) {return false;}
	function the_flexible_field($field_name, $post_id = false) {return false;}
	function acf_filter_post_id( $post_id ) {return $post_id;}
}

function theme_get_fields($post_id, $filter = null, $remove_empty = true) {
	static $options = array();

	if (!isset($options[$post_id])) {
		$options[$post_id] = get_fields($post_id);
	}

	$result = $options[$post_id];

	if (!empty($filter) && !empty($result)) {
		$result = array_intersect_key($result, array_flip($filter));
	}

	if ($remove_empty) {
		$result = array_filter($result);
	}

	return $result;
}

function theme_language_switcher() {
?>
<div class="form-switcher">
<p><span class="language-switch-text">Select language</span></p>
	<form action="#" class="language-form">

		<fieldset>
			<select class="language">
				<option value="en|en" title="<?php bloginfo('template_url') ?>/images/flags/us.png">us</option>
				<option value="en|es" title="<?php bloginfo('template_url') ?>/images/flags/es.png">es</option>
				<option value="en|fr" title="<?php bloginfo('template_url') ?>/images/flags/fr.png">fr</option>
				<option value="en|it" title="<?php bloginfo('template_url') ?>/images/flags/it.png">it</option>
				<option value="en|pt" title="<?php bloginfo('template_url') ?>/images/flags/pt.png">pt</option>
				<option value="en|de" title="<?php bloginfo('template_url') ?>/images/flags/de.png">de</option>
			</select>
		</fieldset>
	</form>
</div>
	<div id="google_translate_element2" style="display:none;"></div>
	<script type="text/javascript">
	function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
	</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
	<script type="text/javascript">
	/* <![CDATA[ */
	function GTranslateFireEvent(element,event){try{if(document.createEventObject){var evt=document.createEventObject();element.fireEvent('on'+event,evt)}else{var evt=document.createEvent('HTMLEvents');evt.initEvent(event,true,true);element.dispatchEvent(evt)}}catch(e){}}function doGTranslate(lang_pair){if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];var teCombo;var sel=document.getElementsByTagName('select');for(var i=0;i<sel.length;i++)if(sel[i].className=='goog-te-combo')teCombo=sel[i];if(document.getElementById('google_translate_element2')==null||document.getElementById('google_translate_element2').innerHTML.length==0||teCombo.length==0||teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)},500)}else{teCombo.value=lang;GTranslateFireEvent(teCombo,'change');GTranslateFireEvent(teCombo,'change')}}
	/* ]]> */
	</script>

<?php

}

function theme_filter_digits($string) {
    return preg_replace('|[^0-9]|', '', $string);
}

// Allow HTML descriptions in WordPress Menu
remove_filter( 'nav_menu_description', 'strip_tags' );
add_filter( 'wp_setup_nav_menu_item', 'theme_wp_setup_nav_menu_item' );
function theme_wp_setup_nav_menu_item( $menu_item ) {
    $menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
    return $menu_item;
}

function theme_menu_name($location) {
    $locations = get_nav_menu_locations();
    if ( isset( $locations[ $location ] ) ) {
        if ($menu = wp_get_nav_menu_object( $locations[ $location ] )) {
            echo $menu->name;
        }
    }
}

function theme_subscribe_form() {
    global $mysubscribe2;

    if ( isset($_REQUEST['email']) && is_email($_REQUEST['email']) ) {
        $value = $mysubscribe2->sanitize_email($_REQUEST['email']);
    } else {
        $value = '';
    }

    ob_start();
?>
<form method="post" action="<?php echo get_site_url() ?>" class="newsletter-form">
    <fieldset>
        <label for="newsletter-field"><?php _e('Join our newsletter', 'kenyon') ?></label>
        <div class="area clearfix">
            <input type="email" name="email" id="newsletter-field" value="<?php echo $value ?>" placeholder="" />
            <input class="btn btn-default" type="submit" name="subscribe" value="<?php _e('Send', 'kenyon') ?>" />
            <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>" />
        </div>
    </fieldset>
</form>
<?php
    return ob_get_clean();
}
add_filter('s2_form', 'theme_subscribe_form');

function theme_print_once($text, $place = 'global') {
    static $flag = array();

    if (!isset($flag[$place])) {
        $flag[$place] = true;
        echo $text;
    }
}

function theme_author_posts_link_filter($link) {
    global $authordata;
    if ( !is_object( $authordata ) )
        return false;

    $link = sprintf(
        '<a href="%1$s" title="%2$s" rel="author" class="by">%3$s</a>',
        esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
        esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ),
        get_the_author()
    );

    return $link;
}
add_filter('the_author_posts_link', 'theme_author_posts_link_filter');

function theme_print_each($count = null, $text = '') {
    static $counter = 0;

    if ($count === null) {
        $counter = 0;
        return;
    }

    if (($counter != 0) && ($counter % $count == 0)) echo $text;

    $counter++;
}

if (function_exists('wp_pagenavi')) :

function theme_pagenavi( $args = array() ) {
    if ( !is_array( $args ) ) {
        $argv = func_get_args();

        $args = array();
        foreach ( array( 'before', 'after', 'options' ) as $i => $key )
            $args[ $key ] = isset( $argv[ $i ]) ? $argv[ $i ] : "";
    }

    $args = wp_parse_args( $args, array(
        'before' => '',
        'after' => '',
        'options' => array(),
        'query' => $GLOBALS['wp_query'],
        'type' => 'posts',
        'echo' => true
    ) );

    extract( $args, EXTR_SKIP );

    $options = wp_parse_args( $options, PageNavi_Core::$options->get() );

    $instance = new PageNavi_Call( $args );

    list( $posts_per_page, $paged, $total_pages ) = $instance->get_pagination_args();

    //custom posts_per_page fix
    global $wp_query;
    if ($wp_query->is_posts_page) {
        $posts_per_page = get_option('posts_per_page');
        $total_pages = intval($wp_query->found_posts / $posts_per_page) + (($wp_query->found_posts % $posts_per_page) ? 1 : 0);
    }

    if ( 1 == $total_pages && !$options['always_show'] )
        return;

    $pages_to_show = absint( $options['num_pages'] );
    $larger_page_to_show = absint( $options['num_larger_page_numbers'] );
    $larger_page_multiple = absint( $options['larger_page_numbers_multiple'] );
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor( $pages_to_show_minus_1/2 );
    $half_page_end = ceil( $pages_to_show_minus_1/2 );
    $start_page = $paged - $half_page_start;

    if ( $start_page <= 0 )
        $start_page = 1;

    $end_page = $paged + $half_page_end;

    if ( ( $end_page - $start_page ) != $pages_to_show_minus_1 )
        $end_page = $start_page + $pages_to_show_minus_1;

    if ( $end_page > $total_pages ) {
        $start_page = $total_pages - $pages_to_show_minus_1;
        $end_page = $total_pages;
    }

    if ( $start_page < 1 )
        $start_page = 1;

    $out = '';

    if ( $start_page >= 2 && $pages_to_show < $total_pages ) {
        // First
        $first_text = str_replace( '%TOTAL_PAGES%', number_format_i18n( $total_pages ), $options['first_text'] );
        $out .= '<li>' .$instance->get_single( 1, $first_text, array(
            'class' => 'first'
        ), '%TOTAL_PAGES%' ). '</li>';
    }

    // Previous
    if ( $paged > 1 && !empty( $options['prev_text'] ) ) {
        $out .= '<li>' . $instance->get_single( $paged - 1, $options['prev_text'], array(
            'class' => 'previouspostslink',
        ) ) . '</li>';
    }

    if ( $start_page >= 2 && $pages_to_show < $total_pages ) {
        if ( !empty( $options['dotleft_text'] ) )
            $out .= "<li><span class='extend'>{$options['dotleft_text']}</span></li>";
    }

    // Smaller pages
    $larger_pages_array = array();
    if ( $larger_page_multiple )
        for ( $i = $larger_page_multiple; $i <= $total_pages; $i+= $larger_page_multiple )
            $larger_pages_array[] = $i;

    $larger_page_start = 0;
    foreach ( $larger_pages_array as $larger_page ) {
        if ( $larger_page < ($start_page - $half_page_start) && $larger_page_start < $larger_page_to_show ) {
            $out .= '<li>' . $instance->get_single( $larger_page, $options['page_text'], array(
                'class' => 'smaller page',
            ) ) . '</li>';
            $larger_page_start++;
        }
    }

    if ( $larger_page_start )
        $out .= "<li><span class='extend'>{$options['dotleft_text']}</span></li>";

    // Page numbers
    $timeline = 'smaller';
    foreach ( range( $start_page, $end_page ) as $i ) {
        if ( $i == $paged && !empty( $options['current_text'] ) ) {
            $current_page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $options['current_text'] );
            $out .= "<li class=\"active\"><span>$current_page_text</span></li>";
            $timeline = 'larger';
        } else {
            $out .= '<li>' . $instance->get_single( $i, $options['page_text'], array(
                'class' => "page $timeline",
            ) ) . '</li>';
        }
    }

    // Large pages
    $larger_page_end = 0;
    $larger_page_out = '';
    foreach ( $larger_pages_array as $larger_page ) {
        if ( $larger_page > ($end_page + $half_page_end) && $larger_page_end < $larger_page_to_show ) {
            $larger_page_out .= '<li>' . $instance->get_single( $larger_page, $options['page_text'], array(
                'class' => 'larger page',
            ) ) . '</li>';
            $larger_page_end++;
        }
    }

    if ( $larger_page_out ) {
        $out .= "<li><span class='extend'>{$options['dotright_text']}</span></li>";
    }
    $out .= $larger_page_out;

    if ( $end_page < $total_pages ) {
        if ( !empty( $options['dotright_text'] ) )
            $out .= "<li><span class='extend'>{$options['dotright_text']}</span></li>";
    }

    // Next
    if ( $paged < $total_pages && !empty( $options['next_text'] ) ) {
        $out .= '<li>' . $instance->get_single( $paged + 1, $options['next_text'], array(
            'class' => 'nextpostslink',
        ) ) . '</li>';
    }

    if ( $end_page < $total_pages ) {
        // Last
        $out .= '<li>' . $instance->get_single( $total_pages, $options['last_text'], array(
            'class' => 'last',
        ), '%TOTAL_PAGES%' ) . '</li>';
    }

    $out = '<div class="text-center"><ul class="pagination">' . $out . '</ul></div>';

    $out = apply_filters( 'wp_pagenavi', $out );

    if ( !$echo )
        return $out;

    echo $out;
}

endif;

/*
 * custom posts_per_page for blog page
*/
add_action('pre_get_posts', 'theme_blogroll_posts_per_page', 1);
function theme_blogroll_posts_per_page(&$query) {

    if ( (! $query->is_posts_page && !$query->is_home) || is_search() ) {
        return;
    }

    $ppp = get_option('posts_per_page');
    $first_ppp = get_field('first_page_post_number', 'option');
    $first_ppp = $first_ppp ? $first_ppp : $ppp;

    if ( $query->is_paged ) {

        $page_offset = ( ($query->query_vars['paged']-2) * $ppp ) + $first_ppp;

        $query->set('offset', $page_offset );

    }
    else {

        $query->set('posts_per_page', $first_ppp);

    }

}

add_filter('found_posts', 'theme_adjust_blogroll_pagination', 1, 2 );
function theme_adjust_blogroll_pagination($found_posts, $query) {
    $ppp = get_option('posts_per_page');
    $first_ppp = get_field('first_page_post_number', 'option');
    $first_ppp = $first_ppp ? $first_ppp : $ppp;

    if ( $query->is_posts_page ) {
            return $found_posts - ($first_ppp - $ppp);
    }

    return $found_posts;
}


function theme_one_post_category() {
    $cats = get_the_category();

    if (is_array($cats)) {
        return $cats[0]->name;
    }

    return __('Uncategorized');
}

function theme_div_on_images($html, $id, $caption, $title, $align, $url, $size, $alt) {
    $html = get_image_tag($id, $alt, $title, $align, $size);

    $rel = $rel ? ' rel="attachment wp-att-' . esc_attr($id).'"' : '';

    $image = get_post($id);
    $parent = get_post($image->post_parent);

    $before_html = '<div class="image-holder">';
    $after_html = '</div>';

    if ( $url ) {
        $html = $before_html.'<a href="' . esc_attr($url) . "\"$rel>$html</a>".$after_html;
    } else {
        $html = $before_html.$html.$after_html;
    }

    return $html;
}

add_filter('image_send_to_editor', 'theme_div_on_images', 10, 8);

function theme_get_comment_author_link_filter($comment_ID = null) {
    $url    = get_comment_author_url( $comment_ID );
    $author = get_comment_author( $comment_ID );

    if ( empty( $url ) || 'http://' == $url || 'https://' == $url )
        $return = $author;
    else
        $return = "<a href='$url' rel='external nofollow' class='by'>$author</a>";

    return $return;
}
add_filter('get_comment_author_link', 'theme_get_comment_author_link_filter');


function theme_comment_form( $args = array(), $post_id = null ) {
    if ( null === $post_id )
        $post_id = get_the_ID();
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    $args = wp_parse_args( $args );
    if ( ! isset( $args['format'] ) )
        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = 'html5' === $args['format'];
    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
    );

    $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

    /**
     * Filter the default comment form fields.
     *
     * @since 3.0.0
     *
     * @param array $fields The default comment fields.
     */
    $fields = apply_filters( 'comment_form_default_fields', $fields );
    $defaults = array(
        'fields'               => $fields,
        'comment_field'        => '<div class="form-group comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
        /** This filter is documented in wp-includes/link-template.php */
        'must_log_in'          => '<div class="form-group"><p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p></div>',
        /** This filter is documented in wp-includes/link-template.php */
        'logged_in_as'         => '<div class="form-group"><p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p></div>',
        'comment_notes_before' => '<div class="form-group"><p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p></div>',
        'comment_notes_after'  => '<div class="form-group"><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p></div>',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => __( 'Leave a Reply' ),
        'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Post Comment' ),
        'format'               => 'xhtml',
    );

    /**
     * Filter the comment form default arguments.
     *
     * Use 'comment_form_default_fields' to filter the comment fields.
     *
     * @since 3.0.0
     *
     * @param array $defaults The default comment form arguments.
     */
    $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

    ?>
    <?php if ( comments_open( $post_id ) ) : ?>
        <?php
        /**
         * Fires before the comment form.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_before' );
        ?>
        <div id="respond" class="comment-respond">
            <h2 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h2>
            <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
                <?php echo $args['must_log_in']; ?>
                <?php
                /**
                 * Fires after the HTML-formatted 'must log in after' message in the comment form.
                 *
                 * @since 3.0.0
                 */
                do_action( 'comment_form_must_log_in_after' );
                ?>
            <?php else : ?>
                <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
                    <?php
                    /**
                     * Fires at the top of the comment form, inside the <form> tag.
                     *
                     * @since 3.0.0
                     */
                    do_action( 'comment_form_top' );
                    ?>
                    <?php if ( is_user_logged_in() ) : ?>
                        <?php
                        /**
                         * Filter the 'logged in' message for the comment form for display.
                         *
                         * @since 3.0.0
                         *
                         * @param string $args_logged_in The logged-in-as HTML-formatted message.
                         * @param array  $commenter      An array containing the comment author's
                         *                               username, email, and URL.
                         * @param string $user_identity  If the commenter is a registered user,
                         *                               the display name, blank otherwise.
                         */
                        echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
                        ?>
                        <?php
                        /**
                         * Fires after the is_user_logged_in() check in the comment form.
                         *
                         * @since 3.0.0
                         *
                         * @param array  $commenter     An array containing the comment author's
                         *                              username, email, and URL.
                         * @param string $user_identity If the commenter is a registered user,
                         *                              the display name, blank otherwise.
                         */
                        do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
                        ?>
                    <?php else : ?>
                        <?php echo $args['comment_notes_before']; ?>
                        <?php
                        /**
                         * Fires before the comment fields in the comment form.
                         *
                         * @since 3.0.0
                         */
                        do_action( 'comment_form_before_fields' );
                        foreach ( (array) $args['fields'] as $name => $field ) {
                            /**
                             * Filter a comment form field for display.
                             *
                             * The dynamic portion of the filter hook, $name, refers to the name
                             * of the comment form field. Such as 'author', 'email', or 'url'.
                             *
                             * @since 3.0.0
                             *
                             * @param string $field The HTML-formatted output of the comment form field.
                             */
                            echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                        }
                        /**
                         * Fires after the comment fields in the comment form.
                         *
                         * @since 3.0.0
                         */
                        do_action( 'comment_form_after_fields' );
                        ?>
                    <?php endif; ?>
                    <?php
                    /**
                     * Filter the content of the comment textarea field for display.
                     *
                     * @since 3.0.0
                     *
                     * @param string $args_comment_field The content of the comment textarea field.
                     */
                    echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
                    ?>
                    <?php echo $args['comment_notes_after']; ?>
                    <p class="form-submit">
                        <input class="btn btn-primary" name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
                        <?php comment_id_fields( $post_id ); ?>
                    </p>
                    <?php
                    /**
                     * Fires at the bottom of the comment form, inside the closing </form> tag.
                     *
                     * @since 1.5.0
                     *
                     * @param int $post_id The post ID.
                     */
                    do_action( 'comment_form', $post_id );
                    ?>
                </form>
            <?php endif; ?>
        </div><!-- #respond -->
        <?php
        /**
         * Fires after the comment form.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_after' );
    else :
        /**
         * Fires after the comment form if comments are closed.
         *
         * @since 3.0.0
         */
        do_action( 'comment_form_comments_closed' );
    endif;
}

function theme_add_menu_start_depth_option($items, $args) {

    $parent_class = array('current-menu-parent', 'current-menu-ancestor');
    $current_class = array('current-menu-item');

    //calculate item children, parents and depth
    $depth = 1;
    $parent_ids = array();
    $parent_keys = array();

    foreach ($items as $key => $item) {
        if ($item->menu_item_parent && ($item->menu_item_parent == $items[$key-1]->ID)) {
            $depth++;
            array_push($parent_ids,$items[$key-1]->ID);
            array_push($parent_keys,$key-1);
        } elseif (count($parent_ids) && ($item->menu_item_parent != $parent_ids[count($parent_ids)-1])) {
            while ($parent_ids && ($item->menu_item_parent != $parent_ids[count($parent_ids)-1])) {
                $depth--;
                array_pop($parent_ids);
                array_pop($parent_keys);
            }
        }

        if ($parent_ids) {
            if (!isset($items[$key]->parent_ids)) {
                $items[$key]->parent_ids = array();
            }

            if (!isset($items[$key]->parent_keys)) {
                $items[$key]->parent_keys = array();
            }

            $items[$key]->parent_ids = $parent_ids;
            $items[$key]->parent_keys = $parent_keys;
        }
        $items[$key]->depth = $depth;
        foreach($parent_keys as $k) {
            if (!isset($items[$k]->child_ids)) {
                $items[$k]->child_ids = array();
            }
            if (!isset($items[$k]->child_keys)) {
                $items[$k]->child_keys = array();
            }
            $items[$k]->child_ids[] = $item->ID;
            $items[$k]->child_keys[] = $key;
        }
    }

    //if start_level >= 2 then remove unnecessary items
    if (!isset($args->start_level) || intval($args->start_level) < 2) {
        return $items;
    } else {
        $filtered_items = $items;

        //find current item
        $current_item = count($filtered_items);
        while ($current_item) {
            if (!is_array($filtered_items[$current_item]->classes)) {
                $filtered_items[$current_item]->classes = array();
            }
            if (count(array_intersect($filtered_items[$current_item]->classes, $current_class))) {
                break;
            }
            $current_item--;
        }

        //find parent item if current item not found
        if (!$current_item) {
            $current_item = count($filtered_items);
            while ($current_item) {
                if (count(array_intersect($filtered_items[$current_item]->classes, $parent_class))) {
                    break;
                }
                $current_item--;
            }
        }

        //if active item found and active item depth not too small to calculate it's submenu on this level
        if ($current_item && $filtered_items[$current_item]->depth >= ($args->start_level -1)) {
            //find active parent with level = start_level -1;
            $parent_item = $current_item;
            if ($filtered_items[$parent_item]->depth >= $args->start_level) {
                $parent_item = $filtered_items[$parent_item]->parent_keys[$args->start_level-2];
            }

            //save
            $child_ids = $filtered_items[$parent_item]->child_ids;
            $child_ids = $child_ids ? $child_ids : array();

            //remove unnecessary items
            foreach ($filtered_items as $key => $item) {
                if (($item->depth < $args->start_level) || (!in_array($item->ID, $child_ids) && ($key != $current_item))) {
                    unset($filtered_items[$key]);
                }
            }

            //reorder item keys
            if (count($filtered_items)) {
                $reordered_items = array();
                $key = 0;
                foreach ($filtered_items as $item) {
                    $key++;
                    $reordered_items[$key] = $item;
                }

                return $reordered_items;
            }
        }

        $args->items_wrap = '';
        return array();
    }
}
add_filter('wp_nav_menu_objects', 'theme_add_menu_start_depth_option', 10, 2);

function theme_sub_nav_menu($locations) {
    foreach ($locations as $location) {
        $nav = wp_nav_menu( array(
            'theme_location' => $location,
            'start_level' => 2,
            'depth' => 2,
            'container' => false,
            'fallback_cb' => false,
            'echo' => false,
            'items_wrap' => '<nav class="side-nav"><ul>%3$s</ul></nav>',
            'walker' => new Theme_Walker_Sub_Nav,
        ));

        $nav = trim($nav);
        if ($nav) {
            return $nav;
        }
    }

    return false;
}

function check_http_in_url($url) {
    if (!preg_match('|http[s]?:\/\/|i', $url)) {
        return 'http://'.$url;
    }else return $url;
}

class MyAccountLinks extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'MyAccountLinks', // Base ID
			__('MyAccountLinks', 'text_domain'), // Name
			array( 'description' => __( 'A Foo Widget', 'text_domain' ), ) // Args
		);
	}

	public function widget( $args, $instance ) { ?>
		<ul class="btn-list">
			<li><a href="#" class="orders">View recent orders</a></li>
			<li><a href="#" class="address">Manage addresses</a></li>
			<li><a href="#" class="password">Change password</a></li>
		</ul>
        <?php
	}


	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}

function theme_excerpt($maxlength = 200) {
	$excerpt = strip_tags(get_the_excerpt());

	if (strlen($excerpt) > $maxlength) {
		$excerpt = substr($excerpt, 0, $maxlength) . '...';
	}

	return $excerpt;
}

function register_MyAccountLinks_widget() {
    register_widget( 'MyAccountLinks' );
}

add_action( 'wp_ajax_nopriv_dealerDetail', 'dealerDetail' );
add_action( 'wp_ajax_dealerDetail', 'dealerDetail' );
function dealerDetail(){
	include( get_template_directory() .'/blocks/dealers/single-dealer.php' );
	exit;
}

add_filter( 'woocommerce_debug_tools', 'custom_woocommerce_debug_tools' );

function custom_woocommerce_debug_tools( $tools ) {
	$tools['woocommerce_delete_tax_rates'] = array(
		'name'		=> __( 'Delete Tax Rates',''),
		'button'	=> __( 'Delete ALL tax rates from WooCommerce','' ),
		'desc'		=> __( 'This tool will delete all your tax rates allowing you to start fresh.', '' ),
		'callback'  => 'woocommerce_delete_tax_rates'
	);
	return $tools;
}

/**
 * Delete Tax rates
 */
function woocommerce_delete_tax_rates() {
	global $wpdb;

	$wpdb->query( "TRUNCATE " . $wpdb->prefix . "woocommerce_tax_rates" );
	$wpdb->query( "TRUNCATE " . $wpdb->prefix . "woocommerce_tax_rate_locations" );

	echo '<div class="updated"><p>' . __( 'Tax rates successfully deleted', 'woocommerce' ) . '</p></div>';
}

function theme_promo_background_image() {
	if ($image = get_field('background_image')) {
		list($src) = wp_get_attachment_image_src($image, 'full');
		echo ' style="background-image: url('.$src.');"';
	}
}

function theme_parse_youtube_url($url) {
	$url_info = parse_url($url);
	if (!isset($url_info['query'])) return false;
	$url_query = array();
	parse_str($url_info['query'], $url_query);
	if (!isset($url_query['v'])) return false;

	return "https://www.youtube.com/embed/{$url_query['v']}";
}

add_action( 'wp_ajax_nopriv_get_youtube_video_data', 'get_youtube_video_data' );
add_action( 'wp_ajax_get_youtube_video_data', 'get_youtube_video_data' );

function get_youtube_video_data(){
	$vid = $_POST['youtubeid'];
	$json_output = file_get_contents("https://gdata.youtube.com/feeds/api/videos/".$vid."?v=2&alt=json");
	$json = json_decode($json_output, true);
	//This gives you the video description
	echo $video_description = $json['entry']['media$group']['media$description']['$t'];
}

add_action( 'wp_ajax_nopriv_get_variation_id', 'get_variation_id' );
add_action( 'wp_ajax_get_variation_id', 'get_variation_id' );

function get_variation_id(){

	$voltage = $_POST['voltage'];
	$plug = $_POST['plug'];
	$pID = $_POST['productID'];

	$args = array(
                     'post_type'     => 'product_variation',
                     'post_status'   => array( 'private', 'publish' ),
                     'numberposts'   => -1,
                     'orderby'       => 'menu_order',
                     'order'         => 'asc',
                     'post_parent'   => $pID
                 );
  	$variations = get_posts( $args );

    foreach ( $variations as $variation ) {

		$variation_id           = absint( $variation->ID );
		$variation_voltage      = get_post_meta( $variation_id, 'attribute_pa_voltage', true );
		$variation_plug         = get_post_meta( $variation_id, 'attribute_pa_plug', true );
		if( $variation_voltage == $voltage && $variation_plug == $plug )
		{
			echo $variation_id;
			die;
		}

  	}

	echo 0;
	die;
}


//Start Multistep checkout page


add_action( 'wp_ajax_nopriv_needs_payment_woocommerce', 'needs_payment_woocommerce' );
add_action( 'wp_ajax_needs_payment_woocommerce', 'needs_payment_woocommerce' );

function needs_payment_woocommerce(){
	add_filter('woocommerce_cart_needs_payment', '__return_false');
	unset($_POST['payment_method']);
	echo 0;
	die;
}
	if ( empty($_POST['payment_method'])  ) {



		add_filter('woocommerce_cart_needs_payment', '__return_false');		
		
		// Place order button text change
		add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' );
		function woo_custom_order_button_text() {
			return __( 'CONTINUE TO PAYMENT', 'woocommerce' );
		}
		// End : Place order button text change
	
	}
	
	
	
	
	
	add_action( 'woocommerce_after_checkout_validation', 'woocommerce_payment' );
	
	function woocommerce_payment($posted){
		global $woocommerce;
			
	
		if ( ! isset( $_POST['woocommerce_checkout_update_totals'] ) && wc_notice_count( 'error' ) == 0 ) {


						if(!empty($_POST['payment_method']))
						{
						
						}
							
						elseif(!isset($_POST['payment_method']))
						{
							
							 if( !empty($_POST['payment_enable']))
							 {
							 	 echo "<div class='alert alert-danger'>Please Select Payment Method </div>"; die;
							 }
							 else {
								 // Contact Details
								
								$billing_fname = $posted['billing_first_name'];
								$billing_last_name = $posted['billing_last_name'];
								$billing_email = $posted['billing_email'];
							
							
								// Billing informations
								$billing_company = $posted['billing_company'];
								$billing_phone = $posted['billing_phone'];
								$billing_country = $posted['billing_country'];
								$billing_address_1 = $posted['billing_address_1'];
								$billing_address_2 = $posted['billing_address_2'];
								$billing_city = $posted['billing_city'];
								$billing_state = $posted['billing_state'];
								$billing_postcode = $posted['billing_postcode'];
								$billing_heading = "<h3>Billing & Shipping Details</h3>";

								if($posted['ship_to_different_address']==1)
								{
									$billing_heading = "<h3>Billing Details</h3>";

									// Shipping informations			
									$shipping_first_name = $posted['shipping_first_name'];
									$shipping_last_name = $posted['shipping_last_name'];
									$shipping_company = $posted['shipping_company'];
									$shipping_country = $posted['shipping_country'];
									$shipping_address_1 = $posted['shipping_address_1'];
									$shipping_address_2 = $posted['shipping_address_2'];
									$shipping_city = $posted['shipping_city'];
									$shipping_state = $posted['shipping_state'];
									$shipping_postcode = $posted['shipping_postcode'];
								}
							
								echo "<div class='checkout_infns'>";
								echo "<h3>Contact Details</h3>";
								echo !empty($billing_fname) ? "<div class='single_row'><span class='label_text'> First Name: </span> <span class='value_text'> $billing_fname </span></div>" : "";
								echo !empty($billing_last_name) ? "<div class='single_row'><span class='label_text'> Last Name: </span> <span class='value_text'> $billing_last_name </span></div>" : "";
								echo !empty($billing_email) ? "<div class='single_row'><span class='label_text'> Email: </span> <span class='value_text'> $billing_email </span></div>" : "";
								echo $billing_heading;
								echo !empty($billing_company) ? "<div class='single_row'><span class='label_text'> Company: </span> <span class='value_text'> $billing_company </span></div>" : "";
								echo !empty($billing_phone) ? "<div class='single_row'><span class='label_text'> Phone: </span> <span class='value_text'> $billing_phone </span></div>" : "";
								echo !empty($billing_country) ? "<div class='single_row'><span class='label_text'> Country: </span> <span class='value_text'> $billing_country </span></div>" : "";
								echo !empty($billing_address_1) ? "<div class='single_row'><span class='label_text'> Address 1: </span> <span class='value_text'> $billing_address_1 </span></div>" : "";
								echo !empty($billing_address_2) ? "<div class='single_row'><span class='label_text'> Address 2: </span> <span class='value_text'> $billing_address_2 </span></div>" : "";
								echo !empty($billing_city) ? "<div class='single_row'><span class='label_text'> City: </span> <span class='value_text'> $billing_city </span></div>" : "";
								echo !empty($billing_state) ? "<div class='single_row'><span class='label_text'> State: </span> <span class='value_text'> $billing_state </span></div>" : "";
								echo !empty($billing_postcode) ? "<div class='single_row'><span class='label_text'> Post Code: </span> <span class='value_text'> $billing_postcode </span></div>" : "";
								
								if($posted['ship_to_different_address']==1)
								{
									echo "<h3>Shipping Details</h3>";
									echo !empty($shipping_first_name) ? "<div class='single_row'><span class='label_text'> First Name: </span> <span class='value_text'> $shipping_first_name </span></div>" : "";
									echo !empty($shipping_last_name) ? "<div class='single_row'><span class='label_text'> Last Name: </span> <span class='value_text'> $shipping_last_name </span></div>" : "";								
									echo !empty($shipping_company) ? "<div class='single_row'><span class='label_text'> Company: </span> <span class='value_text'> $shipping_company </span></div>" : "";							
									echo !empty($shipping_country) ? "<div class='single_row'><span class='label_text'> Country: </span> <span class='value_text'> $shipping_country </span></div>" : "";
									echo !empty($shipping_address_1) ? "<div class='single_row'><span class='label_text'> Address 1: </span> <span class='value_text'> $shipping_address_1 </span></div>" : "";
									echo !empty($shipping_address_2) ? "<div class='single_row'><span class='label_text'> Address 2: </span> <span class='value_text'> $shipping_address_2 </span></div>" : "";
									echo !empty($shipping_city) ? "<div class='single_row'><span class='label_text'> City: </span> <span class='value_text'> $shipping_city </span></div>" : "";
									echo !empty($shipping_state) ? "<div class='single_row'><span class='label_text'> State: </span> <span class='value_text'> $shipping_state </span></div>" : "";
									echo !empty($shipping_postcode) ? "<div class='single_row'><span class='label_text'> Post Code: </span> <span class='value_text'> $shipping_postcode </span></div>" : "";
								}
							
								echo "</div>";

							add_filter('woocommerce_cart_needs_payment', '__return_true');
							?>
							<div class='payment_screen'>
								<div id="payment">
								<?php if ( WC()->cart->needs_payment() ) : ?>
								<h3>Choose payment method</h3>
								<input type="hidden" name="payment_enable" value="yes" />
								<ul class="payment_methods methods">
								<?php
								$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
								if ( ! empty( $available_gateways ) ) {
									foreach ( $available_gateways as $gateway ) {?>
									<li class="payment_method_<?php echo $gateway->id; ?>">
										<input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
										<label for="payment_method_<?php echo $gateway->id; ?>">
											<?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?>
										</label>
									<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
											<div class="payment_box payment_method_<?php echo $gateway->id; ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif; ?>>
												<?php $gateway->payment_fields(); ?>
											</div>
									<?php endif; ?>
									</li>
					<?php	}
						} else {
							if ( ! WC()->customer->get_country() )
								$no_gateways_message = __( 'Please fill in your details above to see available payment methods.', 'woocommerce' );
							else
								$no_gateways_message = __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' );

							echo '<p>' . apply_filters( 'woocommerce_no_available_payment_methods_message', $no_gateways_message ) . '</p>';
						}
					?>
					</ul>
					<?php endif; ?>
						<div class="clear"></div>
						</div>
					</div>
					<div class="col2-set">
					<div class="col-1">
        				<div class="shipping-block">
							<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            
                			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
                	
                			<?php wc_cart_totals_shipping_html(); ?>
                	
                			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
            
            				<?php endif; ?>
        				</div>
  					</div>
  					<div class="col-2" id="shippingAndCartTotal">
    	<div class="cart_totals">
		<table>
			<tr class="cart-subtotal">
				<th><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_subtotal_html(); ?></td>
			</tr>
            
            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			<tr class="shipping">
				<th><?php _e( 'Shipping &amp; handling', 'woocommerce' ); ?></th>
				<td><span id="shipping_handling_charge" class="amount"></span></td>
			</tr>
            <?php endif; ?>
            
			<?php foreach ( WC()->cart->get_coupons( 'cart' ) as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>


			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee">
					<th><?php echo esc_html( $fee->name ); ?></th>
					<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( WC()->cart->tax_display_cart === 'excl' ) : ?>
				<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
						<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
							<th><?php echo esc_html( $tax->label ); ?></th>
							<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr class="tax-total">
						<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
						<td><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>

			<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
				<tr class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

			<tr class="order-total">
				<th><?php _e( 'Order Total', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_order_total_html(); ?></td>
			</tr>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		</table>
		</div>
		</div>
		</div>
					<?php add_filter('woocommerce_cart_needs_payment', '__return_false');?>
						<script type="text/javascript">										
							jQuery( function( $ ) {
									$('.woocommerce-checkout li').removeClass('active');
									$('.woocommerce-checkout li.payment_step').addClass('active');
									$( ".woocommerce-checkout li.billing_step .holder" ).replaceWith( "<span class='holder'>CHECKOUT <span style='color:#f99400;'>[ Edit ] </span></span>" );
									$('.checkout #place_order').val('PLACE ORDER');
									$(".payment-holder").attr("style", "display: none !important");
									$(".shipping-block").attr("style", "display: block !important");
									$('.woocommerce-checkout .step-list li').click(function()
										{	
										   var steps = $(this).attr("class");
										    $(".payment_methods .input-radio").attr("checked", false);
										    $(".checkout_infns").hide();
											   if(steps=="billing_step"){
												   $(".payment-holder").attr("style", "display: block !important");
												   $(".shipping-block").remove();
												   $("#shippingAndCartTotal").remove();
												   $(".payment_screen").hide();
												   $('.checkout #place_order').val('CONTINUE TO PAYMENT');
												   $( "input[name=payment_enable]" ).remove();
												   $( ".alert-danger" ).remove();
												   
													$.ajax({
												        type: 'POST',			   
														url:"/wp-admin/admin-ajax.php",
												        data: 
													        { action: 'needs_payment_woocommerce'															        	 },
													          success: function(data, textStatus, XMLHttpRequest)
																        {
																            //update_checkout();
																        }
														    }); 
													$('.woocommerce-checkout li').removeClass('active');
													$(this).addClass('active');
										   }
										});
									});
								</script>								
							 	<style type="text/css"> 	
								 	div.blockOverlay
								 	{ 	
									   /* position:unset !important;
									    display:none !important; */
									}
									.payment-holder,.shipping-block, #order_review h3
									{
									 	 display:none !important;
									} 
									#add_payment_method
									{
										border : none !important;
								 	}	 	
							 	</style>
							 	<?php die;
							 		}
								} // payment screen repeating avoid on not clicked on payment
							}
					}
//End Multistep checkout page


add_action('wp_head','kenyon_ajaxurl');
function kenyon_ajaxurl() {
?>
<script type="text/javascript">
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}

//save_product_variation
function save_product_variation($post_id) {

	// Autosave, do nothing
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
	// AJAX? Not used here
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
        return;
	// Check user permissions
	if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
	// Return if it's a post revision
	if ( false !== wp_is_post_revision( $post_id ) )
        return;

	global $post;
	$post = get_post( $post_id );

	if ( $post->post_type == 'product' ) {

		$args = array(
			'post_parent' => $post_id,
			'post_type' => array ( 'product_variation' ),
		);
		$the_query = new WP_Query( $args );

		$variation_skus = '';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$sku = get_post_meta( $post->ID, '_sku', true );
			$variation_skus .= $sku. ' ' ;
		}
		update_post_meta( $post_id, '_variation_sku', $variation_skus );
	}
}
add_action('save_post', 'save_product_variation' );

/*add_action('wp_head','kenyon_ajaxurl1');
function kenyon_ajaxurl1() {

		global $post;
		$args = array(
			'post_type' => array ( 'product' ),
			'posts_per_page' => -1
		);
		$loop2 = new WP_Query( $args);

		while ( $loop2->have_posts() ) {
			$loop2->the_post();
			echo $post_id = $post->ID;

			$args = array(
				'post_parent' => $post_id,
				'post_type' => array ( 'product_variation' ),
				'posts_per_page' => -1
			);
			$the_query = new WP_Query( $args );

			$variation_skus = '';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$sku = get_post_meta( $post->ID, '_sku', true );
				$variation_skus .= $sku. ' ' ;
			}
			update_post_meta( $post_id, '_variation_sku', $variation_skus );


			//die();

		}
}*/


function my_skip_mail($f){
	$submission = WPCF7_Submission::get_instance();
	// get submission data
	$data = $submission->get_posted_data();
	// nothing's here... do nothing...
	if(empty($data)) return;
if($data['_wpcf7']=='14094'){
	if(1==1){
		return true; // DO NOT SEND E-MAIL
	}
 		}else{
		return false; // SEND E-MAIL
	}

}
add_filter('wpcf7_skip_mail','my_skip_mail');

function custom_wpcf7_before_send_mail ($WPCF7_ContactForm) {



	// get current FORM instance
	$WPCF7_ContactForm = WPCF7_ContactForm::get_current();

	// get current SUBMISSION instance
	$submission = WPCF7_Submission::get_instance();

	// get submission data
	$data = $submission->get_posted_data();
	$mailingdata=$WPCF7_ContactForm->get_properties();

	// nothing's here... do nothing...
	if(empty($data)) return;
	$formid = $WPCF7_ContactForm->id;
	if($formid!='14094') return;


	// nothing's here... do nothing...
	if(empty($data)) return;
	// extract posted data
	$name     = isset($data['yourname'])     ? $data['yourname']     : "";
	$email  = isset($data['email'])       ? $data['email']       : "";
	$company    = isset($data['company'])         ? $data['company']         : "";
	$phone  = isset($data['phone'])       ? $data['phone']       : "";
	$zip  = isset($data['zip'])       ? $data['zip']       : "";
	$message  = isset($data['message'])       ? $data['message']       : "";

	$mailbody.="<table><tr><td>You have received a request.\r\n</br></br></td></tr>";
	$mailbody.="<tr><td>Name :". $name."\r\n</br></td></tr>";
	$mailbody.="<tr><td>Email :". $email."\r\n</br></td></tr>";
	$mailbody.="<tr><td>Company :". $company."\r\n</br></td></tr>";
	$mailbody.="<tr><td>Phone :". $phone."\r\n</br></td></tr>";
	$mailbody.="<tr><td>Zip :". $zip."\r\n</br></td></tr>";
	$mailbody.="<tr><td>Message :". $message."\r\n</br></td></tr>";

	$mailbody.="<tr><td><table>";
	$mailbody.="<tr><td colspan=3>Interested products</td></tr>";
	if(count($data['qty'])>0) {
	for($i=0;$i<count($data['qty']);$i++){
		$mailbody.="<tr><td>Qty: ".$data['qty'][$i] ." | </td><td>Modal:".$data['modal'][$i] ."</td><td>Description:".$data['description'][$i] ." </td><tr>";
	}
	}
	$mailbody.="<tr><td><table>";

	$mailbody.="<tr><td><table>";

	// do other stuff here

	$subject=$mailingdata['mail']['subject'];
	$sender=$mailingdata['mail']['sender'];
	$recipients = $mailingdata['mail']['recipient'];

	$headers = "From: ". $name."<".$email."> \r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8 \r\n";

	//if($data['mailme']==1){
		wp_mail( $recipients, $subject, $mailbody, $headers ); //  SEND E-MAIL
	//}

}

add_action("wpcf7_before_send_mail", "custom_wpcf7_before_send_mail");

add_action( 'wp_ajax_nopriv_get_videos_load_more', 'get_videos_load_more' );
add_action( 'wp_ajax_get_videos_load_more', 'get_videos_load_more' );

function get_videos_load_more(){
      $post_count = $_POST ['post_count']; 
		$args = array(
		'post_type'		=> 'video',
		'post_status'   => 'publish',						
        'order' => 'DESC',
		'ignore_sticky_posts' => true,
		'showposts'		=> $post_count		
       ); 
	  $video_list = get_posts($args);
	  $videoCount = wp_count_posts('video')->publish;	  
	  $total_posts = $videoCount;	
   	  $count_of_post = 0;
	if($video_list){
		foreach($video_list as $video):
				$youtubeVideoId  = get_post_meta( $video->ID, 'youtube_video_id', true );
				$videoURL = get_permalink( $video->ID);?>						 
				<div class="thumb">
						<a href="<?php echo $videoURL; ?>">
							<div class="pic">
							<img src="https://i.ytimg.com/vi/<?php echo $youtubeVideoId;?>/mqdefault.jpg"  alt="image" width="120" height="67">
							</div>
							<p><?php echo $video->post_title;?></p>
						</a>
				</div>
    	 <?php $count_of_post++;
	   endforeach;?>
		<input type="hidden" id="pagination" name="pagination" value="<?php echo $post_count+$count_of_post; ?>" />
		<?php } 
		if($count_of_post == $total_posts){?>
				<style>
					.next-page { display:none !important;}
				</style>
		 <?php }else{
		 ?>
				<style>
					.next-page { display:inline !important;}
				</style>
		 <?php 
		 } wp_die();
}

function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
	 <div class="post">
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
	
    <div class="comment-author vcard pic">
         <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment->comment_author_email, $args['avatar_size'] ); ?>
       
    </div>
	 
	 
	 <div class="title">
	 <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
	 <h3><?php echo get_comment_author(); ?></h3>
	 
	 </div>
	
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
	 <p class="info">
        <?php
        /* translators: 1: date, 2: time */
        printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?>
     </p>   
    </div>

    <?php comment_text(); ?>

    
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
	</div>
    <?php endif; ?>
    <?php
    }


/* Add Proposition 65 Alert checkbox in general product data section*/    
add_action( 'woocommerce_product_options_general_product_data', 'proposition_65_alert');
function proposition_65_alert(){
 
	woocommerce_wp_checkbox( array(
		'id'      => 'proposition_65',
		'value'   => get_post_meta( get_the_ID(), 'proposition_65', true ),
		'label'   => 'California Proposition 65?',
		'desc_tip' => true,
		'description' => 'Check this box if you want to display the Proposition 65 alert in the product description.',
	) );
 
}

add_action( 'woocommerce_process_product_meta', 'prop65_save_fields', 10, 2 );
function prop65_save_fields( $id, $post ){
 
	//if( !empty( $_POST['proposition_65'] ) ) {
		update_post_meta( $id, 'proposition_65', $_POST['proposition_65'] );
	//} else {
	//	delete_post_meta( $id, 'proposition_65' );
	//}
 
}
?>