<?php

//wp_set_password( 'changepond', 2 );

//echo "test"; die;
function mindtrustlabs_setup(){
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'mindtrustlabs_setup' );
// Add scripts and styles to the header
function mindtrustlabs_header_scripts() {
	wp_enqueue_style ('Font','http://fonts.googleapis.com/css?family=Lato:400,900,700%7CRoboto+Slab:400,300,100%7COpen+Sans:400,300italic,300,400italic,600');
	wp_enqueue_style ( 'Bootstrap-Min', get_template_directory_uri () . '/css/bootstrap.css' );
	wp_enqueue_style ( 'Fancy-CSS', get_template_directory_uri () . '/css/fancybox.css' );
	wp_enqueue_style ( 'Main-CSS', get_template_directory_uri () . '/css/all.css' );
	wp_enqueue_style ( 'JSF-CSS', get_template_directory_uri () . '/css/jsf.css' );
	wp_enqueue_style ( 'Slier-CSS', get_template_directory_uri () . '/css/style_slider.css' );
	
	
}
add_action ( 'wp_enqueue_scripts', 'mindtrustlabs_header_scripts' );


// Add scripts to wp_footer()
function mindtrustlabs_footer_script() {
	wp_enqueue_script ( 'jquery min','http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' );
	wp_enqueue_script ( 'Bootstrap Min JS main','https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' );
	wp_enqueue_script ( 'jquery main', get_template_directory_uri () . '/js/jquery.main.js' );
	wp_enqueue_script ( 'jquery masony', get_template_directory_uri () . '/js/masonry.pkgd.min.js' );
	wp_enqueue_script ( 'Player min', get_template_directory_uri () .'/js/mediaelement-and-player.min.js' );

}
add_action ( 'wp_footer','mindtrustlabs_footer_script' );



// Register widget areas.
function mindtrustlabs_widgets_init() {
	require get_template_directory () . '/inc/ab_nav_menu_widget.php';
	register_widget( 'AB_Nav_Menu_Widget' );
	

	
	register_sidebar ( array (
			'name' => __ ( 'TopMenu Section', 'mindtrustlabs' ),
			'id' => 'sidebar-topmenu',
			'description' => __ ( 'TopMenu  area.', 'mindtrustlabs' ),
			'before_widget' => '',
			'after_widget' => ''
	) );
	
	register_sidebar ( array (
				'name' => __ ( 'FooterMenu Section', 'mindtrustlabs' ),
				'id' => 'sidebar-bottommenu',
				'description' => __ ( 'FooterMenu  area.', 'mindtrustlabs' ),
				'before_widget' => '',
				'after_widget' => ''
	) );
	register_sidebar ( array (
					'name' => __ ( 'career Section', 'mindtrustlabs' ),
					'id' => 'sidebar-career',
					'description' => __ ( 'career  area.', 'mindtrustlabs' ),
					'before_widget' => '',
					'after_widget' => ''
	) );
	
	register_sidebar ( array (
						'name' => __ ( 'Twitter Section', 'mindtrustlabs' ),
						'id' => 'sidebar-twitter',
						'description' => __ ( 'twitter  area.', 'mindtrustlabs' ),
						'before_widget' => '',
						'after_widget' => ''
	) );
}
add_action('widgets_init', 'mindtrustlabs_widgets_init' );

function mindtrustlabs_register_theme_customizer( $wp_customize ) {
	$wp_customize->add_section( 'mindtrustlabs_copyright_section' , array('title'=> __( 'Copyright', 'mindtrustlabs' ),'priority'   => 30,) );
	$wp_customize->add_setting('mindtrustlabs_text',array('default'=> ''));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'text',array('label'=> __( 'Copyright Text', 'mindtrustlabs' ),'section'=> 'mindtrustlabs_copyright_section','settings'=> 'mindtrustlabs_text')));
}
add_action( 'customize_register', 'mindtrustlabs_register_theme_customizer' );

function remove_widget_title($title) {
	if($title != '' && strpos($title,'{NOTITLE}') !== false){
		$title = "";
	}
	return $title;
}
add_filter('widget_title', 'remove_widget_title');

function mindtrustlabs_myextensionTinyMCE($init) {
	// Command separated string of extended elements
	$ext = 'span[id|name|class|style]';

	// Add to extended_valid_elements if it alreay exists
	if ( isset( $init['extended_valid_elements'] ) ) {
		$init['extended_valid_elements'] .= ',' . $ext;
	} else {
		$init['extended_valid_elements'] = $ext;
	}

	// Super important: return $init!
	return $init;
}
add_filter('tiny_mce_before_init', 'mindtrustlabs_myextensionTinyMCE' );

//remove_filter ('acf_the_content', 'wpautop');

function mindtrustlabs_remove_empty_p( $content ){
	// clean up p tags around block elements
	$content = preg_replace( array(
		'#<p>\s*<(div|aside|section|article|header|footer)#',
		'#</(div|aside|section|article|header|footer)>\s*</p>#',
		'#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
		'#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
		'#<p>\s*</(div|aside|section|article|header|footer)#',
	), array(
		'<$1',
		'</$1>',
		'</$1>',
		'<$1$2>',
		'</$1',
	), $content );

	return preg_replace('#<p>(\s|&nbsp;)*+(<br\s*/*>)*(\s|&nbsp;)*</p>#i', '', $content);
}
//add_filter( 'acf_the_content', 'mindtrustlabs_remove_empty_p', 20, 1 );
//add_filter( 'the_content', 'mindtrustlabs_remove_empty_p');


function add_styles()
{

}
add_action('wp_head', 'add_styles');function add_script()
{
	
	if ( wp_is_mobile() ) {
		
	?>
 <script>
 jQuery( "div .video-box" ).last().addClass( "hidden-xs" );   
</script>
<?php
	}
}
add_action('wp_head', 'add_script');?>