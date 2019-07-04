<?php

wp_register_style('theme-admin', get_template_directory_uri() . '/css/admin.css');
wp_enqueue_style('theme-admin');


include( get_template_directory() .'/classes.php' );
include( get_template_directory() .'/widgets.php' );

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

if ( ! isset( $content_width ) ) $content_width = 900;

remove_action('wp_head', 'wp_generator');

add_action( 'after_setup_theme', 'theme_localization' );
function theme_localization () {
	load_theme_textdomain( 'subculture', get_template_directory() . '/languages' );
}


if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'id' => 'default-sidebar',
		'name' => __('Default Sidebar', 'subculture'),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails

    add_image_size( '1925px', 1925, 99999, false );
    add_image_size( 'home-slideshow', 1925, 748, true );
	add_image_size( 'events-thumb-358', 358, 99999, false );
	add_image_size( 'events-thumb-358x151', 358, 151, true );
    add_image_size( 'events-thumb-100', 100, 9999, false );

    //TODO: Maybe need some redesign of About US page to reduce image sizes quantity
    add_image_size( 'about-image-gallery-750x484', 750, 484, true );
    add_image_size( 'about-image-gallery-360x484', 360, 484, true );
    add_image_size( 'about-image-gallery-557x360', 557, 360, true );
    add_image_size( 'about-image-gallery-557x364', 557, 364, true );
    add_image_size( 'about-image-gallery-556x745', 556, 745, true );
    add_image_size( 'about-image-gallery-360x484', 360, 484, true );
    add_image_size( 'about-image-gallery-750x484', 750, 484, true );
	
	add_image_size( 'home-boxes-374x230', 374, 230, true );
	add_image_size( 'events-gallery-683', 683, 99999, false);
	
	add_image_size( 'page-gallery-thumbs-750x456', 750, 456, true );
	add_image_size( 'package-post-thumbs-350x167', 350, 167, true );
	add_image_size( 'package-floorplan-thumbs-454x211', 454, 211, true );

	// Post Thumbnail
	add_image_size( 'post-main-1405x569', 1405, 569, true );
	add_image_size( 'post-thumbs-1108x570', 1108, 570, true );
	add_image_size( 'post-thumbs-848x400', 848, 400, true );
	add_image_size( 'post-thumbs-780x381', 780, 381, true );
	add_image_size( 'post-thumbs-550x535', 550, 535, true );
	add_image_size( 'post-thumbs-263x401', 263, 401, true );
	
}

register_nav_menus( array(
	'top' => __( 'Top', 'subculture' ),
    'bottom' => __( 'Bottom', 'subculture' ),
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
function change_menu_classes($css_classes) {
	$css_classes = str_replace("current-menu-item", "active", $css_classes);
	$css_classes = str_replace("current-menu-parent", "active", $css_classes);
    $css_classes = str_replace("current-menu-ancestor", "active", $css_classes);
    $css_classes = str_replace("menu-item-has-children", "dropdown", $css_classes);

    return $css_classes;
}
add_filter('nav_menu_css_class', 'change_menu_classes');

//Replace standard wp body classes and post classes
function theme_body_class($classes) {
	if (is_array($classes)) {
		foreach ($classes as $key => $class) {
			$classes[$key] = 'body-class-' . $classes[$key];
		}
	}

	return $classes;
}
add_filter('body_class', 'theme_body_class', 9999);

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
	$form .= '<input type="submit" class="adminbar-button" value="' . __('Search', 'subculture') . '"/>';
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
		'title' => 'Theme Options',
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


function theme_wrapper_class($class = null) {
    global $wrapper_class;

    if ($class === null) {
        echo $wrapper_class ? ' class="' . $wrapper_class . '"' : '';
    } else {
        $wrapper_class =  $class;
    }
}

function theme_header_title($title = null) {
    global $header_title;

    if ($title === null) {
        echo $header_title ? $header_title : get_the_title();
    } else {
        $header_title =  $title;
    }
}

function theme_cf7_form_class($class) {
    $class .= ' contact-form';
    return $class;
}
add_filter('wpcf7_form_class_attr', 'theme_cf7_form_class');

function theme_faq_list_categories() {
    $cats = get_terms(array('faq-category'));

    if (!$cats) return;

?>
    <ul>
        <?php foreach ($cats as $cat) : ?>
        <li><a href="#category-<?php echo $cat->slug ?>"><?php echo $cat->name ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php
}

function theme_print_each($count = null, $text = '') {
    static $counter = 0;

    if ($count === null) {
        $counter = 0;
        return;
    }

    if (($counter != 0) && ($counter % $count == 0)) echo $text;

    $counter++;
}

function theme_gallery_image($image, $size) {
?>
    <img src="<?php echo $image['sizes']['about-image-gallery-'.$size] ?>" alt="<?php echo $image['alt'] ?>" width="<?php echo $image['sizes']['about-image-gallery-'.$size.'-width'] ?>" height="<?php echo $image['sizes']['about-image-gallery-'.$size.'-height'] ?>" />
<?php
}


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
        'comment_notes_after'  => '<div class="form-group"><p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <p>' . allowed_tags() . '</p>' ) . '</p></div>',
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
            <h1 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h1>
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

function theme_events_query() {
	query_posts(array(
		'post_type' => 'ts_event',
		'posts_per_page' => -1,
	));
}

//Custom Post Type Lables
$labels = array(
  'name' => _x('Events', 'post type general name'),
  'singular_name' => _x('Events', 'post type singular name'),
  'add_new' => _x('Add New', 'Events'),
  'add_new_item' => __('Add New Events'),
  'edit_item' => __('Edit Events'),
  'new_item' => __('New Events'),
  'view_item' => __('View Events'),
  'search_items' => __('Search Events'),
  'not_found' =>  __('Nothing found'),
  'not_found_in_trash' => __('Nothing found in Trash'),
  'parent_item_colon' => ''
 );

//Custom Post Type Arguments 
 $args = array(
  'labels' => $labels,
  'public' => true,
  'has_archive' => true,
  'publicly_queryable' => true,
  'show_ui' => true,
  'query_var' => true, 
  'rewrite' => true,
  'capability_type' => 'post',
  'hierarchical' => true,
  'menu_position' => null,
  'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields'  )
   ); 

