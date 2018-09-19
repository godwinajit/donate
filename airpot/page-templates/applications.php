<?php 
/*
		Template Name:Applications Page
	*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}?>
<?php
global $post, $woocommerce, $product;

global $wp_query;

if ( have_posts() ) :
 while ( have_posts() ) : the_post(); 

$slug = basename(get_permalink());

$category = get_term_by( 'slug', $slug, 'product_cat' );
$parent_id=$category->term_id;

function get_product_categories($parent_id){
	return get_categories( array(
		'parent'       => $parent_id,
		'menu_order'   => 'ASC',
		'hide_empty'   => 0,
		'hierarchical' => 1,
		'taxonomy'     => 'product_cat',
		'pad_counts'   => 0,
		'orderby' => 'order'
)  );	
}

function get_category_image($category_id,$default_image){
	$thumbnail_id = get_woocommerce_term_meta ( $category_id, 'thumbnail_id', true );
	$image = wp_get_attachment_url ( $thumbnail_id, 'full' );
	if (empty ( $image ))
	{
		$image =  get_template_directory_uri().'/images/'.$default_image;
	}
	else
	{
		$image = $image;
	}
	return $image;
}

function getNumberOfRows($product_categories){
	$number_of_cat_in_a_row = 3;
	$product_categories_loop_count = 0;
	$total_categories = count($product_categories);
	$product_categories_loop_count = explode('.',($total_categories / $number_of_cat_in_a_row));
	$extra_categories = $product_categories_loop_count[1];
	if($extra_categories > 0 ) $product_categories_loop_count[0]++;
	return $product_categories_loop_count[0];
}

$product_categories = get_product_categories($parent_id);
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
						<h1>Applications</h1>
					</div>
					<div class="product-list application inner text-center">
						<div class="blocks-holder">
							<div class="row">
								<div class="col-sm-3">
									<a class="collapsed block" href="#category01">
										<div class="text-block">
											<span> Motion Damping Devices </span>
										</div>
										<img src="images/img03.jpg" width="298" height="265" alt="image description">
									</a>
									<div id="category01" class="collapse">
										<div class="products-block">
											<a href="#category01" class="close"><span class="fa fa-times"></span></a>
											<div class="row" id="accordion1">
												<div class="panel">
													<div class="col-sm-6 col-md-4">
														<ul class="item-list same-holder">
															<li class="same-height">
																<a class="opener" href="#block1" data-parent="#accordion1" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Solenoids </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block2" data-parent="#accordion1" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Spring Loaded Mechanisms </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block5" data-parent="#accordion1" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Falling Mass </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block6" data-parent="#accordion1" data-toggle="collapse"><img src="images/img34.jpg" alt="image description">Creating Time Delay</a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block31" data-parent="#accordion1" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Vibration Damping </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block32" data-parent="#accordion1" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Oscillating Valve Damping </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block35" data-parent="#accordion1" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Limiting Overaction </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block36" data-parent="#accordion1" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Cushioning Impact </a>
															</li>
														</ul>
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block1">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block2">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block5">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block6">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block31">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block32">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block35">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block36">
														<img src="images/img25.jpg" alt="image description">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<a class="collapsed block" href="#category02">
										<div class="text-block">
											<span> Air &amp; Vacuum Pneumatic Actuators </span>
										</div>
										<img src="images/img03.jpg" width="298" height="265" alt="image description">
									</a>
									<div id="category02" class="collapse">
										<div class="products-block">
											<a href="#category02" class="close"><span class="fa fa-times"></span></a>
											<div class="row" id="accordion2">
												<div class="panel">
													<div class="col-sm-6 col-md-4">
														<ul class="item-list same-holder">
															<li class="same-height">
																<a class="opener" href="#block3" data-parent="#accordion2" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Solenoids </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block4" data-parent="#accordion2" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Spring Loaded Mechanisms </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block7" data-parent="#accordion2" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Falling Mass </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block8" data-parent="#accordion2" data-toggle="collapse"><img src="images/img34.jpg" alt="image description">Creating Time Delay</a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block33" data-parent="#accordion2" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Vibration Damping </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block34" data-parent="#accordion2" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Oscillating Valve Damping </a>
															</li>
														</ul>
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block3">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block4">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block7">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block8">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block33">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block34">
														<img src="images/img25.jpg" alt="image description">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<a class="collapsed block" href="#category03">
										<div class="text-block">
											<span> Piston Position Sensing </span>
										</div>
										<img src="images/img03.jpg" width="298" height="265" alt="image description">
									</a>
									<div id="category03" class="collapse">
										<div class="products-block">
											<a href="#category03" class="close"><span class="fa fa-times"></span></a>
											<div class="row" id="accordion3">
												<div class="panel">
													<div class="col-sm-6 col-md-4">
														<ul class="item-list same-holder">
															<li class="same-height">
																<a class="opener" href="#block23" data-parent="#accordion3" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Solenoids </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block24" data-parent="#accordion3" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Spring Loaded Mechanisms </a>
															</li>
														</ul>
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block23">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block24">
														<img src="images/img25.jpg" alt="image description">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<a class="collapsed block" href="#category04">
										<div class="text-block">
											<span> Precision Force Control </span>
										</div>
										<img src="images/img03.jpg" width="298" height="265" alt="image description">
									</a>
									<div id="category04" class="collapse">
										<div class="products-block">
											<a href="#category04" class="close"><span class="fa fa-times"></span></a>
											<div class="row" id="accordion4">
												<div class="panel">
													<div class="col-sm-6 col-md-4">
														<ul class="item-list same-holder">
															<li class="same-height">
																<a class="opener" href="#block25" data-parent="#accordion4" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Solenoids </a>
															</li>
															<li class="same-height">
																<a class="opener" href="#block26" data-parent="#accordion4" data-toggle="collapse"><img src="images/img34.jpg" alt="image description"> Velocity Control of Spring Loaded Mechanisms </a>
															</li>
														</ul>
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block25">
														<img src="images/img25.jpg" alt="image description">
													</div>
													<div class="col-sm-6 col-md-8 open-block collapse" id="block26">
														<img src="images/img25.jpg" alt="image description">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
						</div>
						
						
					</div>
				</div>
			</section>
 <?php endwhile; 
			 else: ?>

<p> Sorry no post available</p>



 <!-- REALLY stop The Loop. -->
 <?php endif;
			 wp_reset_postdata(); ?>
			<section class="contact-section">
				<div class="container">
					<div class="left-col">
						<h2>For more information on our pneumatic actuation products, <strong class="text-uppercase">Contact Us Today!</strong> Our experienced staff will provede you with the solution your project requires.</h2>
					</div>
					<a href="#" class="btn btn-info btn-wide">Contact Us</a>
				</div>
			</section>
		</main>


<?php get_footer ();?>

 <script type="text/javascript">
<!--
jQuery( document ).ready(function() {
	jQuery( ".opener" ).click(function() {
		var id=this.id;
		var splivar=(this.id).split("-");		
		var str = jQuery("#desc_value-"+splivar[1]).text();
		var title = jQuery("#Title_value-"+splivar[1]).text();		
			
		jQuery(".targetdesc").html(str);
		jQuery(".targetTitle").html(title);
		});
});
//-->
</script>