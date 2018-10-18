<?php
/**
 * Template Name: Download
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */
get_header(); ?>
<main id="main" role="main">
<section class="block download-section">
	<div class="container">
		<div class="heading-box">
			<div class="row">
				<div class="col-sm-7">
					<h1>10 Areas of Focus For Your Next Website Redesign</h1>
					<p>
						Access your offer by clicking the button to the right <span
							class="icon-arrow-right"></span>
					</p>
				</div>
				<div class="col-sm-5">
					<a href="#" class="btn btn-default btn-download">Download Now</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8">
				<div class="download-content">
					<h2>Let's talk about you marketing</h2>
					<p>We're great listeners. We want to hear about your challenges and
						determine how can help</p>
					<h4>What you can expect:</h4>
					<ul class="item-list">
						<li>A 30 minute phone conversation with one of our consultants</li>
						<li>An evalution of your current marketing strategy</li>
						<li>An analysis of your website</li>
						<li>Suggestions for improvement</li>
					</ul>
					<p>Request your free consultation and learn more about what we can
						do</p>
					<img src="<?php echo get_template_directory_uri () ?>/images/img-80.jpg" alt="image description" width="359"
						height="471" class="alignleft" />
				</div>
			</div>
			<div class="col-sm-4">
				<form action="#" class="get-form">
					<fieldset>
						<h4>
							<span>Schedule Your Free Assessment</span>
						</h4>
						<ul>
							<li><label for="fn">First name <span class="required">*</span> </label>
								<input type="text" class="form-control" id="fn" placeholder="">
							</li>
							<li><label for="ln">Last name <span class="required">*</span> </label>
								<input type="text" class="form-control" id="ln" placeholder="">
							</li>
							<li><label for="email">Email (<a href="#">Privacy Policy</a>) <span
									class="required">*</span> </label> <input type="email"
								class="form-control" id="email" placeholder="">
							</li>
							<li><label for="company">Company <span class="required">*</span>
							</label> <input type="text" class="form-control" id="company"
								placeholder="">
							</li>
							<li><label for="role">Role/title <span class="required">*</span>
							</label> <select id="role">
									<option value="">- Please Select -</option>
									<option value="">- option 1 -</option>
									<option value="">- option 2 -</option>
							</select>
							</li>
							<li><label for="web">Website <span class="required">*</span> </label>
								<input type="text" class="form-control" id="web" placeholder="">
							</li>
							<li><label for="phone">Phone <span class="required">*</span> </label>
								<input type="tel" class="form-control" id="phone" placeholder="">
							</li>
							<li><label for="industry">Industry classification <span
									class="required">*</span> </label> <select id="industry">
									<option value="">- Please Select -</option>
									<option value="">- option 1 -</option>
									<option value="">- option 2 -</option>
							</select>
							</li>
							<li><label for="employees">Number of Employees</label> <select
								id="employees">
									<option value="">- Please Select -</option>
									<option value="">- option 1 -</option>
									<option value="">- option 2 -</option>
							</select>
							</li>
							<li><label for="solution">Using a marketing automation solution?</label>
								<select id="solution">
									<option value="">- Please Select -</option>
									<option value="">- option 1 -</option>
									<option value="">- option 2 -</option>
							</select>
							</li>
							<li><label for="msg">What are Your Marketing Aspirations ? <span
									class="required">*</span> </label> <textarea id="msg" cols="30"
									rows="10"></textarea>
							</li>
						</ul>
						<button type="submit" class="btn btn-default btn-get">Request
							Consultation</button>
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