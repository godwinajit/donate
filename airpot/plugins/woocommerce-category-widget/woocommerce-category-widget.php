<?php

/*
 *
 * Plugin Name: Woocommerce Category
 *
 * Plugin URI: http://www.supportlive24x7.com/
 *
 * Description: This is widget plugin which shows the list of woocommerce category.
 *
 * Version: 1.1.0
 *
 * Author: Arun Kushwaha- arunkushwaha87@gmail.com
 *
 * Author URI: http://www.supportlive24x7.com/
 *
 * License: GPL2
 *
 */
?>

<?php
class woocommerce_category extends WP_Widget {
	
	// constructor
	function woocommerce_category() {
		parent::WP_Widget ( false, $name = __ ( 'Woocommerce Category listing', 'woocommerce_category' ) );
	}
	
	// widget form creation
	function form($instance) {
		
		// Check values
		if ($instance) {
			
			$title = esc_attr ( $instance ['title'] );
			
			$subtitle = esc_attr ( $instance ['subtitle'] );
			
			$select = $instance ['category_id'];

			$show_title = $instance ['show_title'];
			
		} else {
			
			$title = '';
			
			$subtitle = '';
			
			$select = '';
			
			$show_title = '';
		}
		
		?>



<p>

	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Section Title', 'woocommerce_category'); ?></label>

	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
		name="<?php echo $this->get_field_name('title'); ?>" type="text"
		value="<?php echo $title; ?>" />

</p>

<p>

	<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Section Sub Title', 'woocommerce_category'); ?></label>

	<input class="widefat"
		id="<?php echo $this->get_field_id('subtitle'); ?>"
		name="<?php echo $this->get_field_name('subtitle'); ?>" type="text"
		value="<?php echo $subtitle; ?>" />

</p>


<?php
		
		$taxonomy = 'product_cat';
		
		$orderby = 'name';
		
		$show_count = 0; // 1 for yes, 0 for no
		
		$pad_counts = 0; // 1 for yes, 0 for no
		
		$hierarchical = 1; // 1 for yes, 0 for no
		
		$title = '';
		
		$subtitle = '';
		
		$empty = 0;
		
		$args = array (
				
				'taxonomy' => $taxonomy,
				
				'orderby' => $orderby,
				
				'show_count' => $show_count,
				
				'pad_counts' => $pad_counts,
				
				'hierarchical' => $hierarchical,
				
				'title_li' => $title,
				
				'subtitle_li' => $subtitle,
				
				'hide_empty' => $empty 
		)
		;
		
		?>

<?php
		
$all_categories = get_categories ( $args );
		
		?>

<label for="<?php echo $this->get_field_id('category_id'); ?>"><?php _e('Please select category to show', 'woocommerce_category'); ?></label>

<?php
		
		if (! empty ( $all_categories )) 

		{
			
			printf ( 

			'<select name="%s[]" id="%s" class="widefat" style="margin-bottom:10px">', 

			$this->get_field_name ( 'category_id' ), 

			$this->get_field_id ( 'category_id' ) )

			;
			
			// The Loop
			
			foreach ( $all_categories as $cat ) {
				
				// print_r($cat);
				
				if ($cat->category_parent == 0) {
					
					$category_id = $cat->term_id;
					
					printf ( 

					'<option value="%s" class="hot-topic" %s style="margin-bottom:3px;">%s</option>', 

					$category_id, 

					in_array ( $category_id, $select ) ? 'selected="selected"' : '', 

					$cat->name )

					;
				}
			}
			
			echo '</select>';
		} 

		else {
			
			// No posts were found
			
			echo 'No woocommerce category found ';
		}	
	}
	
	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		// Fields
		
		$instance ['title'] = strip_tags ( $new_instance ['title'] );
		
		$instance ['subtitle'] = strip_tags ( $new_instance ['subtitle'] );
		
		$instance ['category_id'] = esc_sql ( $new_instance ['category_id'] );
		
		$instance ['show_title'] = esc_sql ( $new_instance ['show_title'] );
		
		// print_r($instance);
		
