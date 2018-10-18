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
	<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-180x180-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-152x152-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-144x144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-120x120-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-76x76-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-57x57-precomposed.png">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon.png">
	<link rel="icon" sizes="192x192" href="<?php echo get_template_directory_uri () ?>/images/touch-icon-192x192.png">
	<link rel="icon" sizes="128x128" href="<?php echo get_template_directory_uri () ?>/images/touch-icon-128x128.png">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-144x144-precomposed.png">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900,700%7CRoboto+Slab:400,300,100%7COpen+Sans:400,300italic,300,400italic,600' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/fancybox.css">
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/jsf.css">
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/all.css">
	<script type='text/javascript'>
		(function (d, t) {
		  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
		  bh.type = 'text/javascript';
		  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=0numk2ypnwocsqgwydt7jw';
		  s.parentNode.insertBefore(bh, s);
		  })(document, 'script');
	</script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5QPLF8"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="wrapper">
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
						<a class="navbar-brand" href="#"><img src="<?php echo get_template_directory_uri () ?>/images/logo.svg" alt="image description" /></a>
					</div>
					<div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="nav navbar-nav pull-right">
							<li><a href="#">Work</a></li>
							<li><a href="#">Services</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Resources</a></li>
							<li><a href="#">Ideas</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</header>
	