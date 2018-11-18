<?php
/**
 * Twenty Thirteen functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development
 * and https://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Add support for a custom header image.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Twenty Thirteen setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentythirteen_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		$fonts_url = '';
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	//wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.03' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );

	// Loads the Internet Explorer specific stylesheet.
	//wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Social Footer Section',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

	register_sidebar( array(
		'name' => 'Footer Contact Section',
		'id' => 'footer-sidebar-2',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

	register_sidebar( array(
		'name' => 'Footer Logo Section',
		'id' => 'footer-sidebar-3',
		'description' => 'Appears in the footer area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
	
	require get_template_directory () . '/includes/gla_nav_menu_widget.php';
	register_widget( 'GLA_Nav_Menu_Widget' );
	
	register_sidebar ( array (
			'name' => __ ( 'Header Main Menu', 'twentythirteen' ),
			'id' => 'sidebar-mainmenu',
			'description' => __ ( 'Header Main Menu.', 'twentythirteen' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title'  => '',
			'after_title'   => ''
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*/
function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Twenty thirteen 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

if ( ! function_exists( 'twentythirteen_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 * and a Continue reading link.
 *
 * @since Twenty Thirteen 1.4
 *
 * @param string $more Default Read More excerpt link.
 * @return string Filtered Read More excerpt link.
 */
function twentythirteen_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentythirteen_excerpt_more' );
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';
		
	if ( is_single()  )
		$classes[] = 'single-post';	
		

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20141120', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );

/*------- ACF Theme Option  --------------*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Option',
		'menu_title'	=> 'Theme Option',
		'menu_slug' 	=> 'theme-option',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-option',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-option',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Sidebar Settings',
		'menu_title'	=> 'Sidebar',
		'parent_slug'	=> 'theme-option',
	));
	
}

/******** Excerpt Length **********/
function custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/************** Read More Text ******************/
function new_excerpt_more( $more ) {
	$redirect_url = get_post_meta(get_the_ID(), 'redirect_url', true);
	if(is_home() && !is_singular('grantees')){
		if($redirect_url){
			return ' ...<a class="blog-read-more" href="' . $redirect_url . '" target="_blank" title="Read More">' . __( 'More', 'your-text-domain' ) . '</a>';
		}else{
			return ' ...<a class="blog-read-more" href="' . get_permalink( get_the_ID() ) . '" title="Read More">' . __( 'More', 'your-text-domain' ) . '</a>';
		}
	}else{
		if($redirect_url){
			return ' ...<a class="read-more" href="' . $redirect_url . '" target="_blank" title="Read More">' . __( 'MORE', 'your-text-domain' ) . '</a>';
		}else{
			return ' ...<a class="read-more" href="' . get_permalink( get_the_ID() ) . '" title="Read More">' . __( 'MORE', 'your-text-domain' ) . '</a>';
		}
	}
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

if (function_exists('st_makeEntries')){
add_shortcode('sharethis', 'st_makeEntries');
}

/*********** Twitter Sidebar *********/

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Twitter Sidebar',
		'id' => 'twitter-sidebar',
		'description' => 'twitter sidebar',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
}
add_filter('latest_tweets_cache_seconds', function( $ttl ){
    return 0;
}, 10, 1 );

//New Twitter Widget for Home Page
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Twitter Home Page',
		'id' => 'twitter-home',
		'description' => 'Appears as on Home Page (twitter homepage section)',
		'before_widget' => '<div class="news-box news-box-blue md-visible">',
		'after_widget' => '</div>',
		'before_title' => '<span class="text-holder"><span class="icon icon-twitter"></span><span class="title">',
		'after_title' => '</span>',
	));
}
add_filter('latest_tweets_cache_seconds', function( $ttl ){
    return 0;
}, 1, 1 );

/************ Admin Logo *******/

function my_login_logo() { ?>
<style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/global-lyme-alliance-logo.png);
	      background-size: 310px auto;
      width: auto;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


