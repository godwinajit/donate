<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<?php global $woocommerce; ?>

<div class="col-sm-12">
</div>

<div class="clearfix"></div>

    <div class="col-sm-4">
     <?php woocommerce_get_template( 'cart/mini-cart.php' )?> 
    </div>
    <div class="col-sm-8">
		
        <form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">
        <div class="payment-holder">
            <?php  do_action( 'woocommerce_checkout_order_review' ); ?>
            <?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				
				<div id="add_payment_method">
					<h3><?php _e( 'Contact Details', 'kenyon' ); ?></h3>
					<div class="add-payment-method-fields">
						<?php woocommerce_form_field( 'billing_first_name', $checkout->checkout_fields['billing']['billing_first_name'], $checkout->get_value( 'billing_first_name' ) ); ?>
						<?php unset($checkout->checkout_fields['billing']['billing_first_name']); ?>
						
						<?php woocommerce_form_field( 'billing_last_name', $checkout->checkout_fields['billing']['billing_last_name'], $checkout->get_value( 'billing_last_name' ) ); ?>
						<?php unset($checkout->checkout_fields['billing']['billing_last_name']); ?>

						<?php woocommerce_form_field( 'billing_email', $checkout->checkout_fields['billing']['billing_email'], $checkout->get_value( 'billing_email' ) ); ?>
						<?php unset($checkout->checkout_fields['billing']['billing_email']); ?>
					</div>
				</div>

                <div class="col2-set" id="customer_details">

                    <div class="col-1">

                        <?php do_action( 'woocommerce_checkout_billing' ); ?>

                    </div>

                    <div class="col-2">

                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>

                    </div>

                </div>

                <?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

                <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>

                    <?php if ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) : ?>

                        <h3><?php _e( 'Additional Information', 'woocommerce' ); ?></h3>

                    <?php endif; ?>

                    <?php foreach ( $checkout->checkout_fields['order'] as $key => $field ) : ?>

                        <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

                    <?php endforeach; ?>

                <?php endif; ?>

                <?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>


                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

            <?php endif; ?>
		
            <?php wc_get_template( 'checkout/review-order-shipping-and-totalamount.php' )?>

        </form>
    </div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>