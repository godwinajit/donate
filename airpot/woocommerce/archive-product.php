<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if (! defined ( 'ABSPATH' )) {
	exit (); // Exit if accessed directly
}

/**
 * woocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */

global $wp_query;
$current_category = $wp_query->get_queried_object();
$redirect_cat_to_product = get_field('redirect_to_product', 'product_cat_'.$current_category->term_id);
$redirect_cat_to_url = get_field('redirect_url', 'product_cat_'.$current_category->term_id);
$redirect_cat_to_page = get_field('current_redirect_page', 'product_cat_'.$current_category->term_id);
if( ($redirect_cat_to_product) || ($redirect_cat_to_url) ){
	if($redirect_cat_to_product){
		global $wpdb;
		$redirect_product_id = $wpdb->get_var( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = ".$redirect_cat_to_product." AND meta_key = 'products_id' ORDER BY post_id DESC") );
		if(!$redirect_product_id) $redirect_product_id = $redirect_cat_to_product;
		wp_redirect(get_permalink($redirect_product_id), 302 );
		exit;
	}elseif($redirect_cat_to_url){
		wp_redirect($redirect_cat_to_page, 302 );
		exit;
	}
}

woocommerce_breadcrumb ( array (
		'delimiter' => ' ',
		'wrap_before' => '<ol class="breadcrumb">',
		'wrap_after' => '</ol>',
		'before' => '<li>',
		'after' => '</li>' 
) );
$str_print = ob_get_clean ();
echo str_replace ( "<br />", " ", $str_print );
?>
<div class="row category_menu_sidebar">
	<div class="col-sm-3">
	<?php dynamic_sidebar( 'sidebar-productcatgory' );?>
	<ul class="product-categories" id="product-categories-extra">
      	<li>
      		<?php if($product->id != 5306){?>
      			<a style="color: #555555 !important;" href="<?php echo get_permalink(5306);?>"><?php echo get_the_title(5306);?></a>
      		<?php }else{?>
      			<a style="color: #f47a20 !important;" href="<?php echo get_permalink(5306);?>"><?php echo get_the_title(5306);?></a>
      		<?php }?>
      	</li>
      </ul>
	</div>
	<div class="col-sm-9">
	<h1><?php echo $current_category->name;?></h1>
	<?php 
	if(!empty(get_field('home_page_category__image', 'product_cat_'.$current_category->term_id)) && get_field('category_image_enable', 'product_cat_'.$current_category->term_id)[0] == "true")
		{?>
			<div class="home_page_category__image"><img  style="float:right;" src="<?php echo get_field('home_page_category__image', 'product_cat_'.$current_category->term_id);?>"></div>
		<?php } ?>
		
		<p><?php echo wpautop($current_category->description);?></p>
		<?php 
		
		if( ( get_option( 'product_cat_'.$current_category->term_id.'_chart_layout') ) && ( category_has_child( $current_category->term_id) ) ){ 
			$child_categories = get_product_categories($current_category->term_id);
			$category_custom_specs =  array();
			?>
			<div class="table-holder">
								<table class="table table-striped table-sm">
									<tbody><tr>
										<th>
											<span class="color-primary">MODEL</span>
										</th>
									<?php foreach ( $child_categories as $child_category ) { 
										$category_custom_specs = get_field('category_custom_specs', 'product_cat_'.$child_category->term_id);
									 $category_title_with_break = get_field('h1_name_if_blank', 'product_cat_'.$child_category->term_id);
										 ?>
										<th>
											<span class="color-primary"><center><?php if(!empty($category_title_with_break)){echo $category_title_with_break;} else { echo $child_category->name;}?></center>
												<a class="btn-view" href="<?php echo get_term_link( $child_category->slug, 'product_cat');?>">VIEW PRODUCT GROUP</a>
											</span>
										</th>
									<?php }?>
									</tr>
									<?php 
									$cat_spec_count = 0;?>
									
									<?php foreach ($category_custom_specs as $category_custom_specs)	{
									?>
									
									<tr>
										<td><?php echo $category_custom_specs['spec_name']?></td>
										<?php 
											foreach ( $child_categories as $child_category ) { 
											$category_custom_specs = get_field('category_custom_specs', 'product_cat_'.$child_category->term_id);
										?>
										<td><strong><?php echo $category_custom_specs[$cat_spec_count]['spec_value']?></strong></td>
										<?php }?>
									</tr>
									<?php $cat_spec_count++;}?>
								</tbody></table>
							</div>
			
			<?php 
		}elseif( category_has_child( $current_category->term_id) ){
				$child_categories = get_product_categories($current_category->term_id);
				$i=0;
				$Gramforce_id = 5306;
				$Gramforce_post = get_post($Gramforce_id); 
				$Gramforce_post_content = $Gramforce_post->post_content;
				$Gramforce_img_url = $image = wp_get_attachment_image_src( get_post_thumbnail_id( $Gramforce_id ), array( 768, 432) );
				//echo '<div class="product-section"><div class="row">';
				echo '<div class="product-section">';
				
								
				foreach ( $child_categories as $child_category ) { 
				
				if( ($i % 2) == 0){ echo'<div class="row">'; }	?>
						<article class="product col-sm-6">
							<div class="img-holder">
								<a href="<?php echo get_term_link( $child_category->slug, 'product_cat');?>"> <img width="370" height="137" alt="image description" src="<?php echo get_category_image($child_category->term_id,'img33.jpg')?>"> </a>
							</div>
							<div class="content">
								<span class="position"><h2><a href="<?php echo get_term_link( $child_category->slug, 'product_cat');?>"><?php echo $child_category->name;?></a></h2></span>
								<p><?php echo wp_trim_words ( $child_category->description, 25);?></p>
							</div>
						</article>
						<?php
							if( ($i == 6) && ($current_category->term_id == 134)){ ?>
								<article class="product col-sm-6">
									<div class="img-holder">
										<a href="<?php echo get_permalink($Gramforce_id);?>"> <img width="370" height="137" alt="image description" src="<?php echo $Gramforce_img_url[0];?>"> </a>
									</div>
									<div class="content">
										<span class="position"><h2><a href="<?php echo get_permalink($Gramforce_id);?>"><?php echo get_the_title($Gramforce_id);?></a></h2></span>
										<p><?php echo wp_trim_words ( $Gramforce_post_content , 25);?></p>
									</div>
								</article>							
						<?php }	?>
				<?php if( ($i % 2) != 0){ echo'</div>'; }	$i++;}
				if( (count($child_categories) % 2) != 0){ echo'</div>'; }
				echo '</div>';
				//echo '</div></div>';
				
			}else{
				$productargs = array( 'post_type' => 'product', 'product_cat' => $current_category->slug, 'orderby' => 'products_model','order' => 'asc' );
				$productloop = new WP_Query( $productargs );
				$productloopcount = 0;
				?>
				<div class="product-section">
				
				<?php 
				        while ( $productloop->have_posts() ) : $productloop->the_post();?>
				
				            <?php 
				            $image_original = wp_get_attachment_image_src( get_post_thumbnail_id( $productloop->post->ID ), 'thump');
				            ?>
								<?php if( ($productloopcount % 2) == 0){?><div class="row"><?php }?>
										<article class="product col-sm-6">
											<div class="img-holder">
												<a href="<?php echo get_permalink( $productloop->post->ID);?>"> <img width="370" height="137" alt="<?php echo $productloop->post->post_title;?>" src="<?php echo $image_original[0];?>"> </a>
											</div>
											<div class="content">
												<span class="position"><?php echo $productloop->post->post_title;?></span>
												<?php if(!empty(get_field('products_model',$productloop->post->ID))){?>
												<h2> <a href="<?php echo get_permalink( $productloop->post->ID);?>">Model: <?php echo get_field('products_model',$productloop->post->ID);?> </a> </h2><?php } ?>
												<a class="btn btn-primary" href="<?php echo get_permalink( $productloop->post->ID);?>">Build Your Part</a>
											</div>
										</article>
								<?php if( ($productloopcount % 2) != 0){?>	</div> <?php }?>
								<?php $productloopcount++;?>
				    <?php endwhile; ?>
				    <?php wp_reset_query(); ?>
				</div>
	</div>
	
</div>

							
					
		<?php 
	}
	//echo "====".$current_category->name; die;
?>

<div>
<?php the_field('categories_subdescription', 'product_cat_'.$current_category->term_id)?>
</div>