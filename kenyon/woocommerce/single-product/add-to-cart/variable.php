<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<!-- Production Varient Image and Description start -->
<div class="kenyon-product-var-image-desc-wrap" style="text-align: center;">
	<div class="kenyon-product-var-image-wrap">
		<img src="" srcset="" class="kenyon-product-var-image-src" alt="">
	</div>
	<div class="kenyon-product-var-desc">
	</div>
	<br>
</div>
<!-- Production Varient Image and Description End -->

<form class="variations_form cart option-form" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
    <fieldset>
	<?php if ( ! empty( $available_variations ) ) : ?>
		<div class="variations">
				<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
                <div class="area clearfix">
						<label for="<?php echo sanitize_title($name); ?>">
							<?php echo wc_attribute_label( $name ); ?> 
							<?php if (has_term('grills', 'product_cat', get_the_ID())) : ?>
								<?php
									global $tooltips;
									$tooltip = isset($tooltips[sanitize_title($name)]) ? $tooltips[sanitize_title($name)] : null;
									
									if ($tooltip) : ?>
									<span class="tooltip-opener" rel="tooltip" title="<?php echo $tooltip; ?>">[?]</span>
									<?php endif; 
								?>
							<?php endif; ?>
						</label>
                        <div class="select-holder">
                            <select id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" name="attribute_<?php echo sanitize_title( $name ); ?>" class="default">
                                <option value=""><?php echo __( 'Choose an option', 'woocommerce' ) ?>&hellip;</option>
                                <?php
                                    if ( is_array( $options ) ) {

                                        if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
                                            $selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
                                        } elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
                                            $selected_value = $selected_attributes[ sanitize_title( $name ) ];
                                        } else {
                                            $selected_value = '';
                                        }

                                        // Get terms if this is a taxonomy - ordered
                                        if ( taxonomy_exists( $name ) ) {

                                            $orderby = wc_attribute_orderby( $name );

                                            switch ( $orderby ) {
                                                case 'name' :
                                                    $args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
                                                break;
                                                case 'id' :
                                                    $args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false, 'hide_empty' => false );
                                                break;
                                                case 'menu_order' :
                                                    $args = array( 'menu_order' => 'ASC', 'hide_empty' => false );
                                                break;
                                            }

                                            $terms = get_terms( $name, $args );

                                            foreach ( $terms as $term ) {
                                                if ( ! in_array( $term->slug, $options ) )
                                                    continue;

                                                echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
                                            }
                                        } else {

                                            foreach ( $options as $option ) {
                                                echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
                                            }

                                        }
                                    }
                                ?>
                            </select>
                        </div>
					</div>
                    <?php if ( sizeof( $attributes ) == $loop ) : ?>
                    <div class="area clearfix">
                        <?php echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>'; ?>
                    </div>
                    <?php endif; ?>
		        <?php endforeach;?>
				<?php woocommerce_quantity_input(); ?>
		</div>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		

		<div class="single_variation_wrap" style="display:none;">
			<?php do_action( 'woocommerce_before_single_variation' ); ?>

			<div class="default-price"><?php woocommerce_template_loop_price() ?></div>
			<div class="single_variation"></div>

			<div class="variations_button">
				
				<button type="submit" class="single_add_to_cart_button button alt btn btn-default btn-block"><?php echo $product->single_add_to_cart_text(); ?></button>
				<span class="button-disabled">
					<span class="info-txt">Please select all the required fields to add to your cart</span>
				</span>
			</div>

			<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
			<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="variation_id" value="" />

			<?php do_action( 'woocommerce_after_single_variation' ); ?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php else : ?>

		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>

	<?php endif; ?>
    </fieldset>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
