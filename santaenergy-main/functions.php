<?php
/**
 * santaenergy-main functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package santaenergy-main
 */

if ( ! function_exists( 'santaenergy_main_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function santaenergy_main_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on santaenergy-main, use a find and replace
		 * to change 'santaenergy-main' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'santaenergy-main', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		/*register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'santaenergy-main' ),
		) );*/

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'santaenergy_main_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function santaenergy_main_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'santaenergy_main_content_width', 640 );
}
add_action( 'after_setup_theme', 'santaenergy_main_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function santaenergy_main_widgets_init() {
	// Left Sidebar One
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar One', 'santaenergy-main' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '<div class="section-header icon-logo">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	// Left Sidebar Two
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Two', 'santaenergy-main' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '<div class="section-header icon-logo">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	//Top Most Header Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Top Header', 'santaenergy-main' ),
		'id'            => 'header-top',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="hide-element">',
		'after_title'   => '</h2>',
	) );

	//Top Menu Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Header Menu', 'santaenergy-main' ),
		'id'            => 'header-menu',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="hide-element">',
		'after_title'   => '</h2>',
	) );

	//Blog Details Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Details Sidebar', 'santaenergy-main' ),
		'id'            => 'blog-details',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '<div class="blog-sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="sidebar-title">',
		'after_title'   => '</h2>',
	) );

	//Bottom Content
	register_sidebar( array(
		'name'          => esc_html__( 'Bottom Content', 'santaenergy-main' ),
		'id'            => 'bottom-content-1',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

	//Footer Content One
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column One', 'santaenergy-main' ),
		'id'            => 'footer-content-1',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		// 'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_widget' => '',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar-title"><a href="#" class="sidebar-opener"></a><h4 class="footer-title footer-content-1">',
		'after_title'   => '</h4></div><div class="sidebar-content">',
	) );

	//Footer Content Two
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column Two', 'santaenergy-main' ),
		'id'            => 'footer-content-2',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar-title"><a href="#" class="sidebar-opener"></a><h4 class="footer-title footer-content-2">',
		'after_title'   => '</h4></div><div class="sidebar-content">',
	) );

	//Footer Content Three
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column Three', 'santaenergy-main' ),
		'id'            => 'footer-content-3',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar-title"><a href="#" class="sidebar-opener"></a><h4 class="footer-title footer-content-3">',
		'after_title'   => '</h4></div><div class="sidebar-content">',
	) );

	//Footer Content Four
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column Four', 'santaenergy-main' ),
		'id'            => 'footer-content-4',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar-title"><a href="#" class="sidebar-opener"></a><h4 class="footer-title footer-content-4">',
		'after_title'   => '</h4></div><div class="sidebar-content">',
	) );

	//Footer Content Five
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column Five', 'santaenergy-main' ),
		'id'            => 'footer-content-5',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar-title"><a href="#" class="sidebar-opener"></a><h4 class="footer-title footer-content-5">',
		'after_title'   => '</h4></div><div class="sidebar-content">',
	) );

	//Footer Content Six
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column Six', 'santaenergy-main' ),
		'id'            => 'footer-content-6',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar-title"><a href="#" class="sidebar-opener"></a><h4 class="footer-title footer-content-6">',
		'after_title'   => '</h4></div><div class="sidebar-content">',
	) );

	//Footer Copy Right
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Copyright', 'santaenergy-main' ),
		'id'            => 'footer-content-7',
		'description'   => esc_html__( 'Add widgets here.', 'santaenergy-main' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="hide-element">',
		'after_title'   => '</h4></div>',
	) );

}
add_action( 'widgets_init', 'santaenergy_main_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function santaenergy_main_scripts() {
	wp_enqueue_style( 'santaenergy-main-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'santaenergy_main_scripts' );

function remove_revslider_meta_tag() { return''; }
add_filter( 'revslider_meta_generator', 'remove_revslider_meta_tag' );

//show_admin_bar(false);

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Function to remove empty Paragraph tags
function remove_empty_p($content){
    $content = force_balance_tags($content);
    return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}
