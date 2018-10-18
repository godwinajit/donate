<?php
/*
* Template - Portfolio post
* Version: 1.1
*/
get_header(); ?>
	<div class="content-area">
		<div id="container" class="site-content">
			<div id="content" class="hentry">
				<div class="breadcrumbs home_page_title entry-header">
					<?php the_title(); ?>
				</div>
				<?php $pdfprnt_options = get_option('pdfprnt_options_array');
				if ( function_exists( 'pdfprnt_show_buttons_for_bws_portfolio_post' ) && ( isset( $pdfprnt_options ) && is_array( $pdfprnt_options ) && true === in_array( 'portfolio', $pdfprnt_options['use_types_posts']) ) )
					echo pdfprnt_show_buttons_for_bws_portfolio_post();
				
				global $wp_query;
				while ( have_posts() ) : the_post(); ?>
					<div class="portfolio_content entry-content">
						<div class="entry">
							<?php global $post;
							$portfolio_options	=	get_option( 'prtfl_options' );
							$meta_values		=	get_post_custom( $post->ID );
							$post_thumbnail_id	=	get_post_thumbnail_id( $post->ID );
							if ( empty ( $post_thumbnail_id ) ) {
								$args = array(
									'post_parent'		=>	$post->ID,
									'post_type'			=>	'attachment',
									'post_mime_type'	=>	'image',
									'orderby'			=>	'menu_order',
									'order'				=>	'ASC',
									'numberposts'		=>	1
								);
								$attachments		=	get_children( $args );
								$post_thumbnail_id	=	key($attachments);
							}
							$image			=	wp_get_attachment_image_src( $post_thumbnail_id, 'portfolio-thumb' );
							$image_large	=	wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
							$image_alt		=	get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
							$image_desc 	=	get_post($post_thumbnail_id);
							$image_desc		=	$image_desc->post_content;
							if ( '1' == get_option( 'prtfl_postmeta_update' ) ) {
								$post_meta		=	get_post_meta( $post->ID, 'prtfl_information', true );
								$date_compl		=	$post_meta['_prtfl_date_compl'];
								if ( ! empty( $date_compl ) && 'in progress' != $date_compl) {
									$date_compl		=	explode( "/", $date_compl );
									$date_compl		=	date( get_option( 'date_format' ), strtotime( $date_compl[1] . "-" . $date_compl[0] . '-' . $date_compl[2] ) );
								}
								$link			=	$post_meta['_prtfl_link'];
								$short_descr	=	$post_meta['_prtfl_short_descr'];
								$full_descr		=	$post->post_content != "" ? $post->post_content : $post_meta['_prtfl_short_descr'];
								$svn			=	$post_meta['_prtfl_svn'];
							} else {
								$date_compl		=	get_post_meta( $post->ID, '_prtfl_date_compl', true );
								if ( ! empty( $date_compl ) && 'in progress' != $date_compl) {
									$date_compl		=	explode( "/", $date_compl );
									$date_compl		=	date( get_option( 'date_format' ), strtotime( $date_compl[1] . "-" . $date_compl[0] . '-' . $date_compl[2] ) );
								}
								$link			=	get_post_meta( $post->ID, '_prtfl_link', true );
								$short_descr	=	get_post_meta( $post->ID, '_prtfl_short_descr', true );
								$full_descr		=	$post->post_content != "" ? $post->post_content : get_post_meta( $post->ID, '_prtfl_short_descr', true );
								$svn			=	get_post_meta( $post->ID, '_prtfl_svn', true );
							} ?>
							<div class="portfolio_thumb">
								<a class="lightbox" rel="portfolio_fancybox" href="<?php echo $image_large[0]; ?>" title="<?php echo $image_desc; ?>">
									<img src="<?php echo $image[0]; ?>" width="<?php echo $portfolio_options['prtfl_custom_size_px'][0][0]; ?>" height="<?php echo $portfolio_options['prtfl_custom_size_px'][0][1]; ?>" alt="<?php echo $image_alt; ?>" />
								</a>
							</div><!-- .portfolio_thumb -->
							<div class="portfolio_short_content">
								<?php if ( 1 == $portfolio_options['prtfl_date_additional_field'] ) { ?>
										<p>
											<span class="lable"><?php echo $portfolio_options['prtfl_date_text_field']; ?></span> <?php echo $date_compl; ?>
										</p>
								<?php }
								$user_id = get_current_user_id();
								if ( 1 == $portfolio_options['prtfl_link_additional_field'] ) {
									if ( false !== parse_url( $link ) ) { ?>
										<?php if ( ( 0 == $user_id && 0 == $portfolio_options['prtfl_link_additional_field_for_non_registered'] ) || 0 != $user_id ) { ?>
											<p><span class="lable"><?php echo $portfolio_options['prtfl_link_text_field']; ?></span> <a href="<?php echo $link; ?>"><?php echo $link; ?></a></p>
										<?php } else { ?>
											<p><span class="lable"><?php echo $portfolio_options['prtfl_link_text_field']; ?></span> <?php echo $link; ?></p>
										<?php }
									} else { ?>
										<p><span class="lable"><?php echo $portfolio_options['prtfl_link_text_field']; ?></span> <?php echo $link; ?></p>
									<?php }
								}
								if ( 1 == $portfolio_options['prtfl_description_additional_field'] ) { ?>
									<p><span class="lable"><?php echo $portfolio_options['prtfl_description_text_field']; ?></span> <?php echo str_replace("\n", "<br />", $full_descr); ?></p>
								<?php }
								if ( 0 != $user_id && $portfolio_options ) {
									if ( 1 == $portfolio_options['prtfl_svn_additional_field'] ) { ?>
										<p><span class="lable"><?php echo $portfolio_options['prtfl_svn_text_field']; ?></span> <?php echo $svn; ?></p>
									<?php }
									if ( 1 == $portfolio_options['prtfl_executor_additional_field'] ) {
										$executors_profile = wp_get_object_terms( $post->ID, 'portfolio_executor_profile' ); ?>
										<p><span class="lable"><?php echo $portfolio_options['prtfl_executor_text_field']; ?></span>
										<?php $count = 0;
										foreach ( $executors_profile as $profile ) {
											if ( $count > 0 )
												$content .= ', '; ?>
											<a href="<?php echo $profile->description; ?>" title="<?php echo $profile->name; ?> profile" target="_blank"><?php echo $profile->name; ?></a>
											<?php $count++;
										} ?>
										</p>
									<?php }
								 } ?>
							</div><!-- .portfolio_short_content -->
							<div class="portfolio_images_block">
								<?php $args = array(
									'post_parent'		=>	$post->ID,
									'post_type'			=>	'attachment',
									'post_mime_type'	=>	'image',
									'numberposts'		=>	-1,
									'orderby'			=>	'menu_order',
									'order'				=>	'ASC',
									'exclude'			=>	$post_thumbnail_id
								);
								$attachments				=	get_children( $args );
								$array_post_thumbnail_id	=	array_keys( $attachments );
								$count_element				=	count( $array_post_thumbnail_id );

								while ( list( $key, $value ) = each( $array_post_thumbnail_id ) ) {
									$image			=	wp_get_attachment_image_src( $value, 'portfolio-photo-thumb' );
									$image_large	=	wp_get_attachment_image_src( $value, 'large' );
									$image_alt		=	get_post_meta( $value, '_wp_attachment_image_alt', true );
									$image_title	=	get_post_meta( $value, '_wp_attachment_image_title', true );
									$image_desc 	=	get_post($value);
									$image_desc		=	$image_desc->post_content;

									if ( 0 == $key ) { ?>
										<span class="lable"><?php echo $portfolio_options['prtfl_screenshot_text_field']; ?></span>
										<div class="portfolio_images_rows">
									<?php } ?>
										<div class="portfolio_images_gallery">
											<a class="lightbox" rel="portfolio_fancybox" href="<?php echo $image_large[0]; ?>" title="<?php echo $image_desc; ?>">
												<img src="<?php echo $image[0]; ?>" width="<?php echo $portfolio_options['prtfl_custom_size_px'][1][0]; ?>" height="<?php echo $portfolio_options['prtfl_custom_size_px'][1][1]; ?>" alt="<?php echo $image_alt; ?>" />
											</a>
											<br /><?php echo $image_title; ?>
										</div>
									<?php if ( 0 == ( $key + 1 ) % $portfolio_options['prtfl_custom_image_row_count'] && 0 != $key && $key + 1 != $count_element) { ?>
										</div><!-- .portfolio_images_rows -->
										<div class="portfolio_images_rows">
									<?php }
								}
								if ( 0 < $count_element ) { ?>
									</div><!-- .portfolio_images_rows -->
								<?php } ?>
							</div><!-- .portfolio_images_block -->
						</div><!-- .entry -->
						<div class="entry_footer">
							<div class="read_more">&nbsp;</div>
							<?php $terms = wp_get_object_terms( $post->ID, 'portfolio_technologies' );
							if ( is_array( $terms ) && 0 < count( $terms ) ) { ?>
								<div class="portfolio_terms"><?php echo $portfolio_options['prtfl_technologies_text_field']; ?>
									<?php $count = 0;
									foreach ( $terms as $term ) {
										if ( $count > 0 )
											echo ', ';
										echo '<a href="' . get_term_link( $term->slug, 'portfolio_technologies') . '" title="' . sprintf( __( "View all posts in %s" ), $term->name ) . '" ' . '>' . $term->name . '</a>';
										$count++;
									} ?>
								</div><!-- .portfolio_terms -->
							<?php } ?>
						</div><!-- .entry_footer -->
					</div><!-- .portfolio_content -->
				<?php endwhile; ?>
				<script type="text/javascript">
					(function($){
						$(document).ready(function(){
							<?php if ( ! function_exists( 'is_plugin_active_for_network' ) || ! function_exists( 'is_plugin_active' ) )
								require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
							$all_plugins = get_plugins();
							if ( ( ! is_plugin_active( 'gallery-plugin-pro/gallery-plugin-pro.php' ) && ! is_plugin_active_for_network( 'gallery-plugin-pro/gallery-plugin-pro.php' ) ) || ( isset( $all_plugins["gallery-plugin-pro/gallery-plugin-pro.php"]["Version"] ) && "1.3.0" >= $all_plugins["gallery-plugin-pro/gallery-plugin-pro.php"]["Version"] ) ) {  ?>
								$("a[rel=portfolio_fancybox]").fancybox({
									'transitionIn'		: 'elastic',
									'transitionOut'		: 'elastic',
									'titlePosition' 	: 'inside',
									'speedIn'			: 500,
									'speedOut'			: 300,
									'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
										return '<span id="fancybox-title-inside">' + ( title.length ? title + '<br />' : '' ) + 'Image ' + ( currentIndex + 1 ) + ' / ' + currentArray.length + '</span>';
									}
								});
							<?php } else { ?>
								$("a[rel=portfolio_fancybox]").fancybox({
									openSpeed	:	500, 
									closeSpeed	:	300,
									helpers		: {
										title	: { type : 'inside' }
									},
									prevEffect	: 'fade',
									nextEffect	: 'fade',	
									openEffect	: 'elastic',
									closeEffect	: 'elastic',
									beforeLoad: function() {
										this.title = '<span id="fancybox-title-inside">' + ( this.title.length ? this.title + '<br />' : '' ) + 'Image ' + ( this.index + 1 ) + ' / ' + this.group.length + '</span>';
									}
								});		
							<?php } ?>
						});
					})(jQuery);
				</script>
			</div><!-- #content -->
		</div><!-- #container -->
	</div><!-- .content-area -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>