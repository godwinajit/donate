<?php
/**
 * Template Name: Services
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */

get_header(); ?>

<div class="top-section services">
	<div class="video-section">
		<div class="holder inner">
			<div class="container">
				<div class="row">
					<h1>What We Do</h1>
					<hr>
					<h2>First we build brands. Then we set them up for success.</h2>
				</div>
			</div>
		</div>
		<div class="video-frame">
			<div class="video-box" data-width="720" data-height="406">
				<video class="mejs-wmp" width="720" height="406" controls="none"
					preload="none" poster="<?php the_field('thumbnail_of_video'); ?>"
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
<section class="about-blocks">
	<div class="container">
		<div class="row same-height-holder">
			<div class="col-sm-6">
				<div class="box">
                    <strong class="name">It starts with big ideas.</strong>
					<div class="icon-box same-height">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/new_Branding-01.png" alt="image description" width="117" height="73" />
					</div>
					<h3>Strategy &amp; Brand Building</h3>
					<p>Brand Identity Creation, Strategic Research, Competitve Analysis</p>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box">
                    <strong class="name">We bring your ideas to life.</strong>
					<div class="icon-box same-height">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/small_ui.png"
							alt="image description" width="115" height="78" />
					</div>
					<h3>Design, UI/UX &amp; Development</h3>
					<p>We build digital interfaces - from websites and mobile apps to custom products and platforms.</p>
				</div>
			</div>
		</div>
		<span class="decor-line"> <span></span>
		</span>
		<div class="row same-height-holder">
			<div class="col-sm-6">
				<div class="box">
                     <strong class="name">We help share your ideas with the world.</strong>
					<div class="icon-box same-height">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/small_digital.png"
							alt="image description" width="130" height="48" />
					</div>
					<h3>Digital Marketing</h3>
					<p>Custom social promotions &amp; games, email marketing creation/development, social media strategy/management, inbound lead generation &amp; content creation.</p>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box">
                    <strong class="name">We use your ideas to grow your brand.</strong>
					<div class="icon-box same-height">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/new_clapper-01.png"	alt="image description" width="79" height="78" />
					</div>
					<h3>Optimization &amp; Automation</h3>
					<p>SEO/SEM management, Marketing Automation &amp; CRM integration, web/app maintenance.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="block quote-section blue">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<blockquote class="quote">
					<q>&quot;MindTrust Labs isn't just any old agency - we consider them to be partners. Whenever we need to update our existing products or build new ones, we go to MindTrust.&quot;</q> <cite>C Errato - MindTrust Labs</cite>
				</blockquote>
			</div>
		</div>
	</div>
</section>
<section class="block branding">
	<div class="container">
		<h2>It starts with big ideas.</h2>
		<img
			src="<?php echo get_template_directory_uri () ?>/images/large_brand.png"
			alt="image description" width="400" height="240" class="aligncenter" />
		<div class="row" id="image_space_row">
			<div class="col-sm-4">
				<article>
					<h3>Your Unique Voice</h3>
					<P>Digital noise is at an all-time high, making it increasingly more
                    difficult to target and captivate target audiences. MindTrust brand
                    strategists help you develop a unique voice so your big ideas are 
                    heard loud and clear.</P>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Ideation</h3>
					<p>Whether you're building a brand new product, overhauling an
                        old one or need something that is going to help you stand out, 
                        our job is to work with you to refine your ideas and ensure that 
                        whatever we create takes your brand to the next level.</p>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Strategy &amp; Research</h3>
					<p>For an advertising campaign, it's knowing what mediums are going to make 
                        the biggest impact. For a new software product, it's knowing how to build 
                    to optimize for user experience. The bottom line: we look at your goals and 
                        build a strategy around them - backed by research - to make sure you achieve them.</p>
				</article>
			</div>
		</div>
		
	</div>
</section>
<div class="examples">
	<a href="#" class="btn-circle">
		<div>
			Ideas Brought <br> To Life <br>
			<hr>
		</div>
	</a>
