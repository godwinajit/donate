<?php
/**
 * Order tracking form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

?>

<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

	<p><?php _e( 'To track your RFQ please enter your RFQ ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></p>

	<p class="form-row form-row-first"><label for="orderid"><?php _e( 'RFQ ID', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Found in your RFQ confirmation email.', 'woocommerce' ); ?>" /></p>
	<p class="form-row form-row-last"><label for="order_email"><?php _e( 'Email', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Email you used during RFQ.', 'woocommerce' ); ?>" /></p>
	<div class="clear"></div>

	<p class="form-row"><input type="submit" class="button" name="track" value="<?php _e( 'Track', 'woocommerce' ); ?>" /></p>
	<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>

</form>
