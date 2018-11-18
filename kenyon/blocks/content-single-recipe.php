<div class="post <?php echo join( ' ', get_post_class('', null)) ?>" id="post-<?php the_ID(); ?>">
    <header class="heading clearfix">
        <div class="social-block">
            <strong class="comment-counter"><?php comments_popup_link(0, 1, '%'); ?></strong>
            <?php get_template_part('blocks/share-links'); ?>
        </div>
        <div class="holder">
            <div class="meta clearfix">
                <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F j Y')?></time>
                <?php the_author_posts_link() ?>
            </div>
            <?php the_title( '<h1><a href="' . esc_url( get_permalink() ) . '">', '</a></h1>' ); ?>
        </div>
    </header>
	
	<?php if (has_post_thumbnail()) : ?>
	<div class="image-block">
		<?php the_post_thumbnail('blogroll-featured'); ?>
	</div>
	<?php endif; ?>

    <?php the_content(); ?>

    <aside class="categories">
        <span class="title"><?php _e('Categories', 'kenyon') ?></span>
        <ul>
            <li><?php the_category('</li> <li>') ?></li>
        </ul>
    </aside>
</div>