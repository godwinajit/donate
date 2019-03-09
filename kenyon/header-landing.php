<!DOCTYPE html>
<html>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NG55P7');</script>
<!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"">
	<link rel="shortcut icon" href="https://cookwithkenyon.com/wp-content/uploads/2014/11/favicon.png" type="image/png" />
	<title><?php wp_title(' | ', true, 'right'); ?><?php //bloginfo('name'); ?></title>

	<?php wp_enqueue_style('kenyon-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css'); ?>
<!-- 	<?php wp_enqueue_style('kenyon-fancybox', get_template_directory_uri().'/css/fancybox.css'); ?> -->
	<?php wp_enqueue_style('kenyon-all', get_template_directory_uri().'/css/all.css'); ?>
	<?php wp_enqueue_style('kenyon-theme', get_template_directory_uri().'/style.css', array('kenyon-all')); ?>

	<?php wp_enqueue_script('kenyon-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery')); ?>
	<?php wp_enqueue_script('kenyon-main', get_template_directory_uri().'/js/jquery.main.js', array('kenyon-bootstrap')); ?>
      <?php if(is_page_template('pages/template-gallery.php')){
    	wp_enqueue_script('kenyon-masonary', get_template_directory_uri().'/js/masonry.pkgd.min.js');
    	wp_enqueue_script('kenyon-masonary1', get_template_directory_uri().'/js/script_gallery.js');
	wp_enqueue_script('kenyon-masonary2', get_template_directory_uri().'/js/jquery.lightbox-0.5.min.js');
	}?>

	<?php if ( is_singular() ) wp_enqueue_script( 'kenyon-comment-reply', get_template_directory_uri()."/js/comment-reply.js" ); ?>

	<!-- <script type="text/javascript" src="https://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "c046a886-1ec1-40f6-a4ed-e9dfff2f2263", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
	<script type="text/javascript">
			var pathInfo = {
				base: '<?php echo get_template_directory_uri(); ?>/',
				css: 'css/',
				js: 'js/',
				swf: 'swf/',
			}
	</script> -->

	<?php wp_head(); ?>
<!-- ClickDesk Live Chat Service for websites -->
<!-- <script type='text/javascript'>
var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyDwsSBXVzZXJzGNDF6OsHDA');
var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' :
'http://my.clickdesk.com/clickdesk-ui/browser/');
var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
var glcspt = document.createElement('script'); glcspt.type = 'text/javascript';
glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
</script> -->
<!-- End of ClickDesk -->
<style type="text/css">
	body.cookies-accepted #cookie-notice {
    display: none;
}

#lp-head {
    padding: 16px 0;
}
.lp-logo {
    width: auto;
    float: left;
}
.lp-logo strong.logo {
    max-width: 135px;
    margin: 0;
}

.lp-button {
    float: right;
    padding-top: 6px;
}
.lp-button a {
    background-color: #fff;
    padding: 6px 36px;
    font-size: 18px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #232427;
    border-radius: 4px;
}



.lp-hero-section {
    min-height: 458px;
    background-size: cover;
    background-position: center center;
    position: relative;
    z-index: 1;
    display: flex;
    display: -webkit-flex;
    -webkit-flex-direction: column;
    flex-direction: column;
    justify-content: flex-end;
    -webkit-justify-content: flex-end;
    justify-content: flex-end;
    text-align: center;
}
/*.lp-hero-section:before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.9) 66%, #ffffff);
    z-index: -1;
}*/
.lp-hero-section:before {
    content: '';
    position: absolute;
    width: 100%;
    height: 76%;
background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(0,0,0,0) 0%, rgba(0,0,0,0.58) 58%, rgba(0,0,0,0.9) 90%, rgba(0,0,0,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,0)), color-stop(0%, rgba(0,0,0,0)), color-stop(58%, rgba(0,0,0,0.58)), color-stop(90%, rgba(0,0,0,0.9)), color-stop(100%, rgba(0,0,0,1)));
background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(0,0,0,0) 0%, rgba(0,0,0,0.58) 58%, rgba(0,0,0,0.9) 90%, rgba(0,0,0,1) 100%);
background: -o-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(0,0,0,0) 0%, rgba(0,0,0,0.58) 58%, rgba(0,0,0,0.9) 90%, rgba(0,0,0,1) 100%);
background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(0,0,0,0) 0%, rgba(0,0,0,0.58) 58%, rgba(0,0,0,0.9) 90%, rgba(0,0,0,1) 100%);
background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(0,0,0,0) 0%, rgba(0,0,0,0.58) 58%, rgba(0,0,0,0.9) 90%, rgba(0,0,0,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#000000', GradientType=0 );
    z-index: -1;
}
.lp-block-holder {
    max-width: 732px;
    margin: 0 auto;
    padding-bottom: 110px;
}
.lp-hero-section h1 {
    font-size: 60px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    /*color: #232427;*/
    color: #ffffff;
}
.lp-hero-section p {
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.5;
    letter-spacing: normal;
    text-align: center;
    /*color: #494a4e;*/
    color: #ffffff;
}
/*=========== SECTION 2 LP ========== */
.lp-section-2 {
    padding: 30px 0 80px;
}

