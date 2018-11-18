<?php
/**
 * Customer processing order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<p><?php _e( "Dear ", 'woocommerce' ); echo $order->billing_first_name; _e( ",", 'woocommerce' ); ?></p>
<p><?php _e( "Thank you! This email is to confirm your recent order with Kenyon. Once your order is on the way, UPS will send an email with tracking information included.", 'woocommerce' ); ?></p>

<h2><?php echo __( 'Order', 'woocommerce' ) . ' ' . $order->get_order_number() . ' ' . __( 'Details:', 'woocommerce' ); ?></h2>

<p><?php echo __( 'Date ', 'woocommerce' ) ; printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->order_date ) ), date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ); ?></p>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>

	<h3><?php _e( 'Shipping address', 'woocommerce' ); ?></h3>

	<p><?php echo $shipping; ?></p>

<?php endif; ?>

<h3><?php _e( 'Billing address', 'woocommerce' ); ?></h3>

<p><?php echo $order->get_formatted_billing_address(); ?></p>
			
			
<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<thead>
		<tr>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $order->email_order_items_table( $order->is_download_permitted(), true, $order->has_status( 'processing' ) ); ?>
	</tbody>
	<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th scope="row" colspan="2" style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
						<td style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
					</tr><?php
				}
			}
		?>
	</tfoot>
</table>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

<p><?php _e( 'If you have any questions or concerns, email us or call 860-664-4906 from 8:00 am Eastern time, Monday thru Friday and reference your order.', 'woocommerce' );  ?></p>

<?php do_action( 'woocommerce_email_footer' ); ?>