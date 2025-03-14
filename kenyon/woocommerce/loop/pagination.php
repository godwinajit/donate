<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ( $wp_query->max_num_pages <= 1 )
	return;
?>
<div class="text-center hidden-lg hidden-md">
    <ul class="pagination">
    <?php

        $links = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
            'base'         => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
            'format'       => '',
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'total'        => $wp_query->max_num_pages,
            'prev_text'    => '«',
            'next_text'    => '»',
            'type'         => 'array',
            'end_size'     => 2,
            'mid_size'     => 2
        ) ) );

        foreach ($links as $link) {
            echo '<li';
            if (strpos($link, 'current') !== false) {
                echo ' class="active"';
            }
            echo '>';
            echo $link;
            echo '</li>';
        }
    ?>
    </ul>
</div>