.lp-section-2 .row .lp-two-col-section {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    flex-basis: 47.4%;
    -webkit-flex-basis: 47.4%;
    float: left;
    margin-right: 2.43%;
    margin-top: 25px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    position: relative;
}
.lp-section-2 .row{
	 display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: stretch;
    -moz-box-align: stretch;
    -webkit-align-items: stretch;
    -ms-flex-align: stretch;
    align-items: stretch;
    flex-wrap: wrap;
    -wevkit-flex-wrap: wrap;
    flex-direction: row;
    -webkit-flex-direction: row;
    margin-right: -2.5%;
}

.lp-img-content {
    min-height: 400px;
    background-size: cover;
    width: 100%;
}
.lp-two-col-section .text-block {
    display: flex;
    display: -webkit-flex;
    -webkit-flex-direction: column;
    flex-direction: column;
    justify-content: center;
    -webkit-justify-content: center;
    justify-content: center;
    padding-right: 13%;
}
.lp-two-col-section h2 {
    font-size: 40px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #f99400;
}
.lp-two-col-section p {
    font-size: 20px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #232427;
}

/*===================== LP SECTION 3 ================= */
#lp-third {
    background-color: rgba(179, 182, 185, .3);
    padding: 80px 0;
}
#third:before {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.65);
    z-index: -1;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.best-recipes-section-title {
    max-width: 418px;
    margin: 0 auto;
    padding-bottom: 70px;
}
.best-recipes-section-title h2 {
    font-size: 32px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: center;
    color: #232427;
}
.three-col-adjust-wrapper {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-align: stretch;
    -moz-box-align: stretch;
    -webkit-align-items: stretch;
    -ms-flex-align: stretch;
    align-items: stretch;
    flex-wrap: wrap;
    -wevkit-flex-wrap: wrap;
    flex-direction: row;
    -webkit-flex-direction: row;
    margin-right: -2.5%;
}
.three-col-adjust {
    flex-basis: 30.9%;
    -webkit-flex-basis: 30.9%;
    float: left;
    margin-right: 2.43%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    position: relative;
    background-color: #fff;
}
.img-se {
    min-height: 206px;
    background-size: cover;
    background-position: center center;
}
.lp-third-details {
    background-color: #fff;
    padding: 27px;
}
.lp-third-details h3 {
    font-size: 24px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #f99400;
    margin: 0 0 24px;
    text-align: center;
}
.lp-third-details p {
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.75;
    letter-spacing: normal;
    color: #8a8a8a;
    margin: 0 0 8px;
    text-align: center;
}

/*================= lp VIDEO SECTION ========== */
#lp-video {
    padding: 80px 0;
}

#lp-video .video-sec iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
#lp-video .video-sec {
    position: relative;
    padding-bottom: 50%;
    padding-top: 25px;
    height: 0;
    max-width: 926px;
    margin: 0 auto;
}

/*================== SLIDER SECTION =============== */
.lp-slider-section {
    background-color: #232427;
    padding: 60px 0 50px;
}
.lp-slider-section h2 {
    font-size: 32px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #ffffff;
    text-align: center;
    text-transform: uppercase;
    margin: 0 0 60px;
}
.lp-shop-cta a:hover,
.lp-button a:hover {
    text-decoration: none;
}
.lp-shop-cta a:focus,
.lp-slide-item h3 a:focus {
    outline: none;
}

/*====================== footer lp ============= */
body.page-template-template-landingpage.cookies-not-set:before {
    background-color: transparent;
}

.lp-footer {
    padding: 50px 0 31px;
}
.lp-f-social ul li {
    display: inline-block;
    padding: 0 7px;
}
.lp-f-social ul {
    margin: 0;
}
.lp-f-contact ul li {
    display: inline-block;
    padding: 0 20px;
}
.lp-f-contact ul li:last-child {
    padding-right: 0;
}
.lp-f-contact ul li a {
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #8a8a8a;
}
.lp-f-contact ul li a:hover{
	text-decoration: none;
}
.lp-f-contact ul {
    float: right;
    margin: 0;
}
.lp-f-social {
    width: auto;
    float: left;
}
.lp-f-contact {
    width: auto;
    float: left;
}
.foot-left-lp p {
    font-size: 12px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #b3b6b9;
    margin: 0;
}
.foot-logo-lp {
    margin-bottom: 28px;
}

