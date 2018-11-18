<?php 

/*

  Template Name: Terms Page Template

 */

get_header();

/** getting custom field values :Meet our Attorneys 
$title = get_field('title');
$description = get_field('description');
$view_all_button_text = get_field('view_all_button_text');
$view_all_button_link = get_field('view_all_button_link');
*/
 ?>
	<main id="main" role="main">
		<div class="container content-container">
			<div class="content-section">
			<?php while ( have_posts() ) : the_post(); ?>
				<header class="heading text-center">
					<div class="heading-frame">
						<h1 class="h2"><?php echo the_title(); ?></h1>
						<div class="divider style-dark"><div></div></div>
					</div>
				</header>
				<?php echo the_content(); ?>
				<p>Last updated:  <?php the_modified_date();?></p>
				
				<?php endwhile; ?>
			</div>
		</div>
		<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>
	<?php get_footer();?>