</div>
<section class="block web-experience">
	<div class="container">
		<h2>We bring your ideas to life.</h2>
		<img
			src="<?php echo get_template_directory_uri () ?>/images/large_ui.png"
			alt="image description" width="400" height="240" class="aligncenter" />
		<div class="row" id="image_space_row">
			<div class="col-sm-4">
				<article>
					<h3>UI/UX</h3>
					<P>The way in which users interact with your product is crucial 
                        to its success. Our interaction designers create unique experiences 
                        optimized for your audience that meet the needs of your business. Our goal is 
                    always to make products easy to use across every platform, regardless of how complex they may be.</P>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Design</h3>
					<p>Our award-winning designers mix art and science to create visually stunning 
                        products. We've designed logos that cause instant recognition, physical installations 
                    that embody a brand's philosphy, and digital products that push boundaries of design and technology, 
                    all while serving the needs of the brand.</p>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Development</h3>
					<p>Consumer and business technologies are changing faster than ever before. For 
                    our development teams, therein lies the opportunity. Clients come to MindTrust with 
                    big ideas - and our developers build the logic behind those ideas using scalable technologies 
                    that will stand the test of time.</p>
				</article>
			</div>
		</div>
		
	</div>
</section>

<div class="example3">
	<a href="#" class="btn-circle">
		<div>
			See an <br> Example <br>
			<hr>
		</div>
	</a>
</div>
<section class="block web-experience">
	<div class="container">
		<h2>We help share your ideas with the world.</h2>
		<img
			src="<?php echo get_template_directory_uri () ?>/images/large_digital.png"
			alt="image description" width="746" height="432" class="aligncenter" />
		<div class="row" id="image_space_row">
			<div class="col-sm-4">
				<article>
					<h3>Digital Marketing &amp; Advertising</h3>
					<P>In the digital age, the ways in which a brand can advertise are virtually 
                    endless. From online advertising opportunities to filming and editing commercials, 
                        brand videos and product demos, our job is to figure out which mediums are 
                        going to create the greatest impact, build what you need, and manage the growth of your campaigns. </P>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Social Virality</h3>
					<p>Social media isn't just about managing accounts anymore. It's about creating 
                    content - games, promotions, videos, and more - that are going to stick out above the 
                    clutter and get shared across the web. Our team is set up to share your camapigns with the 
                    rest of the world to make sure your brand is heard loud and clear.</p>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Inbound &amp; Lead Generation</h3>
					<p>When it comes to managing your Customer Journey, we stand by the Inbound Marketing 
                    philosophy - that customers need to be nutured through the sales cycle by receiving 
                    interesting and relevant content. All the tools you need to get in front of customers, 
                    including custom emails, social promotions, online ads, landing pages and more can be 
                    created and managed by MindTrust. MindTrust is an official agency partner of HubSpot.</p>
				</article>
			</div>
		</div>
	</div>
</section>

<div class="example2">
	<a href="#" class="btn-circle">
		<div>
			See an <br> Example <br>
			<hr>
		</div>
	</a>
</div>
<section class="block web-experience">
	<div class="container">
		<h2>We use your ideas to grow your brand.</h2>
		<img
			src="<?php echo get_template_directory_uri () ?>/images/large_optimization.png"
			alt="image description" width="746" height="432" class="aligncenter" />
		<div class="row" id="image_space_row">
			<div class="col-sm-4">
				<article>
					<h3>SEO / SEM Management</h3>
					<P>Our SEO and SEM teams stay on top of search trends so you don't have to. We ensure that 
                    your brand is following SEO best practices across all digital properties, and that you're employing 
                    the most modern SEM techniques to convert users into customers and getting the highest return on your investment possible.</P>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Marketing Automation / CRM</h3>
					<p>Many of the most successful businesses don't have alignment between marketing and sales 
                    teams. Our marketing automation and CRM experts do a deep dive into a client's marketing and sales 
                    cycles, audit software for best practices, make recommendations, and develop custom 
                    components as necessary to ensure optimization and scalibility. </p>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Maintenance</h3>
					<p>Many of our clients continue to work with MindTrust after a product launch  
                    to manage and maintain the product as it continues to evolve. Our maintenance packages 
                    allow clients access to different departments when they need them. </p>
				</article>
			</div>
		</div>
		
	</div>
</section>
<div class="example">
	<a class="btn-circle" href="#">
		<div>
			See an <br> Example <br>
			<hr>
		</div>
	</a>
</div>
<div class="quote-block">
	<div class="holder">
		<blockquote class="quote">
			<q>&quot;You see things with crisp, clear eyes and have enabled us to
				enter a new realm of professionalism. You have gone above and beyond
				to help us help others.&quot;</q> <cite> Cheryl A. Trzcinski, CEO
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
