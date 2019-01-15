<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package santaenergy-main
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function santaenergy_main_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'santaenergy_main_pingback_header' );


// Custom Image Sizes required for the Theme
add_image_size( 'santa-main-thumb-476-234', 476, 234);
add_image_size( 'santa-main-thumb-609-504', 609, 504);
add_image_size( 'santa-main-thumb-349-180', 349, 180);
add_image_size( 'santa-main-thumb-350-180', 350, 180);
add_image_size( 'santa-main-thumb-350-208', 350, 208);
add_image_size( 'santa-main-thumb-838-677', 838, 677);


// Build a Custom Menu
require get_template_directory () . '/inc/santa_main_nav_menu_widget.php';
	register_widget( 'Santa_Main_Nav_Menu_Widget' );