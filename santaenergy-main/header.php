<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package santaenergy-main
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"><!-- Bootstrap CSS File -->
	<link href="<?php echo get_template_directory_uri(); ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"><!-- Main Stylesheet File -->
	<link href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" rel="stylesheet" type="text/css">
	<?php wp_head(); ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">    
</head>
<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'santaenergy-main' ); ?></a>
		<div class="full-menu" style="display: none;">
			<div class="desktop-menu-open">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="menu-open-logo">
								<a class="navbar-brand fs-25 fw-600 color-fff color-red-hvr" href="<?php echo network_site_url();?>"><img alt="Santa" src="<?php echo get_template_directory_uri(); ?>/img/santa_home_logo_white.svg"></a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="close-menu-icon main-opener">
								<img src="<?php echo get_template_directory_uri(); ?>/img/santa_home_close_yellow.svg">
							</div>
						</div>
						<div class="col-md-12">
							<?php dynamic_sidebar('header-menu');?>
						</div>

					</div>
				</div>
			</div>

			</div>


	<header class="header">
		<div class="top-header">
			<div class="menu-container">
				<nav class="navbar navbar-expand-lg navbar-colored">
					<div class="container">
						<a class="navbar-brand fs-25 fw-600 color-fff color-red-hvr" href="<?php echo network_site_url();?>"><img alt="Santa" src="<?php echo get_template_directory_uri(); ?>/img/santa_home_logo_color.svg"></a>
		                <div aria-controls="main-navbar" aria-expanded="true" aria-label="Toggle navigation" class="bars z-index-1 bars-rotate" data-target="#main-navbar" data-toggle="collapse">
			                <span class="first d-block bg-fff mb-6px transition-5"></span> <span class="second d-block bg-fff mb-6px transition-5"></span> <span class="third d-block bg-fff mb-6px transition-5"></span>
	                </div>
	                <a href="#" class="menu-icon-normal main-opener"><span></span></a>
		        </nav>
			</div>
			<div class="main-dropdown">
				<div class="container">
					<div class="main-nav">
						<?php dynamic_sidebar('header-menu');?>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="top-menu-section">
								<?php dynamic_sidebar('header-top');?>
							</div>
						</div>
					</div>
                </div>
			</div>
		</div>
	</header>
	<main id="main">
