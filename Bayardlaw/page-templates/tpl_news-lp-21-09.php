<?php 

/*

  Template Name: News Listing Page Template

 */

get_header();
$query_array = array('relation' => 'AND');

if(isset($_GET['practice']) && !empty($_GET['practice'])){
	$designation = $_GET['practice'];
	array_push($query_array, array('key' => 'practices_tag', 'value' => $designation, 'compare' => 'like'));
}elseif(isset($_GET['authfilter']) && !empty($_GET['authfilter'])){
	echo $author = $_GET['authfilter'];
	array_push($query_array, array('key' => 'attorneys_tag', 'value' => $author, 'compare' => 'like'));
}


?>
<?php if ( have_posts() ) : ?>
					<?php while (have_posts()) : the_post();
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID),'full');
						$bannerTitle = get_the_title();
						$bannerContent = get_the_content();
						if(isset($_GET['category']) && !empty($_GET['category'])){
							$catDetails = get_category_by_slug($_GET['category']);
							$bannerTitle = $catDetails->name;
							$bannerContent = $catDetails->category_description;
						}
					?>
	<section class="visual-section">
		<div class="bg-stretch"><img src="<?php echo $large_image_url[0];?>" alt=""></div>
		<div class="container">
			<div class="frame">
				<div class="text-block center-block text-center">
					<div class="divider"><div></div></div>
					<h1><?php echo $bannerTitle;?></h1>
					<p><?php echo $bannerContent;?></p>
				</div>
			</div>
		</div>
	</section>
	<main id="main" role="main">
		<div class="container">
			<div class="filter-bar clearfix">
				<strong class="title pull-left">Filter by:</strong>
				<a href="/news" class="view-all pull-right">View All</a>
				<div class="holder">
					<ul class="list-inline add-nav" id="filter">
					<?php foreach (get_categories() as $category){
						if ($category->count > 0 && get_option('category_'.$category->term_id.'_show_in_news_page_filters')=='Yes'){
						?>
							<li><a href="<?php echo esc_url( add_query_arg( 'category', $category->slug, the_permalink()));?>"><?php echo $category->cat_name;?></a></li>
					
						<?php } 
						} ?>
						<li class="panel">
							<a href="#filter-drop-01" data-toggle="collapse" aria-expanded="false" data-parent="#filter">Attorney</a>
							<div class="filter-drop collapse" id="filter-drop-01">
								<div class="container-fluid">
									<ul class="list-inline">
									<?php $args = array( 'post_type' => 'attorney','posts_per_page'   =>100,'orderby'=> 'title','order'=> 'ASC');
										$posts_array = get_posts( $args ); 
										
										foreach ( $posts_array as $posts_val ) :  ?>
										<li><a href="<?php echo esc_url( add_query_arg( 'authfilter', $posts_val->ID, the_permalink()));?>"><?php echo get_the_title( $posts_val );?></a></li>
										<?php  endforeach;  ?>
										
									</ul>
								</div>
							</div>
						</li>						
						<?php $taxonomies = get_object_taxonomies('attorney');
								$cat_args = array(								
								'number'        => 10,
								'hide_empty'    => true
								);
								$termparent =  get_terms($taxonomies[0]);														
						?>					
						<li class="panel">
							<a href="#filter-drop-02" data-toggle="collapse" aria-expanded="false" data-parent="#filter">Practice Area</a>
							<div class="filter-drop collapse" id="filter-drop-02">
								<div class="container-fluid">							
									<ul class="list-inline">
										<?php foreach ($termparent as $term):?>
										<li><a href="<?php echo esc_url( add_query_arg( 'practice', $term->term_id , the_permalink()));?>"><?php echo $term->name ;?></a></li>
										<?php endforeach;?>
									</ul>
								</div>
							</div>
						</li>					
					
					</ul>
				</div>
			</div>
			<div class="content-section">
				<div class="news-gallery">
					<div class="mask">
						<div class="slideset">
						
						<?php 	$latest_page = (get_query_var('page')) ? get_query_var('page') : 1;
							$args = array( 'posts_per_page'   =>6,'paged' => $latest_page,'orderby'=> 'date','order'=> 'DESC');
						
							if(isset($_GET['practice']) && !empty($_GET['practice'])){
								$args = array('posts_per_page'   =>6 ,'paged' => $latest_page, 'orderby'=> 'date', 'order'=> 'DESC', 'meta_query' => $query_array);
							}
							if(isset($_GET['category']) && !empty($_GET['category'])){
								$args = array('posts_per_page'   =>6 ,'paged' => $latest_page, 'orderby'=> 'date', 'order'=> 'DESC','category_name'=>$_GET['category']);
							}
							if(isset($_GET['authfilter']) && !empty($_GET['authfilter'])){
								$args = array('posts_per_page'   =>6 ,'paged' => $latest_page, 'orderby'=> 'date', 'order'=> 'DESC', 'meta_query' => $query_array);
							}
							$the_query = new WP_Query( $args ); 
							
							?>
						<?php if ( $the_query->have_posts() ) : ?>
						<?php $i=1;  
						$published_posts = $the_query->post_count;
						while ( $the_query->have_posts() ) : $the_query->the_post(); 
							if($i==1 || $i%6==1):?>
							
							<div class="slide">
								<div class="row">
							<?php endif;?>
									<div class="col-sm-6 col-xs-12">
										<section class="news-box news-box-border">
											<div class="frame">
											<?php  $post_categories = wp_get_post_categories( $post->ID );
													$cat = get_category( $post_categories[0] );
													$category_link = get_category_link( $cat->term_id );?>
												<header>
													<ul class="list-inline bar">
														<li><a href="<?php echo get_site_url(); ?>/news/?category=<?php echo $cat->slug; ?>"><?php echo $cat->name;?></a></li>
														<li><time datetime="2015-05-15"> <?php echo get_the_date('m.d.Y')?></time></li>
													</ul>
													<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
													<?php if($cat->name=='Publication'):?>
													<?php 
													$posts = get_field('attorneys_tag');													
													if( $posts ): ?>
													    <ul>
													    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
													        <?php setup_postdata($post);  ?>
													      
													        <a href="<?php the_permalink(); ?>" class="author">- By <?php the_title(); ?> </a>
													    <?php endforeach; ?>
													    </ul>
													    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
													<?php endif; ?>
													
													<?php endif;?>
												</header>
												<p><?php echo wp_trim_words( get_the_content(), 25, '...' );?></p>
												<!-- <ul class="list-inline">
													<li><a class="btn btn-link" href="#">#Tag</a></li>
													<li><a class="btn btn-link" href="#">#Tag</a></li>
													<li><a class="btn btn-link" href="#">#Tag</a></li>
												</ul>
												 -->
											</div>
											<footer>
												<a href="<?php the_permalink(); ?>" class="btn">Read <?php echo $cat->name;?></a>
											</footer>
										</section>
									</div>
									<?php if($i%2==0):?>
									<div class="clearfix"></div>
									<?php endif;?>
								<?php 	
								if($i%6==0 || $i==$published_posts):?>
								</div>
							</div>
							<?php endif;?>
							<?php $i++;endwhile;?>
							<?php wp_reset_postdata(); ?>
							<?php else:  ?>
							<p><?php _e( 'Sorry, no News matched your criteria.' ); ?></p>
							<?php endif; ?>
							<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
										
							
						</div>
					</div>
					<!-- <div class="pagination-holder">
						<a class="btn-prev" href="#">Previous</a>
						<div class="pagination">
							<!-- pagination generated here --
						</div>
						<a class="btn-next" href="#">Next</a>
					</div>-->
					<div class="pagination-holder">
					<?php  echo '<div class="pagination-links">';
					$big = 999999999; // need an unlikely integer
			    $args = array(			    		
			    		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			    		'format' => '?paged=%#%',
			    		'current' => max( 1, get_query_var('paged') ),
			    		'total'              => $the_query->max_num_pages,			    		
			    		'show_all'           => false,
			    		'end_size'           => 1,
			    		'mid_size'           => 2,
			    		'prev_next'          => True,
			    		'prev_text'          => __('Previous'),
			    		'next_text'          => __('Next'),
			    		'type'               => 'list',
			    		
			    );
    	echo paginate_links( $args ); ?>
    	</div>
				</div>
			</div>
		</div>
		<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>
	<?php endwhile;?>
					<?php wp_reset_postdata(); ?>
					<?php else:  ?>
					<p><?php _e( 'Sorry, no News matched your criteria.' ); ?></p>
					<?php endif; ?>
					<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<?php get_footer();?>