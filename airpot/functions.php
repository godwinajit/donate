<?php
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
function airpot_setup(){
	add_theme_support( 'post-thumbnails' );
	//set_post_thumbnail_size( 'single-post-thumbnail', 220, 180 );
}
add_action( 'after_setup_theme', 'airpot_setup' );

// Add scripts and styles to the header
function airpot_header_scripts() {
	wp_enqueue_style ( 'Bootstrap-Min', get_template_directory_uri () . '/css/bootstrap.css' );
	wp_enqueue_style ( 'Main-CSS', get_template_directory_uri () . '/css/style.css' );
	wp_enqueue_style ( 'Zoom-CSS', get_template_directory_uri () . '/css/multizoom.css' );
//12/24/16 Added style.css from main folder for adding edits to css
	wp_enqueue_style ( 'Secondary-CSS', get_template_directory_uri() . '/style.css' );
}
add_action ( 'wp_enqueue_scripts', 'airpot_header_scripts' );

// Add scripts to wp_footer()
function airpot_footer_script() {
	wp_enqueue_script ( 'jquery min', '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js' );
	wp_enqueue_script ( 'Bootstrap Min JS main', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js' );
	wp_enqueue_script ( 'jquery main', get_template_directory_uri () . '/js/jquery.main.js' );
	wp_enqueue_script ( 'Zoom main', get_template_directory_uri () . '/js/multizoom.js' );
	wp_enqueue_script ( 'elevatezoom', get_template_directory_uri () . '/js/jquery.elevatezoom.min.js' );
	wp_enqueue_script ( 'magnifierzoom', get_template_directory_uri () . '/js/jquery.magnifier.js' );
}
add_action ( 'wp_footer', 'airpot_footer_script' );

// Register widget areas.
function airpot_widgets_init() {
	require get_template_directory () . '/inc/airpot_nav_menu_widget.php';
	require get_template_directory () . '/inc/airpot_news_page.php';
	require get_template_directory () . '/inc/airpot_social_icons_widget.php';
	require get_template_directory () . '/inc/airpot_footer_news_widget.php';
	register_widget( 'Airpot_Nav_Menu_Widget' );
	register_widget( 'Airpot_Social_Icons_Widget' );
	register_widget( 'Airpot_Footer_News_Widget' );

	register_sidebar ( array (
	'name' => __ ( 'Header Section', 'airpot' ),
	'id' => 'sidebar-header',
	'description' => __ ( 'Header Content area.', 'airpot' ),
	'before_widget' => '',
	'after_widget' => ''
			) );

	register_sidebar ( array (
	'name' => __ ( 'Home Applications Section', 'airpot' ),
	'id' => 'sidebar-homeapplications',
	'description' => __ ( 'Home Applications Section', 'airpot' ),
	'before_widget' => '<section class="main-section">',
	'after_widget' => '</section>'
			) );

	register_sidebar ( array (
	'name' => __ ( 'Home Products Section', 'airpot' ),
	'id' => 'sidebar-homeproducts',
	'description' => __ ( 'Home Products Section', 'airpot' ),
	'before_widget' => '',
	'after_widget' => ''
			) );

	register_sidebar ( array (
	'name' => __ ( 'Footer Section', 'airpot' ),
	'id' => 'sidebar-footer',
	'description' => __ ( 'Footer Section here.', 'airpot' ),
	'before_widget' => '',
	'after_widget' => ''
	) );

	register_sidebar ( array (
	'name' => __ ( 'Footer News section', 'airpot' ),
	'id' => 'sidebar-news',
	'description' => __ ( 'Featured News Section', 'airpot' ),
	'before_widget' => '',
	'after_widget' => ''
			) );

	register_sidebar ( array (
			'name' => __ ( 'Featured Work Section', 'airpot' ),
			'id' => 'sidebar-featured',
			'description' => __ ( 'Featured Work Section', 'airpot' ),
			'before_widget' => '',
			'after_widget' => ''
	) );

	register_sidebar ( array (
				'name' => __ ( 'Contact Info Section', 'airpot' ),
				'id' => 'sidebar-contactinfo',
				'description' => __ ( 'Contact Info Section', 'airpot' ),
				'before_widget' => '',
				'after_widget' => ''
	) );
	register_sidebar ( array (
				'name' => __ ( 'Contact Us Section', 'airpot' ),
				'id' => 'sidebar-contactus',
				'description' => __ ( 'Contact Us Section', 'airpot' ),
				'before_widget' => '',
				'after_widget' => ''
			) );
	register_sidebar ( array (
	'name' => __ ( 'Email Subscription', 'airpot' ),
	'id' => 'sidebar-emailsubscription',
	'description' => __ ( 'Email Subscription', 'airpot' ),
	'before_widget' => '',
	'after_widget' => ''
			) );
				register_sidebar ( array (
	'name' => __ ( 'Products categories', 'airpot' ),
	'id' => 'sidebar-productcatgory',
	'description' => __ ( 'Products categories', 'airpot' ),
	'before_widget' => '',
	'after_widget' => ''
			) );

}
add_action ( 'widgets_init', 'airpot_widgets_init' );

function remove_widget_title($title) {
	if($title != '' && strpos($title,'{NOTITLE}') !== false){
		$title = "";
	}
	return $title;
}
add_filter ( 'widget_title', 'remove_widget_title' );

add_action( 'after_setup_theme', 'baw_theme_setup' );
function baw_theme_setup() {
	add_image_size( 'featured-work-thumb', 66, 66, true ); // (cropped)
	add_image_size( 'slider-image-thumb', 689, 486, true ); // (cropped)
	add_image_size( 'video-thumb', 257, 162, true ); // (cropped)
	add_image_size( 'home-applications-thumb', 406, 406, true ); // (cropped)
	add_image_size( 'home-products-thumb', 362, 321, true ); // (cropped)
	add_image_size( 'category-accordion-thumb', 298, 265, true ); // (cropped)
	add_image_size( 'sub-category-accordion-thumb', 101, 101, true ); // (cropped)
}


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section class="main-section inner123">
				<div class="container">';
}

