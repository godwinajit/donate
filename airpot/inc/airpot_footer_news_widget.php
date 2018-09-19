<?php
/**
 * Social Icons for Footer content page
 *
 */
class Airpot_Footer_News_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array (
				'description' => __ ( 'Custom Post Type Display.' )
		);
		parent::__construct ( 'airpot_footer_news', __ ( 'Airpot Footer News Section' ), $widget_ops );
	}

	function widget($args, $instance) {
		$title =  $instance ['title'];	
		$post_type =  $instance ['ptype'];	

		$html.= '<div class="col-md-3 col-sm-6">
					<h3>'.strtoupper($title).'</h3>
						<ul class="news-list list-unstyled">';
	
		$new_loop = new WP_Query( array(
				'post_type' => $post_type,
				'posts_per_page' => 4			
		) );
		?>		
		<?php if ( $new_loop->have_posts() ) : ?>
		    <?php while ( $new_loop->have_posts() ) : $new_loop->the_post(); ?>
				<?php $html.='<li>
		          				<h4><a href='.get_permalink($post->ID).'>'. get_the_title( $post->ID ).'</a></h4>
				         		<p class="info"><!-- <span class="author">by '.ucfirst(get_the_author($post->ID)).'</span> -->on <time datetime="2014-06-24">'.get_the_time('F d, Y',$post->ID).'</time></p>
							</li>';		
		         endwhile;?>		
		   <?php endif; ?>
		<?php wp_reset_query();
		
		$html.='</ul></div>';
		echo $html;
	}

	function update($new_instance, $old_instance) {

		$instance ['title'] = $new_instance ['title'];	
		$instance ['ptype'] = $new_instance ['ptype'];
		
		return $instance;
	}

	function form($instance) {

		$title = isset ( $instance ['title'] ) ? $instance ['title'] : '';
		$post_type = isset ( $instance ['ptype'] ) ? $instance ['ptype'] : '';
		?>				
				<p>
					<label for="<?php echo $this->get_field_id("title"); ?>">					
						<?php _e( 'Title ' ); ?>:
						<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />				
					</label>				
					
					</p>				
					<p>
					<label for="<?php echo $this->get_field_id("ptype"); ?>">					
						
					<?php _e( 'Select Post Type ' ); ?>:
					<?php  $args=array(
					       'public'   => true,
						  '_builtin' => false
							); 
					   $output = 'names';
					   $operator = 'and';
					   $post_types=get_post_types($args,$output,$operator);?>
	     <select id="<?php echo $this->get_field_id('ptype'); ?>" name="<?php echo $this->get_field_name('ptype'); ?>" class="widefat" style="width:100%;">
            <?php foreach ($post_types  as $post_type_value) { ?>
            <option <?php selected( $instance['ptype'], $post_type ); ?> value="<?php echo $post_type_value; ?>"><?php echo $post_type_value; ?></option>
            <?php } ?>      
        </select>	
	</label>					
	</p>				
<?php }}?>		

