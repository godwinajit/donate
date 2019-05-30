<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<div class="order-block">
    <h2>
        <?php _e( 'You have', 'woocommerce' ); ?>
        <a href="<?php print $woocommerce->cart->get_cart_url(); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a>
        <?php _e( 'in your cart', 'woocommerce' ); ?>
    </h2>

	<div class="clearfix"></div>

    <ul class="order-list">
    
        <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
    
            <?php
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { 
                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
    
                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
    
                        $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                        $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                        $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                
                ?>
                    
                    <li>
                        <?php echo str_replace( array( 'http:', 'https:', 'width="535"', 'height="250"' ), array('', '', 'width="111"', 'height="80"'), $thumbnail )?>
                        <h3><a href="<?php echo get_permalink( $product_id ); ?>">
                                <?php echo $product_name; ?>
                            </a>
                         </h3>
                        <span class="amount"><span><?php echo $cart_item['quantity'] ?>x</span> <?php echo strip_tags($product_price) ?></span>
                    </li>
                    <?php
                    
                    }
                }
            ?>
    
        <?php else : ?>
    
            <li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>
    
        <?php endif; ?>
    
    </ul><!-- end product list -->

<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

	<div class="subtotal-order"><span class="title"><?php _e( 'Subtotal', 'woocommerce' ); ?>:</span><?php echo WC()->cart->get_cart_subtotal(); ?></div>
	
	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="btn-cart"><?php _e( 'View Cart', 'woocommerce' ); ?></a>

<?php endif; ?>
	</div>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>