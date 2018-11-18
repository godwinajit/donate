<?php

$title = get_field('news_title');

$count = get_field('news_count');
$count = $count ? $count : 1;


$category = get_field('news_category');

if (empty($category)) return; 

$category = get_term($category, 'category');

if (empty($category) || is_wp_error($category)) return; 

query_posts(array(
   'posts_per_page' => $count,
   'cat' => $category->term_id,
));

if (have_posts()) : the_post(); ?>
<article class="col-md-6 col-sm-6 same-height">
	<?php if ($title) : ?>
    <header class="heading">
        <h2><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $title; ?></a></h2>
    </header>
	<?php endif; ?>
	
    <?php if (has_post_thumbnail()) : ?>
    <div class="image-block">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('homepage-latest-news-image') ?></a>
    </div>
    <?php endif; ?>
    <h3><a href="<?php the_permalink() ?>"><?php the_title()?></a></h3>
    <?php the_excerpt(); ?>
    <div class="link-block">
        <a href="<?php the_permalink(); ?>" class="more"><?php _e('Read on', 'kenyon') ?></a>
    </div>
</article>
<?php endif; ?>