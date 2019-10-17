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
	<?php wp_enqueue_style('kenyon-fancybox', get_template_directory_uri().'/css/fancybox.css'); ?>
	<?php wp_enqueue_style('kenyon-all', get_template_directory_uri().'/css/all.css'); ?>
	<?php wp_enqueue_style('kenyon-theme', get_template_directory_uri().'/style.css', array('kenyon-all')); ?>

	<?php wp_enqueue_script('kenyon-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery')); ?>
	<?php wp_enqueue_script('kenyon-main', get_template_directory_uri().'/js/jquery.main.js', array('kenyon-bootstrap')); ?>
    <?php wp_enqueue_script('kenyon-theme', get_template_directory_uri().'/js/theme.js', array('kenyon-main')); ?>
      <?php if(is_page_template('pages/template-gallery.php')){
    	wp_enqueue_script('kenyon-masonary', get_template_directory_uri().'/js/masonry.pkgd.min.js');
    	wp_enqueue_script('kenyon-masonary1', get_template_directory_uri().'/js/script_gallery.js');
	wp_enqueue_script('kenyon-masonary2', get_template_directory_uri().'/js/jquery.lightbox-0.5.min.js');
	}?>

	<?php if ( is_singular() ) wp_enqueue_script( 'kenyon-comment-reply', get_template_directory_uri()."/js/comment-reply.js" ); ?>

	<script type="text/javascript" src="https://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "c046a886-1ec1-40f6-a4ed-e9dfff2f2263", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
	<script type="text/javascript">
			var pathInfo = {
				base: '<?php echo get_template_directory_uri(); ?>/',
				css: 'css/',
				js: 'js/',
				swf: 'swf/',
			}
	</script>

	<?php wp_head(); ?>
<!-- ClickDesk Live Chat Service for websites -->
<script type='text/javascript'>
var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyDwsSBXVzZXJzGNDF6OsHDA');
var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' :
'http://my.clickdesk.com/clickdesk-ui/browser/');
var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
var glcspt = document.createElement('script'); glcspt.type = 'text/javascript';
glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
</script>
<!-- End of ClickDesk -->
<style type="text/css">
	body.cookies-accepted #cookie-notice {
    display: none;
}

</style>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NG55P7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="wrapper">
				<div class="sticky-menu sticky-lg">
			<ul>
				<li><a onclick="openNav()" href="javascript:void(0)"><span><svg version="1.1" class="icon-offer" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
					<path class="path-offer" d="M27.174,13.412l-12.6-12.6C14.07,0.308,13.37,0,12.6,0H2.8C1.26,0,0,1.26,0,2.8v9.8
					c0,0.77,0.308,1.47,0.826,1.988l12.6,12.6C13.93,27.692,14.63,28,15.4,28c0.77,0,1.47-0.308,1.974-0.826l9.8-9.8
					C27.692,16.87,28,16.17,28,15.4C28,14.63,27.678,13.916,27.174,13.412z M4.9,7C3.738,7,2.8,6.062,2.8,4.9s0.938-2.1,2.1-2.1
					S7,3.738,7,4.9S6.062,7,4.9,7z"/>
				</svg></span><em>Offers</em></a></li>
				<li><a href="/about/"><span><svg version="1.1" class="icon-star" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
					<path class="path-star" d="M27.976,10.643c-0.058-0.187-0.211-0.323-0.397-0.351L18.5,8.906l-4.06-8.642
					c-0.166-0.352-0.716-0.352-0.881,0l-4.06,8.642l-9.079,1.385c-0.185,0.028-0.339,0.165-0.397,0.351s-0.01,0.392,0.124,0.529
					l6.569,6.727l-1.551,9.498c-0.031,0.194,0.044,0.389,0.196,0.504c0.152,0.116,0.352,0.131,0.518,0.039L14,23.456l8.12,4.484
					C22.192,27.98,22.271,28,22.349,28c0.102,0,0.203-0.033,0.289-0.099c0.151-0.115,0.227-0.311,0.196-0.504l-1.551-9.498l6.569-6.727
					C27.985,11.034,28.033,10.829,27.976,10.643z"/>
				</svg></span><em>Why us?</em></a></li>
				<li><a href="tel:(860)664-4906"><span><svg version="1.1" class="icon-phone" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
					<path class="path-phone" d="M23.496,28C10.519,28,0,17.48,0,4.503l4.226-4.226c0.37-0.37,0.969-0.37,1.338,0l5.515,5.515
						c0.37,0.37,0.37,0.969,0,1.338l-4.226,4.226l9.79,9.791l4.226-4.226c0.37-0.37,0.969-0.37,1.338,0l5.515,5.515
						c0.37,0.37,0.37,0.969,0,1.338L23.496,28z"/>
					</svg></span><em>Call Us</em></a></li>
			</ul>
		</div>

<div id="mySidenav" class="sidenav">
<h2>Today's offers   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></h2>
<?php
if( have_rows('todays_offers', 25) ):
		    while ( have_rows('todays_offers', 25) ) : the_row();
				$img_id_offer_image	= get_sub_field('offer_image');
				$img_src_offer_image = wp_get_attachment_image_src( $img_id_offer_image, 'shop_catalog' )[0];
			?>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="image-block">
                        <div class="holder">
                            <a href="<?php the_sub_field('offer_url');?>">
                                <img src="<?php echo $img_src_offer_image?>" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="" width="535" height="331">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="product-info">
                        <div class="meta-block clearfix">
                            <h3>
                    <a href="<?php the_sub_field('offer_url');?>"><?php the_sub_field('offer_title');?></a>
                </h3>
                        </div>
                        <p><?php the_sub_field('offer_description');?></p>
                        <strong class="price"><del><span class="amount"><?php the_sub_field('regular_price');?></span></del> <ins><span class="amount"><?php the_sub_field('offer_price');?></span></ins></strong>
                        <a class="btn btn-default btn-block" href="<?php the_sub_field('offer_url');?>"><?php the_sub_field('offer_button');?></a>
                    </div>
                </div>

            </div>
			<?php endwhile;
		endif;
	?>
