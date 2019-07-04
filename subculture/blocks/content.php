<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="title">
			<?php if ( is_single() ) :
				the_title( '<h1>', '</h1>' );
			else :
				the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
            
            <?php $start_date = get_post_meta(get_the_ID(), '_start', true);  ?>
            <?php if($start_date): ?>
				<p class="info"><strong class="date"><a href="<?php the_permalink() ?>" rel="bookmark"><?php echo theme_ts_event_date('F jS, h:i a', $start_date) ?></a></strong></p>
            <?php endif; ?>
	</div>
	<div class="content">
		<?php the_post_thumbnail(); ?>
		<?php if (is_single()) :
			the_content();
		else:
			theme_the_excerpt();
		endif; ?>
	</div>
	<div class="meta">
		<ul>
			<?php the_tags(__('<li>Tags: ', 'subculture'), ', ', '</li>'); ?>
			<?php edit_post_link( __( 'Edit', 'subculture' ), '<li>', '</li>' ); ?>
		</ul>
	</div>
</div>
