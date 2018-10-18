<?php
/**
 * Template Name: About
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */
get_header(); ?>
<div class="top-section contact">
	<div class="video-section">
		<div class="holder inner">
			<div class="container">
				<div class="row">
					<h1>WHAT WE DO</h1>
					<hr>
					<h2>First we build brands. Then we set them up for success.</h2>
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
<section class="about-blocks">
	<div class="container">
		<div class="row same-height-holder">
			<div class="col-sm-6">
				<div class="box">
                    <strong class="name">It starts with big ideas</strong>
					<div class="icon-box same-height">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/new_Branding-01.png" alt="image description" width="117" height="73" />
					</div>
					<h3>Strategy &amp; Brand Building</h3>
					<p>Brand Identity Creation, Strategic Research, &amp; Competitive Analysis</p>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box">
                    <strong class="name">That we bring to life</strong>
					<div class="icon-box same-height">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/small_ui.png"
							alt="image description" width="115" height="78" />
					</div>
					<h3>UI/UX Design &amp; Development</h3>
					<p>Websites, Mobile Apps, Software Products, &amp; Enterprise Platforms</p>
				</div>
			</div>
		</div>
		<span class="decor-line"> <span></span>
		</span>
		<div class="row same-height-holder">
			<div class="col-sm-6">
				<div class="box">
                     <strong class="name">And share with the world</strong>
					<div class="icon-box same-height">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/small_digital.png"
							alt="image description" width="130" height="48" />
					</div>
					<h3>Digital Marketing</h3>
					<p>Context Aware Mobile, Social, Email, Inbound Lead Generation, &amp; Content Solutions</p>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box">
                    <strong class="name">To grow your brand</strong>
					<div class="icon-box same-height">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/new_clapper-01.png"	alt="image description" width="79" height="78" />
					</div>
					<h3>Optimization &amp; Automation</h3>
					<p>SEO/SEM, Marketing Automation, Sales Enablement, &amp; CRM Integration</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="block branding">
	<div class="container">
		<h2>Your Digital Dream Team</h2>
		<div class="text-box">
							<h3>We are in this together.</h3>
							<hr>
							<div class="row">
								<div class="col-sm-12"><p>Each project we embark upon has a carefully assembled team, your “MindTrust”. Software projects are led by a product manager and marketing projects by a senior digital strategist who is as passionate about the project as you are. Based on your unique needs, we tap into our consortium of the world’s top analysts, creative directors, technologists, marketers, project managers, designers, and developers to assemble an All-Star team. We craft a custom process and set the bar high. Our clients expect great work, we expect more. Every pixel and line of code that we bring to life reflects who we are.</p></div>
							</div>
						</div>
		<!--<img
			src="<?php echo get_template_directory_uri () ?>/images/large_brand.png"
			alt="image description" width="400" height="240" class="aligncenter" />-->
		<div class="row" id="image_space_row">
			<div class="col-sm-6">
				<article>
					<h3>MindTrust by the Numbers</h3>
					<ul><li>Over a Decade of Experience</li>
						<li>Privately Held</li>
						<li>Worldwide Consortium of Top Talent</li>
						<li>50+ Agency Alliance Partners</li>
						<li>US Headquarters</li>
						<li>Hundreds of Successful Projects</li>
						<li>Millions of Lines of Code</li></ul>
				</article>
			</div>
			<div class="col-sm-6">
				<article>
					<h3>Core Areas of Expertise</h3>
					<ul>
						<li>Integrated Marketing Communications</li>
						<li>User Experience (UI / UX) Design</li>
						<li>Software Product Development</li>
						<li>Web &amp; Mobile App Development</li>
						<li>Emerging Technologies</li>
						<li>Open Source Frameworks &amp; Algorithms</li>
						<li>Cloud Computing &amp; Big Data</li></ul>
				</article>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="txt-box abtop">
					<h3>Technology Services</h3>
					<p>At MindTrust, we create beautiful software for companies around the world. From mobile apps and websites to enterprise-grade systems, we apply our expertise across domains, platforms and screens. We strive to create beautifully functional software. Our approach is based on the belief that technology and design should work together to deliver meaningful product experiences and digital business solutions.  From consumer-facing apps to enterprise technologies, your “MindTrust” is ready to solve problems and transform your business through software. Enterprises and startups rely on our proprietary agile development methodology to accelerate application delivery and launch innovative products.</p>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="txt-box abtop">
					<h3>Interactive Marketing</h3>
					<p>As digital platforms continue to redefine the broadcast model, consumers are more active than ever in their relationships with brands. Our data-driven approach addresses the unspoken needs of the end-user to drive value through engagement and participation. MindTrust Labs develops multi-channel campaigns that build brands and drive sales. Working across traditional and digital mediums, we are always focused on results-oriented programs and increasing the bottom line.</p>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="txt-box abtop last-tbox">
					<h3>Creative Services</h3>
					<p>Your brand is your business. MindTrust Labs brings your brand’s creative vision to life and translates it into world- class digital products, services, and campaigns. Our unique model brings an all-star team of creative professionals together to form your very own “MindTrust”. Through close collaboration, our creative team creates beautiful digital experiences and enhances your business by maintaining consistency throughout all of your marketing and branding initiatives.</p>
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
					<q>&quot;Mindtrust's ability to quickly synthesize needs and adapt on the fly, has been of particular use to our organization. I give them my highest recommendation.&quot;</q> <cite>Ian O'Brien - Director of Digital Marketing, Datto</cite>
				</blockquote>
			</div>
		</div>
	</div>