.lp-f-contact ul li.lp-site a {
    color: #f99400;
}
li.lp-call:before {
    content: '';
    position: absolute;
    background-image: url(http://kenyongrills.staging.wpengine.com/wp-content/uploads/2019/01/phone.svg);
    width: 18px;
    height: 18px;
    background-repeat: no-repeat;
    left: 20px;
    top: 3px;
    background-size: cover;
}
.lp-f-contact ul li.lp-call {
    position: relative;
    padding-left: 47px;
}

.lp-f-contact li.lp-fax:before {
    content: '';
    position: absolute;
    background-image: url(http://kenyongrills.staging.wpengine.com/wp-content/uploads/2019/01/fax.svg);
    width: 18px;
    height: 18px;
    background-repeat: no-repeat;
    left: 20px;
    top: 3px;
    background-size: cover;
}
.lp-f-contact ul li.lp-fax {
    position: relative;
    padding-left: 47px;
}

@media(min-width: 1025px) and (max-width: 1200px){
.lp-f-contact ul li {
    padding: 0 8px;
}
.lp-f-contact ul li.lp-call {
    padding-left: 32px;
}
.lp-f-contact ul li.lp-fax {
    padding-left: 30px;
}
body .lp-f-contact li.lp-call:before,
body .lp-f-contact li.lp-fax:before {
    left: 0;
}
.lp-f-contact ul li a {
    font-size: 14px;
}

}

@media(min-width: 768px) and (max-width: 1024px){
.col-md-8.foot-right-lp {
    width: 66.66666667%;
    float: left;
}
.col-md-4.foot-left-lp {
    width: 33.33333333%;
    float: left;
}
.lp-f-contact {
    width: 100%;
    float: none;
    padding-top: 20px;
}
.lp-f-contact ul li {
    display: inline-block;
    padding: 0 6px;
}
.lp-f-contact ul li.lp-call {
    position: relative;
    padding-left: 32px;
}
.lp-f-contact ul li.lp-fax {
    position: relative;
    padding-left: 30px;
}
body .lp-f-contact li.lp-call:before,
body .lp-f-contact li.lp-fax:before {
    left: 0;
}
.lp-f-contact ul li a {
    font-size: 15px;
}
.lp-f-social {
    width: 100%;
    float: none;
}
.lp-f-contact ul {
    float: none;
    margin: 0;
}
}
@media(max-width: 767px){
#third:before {
    background-color: rgba(0, 0, 0, 0.65);
}
body #lp-head {
    padding: 20px 10px;
}
body .lp-button {
    padding-top: 2px;
}
.lp-hero-section h1 {
    font-size: 40px;
}
.lp-block-holder {
    padding-bottom: 7px;
    padding: 0 20px 7px;
}
.lp-hero-section:before {
    bottom: -1px;
    left: 0;
    right: 0;
}
body .lp-button a {
    padding: 6px 16px;
}
body .lp-section-2 {
    padding: 30px 20px 60px;
}
body .lp-two-col-section h2 {
    font-size: 32px;
}
.lp-section-2 .row {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    flex-direction: column-reverse;
    -webkit-flex-direction: column-reverse;
}
.lp-section-2 .row .lp-two-col-section {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    flex-basis: 100%;
    -webkit-flex-basis: 100%;
    float: left;
    margin-right: 0;
    margin-top: 0px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    position: relative;
}
body .lp-img-content {
    min-height: 173px;
    background-size: cover;
    width: 100%;
    margin-bottom: 15px;
}
body .lp-two-col-section .text-block {
    padding-right: 0;
}
body.page-template-template-landingpage .home-shop-section {
    padding: 106px 20px;
}
body.page-template-template-landingpage .shop-block-holder p {
    margin-bottom: 0;
}
#lp-third {
    padding: 60px 0;
}
body .best-recipes-section-title {
    padding-bottom: 20px;
    padding-left: 10px;
    padding-right: 10px;
}
body #lp-video {
    padding: 60px 20px;
}
.lp-slides-wrap {
    padding-bottom: 80px;
    max-width: 420px;
    margin: 0 auto;
    padding: 0 10px;
}
body .lp-slides-wrap button.slick-next.slick-arrow {
    left: 52%;
}
body .lp-slides-wrap button.slick-prev.slick-arrow {
    left: 43%;
}
.lp-slider-section h2 {
    margin: 0 0 33px;
}
.lp-footer {
    padding: 60px 0 51px;
}
.foot-logo-lp {
    margin-bottom: 24px;
    text-align: center;
}
.foot-left-lp p {
    text-align: center;
}
body .foot-left-lp,
body .foot-right-lp {
    max-width: 209px;
    margin: 0 auto;
    padding-bottom: 53px;
    text-align: center;
}
.lp-f-social {
    width: 100%;
    float: none;
    margin-bottom: 24px;
}
.lp-f-contact ul{
    width: 100%;
    float: none;
}
.lp-f-contact ul li {
    display: inline-block;
    padding: 0 0px!important;
    margin-bottom: 24px;
}
.lp-f-contact ul li:last-child {
    margin-bottom: 0px;
}
li.lp-call:before,
.lp-f-contact li.lp-fax:before {
    left: -25px;
}
}
</style>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NG55P7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="lp-head" style="background-color: #f99400">
				<div class="container">
					<div class="row">
						<div class="col-md-2 lp-logo">
							<strong class="logo"><a href="<?php echo home_url(); ?>"><img src="https://www.cookwithkenyon.com/wp-content/uploads/2018/05/logo.svg"></a></strong>
						</div>

						<div class="col-md-2 lp-button">
							<a href="#">SHOP NOW</a>
						</div>


					</div>
				</div>
			</div>

	

		<main  role="main">