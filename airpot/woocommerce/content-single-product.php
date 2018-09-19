<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post, $woocommerce, $product;



function findreplacestr($str){
$fullstr="";	

	if(strpos($str,'{Stroke}') !== false):
	$fullstr=str_replace('{Stroke}','<span id="Stroke"></span>',$str);
	elseif(strpos($str,'{Custom') !== false):
	$fullstr.=str_replace('{Custom Stroke}','<span id="Custom-Stroke"></span>',$str);	
	elseif(strpos($str,'{Custom-Stroke}') !== false):
	$fullstr=str_replace('{Custom-Stroke}','<span id="Custom-Stroke"></span>',$str);	
	endif;
	
	if (strpos($str,'{-J2}') !=null):
	$fullstr=str_replace('{-J2}','<span id="-J2"></span>',$fullstr);
	endif;
	
	if (strpos($str,'{-ET}') !== false):
	$fullstr=str_replace('{-ET}','<span id="-ET"></span>',$fullstr);
	endif;
//	echo $fullstr;
	return $fullstr;
}
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }

?>
<?php ob_start(); ?>

    <?php woocommerce_breadcrumb(array(
      'delimiter'   => ' ',
      'wrap_before' => '<ol class="breadcrumb">',
      'wrap_after'  => '</ol>',
      'before'      => '<li>',
      'after'       => '</li>',
      ));
    $str_print=ob_get_clean();
      echo str_replace("<br />"," ",$str_print);?>
