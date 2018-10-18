<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Mindtrustlabs
 * @since Twenty Fourteen 1.0
 */
get_header ();
?>

<div class="top-section">
	<div class="video-section">
		<div class="holder">
			<div class="container">
				<div class="row">
					<h1>
						The Agency <br />of the <br />Future
					</h1>
					<strong><h2>At the core, we are a big ideas company. The products we build push the boundaries of innovation. Brands come to MindTrust Labs to turn their visions for the future into reality.</h2></strong><br />
					<a href="<?php echo get_home_url(); ?>/work"
						class="btn btn-default btn-see">See Work</a> <a
						href="<?php echo get_home_url(); ?>/contact"
						class="btn btn-default btn-see">Request quote</a>
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
		</div>
	</div>
</div>
<main id="main" role="main">
<section class="block services">
	<div class="container">
		<h2>From mindspace to cyberspace we empower businesses and brands.</h2>
		<div class="heading-icons">
			<span class="icon icon-brush"></span>
			<hr>
			<span class="icon icon-laptop"></span>
			<hr>
			<span class="icon icon-line-chart"></span>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<article>
					<h3>Design</h3>
					<p>How a brand is perceived by its target audience is crucial to the success of the products we create. Everything our art directors, graphic and UI/UX designers design for our clients is built with the end user in mind. Our clients walk away with brand guidelines, wireframes, and cutting-edge designs that inform the way your brand is perceived by current and future customers.</p>
					<a href="#" class="link-more">See Examples of Our Work</a>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Development</h3>
					<p>Our world class software engineers turn those beautiful designs into functional products. We've assembled a team of developers that are at the forefront of technological innovation, building everything from mobile apps and websites to complex databases with user-friendly business intelligence tools.</p>
					<a href="<?php echo get_home_url(); ?>/our-process"
						class="link-more">Learn More About Our Process</a>
				</article>
			</div>
			<div class="col-sm-4">
				<article>
					<h3>Marketing</h3>
					<p>Your product is built and ready to go - or your website just launched and you're ready to sell. How you share that information with the rest of the world could spell success or failure for your brand. With digital strategists, SEO/SEM experts, photographers, videographers, and marketing automation professionals on staff, we seamlessly integrate with your marketing team to help exceed objectives.</p>
                    <a href="<?php echo get_home_url(); ?>/digital-marketing"
						class="link-more">Did You Know We're HubSpot Partners?</a>
				</article>
			</div>
		</div>
	</div>
</section>
<section class="who" id="htmlCodeSection">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="card-html-code">
					<div class="front-image">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/card-html.jpg">
					</div>
					<div class="back-image">
						<img
							src="<?php echo get_template_directory_uri () ?>/images/card-html-code.jpg">
					</div>
					<div class="line hidden-xs"></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="txt-box">
					<h2>Turning Complex Systems</h2>
					<h3>Into Stunning Interfaces</h3>
					<p>At the onset of each project, we work with brands and businesses to understand their business goals and the desired journey of each target audience.</p>
					<p>Not only are the custom interfaces we build a reflection of our strategic findings - we build them in a way that you have complete control over each component once the work is complete. </p>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="block quote-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<blockquote class="quote">
					<q>“The new website looks great, what an improvement! You guys have
						done a fantastic job and I want to let you know how much it is
						appreciated.”</q> <cite>Bob Zaccardo, President Branded Tray</cite>
				</blockquote>
			</div>
		</div>
	</div>
</div>
<div class="view-work">
	<a href="<?php echo get_home_url(); ?>/work" class="btn-circle">
		<div>
			View <br> Work <br>
			<hr>
		</div>
	</a>
</div>
<section class="block companies">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				                <?php the_content(); ?>
				        <?php endwhile; ?>
		</section>
<section class="block case-studies">
	<div class="container">
		<h2>
			Case Studies &amp; Brain Dumps. <br> <a
				href="http://blog.mindtrustlabs.com">See all Articles here</a>
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
<div class="block twitter-section">
	<div class="container">
		<div class="col-sm-12">
			<div class="row">
				<div class="tweet">
					<blockquote class="twitter-tweet" lang="ru"><?php dynamic_sidebar( 'sidebar-twitter' ); ?></blockquote>
					<span class="icon icon-twitter"></span>
				</div>
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
					class="icon icon-facebook"></span></a></li>
			<li><a href="https://twitter.com/mindtrustlabs"><span
					class="icon icon-twitter"></span></a></li>
			<li><a href="https://www.linkedin.com/company/mindtrust-labs"><span
					class="icon icon-linkedin"></span></a></li>
			<li><a href="#"><span class="icon icon-rss"></span></a></li>
		</ul>
	</div>
</div>
		
		<?php
		get_footer();
		?>
