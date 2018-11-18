<?php 

/*

  Template Name: Our Attorneys Page Template

 */

get_header();?>
<script type="text/javascript">
<!--
jQuery( document ).ready(function() {
	jQuery(".show-confirm-popup").confirm({ text:"<?php echo get_option( 'attorney_disclaimer' );?>"});
});
//-->
</script>
<?php

/** getting custom field values :Meet our Attorneys 
$title = get_field('title');
$description = get_field('description');
$view_all_button_text = get_field('view_all_button_text');
$view_all_button_link = get_field('view_all_button_link');
*/
$post_type_cat='attorney';
$retiredAttorneyArr = array();

$query_array = array('relation' => 'AND');

if(isset($_GET['designation']) && !empty($_GET['designation'])){
    $designation = $_GET['designation'];
    array_push($query_array, array('key' => 'designation', 'value' => $designation, 'compare' => '='));
}



 ?>
 <?php if ( have_posts() ) : ?>
					<?php while (have_posts()) : the_post();?>	
					<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID),'full');
							?>
 <section class="visual-section">
		<div class="bg-stretch"><img src="<?php echo $large_image_url[0];?>" alt=""></div>
		<div class="container">
			<div class="frame">
				<div class="text-block center-block text-center">
					<div class="divider"><div></div></div>
					<h1><?php the_title();?></h1>
					<p><?php the_content();?></p>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; endif;?>

	<main id="main" role="main">
		<div class="container">
			<div class="filter-bar clearfix">
				<strong class="title pull-left">Filter by:</strong>
				<a href="/our-attorneys" class="view-all pull-right">View All</a>
				<div class="holder">
					<ul class="list-inline add-nav" id="filter">
						<?php $taxonomies = get_object_taxonomies($post_type_cat);
								$cat_args = array(
								'parent'        => 0,
								'number'        => 10,
								'hide_empty'    => false
								);
								$termparent =  get_terms($taxonomies[0],$cat_args);								
						?>
						<?php $i=1;foreach ($termparent as $parent):?>
						<li class="panel">
							<a href="#filter-drop-<?php echo $i;?>" data-toggle="collapse" aria-expanded="false" data-parent="#filter"><?php echo $parent->name;?></a>
							<div class="filter-drop collapse" id="filter-drop-<?php echo $i;?>">
								<div class="container-fluid">							
									<ul class="list-inline">
										<?php  $termchildren = get_terms($taxonomies[0], array('hide_empty' => false,'child_of' => $parent->term_id) );										 
										foreach ($termchildren as $term):?>
										<li><a href="<?php echo esc_url( add_query_arg( 'practice', $term->slug , the_permalink()));?>"><?php echo $term->name ;?></a></li>
										
										<?php endforeach;?>
									</ul>
								</div>
							</div>
						</li>					
						<?php $i++; endforeach;?>
					</ul>
				</div>
			</div>
			<div class="content-section">
				<div class="row">
				<?php 
					$args = array( 'post_type' => 'attorney','posts_per_page'   =>100,
							'meta_query' => $query_array,'meta_key'			=> 'last_name');
					
					if(isset($_GET['practice']) && !empty($_GET['practice'])){
						$args = array( 'post_type' => 'attorney','posts_per_page'   =>100,'tax_query' => array(
																											array(
																												'taxonomy' => 'practices',
																												'field'    => 'slug',
																												'terms'    => $_GET['practice'],
																												),
																											),'meta_key'			=> 'last_name');
					}
					add_filter( 'posts_orderby' , 'posts_orderby_lastname' );
					
					$the_query = new WP_Query( $args ); 
					//echo "Last SQL-Query: {$the_query->request}";
					?>
					<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>	
					<?php if(get_field('retired')){
						$retiredAttorneyArr[] = $post->ID;
						continue;
					}?> 
						<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12">
						<section class="person-box">
							<figure class="img-box">
							<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID),array( 819, 1024));
							?>
								<img src="<?php echo  $large_image_url[0];?>" height="365" width="360" alt="">
								<figcaption>
									<h3><?php the_title(); ?></h3>
									<span class="post"><?php the_field('designation'); ?></span>
								</figcaption>
							</figure>
							<?php $post_categories = wp_get_post_categories( $post->ID );
							$post = &get_post($post->ID);
							// get post type by post
							$post_type = $post->post_type;
							// get post type taxonomies
							$taxonomies = get_object_taxonomies($post_type);
							
							$terms = get_the_terms( $post->ID, $taxonomies[0] );
							?>
							<ul class="scope-list">
							<?php 
							if(is_array($terms)){
								foreach($terms as $pratice){
									if( $pratice->parent != 120 ){
							?>
								<li><?php  echo $pratice->name;?></li>
							<?php 
									}
								}
							}	
							?>
							</ul>
							<footer>
								<ul>
									<li><a href="tel:<?php the_field('phone'); ?>"><?php the_field('phone'); ?></a></li>
									<li><a class="email show-confirm-popup" href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a></li>
								</ul>
								<?php if(!get_field('retired')){?>
									<a href="<?php the_permalink(); ?>" class="btn btn-primary"><span><span>Read Bio</span></span></a>
								<?}?>
							</footer>
						</section>
					</div>		
					
					
					<?php endwhile;//remove_filter( 'posts_orderby' , 'posts_orderby_lastname' );?>
					<?php wp_reset_postdata(); ?>
					<?php else:  ?>
					<p><?php _e( 'Sorry, no attorneys matched your criteria.' ); ?></p>
					<?php endif; ?>
					<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

					<!-- Retired Attorney Listing -->
					<?php if(count($retiredAttorneyArr)){?>
						<?php 
							foreach($retiredAttorneyArr as $retiredAttorney){
						?>
							<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12">
							<section class="person-box">
								<figure class="img-box">
								<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $retiredAttorney),array( 819, 1024));
								?>
									<img src="<?php echo  $large_image_url[0];?>" height="365" width="360" alt="">
									<figcaption>
										<h3><?php echo get_the_title($retiredAttorney); ?></h3>
										<span class="post"><?php the_field('designation', $retiredAttorney); ?></span>
									</figcaption>
								</figure>
								<?php $post_categories = wp_get_post_categories( $retiredAttorney );
								$post = &get_post($retiredAttorney);
								// get post type by post
								$post_type = $post->post_type;
								// get post type taxonomies
								$taxonomies = get_object_taxonomies($post_type);
								
								$terms = get_the_terms( $retiredAttorney, $taxonomies[0] );
								?>
								<ul class="scope-list">
								<?php 
								if(is_array($terms)){
									foreach($terms as $pratice){
										if( $pratice->parent != 120 ){
								?>
									<li><?php  echo $pratice->name;?></li>
								<?php 
										}
									}
								}	
								?>
									</ul>
								<footer>
									<ul>
										<li><a href="tel:<?php the_field('phone', $retiredAttorney); ?>"><?php the_field('phone', $retiredAttorney); ?></a></li>
										<li><a class="email show-confirm-popup" href="mailto:<?php the_field('email', $retiredAttorney); ?>"><?php the_field('email', $retiredAttorney); ?></a></li>
									</ul>
									<?php if(!get_field('retired', $retiredAttorney)){?>
										<a href="<?php the_permalink(); ?>" class="btn btn-primary"><span><span>Read Bio</span></span></a>
									<?}?>
								</footer>
							</section>
						</div>
						<?}?>
					<?}?>
				</div>
			</div>
		</div>
		<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>
	<?php get_footer();?>