<script>
jQuery(document).ready(function() {
var $breadCrumbLevel6 = jQuery('.breadcrumb > li:nth-child(6)');
var $breadCrumbLevel2 = jQuery('.breadcrumb > li:nth-child(2)');
$breadCrumbLevel6.hide();
$breadCrumbLevel2.hide();
});
</script>
<div id="productAttributeImgDiv"></div>
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
      			<div class="row">
	      			<div class="col-sm-3">
							<?php
							if (has_post_thumbnail ()) {
								echo 'Click to Enlarge<br>';
								$image_title = esc_attr ( get_the_title ( get_post_thumbnail_id () ) );
								$image_caption = get_post ( get_post_thumbnail_id () )->post_excerpt;
								$image_link = wp_get_attachment_url ( get_post_thumbnail_id () );
								$image = get_the_post_thumbnail ( $post->ID, apply_filters ( 'single_product_large_thumbnail_size', 'shop_single' ), array (
										'title' => $image_title,
										'alt' => $image_title
								) );

								$attachment_count = count ( $product->get_gallery_attachment_ids () );

								if ($attachment_count > 0) {
									$gallery = '[product-gallery]';

								?>
							<div class="slideshow carousel row" data-ride="carousel" id="slideshow" data-interval="false">
								<div class="col-sm-12">
									<div class="carousel-inner-new">
									<div class="scrollabl">
									<div class="jcf-scrollable">
										<div class="item active">
											<a data-rel="lightbox[gallery1]" title="<?php echo $image_caption;?>" href="<?php echo $image_link; ?>"><img src="<?php echo $image_link; ?>" alt="<?php echo $image_caption?>"></a>
										</div><?php $attachment_ids = $product->get_gallery_attachment_ids();
										$j=1;
										foreach ( $attachment_ids as $attachment_id ) {



											$image_link1 = wp_get_attachment_url( $attachment_id );

											if ( ! $image_link1 )
												continue;

											$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
											$image_title = esc_attr( get_the_title( $attachment_id ) );
											if($j==0){?>
										<div class="item active">
										<?php }else{?>
										<div class="item">
										<?php }?>
											<a data-rel="lightbox[gallery1]" title="<?php echo $image_title;?>" href="<?php echo $image_link1; ?>"><img src="<?php echo $image_link1; ?>" alt="<?php echo $image_title;?>"></a>
										</div>
										<?php $j++;	}?>

									</div>
									</div>
									</div>
								</div>
								<!-- <div class="col-sm-12">
									<ol class="carousel-indicators">
									<li data-target="#slideshow" data-slide-to="0" class="active"><img src="<?php echo $image_link; ?>" alt="<?php echo $image_title;?>"></li>
										<?php $attachment_ids = $product->get_gallery_attachment_ids();
										$i=1;
										foreach ( $attachment_ids as $attachment_id ) {



											$image_link1 = wp_get_attachment_url( $attachment_id );

											if ( ! $image_link1 )
												continue;

											$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
											$image_title = esc_attr( get_the_title( $attachment_id ) );?>
												<li data-target="#slideshow" data-slide-to="<?php echo $i;?>" class=""><img src="<?php echo $image_link1; ?>" alt="<?php echo $image_title;?>"></li>

											<?php $i++; }?>
									</ol>
								</div>-->
							</div>
							<?php } else {?>
							<div class="row">
													<div class="col-sm-12"><a data-rel="lightbox[gallery1]" title="<?php echo $image_caption;?>" href="<?php echo $image_link; ?>"><img src="<?php echo $image_link;?>" alt="<?php echo $image_caption;?>" /></a></div>
												</div>
							<?php } ?>
							<?php

  							//echo apply_filters ( 'woocommerce_single_product_image_html', sprintf ( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );
							} else {

							echo apply_filters ( 'woocommerce_single_product_image_html', sprintf ( '<div class="row">
													<div class="hidden-xs col-sm-12"><img src="%s" alt="%s" /></div>
												</div>', wc_placeholder_img_src (), __ ( 'Placeholder', 'woocommerce' ) ), $post->ID );
						}
						?>

	      			</div>
	      			<div class="col-sm-5">

							<span class="position"><?php the_title(); ?></span>
							<h2 class="model-name"><a style="color: #f47a20;font-size: 21px;font-weight:bold;" href="<?php the_permalink();?>">Model: <?php the_field('products_model');?></a></h2>
								<?php $attribute_set = count($product->get_attributes());?>
								<?php if (!empty($attribute_set)){?><p><a class="configure_part" href="#CONFIGFORM">CONFIGURE YOUR PART</a></p><?php } ?>
								<script type="text/javascript">var PARTADDITIONALPARAMETERS = "";</script>
								<?php if(get_field('part_additional_parameters')){?>
									<script type="text/javascript">PARTADDITIONALPARAMETERS = "<?php echo get_field('part_additional_parameters');?>";</script>
								<?php }?>
								<?php   $thecontent = get_the_content();
									 $performance=get_field('performance');
									 $mounting_data=get_field('mounting_data');
									 $relatedfiles=have_rows('related_files');

									if(!empty($thecontent)) {
									$class1='class="active"';
									$activetab1='active';
									}else{
										if( !empty($performance) ){
											$class2='class="active"';
											$activetab2='active';

										}else{
											if( !empty($mounting_data)){
											$class3='class="active"';
											$activetab3='active';
											}else{
												if(!empty($relatedfiles)){
												$class4='class="active"';
												$activetab4='active';

												}
											}
										}
									}
								?>
							<div role="tabpanel" class="tabs-default product_detailed_page">
								<ul class="nav nav-tabs same-holder" role="tablist">


									<?php $thecontent = get_the_content();
									if(!empty($thecontent)) : ?>
									<li role="presentation" <?php echo $class1;?> ><a class="same-height" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab"><span>Specifications</span></a></li>
									<?php endif;?>
									<?php if(get_field('performance')):?>
									<li role="presentation" <?php echo $class2;?>><a class="same-height" href="#tab-02" aria-controls="tab-02" role="tab" data-toggle="tab"><span>Performance</span></a></li>
									<?php endif;?>
									<?php if(get_field('mounting_data')):?>
									<li role="presentation" <?php echo $class3;?>><a class="same-height" href="#tab-03" aria-controls="tab-03" role="tab" data-toggle="tab"><span>Mounting Data</span></a></li>
									<?php endif;?>
									<?php if( have_rows('related_files') ): ?>
									<li role="presentation" <?php echo $class4;?>><a class="same-height" href="#tab-04" aria-controls="tab-03" role="tab" data-toggle="tab"><span>Related Files</span></a></li>
									<?php endif; ?>
								</ul>
								<div class="tab-content">
									<?php $thecontent = get_the_content();
									if(!empty($thecontent)) : ?>
									<div role="tabpanel" class="tab-pane <?php echo $activetab1;?>" id="tab-01">
										<?php the_content(); ?>
									</div>
									<?php endif;?>
									<?php if(get_field('performance')):?>
									<div role="tabpanel" class="tab-pane <?php echo $activetab2;?>" id="tab-02">
										<?php the_field('performance');?>
									</div>
									<?php endif;?>
									<?php if(get_field('mounting_data')):?>
									<div role="tabpanel" class="tab-pane <?php echo $activetab3;?>" id="tab-03">
										<?php the_field('mounting_data');?>
									</div>
									<?php endif;?>
									<?php if( have_rows('related_files') ): ?>
									<div role="tabpanel" class="tab-pane <?php echo $activetab4;?>" id="tab-04">


									<?php
										while ( have_rows('related_files') ) : the_row();
											$related_file_name=get_sub_field('related_file_name');
											$related_file_title=get_sub_field('related_file_title');
									?>
											<a href="<?php echo $related_file_name;?>" target="_blank"><?php echo $related_file_title; ?></a>
										 <?php endwhile; ?>


									</div>
									<?php endif;?>
								</div>
							</div>

	      			</div>
	      			<div class="hidden-xs col-sm-4">
							<?php
									$imageurl=get_field('zooming_image');
									$largeimageurl=get_field('zooming_large_image');
							if( (!empty($imageurl)) && (!empty($largeimageurl))):?>


									<div id="demo-container" style="position: absolute; left: -44px; top: 0; height: 64px; width: 67px; opacity: 0.4;"></div>
									<div class="position" style="padding-left:25px;">Click on the Line Drawing image to Zoom In / Out </div>
									 <!-- <img  id="zoomimage" src="<?php echo $imageurl;?>" height="391" width="291" alt=""> -->
									<!-- <a href="<?php echo $largeimageurl; ?>" data-dims="300, 225" data-magsize="150,150" data-large="<?php echo $largeimageurl;?>"  ><img id="zoomimage" src="<?php echo $imageurl;?>"  title=""/></a>-->
										<img  src="<?php echo $imageurl;?>" style="width:270px; height:auto;" class="magnify"  /> <!-- Ideal Dimension 270 × 407 -->
										<img src="<?php echo $largeimageurl;?>" style="display: none;" id="targetimageid"> <!-- Ideal Dimension 1350 × 2034 -->
									<?php wp_enqueue_script( 'elevate-zoom' ); ?>



							<?php endif;?>

	      			</div>
      			</div>
      			<div class="row">
      				<div class="col-sm-8">

						<?php $attributes = count($product->get_attributes());
						if($attributes):?>
						<form id="CONFIGFORM" name="CONFIGFORM" _lpchecked="1">
						<div class="row" style="margin-top:20px;">
							<div class="panel panel-default">
								<div class="panel-heading ">
									CONFIGURE YOUR PART
									<br>
									<?php if(!empty(get_field('products_iframe'))):?>
									<input type="hidden" id="partNumber" name="partNumber" value="<?php the_field('products_model');?>">
									<input type="hidden" id="partNum" name="partNum" value="<?php the_field('products_model');?>">
									 <input id="selectConfigRodType" name="selectConfigRodType" type="HIDDEN" value="">
               						 <input id="selectConfigRodEndType" name="selectConfigRodEndType" type="HIDDEN" value="">
               						 <input id="selectConfigOptions" name="selectConfigOptions" type="HIDDEN" value="">
               						 <input id="selectConfigOptions" name="selectConfigOptionsNew" type="HIDDEN" value="">
						             <input id="retractedMountingLengthMin" name="retractedMountingLengthMin" type="HIDDEN" value="">
						        	<input id="productNameField" name="productNameField" type="HIDDEN" value="<?php the_field('products_model');?>">
									<div id="model"><?php the_field('products_model');?></div>
									<?php else:?>
									<?php $modelstr=get_field('products_model');
										if (preg_match('/[\'^Â£$%&*()}{@#~?><>,|=_+Â¬-]/', $modelstr))
										{
										  //	list($first, $second) = split('-', $modelstr);
											$modelstrtem=get_field('products_model_template');
											?>
										  <!-- 	<span id="model"><?php //echo trim($first); ?><?php //echo "-";?><span id="Custom-Stroke"></span><span id="Stroke"></span><?php //echo trim($second); ?><span id="-J2"></span><span id="-ET"></span></span>-->
										  <span id="model"><?php echo findreplacestr($modelstrtem);?></span>

								<?php 		}else{
									?>
											<span id="model"><?php echo trim(substr($modelstr,0,-1)); ?><span id="Stroke"></span><?php echo trim(substr($modelstr,-1)); ?><span id="M"></span><span id="T1"></span><span id="T2"></span><span id="T3"></span><span id="T4"></span><span id="-ET"></span></span>
									<?php }?>
									<?php endif;?>
								</div>
								<div class="panel-body">
									<div class="model-block">
										<div class="model-iframe">

											<?php $product->list_attributes(); ?>
										</div>
										<?php $threedfilestate=get_field("dynamically_generated_3d_file");
										?>

										<input name="threedfilestate" id="threedfilestate" value="<?php echo $threedfilestate;?>" type="hidden"/>
										<div class="threedcadbutton">
										<div class="row">
										<div class="col-sm-4 col-sm-offset-2">
										<?php if( ($threedfilestate=="no") && (get_field("static_3d_file_name") != '')){?>
											<a target="_blank" class="btn btn-primary btn-block" href="http://cad3d.airpot.com/WebGenerated/Rapid/<?php the_field('static_3d_file_name');?>" id="threedcad-nofile" >3D File</a>
										<?php }else{?>
											<a target="_blank" class="btn btn-primary btn-block" href="" id="threedcad" disabled="true">3D File</a>
										<?php }?>
										</div>
										
										
										<div class="col-sm-4">
										<?php 										
											$isProductInCart = false;
											foreach( WC()->cart->get_cart() as $cart_item_key => $values ) {
												$_product = $values['data'];
												
												if( get_the_ID() == $_product->id ) {
													 $isProductInCart = true;
													 echo '<a class="btn btn-primary btn" disabled="true">ADDED TO RFQ CART</a>';
												}
											}
										
											if (!$isProductInCart){
												echo apply_filters( 'woocommerce_loop_add_to_cart_link',
														    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn btn-primary			btn %s product_type_%s">%s</a>',
															esc_url( $product->add_to_cart_url() ),
													        esc_attr( $product->id ),
													        esc_attr( $product->get_sku() ),
													        $product->is_purchasable() ? 'add_to_cart_button' : '',
													        esc_attr( $product->product_type ),
													        'ADD TO RFQ CART'
															),
														$product );
											}
										 ?>
										</div>
										</div>
										</div>
										
											<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
											<input type="hidden" id="product_id" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
											<input type="hidden" name="variation_id" class="variation_id" value="" />
											<input type="hidden" name="js-ajax-url" class="js-ajax-url" value="<?php echo home_url(); ?>/wp-admin/admin-ajax.php" />
										<!-- <a href="#" class="btn btn-primary btn-lg">ADD TO RFQ CART</a>-->
									</div>
								</div>
							</div>
						</div>
						<?php else: ?>
						<div class="panel-body">
									<div class="model-block">

										<?php $threedfilestate=get_field("dynamically_generated_3d_file");?>
										<?php if( ($threedfilestate=="no") && (get_field("static_3d_file_name") != '')):?>
											<a target="_blank" class="btn btn-primary btn-block" href="http://cad3d.airpot.com/WebGenerated/Rapid/<?php the_field('static_3d_file_name');?>" id="threedcad-nofile" >3D File</a>
										</div>
										<?php elseif($threedfilestate!=="no_file"):?>
										<div class="threedcadbutton">
										<a target="_blank" class="btn btn-primary btn-lg" href="http://cad3d.airpot.com/WebGenerated/Rapid/<?php the_field('products_model');?>.zip" id="threedcad-nofile" >3D File</a>
										</div>
										<?php else:?>
										<?php /*echo apply_filters( 'woocommerce_loop_add_to_cart_link',
										    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn btn-primary btn-lg %s product_type_%s">%s</a>',
										        esc_url( $product->add_to_cart_url() ),
										        esc_attr( $product->id ),
										        esc_attr( $product->get_sku() ),
										        $product->is_purchasable() ? 'add_to_cart_button' : '',
										        esc_attr( $product->product_type ),
										        'ADD TO RFQ CART'
										    ),
										$product ); */?>
											<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
											<input type="hidden" id="product_id" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
											<input type="hidden" name="variation_id" class="variation_id" value="" />
											<input type="hidden" name="js-ajax-url" class="js-ajax-url" value="<?php echo home_url(); ?>/wp-admin/admin-ajax.php" />
										<!-- <a href="#" class="btn btn-primary btn-lg">ADD TO RFQ CART</a>-->
										<?php endif;?>
									</div>
								</div>

						</form>

						<?php endif;?>
      				</div>
      			</div>
      		</div>
      </div>



					<div class="product-section row single-product" itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>">



					</div>

<style>
#lightboxOverlay, #lightbox
	{
		display:none !important;
	}
</style>
<script type="text/javascript">
	jQuery( document ).ready(function() {
		jQuery(".add_to_cart_button").click(function(){
	        jQuery.ajax({
		        type: 'POST',
		        url: jQuery('.js-ajax-url').val(),
		        traditional: true,
		        data: {
		            action: 'configure_your_part',
		            variation_term:stripHTML(jQuery('#model').html()),
		            product_id: jQuery("#product_id").val(),
		        },
	            async : false,
	            success: function(data){
		            //append results
		           // alert(data);
		            console.log("success"+data)
		        }
		    });
	    });
		/*jQuery('#zoomimage').addimagezoom({

			speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
			descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
			imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
			magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
			zoomrange: [1, 5],
			magnifiersize: [250,250],
			magnifierpos: 'right',
			cursorshadecolor: '#fdffd5',
			cursorshade: true
		})*/
	 	jQuery("select#type").change(function(){
			var value = $(this).val();
		    jQuery("div#target").append('<input type="textbox" value='+value+'/>');
		});

		jQuery("#zoomimage").attr("data-zoom-image", "<?php echo $largeimageurl ?>");
		jQuery("#zoomimage").elevateZoom({
						responsive: true,
						loadingIcon:"<?php echo get_template_directory_uri().'/images/loading.png'; ?>",
						imageCrossfade: true,
						zoomWindowFadeIn: 500,
						zoomWindowFadeOut: 500,
						/*lensFadeIn: 500,
						lensFadeOut: 500,*/
						zoomWindowHeight: 300,
						zoomWindowWidth: 300,
						/*zoomWindowOffetx: 90,*/
						zoomWindowPosition: "demo-container",
						borderSize: 1,
						borderColour: '#dbdbdb',
						tint:true,
						tintColour:'#FFF',
						tintOpacity:0.5,
						easing : true
						});
	});
</script>

	<script type="text/javascript">
	jQuery(":checkbox[name='pa_optional-sensor-tracks']").change(function() {
	        if (jQuery(".pa_optional-sensor-tracks:checked").length > 0) {
			     if(jQuery("#cb-M").prop("checked", true)){
		          	 jQuery(".magnet").find('span.jcf-checkbox').removeClass( "jcf-checked" );
			      	 jQuery(".pa_optional-piston-magnet").prop('checked', false);
		        	 jQuery(".pa_optional-piston-magnet").prop("disabled", true);
			     }
	        } else {
	        	jQuery(".pa_optional-piston-magnet").prop("disabled", false);
	        }

	});
	jQuery('#selectStrokeiframe').change(function(){
		jQuery('#Stroke').html(jQuery(this).val());
		updatepage();
	});

</script>


