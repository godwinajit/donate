<?php 
/*
		Template Name:Request Quote Page
	*/
?>
	<?php get_header ();?>	
		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a>
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>Request for Quote Cart</h1>
					</div>
					<form role="form" class="form-product">
						<div class="form-heading other">
							<div class="col-sm-8 col-md-9">Product</div>
							<div class="col-sm-2 col-md-1">Q-ty</div>
							<div class="col-sm-2">Action</div>
						</div>
						<article class="row product form-group">
							<div class="img-holder col-sm-3">
								<a href="#"> <img width="370" height="137" alt="image description" src="<?php echo get_template_directory_uri () ?>/images/img33.jpg"> </a>
							</div>
							<div class="content col-sm-5 col-md-6">
								<span class="position">Airpel Double-Acting Double Rod End</span>
								<h2> <a href="#">Model: E9DD </a> </h2>
							</div>
							<div class="col-sm-2 col-md-1">
								<div class="form-group"><input type="number" class="form-control" placeholder="1"></div>
							</div>
							 <div class="col-sm-2">
							 	<a href="#" class="btn btn-default btn-sm">Remove</a>
							 </div>
						</article>
						<article class="row product form-group">
							<div class="img-holder col-sm-3">
								<a href="#"> <img width="370" height="137" alt="image description" src="<?php echo get_template_directory_uri () ?>/images/img33.jpg"> </a>
							</div>
							<div class="content col-sm-5 col-md-6">
								<h2> <a href="#">Model: E9DD </a> </h2>
							</div>
							<div class="col-sm-2 col-md-1">
								<div class="form-group"><input type="number" class="form-control" placeholder="1"></div>
							</div>
							 <div class="col-sm-2">
							 	<a href="#" class="btn btn-default btn-sm">Remove</a>
							 </div>
						</article>
						<article class="row product form-group">
							<div class="img-holder col-sm-3">
								<a href="#"> <img width="370" height="137" alt="image description" src="<?php echo get_template_directory_uri () ?>/images/img33.jpg"> </a>
							</div>
							<div class="content col-sm-5 col-md-6">
								<h2> <a href="#">Model: E9DD </a> </h2>
							</div>
							<div class="col-sm-2 col-md-1">
								<div class="form-group"><input type="number" class="form-control" placeholder="1"></div>
							</div>
							 <div class="col-sm-2">
							 	<a href="#" class="btn btn-default btn-sm">Remove</a>
							 </div>
						</article>
						<article class="row product form-group">
							<div class="img-holder col-sm-3">
								<a href="#"> <img width="370" height="137" alt="image description" src="<?php echo get_template_directory_uri () ?>/images/img33.jpg"> </a>
							</div>
							<div class="content col-sm-5 col-md-6">
								<h2> <a href="#">Model: E9DD </a> </h2>
							</div>
							<div class="col-sm-2 col-md-1">
								<div class="form-group"><input type="number" class="form-control" placeholder="1"></div>
							</div>
							 <div class="col-sm-2">
							 	<a href="#" class="btn btn-default btn-sm">Remove</a>
							 </div>
						</article>
						<div class="row form-footer">
							<div class="col-sm-2">
							 	<a href="#" class="btn btn-primary btn-sm btn-prev"><span>Back to Products</span></a>
							 </div>
							 <div class="col-sm-offset-2 col-sm-2 col-md-offset-4 col-md-2">
							 	<a href="#" class="btn btn-default btn-sm inner">Update Cart</a>
							 </div>
							<div class="col-sm-4 col-md-2">
								<div class="row">
									<label for="a5" class="col-sm-6 control-label">Total: </label>
									<div class="col-sm-6">
										<input type="text" id="a5" class="form-control" placeholder="1">
									</div>
								</div>
							</div>
							<div class="col-sm-2">
							 	<a href="#" class="btn btn-primary btn-sm">Review RFQ</a>
							 </div>
						</div>
					</form>
				</div>
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
		<?php get_footer ();?>