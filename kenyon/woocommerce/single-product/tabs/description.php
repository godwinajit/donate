<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

?>

<div id="overview">

    <?php theme_product_overview_gallery(); ?>

    <div class="text-block">
        <?php the_content(); ?>
    </div>
</div>