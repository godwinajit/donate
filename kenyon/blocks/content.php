<article class="post <?php echo join( ' ', get_post_class('', null)) ?>" id="post-<?php the_ID(); ?>">
    <?php if (has_post_thumbnail()) : ?>
        <div class="image-block">
			<a href="<?php the_permalink() ?>">
            <?php the_post_thumbnail(); ?>
			</a>
        </div>
    <?php endif; ?>
    <header>
        <div class="meta clearfix">
            <strong class="comment-counter"><?php comments_popup_link(0, 1, '%'); ?></strong>
			<?php /*?><?php if( get_post_type( $post ) !='product'): ?>
			<time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F j Y')?></time>
            <?php the_author_posts_link() ?>
			<?php endif;?><?php */?>
        </div>
        <?php the_title( '<h1><a href="' . esc_url( get_permalink() ) . '">', '</a></h1>' ); ?>
    </header>
    <?php the_excerpt() ?>
    <a href="<?php the_permalink() ?>" class="more"><?php _e('Read on', 'kenyon') ?></a>
    <?php edit_post_link( __('Edit', 'kenyon'), '<br />', ''); ?>
</article>