function my_theme_wrapper_end() {
  echo '</div></section>';
}

add_action( 'init', 'airpot_remove_woo_sidebar' );
function airpot_remove_woo_sidebar() {

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}


add_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );

// Add product categories to the "Product" breadcrumb in WooCommerce.
// Get breadcrumbs on product pages that read: Home > Shop > Product category > Product Name
add_filter( 'woo_breadcrumbs_trail', 'woo_custom_breadcrumbs_trail_add_product_categories', 20 );
function woo_custom_breadcrumbs_trail_add_product_categories ( $trail ) {
	if ( ( get_post_type() === 'product' ) && is_singular() ) {
		global $post;
		$taxonomy = 'product_cat';
		$terms = get_the_terms( $post->ID, $taxonomy );
		$links = array();
		if ( $terms && ! is_wp_error( $terms ) ) {
			$count = 0;
			foreach ( $terms as $c ) {
				$count++;
				//if ( $count > 1 ) { continue; }
				$parents = woo_get_term_parents( $c->term_id, $taxonomy, true, ', ', $c->name, array() );
				if ( $parents != '' && ! is_wp_error( $parents ) ) {
					$parents_arr = explode( ', ', $parents );
					foreach ( $parents_arr as $p ) {
						if ( $p != '' ) { $links[] = $p; }
					}
				}
			}
			// Add the trail back on to the end.
			// $links[] = $trail['trail_end'];
			$trail_end = get_the_title($post->ID);
			// Add the new links, and the original trail's end, back into the trail.
			array_splice( $trail, 2, count( $trail ) - 1, $links );
			$trail['trail_end'] = $trail_end;
			//remove any duplicate breadcrumbs
			$trail = array_unique($trail);
		}
	}
	return $trail;
} // End woo_custom_breadcrumbs_trail_add_product_categories()
/**
 * Retrieve term parents with separator.
 *
 * @param int $id Term ID.
 * @param string $taxonomy.
 * @param bool $link Optional, default is false. Whether to format with link.
 * @param string $separator Optional, default is '/'. How to separate terms.
 * @param bool $nicename Optional, default is false. Whether to use nice name for display.
 * @param array $visited Optional. Already linked to terms to prevent duplicates.
 * @return string
 */
if ( ! function_exists( 'woo_get_term_parents' ) ) {
	function woo_get_term_parents( $id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array() ) {
		$chain = '';
		$parent = &get_term( $id, $taxonomy );
		if ( is_wp_error( $parent ) )
			return $parent;
		if ( $nicename ) {
			$name = $parent->slug;
		} else {
			$name = $parent->name;
		}
		if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
			$visited[] = $parent->parent;
			$chain .= woo_get_term_parents( $parent->parent, $taxonomy, $link, $separator, $nicename, $visited );
		}
		if ( $link ) {
			$chain .= '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $parent->name ) ) . '">'.$parent->name.'</a>' . $separator;
		} else {
			$chain .= $name.$separator;
		}
		return $chain;
	} // End woo_get_term_parents()
}


// Make products without price purchaseables
function disable_prices($purchasable, $product) {
	if ( $product->get_price() === '' ) $purchasable = true;
	return $purchasable;
}
add_filter('woocommerce_is_purchasable', 'disable_prices', 10, 2);



