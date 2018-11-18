<?php
/**
 * The template for displaying 404 pages (Not Found)
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
	<title>Bayardlaw</title>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
</head>
<body>
<div id="wrapper">
	<header class="container" id="header">
		<div class="logo"><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-big.png" alt=""></a></div>
	</header>
	<main id="main" role="main">
		<div class="container">
			<div class="content-section error-section text-center">
				<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icon-scales.gif" width="208" height="152" alt="">
				<div class="heading">
					<div class="heading-frame">
						<h1><span>404.</span> Something went wrong</h1>
						<div class="divider style-dark"><div></div></div>
					</div>
				</div>
				<a href="<?php echo get_site_url(); ?>" class="btn btn-default"><span><span>Take me Home</span></span></a>
			</div>
		</div>
	</main>
	

<?php get_footer(); ?>