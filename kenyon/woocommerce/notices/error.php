<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;

?>
<div class="col-sm-12">

<?php foreach ( $messages as $message ) : ?>
	<div class="alert alert-danger" role="alert">
		<?php echo wp_kses_post( $message ); ?>
   	</div>
<?php endforeach; ?>

</div>

