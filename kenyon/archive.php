<?php get_header(); ?>

<div class="container">
    <?php get_template_part('blocks/breadcrumbs'); ?>
<div class="title-box">
<div class="title-page">
    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    <?php /* If this is a category archive */ if (is_category()) { ?>
        <h1><?php printf(__( 'Archive for the &#8216;%s&#8217; Category', 'kenyon' ), single_cat_title('', false)); ?></h1>
        <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
        <h1><?php printf(__( 'Posts Tagged &#8216;%s&#8217;', 'kenyon' ), single_tag_title('', false)); ?></h1>
        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
        <h1><?php _e('Archive for', 'kenyon'); ?> <?php the_time('F jS, Y'); ?></h1>
        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
        <h1><?php _e('Archive for', 'kenyon'); ?> <?php the_time('F, Y'); ?></h1>
        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
        <h1><?php _e('Archive for', 'kenyon'); ?> <?php the_time('Y'); ?></h1>
        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
        <h1><?php _e('Author Archive', 'kenyon'); ?></h1>
        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        <h1><?php _e('Blog Archives', 'kenyon'); ?></h1>
    <?php } ?>
   
</div>
<div class="category-filter">
<form id="category-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

<?php
$theCatId = get_term_by( 'slug', 'news', 'category' );
$theCatId = $theCatId->term_id;

$args = array(
    			'orderby'          => 'name',
    			'echo'             => 0,
    		    'hide_empty'      => 0,
    		    'child_of' => $theCatId,
);
?>
    
    		<?php $select  = wp_dropdown_categories( $args ); ?>
    		<?php $replace = "<select$1 onchange='return this.form.submit()'> <option value='$theCatId'>Select a SubCategory</option>"; ?>
    		<?php $select  = preg_replace( '#<select([^>]*)>#', $replace, $select ); ?>
    
    		<?php echo $select; ?>
    
    		<noscript>
    			<input type="submit" value="View" />
    		</noscript>
    
    	</form>
    	</div>
    	
    	</div>
</div>
 

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