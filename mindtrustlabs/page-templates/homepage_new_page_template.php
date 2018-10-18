<?php
/**
 * Template Name: Home page - New
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */
?>
<!DOCTYPE html>
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
	<!-- iPad and iPad mini (with @2× display) iOS ≥ 8 -->
	<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-180x180-precomposed.png">
	<!-- iPad 3+ (with @2× display) iOS ≥ 7 -->
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-152x152-precomposed.png">
	<!-- iPad (with @2× display) iOS ≤ 6 -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-144x144-precomposed.png">
	<!-- iPhone (with @2× and @3 display) iOS ≥ 7 -->
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-120x120-precomposed.png">
	<!-- iPhone (with @2× display) iOS ≤ 6 -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-114x114-precomposed.png">
	<!-- iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7 -->
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-76x76-precomposed.png">
	<!-- iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6 -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-72x72-precomposed.png">
	<!-- Android Stock Browser and non-Retina iPhone and iPod Touch -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-57x57-precomposed.png">
	<!-- Fallback for everything else -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon.png">
	<!--
	    Chrome 31+ has home screen icon 192×192 (the recommended size for multiple resolutions).
	    If it’s not defined on that size it will take 128×128.
	-->
	<link rel="icon" sizes="192x192" href="<?php echo get_template_directory_uri () ?>/images/touch-icon-192x192.png">
	<link rel="icon" sizes="128x128" href="<?php echo get_template_directory_uri () ?>/images/touch-icon-128x128.png">
	<!-- Tile icon for Win8 (144x144) -->
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-144x144-precomposed.png">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900,700%7CRoboto+Slab:400,300,100%7COpen+Sans:400,300italic,300,400italic,600' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/fancybox.css">
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
<body class="front">
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
					
					<?php dynamic_sidebar( 'sidebar-topmenu' ); ?>
				</nav>
			</div>
		</div>
	</header>
	<div class="top-section">
		<div class="video-section">
			<div class="holder">
				<div class="container">
					<div class="row">
						<h1>MINDTRUST</h1>
						<h2>Discover our science of collaborative innovation.</h2>
						<a href="<?php echo get_home_url(); ?>/work" class="btn btn-default btn-see">See Our Work</a>
						<a href="<?php echo get_home_url(); ?>/contact" class="btn btn-default btn-see">Let's Talk</a>
					</div>
				</div>
			</div>
			<div class="video-frame">
				<div class="video-box" data-width="720" data-height="406">
					<video class="mejs-wmp" width="720" height="406" controls="none" preload="none" poster="/wp-content/uploads/2015/01/insta.gif" autoplay="autoplay" loop="loop">
						<source src="/wp-content/uploads/2015/01/MT-Web-BG.mp4" />
						<source src="/wp-content/uploads/2015/01/MT-Web-BG.webmsd.webm" />
						<source src="/wp-content/uploads/2015/01/MT-Web-BG.ogv" />
					</video>
				</div>
			</div>
		</div>
	</div>
	<main id="main" role="main">
		<section class="block services">
			<div class="container">
				<h2>At the core, we are an ideas company. The products we build push the boundaries of innovation.</h2>
				<p class="text-center"><a class="btn btn-default btn-core" href="<?php echo get_home_url(); ?>/about">Learn More</a></p>
			</div>
		</section>
		<div class="view-work without-overlay" style="background-image:url(<?php echo get_template_directory_uri () ?>/images/NewMindTrustLabs_CaseStudyImage.jpg);">
			<a href="<?php echo get_home_url(); ?>/work" class="btn-circle">
				<div>View <br> Work <br> <hr></div>
			</a>
		</div>
		<section class="block companies">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				                <?php the_content(); ?>
				        <?php endwhile; ?>
		</section>
	
		
<div class="block twitter-section white">
	<div class="container">
		<div class="col-sm-12">
			<div class="row">
				<div class="tweet">
					<blockquote class="twitter-tweet" lang="ru"><?php dynamic_sidebar( 'sidebar-twitter' ); ?></blockquote>
					<span class="icon icon-twitter"></span>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="quote-block">
	<div class="holder">
		<blockquote class="quote">
			<q>“Markets are changing faster than they ever have before.  To stay competitive, businesses today need to collaborate across disciplines, locations and organizations to invent the best solutions, faster.  Integrating multidimensional teams with agile software best-practices leads to new ideas and better products brought to market faster. We can build you a dream team, your “MindTrust”.</q>
<cite>Chris Errato, Founder/President</cite>
		</blockquote>
		<div class="buttons-holder">
			<a href="https://www.mindtrustlabs.com/contact/"
				class="btn btn-default btn-contact">Learn How</a>
		</div>
		<!-- <ul class="social-links">
			<li><a href="https://www.facebook.com/mindtrustlabs"><span
					class="icon icon-facebook"></span> </a></li>
			<li><a href="https://twitter.com/mindtrustlabs"><span
					class="icon icon-twitter"></span> </a></li>
			<li><a href="https://www.linkedin.com/company/mindtrust-labs"><span
					class="icon icon-linkedin"></span> </a></li>
			<li><a href="#"><span class="icon icon-rss"></span> </a></li>
		</ul> -->
	</div>
</div>
<?php get_footer();	?>