<?php
/*
  Plugin Name: Featured Gallery
  Description: Featured Gallery Widget
  Version: 1.0
 */

class featured_Gallery extends WP_Widget {

    //process the new widget
    public function __construct() {
        $option = array(
            'classname' => 'featured_gallery',
            'description' => 'This featured Gallery'
        );
        $this->WP_Widget('featured_Gallery', 'featured Gallery', $option);
    }

//build the widget settings form
    function form($instance) {
        $instance = wp_parse_args( ( array ) $instance, array(
			'image_path_1'        => __( '' ),
        	'image_path_2'        => __( '' ),
        	'image_path_3'        => __( '' ),
        	'image_path_4'        => __( '' ),
        	'image_path_5'        => __( '' ),
        	'image_path_6'        => __( '' ),
        	'image_path_7'        => __( '' ),
        	'image_path_8'        => __( '' ),
        	'image_path_9'        => __( '' ) 
		) );

		$image_path_1          = $instance['image_path_1'];
		$image_path_2          = $instance['image_path_2'];
		$image_path_3          = $instance['image_path_3'];
		$image_path_4          = $instance['image_path_4'];
		$image_path_5          = $instance['image_path_5'];
		$image_path_6          = $instance['image_path_6'];
		$image_path_7          = $instance['image_path_7'];
		$image_path_8          = $instance['image_path_8'];
		$image_path_9          = $instance['image_path_9'];
		$image_path_10          = $instance['image_path_10'];
		$image_path_11          = $instance['image_path_11'];
		$image_path_12          = $instance['image_path_12'];
		?>
			<p>
				<label for="<?php echo $this->get_field_id("image_path_1"); ?>">
					<?php _e( 'Gallery image path 1' ); ?>:
					<input class="widefat" id="<?php echo $this->get_field_id("image_path_1"); ?>" name="<?php echo $this->get_field_name("image_path_1"); ?>" type="text" value="<?php echo esc_attr($instance["image_path_1"]); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id("image_path_2"); ?>">
					<?php _e( 'Gallery image path 2' ); ?>:
					<input class="widefat" id="<?php echo $this->get_field_id("image_path_2"); ?>" name="<?php echo $this->get_field_name("image_path_2"); ?>" type="text" value="<?php echo esc_attr($instance["image_path_2"]); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id("image_path_3"); ?>">
					<?php _e( 'Gallery image path 3' ); ?>:
					<input class="widefat" id="<?php echo $this->get_field_id("image_path_3"); ?>" name="<?php echo $this->get_field_name("image_path_3"); ?>" type="text" value="<?php echo esc_attr($instance["image_path_3"]); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id("image_path_4"); ?>">
					<?php _e( 'Gallery image path 4' ); ?>:
					<input class="widefat" id="<?php echo $this->get_field_id("image_path_4"); ?>" name="<?php echo $this->get_field_name("image_path_4"); ?>" type="text" value="<?php echo esc_attr($instance["image_path_4"]); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id("image_path_5"); ?>">
					<?php _e( 'Gallery image path 5' ); ?>:
					<input class="widefat" id="<?php echo $this->get_field_id("image_path_5"); ?>" name="<?php echo $this->get_field_name("image_path_5"); ?>" type="text" value="<?php echo esc_attr($instance["image_path_5"]); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id("image_path_6"); ?>">
					<?php _e( 'Gallery image path 6' ); ?>:
					<input class="widefat" id="<?php echo $this->get_field_id("image_path_6"); ?>" name="<?php echo $this->get_field_name("image_path_6"); ?>" type="text" value="<?php echo esc_attr($instance["image_path_6"]); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id("image_path_7"); ?>">
					<?php _e( 'Gallery image path 7' ); ?>:
					<input class="widefat" id="<?php echo $this->get_field_id("image_path_7"); ?>" name="<?php echo $this->get_field_name("image_path_7"); ?>" type="text" value="<?php echo esc_attr($instance["image_path_7"]); ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id("image_path_8"); ?>">
					<?php _e( 'Gallery image path 8' ); ?>:
					<input class="widefat" id="<?php echo $this->get_field_id("image_path_8"); ?>" name="<?php echo $this->get_field_name("image_path_8"); ?>" type="text" value="<?php echo esc_attr($instance["image_path_8"]); ?>" />
				</label>
				</p>
				
				
				<p>
					<label for="<?php echo $this->get_field_id("image_path_9"); ?>">
					<?php _e( 'Gallery image path 9' ); ?>: <input class="widefat"
						id="<?php echo $this->get_field_id("image_path_9"); ?>"
						name="<?php echo $this->get_field_name("image_path_9"); ?>"
						type="text" value="<?php echo esc_attr($instance["image_path_9"]); ?>" />
					</label>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id("image_path_10"); ?>">
					<?php _e( 'Gallery image path 10' ); ?>: <input class="widefat"
						id="<?php echo $this->get_field_id("image_path_10"); ?>"
						name="<?php echo $this->get_field_name("image_path_10"); ?>"
						type="text" value="<?php echo esc_attr($instance["image_path_10"]); ?>" />
					</label>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id("image_path_11"); ?>">
					<?php _e( 'Gallery image path 11' ); ?>: <input class="widefat"
						id="<?php echo $this->get_field_id("image_path_11"); ?>"
						name="<?php echo $this->get_field_name("image_path_11"); ?>"
						type="text" value="<?php echo esc_attr($instance["image_path_11"]); ?>" />
					</label>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id("image_path_12"); ?>">
					<?php _e( 'Gallery image path 12' ); ?>: <input class="widefat"
						id="<?php echo $this->get_field_id("image_path_12"); ?>"
						name="<?php echo $this->get_field_name("image_path_12"); ?>"
						type="text" value="<?php echo esc_attr($instance["image_path_12"]); ?>" />
					</label>
				</p>

			
			
			<?php 
    }

//save the widget settings
    function update($new_instance, $old_instance) {
        return $new_instance;
    }

//display the widget
    function widget($args, $instance) {
	wp_enqueue_script( 'lightbox', plugins_url().'/featured_gallery/lightbox.min.js',  '0.0.1', true );
	//wp_enqueue_style( 'lightbox-css-screen', plugins_url().'/featured_gallery/css/screen.css11', false, '0.0.1' );
	wp_enqueue_style( 'lightbox-css', plugins_url().'/featured_gallery/css/lightbox.css', false, '0.0.1' );
      ?>
			<li><a href="<?php echo $instance['image_path_1'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_1'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_2'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_2'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_3'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_3'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_4'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_4'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_5'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_5'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_6'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_6'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_7'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_7'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_8'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_8'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_9'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_9'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_10'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_10'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_11'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_11'];?>" /></a></li>
			<li><a href="<?php echo $instance['image_path_12'];?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img width="92" height="85" src="<?php echo $instance['image_path_12'];?>" /></a></li>
			
		
        <?php 
    }
}

add_action('widgets_init', 'featured_gallery_register');

/**
 * Register the widget
 * 
 * @since 1.0
 */
function featured_gallery_register() {
    register_widget('featured_Gallery');
}
?>