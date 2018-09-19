<?php 
/*
		Template Name:Videos Page
	*/
?>
	<?php get_header ();?>
		<main role="main" id="main">
			<div class="link-group inner">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri () ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>Support</h1>
					</div>
					<div class="row">
						<div class="col-sm-9 col-md-9 col-sm-push-3" id="content">
							<div class="content-section">
								<?php the_field('video_page_title');?>
								
							</div>
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
		<style>
	#fancybox-content{
		width:560px!important;
		height:340px!important;
	}
	#fancybox-close{
		right:-10px!important;
	}
	/*.icon-play {
	  /*left: 370px;*/
	  left:360px;
	  position: absolute;
	  top: 170px;
	}*/
	</style>
<?php get_footer ();?>