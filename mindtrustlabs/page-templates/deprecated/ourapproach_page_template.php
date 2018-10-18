<?php
/**
 * Template Name:Our approach process
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
					<h1>It's about a story</h1>
					<h2>told through a comprehensive brand experience.</h2>
				</div>
			</div>
		</div>
		<div class="video-frame">
			<div class="video-box hidden-xs" data-width="720" data-height="406">
				<video class="mejs-wmp" width="720" height="406" controls="none"
					preload="none"
					poster="<?php the_field('thumbnail_of_video'); ?>"
					autoplay="autoplay" loop="loop">
					<source src="<?php the_field('mp4_video_url'); ?>" />
					<source src="<?php the_field('webm_video_url'); ?>" />
					<source src="<?php the_field('ogv_video_url'); ?>" />
				</video>
			</div>
		       <div class="img-placeholder" data-width="720" data-height="406">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-video-01.jpg" alt="image description" width="1400" height="538" />
				</div>
		</div>
	</div>
</div>
<main id="main" role="main">
<section class="block family">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>
					Our <strong>"4D"</strong> Agile Development Process
				</h2>
				<div class="dev-holder">
					<div class="col-sm-6 col-md-5 col-lg-4">
						<div class="map">
							<img src="<?php echo get_template_directory_uri () ?>/images/none.gif" width="324" height="321" usemap="#map"
								alt="" />
							<ul>
								<li class="activestate" id="area1"><span
									class="icon icon-lightbulb-o"></span></li>
								<li id="area2"><span class="icon icon-paper-plane-o"></span></li>
								<li id="area3"><span class="icon icon-wrench"></span></li>
								<li id="area4"><span class="icon icon-brush"></span></li>
							</ul>
							<map class="dev-process" name="map" id="map">
								<area class="active" href="#" alt="area1" shape="poly"
									coords="44, 248, 34, 217, 32, 175, 51, 126, 85, 94, 122, 77, 159, 72, 202, 79, 221, 87, 202, 67, 166, 44, 126, 35, 81, 44, 40, 64, 11, 100, 1, 137, 4, 183, 14, 209" />
								<area href="#" alt="area2" shape="poly"
									coords="254, 276, 221, 302, 176, 320, 133, 319, 96, 305, 57, 269, 41, 223, 40, 174, 60, 129, 92, 98, 81, 132, 76, 178, 89, 225, 109, 249, 141, 276, 182, 290, 222, 287" />
								<area href="#" alt="area3" shape="poly"
									coords="286, 74, 316, 122, 323, 174, 308, 224, 273, 262, 227, 281, 180, 282, 148, 271, 118, 249, 96, 224, 129, 239, 171, 245, 204, 242, 238, 228, 263, 204, 286, 172, 294, 139, 293, 103" />
								<area href="#" alt="area4" shape="poly"
									coords="90, 38, 76, 42, 83, 32, 135, 6, 179, 1, 214, 9, 249, 29, 271, 63, 284, 102, 285, 136, 281, 160, 271, 182, 249, 209, 230, 225, 242, 194, 248, 149, 242, 114, 233, 91, 217, 68, 181, 44, 145, 31, 112, 31" />
							</map>
						</div>
					</div>
					<div class="dev-content col-sm-6 col-md-7 col-lg-8">
						<div>
							<p>The Discovery phase starts with the end goal. Are you looking
								to attract more leads? Have a more user friendly website? Climb
								the search engine ranks or develop a cross platform advertising
								campaign? We start with the goals, and our Digital Marketing
								Strategists, Business Analysts and Creative Directors create the
								roadmap to achieve them.</p>
							<h4>We Provide you with:</h4>
							<ul class="list-unstyled">
								<li>Digital Marketing Strategist</li>
								<li>Business Analyst</li>
								<li>Creative Director</li>
							</ul>
						</div>
						<div>
							<p>For most agencies, deployment means pushing a website from the
								testing environment to a live state. At Mindtrust, deployment
								means the commencement of the strategic digital marketing plans
								that were formulated during the discovery phase. Throughout
								design and development our marketing team prepares for launch so
								the marketing and sales funnels are ready to be filled as soon
								as it's live.</p>
							<h4>We Provide you with:</h4>
							<ul class="list-unstyled">
								<li>SEO/SEM Specialist</li>
								<li>Content Creators</li>
								<li>Marketing Director</li>
								<li>Social Media Expert / Community</li>
								<li>Manager</li>
								<li>Webmaster (maintenance)</li>
							</ul>
						</div>
						<div>
							<p>Mindtrust Labs employs an agile development strategy across
								all software development projects. Agile affords product teams
								the necessary freedom to make changes to a product once
								development has begun in order to adapt to changing market
								conditions and to incorporate insights that are gleaned during
								the development effort. It also provides the ability to scale
								teams more effectively and collaborate more clearly with
								distributed teams.</p>
							<h4>We Provide you with:</h4>
							<ul class="list-unstyled">
								<li>Fronted Developers</li>
								<li>Backend Developers</li>
								<li>Database Architects</li>
								<li>OA Engineers</li>
							</ul>
						</div>
						<div>
							<blockquote class="quote">
								<q>"Design is not just what it looks like and feels like. Design
									is how it works."</q> <cite>Steve Jobs</cite>
							</blockquote>
							<p>Whether it's in software or product, the importance of shaping
								user behavior through design cannot be understated. At Mindtrust
								Labs, we are constantly pushing the boundaries in order enhance
								the end user experience.</p>
							<h4>We Provide you with:</h4>
							<ul class="list-unstyled">
								<li>UI/UX Designer</li>
								<li>Graphic Designer</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="content family white-txt box-blue visual">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="block-area white-txt">
					<blockquote class="quote">
						<q>"Thank you so much for creating me my beautiful site! I really appreciate all the hard work you and your team put in to make my website as wonderful as it is!."</q> <cite>Lauren Cecchi,  CEO Lauren Cecchi New York</cite>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="block standards process">
	<div class="container">
		<div class="row">
			<div class="columns">
				<div class="col-sm-6 column text-right">
					<div class="wrap">
						<div class="heading">
							<h2>
								Discover <span class="icon icon-lightbulb-o"></span>
							</h2>
						</div>
						<article class="standard">
							<h3>People over Profits</h3>
							<h4>It ain’t about the Benjamins.</h4>
							<p>Relationships are our gold standard. We want to work with
								awesome people. Because, for us, success is measured by positive
								experiences, not the bottom line. As such, we strive to surround
								ourselves with both smart and passionate team members and
								clients, those who will grow our minds and hearts and not just
								our wallets.</p>
						</article>
					</div>
				</div>
				<div class="col-sm-6 column">
					<div class="wrap">
						<div class="heading"></div>
						<article class="standard">
							<h3>Make it Better</h3>
							<h4>There’s always room for improvement.</h4>
							<p>This value remains continuous in our thoughts, a defined
								intention across all touchpoints of our organization. The carrot
								that drives our decision-making and, ultimately, our end
								product, this objective also waxes personal, stoking our
								internal flames. Because each one of us accepted the open-ended
								challenge to keep climbing the ladder to greatness.</p>
						</article>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="col-sm-6 column text-right">
					<div class="wrap">
						<div class="heading"></div>
						<article class="standard">
							<h3>Keep it Simple</h3>
							<h4>Because it is simple.</h4>
							<p>Our practices and solutions are simple, because simple = clear
								= understandable and executable. We apply this concept to every
								aspect of the business, from our office space to the services we
								offer. We also subscribe to the strength of simplicity when we
								design and write code.</p>
						</article>
					</div>
				</div>
				<div class="col-sm-6 column">
					<div class="wrap">
						<div class="heading">
							<h2>
								Design <span class="icon icon-brush"></span>
							</h2>
						</div>
						<article class="standard">
							<h3>Keep it Real</h3>
							<h4>People are people.</h4>
							<p>And that’s how we treat them, regardless of rank or
								association. Everyone deserves respect, transparency, and
								honesty - the three pillars of our every interaction with
								colleagues and clients. Bonus: work, and life in general, will
								become easier and more productive.</p>
						</article>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="col-sm-6 column text-right">
					<div class="wrap">
						<article class="standard">
							<h3>Quality over Quantity</h3>
							<h4>Less is more.</h4>
							<p>Mental energy is a depletable bandwidth, so we concentrate our
								time and talent on fewer projects/clients. A greater investment
								on our part, but we’re not running a creative services puppy
								mill. Plus, prioritizing quality over quantity supports our
								other core values.</p>
						</article>
					</div>
				</div>
				<div class="col-sm-6 column">
					<div class="wrap">
						<article class="standard">
							<h3>Never Stop Learning</h3>
							<h4>Challenge yourself.</h4>
							<p>As children, we were force-fed education, but as we age, our
								academic interactions are less frequent. Unless you seek them
								out. We encourage our team to learn: to pursue their passions,
								listen to one another, and access new knowledge at conferences,
								the library, on blogs, and via other hands-on means. Oh, and to
								ask more questions.</p>
						</article>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="col-sm-6 column text-right">
					<div class="wrap">
						<div class="heading">
							<h2>
								Develop <span class="icon icon-wrench"></span>
							</h2>
						</div>
						<article class="standard">
							<h3>Ask more questions</h3>
							<h4>Demand better answers.</h4>
							<p>We believe that pushing the envelope helps to solidify and
								defend thoughts/concepts, and reshapes thinking. A strong idea
								or concept will withstand the stress test or will be better at
								the finish line for having undergone the scrutiny.</p>
						</article>
					</div>
				</div>
				<div class="col-sm-6 column">
					<div class="wrap">
						<div class="heading"></div>
						<article class="standard">
							<h3>NWork to Live</h3>
							<h4>Life comes first.</h4>
							<p>Work is only one piece in the personal pie chart of life, and
								we aim to keep it that way. Since we are only as strong as our
								people, we encourage them to work hard, play hard, and rest
								hard. Whenever possible, we help cultivate their passions. And
								we consider their interests and strengths when we take on jobs.
								After all, if you love what you do it’s never really work.</p>
						</article>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="col-sm-6 column text-right">
					<div class="wrap">
						<div class="heading"></div>
						<article class="standard">
							<h3>Keep it Simple</h3>
							<h4>Because it is simple.</h4>
							<p>Our practices and solutions are simple, because simple = clear
								= understandable and executable. We apply this concept to every
								aspect of the business, from our office space to the services we
								offer. We also subscribe to the strength of simplicity when we
								design and write code.</p>
						</article>
					</div>
				</div>
				<div class="col-sm-6 column">
					<div class="wrap">
						<div class="heading">
							<h2>
								Deploy <span class="icon icon-paper-plane-o"></span>
							</h2>
						</div>
						<article class="standard">
							<h3>Keep it Real</h3>
							<h4>People are people.</h4>
							<p>And that’s how we treat them, regardless of rank or
								association. Everyone deserves respect, transparency, and
								honesty - the three pillars of our every interaction with
								colleagues and clients. Bonus: work, and life in general, will
								become easier and more productive.</p>
						</article>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="col-sm-6 column text-right">
					<div class="wrap">
						<article class="standard">
							<h3>Quality over Quantity</h3>
							<h4>Less is more.</h4>
							<p>Mental energy is a depletable bandwidth, so we concentrate our
								time and talent on fewer projects/clients. A greater investment
								on our part, but we’re not running a creative services puppy
								mill. Plus, prioritizing quality over quantity supports our
								other core values.</p>
						</article>
					</div>
				</div>
				<div class="col-sm-6 column">
					<div class="wrap">
						<article class="standard">
							<h3>Never Stop Learning</h3>
							<h4>Challenge yourself.</h4>
							<p>As children, we were force-fed education, but as we age, our
								academic interactions are less frequent. Unless you seek them
								out. We encourage our team to learn: to pursue their passions,
								listen to one another, and access new knowledge at conferences,
								the library, on blogs, and via other hands-on means. Oh, and to
								ask more questions.</p>
						</article>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="col-sm-6 column text-right">
					<div class="wrap">
						<div class="heading">
							<h2>
								Promote <span class="icon icon-bullhorn"></span>
							</h2>
						</div>
						<article class="standard">
							<h3>Ask more questions</h3>
							<h4>Demand better answers.</h4>
							<p>We believe that pushing the envelope helps to solidify and
								defend thoughts/concepts, and reshapes thinking. A strong idea
								or concept will withstand the stress test or will be better at
								the finish line for having undergone the scrutiny.</p>
						</article>
					</div>
				</div>
				<div class="col-sm-6 column">
					<div class="wrap">
						<div class="heading"></div>
						<article class="standard">
							<h3>NWork to Live</h3>
							<h4>Life comes first.</h4>
							<p>Work is only one piece in the personal pie chart of life, and
								we aim to keep it that way. Since we are only as strong as our
								people, we encourage them to work hard, play hard, and rest
								hard. Whenever possible, we help cultivate their passions. And
								we consider their interests and strengths when we take on jobs.
								After all, if you love what you do it’s never really work.</p>
						</article>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="col-sm-6 column text-right">
					<div class="wrap">
						<article class="standard">
							<h3>Quality over Quantity</h3>
							<h4>Less is more.</h4>
							<p>Mental energy is a depletable bandwidth, so we concentrate our
								time and talent on fewer projects/clients. A greater investment
								on our part, but we’re not running a creative services puppy
								mill. Plus, prioritizing quality over quantity supports our
								other core values.</p>
						</article>
					</div>
				</div>
				<div class="col-sm-6 column">
					<div class="wrap">
						<article class="standard">
							<h3>Never Stop Learning</h3>
							<h4>Challenge yourself.</h4>
							<p>As children, we were force-fed education, but as we age, our
								academic interactions are less frequent. Unless you seek them
								out. We encourage our team to learn: to pursue their passions,
								listen to one another, and access new knowledge at conferences,
								the library, on blogs, and via other hands-on means. Oh, and to
								ask more questions.</p>
						</article>
					</div>
				</div>
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