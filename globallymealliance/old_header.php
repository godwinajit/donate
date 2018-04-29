<?php /** * The Header template for our theme * * Displays all of the <head> section and everything up till
<div id="main">
    * * @package WordPress * @subpackage Twenty_Thirteen * @since Twenty Thirteen 1.0 */ ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>

<?php
	if(is_post_type_archive('events') && !is_day() && !is_month() && !is_year()){
		echo "Upcoming Events";	
	}else{
		wp_title( '|', true, 'right' );
	}
  ?>
</title>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css" />

<?php 
//template add css for home page
function wpse_enqueue_page_template_styles() {
    if ( is_page_template( 'templates/new-front-page-template.php' ) ) {
        wp_enqueue_style( 'page-template', get_template_directory_uri() . '/css/main.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_page_template_styles' );
?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/fonts.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.selectbox.css">


<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/responsive.css" />
<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-70990108-1', 'globallymealliance.org');
	  ga('send', 'pageview');
	</script>
</head>
<body <?php if ((is_page_template( 'templates/new-front-page-template.php' ))) {
    }
     else {

      body_class(); 

    }         
  ?>>
<div id="page" class="site">
<div id="site-loader"></div>
<header id="masthead" class="site-header" role="banner">

 <div class="header-top">
  <div class="main cf">

   <?php $logo= get_field( 'logo', 'option'); if($logo){ ?>
   <div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Appeal To Heaven"><img src="<?php echo $logo['url']; ?>" alt="Global Lyme Alliance" title="Global Lyme Alliance" /></a></div>
   <?php } ?>
   <div class="pull-right">
    <div class="social-donate cf">
     <div class="top-social">
      <ul class="cf">
       <?php $facebook_link= get_field( 'facebook_link', 'option'); $twitter_link= get_field( 'twitter_link', 'option'); $instagram_link= get_field( 'instagram_link', 'option'); $youtube_link= get_field( 'youtube_link', 'option'); $google_plus= get_field( 'google_plus', 'option'); $pinterest_link= get_field( 'pinterest_link', 'option'); if($facebook_link){echo '<li> <a href="'.$facebook_link. '" title="Facebook" target="_blank" rel="nofollow" class="fa fa-facebook"><span class="nodisplay">facebook</span></a></li>';} if($twitter_link){echo '<li> <a href="'.$twitter_link. '" title="Twitter" target="_blank" rel="nofollow" class="fa fa-twitter"><span class="nodisplay">twitter</span></a></li>';} if($instagram_link){echo '<li> <a href="'.$instagram_link. '" title="Instagram" target="_blank" rel="nofollow" class="fa fa-instagram"><span class="nodisplay">instagram</span></a></li>';} if($youtube_link){echo '<li> <a href="'.$youtube_link. '" title="You Tube" target="_blank" rel="nofollow" class="fa fa-youtube"><span class="nodisplay">youtube</span></a></li>';} if($google_plus){echo '<li> <a href="'.$google_plus. '" title="Google Plus" target="_blank" rel="nofollow" class="fa fa-google-plus"><span class="nodisplay">Google Plus</span></a></li>';} if($pinterest_link){echo '<li class="pinterest-p"> <a href="'.$pinterest_link. '" title="Pinterest" target="_blank" rel="nofollow" class="fa fa-pinterest"><span class="nodisplay">pinterest</span></a></li>';} ?>
      </ul>
     </div>
     <?php $donate_now_link= get_field( 'donate_now_link', 'option'); if($donate_now_link){echo '<div class="donate-now"><a href="'.$donate_now_link. '" title="Donate Now">Donate Now</a></div>';} ?>
    </div>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
     <label> <span class="screen-reader-text">Search for:</span>
      <input type="search" class="search-field" placeholder="SEARCH" value="" name="s" title="Search for:">
     </label>
     <input type="submit" class="search-submit" value="Search">
    </form>
   </div>
  </div>
 </div>
 <div class="header-bottom">
  <div class="main cf">
   <form role="search" method="get" class="search-form search-form-mob" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label> <span class="screen-reader-text">Search for:</span>
     <input type="search" class="search-field" placeholder="SEARCH" value="" name="s" title="Search for:">
    </label>
    <input type="submit" class="search-submit" value="Search">
   </form>
   <nav id="site-navigation" class="top-navigation" role="navigation">
    <?php wp_nav_menu( array( 'theme_location'=> 'primary', 'container'=> false, 'menu_class' => 'enumenu_ul cf' ) ); ?>
   </nav>
  </div>
 </div>
</header>