/*******  Add Custom Sidebar ********/

function custom_widget() {
	register_sidebar( array(
		'name'          => __( 'Global Alliance Sidebar', 'twentythirteen' ),
		'id'            => 'ga-sidebar',
		'description'   => __( 'Appears in the Sidebar section of the site.', 'twentythirteen' ),
		'before_widget' => '<div class="aside-get-involved">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="asideget-involved-title">',
		'after_title'   => '</div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Single Blog Sidebar', 'twentythirteen' ),
		'id'            => 'single-blog-sidebar',
		'description'   => __( 'Appears in the Sidebar section for Blog Post of the site.', 'twentythirteen' ),
		'before_widget' => '<div class="aside-single-blog">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="asideget-single-blog-title">',
		'after_title'   => '</div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Blog Video Sidebar', 'twentythirteen' ),
		'id'            => 'blogvideo-sidebar',
		'description'   => __( 'Appears in the Blog and Video Sidebar section of the site.', 'twentythirteen' ),
		'before_widget' => '<div class="common-aside-block %1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="common-aside-title">',
		'after_title'   => '</div>',
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'About Our Grants', 'twentythirteen' ),
		'id'            => 'aboutgrant-sidebar',
		'description'   => __( 'Appears in the About Our Grants Sidebar section of the site.', 'twentythirteen' ),
		'before_widget' => '<div class="aside-widget-text">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="aside-widget-text-title">',
		'after_title'   => '</div>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Sidebar Bucket', 'twentythirteen' ),
		'id'            => 'bucket-sidebar',
		'description'   => __( 'Appears in the Sidebar section of the site.', 'twentythirteen' ),
		'before_widget' => '<div class="bucket-widget-text">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bucket-widget-title-height"><div class="dis-table"><div class="bucket-widget-text-title">',
		'after_title'   => '</div></div></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Events Sidebar', 'twentythirteen' ),
		'id'            => 'ga-events-sidebar',
		'description'   => __( 'Appears in the Events Sidebar section of the site.', 'twentythirteen' ),
		'before_widget' => '<div class="aside-ga-events-sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="asideget-ga-events-sidebar-title">',
		'after_title'   => '</div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Blog Details Sidebar', 'twentythirteen' ),
		'id'            => 'blog-details-sidebar',
		'description'   => __( 'Appears in the Sidebar section of the site.', 'twentythirteen' ),
		'before_widget' => '<div class="blog-details-widget-text">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bucket-widget-title-height"><div class="dis-table"><div class="bucket-widget-text-title">',
		'after_title'   => '</div></div></div>',
	) );

}
add_action( 'widgets_init', 'custom_widget' );

/*------ For all Custom Shortcodes ------*/
require get_template_directory() . '/includes/CustomShortCode.php';

add_image_size( 'category-thumb', '206', '183', true );

/********* Apply formatting to get_the_content() ************/
function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

/******** Add Class in body ****************/
add_filter( 'body_class', 'my_class_names' );
function my_class_names( $classes ) {
	// add 'class-name' to the $classes array
	global $post;
	$slug = get_post( $post )->post_name;
	$classes[] = $slug;
	// return the $classes array
	return $classes;
}

/********* Add Custom Post types to blog page *********/
/*add_filter( 'pre_get_posts', 'my_get_posts' );
function my_get_posts( $query ) {

	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'events') );

	return $query;
}*/

add_image_size( 'blog-list-thumb', 304, 304, array( 'center', 'top' ) );
add_image_size( 'home-blog-list-thumb', 368, 216, array( 'left', 'top' ) );
add_image_size( 'blog-list-detail', 304, 700, array( 'center', 'top' ) );
add_image_size( 'grantees-thumb', 204, 204, array( 'center', 'center' ) );
add_image_size( 'banner-top', 1564, 475, array( 'center', 'center' ) );


