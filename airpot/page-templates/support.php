<?php 
/*
		Template Name:Support Page
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
						<h1>Support</h1>
					</div>
					<div class="row">
						<div class="col-sm-4 col-md-5 col-lg-4 col-sm-push-3">							
						</div>
						<div style="width:74%;height:auto;"class="col-sm-5 col-md-4 col-lg-5 col-sm-push-3">
							<iframe scrolling="no" src="<?php echo  get_home_url(); ?>/generate3d/MakeRapidPart.shtml" width="99%" height="600" style="border: 0px;"></iframe>
						</div>
						<aside class="col-sm-3 col-sm-pull-9">
							<?php wp_nav_menu(array(
							'container'       => 'nav',
							'container_class' => 'add-nav',
							'container_id'    => '',
								'menu' => 'Left Menu', 	
								'menu_class'      => 'list-unstyled'						
							)); ?>
						</aside>
					</div>
				</div>
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
		<?php get_footer ();?>