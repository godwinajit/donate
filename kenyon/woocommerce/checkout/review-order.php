<?php
/**
 * Review order form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ( ! is_ajax() ) : ?><div id="order_review"><?php endif; ?>

	<div class="shipping-block" style="display:none;">
    
    	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

				<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>
    
    </div>

	<div class="mycart_totals" style="display:none;">
		<table>
			<tbody>
            	<tr class="cart-subtotal">
					<th><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></th>
					<td><?php wc_cart_totals_subtotal_html(); ?></td>
				</tr>
            
            	<?php foreach ( WC()->cart->get_coupons( 'cart' ) as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
				<?php endforeach; ?>
                
            	<tr class="shipping">
					<th>Shipping &amp; handling</th>
					<td><span class="amount"></span></td>
				</tr>
                
                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee">
					<th><?php echo esc_html( $fee->name ); ?></th>
					<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
				</tr>
				<?php endforeach; ?>
                
                <?php if ( WC()->cart->tax_display_cart === 'excl' ) : ?>
					<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
						<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
							<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
								<th><?php echo esc_html( $tax->label ); ?></th>
								<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr class="tax-total">
							<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
							<td><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>
            
                <?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
					<tr class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
						<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
						<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
				<tr class="order-total">
					<th><?php _e( 'Order Total', 'woocommerce' ); ?></th>
					<td><?php wc_cart_totals_order_total_html(); ?></td>
				</tr>
				<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

			</tbody>
     	</table>
    </div>
     
	<?php do_action( 'woocommerce_review_order_before_payment' ); ?>

	<div id="payment">
    	
    	
    	
    	
		<?php if ( WC()->cart->needs_payment() ) : ?>
		<h3>Choose payment method</h3>
		<input type="hidden" name="payment_enable" value="yes" />
		<ul class="payment_methods methods">
			<?php
				$available_gateways = WC()->payment_gateways->get_available_payment_gateways();
				if ( ! empty( $available_gateways ) ) {

					foreach ( $available_gateways as $gateway ) {?>
					<li class="payment_method_<?php echo $gateway->id; ?>">
	<input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label for="payment_method_<?php echo $gateway->id; ?>">
		<?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?>
	</label>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo $gateway->id; ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif; ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>
			<?php	}
				} else {

				    if ( ! WC()->customer->get_billing_country() )
						$no_gateways_message = __( 'Please fill in your details above to see available payment methods.', 'woocommerce' );
					else
						$no_gateways_message = __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' );

					echo '<p>' . apply_filters( 'woocommerce_no_available_payment_methods_message', $no_gateways_message ) . '</p>';

				}
			?>
		</ul>
		<?php endif; ?>

		

		<div class="clear"></div>

	</div>

	<?php //do_action( 'woocommerce_review_order_after_payment' ); ?>

<?php if ( ! is_ajax() ) : ?></div><?php endif; ?>