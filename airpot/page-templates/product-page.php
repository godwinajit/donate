<?php 
/*
		Template Name:Product Page
	*/
?>
	<?php get_header ();?>	
		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a>
			</div>
			<div class="main-section inner">
				<div class="container">
					<ol class="breadcrumb">
						<li><a href="#"><i class="icon-prev"></i> Product lines </a></li>
						<li><a href="#">Airpel Anti-Stiction Air Cylinders</a></li>
						<li><a href="#">Metric Models</a></li>
						<li><a href="#">Double Acting</a></li>
						<li><a href="#">E9 Double Acting</a></li>
						<li class="active">Product</li>
					</ol>
					<div class="product-section row single-product">
						<div class="col-sm-3">
							<div class="slideshow carousel row" data-ride="carousel" id="slideshow" data-interval="false">
								<div class="col-sm-12">
									<div class="carousel-inner">
										<div class="item active">
											<a data-rel="lightbox[gallery1]" title="Model: E9DD" href="<?php echo get_template_directory_uri () ?>/images/img29.jpg"><img src="<?php echo get_template_directory_uri () ?>/images/img29.jpg" alt="image description"></a>
										</div>
										<div class="item">
											<a data-rel="lightbox[gallery1]" title="Model: E9DD" href="<?php echo get_template_directory_uri () ?>/images/img33.jpg"><img src="<?php echo get_template_directory_uri () ?>/images/img33.jpg" alt="image description"></a>
										</div>
										<div class="item">
											<a  data-rel="lightbox[gallery1]" title="Model: E9DD" href="<?php echo get_template_directory_uri () ?>/images/img29.jpg"><img src="<?php echo get_template_directory_uri () ?>/images/img29.jpg" alt="image description"></a>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<ol class="carousel-indicators">
										<li data-target="#slideshow" data-slide-to="0" class="active"><img src="<?php echo get_template_directory_uri () ?>/images/img32.jpg" alt="image description"></li>
										<li data-target="#slideshow" data-slide-to="1"><img src="<?php echo get_template_directory_uri () ?>/images/img31.jpg" alt="image description"></li>
										<li data-target="#slideshow" data-slide-to="2"><img src="<?php echo get_template_directory_uri () ?>/images/img30.jpg" alt="image description"></li>
									</ol>
								</div>
							</div>
							<div class="row">
								<div class="hidden-xs col-sm-12">
									<img src="<?php echo get_template_directory_uri () ?>/images/img37.jpg" height="391" width="291" alt="">
								</div>
							</div>
						</div>
						<div class="col-sm-5">
							<span class="position">Airpel Double-Acting Double Rod End</span>
							<h2><a href="#">Model: E9DD</a></h2>
							<div role="tabpanel" class="tabs-default">
								<ul class="nav nav-tabs same-holder" role="tablist">
									<li role="presentation" class="active"><a class="same-height" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab"><span>Specifications</span></a></li>
									<li role="presentation"><a class="same-height" href="#tab-02" aria-controls="tab-02" role="tab" data-toggle="tab"><span>Performance</span></a></li>
									<li role="presentation"><a class="same-height" href="#tab-03" aria-controls="tab-03" role="tab" data-toggle="tab"><span>Mounting Data</span></a></li>
									<li role="presentation"><a class="same-height" href="#tab-04" aria-controls="tab-03" role="tab" data-toggle="tab"><span>Related Files</span></a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="tab-01">
										<img src="<?php echo get_template_directory_uri () ?>/images/img28.jpg" alt="image description">
									</div>
									<div role="tabpanel" class="tab-pane" id="tab-02">
										<strong class="info-note">Pressure Range</strong>
										<p>Full vacuum-125 psi. (0.86 MPa)</p>
										<strong class="info-note">Force Factor</strong>
										<table class="table inner">
											<tbody><tr>
												<th>Dashpots</th>
												<th>Actuators</th>
												<th>Airpels</th>
											</tr>
											<tr>
												<td><a class="link" href="#">160</a> A 1.00 F 2.50</td>
												<td><a class="link" href="#">160 A 1.00</a> F 2.50 P</td>
												<td><a class="link" href="#">E9D</a> 1.0 U</td>
											</tr>
											<tr>
												<td><a class="link" href="#">2K160</a> A 1.00 F 2.50</td>
												<td><a class="link" href="#">2K160P</a> 1.00 F 2.50</td>
												<td><a class="link" href="#">M9D</a> 1.0 U</td>
											</tr>
											<tr>
												<td><a class="link" href="#">2KS160</a> A 1.00 F 2.50</td>
												<td><a class="link" href="#">2KS160P</a> A 1.00 F 2.50</td>
												<td></td>
											</tr>
										</tbody>
									</table>
									<strong class="info-note">Minimum Pressure Differential</strong>
									<p>Required for Actuation .05 psi. (345 Pa)</p>
									<strong class="info-note">Maximum Leak Rate Under Pressure</strong>
									<ul class="list-unstyled">
										<li>.19 SL/min @65 psi(0.45 MPa)</li>
										<li>.57 SL/min @125 psi(0.86 MPa)</li>
									</ul>
									<strong class="info-note">Friction</strong>
									<ul class="list-unstyled">
										<li>Coefficient: .2</li>
										<li>Force without side load: typically .5% - 1.5% of load</li>
									</ul>
									<strong class="info-note">Operating Temperature Range</strong>
									<ul class="list-unstyled">
										<li>-55°C to +150°C</li>
										<li>If operating at temperatures above</li>
										<li>+70°C, please advise factory.</li>
									</ul>
									</div>
									<div role="tabpanel" class="tab-pane" id="tab-03">
										<img src="<?php echo get_template_directory_uri () ?>/images/img28.jpg" alt="image description">
									</div>
									<div role="tabpanel" class="tab-pane" id="tab-04">
										<img src="<?php echo get_template_directory_uri () ?>/images/img19.jpg" alt="image description">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
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
					<div class="panel panel-default">
						<div class="panel-heading ">
							ALSO WE RECOMMEND
						</div>
						<div class="carousel-nav inner">
							<div class="mask-inner">
								<div class="slideset-inner">
									<div class="slide-inner">
										<a href="#"><img src="<?php echo get_template_directory_uri () ?>/images/img26.jpg" alt="image description" width="257" height="162"></a>
									</div>
									<div class="slide-inner">
										<a href="#"><img src="<?php echo get_template_directory_uri () ?>/images/img26.jpg" alt="image description" width="257" height="162"></a>
									</div>
									<div class="slide-inner">
										<a href="#"><img src="<?php echo get_template_directory_uri () ?>/images/img26.jpg" alt="image description" width="257" height="162"></a>
									</div>
									<div class="slide-inner">
										<a href="#"><img src="<?php echo get_template_directory_uri () ?>/images/img26.jpg" alt="image description" width="257" height="162"></a>
									</div>
									<div class="slide-inner">
										<a href="#"><img src="<?php echo get_template_directory_uri () ?>/images/img26.jpg" alt="image description" width="257" height="162"></a>
									</div>
									<div class="slide-inner">
										<a href="#"><img src="<?php echo get_template_directory_uri () ?>/images/img26.jpg" alt="image description" width="257" height="162"></a>
									</div>
									<div class="slide-inner">
										<a href="#"><img src="<?php echo get_template_directory_uri () ?>/images/img26.jpg" alt="image description" width="257" height="162"></a>
									</div>
									<div class="slide-inner">
										<a href="#"><img src="<?php echo get_template_directory_uri () ?>/images/img26.jpg" alt="image description" width="257" height="162"></a>
									</div>
								</div>
							</div>
							<a class="button-prev" href="#"><i class="fa fa-chevron-left"></i></a>
							<a class="button-next" href="#"><i class="fa fa-chevron-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
			<?php get_footer ();?>