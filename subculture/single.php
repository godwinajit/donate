<?php
theme_wrapper_class ( 'update-page blog' );
get_header ();

$url = site_url ( '/category/', 'https' );
$termName = '';
$terms = wp_get_object_terms ( get_the_ID (), 'category' );

if (! empty ( $terms ) && ! is_wp_error ( $terms )) {
	foreach ( $terms as $term ) {
		$termName .= '<a href="' . $url . '' . $term->slug . '">' . $term->name . '</a>, ';
	}
}

$termName = rtrim ( $termName, ', ' );
?>

<div class="intro">
	<div class="img-w blog-banner"></div>
	<div class="title-holder top-banner-text">
		<div class="title-frame row">
			<div class="col-md-10 col-sm-12">
				<span class="page-title"><a href="/blog"> Blog &nbsp; > </a></span>
			</div>
		</div>
	</div>
</div>
<div class="main-holder">
	<div class="banner">
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-main-1405x569' ); ?>
		<img src="<?php echo $image[0]; ?>" alt="<?php the_title();?>">
	</div>
	<div class="content-wrapper container">
		<div class="row post-text">
			<div class="col-md-2 col-sm-12">
				<div class="social-block">
					<span class="date"><strong><?php echo get_the_date('j');?></strong><?php echo get_the_date('M, Y');?></span>
					<ul class="social-networks">
						<li><a href="#respond"><i class="fa fa-comment"></i> <?php comments_number( '0', '1', '%' ); ?></a></li>
						<li><span class="title">share:</span></li>
						<li><span class="st_facebook"><span class="fa fa-facebook"></span></span></li>
						<li><span class="st_twitter"><span class="fa fa-twitter"></span></span></li>
						<li>
							<div class="popup-holder">
								<a href="emailOpen()" class="opener"><span class="fa fa-envelope"></span></a>
								<div class="popup popup-email" title="SHARE VIA EMAIL">
									<?php get_template_part('blocks/events/email'); ?>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-9 col-sm-12">
                        <?php the_title( '<h1>', '</h1>' );?>
                        <span class="author"><?php echo 'by '. get_the_author_meta('first_name') .' '.get_the_author_meta('last_name');?> - <?php echo $termName;?></span>
                        <?php the_content();?>
							<?php
							if (have_rows ( 'post_slider' )) : ?>
							<div class="post-slider-wrap">
								<div class="post-slider">
								<?php while ( have_rows ( 'post_slider' ) ) : the_row ();
								$postSliderImage = get_sub_field ( 'slider_image' );
								if (is_array ( $postSliderImage ) && isset ( $postSliderImage ['sizes'] ['post-thumbs-780x381'] )) {?>
        						<div class="post-slider-item">
									<img src="<?php echo $postSliderImage ['sizes'] ['post-thumbs-780x381'];?>">
								</div>
    							<?php } endwhile; ?>
        	                    </div>
							</div>
							<?php endif; ?>
                        <?php the_field('post_bottom_content');?>
					</div>
			</div>
<div class="row post-text">
<div class="col-md-2 col-sm-12">&nbsp;</div>
<div class="col-md-9 col-sm-12">
		<?php comments_template(); ?>
		</div>
		</div>
		<div class="row preview">
			<p class="related">
				<a href="#">Related posts:</a>
			</p>
			<?php
					$related = new WP_Query ( array (
							'category__in' => wp_get_post_categories ( $post->ID ),
							'posts_per_page' => 4,
							'post__not_in' => array (
									$post->ID 
							) 
					) );
					
					if ($related->have_posts ()) {
						while ( $related->have_posts () ) {
							$related->the_post ();
							$imageRelated = get_field ( 'post_thumbnail' );
							?>
				<div class="col-md-3 col-sm-6 col-xs-12">
				<?php if (is_array ( $imageRelated ) && isset ( $imageRelated ['sizes'] ['post-thumbs-263x401'] )) {?>
					<a href="<?php echo esc_url( get_permalink() );?>"><img src="<?php echo $imageRelated ['sizes'] ['post-thumbs-263x401']; ?>" alt="post image"></a>
				<?php }?>
				<span class="date"><strong><?php echo get_the_date('j');?></strong><?php echo get_the_date('M, Y');?></span>
				<div class="post-description">
					<?php the_title( '<h5><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );?>
					<p><?php echo wp_trim_words( get_the_content(), 40, '...' );?></p>
				</div>
				<a href="<?php echo esc_url( get_permalink() );?>" class="read-more">Read more</a>
			</div>
		<?php }
			wp_reset_postdata ();
		} ?>
		</div>
	</div>
</div>


<?php get_footer(); ?>