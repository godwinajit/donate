<?php
/**
 * Edit address form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? __( 'Billing address', 'woocommerce' ) : __( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php else : ?>

	<form method="post">

		<h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h3>
		<div class="col2-set">
            <div class="col-1">
            <?php
            $count = 0; 
            foreach ( $address as $key => $field ) : 
            
            if($count-1 == ceil(sizeof($address)/2))
            	print '</div><div class="col-2">';
            ?>
    
                <?php woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) ); ?>
    
            <?php 
			$count++;
			endforeach; //exit; ?>
    
            <p>
                <input type="submit" class="btn btn-default" name="save_address" value="<?php _e( 'Save Address', 'woocommerce' ); ?>" />
                <?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
                <input type="hidden" name="action" value="edit_address" />
            </p>
            </div>
        </div>
	</form>

<?php endif; ?>