		return $instance;
	}
	
	// widget display
	
	// display widget
	function widget($args, $instance) {
		extract ( $args );
		// these are the widget options
		
		$title = apply_filters ( 'widget_title', $instance ['title'] );
		
		$subtitle = apply_filters ( 'widget_title', $instance ['subtitle'] );
		
		$category_ids = $instance ['category_id'];
		
		$showcategory_image = $instance ['category_image'];
		
		$show_title = $instance ['show_title'];
		
		echo $before_widget;
		
		// Display the widget
		
		if ($showcategory_image [0] == 'yes') 

		{
			
			$category_class_name = ' woocommerce_category_box';
		} 

		else 

		{
			
			$category_class_name = ' woocommerce_category_listing_box';
		}
		
		$category_class_name = $category_class_name . '  ' . $this->id;
		
		// Check if title is set

		if($args['id'] == 'sidebar-homeapplications'){
			echo '<div class="container">';
			echo '<div class="applications-list" id="applications">';
			echo '<header class="row heading text-center">';
			echo '<div class="col-md-12">';
			if ($title) {
				echo '<h2>' . $title . '</h2>';
			}
			echo '<h3>' . $subtitle . '</h3>';
			echo '</div>';
			echo '</header>';
			echo '<div class="row">';
		}elseif($args['id'] == 'sidebar-homeproducts'){
			echo '<header class="row heading">';
			echo '<div class="col-md-8 col-md-offset-2">';
				if ($title) {
				echo '<h2>' . $title . '</h2>';
			}
			echo '<h3>' . $subtitle . '</h3>';
			echo '</div>';
			echo '</header>';
			echo '<div class="row">';
		}
		// Check if text is set
		
		$taxonomy = 'product_cat';
		
		$orderby = 'order';
		
		$show_count = 0; // 1 for yes, 0 for no
		
		$pad_counts = 0; // 1 for yes, 0 for no
		
		$hierarchical = 1; // 1 for yes, 0 for no
		
		$title = '';
		
		$subtitle = '';
		
		$empty = 0;
		
		$args1 = array (
				
				'taxonomy' => $taxonomy,
				
				'orderby' => $orderby,
				
				'show_count' => $show_count,
				
				'pad_counts' => $pad_counts,
				
				'hierarchical' => $hierarchical,
				
				'title_li' => $title,
				
				'subtitle_li' => $subtitle,
				
				'hide_empty' => $empty,
				
				'child_of' => $category_ids [0],
				
				'parent' => $category_ids [0] 
		)
		;
		
		$all_categories = get_categories ( $args1 );
		
		$term_slug = get_query_var ( 'term' );
		$K=1;
		foreach ( $all_categories as $cat ) {
			
			$category_id = $cat->term_id;
			
			$thumbnail_id = get_woocommerce_term_meta ( $category_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url ( $thumbnail_id, 'full' );

			$cat_image_path = '';
			if (empty ( $image ))
			{
				$cat_image_path =  '<img src="' . plugins_url ( '/tcp-no-image.jpg', __FILE__ ) . '>';
			}
			else
			{
				$cat_image_path = '<img src="' . $image . '" alt="" />';
			}
			$post_id="{$taxonomy}_{$cat->term_id}";
			$cat_image_path = '<img src="'.get_field('home_page_category__image',$post_id).'" alt="image description">';
			
			$Gramforce_id = 0;
			if($category_id == "24"){
			$Gramforce_id = 5306;
			$Gramforce_post = get_post(5306); 
			$Gramforce_post_content = $Gramforce_post->post_content;
			}

			if($args['id'] == 'sidebar-homeapplications'){
				echo '<div class="col-sm-4">
				<div class="block">
				<div class="block-heading">
				<div class="icon">
				'.$cat_image_path.'
				</div>
				</div>
				<h4>'.$cat->name.'</h4>
				
				<ul class="list">
				<li>'.wp_trim_words ( $cat->description, 12).'</li>
				</ul>
				<a href="' . get_term_link ( $cat->slug, 'product_cat' ) . '" class="more"> LEARN MORE</a>
				</div>
				</div>';
				
				if($Gramforce_id != 0){
				echo '<div class="col-sm-4">
				<div class="block">
				<div class="block-heading">
				<div class="icon">
				<img src="http://airpot.com/wp-content/uploads/2016/09/gramforce_gripper_orange_icon.png">
				</div>
				</div>
				<h4>'.get_the_title($Gramforce_id).'</h4>
				
				<ul class="list">
				<li>'.wp_trim_words ( $Gramforce_post_content , 12).'</li>
				</ul>
				<a href="' . get_permalink($Gramforce_id) . '" class="more"> LEARN MORE</a>
				</div>
				</div>';
				}

				if($K%3==0):
				echo '<div class="clearfix"></div>';
				endif;
			}elseif($args['id'] == 'sidebar-homeproducts'){
				
				$post_id="{$taxonomy}_{$cat->term_id}";				
				$image = get_field('home_page_category__image',$post_id);
				echo '<div class="col-sm-3">
				<div class="block">
				<div class="text-block">
				<h4><a href="' . get_term_link ( $cat->slug, 'product_cat' ) . '">'.$cat->name.'</a></h4>
				</div>
				<span class="more"><a href="' . get_term_link ( $cat->slug, 'product_cat' ) . '"> LEARN MORE</a></span>
				<img src="'.$image.'" width="298" height="265" alt="image description">
				</div>
				</div>';
				if($K%4==0):
				echo '<div class="clearfix"></div>';
				endif;
				
			}
			$K++;
		}
		if($args['id'] == 'sidebar-homeapplications'){
			echo '</div></div></div></div>';
		}if($args['id'] == 'sidebar-homeproducts'){
			//echo '</div>';
			echo '<div class="col-sm-3">
				<div class="block">
				<div class="text-block">
				<h4><a href="http://airpot.com/product/gramforce-grippers/">GramForce<sup>&reg;</sup> Grippers</a></h4>
				</div>
				<span class="more"><a href="http://airpot.com/product/gramforce-grippers/"> LEARN MORE</a></span>
				<img src="http://airpot.com/wp-content/uploads/2017/01/gramforce-gripper-home.jpg" alt="image description" width="298" height="265">
				</div>
				</div>';
		}
		echo $after_widget;
	}
}