/********** Archive post type redirect  **************/
add_action('init', 'event_archive_rewrite');
function event_archive_rewrite(){
   add_rewrite_rule('^events/([0-9]{4})/([0-9]{2})/?','index.php?post_type=events&year=$matches[1]&monthnum=$matches[2]','top');
   add_rewrite_rule('^events/([0-9]{4})/?','index.php?post_type=events&year=$matches[1]','top');
}

add_action('init', 'press_releases_archive_rewrite');
function press_releases_archive_rewrite(){
	add_rewrite_rule('^press-releases/([0-9]{4})/?','index.php?post_type=press_releases&year=$matches[1]','top');
}

add_action('init', 'news_archive_rewrite');
function news_archive_rewrite(){
	add_rewrite_rule('^news/([0-9]{4})/?','index.php?post_type=news&year=$matches[1]','top');
}

add_action('init', 'newsletters_archive_rewrite');
function newsletters_archive_rewrite(){
	add_rewrite_rule('^newsletters/([0-9]{4})/?','index.php?post_type=newsletters&year=$matches[1]','top');
}

add_action('init', 'videos_archive_rewrite');
function videos_archive_rewrite(){
	add_rewrite_rule('^videos/([0-9]{4})/?','index.php?post_type=videos&year=$matches[1]','top');
}

add_filter('comment_post_redirect', 'redirect_after_comment');
function redirect_after_comment($location)
{
return $_SERVER["HTTP_REFERER"];
}

/************ Change Comment box placeholder *************/
add_filter('comment_form_field_comment','my_update_comment_field');
function my_update_comment_field($comment_field) {
	$comment_field = '<p class="comment-form-comment"><textarea id="comment" required="required" placeholder="Join the discussion..." aria-required="true" name="comment"></textarea></p>';
	return $comment_field; 
}

//get_archive by category
function get_all_post_archive_category($atts)
{
  $args = array(
		'type'                     => 'post',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'name', 
		'order'                    => 'ASC',
		'hide_empty'               => 1,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => $atts['id'],
		'number'                   => '',
		'taxonomy'                 => 'category',
		'pad_counts'               => false 
	
	); 
	$categories = get_categories( $args );
	if(!empty($categories))
	{
		
		foreach($categories as $categoriesls)
		{
				
				
				echo'<div class="common-aside-block">
				<div class="common-aside-title">'.$categoriesls->name.'</div>';
				get_category_year($categoriesls);
				echo '</div>';
		}
	}	
}

function get_category_year($cateinfo)
{	
	query_posts( array ( 'category_name' => $cateinfo->name, 'posts_per_page' => -1 ) );
		 $catname;
				while ( have_posts() ) : the_post();
					$catname[] = get_the_date('Y');
				endwhile; 
			
			wp_reset_query();
			 $catname = array_unique($catname);
			if(!empty($catname))
			{
				echo '<ul id="'.$cateinfo->slug.'">';
				foreach($catname as $catnamenm)
			{
				
			echo '<li'.$cateinfo->slug.'"><a href="'.get_site_url().'/'.$catnamenm.'/?category='.$cateinfo->name.'">'.$catnamenm.'</a></li>';	
			$count++;
			}
			echo '</ul>';		 
		}
}

add_shortcode('archive_category','get_all_post_archive_category');

//***************hide editor on specific page***********************/
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
  // Get the Post ID.
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;
  // Hide the editor on the page titled 'Homepage'
      $homepgname = get_the_title($post_id);
	  if($homepgname == 'Past Events' || $homepgname == 'Upcoming Events'  ){ 
		remove_post_type_support('page', 'editor');
	  }
	  $template_file = get_post_meta($post_id, '_wp_page_template', true);
	  if($template_file == 'past-event-template.php' || $template_file == 'upcoming-page-template'){ // the filename of the page template
		remove_post_type_support('page', 'editor');
	  }
}
// *******************************************************************************************/

