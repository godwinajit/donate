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
	<link rel="profile" href="https://gmpg.org/xfn/11">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"><!-- Bootstrap CSS File -->
  <link href="<?php echo get_template_directory_uri(); ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"><!-- Main Stylesheet File -->
  <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" rel="stylesheet" type="text/css">
 <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js" type="text/javascript"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'santaenergy-main' ); ?></a>

  <header>
    <div class="menu-container">
      <nav class="navbar navbar-expand-lg navbar-colored">
        <div class="container">
          <a class="navbar-brand fs-25 fw-600 color-fff color-red-hvr" href="#"><img alt="Santa" src="<?php echo get_template_directory_uri(); ?>/img/santa_home_logo_color.svg"></a>
          <div aria-controls="main-navbar" aria-expanded="true" aria-label="Toggle navigation" class="bars z-index-1 bars-rotate" data-target="#main-navbar" data-toggle="collapse">
            <span class="first d-block bg-fff mb-6px transition-5"></span> <span class="second d-block bg-fff mb-6px transition-5"></span> <span class="third d-block bg-fff mb-6px transition-5"></span>
          </div>
          <div class="navbar-collapse collapse show" id="main-navbar" style="">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button">Products</a>
                <div aria-labelledby="navbarDropdown" class="dropdown-menu">
                  <a class="dropdown-item fs-14" href="#">Air Conditioning</a> <a class="dropdown-item fs-14" href="#">Propane</a> <a class="dropdown-item fs-14" href="#">Propane</a> <a class="dropdown-item fs-14" href="#">Delivery</a> <a class="dropdown-item fs-14" href="#">Equipment</a> <a class="dropdown-item fs-14" href="#">Prices</a><a class="dropdown-item fs-14" href="#">Servicing</a><a class="dropdown-item fs-14" href="#">Price Protection</a>                </div>
              </li>
              <li class="nav-item dropdown">
                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button">Services & Plans</a>
                <div aria-labelledby="navbarDropdown" class="dropdown-menu">
                  <a class="dropdown-item fs-14" href="#">Services & Plans 1</a> <a class="dropdown-item fs-14" href="#">Services & Plans 2</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>

	  <main id="main">
