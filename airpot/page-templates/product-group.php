<?php 
/*
		Template Name:Product Group Page
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
					<ol class="breadcrumb">
						<li><a href="#"><i class="icon-prev"></i> Product lines </a></li>
						<li><a href="#">Airpel Anti-Stiction Air Cylinders</a></li>
						<li><a href="#">Metric Models</a></li>
						<li><a href="#">Double Acting</a></li>
						<li class="active">E9 Double Acting</li>
					</ol>
					<div class="product-section">
							<div class="row">
								<article class="product col-sm-6">
									<div class="img-holder">
										<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img33.jpg" alt="image description" width="370" height="137"> </a>
									</div>
									<div class="content">
										<span class="position">Front Stud Mount</span>
										<h2> <a href="#">Model: E9DN </a> </h2>
										<a href="#" class="btn btn-primary">Build Your Part</a>
									</div>
								</article>
								<article class="product col-sm-6">
									<div class="img-holder">
										<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img33.jpg" alt="image description" width="370" height="137"> </a>
									</div>
									<div class="content">
										<span class="position">Front Stud Mount</span>
										<h2> <a href="#">Model: E9DN </a> </h2>
										<a href="#" class="btn btn-primary">Build Your Part</a>
									</div>
								</article>
							</div>
							<div class="row">
								<article class="product col-sm-6">
									<div class="img-holder">
										<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img33.jpg" alt="image description" width="370" height="137"> </a>
									</div>
									<div class="content">
										<span class="position">Front Stud Mount</span>
										<h2> <a href="#">Model: E9DN </a> </h2>
										<a href="#" class="btn btn-primary">Build Your Part</a>
									</div>
								</article>
								<article class="product col-sm-6">
									<div class="img-holder">
										<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/img33.jpg" alt="image description" width="370" height="137"> </a>
									</div>
									<div class="content">
										<span class="position">Front Stud Mount</span>
										<h2> <a href="#">Model: E9DN </a> </h2>
										<a href="#" class="btn btn-primary">Build Your Part</a>
									</div>
								</article>
							</div>
					</div>
				</div>
			</div>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
		<?php get_footer ();?>