add_action('template_redirect', 'register_a_user');
function register_a_user(){
 
  if(isset($_GET['do']) && $_GET['do'] == 'register'):
    $errors = array();
    if(empty($_POST['user']) || empty($_POST['email'])) $errors[] = 'Please enter a user name and e-mail.';
 
    $user_login = esc_attr($_POST['user']);
    $user_email = esc_attr($_POST['email']);
 
    $sanitized_user_login = sanitize_user($user_login);
    $user_email = apply_filters('user_registration_email', $user_email);
 
    if(!is_email($user_email)) $errors[] = 'Invalid e-mail.';
    elseif(email_exists($user_email)) $errors[] = 'This email is already registered.';
 
    if(empty($sanitized_user_login) || !validate_username($user_login)) $errors[] = 'Invalid user name.';
    elseif(username_exists($sanitized_user_login)) $errors[] = 'User name already exists.';
 
    if(empty($errors)):
      $user_pass = wp_generate_password();
      $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);
 
      if(!$user_id):
        $errors[] = 'Registration failed';
      else:
        update_user_option($user_id, 'default_password_nag', true, true);
        wp_new_user_notification($user_id, $user_pass);
      endif;
    endif;
 
    if(!empty($errors)) define('REGISTRATION_ERROR', serialize($errors));
    else define('REGISTERED_A_USER', $user_email);
  endif;
}
add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( home_url('/registration') );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
 }
}

add_filter('default_page_template_title', function() {
    return __('Basic Template', 'your_text_domain');
});

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
// custom sharethis shortcode
if (function_exists('st_makeEntries')){
add_shortcode('sharethis', 'st_makeEntries');
}

// add Gravity Forms support to hide field labels on a field by field basis
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

//new top and footer menus
function register_my_menus() {
  register_nav_menus(
    array(
      'footer-menu-1' => __( 'Footer Menu 1' ),
      'footer-menu-2' => __( 'Footer Menu 2' ),
      'side-menu' => __( 'Side Menu' ),
      'top-menu' => __( 'Top Menu' ),
      'blog-menu' => __( 'Blog Menu' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );


//Add menu descriptions
function prefix_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<p class="menu-item-description">' . $item->description . '</p>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );

//Go to template to update main menu 
require_once('yamm-nav-walker.php');


//Actions for Search Query
add_action('wp_ajax_nopriv_dhemy_ajax_search','dhemy_ajax_search');
add_action('wp_ajax_dhemy_ajax_search','dhemy_ajax_search');
 
function dhemy_ajax_search(){

// creating a search query
$args = array(
	//'post_type', array( 'page', 'any', 'videos', 'post', 'press_releases', 'news', 'events', 'newsletters'),
	//'order' => 'DESC',
	//'orderby' => 'date',
	'post_status' => 'publish',
	's' =>$_POST['term'],
	'posts_per_page' =>5
	);
 
	$query = new WP_Query( $args );
	// display results
	//need to display pages and post with the most number of keywords in post.
	if($query->have_posts()){
		while ($query->have_posts()) {
			$query->the_post();
			$key = wp_specialchars($s, 1); 
			?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php
			}
		} 

		else {
		?>
			<li><a href="#">Please try again, no results were found...</a></li>
		<?php
		}
	exit;
	}

/* Menu Slug */
add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );

function add_current_nav_class($classes, $item) {
	
	// Getting the current post details
	global $post;

        // check if it's a post
        if (empty($post)) {
             return $classes;
        }	

	// Getting the post type of the current post
	$current_post_type = get_post_type_object(get_post_type($post->ID));
	$current_post_type_slug = $current_post_type->rewrite['slug'];
		
	// Getting the URL of the menu item
	$menu_slug = strtolower(trim($item->url));
	
	// If the menu item URL contains the current post types slug add the current-menu-item class
	if (strpos($menu_slug,$current_post_type_slug) !== false) {
	
	   $classes[] = 'active';
	
	} else {
		
		$classes = array_diff( $classes, array( 'current_page_parent' ) );
	}
	
	// Return the corrected set of classes to be added to the menu item
	return $classes;

}

//Archives, Search Yearly Menu
add_filter( "get_archives_link", "customarchives_link");
 
function customarchives_link( $x )
{
	$url = preg_match('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.-]*(\?\S+)?)?)?)@i', $x, $matches);
	
	return $matches[4] == $_SERVER['REQUEST_URI'] ? preg_replace('@<li"@', '<li"', $x) : $x;
}

///Featured Post Checkbox
function sm_custom_meta_post() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback_post', 'post' );
}
function sm_meta_callback_post( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
	<p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Feature this post', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta_post' );

