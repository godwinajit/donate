<?php
/**
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post, $woocommerce, $product;
global $wp_query;
$current_category = $wp_query->get_queried_object();
$redirect_cat_to_product = get_field('redirect_to_product', 'product_cat_'.$current_category->term_id);
$redirect_cat_to_url = get_field('redirect_url', 'product_cat_'.$current_category->term_id);
$redirect_cat_to_page = get_field('current_redirect_page', 'product_cat_'.$current_category->term_id);
if( ($redirect_cat_to_product) || ($redirect_cat_to_url) ){
	if($redirect_cat_to_product){
		global $wpdb;
		$redirect_product_id = $wpdb->get_var( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = ".$redirect_cat_to_product." AND meta_key = 'products_id' ORDER BY post_id DESC") );
		wp_redirect(get_permalink($redirect_product_id), 302 );
		exit;
	}elseif($redirect_cat_to_url){
		wp_redirect($redirect_cat_to_page, 302 );
		exit;
	}
}?>
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

 ob_start();

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

<div class="row category_menu_sidebar" style="margin-bottom:80px;">
	<div class="col-sm-3">
	<?php dynamic_sidebar( 'sidebar-productcatgory' );?>
		<ul class="product-categories">
      		<li>
      			<?php if($product->id != 5306){?>
      				<a style="color: #555555 !important;" href="<?php echo get_permalink(5306);?>"><?php echo get_the_title(5306);?></a>
      			<?php }else{?>
      				<a style="color: #f47a20 !important;" href="<?php echo get_permalink(5306);?>"><?php echo get_the_title(5306);?></a>
      			<?php }?>
      		</li>
      	</ul>
	</div>
	<div class="col-sm-9 productcontainer">
		<div class="col-sm-12" >
			<div class="col-sm-9">
				<h1 style="text-transform: uppercase;"><?php echo $current_category->post_title;?></h1>
			</div>
			<div class="col-sm-3">
			<?php $logo_link= get_field('logo_image');
			if($logo_link){?>
			<img src="<?php echo $logo_link; ?>" alt="logo">
			<?php } ?>
			</div>	
		</div>
		<div class="content">
			<?php echo $current_category->post_content;?>
		</div>
		<div class="col-sm-12" >
			<div class="col-sm-5 gallery-image">
				<?php $attachment_ids = $product->get_gallery_attachment_ids();
				$image_link1 = wp_get_attachment_url( $attachment_ids[0] );
				$image_title = esc_attr( get_the_title( $attachment_ids[0] ) );
				if($image_link1){
				?>
					<a data-rel="lightbox[gallery1]" title="<?php echo $image_title;?>" href="<?php echo $image_link1; ?>"><img src="<?php echo $image_link1;?>" alt="<?php echo $image_title;?>" /></a>
				<?php } ?>
				<?php if( have_rows('related_files') ): ?>
					<div role="tabpanel" class="tab-pane <?php echo $activetab4;?>" id="tab-04">
					<?php
						while ( have_rows('related_files') ) : the_row();
							$related_file_name=get_sub_field('related_file_name');
							$related_file_title=get_sub_field('related_file_title');
					?>
							<a href="<?php echo $related_file_name;?>" target="_blank" style="font-size:25px;"><?php echo $related_file_title; ?></a>
						 <?php endwhile; ?>
					</div>
				<?php endif;?>
			</div>
			<div class="col-sm-7 thumbnailimage">
					<?php
							if (has_post_thumbnail ()) {
								
								$image_title = esc_attr ( get_the_title ( get_post_thumbnail_id () ) );
								$image_caption = get_post ( get_post_thumbnail_id () )->post_excerpt;
								$image_link = wp_get_attachment_url ( get_post_thumbnail_id () );
								$image = get_the_post_thumbnail ( $post->ID, apply_filters ( 'single_product_large_thumbnail_size', 'shop_single' ), array (
										'title' => $image_title,
										'alt' => $image_title
								) );
			
					if($image_link){?>
					<a data-rel="lightbox[gallery1]" title="<?php echo $image_caption;?>" href="<?php echo $image_link; ?>"><img src="<?php echo $image_link;?>" alt="<?php echo $image_caption;?>" /></a>
					<?php } ?>				
					<?php }							
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
											sprintf( '<div class="col-sm-2 cartbutton" ><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn btn-primary			btn %s product_type_%s">%s</a><div>',
											esc_url( $product->add_to_cart_url() ),
											esc_attr( $product->id ),
											esc_attr( $product->get_sku() ),
											$product->is_purchasable() ? 'add_to_cart_button' : '',
											esc_attr( $product->product_type ),
											'ADD TO RFQ CART'
											),
										$product );
							} ?>
			</div>
		</div>
	</div>
</div>