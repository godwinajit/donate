<?php
/**
 * Social Icons for Footer content page
 *
 */
class Airpot_Social_Icons_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array (
				'description' => __ ( 'Socail media sharing.' )
		);
		parent::__construct ( 'airpot_social_media', __ ( 'Airpot Social Media Links' ), $widget_ops );
	}

	function widget($args, $instance) {
		$title =  $instance ['title'];	
		 $facebook_url =  $instance ['facebook_url'];
		 $twitter_url =  $instance ['twitter_url'];
		 $pinterest_url = $instance ['pinterest_url'];
		 $instagram_url =  $instance ['instagram_url'];
		 $rss_url = $instance ['rss_url'];
		 $dribbble = $instance ['dribbble_url'];

			$html ='<div class="socials-block">
							<h3>'.$title.'</h3>
							<ul class="socials list-inline list-unstyled">
								<li><a href="'.$facebook_url.'" target="_blank"><span class="fa fa-facebook"></span></a></li>
								<li><a href="'.$twitter_url.'" target="_blank"><span class="fa fa-twitter"></span></a></li>
								<li><a href="'.$pinterest_url.'" target="_blank"><span class="fa fa-pinterest"></span></a></li>
								<li><a href="'.$instagram_url.'" target="_blank"><span class="fa fa-instagram"></span></a></li>
								<li><a href="'.$dribbble.'" target="_blank"><span class="fa fa-dribbble"></span></a></li>
							    <li><a href="'.$rss_url.'" target="_blank"> <span class="fa fa-rss"></span></a></li>
						  </ul>
						</div>';		
		echo $html;
	}

	function update($new_instance, $old_instance) {

		$instance ['title'] = $new_instance ['title'];		
		$instance ['facebook_url'] =$new_instance ['facebook_url'];
		$instance ['twitter_url'] = $new_instance ['twitter_url'];
		$instance ['pinterest_url'] =  $new_instance ['pinterest_url'];
		$instance ['instagram_url'] =  $new_instance ['instagram_url'];
		$instance ['rss_url'] =  $new_instance ['rss_url'];
		$instance ['dribbble_url']= $new_instance ['dribbble_url'];
		return $instance;
	}

	function form($instance) {

		$title = isset ( $instance ['title'] ) ? $instance ['title'] : '';		
		$facebook_url = isset ( $instance ['facebook_url'] ) ? $instance ['facebook_url'] : '';
		$twitter_url = isset ( $instance ['twitter_url'] ) ? $instance ['twitter_url'] : '';
		$pinterest_url = isset ( $instance ['pinterest_url'] ) ? $instance ['pinterest_url'] : '';
		$instagram_url = isset ( $instance ['instagram_url'] ) ? $instance ['instagram_url'] : '';
		$rss_url = isset ( $instance ['rss_url'] ) ? $instance ['rss_url'] : '';
		$dribbble_url = isset ( $instance ['dribbble_url'] ) ? $instance ['dribbble_url'] : '';?>

					<p>
						<label for="<?php echo $this->get_field_id("title"); ?>">
											<?php _e( 'Title ' ); ?>:
											<input size="28" id="<?php echo $this->get_field_id("title"); ?>"
							name="<?php echo $this->get_field_name("title"); ?>" type="text"
							value="<?php echo esc_attr($instance["title"]); ?>" />
						</label>
					</p>											
					
					<p>
						<label for="<?php echo $this->get_field_id("facebook_url"); ?>">
											<?php _e( 'Facebook Url ' ); ?>:
											<input size="28"
							id="<?php echo $this->get_field_id("facebook_url"); ?>"
							name="<?php echo $this->get_field_name("facebook_url"); ?>"
							type="text" value="<?php echo esc_attr($instance["facebook_url"]); ?>" />
						</label>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id("twitter_url"); ?>">
											<?php _e( 'Twitter Url ' ); ?>:
											<input size="28"
							id="<?php echo $this->get_field_id("twitter_url"); ?>"
							name="<?php echo $this->get_field_name("twitter_url"); ?>" type="text"
							value="<?php echo esc_attr($instance["twitter_url"]); ?>" />
						</label>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id("pinterest_url"); ?>">
											<?php _e( 'Pinterest Url' ); ?>:
											<input size="28"
							id="<?php echo $this->get_field_id("pinterest_url"); ?>"
							name="<?php echo $this->get_field_name("pinterest_url"); ?>"
							type="text"
							value="<?php echo esc_attr($instance["pinterest_url"]); ?>" />
						</label>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id("instagram_url"); ?>">
											<?php _e( 'Instagram Url' ); ?>:
											<input size="28"
							id="<?php echo $this->get_field_id("instagram_url"); ?>"
							name="<?php echo $this->get_field_name("instagram_url"); ?>"
							type="text" value="<?php echo esc_attr($instance["instagram_url"]); ?>" />
						</label>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id("dribbble_url"); ?>">
											<?php _e( 'Dribbble Url ' ); ?>:
											<input size="28"
							id="<?php echo $this->get_field_id("dribbble_url"); ?>"
							name="<?php echo $this->get_field_name("dribbble_url"); ?>" type="text"
							value="<?php echo esc_attr($instance["dribbble_url"]); ?>" />
						</label>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id("rss_url"); ?>">
											<?php _e( 'RSS Url ' ); ?>:
											<input size="28"
							id="<?php echo $this->get_field_id("rss_url"); ?>"
							name="<?php echo $this->get_field_name("rss_url"); ?>" type="text"
							value="<?php echo esc_attr($instance["rss_url"]); ?>" />
						</label>
					</p>
<?php }}?>
			
	

