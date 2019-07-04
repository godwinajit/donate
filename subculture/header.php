<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon"/>
	<?php wp_enqueue_style('subculture-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css'); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui-1.10.4.custom.min.css">
    <?php wp_enqueue_style('subculture-theme', get_template_directory_uri().'/style.css', array('subculture-all')); ?>
	<?php
	//if ( (strpos(get_page_template(), 'template-about-new.php') !== false) || (strpos(get_page_template(), 'template-event_d.php') !== false)) {
		wp_enqueue_style( 'slick_css', get_template_directory_uri() . '/css/slick.css' );
		wp_enqueue_style( 'slick_theme_css', get_template_directory_uri() . '/css/slick-theme.css' );
		echo '<link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,400i,700,700i" rel="stylesheet">';
	//}
	?>
	<?php wp_enqueue_style('all-subculture', get_template_directory_uri().'/css/all.css'); ?>
    <?php wp_enqueue_script('subculture-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery')); ?>
	<?php wp_enqueue_script('subculture-masonry', get_template_directory_uri().'/js/masonry.min.js', array('jquery')); ?>
	<?php wp_enqueue_script('subculture-imagesloaded', get_template_directory_uri().'/js/imagesloaded.min.js', array('jquery')); ?>

    <script type='text/javascript'>
        (function (d, t) {
            var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
            bh.type = 'text/javascript';
            bh.src = '//www.bugherd.com/sidebarv2.js?apikey=vunfzdxnabbzzktfpl604w';
            s.parentNode.insertBefore(bh, s);
        })(document, 'script');
    </script>

    <script type="text/javascript">
        var pathInfo = {
            base: '<?php echo get_template_directory_uri(); ?>/',
            css: 'css/',
            js: 'js/',
            swf: 'swf/',
        }
    </script>

	<script type="text/javascript">
		(function() {
			var config = {
				kitId: 'dqr0jlq'
			};
			var d = false;
			var tk = document.createElement('script');
			tk.src = '//use.typekit.net/' + config.kitId + '.js';
			tk.type = 'text/javascript';
			tk.async = 'true';
			tk.onload = tk.onreadystatechange = function() {
				var rs = this.readyState;
				if (d || rs && rs != 'complete' && rs != 'loaded') return;
				d = true;
				try { Typekit.load(config); } catch (e) {}
			};
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(tk, s);
		})();
	</script>

    <?php if ( is_singular() ) wp_enqueue_script( 'theme-comment-reply', get_template_directory_uri()."/js/comment-reply.js" ); ?>
	<script type="text/javascript">var switchTo5x=true;</script>
   <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
   <script type="text/javascript">stLight.options({publisher: "ur-ef42c217-fd76-e7bb-5ae-b57e18fc6595", doNotHash: true, doNotCopy: false, hashAddressBar: false});</script>
    <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PTHLFF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PTHLFF');</script>
<!-- End Google Tag Manager -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=439678986178113&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrapper" <?php theme_wrapper_class() ?>>
    <header id="header">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <?php
                        if(has_nav_menu('top'))
                            wp_nav_menu( array(
                                'theme_location' => 'top',
                                'container' => false,
                                'fallback_cb' => false,
                                'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>',
                                'walker' => new Theme_Walker_Nav_Top
                            ));
                    ?>
                    <?php get_template_part('blocks/header/social-links') ?>
                    <div class="dropdown search-form-opener">
                        <button class="btn btn-default dropdown-toggle btn-opener" type="button" data-toggle="dropdown"><i class="fa fa-search"></i></button>
                        <div class="dropdown-menu">
                            <?php get_search_form();?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div id="main">