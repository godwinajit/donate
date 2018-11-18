<?php

query_posts(array(
'taxonomy' => 'Featured',
    'post_type' => 'recipe',
    'posts_per_page' => 1,
));

if (have_posts()) : the_post(); ?>
<article class="col-md-6 col-sm-6">
    <div class="recipe-block same-height">
        <header class="heading">
            <h2><a href="<?php echo get_post_type_archive_link('recipe'); ?>"><?php _e('Recipes', 'kenyon') ?></a></h2>
        </header>
        <div class="clearfix holder">
            <?php if (has_post_thumbnail()) : ?>
            <div class="image-block">
                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('homepage-latest-recipe-image') ?></a>
            </div>
            <?php endif; ?>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
            <?php the_excerpt() ?>
            <div class="link-block">
                <a href="<?php the_permalink() ?>" class="more"><?php _e('Read on', 'kenyon') ?></a>
            </div>
        </div>
    </div>
</article>
<?php endif; ?>