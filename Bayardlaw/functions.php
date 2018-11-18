<?php
/**
 * Bayardlaw functions and definitions
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
 * @subpackage Bayardlaw
 * @since Bayardlaw 1.0
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see bayardlaw_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;


/**
 * Bayardlaw setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Bayardlaw supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Bayardlaw 1.0
 */
function bayardlaw_setup() {
	
	// Add scripts and styles to the header
	function bayardlaw_header_scripts() {
		wp_enqueue_style ( 'Bootstrap-Min', get_template_directory_uri () . '/css/bootstrap.css' );
		wp_enqueue_style ( 'Main-CSS', get_template_directory_uri () . '/css/style.css' );		
	}
	add_action ( 'wp_enqueue_scripts', 'bayardlaw_header_scripts' );
	
	


	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', bayardlaw_fonts_url() ) );


	

	/*
	 * This theme supports all available post formats by default.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'bayardlaw' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'bayardlaw_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Bayardlaw 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function bayardlaw_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'bayardlaw' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'bayardlaw' );

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
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

add_image_size( 'thumb200_200', 200, 200, true );
add_image_size( 'thumb295_295', 295, 295, true );
add_image_size( 'thumb500_667', 500, 667, true );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Bayardlaw 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */


require get_template_directory () . '/inc/bayardlaw_nav_menu_widget.php';
register_widget( 'bayardlaw_Nav_Menu_Widget' );

function bayardlaw_wp_title( $title, $sep ) {
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
		$title = "$title $sep " . sprintf( __( 'Page %s', 'bayardlaw' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'bayardlaw_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Bayardlaw 1.0
 */
function bayardlaw_widgets_init() {
	
	register_sidebar( array(
	'name'          => __( 'Header Menu Area', 'bayardlaw' ),
	'id'            => 'sidebar-3',
	'description'   => __( 'Appears on header of the site.', 'bayardlaw' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name'          => __( 'News Letter', 'bayardlaw' ),
	'id'            => 'news_letter',
	'description'   => __( 'News Letter.', 'bayardlaw' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '',
	) );
	
	register_sidebar( array(
	'name'          => __( 'Footer Menu 1', 'bayardlaw' ),
	'id'            => 'sidebar-4',
	'description'   => __( 'Appears on footer of the site.', 'bayardlaw' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name'          => __( 'Footer Menu 2', 'bayardlaw' ),
	'id'            => 'sidebar-5',
	'description'   => __( 'Appears on footer of the site.', 'bayardlaw' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name'          => __( 'Footer Menu 3', 'bayardlaw' ),
	'id'            => 'sidebar-6',
	'description'   => __( 'Appears on footer of the site.', 'bayardlaw' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name'          => __( 'Footer Social Links', 'bayardlaw' ),
	'id'            => 'sidebar-7',
	'description'   => __( 'Appears on footer of the site.', 'bayardlaw' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name'          => __( 'Footer Address Information', 'bayardlaw' ),
	'id'            => 'sidebar-8',
	'description'   => __( 'Appears on footer of the site.', 'bayardlaw' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name'          => __( 'Footer Copyrights', 'bayardlaw' ),
	'id'            => 'sidebar-9',
	'description'   => __( 'Appears on footer of the site.', 'bayardlaw' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'bayardlaw_widgets_init' );

if ( ! function_exists( 'bayardlaw_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Bayardlaw 1.0
 */
function bayardlaw_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'bayardlaw' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'bayardlaw' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'bayardlaw' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'bayardlaw_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since Bayardlaw 1.0
*/
function bayardlaw_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'bayardlaw' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'bayardlaw' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'bayardlaw' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'bayardlaw_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own bayardlaw_entry_meta() to override in a child theme.
 *
 * @since Bayardlaw 1.0
 */
function bayardlaw_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'bayardlaw' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		bayardlaw_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'bayardlaw' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'bayardlaw' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'bayardlaw' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;


function search_excerpt_highlight() {
	$excerpt = get_the_excerpt();
	$keys = implode('|', explode(' ', get_search_query()));
	$excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);

	echo '<p>' . $excerpt . '</p>';
}

function search_title_highlight() {
	$title = get_the_title();
	$keys = implode('|', explode(' ', get_search_query()));
	$title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $title);

	echo $title;
}

if ( ! function_exists( 'bayardlaw_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own bayardlaw_entry_date() to override in a child theme.
 *
 * @since Bayardlaw 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function bayardlaw_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'bayardlaw' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'bayardlaw' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'bayardlaw_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Bayardlaw 1.0
 */
function bayardlaw_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Bayardlaw 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'bayardlaw_attachment_size', array( 724, 724 ) );
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
 * @since Bayardlaw 1.0
 *
 * @return string The Link format URL.
 */
function bayardlaw_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

if ( ! function_exists( 'bayardlaw_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 * and a Continue reading link.
 *
 * @since Bayardlaw 1.4
 *
 * @param string $more Default Read More excerpt link.
 * @return string Filtered Read More excerpt link.
 */
function bayardlaw_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bayardlaw' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'bayardlaw_excerpt_more' );
endif;

function give_dequeue_plugin_css() {
	wp_dequeue_style('wpfai_style');
	wp_deregister_style('wpfai_style');

}
add_action('wp_enqueue_scripts','give_dequeue_plugin_css', 100);

// Added to extend allowed files types in Media upload 
add_filter('upload_mimes', 'custom_upload_mimes'); 
function custom_upload_mimes ( $existing_mimes=array() ) { 
	// Add *.VCF files to Media upload 
	$existing_mimes['vcf'] = 'text/x-vcard';
	return $existing_mimes;
}


function posts_orderby_lastname ($orderby_statement)
{
	$orderby_statement = "RIGHT(post_title, LOCATE(' ', REVERSE(post_title)) - 1) asc,wp_postmeta.meta_value desc";

	return $orderby_statement;
}


add_filter('admin_init', 'my_general_settings_register_fields');

function my_general_settings_register_fields()
{
	register_setting('general', 'attorney_disclaimer', 'esc_attr');
	add_settings_field('attorney_disclaimer', '<label for="attorney_disclaimer">'.__('Attorney Disclaimer Text' , 'attorney_disclaimer' ).'</label>' , 'my_general_settings_fields_html', 'general');
}

function my_general_settings_fields_html()
{
	$value = get_option( 'attorney_disclaimer', '' );
	echo '<textarea  rows="4" cols="50" id="attorney_disclaimer" name="attorney_disclaimer">' . $value . '</textarea>';
}