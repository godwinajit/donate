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
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="viewport"
  content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700"
  rel="stylesheet">
<link
  href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700"
  rel="stylesheet">
<title>Global Lyme Alliance</title>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-70990108-1', 'globallymealliance.org');
	  ga('send', 'pageview');
	</script>

  <!--styles -->
<link rel="stylesheet" href="/donate/dist/css/main.css">
	<script src="/donate/dist/js/donate.js"></script>
<link rel="stylesheet" href="/donate/app/css/donate.css">
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WP2T4DN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


  <div class="page">
    <header class="header">
      <div class="wrapper container-fluid">
        <div class="row center-xs">
          <div class="col-xs-11 col-lg-10">

                   <?php $logo= get_field( 'logo', 'option'); if($logo){ ?>
   <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Appeal To Heaven"><img src="<?php echo $logo['url']; ?>" alt="Global Lyme Alliance" title="Global Lyme Alliance" /></a>
   <?php } ?>
                            <div class="right-holder">
                                <div class="facebook-widget">
                                    <div class="fb-like" data-href="https://www.facebook.com/GlobalLymeAlliance/" data-size="large" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
                                </div>
<?php $donate_now_link= get_field( 'donate_now_link', 'option'); if($donate_now_link){echo '<a class="btn btn-default" href="'.$donate_now_link. '" title="Donate Now">Donate Now</a>';} ?>

                                <a href="#" class="search-opener">
                                    <span class="icon-search"></span>
                                </a>


                                <a href="#" class="nav-opener">
                                    <span class="icon-burger"></span>
                                </a>

                            </div>
                                <nav class="nav">
                                <?php
                                     if(is_active_sidebar('sidebar-mainmenu')){
                                        dynamic_sidebar('sidebar-mainmenu');
                                     }
                                    ?>
                                </nav>
                            </div>
                            </div>
  </header>
    