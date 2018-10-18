<?php get_header ();?>
	<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<ol class="breadcrumb">
						<li><a href="#"><i class="icon-prev"></i> News </a></li>
						<li><a href="#">Press Releases</a></li>
						<li class="active"><?php the_title();?></li>
					</ol>
					<div class="row">
						<div class="col-sm-9 col-md-9 col-sm-push-3" id="content">
							<?php while (have_posts()) : the_post(); ?>
								<article class="post">						 
							    <h2> <?php the_title();?> </h2>
								<time datetime="2010-07-31"> <?php the_time('M d, Y');?></time>
								<h3 class="h3"><?php the_field('application_notes');?> </h3>			
								<?php the_content();?>					
								</article>	
						  <?php endwhile;?>
							</div>
						<aside class="col-sm-3 col-sm-pull-9">
							<?php wp_nav_menu(array(
							'container'       => 'nav',
							'container_class' => 'add-nav',
							'container_id'    => '',
							'menu' => 'News Menu', 	
							'menu_class'      => 'list-unstyled'						
							)); ?>
							<?php dynamic_sidebar( 'sidebar-emailsubscription' );?>	
						</aside>
					</div>
				</div>
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
<?php get_footer ();?>