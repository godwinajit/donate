<?php 
/*
		Template Name:News Page
	*/
?>
	<?php get_header ();?>	
		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
			<!--	<a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>User Account</h1>
					</div>
					<div class="row">
						<div class="col-sm-9 col-md-9 col-sm-push-3" id="content">	
							
								<?php 
								header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');								
								session_start();							
								
								$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
								if (isset($_REQUEST['cat'])) {
									$cat_name=$_REQUEST['cat'];
								}
								
								if(!empty($cat_name) && ($paged==1))
								{
									$_SESSION['category_name']=$cat_name;								
									wp_redirect(get_home_url().'/news-page' );				
									exit();
								}
								
								
						

								 					  
								  $custom_args = array(
								      'post_type' => 'news',
								      'posts_per_page' => 3,
									  'category_name' => $_SESSION['category_name'],
								      'paged' => $paged
								    );
								
								  $custom_query = new WP_Query( $custom_args ); ?>
								 
								  <?php if ( $custom_query->have_posts() ) : ?>
								   
								    <!-- the loop -->
								    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
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
								        custom_pagination($custom_query->max_num_pages,"",$paged);
								      }
								    ?>
								 
								  <?php wp_reset_postdata(); wp_reset_query(); ?>
								 
								  <?php else:  ?>
								    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
								  <?php endif; ?>
														
						</div>
						<aside class="col-sm-3 col-sm-pull-9">
							<nav class="add-nav">
								<ul class="list-unstyled">
									<li class="<?php if($_SESSION['category_name']=='press-releases') echo 'active';?>"><a href="<?php echo  esc_url( add_query_arg( 'cat', 'press-releases', get_permalink( 2 ) ) );?>">Press Releases </a></li>
									<li class="<?php if($_SESSION['category_name']=='application-notes') echo 'active';?>"><a href="<?php echo  get_home_url().'/news-page?cat=application-notes';?>">Application Notes </a></li>
									<li class="<?php if($_SESSION['category_name']=='other-category') echo 'active';?>"><a href="<?php echo  get_home_url().'/news-page?cat=other-category';?>">Other Category </a></li>
									<li class="<?php if($_SESSION['category_name']=='archive') echo 'active';?>"><a href="<?php echo  get_home_url().'/news-page?cat=archive';?>"> Archive </a></li>
								</ul>
							</nav>
							
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

