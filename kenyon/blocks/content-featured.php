<article class="post <?php echo join( ' ', get_post_class('', null)) ?>" id="post-<?php the_ID(); ?>">
    <?php if (has_post_thumbnail()) : ?>
    <div class="image-block">
        <?php the_post_thumbnail('blogroll-featured'); ?>
    </div>
    <?php endif; ?>
    <header>
        <div class="meta clearfix">
            <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F j Y')?></time>
            <?php the_author_posts_link() ?>
        </div>
        <h1><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
    </header>
    <?php the_excerpt() ?>
    <?php edit_post_link( __('Edit', 'kenyon')); ?>
</article>