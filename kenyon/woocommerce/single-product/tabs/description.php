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
        <?php if(get_post_meta(get_the_ID(), 'proposition_65', true) == 'yes') : ?>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Proposition 65</h4>
		      </div>
		      <div class="modal-body">
		        <p><strong>WARNING:</strong> This product contains chemicals known to the State of California to cause cancer and/or reproductive harm, and birth defects or other reproductive harm. For more information: <a href="https://www.p65warnings.ca.gov/" target="_blank">www.p65warnings.ca.gov</a></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
        <p style="margin-top: 30px;"><img src="/wp-content/uploads/2019/04/warning-icon-16px.png" style="margin-top: 3px;" /> <a href="#" data-toggle="modal" data-target="#myModal" style="font-weight: 800;">WARNING:</a> California’s Proposition 65</p>
	<?php endif; ?>
    </div>
</div>