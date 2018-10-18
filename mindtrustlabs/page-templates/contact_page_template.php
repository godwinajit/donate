<?php
/**
 * Template Name: Contact 
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
						<h1>Ready to smoke the competition?</h1>
						<hr>
						<h2>Get in touch.</h2>
					</div>
				</div>
			</div>
			<div class="video-frame">
				<div class="video-box" data-width="720" data-height="406">
					<video class="mejs-wmp" width="720" height="406" controls="none" preload="none" poster="<?php the_field('thumbnail_of_video'); ?>" autoplay="autoplay" loop="loop">
						<source src="<?php the_field('mp4_video_url'); ?>" />
						<source src="<?php the_field('webm_video_url'); ?>" />
						<source src="<?php the_field('ogv_video_url'); ?>" />
					</video>
				</div>
				<!-- <div class="img-placeholder" data-width="720" data-height="406">
					<img src="<?php echo get_template_directory_uri () ?>/images/img-video-01.jpg" alt="image description" width="1400" height="538" />
				</div> -->
			</div>
		</div>
	</div>
	<main id="main" role="main">
		<section class="block contact-form-section">
			<div class="container">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				                <?php the_content(); ?>
				        <?php endwhile; ?>
			</div>
		</section>
		<section class="block contact-section">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 col-lg-8">
						<h3>New Business</h3>
						<p>Let's talk about what MindTrust Labs can do for your business. <br> <a href="mailto:&#115;&#097;&#108;&#101;&#115;&#064;&#109;&#105;&#110;&#100;&#116;&#114;&#117;&#115;&#116;&#108;&#097;&#098;&#115;&#046;&#099;&#111;&#109;" class="link">&#115;&#097;&#108;&#101;&#115;&#064;&#109;&#105;&#110;&#100;&#116;&#114;&#117;&#115;&#116;&#108;&#097;&#098;&#115;&#046;&#099;&#111;&#109;</a></p>
						<h3>Media/Press Inquiries</h3>
						<p>We review every inquiry we receive and will do our best to reply in a timely manner. Thanks! <br> <a href="mailto:&#109;&#101;&#100;&#105;&#097;&#064;&#109;&#105;&#110;&#100;&#116;&#114;&#117;&#115;&#116;&#108;&#097;&#098;&#115;&#046;&#099;&#111;&#109;" class="link">&#109;&#101;&#100;&#105;&#097;&#064;&#109;&#105;&#110;&#100;&#116;&#114;&#117;&#115;&#116;&#108;&#097;&#098;&#115;&#046;&#099;&#111;&#109;</a></p>
					</div>
					<div class="col-sm-5 col-lg-4">
						<dl class="contact-info">
							<dt>PHONE:</dt>
							<dd>(203) 780-8003</dd>
							<dt>Fax:</dt>
							<dd>(888) 588-3525</dd>
							<dt>Email:</dt>
							<dd><a href="mailto:&#105;&#110;&#102;&#111;&#064;&#109;&#105;&#110;&#100;&#116;&#114;&#117;&#115;&#116;&#108;&#097;&#098;&#115;&#046;&#099;&#111;&#109;">&#105;&#110;&#102;&#111;&#064;&#109;&#105;&#110;&#100;&#116;&#114;&#117;&#115;&#116;&#108;&#097;&#098;&#115;&#046;&#099;&#111;&#109;</a></dd>
							<dt>MAILING:</dt>
							<dd><address>228 Park Ave S #86988<br> New York, NY 10003-1502, USA</address></dd>
						</dl>
					</div>
				</div>
			</div>
			<? /* <div class="address-block">
				<?php $location = get_field('map_display');

if( !empty($location) ):
?>
<div class="acf-map">
	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
</div> 
<?php endif; ?>
			</div>*/ ?>
		</section>
		<div class="quote-block">
		<div class="holder">
			<blockquote class="quote">
				<q>“Mindtrust's ability to quickly synthesize needs and adapt on the fly, has been of particular use to our organization. I give them my highest recommendation.”</q>
	<cite>Ian O'Brien - Director of Digital Marketing, Datto</cite>
			</blockquote>
		</div>
	</div>
	<?php
		get_footer();
		?>