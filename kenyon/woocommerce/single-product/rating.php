<?php
/**
 * Single Product Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;

$count   = $product->get_rating_count();
$average = $product->get_average_rating();

$reviews_link = is_singular('product') ? '#reviews' : get_permalink() . '#reviews';

if ( $count > 0 ) : ?>

	<div class="frame" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="rating-box" title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
			<span class="rating" style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating-value"><?php echo esc_html( $average ); ?></strong>
			</span>
		</div>
		<a href="<?php echo $reviews_link ?>" class="woocommerce-review-link" rel="nofollow"><?php _e('Read users review', 'kenyon'); ?></a>
	</div>

<?php endif; ?>