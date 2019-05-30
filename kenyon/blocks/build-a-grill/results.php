<?php 
	global $post;
	$cross_sells = array();
?>

<?php if (have_posts()) : ?>
    <div class="heading">
        <h2><?php _e('We found the perfect grill for you!', 'kenyon') ?></h2>
    </div>

    <?php while (have_posts()) : the_post(); ?>
		<?php 
			$product = wc_get_product($post);
			$cross_sells = array_merge($product->get_cross_sell_ids(), $cross_sells); 
		?>
        <?php woocommerce_get_template_part( 'content', 'product_build' ); ?>
    <?php endwhile; ?>

	<?php 
		wc_get_template( 'global/build-cross-sells.php', array(
			'cross_sells' => $cross_sells,
		)); 
	?>
<?php else : ?>
    <div class="heading">
        <h2><?php _e('Products not found.', 'kenyon') ?></h2>
    </div>
<?php endif; ?>