</div>
	
		<header id="header">
		<!-- <div class="widgetBox"><?php dynamic_sidebar('Header Content'); ?></div> -->
			<div class="header-holder">
				<div class="container">
					<!-- <?php get_template_part('blocks/social-links'); ?> -->

					<div class="form-block">
						<?php theme_language_switcher(); ?>
                      <div class="top-head-cart">
						<a href="/my-cart/"><img src="/wp-content/uploads/2018/05/shop.svg" alt="My Cart">
							<?php echo WC()->cart->get_cart_contents_count() ? WC()->cart->get_cart_contents_count() : ''; ?>
						</a>
					</div>  
					</div>

                    <?php if(has_nav_menu('top'))
                        wp_nav_menu( array(
                            'container' => false,
                            'theme_location' => 'top',
                            'depth' => 2,
                            'items_wrap' => '<nav class="add-nav"><ul>%3$s</ul></nav>',
                            'walker' => new Theme_Walker_Nav_Top)
                        );
                    ?>
				</div>
			</div>
			<!-- <div class="header-frame">
				<div class="container">
					<strong class="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?>. <?php bloginfo('description'); ?>.</a></strong>
				</div>
			</div> -->

            <?php if (has_nav_menu('main')) : ?>
			<nav class="nav-holder " id="myHeader">
				<div class="container">
					<div class="row">
						<div class="col-md-2 nv-logo">
							<strong class="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?>. <?php bloginfo('description'); ?>.</a></strong>
						</div>
						<div class="col-md-8">
						<div class="navbar navbar-default">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
								Menu
							</button>
							
							<div class="collapse navbar-collapse" id="main-nav">
                                <?php
                                    wp_nav_menu( array(
                                            'container' => false,
                                            'fallback_cb' => false,
                                            'theme_location' => 'main',
                                            'items_wrap' => '<ul id="nav">%3$s</ul>',
                                            'walker' => new Theme_Walker_Nav_Mega_Dropdown)
                                    );
                                ?>

                                <!-- Top Menu For Mobile Start -->
                                <div class="mobile-extened-menus">
							<div>
                                <?php if(has_nav_menu('top'))
			                        wp_nav_menu( array(
									    'container' => false,
								        'theme_location' => 'top',
										'depth' => 2,
						                'items_wrap' => '<nav class="add-nav"><ul>%3$s</ul></nav>',
					                    'walker' => new Theme_Walker_Nav_Top)
							        );
			                    ?>
							</div>
							<!-- Top Menu For Mobile End -->
							<!-- Language Selector and Cart icon with count start -->
							<div class="form-block">
								<?php theme_language_switcher(); ?>
								<div class="top-head-cart"><?php echo WC()->cart->get_cart_contents_count() ? WC()->cart->get_cart_contents_count() : ''; ?>
								<a href="/my-cart/">
									<img src="/wp-content/uploads/2018/05/shop.svg" alt="My Cart">
								</a>
							</div>
						</div>
							<!-- Language Selector and Cart icon with count start -->
							<!-- Footer Menu for Mobile start -->
							<?php if(has_nav_menu('footer_1')) : ?>
							    <div class="col-md-2 col-sm-2 col-xs-6">
							        <strong class="title"><?php theme_menu_name('footer_1'); ?></strong>
							        <?php wp_nav_menu( array(
							            'container' => false,
							            'fallback_cb' => false,
							            'theme_location' => 'footer_1',
							            'items_wrap' => '<ul class="footer-nav">%3$s</ul>',
							            'depth' => 1,
							        )); ?>
							    </div>
								<?php endif; ?>

								<?php if(has_nav_menu('footer_2')) : ?>
								<div class="col-md-2 col-sm-2 col-xs-6">
							        <strong class="title"><?php theme_menu_name('footer_2'); ?></strong>
							        <?php wp_nav_menu( array(
							            'container' => false,
										'fallback_cb' => false,
									    'theme_location' => 'footer_2',
								        'items_wrap' => '<ul class="footer-nav">%3$s</ul>',
							            'depth' => 1,
								    )); ?>
							    </div>
							<?php endif; ?>
							<!-- Footer Menu for Mobile end -->
						</div>
							</div>
							
						</div>
						</div>

						<div class="col-md-2 social-item-section">
							<div class="search-icon-section"><img src="/wp-content/uploads/2018/05/seach-1.svg">
								<?php get_search_form(); ?> </div>
							<div class="social-sharing"><img src="/wp-content/uploads/2018/05/share-white-1.svg"></div>
							<div class="header-social"><?php get_template_part('blocks/social-links'); ?></div>
						</div>

						<div class="open-search-form-mobile">
						<div class="form-mob-close"><img src="/wp-content/uploads/2018/06/close-white.svg"></div><?php get_search_form(); ?>
					</div>

					</div>
				</div>
			</nav>
            <?php endif; ?>
		</header>
		<main id="main" role="main">