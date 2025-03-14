<?php 
/*
		Template Name:User Account
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
					<div class="headline text-uppercase">
						<h1>User Account</h1>
					</div>
					<div class="row">
						<div class="col-sm-9 col-sm-push-3" id="content">
		<?php echo pippin_show_error_messages(); ?>
							<div class="row content-section">
								<div class="col-md-6">
									<div class="form-heading">
										<span>General Information</span>									
										
									</div>
									<?php echo do_shortcode( '[additional_inforamtion_form]' ); ?>
								
								</div>
								<div class="col-md-6">
									<div class="form-heading">
										<span>Change Password</span>
									</div>
													<?php echo do_shortcode( '[password_form]' ); ?>
									
								</div>
							</div>
						</div>
						<aside class="col-sm-3 col-sm-pull-9">
							<nav class="add-nav">
								<ul class="list-unstyled">
									<li class="active"><a href="/useraccount">Personal Information</a></li>
									<li><a href="/address-book">Address Book</a></li>
									<li><a href="/checkout">RFQs Review</a></li>
								</ul>
							</nav>
						</aside>
					</div>
				</div>
			</section>
			<section class="contact-section">
				<div class="container">
					<div class="left-col">
						<h2>For more information on our pneumatic actuation products, <strong class="text-uppercase">Contact Us Today!</strong> Our experienced staff will provede you with the solution your project requires.</h2>
					</div>
					<a href="#" class="btn btn-info btn-wide">Contact Us</a>
				</div>
			</section>
		</main>
		<?php get_footer ();?>