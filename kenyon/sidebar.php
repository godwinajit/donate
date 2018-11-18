<div class="filter-form ">

	<?php do_action( 'woocommerce_layered_nav_clear_filter' ); ?>
	
	<?php if(is_shop() ): get_template_part('blocks/category-list'); endif; ?>
    
    <?php dynamic_sidebar('shop-sidebar'); ?>
    
</div>
