<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( ! woocommerce_products_will_display() )
	return;

$paged    = max( 1, $wp_query->get( 'paged' ) );
$per_page = $wp_query->get( 'posts_per_page' );
$total    = $wp_query->found_posts;
$first    = ( $per_page * $paged ) - $per_page + 1;
$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

echo $total;

?>