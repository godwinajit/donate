<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Mindtrustlabs
 * @since Twenty Fourteen 1.0
 */
?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MindTrust Labs</title>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-P5QPLF8');</script>
	<!-- End Google Tag Manager -->
	<!-- iPad and iPad mini (with @2� display) iOS = 8 -->
	<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-180x180-precomposed.png">
	<!-- iPad 3+ (with @2� display) iOS = 7 -->
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-152x152-precomposed.png">
	<!-- iPad (with @2� display) iOS = 6 -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-144x144-precomposed.png">
	<!-- iPhone (with @2� and @3 display) iOS = 7 -->
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-120x120-precomposed.png">
	<!-- iPhone (with @2� display) iOS = 6 -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-114x114-precomposed.png">
	<!-- iPad mini and the first- and second-generation iPad (@1� display) on iOS = 7 -->
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-76x76-precomposed.png">
	<!-- iPad mini and the first- and second-generation iPad (@1� display) on iOS = 6 -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-72x72-precomposed.png">
	<!-- Android Stock Browser and non-Retina iPhone and iPod Touch -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-57x57-precomposed.png">
	<!-- Fallback for everything else -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon.png">
	<!--
	    Chrome 31+ has home screen icon 192�192 (the recommended size for multiple resolutions).
	    If it�s not defined on that size it will take 128�128.
	-->
	<link rel="icon" sizes="192x192" href="<?php echo get_template_directory_uri () ?>/images/touch-icon-192x192.png">
	<link rel="icon" sizes="128x128" href="<?php echo get_template_directory_uri () ?>/images/touch-icon-128x128.png">
	<!-- Tile icon for Win8 (144x144) -->
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri () ?>images/apple-touch-icon-144x144-precomposed.png">
	
		<?php wp_head(); ?>
	<script type='text/javascript'>
		(function (d, t) {
		  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
		  bh.type = 'text/javascript';
		  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=kt4ybsicwg3pq5gikgof7w';
		  s.parentNode.insertBefore(bh, s);
		  })(document, 'script');
	</script>
</head>
<?php $bodyclassname=is_front_page() ? "front" : "noclass" ;?>
<?php $wrapperclassname="";if ( get_post_type( get_the_ID() ) == 'career' ) {$wrapperclassname = 'single';}else{$wrapperclassname = get_field('layout_name');}?>
<body class="<?php echo $bodyclassname;?>" >
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5QPLF8"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="wrapper" class="<?php echo $wrapperclassname; ?>">
	<header id="header">
		<div class="container">
			<div class="row">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
						<a class="navbar-brand" href=" <?php echo  get_home_url(); ?>  "><img src="<?php echo get_template_directory_uri () ?>/images/logo.svg" alt="image description" /></a>
					</div>
					
					<?php dynamic_sidebar( 'sidebar-topmenu' ); ?>
				</nav>
			</div>
		</div>
	</header>