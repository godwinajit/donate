<?php
/* Template Name: Landing Page for Survey Template */
?>
<?php
/**
 * * The Header template for our theme * * Displays all of the <head> section and everything up till
 * * @package WordPress * @subpackage Twenty_Thirteen * @since Twenty Thirteen 1.0
 */
?>
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
<!-- Google Tag Manager 09202017start-->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M3M64ZD');</script>
<!-- End Google Tag Manager 09202017end-->
<!-- Global site tag (gtag.js) - Google Analytics Start -->
<script async
	src="https://www.googletagmanager.com/gtag/js?id=UA-70990108-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-70990108-2');
</script>
<!-- Global site tag (gtag.js) - Google Analytics End -->
<!-- FullStory Script start -->
<script> window['_fs_debug'] = false; window['_fs_host'] = 'fullstory.com'; window['_fs_org'] = 'AE344'; window['_fs_namespace'] = 'FS'; (function(m,n,e,t,l,o,g,y){ if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;} g=m[e]=function(a,b){g.q?g.q.push([a,b]):g._api(a,b);};g.q=[]; o=n.createElement(t);o.async=1;o.src='https://'+_fs_host+'/s/fs.js'; y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y); g.identify=function(i,v){g(l,{uid:i});if(v)g(l,v)};g.setUserVars=function(v){g(l,v)}; y="rec";g.shutdown=function(i,v){g(y,!1)};g.restart=function(i,v){g(y,!0)}; g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)}; g.clearUserCookie=function(){}; })(window,document,window['_fs_namespace'],'script','user'); </script>
<!-- FullStory Script end -->
<!-- Facebook Pixel Code -->
<script>
 !function(f,b,e,v,n,t,s)
 {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
 n.callMethod.apply(n,arguments):n.queue.push(arguments)};
 if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
 n.queue=[];t=b.createElement(e);t.async=!0;
 t.src=v;s=b.getElementsByTagName(e)[0];
 s.parentNode.insertBefore(t,s)}(window, document,'script',
 'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '1538973079464292');
 fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
 src="https://www.facebook.com/tr?id=1538973079464292&ev=PageView&noscript=1
https://www.facebook.com/tr?id=1538973079464292&ev=PageView&noscript=1
"
/></noscript>
<!-- End Facebook Pixel Code -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>

<?php
if (is_post_type_archive('events') && ! is_day() && ! is_month() && ! is_year()) {
    echo "Upcoming Events";
} else {
    wp_title('|', true, 'right');
}
?>

</title>
<link rel="shortcut icon"
	href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico"
	type="image/x-icon">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700"
	rel="stylesheet">
<link
	href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700"
	rel="stylesheet">
<link rel="stylesheet" type="text/css"
	href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo get_template_directory_uri(); ?>/css/fonts.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo get_template_directory_uri(); ?>/css/magnific-popup.css">
<link rel="stylesheet" type="text/css"
	href="<?php echo get_template_directory_uri(); ?>/css/jquery.selectbox.css">
<!--add wphead -->
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css"
	href="<?php echo get_template_directory_uri(); ?>/css/main.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo get_template_directory_uri(); ?>/responsive.css" />
	
</head>
<?php
if (has_post_thumbnail()) {
	$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
}else {
	$banneurl = get_template_directory_uri().'/images/template-banner.jpg';
}
?>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) 09202017start-->
	<div id="site-loader"></div>
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3M64ZD"
			height="0" width="0" style="display: none; visibility: hidden"></iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) 09202017end-->
	 <!-- <img src="https://gallery.mailchimp.com/c907a9b9719f3fa581c9bcf32/images/0761d161-deb0-45ce-957b-ed709a1843fa.png" alt="Logo" /> -->
	<div id="page">
		<div class="header">
			<div class="wrapper container-fluid">
				<a href="https://globallymealliance.org/" title="Global Lyme Alliance" class="header-logo">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo-dark-blue.jpg" alt="Global Lyme Alliance">
				</a>
			</div>
		</div>
		<main class="mains">
		<div class="inner-pages common-content-page">
			<!-- <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)"> 
                <div class="inner-banner" style="background-image:url(http://gla2018.staging.wpengine.com/wp-content/uploads/2017/05/research_science_petri-dish.png)">
			</div> -->
			<div class="container-section">
				<div class="wrapper container-fluid survey-content">
                	<?php echo the_content(); ?>
                </div>
            </div>
         </div>
         </main>
<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<!-- footer starts here -->
<footer class="footer">
	<div class="wrapper container-fluid">
		<div class="footer-columns">
			<a href="http://gla2018.staging.wpengine.com/" title="Global Lyme Alliance" class="logo">Global Lyme Alliance</a>
			<div class="copyright-block">
				<div id="black-studio-tinymce-26" class="widget widget_black_studio_tinymce">
					<div class="textwidget">
						<p>2019 &copy; Copyright Global Lyme Alliance. All rights reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- #colophon -->
<div class="preload"> <img src="<?php echo get_template_directory_uri(); ?>/images/minus.png" alt="Preload" /> </div>
</div>
<!-- #page -->

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/css_browser_selector.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.equalheight.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/placeholder.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.selectbox-0.2.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.magnific-popup.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/menu.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/general.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.screwdefaultbuttonsV2.min.js" type="text/javascript"></script>
<!--<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.2.min.js" type="text/javascript"></script>-->
<script src="<?php echo get_template_directory_uri(); ?>/js/src/main.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/jquery.openclose.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/jquery.accordion.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/retina-cover.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/pie-chart.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/steps.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/enquire.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/custom-forms.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/fancybox.js" type="text/javascript">
<!-- Facebook Book -->
<div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
