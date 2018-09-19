<?php get_header ();?>
<?php global $product;?>
<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<div class="main-section inner <?php if(is_product_category())echo "product-cat-main-sec";?>">
				<div class="container">
						<?php 
						if(is_product_category()){
							wc_get_template( 'archive-product.php' );
						}elseif ($product->id == 5306){
							wc_get_template_part( 'content', 'single-product-gramforce-grippers' );
						}else{
							woocommerce_content();
						}
						?>
		
				</div>
			</div>
						</div>
	<?php dynamic_sidebar( 'sidebar-contactus' );?>
	</main>
<?php get_footer ();?>