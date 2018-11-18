<div id="woocommerce_layered_nav-99999" class="block woocommerce widget_layered_nav">
		<strong class="title">Product Type</strong>
<?php 
	$args = array(
	  	'taxonomy'     => 'product_cat',
	  	'show_count'   => 0,
	  	'pad_counts'   => 0,
	  	'hierarchical' => 1,
	  	'title_li'     => '',
	  	'hide_empty'   => 0
	);
	
	$all_categories = get_categories( $args );
	
	foreach ($all_categories as $cat) {
?>
    
		<ul class="check-list">
<?php	
	if( $cat->category_parent == 0 && strtoupper($cat->name) != strtoupper('Refurbished Products')) {
        $category_id = $cat->term_id;
		
?>		
		<li>	
			
				<input id="dropdown_layered_nav_<?php echo $cat->name; ?>" class="jcf-hidden" type="radio" value="<?php echo $cat->id; ?>" name="dropdown_layered_nav_<?php echo $cat->name; ?>"
                onclick="window.location.assign('<?php echo get_term_link($cat->slug, 'product_cat') ?>')">
				<label for="dropdown_layered_nav_<?php echo $cat->name; ?>"><?php echo $cat->name; ?></label>
            
<?php		
			//window.location = <?php echo get_term_link($cat->slug, 'product_cat') ;
//        echo '<a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>'; 
		}
?>
		</li>
<?php	}
?>	
	</ul>
</div>