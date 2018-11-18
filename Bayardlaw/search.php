<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
<div class="container">
		<ol class="breadcrumb">
			<li><a href="#">Search Results</a></li>
			<li class="active"><?php printf( __( '%s', 'bayardlaw' ), get_search_query() ); ?></li>
		</ol>
	</div>

<main id="main" role="main">
		<header class="page-heading container-fluid search-results-heading">
			<div class="center-block">
				<div class="row">
					<div class="col-lg-6 col-md-7 col-xs-12">
						<h1>Search Results for <em>“<?php printf( __( '%s', 'bayardlaw' ), get_search_query() ); ?>”</em></h1>
					</div>
					<div class="col-lg-6 col-md-5 col-xs-12">
						<form role="search" class="search-form" action="<?php echo get_site_url(); ?>" method="post">
							<div class="input-group">
								<input type="search" class="form-control" name="s" value="<?php printf( __( '%s', 'bayardlaw' ), get_search_query() ); ?>">
								<span class="input-group-btn">
									<button type="submit" class="btn"><i class="glyphicon glyphicon-search"></i></button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</header>
		<div class="container content-container">
			<div class="content-section">
				<div class="news-gallery">
					<div class="mask">
						<div class="slideset">
						
						<?php
						$countposts = $wp_query->post_count; 
						if ( have_posts() ) : ?>
						
	
						<div class="slide">
						
											
						<?php 
						$articlecount=1;
					while ( have_posts() ) : the_post(); ?>
					
								<section class="news-box">
									<h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
									<p><?php 
									
									 
									$content = wp_trim_words( get_the_content(), 30 );;
									$keys = implode('|', explode(' ', get_search_query()));
									$content = preg_replace('/(' . $keys .')/iu', '<mark>\0</mark>', $content);
									
									echo  $content;
									
									
									
									
									?></p>
									<a href="<?php the_permalink(); ?>" class="btn btn-link">Read More</a>
								</section>
					
						
						
						
						<?php 
						if($articlecount % 5==0 && ($countposts != $articlecount ))
						{
							echo "</div><div class='slide'>";
						}
						$articlecount++;
						endwhile; ?>
						<?php else : ?>
							<p> No Items available for the current search term </p>
						<?php endif; ?>
			</div>
							
								
								
						
							
							
						</div>
					</div>
					<div class="pagination-holder">
						<a class="btn-prev" href="#">Previous</a>
						<div class="pagination">
							<!-- pagination generated here -->
						</div>
						<a class="btn-next" href="#">Next</a>
					</div>
				</div>
			</div>
		</div>
		<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>

<?php get_footer(); ?>