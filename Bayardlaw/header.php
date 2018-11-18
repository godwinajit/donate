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
	<script type='text/javascript'>
(function (d, t) {
  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=dx5vovqqwnoxrqqb3lzofg';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script');
</script>
</head>
<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KJ737D"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KJ737D');</script>
<!-- End Google Tag Manager -->
<div id="wrapper">

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
