<div id="woocommerce_layered_nav-99999" class="block woocommerce widget_layered_nav">
		<strong class="title">Product Type</strong>
<?php 
	$queried_object = get_queried_object();
	$term_id = $queried_object->term_id;
		
	$args = array(
	  	'taxonomy'     => 'product_cat',
	  	'show_count'   => 0,
	  	'pad_counts'   => 0,
	  	'hierarchical' => 1,
	  	'title_li'     => '',
	  	'hide_empty'   => 0
	);
	
	$all_categories = get_categories( $args );
?>
	<ul class="check-list">
<?php
	foreach ($all_categories as $cat) {
	
	if( $cat->category_parent == 0 && strtoupper($cat->name) != strtoupper('Refurbished Products')) {
        $category_id = $cat->term_id;
		
		if($category_id == $term_id):
			$class = ' checked="checked" ';
		else :
			$class = '';
		endif;
?>		
		<li>	
				
				<input id="dropdown_layered_nav_<?php echo $cat->slug; ?>" class="jcf-hidden" type="radio" <?php echo $class; ?> value="<?php echo $cat->id; ?>" name="dropdown_layered_nav_product_type">
				<label for="dropdown_layered_nav_<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></label>
            
<?php		
		wc_enqueue_js("

						jQuery('input[id=dropdown_layered_nav_" . $cat->slug . "]').change(function(){
							location.href = '" . esc_url_raw( get_term_link($cat->slug, 'product_cat') ) . "';
						});");
			
		}
?>
		</li>
<?php	}
?>	
	</ul>
</div>