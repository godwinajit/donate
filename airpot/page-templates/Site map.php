<?php 
/*
		Template Name: Site Map
	*/
?>
<?php
$args = array(
    'number'     => $number,
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids
);

$product_categories = get_terms( 'product_cat', $args );



echo 'Total number of categories '.count($product_categories);


foreach( $product_categories as $cat ) { 
		echo '<br>'.get_term_link( $cat->slug, 'product_cat' );; 
	}
?>

<?php
		//	echo '<pre><br>Generating Site map......';
			$args = array( 'post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => -1 );

$products = new WP_Query( $args );

//echo '<br>Total number of produts : '.$products->found_posts;
			?>
<?php if ( $products->have_posts() ) : ?>
    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
        <?php echo get_permalink ().'<br>';?>         
    <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>