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
add_image_size( 'santa-main-thumb-100-115', 100, 115);
add_image_size( 'santa-main-thumb-100-125', 100, 125);
add_image_size( 'santa-main-thumb-280-460', 280, 460);
add_image_size( 'santa-main-thumb-349-180', 349, 180);
add_image_size( 'santa-main-thumb-350-180', 350, 180);
add_image_size( 'santa-main-thumb-370-180', 370, 180);
add_image_size( 'santa-main-thumb-350-208', 350, 208);
add_image_size( 'santa-main-thumb-300-300', 300, 300);
add_image_size( 'santa-main-thumb-476-234', 476, 234);
add_image_size( 'santa-main-thumb-609-504', 609, 504);
add_image_size( 'santa-main-thumb-640-960', 640, 960);
add_image_size( 'santa-main-thumb-742-360', 742, 360);
add_image_size( 'santa-main-thumb-774-282', 774, 282);
add_image_size( 'santa-main-thumb-838-677', 838, 677);
add_image_size( 'santa-main-thumb-1177-677', 1177, 460);
add_image_size( 'santa-main-thumb-1439-480', 1439, 480);


// Build a Custom Menu
require get_template_directory () . '/inc/santa_main_nav_menu_widget.php';
	register_widget( 'Santa_Main_Nav_Menu_Widget' );
// Build a Custom Map Section
require get_template_directory () . '/inc/santa_map_widget.php';
	register_widget( 'Santa_Map_Widget' );

/*------- TODO: The gloabal options should come from this section after we remove the X template totally -- ACF Theme Option  --------------*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Option',
		'menu_title'	=> 'Theme Option',
		'menu_slug' 	=> 'theme-option',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Global Settings',
		'menu_title'	=> 'Theme Global Settings',
		'parent_slug'	=> 'theme-global-option',
	));
	
}

add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
    if ( get_post_type() == 'post' ) {
        $classes[] = 'page-template-blog-page';
    }
    return $classes;
}

add_filter( 'widget_text', 'do_shortcode' );

function santa_get_post_tags(){
	$post_tags = get_the_tags();
 
	if ( $post_tags ) {
		echo '<span class="blog-tag">';
			foreach( $post_tags as $tag ) {
				echo $tag->name . '';
				break;
			}
		echo '</span>';
	}
}

function get_latest_post_for_archive(){
    $the_query = new WP_Query( array(
      'posts_per_page' => 1,
   ));
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
	?>
	<article class="blog featured-blog">
      <a href="<?php the_permalink();?>" class="blog-link">
        <div class="blog-pic">
		<?php 
			$banner_desktop_image = get_field('banner_desktop_image');
			$banner_desktop_image_size = 'santa-main-thumb-1177-677';

			$banner_mobile_image = get_field('banner_mobile_image');
			$banner_mobile_image_size = 'santa-main-thumb-280-460';
		?>
          <div class="bg-stretch">
			<?php if( $banner_desktop_image ) {?>
				<span data-srcset="<?php echo $banner_desktop_image['sizes'][ $banner_desktop_image_size ];?>"></span>
			<?php }else{?>
				<span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img03.jpg"></span>
			<?php }?>

			<?php if( $banner_mobile_image ) {?>
				<span data-srcset="<?php echo $banner_mobile_image['sizes'][ $banner_mobile_image_size ];?>" data-media="(max-width: 480px)"></span>
			<?php }else{?>
	            <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img03-m.jpg" data-media="(max-width: 480px)"></span>
			<?php }?>
          </div>
          <?php santa_get_post_tags();?>
        </div>
        <div class="blog-content">
          <h2><?php the_title();?></h2>
          <p><?php echo wp_trim_words( get_the_excerpt(), 50, '...' );?></p>
          <i class="icon-next"></i>
        </div>
      </a>
    </article>
<?php
		endwhile;
	wp_reset_postdata();
endif;
}