// register widget

add_action ( 'widgets_init', create_function ( '', 'return register_widget("woocommerce_category");' ) );

// Register style sheet.

//add_action ( 'wp_enqueue_scripts', 'woocommerce_category_style' );

/**
 * Register style sheet.
 */
function woocommerce_category_style() {
	//wp_register_style ( 'woocommerce_category_style', plugins_url ( 'woocommerce-category-widget/css/style.css' ) );
	
	//wp_enqueue_style ( 'woocommerce_category_style' );
}

//add_action ( 'admin_notices', 'woocommerce_category_cat_admin_notice' );

function woocommerce_category_cat_admin_notice() {
	global $current_user;
	
	$user_id = $current_user->ID;
	/* Check that the user hasn't already clicked to ignore the message */
	if (! get_user_meta ( $user_id, 'woocommerce_category_cat_ignore_notice', true )) {
		
		echo '<div class="updated">
           <p>Thank you for installing WooCommerce Category Plugin. Please consider a <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=helplive24x7@gmail.com&lc=CA&item_name=Donation%20for%20Car%20Seller%20-%20Auto%20Classifieds%20Script&amount=0&currency_code=USD&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted" target="_blank">
           donation</a> to support this plugin. <a href="?woocommerce_category_cat_notice_ignore=0">Discard</a>
           
           

           </p>
           
           </div>';
	}
}

add_action ( 'admin_init', 'woocommerce_category_cat_notice_ignore' );

function woocommerce_category_cat_notice_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	
	// add_user_meta($user_id, 'woocommerce_category_cat_ignore_notice', false, true);
	/* If user clicks to ignore the notice, add that to their user meta */
	if (isset ( $_GET ['woocommerce_category_cat_notice_ignore'] ) && $_GET ['woocommerce_category_cat_notice_ignore'] == '0') {
		add_user_meta ( $user_id, 'woocommerce_category_cat_ignore_notice', 'true', true );
	}
}
