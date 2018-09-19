<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

					<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post" role="form" class="form-product">
					
					<?php do_action( 'woocommerce_before_cart_table' ); ?>
					
				    	<div class="form-heading other">
							<div class="col-sm-8 col-md-9"><?php _e( 'Product', 'woocommerce' ); ?></div>
							<!-- <div class="col-sm-2 col-md-1"> <?php _e( 'Qty', 'woocommerce' ); ?> </div> -->
							<div class="col-sm-2"><?php _e( 'Action', 'woocommerce' ); ?></div>
						</div>
						
							<?php do_action( 'woocommerce_before_cart_contents' ); ?>
					
							<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								//echo "<pre>";
								//print_R($cart_item);
								$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					
								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									?>
									<article class="row product form-group <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
										<div class="img-holder col-sm-3 product-thumbnail">
											<?php
												$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					
												if ( ! $_product->is_visible() )
													echo $thumbnail;
												else
													printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
											?>
											<div style="font-size: 13px; color: gray;"><br>The image may vary from the exact configuration being quoted.</div>
										</div>
										<div class="content col-sm-5 col-md-6 product-name">
											<span class="position"><?php
												if ( ! $_product->is_visible() )
													echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
												else
													echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );
					
												// Meta data
												echo WC()->cart->get_item_data( $cart_item );
					
					               				// Backorder notification
					               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
					               					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
											?></span>
											<h2> <a href="<?php $_product->get_permalink( $cart_item );?>">Model:<?php echo get_post_meta($product_id, 'products_model', true );?> </a> </h2>
										</div>
										<!-- <div class="col-sm-2 col-md-1 product-quantity">
											<div class="form-group"><?php
												if ( $_product->is_sold_individually() ) {
													$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
												} else {
													$product_quantity = woocommerce_quantity_input( array(
														'input_name'  => "cart[{$cart_item_key}][qty]",
														'input_value' => $cart_item['quantity'],
														'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
														'min_value'   => '0'
													), $_product, false );
												}
					
												echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
											?></div>
										</div> -->
										 <div class="col-sm-2 product-remove">
										 	<?php
												echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class=" btn btn-default btn-sm" title="%s">Remove</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
											?>
										 </div>
									</article>
									
									
						
					
										<!-- <td class="product-price">
											<?php
												echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
											?>
										</td>-->
					
									<!-- 	<td class="product-subtotal">
											<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
											?>
										</td>-->
									</tr>
									<?php
								}
							}
					
							do_action( 'woocommerce_cart_contents' );
							?>
							<div class="row form-footer">
							<div class="col-sm-2">
							 		
							 		<!--<a class="btn btn-primary btn-sm btn-prev" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><span><?php _e( 'Back to Products', 'woocommerce' ) ?></span></a>-->
							 </div>
							 <div class="col-sm-offset-2 col-sm-2 col-md-offset-4 col-md-2">
							 	
							 	<!-- <input type="submit" class="btn btn-default btn-sm inner" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" /> -->
					
									<?php do_action( 'woocommerce_cart_actions' ); ?>
					
									<?php wp_nonce_field( 'woocommerce-cart' ); ?>
							 </div>
							<div class="col-sm-4 col-md-2">
								<div class="row">
									<!-- <label for="a5" class="col-sm-6 control-label">Total: </label>
									<div class="col-sm-6">
										<input type="text" id="a5" class="form-control" value="<?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?>" >
									</div> -->
								</div>
							</div>
							<div class="col-sm-2">
							 	
							 	<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="checkout wc-forward btn btn-primary btn-sm"><?php _e( 'Review RFQ', 'woocommerce' ); ?></a>
							 </div>
						</div>
							<!-- <tr>
								<td colspan="6" class="actions">
					
									<?php if ( WC()->cart->coupons_enabled() ) { ?>
										<div class="coupon">
					
											<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />
					
											<?php do_action( 'woocommerce_cart_coupon' ); ?>
					
										</div>
									<?php } ?>
					
									
								</td>
							</tr>-->
					
							<?php do_action( 'woocommerce_after_cart_contents' ); ?>
						
					
					<?php do_action( 'woocommerce_after_cart_table' ); ?>
					
					</form>
	
<!-- <div class="cart-collaterals">

	<?php //do_action( 'woocommerce_cart_collaterals' ); ?>

</div>-->

<?php do_action( 'woocommerce_after_cart' ); ?>
