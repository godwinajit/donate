<?php 
/*
		Template Name:Decipher Part Number
	*/
?>
<?php 

function lensort($a,$b){
	$la = strlen( $a); $lb = strlen( $b);
	if( $la == $lb) {
		return strcmp( $a, $b);
	}
	return $la - $lb;
}

function getModelOptionsByCategory($productCatId){
	$productList = array();
	$productListArr = array();
	$optionsList = '';
	$categoryList = explode(',',$productCatId);
	
	foreach ($categoryList as $category){
		$product_category = get_term_by( 'id', $category, 'product_cat', 'ARRAY_A' );
		
			$args = array( 'post_type' => 'product', 'posts_per_page' => 99, 'product_cat' => $product_category['slug'] );
			$loop = new WP_Query( $args );
	
			while ( $loop->have_posts() ) : $loop->the_post();
				global $product;
				$productListArr[get_field('products_model',get_the_ID())] = get_permalink();
				$productList[] = get_field('products_model',get_the_ID());
			endwhile;			
				wp_reset_query();
	}
	usort($productList, 'lensort');

	foreach ($productList as $product){
		$optionsList.= '<option productURL="'.$productListArr[$product].'">'.$product.'</option>';
	}/* 
	if($productCatId == 51)print_r($productList);
	if($productCatId == 51)echo '--------------------------------------------';
	if($productCatId == 51)print_r($productListArr); */
	return $optionsList;
}
?>
	<?php get_header ();?>
		<main role="main" id="main">
			<div class="link-group inner">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<!-- <a href="#" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>Support</h1>
					</div>
					<div class="row">
						<div class="col-sm-9 col-md-9 col-sm-push-3" id="content">
							<div class="content-section">
								<h2 class="h3"><?php echo the_title();?></h2>
								<?php echo get_post()->post_content;?>
								<div class="two-column">
									<div class="column">
										<?php the_field('column_one_content');?>
										<form class="form" action="#">
	<fieldset>
		<label for="lbl01">Dashpots and Snubbers:</label>
			<select id="lbl01" onchange="location.href=jQuery('#lbl01 option:selected').attr('productURL');">
				<option class="hideme">Select One:</option>
				<?php echo getModelOptionsByCategory(get_field('dashpots_and_snubbers'));?>
			</select>
		<label for="lbl02">Actuator:</label>
			<select	id="lbl02" onchange="location.href=jQuery('#lbl02 option:selected').attr('productURL');">
				<option class="hideme">Select One:</option>
				<?php echo getModelOptionsByCategory(get_field('actuator'));?>
			</select>
		<label for="lbl03">Airpel:</label>
			<select id="lbl03" onchange="location.href=jQuery('#lbl03 option:selected').attr('productURL');">
				<option class="hideme">Select One:</option>
				<?php echo getModelOptionsByCategory(get_field('airpel'));?>
			</select>
		<label for="lbl04">Piston and Cylinder Sets:</label>
			<select id="lbl04" onchange="location.href=jQuery('#lbl04 option:selected').attr('productURL');">
				<option class="hideme">Select One:</option>
				<?php echo getModelOptionsByCategory(get_field('piston_and_cylinder_sets'));?>
			</select>
	</fieldset>
</form>
										
										
									</div>
									<div class="column">
										<?php the_field('column_two_content');?>
									</div>
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
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
<?php get_footer ();?>