//Register Custom Post Type.   
register_post_type( 'ts_event' , $args );

$labels = array(
    'name' => _x( 'Event Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Event Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Event Categories' ),
    'all_items' => __( 'All Event Categories' ),
    'parent_item' => __( 'Parent Event Category' ),
    'parent_item_colon' => __( 'Parent Event Category:' ),
    'edit_item' => __( 'Edit Event Category' ),
    'update_item' => __( 'Update Event Category' ),
    'add_new_item' => __( 'Add New Event Category' ),
    'new_item_name' => __( 'New Show Name' ),
  ); 	

register_taxonomy('event_categories','ts_event',array(
    'hierarchical' => true,
    'labels' => $labels
  ));
  
//add_filter('cron_schedules', 'new_interval');
function new_interval($interval) {
    $interval['minutes_10'] = array('interval' => 10*60, 'display' => 'Once 10 minutes');
    return $interval;
}

if (!wp_next_scheduled( 'import_events_hook' ) ) {
  wp_schedule_event( time(), 'hourly', 'import_events_hook' );
}

add_action( 'import_events_hook', 'import_events_function' );

function import_events_function() {
  $TicketSocketImport = new classTicketSocketImportPlugin();
  $TicketSocketImport->fetch_events();
}
  
//Custom Excerpt

