<?php get_header ();?>

<main role="main" id="main">
<div class="link-group">
	<a href="/product-category/product-lines"><span>Product Lines</span></a> <!-- <a
		href="<?php echo  get_home_url(); ?>/generate-3d-model"
		class="model3d-link"><span><img
			src="<?php echo get_template_directory_uri(); ?>/images/ico04.png"
			alt="image description">Create Your Own 3D Model</span></a> -->
</div>
<div class="main-section inner">
	<div class="container">
		<div class="headline text-uppercase">
			<h1><?php echo the_title();?></h1>
		</div>
		<div class="row">
			<div class="col-sm-12">
			<?php if ( has_post_thumbnail() ) { 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); 
				?>
				<img src="<?php  echo $image[0];?>" class="pull-left"
					style="padding: 20px;">
				<?php }  ?>
					<div class="caption" class="pull-right">
  					<?php while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>						
			 		<?php endwhile;?>	
   				</div>
			</div>
		</div>
	</div>
</div>
</main>
<?php get_footer ();?>