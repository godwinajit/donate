<?php 
/*
		Template Name:Product Category Page
	*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}?>

<?php
global $post, $woocommerce, $product;

global $wp_query;

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

$slug = basename(get_permalink());
$taxonomy = 'product_cat';
$category = get_term_by( 'slug', $slug, 'product_cat' );
$parent_id=$category->term_id;

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
$category_row_loop_count = getNumberOfRows($product_categories);
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
						<h1><?php the_title();?></h1>
					</div>
					<div class="product-list inner text-center">
					<?php 
					for($i= 0; $i <= $category_row_loop_count; $i++  ){
					?>
						<div class="blocks-holder">
							<div class="row">
							<?php 
							$cat_count = 0 ;
							foreach ( $product_categories as $cat ) {	
							
								if($cat->term_id!='449' && $cat->name!="E/P TRANSDUCER & FILTER REGULATOR"):						
								$cat_count++;							
								$post_id="{$taxonomy}_{$cat->term_id}";
								$image = get_field('home_page_category__image',$post_id);															
							?>
								<div class="col-sm-4">
									<a href="#category_<?php echo $cat->term_id;?>" class="collapsed block">
										<!--<?php if( ($cat_count % 2) == 1 ) { ?><div class="text-block"> <?php }else{ ?><span class="text-block"> <?php }?>
											<span><?php echo $cat->name;?></span>
										<?php if( ($cat_count % 2) ==1 ) { ?></div><?php }else{ ?></span> <?php }?>
										<img width="298" height="265" alt="<?php echo $cat->name;?>" src="<?php echo $image;?>">-->
										
										<div class="img-block">
										<img width="298" height="265" alt="<?php echo $cat->name;?>" src="<?php echo $image;?>">					
										</div>
										<?php if( ($cat_count % 2) == 1 ) { ?><div class="text-block"> <?php }else{ ?><span class="text-block"> <?php }?>
											<span><?php echo $cat->name;?></span>
										<?php if( ($cat_count % 2) ==1 ) { ?></div><?php }else{ ?></span> <?php }?>
									</a>
									<div class="collapse" id="category_<?php echo $cat->term_id;?>">
										<div class="products-block">
											<a class="close" href="#category<?php echo $cat->term_id;?>"><span class="fa fa-times"></span></a>
											<div class="row">
											<?php $product_categories1 = get_product_categories($cat->term_id);
													$cat_count1 = 0 ;
													if(count($product_categories1) > 0){		
												?>
												<div id="accordion<?php echo $cat->term_id;?>" class="col-sm-6 col-md-4">
													<div class="panel">
														<ul class="item-list same-holder">
														<?php 
															foreach ( $product_categories1 as $cat1 ) {
																$cat_count1++;
																$post_id1="{$taxonomy}_{$cat1->term_id}";
																$image1 = get_field('home_page_category__image',$post_id1);
																if($image1 == '') $image1 =  get_template_directory_uri().'/images/img34.jpg';
															?>
															<li class="same-height same-height-<?php if( ($cat_count % 2) ==1 ) { ?>left<?php }else{?>right<?php }?>" style="height: 0px;">
																<a id="desc-<?php echo $cat1->term_id;?>" data-parent="#accordion<?php echo $cat->term_id;?>" <?php if(!get_option( 'product_cat_'.$cat1->term_id.'_chart_layout')){?> class="opener" data-toggle="collapse" href="#block<?php echo $cat1->term_id;?><?php }else{echo 'href="'.get_term_link( $cat1->slug, 'product_cat');}?>">
																	<img alt="<?php echo $cat1->name;?>" src="<?php echo $image1;?>"><?php echo $cat1->name;?>
																	</a>
																<div style="display:none" class="desc_toggle_value" id="desc_value-<?php echo $cat1->term_id;?>"><?php echo $cat1->description;?><?php $termlink = get_term_link( $cat1->slug, 'product_cat'); ?>
																<div class="row">
																<a href="<?php echo esc_url( $termlink );?>"><?php echo "Learn More";?></a>
																</div></div>
																<div style="display:none" class="desc_toggle_value" id="Title_value-<?php echo $cat1->term_id;?>"><?php echo $cat1->name;?></div>
															</li>
														<?php }?>
														</ul>
														<?php 
															foreach ( $product_categories1 as $cat1 ) {
																$product_categories2 = get_product_categories($cat1->term_id);
																if(count($product_categories2) > 0){
															?>
															<div id="block<?php echo $cat1->term_id;?>" class="open-block collapse">
																<ul class="list-unstyled">
																<?php 
																	foreach ( $product_categories2 as $cat2 ) { 
																		$product_categories3 = get_product_categories($cat2->term_id);
																		$term_link2 = get_term_link( $cat2->slug, 'product_cat');
																		?>
																		<li><a <?php if( (count($product_categories3) > 0) || (!get_option( 'product_cat_'.$cat2->term_id.'_chart_layout'))){?>href="<?php echo esc_url( $term_link2 );?>"<?php }else{?>href="#" data-toggle="dropdown" <?php }?> id="drop<?php echo $cat2->term_id;?>"><?php echo $cat2->name;?></a>
																		<?php if(count($product_categories3) > 0){?>
																		<ul aria-labelledby="drop<?php echo $cat2->term_id;?>" class="list-unstyled">
																		<?php foreach ( $product_categories3 as $cat3 ) {
																			$term_link3 = get_term_link( $cat3->slug, 'product_cat');
																			?>
																																			
																			<li><a href="<?php echo esc_url( $term_link3 );?>"><?php echo $cat3->name;?></a></li>
																			<?php }?>
																		</ul>
																		<?php }?>
																		</li>
																	<?php } ?>
															</ul>
														</div>														
														<?php }}?>
													</div>
												</div>
												<?php }?>
												<div id="accordiondesc<?php echo $cat->term_id;?>" class="col-sm-6 <?php if(count($product_categories1) > 0){	?>col-md-8<?php }else{?>col-md-12<?php }?>">
													<h3 id="targetTitle<?php echo $cat->term_id;?>" style="display:none"><?php echo $cat->name; ?></h3>
													<div id="targetdesc<?php echo $cat->term_id;?>" style="display:none">
														<?php echo $cat->description; ?>
														<?php $termlink = get_term_link( $cat->slug, 'product_cat'); ?>
														<div class="row">
														<a href="<?php echo esc_url( $termlink );?>"><?php echo "Learn More";?></a>
														</div>
													</div>
													
													<h3 class="targetTitle"></h3>
													<div class="txt-three-cols targetdesc">
														
													</div>
													
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php 
									array_shift($product_categories);
									if($cat_count == 3)break;
									 endif;
								}
								?>
							</div>
						</div>
						<?php }?>
					</div>
				
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
 <?php endwhile; else: ?>


 <!-- The very first "if" tested to see if there were any Posts to -->
 <!-- display.  This "else" part tells what do if there weren't any. -->
 <p>Sorry, no posts matched your criteria.</p>


 <!-- REALLY stop The Loop. -->
 <?php endif;wp_reset_postdata(); ?>
 <script type="text/javascript">
<!--
jQuery( document ).ready(function() {
	jQuery( "a.collapsed" ).click(function() {
		var splivar1=(jQuery(this).attr('href')).split("_");		
		var str = jQuery("#targetdesc"+splivar1[1]).html();		
		var title = jQuery("#targetTitle"+splivar1[1]).html();		
		jQuery(".targetdesc").html(str);
		jQuery(".targetTitle").html(title);
		});
	jQuery( ".opener" ).click(function() {
		var id=this.id;
		var splivar=(this.id).split("-");		
		var str = jQuery("#desc_value-"+splivar[1]).html();		
		var title = jQuery("#Title_value-"+splivar[1]).text();		
		jQuery(".targetdesc").html(str);
		jQuery(".targetTitle").html(title);
		});
});
//-->
</script>
 
 
			<?php get_footer ();?>