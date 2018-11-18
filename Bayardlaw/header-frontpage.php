<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="msvalidate.01" content="87EB7A17481588DEBEC0E41D9662F7E8" />
	<title>Bayardlaw</title>
	<?php wp_head(); ?>
</head>
<body class="home-page">
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KJ737D"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KJ737D');</script>
<!-- End Google Tag Manager -->
<div id="wrapper">
	<section class="visual-section" id="intro">
		<div class="logo"><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-big.png" width="291" height="90" alt="Bayardlaw"></a></div>
		<?php
		/** getting custom field values  */
		$banner_image = get_field('banner_image');?>
		<div class="bg-stretch"><img src="<?php echo $banner_image?>" alt=""></div>
		<div class="container">
		<?php
		/** getting custom field values  */
		$banner_title = get_field('banner_title');
		$banner_text = get_field('banner_text');
		$read_more_button_text = get_field('read_more_button_text');
		$read_more_button_link = get_field('read_more_button_link');?>
			<div class="frame">
				<div class="text-block center-block text-center">
					<div class="divider"><div></div></div>
					<h1><?php if($banner_title) echo $banner_title; ?></h1>
					<p><?php if($banner_text) echo $banner_text; ?></p>
					<a href="<?php if($read_more_button_link) echo $read_more_button_link; ?>" class="btn btn-default"><span><span><?php if($read_more_button_text) echo $read_more_button_text; ?></span></span></a>
				</div>
			</div>
		</div>
	</section>

	<div class="navbar-holder">

		<nav class="navbar navbar-default" id="fixed-nav">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo get_site_url(); ?>"><img alt="Bayardlaw" src="<?php echo get_template_directory_uri(); ?>/images/logo-small.png" height="80" width="126"></a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<form class="navbar-form navbar-right" role="search" action="<?php echo get_site_url(); ?>" method="post">
						<div class="input-group">
							<input type="search" name="s" class="form-control">
							<span class="input-group-btn">
								<button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</span>
						</div>
					</form>
					<?php  if ( is_active_sidebar( 'sidebar-3' ) ) :
							   dynamic_sidebar( 'sidebar-3' );
							 endif;?>
				</div>
			</div>
		</nav>
	</div>
