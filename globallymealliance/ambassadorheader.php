<?php /** * The Header template for our theme * * Displays all of the <head> section and everything up till
<div id="main">
    * * @package WordPress * @subpackage Twenty_Thirteen * @since Twenty Thirteen 1.0 */ ?>
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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-70990108-2"></script>
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
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="viewport"
  content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700"
  rel="stylesheet">
<link
  href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700"
  rel="stylesheet">
<title>Global Lyme Alliance</title>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
  <!--styles -->
<link rel="stylesheet" href="/ambassador/app/css/style.css">
<link rel="stylesheet" href="/ambassador/app/css/main.css">
<link rel="stylesheet" href="<?php echo plugin_dir_url(''); ?>constant-contact-forms/assets/css/style.css">
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) 09202017start-->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M3M64ZD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) 09202017end-->
  <div class="page">
    <header class="header">
      <div class="wrapper container-fluid">
        <div class="row center-xs">
          <div class="col-xs-11 col-lg-10">

                   <?php $logo= get_field( 'logo', 'option'); if($logo){ ?>
   <a class="logo" href="<?php echo esc_url( home_url( '../../' ) ); ?>"><img src="<?php echo $logo['url']; ?>" alt="Global Lyme Alliance" title="Global Lyme Alliance" /></a>
   <?php } ?>
                            <div class="right-holder">
                                <div class="facebook-widget">
                                    <div class="fb-like" data-href="https://www.facebook.com/GlobalLymeAlliance/" data-size="large" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
                                </div>
<?php $donate_now_link= get_field( 'donate_now_link', 'option'); if($donate_now_link){echo '<a class="btn btn-default" href="'.$donate_now_link. '" title="Donate Now">Donate Now</a>';} ?>

                                <a href="#" class="search-opener">
                                    <span class="icon-search"></span>
                                </a>


                                <a href="#" class="nav-opener">
                                    <span class="icon-burger"></span>
                                </a>

                            </div>
                                <nav class="nav">
                                <?php
                                     if(is_active_sidebar('sidebar-mainmenu')){
                                        dynamic_sidebar('sidebar-mainmenu');
                                     }
                                    ?>
                                </nav>
                            </div>
                            </div>
							</div>
  </header>
    