function woo_archive_custom_cart_button_text() {
	return __( 'ADD TO RFQ CART', 'woocommerce' );
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_archive_custom_cart_button_text' ,10);




//Store the custom field

function add_cart_item_custom_data_vase($product_id="",$variation_term_name="") {
	global $woocommerce;
	$product_id = $_POST['product_id']; //This is product ID
	$postedData = $_POST["variation_term_name"];
	$tempData = str_replace("\\", "",$postedData);
	$cleanData = json_decode($tempData);
	session_start();
	$_SESSION['wdm_user_custom_data'] = $cleanData;
	print_r($_SESSION['wdm_user_custom_data']);
	die();
}
add_action( 'wp_ajax_nopriv_add_cart_item_custom_data_vase', 'add_cart_item_custom_data_vase' );
add_action( 'wp_ajax_add_cart_item_custom_data_vase', 'add_cart_item_custom_data_vase' );


if(!function_exists('wdm_add_item_data'))
{
	function wdm_add_item_data($cart_item_data,$product_id)
	{
		/*Here, We are adding item in WooCommerce session with, wdm_user_custom_data_value name*/
		global $woocommerce;
		session_start();

		if (isset($_SESSION['PartNumber'])) {
			$option = $_SESSION['PartNumber'];
			$new_value = array('wdm_user_custom_data_value_new' => $option);
		}
		if(empty($option))
			return $cart_item_data;
		else
		{
			if(empty($cart_item_data))
				return $new_value;
			else
				return array_merge($cart_item_data,$new_value);
		}
		unset($_SESSION['PartNumber']);
		//Unset our custom session variable, as it is no longer needed.
	}
}

add_filter('woocommerce_add_cart_item_data','wdm_add_item_data',1,2);


if(!function_exists('wdm_get_cart_items_from_session'))
{
	function wdm_get_cart_items_from_session($item,$values,$key)
	{
		if (array_key_exists( 'wdm_user_custom_data_value_new', $values ) )
		{
			$item['wdm_user_custom_data_value_new'] = $values['wdm_user_custom_data_value_new'];
		}
		return $item;
	}
}
add_filter('woocommerce_get_cart_item_from_session', 'wdm_get_cart_items_from_session', 1, 3 );



/*if(!function_exists('wdm_add_user_custom_option_from_session_into_cart'))
{
	function wdm_add_user_custom_option_from_session_into_cart($product_name, $values, $cart_item_key )
	{
		/*code to add custom data on Cart & checkout Page*
		if(count($values['wdm_user_custom_data_value']) > 0)
		{
			$return_string = $product_name . "</a><div class='variation'>";
			$return_string .= "<table class='wdm_options_table' id='" . $values['product_id'] . "'>";
			foreach($values['wdm_user_custom_data_value'] as $value):
			$terms = wp_get_post_terms( $values['product_id'], $value->name, 'all' );
                // get the taxonomy
                $tax = $terms[0]->taxonomy;
                // get the tax object
                $tax_object = get_taxonomy($tax);
                // get tax label
                if ( isset ($tax_object->labels->name) ) {
                    $tax_label = $tax_object->labels->name;
                } elseif ( isset( $tax_object->label ) ) {
                    $tax_label = $tax_object->label;
                }

				//foreach ( $terms as $term ) {
					$return_string .= "<tr><td>" . $tax_label . ":</td><td>" . $value->value . "</td></tr>";
				//}
			endforeach;
			$return_string .= "</table></div>";
			return $return_string;
		}
		else
		{
			return $product_name;
		}
	}
}

add_filter('woocommerce_checkout_cart_item_quantity','wdm_add_user_custom_option_from_session_into_cart',1,3);
add_filter('woocommerce_cart_item_name','wdm_add_user_custom_option_from_session_into_cart',1,3);*/


if(!function_exists('wdm_add_values_to_order_item_meta'))
{
	function wdm_add_values_to_order_item_meta($item_id, $values)
	{
		global $woocommerce,$wpdb;
		$user_custom_values = $values['wdm_user_custom_data_value_new'];
		if(!empty($user_custom_values))
		{
			wc_add_order_item_meta($item_id,'PartNumber',$user_custom_values);
		}
	}
}
add_action('woocommerce_add_order_item_meta','wdm_add_values_to_order_item_meta',1,2);

if(!function_exists('wdm_remove_user_custom_data_options_from_cart'))
{
	function wdm_remove_user_custom_data_options_from_cart($cart_item_key)
	{
		global $woocommerce;
		// Get cart
		$cart = $woocommerce->cart->get_cart();
		// For each item in cart, if item is upsell of deleted product, delete it
		foreach( $cart as $key => $values)
		{
			if ( $values['wdm_user_custom_data_value_new'] == $cart_item_key )
				unset( $woocommerce->cart->cart_contents[ $key ] );
		}
	}
}

add_action('woocommerce_before_cart_item_quantity_zero','wdm_remove_user_custom_data_options_from_cart',1,1);




add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields');
function custom_woocommerce_billing_fields( $fields ) {
	$fields['billing_first_name'] = array(
			'label'=>'FIRST NAME',
			'class'     => array('form-group col-sm-12 col-md-6'),
			'input_class'       => array( 'form-control' ),
			'placeholder'   => _x('FIRST NAME', 'placeholder', 'woocommerce'),
			'required'  => true,

	);
	$fields['billing_last_name'] = array(
			'label'=>'LAST NAME',
			'class'     => array('form-group col-sm-12 col-md-6'),
			'input_class'       => array( 'form-control' ),
			'placeholder'   => _x('LAST NAME', 'placeholder', 'woocommerce'),
			'required'  => true,

	);
	$fields['billing_company'] = array(
			'label'=>'COMPANY NAME',
			'class'     => array('form-group'),
			'input_class'       => array( 'form-control' ),
			'placeholder'   => _x('COMPANY NAME', 'placeholder', 'woocommerce'),
			'required'  => true,

	);
	$fields['billing_address_1'] = array(
			'label'=>'STREET ADDRESS',
			'class'     => array('form-group'),
			'input_class'       => array( 'form-control' ),
			'placeholder'   => _x('STREET ADDRESS', 'placeholder', 'woocommerce'),
			'required'  => true,

	);
	$fields['billing_postcode'] = array(
			'label'=>'ZIP',
			'class'     => array('form-group row col-sm-6'),
			'input_class'       => array( 'form-control' ),
			'placeholder'   => _x('ZIP', 'placeholder', 'woocommerce'),
			'required'  => true,

	);
	$fields['billing_city'] = array(
			'label'=>'CITY',
			'class'     => array('form-group row col-sm-6'),
			'input_class'       => array( 'form-control' ),
			'placeholder'   => _x('CITY', 'placeholder', 'woocommerce'),
			'required'  => true,

	);
	unset( $fields['billing_address_2'] );

	$fields['billing_phone'] = array(
			'label'=>'PHONE',
			'class'     => array('form-group form-row-wide '),
			'input_class'       => array( 'form-control' ),
			'placeholder'   => _x('PHONE', 'placeholder', 'woocommerce'),
			'required'  => true,

	);
	$fields['billing_email'] = array(
			'label'=>'E-MAIL',
			'class'     => array('form-group form-row-wide'),
			'input_class'       => array( 'form-control' ),
			'placeholder'   => _x('E-MAIL', 'placeholder', 'woocommerce'),
			'required'  => true,

	);

	$fields['billing_comments'] = array(
			'label'=>'COMMENT or QUESTION',
			'type'              => 'textarea',
			'placeholder'   => _x('COMMENT or QUESTION', 'placeholder', 'woocommerce'),
			'required'  => true,
			'class'     => array('form-group'),
			'clear'     => true,
			'custom_attributes' => array( 'rows' => 5, 'cols' => 10 ),
	);
	$fields['billing_optionsRadios'] = array(
			'type'              => 'radio',
			'class'     => array('indent-form radio'),
			'options'           => array( 'option1' => 'One Time Needed' , 'option2' => 'Recurring Needed')
	);

	return $fields;
}

/**
 *  Personal Information form
 */

function additional_felds() {
	global $post;

	if (is_singular()) :
	$current_url = get_permalink($post->ID);
	else :
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$current_url = $pageURL;
	endif;
	$redirect = $current_url;

	ob_start();

	global $current_user;
	get_currentuserinfo();




	$phone=get_the_author_meta( 'phone', $current_user->ID );
	$fax=get_the_author_meta( 'fax', $current_user->ID );




	?>

		<?php if(isset($_GET['save-changes']) && $_GET['save-changes'] == 'true') { ?>
			<div class="pippin_message success">
				<span><?php _e('Personal Information has been updated', 'rcp'); ?></span>
			</div>
		<?php } ?>
		<form id="pippin_password_form" method="POST"  class="form" action="<?php echo $current_url; ?>">

										<div class="row">
											<div class="col-sm-12 col-md-6">
												<div class="form-group">
													<input type="text"  name="first_name"   value="<?php echo $current_user->user_firstname; ?>" class="form-control"  placeholder="FIRST NAME">
												</div>
											</div>
											<div class="col-sm-12 col-md-6">
												<div class="form-group">
													<input type="text"   name="last_name"   value="<?php echo $current_user->user_lastname; ?>" class="form-control" placeholder="LAST NAME" >
												</div>
											</div>
										</div>
										<div class="form-group">
											<input type="email"   name="email" value="<?php echo $current_user->user_email; ?>" class="form-control" id="exampleInputEmail1" placeholder="E-MAIL ADDRESS">
										</div>
										 <div class="form-group">
											<input type="text"    name="phone"   value="<?php echo $phone; ?>"  class="form-control" placeholder="PHONE">
										</div>
										 <div class="form-group">
											<input type="text"   name="fax"    value="<?php echo $fax; ?>"  class="form-control" placeholder="FAX NUMBER">
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox"> Subscribe for Newsletter </label>
										</div>
										<input type="hidden" name="pippin_action" value="save-changes"/>
										<input type="hidden" name="pippin_redirect" value="<?php echo $redirect; ?>"/>
										<input type="hidden" name="pippin_password_nonce" value="<?php echo wp_create_nonce('rcp-password-nonce'); ?>"/>
										<button type="submit" class="btn btn-default center-block">Submit Changes</button>

		</form>
	<?php
	return ob_get_clean();
}

/**
 *  Change password
 */

function pippin_change_password_form() {
	global $post;

	if (is_singular()) :
	$current_url = get_permalink($post->ID);
	else :
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	else $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$current_url = $pageURL;
	endif;
	$redirect = $current_url;

	ob_start();
 if(isset($_GET['password-reset']) && $_GET['password-reset'] == 'true') { ?>
			<div class="pippin_message success">
				<span><?php _e('Password changed successfully', 'rcp'); ?></span>
			</div>
		<?php } ?>

		<form id="pippin_password_form" method="POST"  class="form" action="<?php echo $current_url; ?>">
			<fieldset>

					 <div class="form-group">
					<input name="pippin_user_old_pass" id="pippin_user_old_pass" class="required form-control" placeholder="OLD PASSWORD" type="password"/>
					</div>

					 <div class="form-group">
					<input name="pippin_user_pass" id="pippin_user_pass" class="required form-control" placeholder="NEW PASSWORD" type="password"/>
					</div>

				<div class="form-group">
					<input name="pippin_user_pass_confirm" id="pippin_user_pass_confirm" class="required  form-control" placeholder="CONFIRM PASSWORD" type="password"/>
				</div>

				<p>
					<input type="hidden" name="pippin_action" value="reset-password"/>
					<input type="hidden" name="pippin_redirect" value="<?php echo $redirect; ?>"/>
					<input type="hidden" name="pippin_password_nonce" value="<?php echo wp_create_nonce('rcp-password-nonce'); ?>"/>
					<input id="pippin_password_submit" class="btn btn-default center-block" type="submit" value="<?php _e('Change Password', 'pippin'); ?>"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

// password reset form
function pippin_reset_password_form() {
	if(is_user_logged_in()) {
		return pippin_change_password_form();
	}
}
add_shortcode('password_form', 'pippin_reset_password_form');
add_shortcode('additional_inforamtion_form', 'additional_felds');


function pippin_reset_password() {
	// reset a users password

if(isset($_POST['pippin_action']) && $_POST['pippin_action'] == 'save-changes') {
global $user_ID;


		if($_POST['email'] == '') {
			// password(s) field empty
			pippin_errors()->add('password_empty', __('Please enter a email', 'pippin'));
		}

		//$wpdb->query($wpdb->prepare("UPDATE wp_users SET user_phone='9940516144' WHERE userid=9"));

		// retrieve all error messages, if any
			$errors = pippin_errors()->get_error_messages();

			if(empty($errors)) {
				// change the password here
				global $current_user;
				get_currentuserinfo();

				$user_data = array(
						'ID' => $user_ID,
						'user_email' => $_POST['email']
				);
				wp_update_user($user_data);

				update_user_meta( $current_user->ID , 'phone', $_POST['phone'], '' );
				update_user_meta( $current_user->ID , 'fax', $_POST['fax'], '' );
				update_usermeta( $current_user->ID, "first_name", $_POST['first_name'] );
				update_usermeta( $current_user->ID, "last_name", $_POST['last_name'] );

				wp_redirect(add_query_arg('save-changes', 'true', $_POST['pippin_redirect']));
				exit;
			}





}
	if(isset($_POST['pippin_action']) && $_POST['pippin_action'] == 'reset-password') {

		global $user_ID;



		global $current_user;
		get_currentuserinfo();



		if(!is_user_logged_in())
			return;

		if(wp_verify_nonce($_POST['pippin_password_nonce'], 'rcp-password-nonce')) {



			if($_POST['pippin_user_pass'] == '' || $_POST['pippin_user_pass_confirm'] == '') {
				// password(s) field empty
				pippin_errors()->add('password_empty', __('Please enter a password, and confirm it', 'pippin'));
			}
			if($_POST['pippin_user_pass'] != $_POST['pippin_user_pass_confirm']) {
				// passwords do not match
				pippin_errors()->add('password_mismatch', __('Passwords do not match', 'pippin'));
			}

			if($_POST['pippin_user_old_pass'] != '') {
				// OLd password(s) checking

					if (!wp_check_password( $_POST['pippin_user_old_pass'], $current_user->user_pass, $user_ID) )
						pippin_errors()->add('password_empty', __('Old password wrong', 'pippin'));
			}


			// retrieve all error messages, if any
			$errors = pippin_errors()->get_error_messages();

			if(empty($errors)) {
				// change the password here
				$user_data = array(
					'ID' => $user_ID,
					'user_pass' => $_POST['pippin_user_pass']
				);
				wp_update_user($user_data);
				// send password change email here (if WP doesn't)
				wp_redirect(add_query_arg('password-reset', 'true', $_POST['pippin_redirect']));
				exit;
			}
		}
	}
}
add_action('init', 'pippin_reset_password');

if(!function_exists('pippin_show_error_messages')) {
	// displays error messages from form submissions
	function pippin_show_error_messages() {
		if($codes = pippin_errors()->get_error_codes()) {
			echo '<div class="pippin_message error" style="text-align:center;padding:10px">';
			    // Loop error codes and display errors
			   foreach($codes as $code){
			        $message = pippin_errors()->get_error_message($code);
			        echo '<span class="pippin_error" ><strong>' . __('Error', 'rcp') . '</strong>: ' . $message . '</span><br/>';
			    }
			echo '</div>';
		}
	}
}

if(!function_exists('pippin_errors')) {
	// used for tracking error messages
	function pippin_errors(){
	    static $wp_error; // Will hold global variable safely
	    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
	}
}




/**
 *** Customizing checkout fields
 **/
add_filter( 'woocommerce_default_address_fields' , function($address_fields) {
	$fields = array(

			'first_name' => array(
				'label'    => __( 'First Name', 'woocommerce' ),
				'required' => true,
				'class'    => array( 'form-row-first' ),
			),
			'last_name' => array(
				'label'    => __( 'Last Name', 'woocommerce' ),
				'required' => true,
				'class'    => array( 'form-row-last' ),
				'clear'    => true
			),
			'company' => array(
				'label' => __( 'Company Name', 'woocommerce' ),
				'class' => array( 'form-row-wide' ),
			),
			'address_1' => array(
				'label'       => __( 'Address', 'woocommerce' ),
				'placeholder' => _x( 'STREET ADDRESS', 'placeholder', 'woocommerce' ),
				'required'    => true,
				'class'       => array( 'form-row-wide', 'address-field' )
			),
			'address_2' => array(
				'placeholder' => _x( 'Apartment, suite, unit etc. (optional)', 'placeholder', 'woocommerce' ),
				'class'       => array( 'form-row-wide', 'address-field' ),
				'required'    => false
			),
			'postcode' => array(
					'label'       => __( 'ZIP', 'woocommerce' ),
					'placeholder' => __( 'ZIP', 'woocommerce' ),
					'required'    => true,
					'class'       => array( 'form-row', 'address-field' ),
					'clear'       => true,
					'validate'    => array( 'postcode' )
			),
			'city' => array(
				'label'       => __( 'City', 'woocommerce' ),
				'placeholder' => __( 'CITY', 'woocommerce' ),
				'required'    => true,
				'class'       => array( 'form-row-wide', 'address-field' )
			),

			'country' => array(
					'type'     => 'country',
					'label'    => __( 'COUNTRY', 'woocommerce' ),
					'required' => true,
					'class'    => array( 'col-sm-12 col-md-6', 'address-field', 'update_totals_on_change' ),
			),
			'state' => array(
				'type'        => 'state',
				'label'       => __( 'STATE', 'woocommerce' ),
				'required'    => true,
				'class'       => array( 'col-sm-12 col-md-6', 'address-field' ),
				'validate'    => array( 'state' )
			),


		);
	return $fields;
});

function category_has_child($parent_id){
	$childCategory = get_categories( array(
			'parent'       => $parent_id,
			'menu_order'   => 'ASC',
			'hide_empty'   => 0,
			'hierarchical' => 1,
			'taxonomy'     => 'product_cat',
			'pad_counts'   => 0,
			'orderby' => 'order'
	)  );
	if(count($childCategory) > 0 ) return true; else return false;

}


function get_product_categories($parent_id){
	return get_categories( array(
			'parent'       => $parent_id,
			'menu_order'   => 'ASC',
			'hide_empty'   => 0,
			'hierarchical' => 1,
			'taxonomy'     => 'product_cat',
			'pad_counts'   => 0,
			'orderby' => 'order'
	)  );
}

function get_category_image($category_id,$default_image){
	$thumbnail_id = get_woocommerce_term_meta ( $category_id, 'thumbnail_id', true );
	$image = wp_get_attachment_url ( $thumbnail_id, 'full' );
	if (empty ( $image ))
	{
		$image =  get_template_directory_uri().'/images/'.$default_image;
	}
	else
	{
		$image = $image;
	}
	return $image;
}




// define the woocommerce_before_order_itemmeta callback To dispaly the custom values in the order details
function action_woocommerce_before_order_itemmeta( $item_id, $item, $product )
{
	if(count($item['PartNumber'])>0):
		$custom_data = maybe_unserialize($item['PartNumber'] );
			$return_string = "<div class='variation'>";
			$return_string .= "<table class='wdm_options_table' id='" . $item['product_id'] . "'>";
				/*foreach($custom_data as $value):
					$terms = wp_get_post_terms( $item['product_id'], $value->name, 'all' );
					// get the taxonomy
					$tax = $terms[0]->taxonomy;
					// get the tax object
					$tax_object = get_taxonomy($tax);
					// get tax label
					if ( isset ($tax_object->labels->name) ) {
						$tax_label = $tax_object->labels->name;
					} elseif ( isset( $tax_object->label ) ) {
						$tax_label = $tax_object->label;
					}	*/
					$return_string .= "<tr><td>" . $custom_data. ":</td></tr>";
		/*		endforeach;*/


			$return_string .= "</table></div>";
		echo $return_string;

	endif;
};
// add the action
add_action( 'woocommerce_before_order_itemmeta', 'action_woocommerce_before_order_itemmeta', 10, 3 );


// define the woocommerce_email_order_meta callback
// define the woocommerce_before_order_itemmeta callback To dispaly the custom values in the order details
function action_woocommerce_order_item_meta_start( $item_id, $item, $order )
{
	if(count($item['PartNumber'])>0):
		$custom_data = maybe_unserialize($item['PartNumber'] );
			$return_string = "<div class='variation'>";
			$return_string .= "<table class='wdm_options_table' id='" . $item['product_id'] . "'>";
				/*foreach($custom_data as $value):
					$terms = wp_get_post_terms( $item['product_id'], $value->name, 'all' );
					// get the taxonomy
					$tax = $terms[0]->taxonomy;
					// get the tax object
					$tax_object = get_taxonomy($tax);
					// get tax label
					if ( isset ($tax_object->labels->name) ) {
						$tax_label = $tax_object->labels->name;
					} elseif ( isset( $tax_object->label ) ) {
						$tax_label = $tax_object->label;
					}
					$return_string .= "<tr><td>" . $tax_label . ":</td><td>" . $value->value . "</td></tr>";
				endforeach;*/
			$return_string .= "<tr><td>" . $custom_data. ":</td></tr>";

			$return_string .= "</table></div>";
		echo $return_string;

	endif;
};
// add the action
add_action( 'woocommerce_order_item_meta_start', 'action_woocommerce_order_item_meta_start', 10, 3 );

function demo($mimes) {
	if ( function_exists( 'current_user_can' ) )
		$unfiltered = $user ? user_can( $user, 'unfiltered_html' ) : current_user_can( 'unfiltered_html' );
	if ( !empty( $unfiltered ) ) {
		$mimes['swf'] = 'application/x-shockwave-flash';
		$mimes['flv'] = 'video/x-flv';
		$mimes['svg'] = 'image/svg+xml';
	}
	return $mimes;
}
add_filter('upload_mimes','demo');

//Define constants for woocommerce attributes
//Select Damping Direction
define("TWO-WAY", "A");
define("PULL", "B");
define("PUSH", "C");
//Rod Configuration
define("058DIA304STAINLESSSTEEL", "N");
define("PLAINEND", "W");
define("BALLUNIVERSAL-10-32THREAD", "X");
define("LOOPWITH156IDREMOVABLERULONBUSHING", "Y");
define("PINLINKWITH2-64THREAD", "F");
define("BALLUNIVERSAL-4-40THREAD", "F");
define("187DIAALUMINUM", "T");
define("250DIASS-STANDARD", "T");
define("10-32THREADEDPLAINEND", "V");
define("14-28THREADEDPLAINEND", "V");
//Included Accessories&Other Options
define("IMPACTRESISTANTCASE-EPDM", "K");
define("DAMPINGADJUSTMENTKNOB-NYLONDONOTEXCEED093MOUNTINGBRACKETTHICKNESS", "M");
define("DAMPINGADJUSTMENTKNOB-NYLON", "M");
define("CYLINDERPORTCROSSSLOT", "R");


function configure_your_part($product_id="",$variation_term="") {
	global $woocommerce;
	 $product_id = $_POST['product_id']; //This is product ID
	 $postedData = $_POST["variation_term"];
	/*$selected=split("#",$postedData);

	$partnum =$product_id;
	foreach($selected as $selectedval):
	if (is_numeric($selectedval)) {
		$partnum.=$selectedval;
	}else{
		$HiddenProducts = explode(',',$selectedval);
		if(is_array($HiddenProducts))
		{
			foreach($HiddenProducts as $HiddenProduct):
			$partnum.=$HiddenProduct;
			endforeach;
		}else{
		$partnum.=$selectedval;
		}
	}
	endforeach;	*/
	session_start();
	$_SESSION['PartNumber'] = $postedData;
	print_r($_SESSION['PartNumber']);
	die();
}
add_action( 'wp_ajax_nopriv_configure_your_part', 'configure_your_part' );
add_action( 'wp_ajax_configure_your_part', 'configure_your_part' );



if(!function_exists('wdm_add_item_data_new'))
{
	function wdm_add_item_data_new($cart_item_data,$product_id)
	{
		/*Here, We are adding item in WooCommerce session with, wdm_user_custom_data_value name*/
		global $woocommerce;
		session_start();

		if (isset($_SESSION['PartNumber'])) {
			$option = $_SESSION['PartNumber'];
			$new_value = array('wdm_user_custom_data_value_new' => $option);
		}
		if(empty($option))
			return $cart_item_data;
		else
		{
			if(empty($cart_item_data))
				return $new_value;
			else
				return array_merge($cart_item_data,$new_value);
		}
		unset($_SESSION['PartNumber']);
		//Unset our custom session variable, as it is no longer needed.
	}
}

add_filter('woocommerce_add_cart_item_data','wdm_add_item_data_new',1,2);


if(!function_exists('wdm_get_cart_items_from_session_new'))
{
	function wdm_get_cart_items_from_session_new($item,$values,$key)
	{
		if (array_key_exists( 'wdm_user_custom_data_value_new', $values ) )
		{
			$item['wdm_user_custom_data_value_new'] = $values['wdm_user_custom_data_value_new'];
		}
		return $item;
	}
}
add_filter('woocommerce_get_cart_item_from_session', 'wdm_get_cart_items_from_session_new', 1, 3 );


if(!function_exists('wdm_add_user_custom_option_from_session_into_cart_new'))
{
	function wdm_add_user_custom_option_from_session_into_cart_new($product_name, $values, $cart_item_key )
	{
		/*code to add custom data on Cart & checkout Page*/
		if(count($values['wdm_user_custom_data_value_new']) > 0)
		{
			$return_string = $product_name . "</a><div class='variation'>";
			$return_string .= "<table class='wdm_options_table' id='" . $values['product_id'] . "'>";
			$return_string .=$values['wdm_user_custom_data_value_new'];

			$return_string .= "</table></div>";
			return $return_string;
		}
		else
		{
			return $product_name;
		}
	}
}

add_filter('woocommerce_checkout_cart_item_quantity','wdm_add_user_custom_option_from_session_into_cart_new',1,3);
add_filter('woocommerce_cart_item_name','wdm_add_user_custom_option_from_session_into_cart_new',1,3);

add_action( 'wp_ajax_nopriv_ajax_getContinentList', 'ajax_getContinentList' );
add_action( 'wp_ajax_ajax_getContinentList', 'ajax_getContinentList' );

function ajax_getContinentList() {
	global $wpdb;
	$continentList = $wpdb->get_results(
			"select
    			taxonomy.term_id,terms.name
			from
    			$wpdb->term_taxonomy as taxonomy
        	inner join
    			$wpdb->terms as terms ON taxonomy.term_taxonomy_id = terms.term_id
        		and taxonomy.taxonomy = 'territories'
        		and taxonomy.parent = 0  order by terms.name ASC;
			"
	);
	$continentListArr = array();
	foreach($continentList as $key => $value) {
		$continentListArr[$value->term_id] = $value->name;
	}
	echo json_encode($continentListArr);
	die();
}

add_action( 'wp_ajax_nopriv_ajax_getCountryList', 'ajax_getCountryList' );
add_action( 'wp_ajax_ajax_getCountryList', 'ajax_getCountryList' );

function ajax_getCountryList() {
	global $wpdb;
	$continent = $_REQUEST['continent'];
	$countryList = $wpdb->get_results(
			"select
			taxonomy.term_id,terms.name
			from
			$wpdb->term_taxonomy as taxonomy
			inner join
			$wpdb->terms as terms ON taxonomy.term_taxonomy_id = terms.term_id
			and taxonomy.taxonomy = 'territories'
			and taxonomy.parent = $continent order by terms.name ASC;
			"
	);
			$countryListArr = array();
			foreach($countryList as $key => $value) {
				$countryListArr[] = array('term_id' => "$value->term_id" ,'name' => "$value->name");
			}
			echo json_encode($countryListArr);
			die();
}


add_action( 'wp_ajax_nopriv_ajax_getRepresentativeList', 'ajax_getRepresentativeList' );
add_action( 'wp_ajax_ajax_getRepresentativeList', 'ajax_getRepresentativeList' );

function ajax_getRepresentativeList() {
	global $wpdb;

	$country = $_REQUEST['country'];
	$product_line = $_REQUEST['product_line'];
	$current_page_id = $_REQUEST['current_page_id'];
	$representativeList = $wpdb->get_results(
			"SELECT
    			wposts.ID, wposts.post_title, wposts.post_content
			FROM
    			wp_posts AS wposts
        INNER JOIN
    			wp_term_relationships AS term_relationships ON wposts.ID = term_relationships.object_id
        INNER JOIN
    			wp_postmeta AS wpostmeta
		WHERE
    			wposts.post_status = 'publish'
        AND wposts.post_type = 'representative'
        AND term_relationships.term_taxonomy_id = $country
        AND wpostmeta.meta_key = '$product_line'
        AND wpostmeta.meta_value = 1
		GROUP BY wposts.ID
		ORDER BY wposts.post_title ASC;
			"
	);

	$representativeListStr = "";
	$representativeItemNo = 0;
	
	if(!empty($representativeList)){
		foreach($representativeList as $representative){
			if( ($representativeItemNo % 2) == 0 )$representativeListStr .= '<div class="row">';
			$representativeListStr .= '<div class="col-sm-6">';
			if($representative->post_title != '')				$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Name:</span>'.$representative->post_title.'<br>';
			if(get_field("street_address",$representative->ID))	$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Address:</span>'.get_field("street_address",$representative->ID).'<br>';
			if(get_field("city",$representative->ID))			$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">City:</span>'.get_field("city",$representative->ID).'<br>';
			if(get_field("state",$representative->ID))			$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">State/Province:</span> '.get_field("state",$representative->ID).'<br>';
			if(get_field("zip_code",$representative->ID))		$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Zip:</span> '.get_field("zip_code",$representative->ID).'<br>';
			if(get_field("country",$representative->ID))		$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Country:</span> '.get_field("country",$representative->ID).'<br>';
			if(get_field("phone",$representative->ID))			$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Phone:</span> '.get_field("phone",$representative->ID).'<br>';
			if(get_field("fax",$representative->ID))			$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Fax:</span> '.get_field("fax",$representative->ID).'<br>';
			if(get_field("email",$representative->ID))			$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Email:</span> <a href="mailto:'.get_field("email",$representative->ID).'">'.get_field("email",$representative->ID).'</a><br>';
			if(get_field("website",$representative->ID))		$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Website:</span> <a target="_blank" href="'.get_field("website",$representative->ID).'">'.get_field("website",$representative->ID).'</a>';
			$representativeListStr .= '<p></p></div>';
			if( ($representativeItemNo % 2) == 1 )$representativeListStr .= '</div>';
			$representativeItemNo++;
		}
	}else{
		if(get_field("name", $current_page_id))						$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Name:</span>'.get_field("name", $current_page_id).'<br>';
		if(get_field("street_address", $current_page_id))							$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Address:</span>'.get_field("street_address", $current_page_id).'<br>';
		if(get_field("city", $current_page_id))									$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">City:</span>'.get_field("city", $current_page_id).'<br>';
		if(get_field("state", $current_page_id))									$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">State/Province:</span> '.get_field("state", $current_page_id).'<br>';
		if(get_field("zip_code", $current_page_id))								$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Zip:</span> '.get_field("zip_code", $current_page_id).'<br>';
		if(get_field("country", $current_page_id))								$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Country:</span> '.get_field("country", $current_page_id).'<br>';
		if(get_field("phone", $current_page_id))									$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Phone:</span> '.get_field("phone", $current_page_id).'<br>';
		if(get_field("fax", $current_page_id))									$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Fax:</span> '.get_field("fax", $current_page_id).'<br>';
		if(get_field("email", $current_page_id))									$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Email:</span> <a href="mailto:'.get_field("email", $current_page_id).'">'.get_field("email", $current_page_id).'</a><br>';
		if(get_field("website", $current_page_id))								$representativeListStr .= '<span style="font-weight: bolder;padding-right: 10px;">Website:</span> <a target="_blank" href="'.get_field("website", $current_page_id).'">'.get_field("website", $current_page_id).'</a>';
	}
	echo $representativeListStr;
	die();
}

add_action('admin_head', 'admin_custom_style');
function admin_custom_style() {
	   echo '<style type="text/css">
		   #acf-category_custom_specs select{width: 100%;}
		 </style>';
}

add_filter( 'wc_add_to_cart_message', 'custom_add_to_cart_message' );
function custom_add_to_cart_message() {
    global $woocommerce;

        $message    =  'Product successfully added to your RFQ.';
    return $message;
}

function airpot_display_email_order_meta( $order, $sent_to_admin, $plain_text ) {
    $billing_comments = get_post_meta( $order->id, '_billing_comments', true );
    $optionsRadios = get_post_meta( $order->id, '_billing_optionsRadios', true );
    if( $plain_text ){
        echo 'Comments : ' . $billing_comments . ' Recurring : ' . $optionsRadios;
    } else {
        if($billing_comments) echo '<p>Comments : ' . $billing_comments. '</p>';
        if($optionsRadios){
        	if($optionsRadios == 'option1')echo '<p>Recurring : One Time Needed.</p>';
        	else if($optionsRadios == 'option2')echo '<p>Recurring : Recurring Needed.</p>';
        }
    }
}
add_action('woocommerce_email_customer_details', 'airpot_display_email_order_meta', 30, 3 );