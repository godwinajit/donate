<?php

theme_wrapper_class('update-page blog');

$post = $posts[0];
if (is_category()) {
    theme_header_title(sprintf(__( 'Archive for the &#8216;%s&#8217; Category', 'subculture' ), single_cat_title('', false)));
} elseif( is_tag() ) {
    theme_header_title(sprintf(__( 'Posts Tagged &#8216;%s&#8217;', 'subculture' ), single_tag_title('', false)));
} elseif (is_day()) {
    theme_header_title(__('Archive for', 'subculture') . ' ' .  get_the_time('F jS, Y'));
} elseif (is_month()) {
    theme_header_title(__('Archive for', 'subculture') . ' ' .  get_the_time('F, Y'));
} elseif (is_year()) {
    theme_header_title(__('Archive for', 'subculture') . ' ' .  get_the_time('Y'));
} elseif (is_author()) {
    theme_header_title(__('Author Archive', 'subculture'));
} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
    theme_header_title(__('Blog Archives', 'subculture'));
}

get_header(); 

$recent_posts_args = array(
	'numberposts' => 5,
	'offset' => 0,
	'category' => 0,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'post',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_posts = wp_get_recent_posts( $recent_posts_args, ARRAY_A );
$current_posts = array();

if (have_posts()) :
	while (have_posts()) : the_post();
		$current_posts[] = get_the_ID();
	endwhile;
endif;
?>

        <div class="intro">
            <div class="img-w blog-banner">
            </div>
            <div class="title-holder top-banner-text">
                <div class="title-frame row">
                    <div class="col-md-10 col-sm-12">
                        <span class="page-title"><a href="/blog"> Blog &nbsp; > </a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-holder">
            <div class="blog-slider">
				<?php foreach( $recent_posts as $recent_post ){?>
                <div class="blog-slide">
                    <a href="<?php echo get_permalink($recent_post['ID']);?>">
					<?php $recent_image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_post['ID'] ), 'post-thumbs-1108x570' ); ?>
                        <div class="text-holder" style="background-image: url('<?php echo $recent_image[0];?>')">
                            <span class="date"><strong><?php echo get_the_date('j', $recent_post['ID']);?></strong><?php echo get_the_date('M', $recent_post['ID']);?></span>
                            <div class="event-title">
                                <span class="subtitle"><?php echo get_field('post_sub_title', $recent_post['ID']);?></span>
                                <h2><?php echo $recent_post['post_title']; ?></h2>
                            </div>
                        </div>
                    </a>
                </div>
				<?php }?>
            </div>
            <div class="content-wrapper container">
                <div class="row posts">
                    <div class="col-md-9 col-sm-12">
                        
						<div class="row preview">
							<?php if (!empty($current_posts)) : 
								$postCount = -1;
								foreach( $current_posts as $current_post){
									$post = get_post($current_post);
									setup_postdata($post);
									$imageRelated = get_field ( 'post_thumbnail', get_the_id() );
									$postCount++;
									?>
		                            <div class="col-md-4 col-sm-6 col-xs-12">
										<?php if (is_array ( $imageRelated ) && isset ( $imageRelated ['sizes'] ['post-thumbs-263x401'] )) {?>
										<a href="<?php echo esc_url( get_permalink() );?>"><img src="<?php echo $imageRelated ['sizes'] ['post-thumbs-263x401']; ?>"	alt="<?php the_title();?>"></a>
										<?php }?>
										<span class="date"><strong><?php echo get_the_date('j');?></strong><?php echo get_the_date('M');?></span>
										<div class="post-description">
											<?php the_title( '<h5><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );?>
											<div class="social-block">
                                        <ul class="social-networks">
                                            <li><a href="<?php echo esc_url( get_permalink() );?>#respond"><i class="fa fa-comment"></i>&nbsp;<?php comments_number( '0', '1', '%' ); ?></a></li>
                                            <li><span class="title">share:</span></li>
                                            <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="blank"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="http://twitter.com/share?url=<?php the_permalink();?>&text=<?php the_title(); ?>" target="blank"><i class="fa fa-twitter"></i></a></li>
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
											<p><?php echo delete_all_between('[embed]', '[/embed]', wp_trim_words( get_the_content(), 40, '...' ));?></p>
										</div>
										<a href="<?php echo esc_url( get_permalink() );?>" class="read-more">Read more</a>
									</div>
								<?php if($postCount == 2) break;?>
								<?php } ?>
							<?php else : ?>
                                No Posts Found.
                            <?php endif; ?>
                        </div>

						<div class="row preview-alt">
							<?php if (count($current_posts)  > 3) : 
										for( $i = 0; $i < (count($current_posts) - 3); $i++ ){
										$postCount++;
										$imageRelated = get_field ( 'post_thumbnail' );
										$post = get_post($current_posts[$postCount]);
										setup_postdata($post);
										$imageRelated = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'post-thumbs-848x400' );
										$termName = '';
										$terms = wp_get_object_terms ( get_the_ID (), 'category' );

										if (! empty ( $terms ) && ! is_wp_error ( $terms )) {
											foreach ( $terms as $term ) {
												$termName .= '<a style="display: inline;" href="' . $url . '' . $term->slug . '">' . $term->name . '</a>, ';
											}
										}

										$termName = rtrim ( $termName, ', ' );
									?>
		                            <div class="col-md-12">
                                <a href="<?php echo esc_url( get_permalink() );?>" class="post-image"><img src="<?php echo $imageRelated[0]; ?>" alt="<?php the_title();?>"></a>
                                <div class="post-description">
                                    <span class="date"><strong><?php echo get_the_date('j');?></strong><?php echo get_the_date('M');?></span>
                                    <?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );?>
                                    <span class="author"><?php echo 'by '. get_the_author_meta('first_name') .' '.get_the_author_meta('last_name');?> - <?php echo $termName;?></span>
                                    <div class="social-block">
                                        <ul class="social-networks">
                                            <li><a href="<?php echo esc_url( get_permalink() );?>#respond"><i class="fa fa-comment"></i>&nbsp;<?php comments_number( '0', '1', '%' ); ?></a></li>
                                            <li><span class="title">share:</span></li>
                                            <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="blank"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="http://twitter.com/share?url=<?php the_permalink();?>&text=<?php the_title(); ?>" target="blank"><i class="fa fa-twitter"></i></a></li>
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
                                    <p><?php echo wp_trim_words( get_the_content(), 40, '...' );?></p>
                                </div>
                                <a href="<?php echo esc_url( get_permalink() );?>" class="read-more">Read more</a>
                            </div>
								<?php } ?>
                            <?php endif; ?>
                        </div>
						<?php get_template_part('blocks/pager'); ?>
                    </div>
                    <div class="col-md-3 col-sm-12 sidebar">
                        <form method="get" class="form-search" action="<?php echo get_home_url();?>">
                            <div class="wrap">
                                <input type="search" id="search" name="s" required>
                                <button type="submit" class="fa fa-search"><span>search</span></button>
                            </div>
                        </form>
                        <h6>Categories</h6>
                        <ul>
						<?php
							$category_list_arr = get_categories('hide_empty=1');
							foreach( $category_list_arr  as $category_list ){
						?>
                            <li><a href="<?php echo get_category_link( $category_list->term_id );?>"><?php echo $category_list->name;?> - <span class="count"><?php echo $category_list->count;?></span></a></li>
						<?php }?>
                        </ul>
                        <h6>Archive</h6>
						<ul>
						<?php
							wp_get_archives();
						?>
                        </ul>
                    </div>
                </div>
                <!-- <div class="row review-block">
                    <div class="col-md-6 col-sm-6 col-xs-12 review-text">
                        <span class="subtitle">Lorem ispum amet sit amet</span>
                        <h2>Jhon doe concert review</h2>
                        <a href="#" class="author-photo"><img src="/wp-content/uploads/2018/03/author-photo.jpg" alt="photo author"></a>
                        <div class="quote">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam "Sed ut perspiciatis unde omnis iste natus error
                            sit voluptatem accusantium
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <img src="http://markup.wpengine.com/markup/subculture-update/images/review-1.jpg" alt="photo">
                    </div>
                </div> -->
            </div>
        </div>





<?php get_footer(); ?>