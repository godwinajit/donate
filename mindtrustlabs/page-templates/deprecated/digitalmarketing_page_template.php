<?php
/**
 * Template Name: Digital marketing
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */
get_header(); ?>
<div class="top-section">
	<div class="video-section">
		<div class="holder inner">
			<div class="container">
				<div class="row">
					<h1>The perfect formula</h1>
					<hr>
					<h2>told through a comprehensive brand experience.</h2>
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
		</div>
	</div>
</div>
<main id="main" role="main">
<section id="solutions">
	<div class="head">
		<h2>Our Solar System of Solutions</h2>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="solutions-block">
					<div class="solutions-holder">
						<span class="solutions-circle"></span>
						<ul class="solutions-icons">
							<li class="strategy active"><a href="#strategy"><img
									src="<?php echo get_template_directory_uri () ?>/images/ico-1.svg" alt="image description" /> </a></li>
							<li class="build"><a href="#build"><img src="<?php echo get_template_directory_uri () ?>/images/ico-2.svg"
									alt="image description" /> </a></li>
							<li class="boost"><a href="#boost"><img src="<?php echo get_template_directory_uri () ?>/images/ico-3.svg"
									alt="image description" /> </a></li>
							<li class="conversion"><a href="#conversion"><img
									src="<?php echo get_template_directory_uri () ?>/images/ico-4.svg" alt="image description" /> </a></li>
							<li class="sales"><a href="#sales"><img src="<?php echo get_template_directory_uri () ?>/images/ico-5.svg"
									alt="image description" /> </a></li>
							<li class="analysis"><a href="#analysis"><img
									src="<?php echo get_template_directory_uri () ?>/images/ico-6.svg" alt="image description" /> </a></li>
						</ul>
						<div class="solutions-message">
							<div class="message-box" id="strategy">
								<div class="message-holder">
									<img class="ico ico-strategy" src="<?php echo get_template_directory_uri () ?>/images/ico-1.svg"
										alt="image description" />
									<h3>Marketing Strategy</h3>
									<p>Marketing is a necessary investment in the growth of your
										business, not an expense.</p>
								</div>
							</div>
							<div class="message-box" id="build">
								<div class="message-holder">
									<img class="ico ico-build" src="<?php echo get_template_directory_uri () ?>/images/ico-2.svg"
										alt="image description" />
									<h3>Build Web Presence</h3>
									<p>Marketing is a necessary investment in the growth of your
										business, not an expense.</p>
								</div>
							</div>
							<div class="message-box" id="boost">
								<div class="message-holder">
									<span class="ico ico-boost"></span> <img class="ico ico-boost"
										src="<?php echo get_template_directory_uri () ?>/images/ico-3.svg" alt="image description" />
									<h3>Boost Traffic</h3>
									<p>Marketing is a necessary investment in the growth of your
										business, not an expense.</p>
								</div>
							</div>
							<div class="message-box" id="conversion">
								<div class="message-holder">
									<span class="ico ico-conversion"></span> <img
										class="ico ico-conversion" src="<?php echo get_template_directory_uri () ?>/images/ico-4.svg"
										alt="image description" />
									<h3>Convert Traffic to Leads</h3>
									<p>Marketing is a necessary investment in the growth of your
										business, not an expense.</p>
								</div>
							</div>
							<div class="message-box" id="sales">
								<div class="message-holder">
									<span class="ico ico-sales"></span> <img class="ico ico-sales"
										src="<?php echo get_template_directory_uri () ?>/images/ico-5.svg" alt="image description" />
									<h3>Convert Leads to Sales</h3>
									<p>Marketing is a necessary investment in the growth of your
										business, not an expense.</p>
								</div>
							</div>
							<div class="message-box" id="analysis">
								<div class="message-holder">
									<span class="ico ico-analysis"></span> <img
										class="ico ico-analysis" src="<?php echo get_template_directory_uri () ?>/images/ico-6.svg"
										alt="image description" />
									<h3>Analysis &amp; Optimization</h3>
									<p>Marketing is a necessary investment in the growth of your
										business, not an expense.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="block case-studies">
	<div class="container">
		<h2>
			Case Studies &amp; Brain Dumps. <br> <a href="#">See all Articles
				here</a>
		</h2>
		<div class="row">
				<?php  
				$blogs_display= $myhubspotwp_blog->publish_blog();
				foreach($blogs_display as $blogpost):
				?>
					<div class="col-sm-4">
						<article class="event">
							<h3><a target="_blank" href="<?php echo $blogpost['published_url'];?>"><?php echo $blogpost['name'];?></a></h3>
							<p><?php echo $blogpost['post_summary'];?></p>
							<time datetime="<?php echo date('m/d/Y', $blogpost['updated']);?>"> <span class="icon icon-calendar"></span><?php echo human_time_diff( ( $blogpost['updated'] / 1000 ), current_time('timestamp') ).' ago - by '.$blogpost['blog_author']['full_name'];?></time>
						</article>						
					</div>					
				<?php endforeach;?>
				</div>
	</div>
