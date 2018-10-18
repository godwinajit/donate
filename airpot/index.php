<?php get_header ();?>
<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines/"><span>Product Lines</span></a>
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<div class="main-section inner">
				<div class="container">
			 <?php while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
			 <?php endwhile;?>
				</div>
			</div>
	<?php dynamic_sidebar( 'sidebar-contactus' );?>
	</main>
<?php get_footer ();?>