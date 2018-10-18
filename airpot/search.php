<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Shape
 * @since Shape 1.0
 */
get_header(); ?>
      <main id="main">
			<div class="container-fluid main-section">		
			
            <?php if ( have_posts() ) : ?>

                <header style="margin-left:12px;" class="page-header">
                    <h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->     

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
 				<?php get_template_part( 'content', 'page' ); ?>  

                <?php endwhile; ?>
            <?php endif; ?>
 </div>			
</main>
<?php get_footer(); ?>