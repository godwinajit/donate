<?php 
/*
		Template Name:Sign-In / Register Page
	*/
?>
	<?php get_header ();?>	
		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="row"><div class="col-sm-12 text-center"><p>This area is provided for your convenience in the event we generate online price quotes, product sales, or make special offers of information or services for our registered customers. If you would like to take advantage of this feature, please complete the information below</p></div></div>
					<div class="sign-section">
						<span class="sep">or</span>
						<div class="row">
							<div class="col-sm-6">
								<div class="title">
									<h1 class="h3 text-uppercase">log in</h1>
								</div>
								
								<?php echo do_shortcode( '[wppb-login]' ); ?>								
							</div>
							<div class="col-sm-6">
								<div class="title">
									<h1 class="h3 text-uppercase">register</h1>
								</div>
								<?php echo do_shortcode( '[wppb-register]' ); ?>						
								<?php //echo poet_display(); ?>	
													
								
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
<?php get_footer ();?>