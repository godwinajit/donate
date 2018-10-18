 <?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="page-error">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<h1>404, Run!!!</h1>
					<hr>
					<h2>Something went wrong...</h2>
					<div class="link-holder"><a href="<?php echo get_home_url(); ?>">Get me out of here <span class="icon-arrow-right"></span></a></div>
					<div class="txt-block">
						<h3>Don't worry, we'll get you where you need to go.</h3>
						<hr>
						<p>If you ended up here from a link in our site, please let us know by sending an email to <a href="mailto:&#104;&#101;&#108;&#112;&#64;&#109;&#105;&#110;&#100;&#116;&#114;&#117;&#115;&#116;&#108;&#97;&#98;&#115;&#46;&#99;&#111;&#109;">our team</a>.</p>
						<a href="/" class="btn btn-default">Home</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<main id="main" role="main">
			<?php
		get_footer();
		?>
		