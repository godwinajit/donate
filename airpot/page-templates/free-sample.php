<?php 
/*
		Template Name:Free-sample Page
	*/
?>
	<?php get_header ();?>	
		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<div class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>Request a Free Sample - <span style="font-size:22px;">Feeling is Believing</span></h1>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p>Thank you for requesting a sample from Airpot Corporation. Please fill out the following form and we will send it to you shortly.</p>
							<div class="well text-center">
							  	<p><strong>Please note </strong>that Airpot provides the following standard configurations of its products as free samples. If your evaluation needs require any other configuration, please contact our sales department to make your request.</p>
							  	<!-- <button type="submit" class="btn btn-default">Contact Us</button> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-offset-2 col-sm-8">
							<?php echo do_shortcode( '[contact-form-7 id="70" title="Free Sample Form"]' );?>		
						</div>
					</div>
				</div>
			</div>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
		<?php get_footer ();?>