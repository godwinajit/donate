<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$lines = array();
foreach ( $item_data as $data ) :
    $key = sanitize_text_field( $data['key'] );
    $lines[] = wp_kses_post( $data['key'] ) . ': ' . wp_kses_post( $data['value'] );
endforeach;

echo join('&#13;', $lines);