///Featured News Post Checkbox
function sm_custom_meta_news() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback_news', 'News' );
}
function sm_meta_callback_news( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
	<p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Feature this post', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta_news' );

///Featured Newsletters Post Checkbox
function sm_custom_meta_newsletters() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback_newsletters', 'Newsletters' );
}
function sm_meta_callback_newsletters( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
	<p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Feature this post', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta_newsletters' );

///Featured Videos Post Checkbox
function sm_custom_meta_videos() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback_newsletters', 'Videos' );
}
function sm_meta_callback_videos( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
	<p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Feature this post', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta_videos' );

///Featured Press Releases Post Checkbox
function sm_custom_meta_press() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback_press', 'press_releases' );
}
function sm_meta_callback_press( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
	<p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Feature this post', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta_press' );

/**
 * Saves the custom meta input
 */
function sm_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
 // Checks for input and saves
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}
 
}
add_action( 'save_post', 'sm_meta_save' );

function wpfeatured_filter_post_class( $classes ) {
    global $post;
    if ( 'yes' == get_post_meta( $post->ID, 'meta-checkbox', true ) ) {
        $classes[] = 'featured-poster';
    }
    return $classes;
}
add_filter( 'post_class', 'wpfeatured_filter_post_class' );


add_action( 'pre_get_posts', 'sk_query_offset', 1 );
function sk_query_offset( &$query ) {

	$postListArr = array('news', 'videos', 'press_releases', 'newsletters');

	$restrictPostList = false;

	if ( in_array($query->query['post_type'], $postListArr) ) {
		$restrictPostList = true;
	}

	if ( $query->query['pagename'] == "blog" ) {
		$restrictPostList = true;
	}

	if(!$restrictPostList) return;

	// Before anything else, make sure this is the right query...
	if ( ! ( $query->is_home() || is_main_query()) || is_admin()) {
		return;
	}

	// First, define your desired offset...
	$offset = +0;

	// Next, determine how many posts per page you want (we'll use WordPress's settings)
	$ppp = get_option( 'posts_per_page' );

	// Next, detect and handle pagination...
	if ( $query->is_paged ) {

		// Manually determine page query offset (offset + current page (minus one) x posts per page)
		$page_offset = $offset + ( ( $query->query_vars['paged']-1 ) * $ppp );

		// Apply adjust page offset
		$query->set( 'offset', $page_offset );

	}
	else {

		// This is the first page. Set a different number for posts per page
		$query->set( 'posts_per_page', $offset + $ppp );

	}
}

add_filter( 'found_posts', 'sk_adjust_offset_pagination', 1, 2 );
function sk_adjust_offset_pagination( $found_posts, $query ) {

if ($query->query['post_type'] == 'tribe_events'){
	return $found_posts;
}

// Before anything else, make sure this is the right query...
	if ( is_admin() ) {
		return $found_posts;
	}


	// Define our offset again...
	$offset = +1;

	// Ensure we're modifying the right query object...
	if ( $query->is_home() && is_main_query() ) {
		// Reduce WordPress's found_posts count by the offset...
		return $found_posts - $offset;
	}
	return $found_posts;
}

