<?php
/**
 * Template Name: Individual Resource
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MindTrust Labs</title>
	<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-180x180-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-152x152-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-144x144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-120x120-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-76x76-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-57x57-precomposed.png">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon.png">
	<link rel="icon" sizes="192x192" href="<?php echo get_template_directory_uri () ?>/images/touch-icon-192x192.png">
	<link rel="icon" sizes="128x128" href="<?php echo get_template_directory_uri () ?>/images/touch-icon-128x128.png">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri () ?>/images/apple-touch-icon-144x144-precomposed.png">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,900,700%7CRoboto+Slab:400,300,100%7COpen+Sans:400,300italic,300,400italic,600' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/fancybox.css">
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/jsf.css">
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri () ?>/css/all.css">
	<script type='text/javascript'>
		(function (d, t) {
		  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
		  bh.type = 'text/javascript';
		  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=0numk2ypnwocsqgwydt7jw';
		  s.parentNode.insertBefore(bh, s);
		  })(document, 'script');
	</script>
</head>
<body>
<div id="wrapper" class="individual">
<div class="top-section">
	<div class="video-section">
		<div class="holder">
			<div class="frame">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<a class="navbar-brand" href="#"><img src="<?php echo get_template_directory_uri () ?>/images/logo.svg"
								alt="image description" /> </a>
							<div class="title-holder">
								<h1>10 Areas of Focus For Your Next Website Redisign</h1>
								<a href="#ebook-content" class="btn btn-default btn-download">Free Download</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="video-frame">
			<div class="video-box" data-width="720" data-height="406">
				<video class="mejs-wmp" width="720" height="406" controls="none"
					preload="none"
					poster="<?php the_field('thumbnail_of_video'); ?>"
					autoplay="autoplay" loop="loop">
					    <source src="<?php the_field('mp4_video_url'); ?>" />
						<source src="<?php the_field('webm_video_url'); ?>" />
						<source src="<?php the_field('ogv_video_url'); ?>" />
				</video>
			</div>
			<!-- <div class="img-placeholder" data-width="720" data-height="406">
<img src="images/img-video-01.jpg" alt="image description" width="1400" height="538" />
</div> -->
		</div>
	</div>
</div>
<main id="main" role="main">
<section class="block individual-section">
	<div class="container" id="ebook-content">
		<div class="row">
			<div class="col-sm-7">
				<h3>There's a lot that goes into making a website great.</h3>
				<p>People's shopping begavior revoles completly around online
					experience</p>
				<p>But what exactly goes into that? Is great design? Functionality?
					Conversion points?</p>
				<p>It's all of the above and more. Your website acts as your digital
					storefront, so it's critical that you don't overlook any one aspect
					of a redesigng.</p>
				<h4>This 10-step guide includes:</h4>
				<ul class="item-list">
					<li>Where you should be focusing your redesign efforts</li>
					<li>How to leverage your website increase conversions</li>
					<li>The benefits of redesiging on the HubSpot COS</li>
					<li>Examples of real COS website</li>
				</ul>
				<div class="share-block">
					<ul class="social">
						<li><span class='st_facebook_large'><span
								class="icon icon-facebook"></span> </span></li>
						<li><span class='st_twitter_large'><span class="icon icon-twitter"></span>
						</span></li>
						<li><span class='st_linkedin_large'><span
								class="icon icon-linkedin"></span> </span></li>
						<li><span class='st_googleplus_large'><span
								class="icon icon-google-plus"></span> </span></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-5">
				<form action="#" class="get-form">
					<fieldset>
						<h4>
							<span>Get Your Copy</span>
						</h4>
						<ul>
							<li><label for="fn">First name <span class="required">*</span> </label>
								<input type="text" class="form-control" id="fn">
							</li>
							<li><label for="ln">Last name <span class="required">*</span> </label>
								<input type="text" class="form-control" id="ln">
							</li>
							<li><label for="email">Email (<a href="#">Privacy Policy</a>) <span
									class="required">*</span> </label> <input type="email"
								class="form-control" id="email">
							</li>
							<li><label for="web">Website <span class="required">*</span> </label>
								<input type="text" class="form-control" id="web">
							</li>
							<li><label for="company">Company <span class="required">*</span>
							</label> <input type="text" class="form-control" id="company">
							</li>
							<li><label for="phone">Phone <span class="required">*</span> </label>
								<input type="tel" class="form-control" id="phone">
							</li>
							<li><label for="role">Role/title <span class="required">*</span>
							</label> <select id="role">
									<option value="">- Please Select -</option>
									<option value="">- option 1 -</option>
									<option value="">- option 2 -</option>
							</select>
							</li>
							<li><label for="industry">Industry classification <span
									class="required">*</span> </label> <select id="industry">
									<option value="">- Please Select -</option>
									<option value="">- option 1 -</option>
									<option value="">- option 2 -</option>
							</select>
							</li>
							<li><label for="msg">What is your biggest marketing challenege ?</label>
								<textarea id="msg" cols="30" rows="10"></textarea>
							</li>
							<li class="checkbox-row"><input type="checkbox" name="check"
								id="check"> <label for="check">Subscribe to the MindTrust Labs
									Blog</label>
							</li>
						</ul>
						<button type="submit" class="btn btn-default btn-get">Get It Now</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</section>
<div class="quote-block">
	<div class="holder">
		<blockquote class="quote">
			<q>“You see things with crisp, clear eyes and have enabled us to
				enter a new realm of professionalism. You have gone above and beyond
				to help us help others.”</q> <cite> Cheryl A. Trzcinski, CEO
				Master's Manna</cite>
		</blockquote>
		<div class="buttons-holder">
			<a href="https://www.mindtrustlabs.com/contact/"
				class="btn btn-default btn-contact">Contact Us</a>
		</div>
		<ul class="social-links">
			<li><a href="https://www.facebook.com/mindtrustlabs"><span
					class="icon icon-facebook"></span> </a></li>
			<li><a href="https://twitter.com/mindtrustlabs"><span
					class="icon icon-twitter"></span> </a></li>
			<li><a href="https://www.linkedin.com/company/mindtrust-labs"><span
					class="icon icon-linkedin"></span> </a></li>
			<li><a href="#"><span class="icon icon-rss"></span> </a></li>
		</ul>
	</div>
</div>
<?php get_footer();	?>
<script>
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
</script>