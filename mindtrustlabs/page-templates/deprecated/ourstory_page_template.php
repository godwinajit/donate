<?php
/**
 * Template Name: Our Story
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
					<h1>Fueled by Passion</h1>
					<hr>
					<h2>Culture, Values, &amp; Team.</h2>
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
			<!-- <div class="img-placeholder" data-width="720" data-height="406">
<img src="images/img-video-01.jpg" alt="image description" width="1400" height="538" />
</div> -->
		</div>
	</div>
</div>
<main id="main" role="main">
<section class="block family">
	<div class="container">
		<div class="txt-columns">
			<div class="row">
				<div class="col-sm-4">
					<div class="txt-box">
						<h3>Who we are</h3>
						<p>Focus Lab is a close team of creative professionals based out
							of Savannah, Ga. We are parents, musicians, gamers, runners,
							gardeners, friends, jokesters, and more. We are passionate about
							partnering with good people and organizations to produce
							exceptional work that betters the world around us.</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="txt-box">
						<h3>What we do</h3>
						<p>Our skills are specific and fine-tuned. We are specialists, not
							generalists. We create visual branding systems that enable
							organizations to put their best face forward to their audience.
							This includes everything from the logo, typography, and
							iconography to website design, app design, and website
							development.</p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="txt-box">
						<h3>Why we do it</h3>
						<p>That’s simple. We exist to create things that promote growth
							and enrich lives in organizations and communities. It isn’t
							enough to make something that looks good. We endeavor toward work
							that drives action, generates results, and makes for change.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<img src="<?php echo get_template_directory_uri () ?>/images/img-30.jpg" alt="image description" class="fullwidth"
		width="1600" height="743" />
</section>
<section class="block standards">
	<div class="container">
		<div class="row">
			<div class="columns">
				<div class="col-sm-6 column text-right">
					<div class="wrap">
						<h2>
							Our <br> Standards
						</h2>
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
						<article class="standard">
							<h3>Keep it Simple</h3>
							<h4>Because it is simple.</h4>
							<p>Our practices and solutions are simple, because simple = clear
								= understandable and executable. We apply this concept to every
								aspect of the business, from our office space to the services we
								offer. We also subscribe to the strength of simplicity when we
								design and write code.</p>
						</article>
						<article class="standard">
							<h3>Quality over Quantity</h3>
							<h4>Less is more.</h4>
							<p>Mental energy is a depletable bandwidth, so we concentrate our
								time and talent on fewer projects/clients. A greater investment
								on our part, but we’re not running a creative services puppy
								mill. Plus, prioritizing quality over quantity supports our
								other core values.</p>
						</article>
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
						<article class="standard">
							<h3>Keep it Real</h3>
							<h4>People are people.</h4>
							<p>And that’s how we treat them, regardless of rank or
								association. Everyone deserves respect, transparency, and
								honesty - the three pillars of our every interaction with
								colleagues and clients. Bonus: work, and life in general, will
								become easier and more productive.</p>
						</article>
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
		</div>
	</div>
	<img src="<?php echo get_template_directory_uri () ?>/images/img-31.jpg" alt="image description" class="fullwidth"
		width="1600" height="833" />
</section>
<section class="block environment">
	<div class="container">
		<div class="txt-box">
			<h2>Office Environment</h2>
			<hr>
			<p>Our work space represents our company values and aesthetic. Open,
				bright, and minimalistic, we designed it to foster collaboration and
				creativity on every level. Our furniture is on wheels and we can
				write on the walls (well, some of them) so the space evolves as our
				brainstorming dictates.</p>
		</div>
		<div class="slideshow">
			<div class="slideset">
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-32.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-33.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-34.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-35.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-36.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-37.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-38.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-39.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-40.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-41.jpg" alt="image description" width="1140"
						height="635" />
				</div>
				<div class="slide">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-42.jpg" alt="image description" width="1140"
						height="635" />
				</div>
			</div>
			<div class="pagination"></div>
		</div>
	</div>
</section>
<section class="block clients">
	<div class="container">
		<h2>Working with clients in…</h2>
		<ul class="flags">
			<li><img src="<?php echo get_template_directory_uri () ?>/images/flag_russia.svg" alt="image description" /> <span
				class="name">Russia</span>
			</li>
			<li><img src="<?php echo get_template_directory_uri () ?>/images/flag_australia.png" alt="image description"
				width="272" height="182" /> <span class="name">Australia</span>
			</li>
			<li><img src="<?php echo get_template_directory_uri () ?>/images/flag_england.svg" alt="image description" /> <span
				class="name">England</span>
			</li>
		</ul>
		<p>Although we’re located in little ol’ Savannah, Georgia, our work
			spans the globe. Conference calls with clients in faraway places are
			part of a normal day at the shop.</p>
	</div>
</section>
<section class="block team">
	<div class="container">
		<h2>Our Team</h2>
		<div class="team-holder">
			<div class="row">
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-43.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Erik Reagan</span> <span class="title">Co-Founder,
										Operations Director</span>
								</h3>
								<hr>
							</div>
							<p>If you’ve spoken to Erik Reagan for any length of time, you’ve
								heard him talk about his family. His beautiful wife and children
								are his world and he is a huge proponent of keeping business
								hours and leaving work at work. (His wife thinks that’s pretty
								cool.) Erik’s professional focus is centered around the
								architecture and planning of web projects. He leads the
								development team at Focus Lab and is an integral part of the
								ExpressionEngine community.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-twitter"></a></li>
							<li><a href="#" class="icon icon-git"></a></li>
							<li><a href="#" class="icon icon-linkedin"></a></li>
						</ul>
					</article>
				</div>
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-44.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Bill Kenney</span> <span class="title">Co-Founder,
										Brand Director</span>
								</h3>
								<hr>
							</div>
							<p>Bill Kenney’s unyielding passion for design began at a young
								age but has developed and honed over his decade in the industry.
								As a business owner, Bill has developed both the design acumen
								and business knowledge necessary for success. A natural, lively,
								and charismatic people person, Bill also focuses on the value of
								surrounding himself with great people, be it mentoring his team,
								or facilitating collaboration with awesome clientele.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-dribbble"></a></li>
							<li><a href="#" class="icon icon-twitter"></a></li>
							<li><a href="#" class="icon icon-linkedin"></a></li>
						</ul>
					</article>
				</div>
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-45.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Matt Yow</span> <span class="title">Lead
										Brand Designer, Typographer</span>
								</h3>
								<hr>
							</div>
							<p>Born and raised in Raleigh, North Carolina, Matt Yow grew up
								on Ninja Turtles, pizza, and rock and roll. Matt is a graduate
								of the Savannah College of Art and Design (SCAD) with a Bachelor
								of Fine Arts in Graphic Design. He joined Focus Lab in the
								summer of 2011 and is the senior brand designer on the team.</p>
						</a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-dribbble"></a></li>
							<li><a href="#" class="icon icon-twitter"></a></li>
							<li><a href="#" class="icon icon-linkedin"></a></li>
						</ul>
					</article>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-46.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Jonathan McGaha</span> <span class="title">Web
										Developer</span>
								</h3>
								<hr>
							</div>
							<p>An early bloomer, Jonathan McGaha has been developing websites
								since middle school. In high school, he was hired to do a
								website for a local TV station and realized development may be
								his career path. When Ryan Irelan released the Learning
								ExpressionEngine videos, everything finally clicked for
								Jonathan; he has used ExpressionEngine as his main CMS since.
								These days, he’s branching out more, learning other CMS's - like
								Pixel &amp; Tonic's Craft - and learning from Erik</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-twitter"></a></li>
							<li><a href="#" class="icon icon-git"></a></li>
						</ul>
					</article>
				</div>
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-47.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Alicja Colon</span> <span class="title">Photographer</span>
								</h3>
								<hr>
							</div>
							<p>Alicja Colon was immersed in design and business from an early
								age, owed to growing up in her father’s vinyl sign shop. After
								earning a BFA in graphic design, Alicja landed a job at a
								non-profit organization where she quickly realized that it was
								easier to create the photographic imagery that she needed than
								to find it. A passion was born.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-dribbble"></a></li>
							<li><a href="#" class="icon icon-twitter"></a></li>
						</ul>
					</article>
				</div>
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-48.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Charlie Waite</span> <span class="title">Interactive
										Director</span>
								</h3>
								<hr>
							</div>
							<p>Charlie Waite is a designer who works remotely from
								Birmingham, AL. A graduate of Ole Miss, where he played baseball
								and learned the ins & outs of design, he now specializes in Web
								and UI/UX design. After his professional baseball career ended,
								Charlie started his own company. He focused on helping small
								businesses with branding and web design needs, as well as the
								branding needs of athletes in the action sports world. In 2012,
								Charlie joined Focus Lab as the lead designer.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-dribbble"></a></li>
							<li><a href="#" class="icon icon-twitter"></a></li>
						</ul>
					</article>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-49.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Sam Stratton</span> <span class="title">Brand
										&amp; UI Designer</span>
								</h3>
								<hr>
							</div>
							<p>Sam joined the team in early 2013. He moonlights as a graphic
								design student at Savannah College of Art and Design (SCAD),
								finishing out his BFA in Graphic Design. Sam enjoys living in
								downtown Savannah, GA so he can ride his bike to work.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-dribbble"></a></li>
							<li><a href="#" class="icon icon-twitter"></a></li>
						</ul>
					</article>
				</div>
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-50.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Summer Teal Simpson</span> <span
										class="title">Brand Strategist, Copywriter/Editor</span>
								</h3>
								<hr>
							</div>
							<p>Southern native Summer Teal Simpson cut her eyeteeth on copy
								in 2006 while moonlighting after her 9-5 as a journalist for
								local publications. This gig eventually led to a sole focus on
								freelance journalism and copywriting. Her appetite whet for a
								creative career trajectory, she joined the team at Focus Lab in
								2013.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-dribbble"></a></li>
							<li><a href="#" class="icon icon-twitter"></a></li>
							<li><a href="#" class="icon icon-linkedin"></a></li>
						</ul>
					</article>
				</div>
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-51.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Myles Kedrowski</span> <span class="title">UI
										Designer</span>
								</h3>
								<hr>
							</div>
							<p>Coming ‘atcha from Minneapolis, Minnesota is Myles Kedrowski.
								Myles believes that content is king and that simplicity breeds
								beautiful design. He recognizes that the web is unnecessarily
								cluttered, that portraying content to the user can be achieved
								just as well - if not more effectively - through cleanliness and
								simple color reinforcement.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-dribbble"></a></li>
							<li><a href="#" class="icon icon-twitter"></a></li>
						</ul>
					</article>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-52.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Kellie Groover</span> <span class="title">Office
										Manager</span>
								</h3>
								<hr>
							</div>
							<p>Savannah native Kellie Groover joined the Focus Lab team in
								January of 2014. She started her college career at the Savannah
								College of Art and Design with a focus on 2D animation, but
								eventually obtained her BA in Communications with a Drawing
								minor from Georgia Southern University.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-twitter"></a></li>
							<li><a href="#" class="icon icon-linkedin"></a></li>
						</ul>
					</article>
				</div>
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-53.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Jonathan Howell</span> <span class="title">Brand
										Designer</span>
								</h3>
								<hr>
							</div>
							<p>Jonathan was born and raised in small, sunny Naples, Florida,
								just fifteen minutes from the Florida Everglades. Despite his
								warm-weather upbringing, he played five years of college ice and
								roller hockey for Florida Gulf Coast University; he graduated
								with a BS degree in marketing and advertising.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-dribbble"></a></li>
							<li><a href="#" class="icon icon-twitter"></a></li>
						</ul>
					</article>
				</div>
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-54.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Andy Fought</span> <span class="title">Developer</span>
								</h3>
								<hr>
							</div>
							<p>Andy Fought is a self taught front end developer going on 13
								years in the field. He has a passion for developing sites with
								clean, beautiful code. Professionally, Andy has had the pleasure
								of working on small-town small business websites, all the way up
								to a responsive redesign for a globally recognized news
								organization.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-twitter"></a></li>
							<li><a href="#" class="icon icon-git"></a></li>
							<li><a href="#" class="icon icon-linkedin"></a></li>
						</ul>
					</article>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<article class="box">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img-55.jpg" alt="image description"
							width="550" height="509" />
							<div class="heading">
								<h3>
									<span class="name">Will Kesling</span> <span class="title">Videographer</span>
								</h3>
								<hr>
							</div>
							<p>Will Kesling’s job is to make Focus Lab look good.
								Fortunately, he claims that’s not hard to do. Will is a student
								at SCAD studying graphic design but he wears the hat of
								videographer on the Focus team.</p> </a>
						<ul class="social-networks">
							<li><a href="#" class="icon icon-dribbble"></a></li>
							<li><a href="#" class="icon icon-twitter"></a></li>
						</ul>
					</article>
				</div>
			</div>
		</div>
	</div>
	<img src="<?php echo get_template_directory_uri () ?>/images/img-56.jpg" alt="image description" class="fullwidth" />
</section>

<div class="block quote-section different">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<blockquote class="quote">
					<q>“Focus Lab have the rare ability to translate complex ideas into
						simple and elegant designs, which constantly amaze us and our
						clients.”</q> <cite>Scott Burgess, CreateOne</cite>
				</blockquote>
			</div>
		</div>
	</div>
</div>
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