</section>
<div class="example3">
	<a href="/work" class="btn-circle">
		<div>
			See an <br> Example <br>
			<hr>
		</div>
	</a>
</div>
<section class="block family">	
	<div class="map-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-3 col-sm-12">
					<div class="txt-block">
						<h2>We're hiring</h2>
						<p>Are you passionate about design, development, or marketing? Do you always bring your A-game? Then we have a fun, creative, and diverse culture in which you can flourish.</p>
						<a href="<?php echo get_home_url(); ?>/careers" class="btn btn-default btn-careers">Careers at MindTrust Labs</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="quote-block">
	<div class="holder">
		<blockquote class="quote">
			<q>“Markets are changing faster than they ever have before.  To stay competitive, businesses today need to collaborate across disciplines, locations and organizations to invent the best solutions, faster.  Integrating multidimensional teams with agile software best-practices leads to new ideas and better products brought to market faster. We can build you a dream team, your “MindTrust”.</q>
			<cite>Chris Errato, Founder/President</cite>
		</blockquote>
		<div class="buttons-holder">
			<a href="http://www.mindtrustlabs.com/contact/"
				class="btn btn-default btn-contact">Learn How</a>
		</div>
		<!-- <ul class="social-links">
			<li><a href="https://www.facebook.com/mindtrustlabs"><span
					class="icon icon-facebook"></span> </a></li>
			<li><a href="https://twitter.com/mindtrustlabs"><span
					class="icon icon-twitter"></span> </a></li>
			<li><a href="https://www.linkedin.com/company/mindtrust-labs"><span
					class="icon icon-linkedin"></span> </a></li>
			<li><a href="#"><span class="icon icon-rss"></span> </a></li>
		</ul> -->
	</div>
</div>

<?php get_footer();	?>
		<!-- <ul class="social-links">
			<li><a href="https://www.facebook.com/mindtrustlabs"><span
					class="icon icon-facebook"></span> </a></li>
			<li><a href="https://twitter.com/mindtrustlabs"><span
					class="icon icon-twitter"></span> </a></li>
			<li><a href="https://www.linkedin.com/company/mindtrust-labs"><span
					class="icon icon-linkedin"></span> </a></li>
			<li><a href="#"><span class="icon icon-rss"></span> </a></li>
		</ul> -->
	</div>
</div>

<?php get_footer();	?>