function get_excerpt($limit, $source = null){
    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = iconv("utf-8", "utf-8//ignore", $excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
    return $excerpt;
}

function theme_customize_tickettypes($code) {
	$find = '|<input\s+[^>]*type=\"submit\"[^>]*>|si';
	$replace = '<button type="submit" class="ticketSocket_formSubmit btn btn-default btn-find">'.__('BUY TICKETS', 'subculture').'</button><div class="clearfix"></div>';
	$code = preg_replace($find, $replace, $code);
	
	return $code;
}

function theme_ts_event_date($format, $timestamp) {
    $event_date = new DateTime();
    $event_date->setTimezone(new DateTimeZone('America/Los_Angeles'));
    $event_date->setTimestamp($timestamp);

	$result = $event_date->format($format);

	return $result;
}

function theme_ts_event_calendar_timestamp_convert($timestamp, $browser_zimezone) {
    $event_date = new DateTime();
    
    $event_date->setTimezone(new DateTimeZone('America/Los_Angeles'));
    $ts_offset = $event_date->getOffset();

    $event_date->setTimezone(new DateTimeZone($browser_zimezone));
    $browser_offset = $event_date->getOffset();

    $event_date->setTimestamp($timestamp);

    $result = $event_date->getTimestamp() + ($ts_offset - $browser_offset);

    return $result;
}


function theme_related_events_build_query() {
/*
	$cats = get_the_terms(get_queried_object_id(), 'event_categories');
	$cat_ids = array();

	if ($cats) {
		foreach ($cats as $event_cat) {
			$cat_ids[] = $event_cat->term_id;
		}
	}

	if (empty($cat_ids)) return;

	$paged = isset($_REQUEST['start']) ? intval($_REQUEST['start']) : 1;

	query_posts(array(
		'posts_per_page' => 3,
		'paged' => $paged,

		'post_type' => 'ts_event',
		'tax_query' => array(
			array(
				'taxonomy' => 'event_categories',
				'field' => 'id',
				'terms' => $cat_ids,
				'operator' => 'IN'
			)
		),
		
		'post__not_in' => array(get_the_ID()),
		
		'meta_key' => '_start',
		'meta_value' => time(), 
		'meta_compare' => '>=',
		
		'orderby' => 'meta_value', 
		'order' => 'ASC',
	));
*/
}


function theme_parse_youtube_id($url) {
    $pattern = '#(?:';                #  Group host alternatives:
    $pattern .=   'youtu\.be/';       #    Either youtu.be,
    $pattern .=   '|youtube\.com';    #    or youtube.com
    $pattern .=   '(?:';              #    Group path alternatives:
    $pattern .=     '/embed/';        #      Either /embed/,
    $pattern .=     '|/v/';           #      or /v/,
    $pattern .=     '|/watch\?v=';    #      or /watch?v=,
    $pattern .=     '|/watch\?.+&v='; #      or /watch?other_param&v=
    $pattern .=   ')';                #    End path alternatives.
    $pattern .= ')';                  #  End host alternatives.
    $pattern .= '([\w-]{11})#x';        # 11 characters (Length of Youtube video ids).
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

//Custom Post Type Lables
$labels = array(
  'name' => _x('Packages', 'post type general name'),
  'singular_name' => _x('Packages', 'post type singular name'),
  'add_new' => _x('Add New', 'Package'),
  'add_new_item' => __('Add New Package'),
  'edit_item' => __('Edit Package'),
  'new_item' => __('New Package'),
  'view_item' => __('View Packages'),
  'search_items' => __('Search Packages'),
  'not_found' =>  __('Nothing found'),
  'not_found_in_trash' => __('Nothing found in Trash'),
  'parent_item_colon' => ''
 );

//Custom Post Type Arguments 
 $args = array(
  'labels' => $labels,
  'public' => true,
  'has_archive' => true,
  'publicly_queryable' => true,
  'show_ui' => true,
  'query_var' => true, 
  'rewrite' => true,
  'capability_type' => 'post',
  'hierarchical' => true,
  'menu_position' => null,
  'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields'  )
   ); 

//Register Custom Post Type.   
register_post_type( 'packages' , $args );



//sef search redirect to fix pagination issue
function theme_sef_search_redirect() {
	if (isset($_REQUEST['s'])) {
		wp_redirect(home_url() . '/search/' . urlencode($_REQUEST['s']), 301);
		die();
	}
}
//add_action('init', 'theme_sef_search_redirect');


//TODO: Need better solution, temporary fix bug #241, need to be removed
function theme_search_pagination_fix($html) {
	$html = str_replace('/?s=', '?s=', $html);
	return $html;
}

// Added For Search Page Ordering 
function my_mod_search($query) {
    if ($query->is_search()) {
		$query->query_vars['meta_key'] = '_start';
		$query->query_vars['meta_value'] = time();
		$query->query_vars['meta_compare'] = '>=';
		$query->query_vars['order'] = 'ASC';
        $query->query_vars['orderby'] = 'meta_value';
	}
}

add_action('parse_query', 'my_mod_search');

function fetch_series(){
	$PROFILE_URL = 'https://secure.subculturenewyork.com';
	$FEED_PATH = '/api/categoryFeed';
		
	$feed = fetch_url($PROFILE_URL . $FEED_PATH);
	
	set_time_limit(0);
	$array = json_decode($feed);

	if (!is_array($array)) return false;
	
	$formattedTypes = array();
			
	if (is_array($array))
	{
		foreach ($array as $category)
		{
			$i = 0;
			if ( strtolower(trim($category->categoryGroup)) == "series" ){
				$i = $i + 1;
				$formattedTypes[] = $category->title;
			}
		}
	}
	return $formattedTypes;
}

function  fetch_url($url) {
	try {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
			
			$result = curl_exec($ch);
			curl_close($ch);
			
			return $result;
		}

		catch (Exception $e) {
			return false;
		}
}

function  fetch_event_tickettypes($eventid) {
	try {
			$ch = curl_init('https://secure.subculturenewyork.com/api/eventFeed/'.$eventid);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
			
			$result = curl_exec($ch);
			curl_close($ch);
			
			$array = json_decode($result);
			if (!is_array($array)) return false;
	
			if (is_array($array))
			{
				foreach ($array as $event)
				{
					return $event->addToCartForm;
				}
			}
			return '';
		}

		catch (Exception $e) {
			return '';
		}
}

function delete_all_between($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if ($beginningPos === false || $endPos === false) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string)); // recursion to ensure all occurrences are replaced
}

add_filter('use_block_editor_for_post', '__return_false');
