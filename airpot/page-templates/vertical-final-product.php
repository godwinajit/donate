<?php 
/*
		Template Name:Vertical final product  Page
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
						<li><a href="#">Damping &amp; Shock Absorption</a></li>
						<li><a href="#">Airpot Precision Dashpots</a></li>
						<li><a href="#">Stock</a></li>
						<li class="active">2KS56 - Bore Size:</li>
					</ol>
					<nav class="sub-nav">
						<ul class="list-unstyled">
							<li class="active"><a href="#">2KS56</a></li>
							<li><a href="#">2KS95</a></li>
							<li><a href="#">2KS160</a></li>
							<li><a href="#">2KS240</a></li>
							<li><a href="#">2KS325</a></li>
							<li><a href="#">2KS444</a></li>
						</ul>
					</nav>
					<div class="product-section row">
						<div class="col-sm-7">
							<div class="slideshow carousel row" data-ride="carousel" id="slideshow" data-interval="false">
								<div class="col-sm-12 col-md-7">
									<div class="carousel-inner">
										<div class="item active">
											<a rel="lightbox[gallery1]" title="2KS56 - Bore Size: .220 (5.59 mm)" href="<?php echo get_template_directory_uri () ?>/images/img29.jpg"><img src="<?php echo get_template_directory_uri () ?>/images/img29.jpg" alt="image description"></a>
										</div>
										<div class="item">
											<a rel="lightbox[gallery1]" title="2KS56 - Bore Size: .220 (5.59 mm)" href="<?php echo get_template_directory_uri () ?>/images/img33.jpg"><img src="<?php echo get_template_directory_uri () ?>/images/img33.jpg" alt="image description"></a>
										</div>
										<div class="item">
											<a  rel="lightbox[gallery1]" title="2KS56 - Bore Size: .220 (5.59 mm)" href="<?php echo get_template_directory_uri () ?>/images/img29.jpg"><img src="<?php echo get_template_directory_uri () ?>/images/img29.jpg" alt="image description"></a>
										</div>
									</div>
								</div>
								<div class="col-sm-12 col-md-5">
									<div class="heading">
										<h2>2KS56 - Bore Size: .220" (5.59 mm)</h2>
									</div>
									<ol class="carousel-indicators">
										<li data-target="#slideshow" data-slide-to="0" class="active"><img src="<?php echo get_template_directory_uri () ?>/images/img32.jpg" alt="image description"></li>
										<li data-target="#slideshow" data-slide-to="1"><img src="<?php echo get_template_directory_uri () ?>/images/img31.jpg" alt="image description"></li>
										<li data-target="#slideshow" data-slide-to="2"><img src="<?php echo get_template_directory_uri () ?>/images/img30.jpg" alt="image description"></li>
									</ol>
								</div>
							</div>
							<div role="tabpanel" class="tabs-default">
								<ul class="nav nav-tabs same-holder" role="tablist">
									<li role="presentation" class="active"><a class="same-height" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab"><span>OVERVIEW</span></a></li>
									<li role="presentation"><a class="same-height" href="#tab-02" aria-controls="tab-02" role="tab" data-toggle="tab"><span>Mounting &amp; Handling Data</span></a></li>
									<li role="presentation"><a class="same-height" href="#tab-03" aria-controls="tab-03" role="tab" data-toggle="tab"><span>SPECIFICATIONS</span></a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="tab-01">
										<img src="<?php echo get_template_directory_uri () ?>/images/img28.jpg" alt="image description">
									</div>
									<div role="tabpanel" class="tab-pane" id="tab-02">
										<img src="<?php echo get_template_directory_uri () ?>/images/img19.jpg" alt="image description">
									</div>
									<div role="tabpanel" class="tab-pane" id="tab-03">
										<img src="<?php echo get_template_directory_uri () ?>/images/img28.jpg" alt="image description">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="panel panel-default">
								<div class="panel-heading ">
									CONFIGURE YOUR PART
								</div>
								<div class="panel-body">
									<div class="model-block">
										<div class="model-iframe">
											<img src="<?php echo get_template_directory_uri () ?>/images/img27.jpg" alt="image description">
										</div>
										<a href="#" class="btn btn-primary btn-lg">ADD TORFQ CART</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
		<?php get_footer ();?>