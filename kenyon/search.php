<?php get_header(); ?>
<script type="text/javascript">
<!--
//Search
//Track searches on your website (ex. product searches)
_fbq('track', 'Search');
//-->
</script>
<div class="container">
    <?php get_template_part('blocks/breadcrumbs'); ?>
    <h1><?php printf( __( 'Search Results for: %s', 'kenyon' ), '<span>' . get_search_query() . '</span>'); ?></h1>
</div>

<?php if(isset($_REQUEST['s']) && $_REQUEST['s'] != '' ): 
	$arr = array();
	global $wp_query; 
	// Search For the Product Having %Keyword% in SKUs Only
	$args = array(
			'post_type' => 'product',
			'meta_query' => array(
        		array(
					'key' => '_sku',
					'value'   => $_REQUEST['s'],
					'compare' => 'LIKE',
					'type'      => 'CHAR',
				),
				'relation' => 'OR',
				array(
					'key' => '_variation_sku',
					'value'   => $_REQUEST['s'],
					'compare' => 'LIKE',
					'type'      => 'CHAR',
				),
			),
			'posts_per_page' => -1
		);
	$loop1 = new WP_Query( $args); 
	$count = $loop1->post_count;
	//echo '<div style="display:none">'.$wp_query->request.'</div>';
	while ( $loop1->have_posts() ) : 
		$loop1->the_post() ; 
		$product = get_product( $post->ID ); 
			array_push($arr,$post->ID); 
	endwhile;
	echo '<div style="display:none">Loop1<br>';
	var_dump($arr);
	echo '</div>';
	
	$args = array(
		'post_type' => array ( 'product_variation' ),
		'meta_query' => array(
			array(
				'key' => '_sku',
				'value'   => $_REQUEST['s'],
				'compare' => '=',
				'type'      => 'CHAR',
			),
		),
		'posts_per_page' => -1
	);
	$varPost = new WP_Query( $args);
	while ($varPost->have_posts()) : 
		$varPost->the_post();
		$plink = get_permalink($post->post_parent);
		$voltage = get_post_meta( $post->ID, 'attribute_pa_voltage', true );
		$plug = get_post_meta( $post->ID, 'attribute_pa_plug', true );
	endwhile; 
	
		
	if ( $voltage != '' & $plug != '' && $plink != '' ) :
		// Goto Redirect
		header("Location: ".$plink.'?pa_voltage='.$voltage.'&pa_plug='.$plug);
		die();
	else:
		wp_reset_postdata();
		echo '<div style="display:none">Count'.$count.'</div>';
		// Search For the Product Having %Keyword%
		$args = array(
			's' => $_REQUEST['s'],
			'post_type' => array ( 'product' ),
			'posts_per_page' => -1
		);
		$loop2 = new WP_Query( $args); 
		if ($loop2->have_posts()) : 
			while ( $loop2->have_posts()) : 
				$loop2->the_post() ; 
				array_push($arr,$post->ID); 
			endwhile;
		endif;
		echo '<div style="display:none">Loop2+';
		var_dump($arr);
		echo '</div>';
		
		// Search Result For Product
		$args = array(
			'post_type' => array ( 'product' ),
			'post__in' => $arr,
			'meta_key' => 'total_sales',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'posts_per_page' => -1
		);
		$loop1 = new WP_Query( $args); 
	endif;
	echo '<div style="display:none">++++'.$loop1->request.'</div>';
	
?>
	<?php if ($loop1->have_posts() && count($arr) > 0 ) :  ?>
	<div class="container">
		<h2><?php printf(__('SEARCHED PRODUCT'))?></h2>
	</div>
	<?php endif;?>
	<?php if ($loop1->have_posts()  && count($arr) > 0 ) : theme_print_each(); ?>
	
		<section class="related-posts">
			<div class="container">
				<div class="row">
					<?php while ($loop1->have_posts()) : $loop1->the_post() ; ?>
						<?php 
								$product = get_product( $post->ID ); 
						?>
									<?php theme_print_each(3, '</div><div class="row">') ?>
									<div class="col-md-4 col-sm-4">
										<?php get_template_part('blocks/content', get_post_type()); ?>
									</div>
						
					<?php endwhile; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
<?php endif; ?>

<div class="container">
	<h2><?php printf(__('SEARCHED POSTS'))?></h2>
</div>	
<?php 	
		$args = array(
			's' => $_REQUEST['s'],
			'post_type' => array ( 'post', 'recipe' ),
			'paged' => $paged
		);
		query_posts($args); 
		echo '<div style="display:none">++'.$wp_query->request.'</div>';
?>

<?php if (have_posts()) : theme_print_each(); ?>

    <section class="related-posts">
        <div class="container">
            <div class="row">
                <?php while (have_posts()) : the_post() ; ?>
                    <?php theme_print_each(3, '</div><div class="row">') ?>
                    <div class="col-md-4 col-sm-4">
                        <?php get_template_part('blocks/content', get_post_type()); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <?php get_template_part('blocks/pager'); ?>

<?php else : ?>
    <div class="container">
        <?php get_template_part('blocks/not_found'); ?>
    </div>

<?php endif; ?>

<?php get_footer(); ?>



<?php get_footer(); ?>