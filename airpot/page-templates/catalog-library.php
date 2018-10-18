<?php 
/*
		Template Name:Catalog library Page
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
						<div class="col-sm-9 col-md-9 col-sm-push-3" id="content">
							<div class="article-list">
								<h2 class="h3">
									<?php while (have_posts()) : the_post(); ?>					    							
										<?php the_content(); ?>						
									 <?php endwhile;?>
								 </h2>
								<div class="row">																
								<?php if( have_rows('catalog_content') ):
									while( have_rows('catalog_content') ): the_row(); ?>
									<article class="col-xs-6 col-sm-4">
											<a href="<?php echo get_sub_field('catalog_title_link');?>"><img src="<?php echo get_sub_field('catalog_image');?>" alt="<?php echo get_sub_field('catalog_title');?>"></a>
											<h3><a href="<?php echo get_sub_field('catalog_title_link');?>"><?php echo get_sub_field('catalog_title');?></a></h3>
											<p><?php echo get_sub_field('catalog_description');?> </p>
										</article>								
								<?php endwhile;?>
								<?php endif; ?>														
								</div>
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
			<?php dynamic_sidebar( 'footer-section1' );?>	
		</main>
<?php get_footer ();?>