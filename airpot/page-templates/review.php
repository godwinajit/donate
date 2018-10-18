<?php 
/*
		Template Name:Review Page
	*/
?>
	<?php get_header ();?>	
		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
			<!--	<a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>User Account</h1>
					</div>
					<div class="row">
						<div class="col-sm-9 col-sm-push-3" id="content">
							<form role="form" class="form-product product-history">
								<div class="form-heading"> <span> My RFQ History </span> </div>
								<div class="row">
									<div class="col-sm-5 col-md-4 form-horizontal">
										<div class="form-group">
											<label for="sort" class="col-sm-4 control-label text-left">Sort by:</label>
											<div class="col-sm-8">
												<select name="sort" id="sort">
													<option value="Date">Date</option>
													<option value="Status">Status</option>
													<option value="Name">Name</option>
													<option value="Price">Price</option>
													<option value="Quantity">Quantity</option>
													<option value="Product Line">Product Line</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-sm-offset-2 col-sm-5 col-md-offset-4 col-md-4">
										<fieldset class="product-search" role="form">
											<div class="form-group">
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Search">
												<button type="submit" class="fa fa-search"></button>
											</div>
										</fieldset>
									</div>
								</div>
								<div class="row"> <div class="divider"></div> </div>
								<div class="form-heading hidden-xs">
									<div class="col-sm-2 col-md-4">Product</div>
									<div class="col-sm-2 col-md-1">Date</div>
									<div class="col-sm-2 col-md-2">RFQ Number </div>
									<div class="col-sm-2 col-md-1">Status</div>
									<div class="col-sm-2 col-md-1">Q-ty</div>
									<div class="col-sm-2 col-md-1">Price</div>
									<div class="hidden-xs hidden-sm col-sm-2 col-md-2">Action</div>
								</div>
								<article class="row product form-group text-center">
									<div class="img-holder hidden-sm col-sm-2">
										<a href="#"> <img width="370" height="137" alt="image description" src="<?php echo get_template_directory_uri () ?>/images/img33.jpg"> </a>
									</div>
									<div class="content col-sm-2">
										<span class="position">Airpel Double-Acting Double Rod End</span>
										<h2> <a href="#">Model: E9DD </a> </h2>
									</div>
									<div class="col-sm-2 col-md-1">28 July, 2014</div>
									<div class="col-sm-2 col-md-2"> 241 </div>
									<div class="col-sm-2 col-md-1">In Progress</div>
									<div class="col-sm-2 col-md-1">11</div>
									<div class="col-sm-2 col-md-1">--</div>
									<div class="col-sm-12 col-md-2 text-left">
										<a class="btn btn-default btn-sm inner" data-toggle="collapse" href="#collapseMore01" aria-expanded="false" aria-controls="collapseMore01">View</a>
										<a href="#" class="btn btn-primary btn-sm inner">Del</a>
									</div>
									<div class="col-sm-12 collapse taxt-left" id="collapseMore01">
										<div class="holder">
											<div class="form-horizontal taxt-left">
												<div class="form-group">
													<div class="col-sm-2 taxt-left">Comment: </div>
													<div class="col-sm-10 taxt-left">
														<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-2 taxt-left">Comment: </div>
													<div class="col-sm-8 taxt-left">
														<textarea name="Comment" ></textarea>
													</div>
													<div class="col-sm-2">
														<button type="submit" class="btn btn-default btn-sm">Send</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</article>
								<article class="row product form-group text-center">
									<div class="img-holder hidden-sm col-sm-2">
										<a href="#"> <img width="370" height="137" alt="image description" src="<?php echo get_template_directory_uri () ?>/images/img33.jpg"> </a>
									</div>
									<div class="content col-sm-2">
										<span class="position">Airpel Double-Acting Double Rod End</span>
										<h2> <a href="#">Model: E9DD </a> </h2>
									</div>
									<div class="col-sm-2 col-md-1">28 July, 2014</div>
									<div class="col-sm-2 col-md-2"> 241 </div>
									<div class="col-sm-2 col-md-1">In Progress</div>
									<div class="col-sm-2 col-md-1">11</div>
									<div class="col-sm-2 col-md-1">--</div>
									<div class="col-sm-12 col-md-2 text-left">
										<a class="btn btn-default btn-sm inner" data-toggle="collapse" href="#collapseMore02" aria-expanded="false" aria-controls="collapseMore02">View</a>
										<a href="#" class="btn btn-primary btn-sm inner">Del</a>
									</div>
									<div class="col-sm-12 collapse taxt-left" id="collapseMore02">
										<div class="holder">
											<div class="form-horizontal taxt-left">
												<div class="form-group">
													<div class="col-sm-2 taxt-left">Comment: </div>
													<div class="col-sm-10 taxt-left">
														<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-2 taxt-left">Comment: </div>
													<div class="col-sm-8 taxt-left">
														<textarea name="Comment" ></textarea>
													</div>
													<div class="col-sm-2">
														<button type="submit" class="btn btn-default btn-sm">Send</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</article>
								<article class="row product form-group text-center">
									<div class="img-holder hidden-sm col-sm-2">
										<a href="#"> <img width="370" height="137" alt="image description" src="<?php echo get_template_directory_uri () ?>/images/img33.jpg"> </a>
									</div>
									<div class="content col-sm-2">
										<span class="position">Airpel Double-Acting Double Rod End</span>
										<h2> <a href="#">Model: E9DD </a> </h2>
									</div>
									<div class="col-sm-2 col-md-1">28 July, 2014</div>
									<div class="col-sm-2 col-md-2"> 241 </div>
									<div class="col-sm-2 col-md-1">In Progress</div>
									<div class="col-sm-2 col-md-1">11</div>
									<div class="col-sm-2 col-md-1">--</div>
									<div class="col-sm-12 col-md-2 text-left">
										<a class="btn btn-default btn-sm inner" data-toggle="collapse" href="#collapseMore03" aria-expanded="false" aria-controls="collapseMore03">View</a>
										<a href="#" class="btn btn-primary btn-sm inner">Del</a>
									</div>
									<div class="col-sm-12 collapse taxt-left" id="collapseMore03">
										<div class="holder">
											<div class="form-horizontal taxt-left">
												<div class="form-group">
													<div class="col-sm-2 taxt-left">Comment: </div>
													<div class="col-sm-10 taxt-left">
														<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-2 taxt-left">Comment: </div>
													<div class="col-sm-8 taxt-left">
														<textarea name="Comment" ></textarea>
													</div>
													<div class="col-sm-2">
														<button type="submit" class="btn btn-default btn-sm">Send</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</article>
								<article class="row product form-group text-center">
									<div class="img-holder hidden-sm col-sm-2">
										<a href="#"> <img width="370" height="137" alt="image description" src="<?php echo get_template_directory_uri () ?>/images/img33.jpg"> </a>
									</div>
									<div class="content col-sm-2">
										<span class="position">Airpel Double-Acting Double Rod End</span>
										<h2> <a href="#">Model: E9DD </a> </h2>
									</div>
									<div class="col-sm-2 col-md-1">28 July, 2014</div>
									<div class="col-sm-2 col-md-2"> 241 </div>
									<div class="col-sm-2 col-md-1">In Progress</div>
									<div class="col-sm-2 col-md-1">11</div>
									<div class="col-sm-2 col-md-1">--</div>
									<div class="col-sm-12 col-md-2 text-left">
										<a class="btn btn-default btn-sm inner" data-toggle="collapse" href="#collapseMore04" aria-expanded="false" aria-controls="collapseMore04">View</a>
										<a href="#" class="btn btn-primary btn-sm inner">Del</a>
									</div>
									<div class="col-sm-12 collapse taxt-left" id="collapseMore04">
										<div class="holder">
											<div class="form-horizontal taxt-left">
												<div class="form-group">
													<div class="col-sm-2 taxt-left">Comment: </div>
													<div class="col-sm-10 taxt-left">
														<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-2 taxt-left">Comment: </div>
													<div class="col-sm-8 taxt-left">
														<textarea name="Comment" ></textarea>
													</div>
													<div class="col-sm-2">
														<button type="submit" class="btn btn-default btn-sm">Send</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</article>
								<ul class="paging paging-post list-unstyled list-inline">
									<li class="prev"><a class="btn btn-primary btn-sm btn-prev" href="#"><span>Previous Page</span></a></li>
									<li><strong>1</strong></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li class="next"><a class="btn btn-primary btn-sm btn-next" href="#"> <span>Next Page</span> </a></li>
								</ul>
							</form>
						</div>
						<aside class="col-sm-3 col-sm-pull-9">
							<nav class="add-nav">
								<ul class="list-unstyled">
									<li><a href="#">Personal Information</a></li>
									<li><a href="#">Address Book</a></li>
									<li class="active"><a href="#">My RFQs</a></li>
								</ul>
							</nav>
						</aside>
					</div>
				</div>
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
		<?php get_footer ();?>