add_action( 'gform_after_submission_9', 'down_free_res_after_submission', 10, 2 );
function down_free_res_after_submission( $entry, $form ) {
	$cookie_name = "download-free-resources";
	$cookie_value = "true";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}

add_filter( 'gform_validation_message_9', 'down_free_res_change_message', 10, 2 );
function down_free_res_change_message( $message, $form ) {
    return '<div class="gform_validation_error">Please enter all required fields.</div><br>';
}

add_action( 'gform_after_submission_13', 'digital_education_form_after_submission', 10, 2 );
function digital_education_form_after_submission( $entry, $form ) {
	$cookie_name = "digital-education";
	$cookie_value = "true";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}

add_filter( 'gform_validation_message_13', 'digital_education_form_change_message', 10, 2 );
function digital_education_form_change_message( $message, $form ) {
    return '<div class="gform_validation_error">Please enter all required fields.</div><br>';
}

add_action( 'gform_after_submission_11', 'download_tea_stud_res_after_submission', 10, 2 );
function download_tea_stud_res_after_submission( $entry, $form ) {
	$cookie_name = "download-teacher-student-resources";
	$cookie_value = "true";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}

add_filter( 'gform_validation_message_11', 'download_tea_stud_res__change_message', 10, 2 );
function download_tea_stud_res__change_message( $message, $form ) {
    return '<div class="gform_validation_error">Please enter all required fields.</div><br>';
}

add_action( 'gform_after_submission_12', 'view_videos_after_submission', 10, 2 );
function view_videos_after_submission( $entry, $form ) {
	$cookie_name = "fundamentals-lyme-disease-awareness-prevention";
	$cookie_value = "true";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}

add_filter( 'gform_validation_message_12', 'view_videos__change_message', 10, 2 );
function view_videos__change_message( $message, $form ) {
    return '<div class="gform_validation_error">Please enter all required fields.</div><br>';
}

add_filter( 'gform_validation_message_16', 'nyc_marathon__change_message', 10, 2 );
function nyc_marathon__change_message( $message, $form ) {
    return '<div class="gform_validation_error">Please enter all the fields.</div><br>';
}

add_filter( 'tribe-events-bar-filters',  'setup_my_field_in_bar', 1, 1 );
 
function setup_my_field_in_bar( $filters ) {
	
	
	$termsTribeEvents = get_terms( array(
		'taxonomy' => TribeEvents::TAXONOMY,
	    'hide_empty' => true,
	) );

	$tributeEventsCatHTML = '<select name="tribe-bar-dcategory" id="tribe-bar-dcategory" class="postform">';
	$tributeEventsCatHTML .= '<option class="level-0" value="">Select One</option>';

	foreach ($termsTribeEvents as $termsTribeEvent){
		$tributeEventsCatHTML .= '<option class="level-0" value="'.$termsTribeEvent->term_taxonomy_id.'">'.$termsTribeEvent->name.'</option>';
	}
	$tributeEventsCatHTML .= '</select>';


    $filters['tribe-bar-dcategory'] = array(
        'name' => 'tribe-bar-dcategory',
        'caption' => 'Select Category',
        'html' => $tributeEventsCatHTML );
	ksort($filters);
 
    return $filters;
}

add_filter( 'tribe_events_pre_get_posts', 'setup_my_category_field_in_query', 10, 1 );
 
function setup_my_category_field_in_query( $query ){
	if ( ! $query->tribe_is_event ) {
		// don�t add the query args to other queries besides events queries
		return;
	}

    if ( !empty( $_REQUEST['tribe-bar-dcategory'] && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		$taxquery = array(
        array(
          'taxonomy' => TribeEvents::TAXONOMY,
          'field'    => 'id',
          'terms'    => array( $_REQUEST['tribe-bar-dcategory'] ),
          'operator' => 'IN'
        )
      );
    $query->set( 'tax_query', $taxquery );
    }
    return $query;
}

/*------ For Gravity From DP submissions ------*/
require get_template_directory() . '/includes/DP_Submission.php';