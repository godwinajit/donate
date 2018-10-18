<?php get_header ();?>

		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>News</h1>
					</div>
					<div class="row">
						<div class="col-sm-9 col-md-9 col-sm-push-3" id="content">				
										
								
								 
								  <?php if ( have_posts() ) : ?>
								   
								    <!-- the loop -->
								    <?php while (have_posts()) : the_post(); ?>
								     <article class="post">	
								       <h2><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h2>
								       <time datetime="2010-07-31"> <?php the_time('M d, Y');?> </time>
								        <h3 class="h3"><?php the_field('application_notes');?></h3>
								        <p> <?php the_excerpt(); ?> </p>
								       <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary btn-sm">Read More</a>
								     </article>
									<div class="row"> <div class="divider"></div> </div>  	
								    <?php endwhile; ?>
								    <!-- end of the loop -->
								 
								    <!-- pagination here -->
								    <?php
								      if (function_exists(custom_pagination)) {
								        custom_pagination($wp_query->max_num_pages,"",$paged);
								      }
								    ?>
								 
								  <?php wp_reset_postdata(); ?>
								 
								  <?php else:  ?>
								    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
								  <?php endif; ?>
														
						</div>
						<aside class="col-sm-3 col-sm-pull-9">
							
							<?php wp_nav_menu(array(
							'container'       => 'nav',
							'container_class' => 'add-nav',
							'container_id'    => '',
							'menu' => 'News Menu', 	
							'menu_class'      => 'list-unstyled'						
							)); ?>
							
							<?php dynamic_sidebar( 'sidebar-emailsubscription' );?>	
						
						</aside>
					</div>
				</div>
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
<?php get_footer ();?>

<?php function custom_pagination($numpages = '', $pagerange = '', $paged='') {

	if (empty($pagerange)) {
		$pagerange = 1;
	}

	/**
	 * This first part of our function is a fallback
	 * for custom pagination inside a regular loop that
	 * uses the global $paged and global $wp_query variables.
	 *
	 * It's good because we can now override default pagination
	 * in our theme, and use this function in default quries
	 * and custom queries.
	 */
	global $paged;
	if (empty($paged)) {
		$paged = 1;
	}
	if ($numpages == '') {
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if(!$numpages) {
			$numpages = 1;
		}
	}

	/**
	 * We construct the pagination arguments to enter into our paginate_links
	 * function.
	 */
	$pagination_args = array(
			'base'            => get_pagenum_link(1) . '%_%',
			'format'          => 'page/%#%',
			'total'           => $numpages,
			'current'         => $paged,
			'show_all'        => False,
			'end_size'        => 1,
			'mid_size'        => $pagerange,
			'prev_next'       => True,
			'prev_text'       => __('<span>PREVIOUS PAGE</span>'),
			'next_text'       => __('<span>NEXT PAGE</span>'),
			'type'            => 'plain',
			'add_args'        => false,
			'add_fragment'    => ''
	);

	$paginate_links = paginate_links($pagination_args);

if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}				
?>
