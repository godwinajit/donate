<?php

/**
 * Santa Main Map widget class
 *
 */
class Santa_Map_Widget extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array(
            'description' => __('Add Map Section to your site.')
        );
        parent::__construct('santa_map_embed_url', __('Santa Map Section'), $widget_ops);
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];
        
        $santa_map_embed_url = $instance['santa_map_embed_url'];
		$santa_map_content = $instance['santa_map_content'];
        
        if (! $santa_map_embed_url)
            return;

		echo '<div class="map-container">
				<iframe allowfullscreen frameborder="0" height="563" src="'.$santa_map_embed_url.'" style="border:0" width="1440"></iframe>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 map-info">
						'.$santa_map_content.'
					</div>
				</div>
			</div>';
    }

function update($new_instance, $old_instance)
{
    $instance['santa_map_embed_url'] = $new_instance['santa_map_embed_url'];
    $instance['santa_map_content'] = $new_instance['santa_map_content'];
    return $instance;
}

function form($instance)
{
    $santa_map_embed_url = isset($instance['santa_map_embed_url']) ? $instance['santa_map_embed_url'] : '';
    $santa_map_content = isset($instance['santa_map_content']) ? $instance['santa_map_content'] : '';
    
   ?>
<p>
	<label for="<?php echo $this->get_field_id('santa_map_embed_url'); ?>"><?php _e('Map Embed URL:'); ?></label>
	<input class="widefat"
		id="<?php echo $this->get_field_id( 'santa_map_embed_url' ); ?>"
		name="<?php echo $this->get_field_name( 'santa_map_embed_url' ); ?>" type="text"
		value="<?php echo $santa_map_embed_url; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('santa_map_content'); ?>"><?php _e('Map Content:'); ?></label>
	<textarea rows="30" class="widefat" id="<?php echo $this->get_field_id( 'santa_map_content' ); ?>" name="<?php echo $this->get_field_name( 'santa_map_content' ); ?>"><?php echo $santa_map_content; ?></textarea>
</p>
<?php
}
}