</section>
<section class="promotions">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<article class="event">
					<span class="icon icon-rocket-01"></span>
					<ul>
						<li>From the beginning of the WP Ninjas branding project</li>
						<li>From the beginning of the WP Ninjas branding project</li>
						<li>From the beginning of the WP Ninjas branding project</li>
					</ul>
				</article>
			</div>
			<div class="col-sm-4">
				<article class="event">
					<span class="icon icon-gears-01-01"></span>
					<ul>
						<li>From the beginning of the WP Ninjas branding project</li>
						<li>From the beginning of the WP Ninjas branding project</li>
						<li>From the beginning of the WP Ninjas branding project</li>
					</ul>
				</article>
			</div>
			<div class="col-sm-4">
				<article class="event">
					<span class="icon icon-cart-01-01"></span>
					<ul>
						<li>From the beginning of the WP Ninjas branding project</li>
						<li>From the beginning of the WP Ninjas branding project</li>
						<li>From the beginning of the WP Ninjas branding project</li>
					</ul>
				</article>
			</div>
		</div>
	</div>
</section>
<section class="margin-bottom">
	<div class="section-head">
		<div class="container">
			<h2>Internet Marketing</h2>
		</div>
	</div>
	<div class="container">
		<div class="row padding-tb-sm">
			<div class="col-lg-10 col-lg-offset-1">
				<ul class="services-list">
					<li><span class="icon icon-img44"></span>
						<h3>
							Inbound Content Marketing
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-img45"></span>
						<h3>
							Search Engine Optimization
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-img46"></span>
						<h3>
							Local Listings Optimization
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-img47"></span>
						<h3>
							Email Marketing
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="margin-bottom">
	<div class="section-head">
		<div class="container">
			<h2>Social Media</h2>
		</div>
	</div>
	<div class="container">
		<div class="row padding-tb-sm">
			<div class="col-lg-10 col-lg-offset-1">
				<ul class="services-list">
					<li><span class="icon icon-img48"></span>
						<h3>
							<a href="#">Social Media Optimization</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-img49"></span>
						<h3>
							<a href="#">Social Media Advertising</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-img50"></span>
						<h3>
							<a href="#">Facebook Advertising</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-uniE607"></span>
						<h3>
							<a href="#">Twitter Advertising</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="margin-bottom">
	<div class="section-head">
		<div class="container">
			<h2>Online Advertising</h2>
		</div>
	</div>
	<div class="container">
		<div class="row padding-tb-sm">
			<div class="col-lg-10 col-lg-offset-1">
				<ul class="services-list">
					<li><span class="icon icon-img52"></span>
						<h3>
							<a href="#">Pay Per Click Advertising (PPC)</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><img class="icon" src="<?php echo get_template_directory_uri () ?>/images/img53.svg"
						alt="image description" />
						<h3>
							<a href="#">Retargeting</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-img54"></span>
						<h3>
							<a href="#">Video Ads</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-img55"></span>
						<h3>
							<a href="#">Mobile Advertising</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="margin-bottom">
	<div class="section-head">
		<div class="container">
			<h2>Conversion Optimization</h2>
		</div>
	</div>
	<div class="container">
		<div class="row padding-tb-sm">
			<div class="col-lg-10 col-lg-offset-1">
				<ul class="services-list">
					<li><span class="icon icon-img56"></span>
						<h3>
							<a href="#">Landing Page A/B Testing</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-img57"></span>
						<h3>
							<a href="#">CTA Development</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><img class="icon" src="<?php echo get_template_directory_uri () ?>/images/img58.svg"
						alt="image description" />
						<h3>
							<a href="#">Phone Call Tracking</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
					<li><span class="icon icon-img59"></span>
						<h3>
							<a href="#">Reporting & Analysis</a>
						</h3>
						<p>This is something about the services that we provide. If you
							would like to learn more,</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<div class="quote-block">
	<div class="holder">
		<blockquote class="quote">
			<q>â€œYou see things with crisp, clear eyes and have enabled us to
				enter a new realm of professionalism. You have gone above and beyond
				to help us help others.â€�</q> <cite> Cheryl A. Trzcinski, CEO
				Master's Manna</cite>
		</blockquote>
		<div class="buttons-holder">
			<a href="http://www.mindtrustlabs.com/contact/"
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