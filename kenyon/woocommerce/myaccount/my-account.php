<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wc_print_notices(); ?>

<div class="clearfix"></div>
<div class="woocommerce account">
    <div class="col-sm-4">
        <p class="myaccount_user">Welcome back, <strong><?php echo $current_user->display_name ?></strong></p>
        <ul class="btn-list">
            <li><a href="<?php echo admin_url( 'edit.php?post_type=shop_order' )?>" class="orders">View recent orders</a></li>
            <li><?php printf( __( '<a class="password" href="%s">Change password</a>.', 'woocommerce' ), wc_customer_edit_account_url() ); ?></li>
            <li><?php printf(__( '<a href="%2$s">Sign out</a>.', 'woocommerce' ) . ' ',"",wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )); ?></li>
        </ul>
       <?php woocommerce_get_template( 'cart/mini-cart.php' )?> 
       
    </div>
    <div class="col-sm-8">

        <?php do_action( 'woocommerce_before_my_account' ); ?>
        
        <?php wc_get_template( 'myaccount/my-address.php' ); ?>
        
        <?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

        <?php wc_get_template( 'myaccount/my-downloads.php' ); ?>
        
        <?php do_action( 'woocommerce_after_my_account' ); ?>
    
    </div>
</div>
