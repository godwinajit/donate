<?php
/*
 Template Name: Portfolio template
* Version: 1.1
*/
get_header(); ?>
<div class="top-section">
	<div class="video-section">
		<div class="holder">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-push-1">
						<form action="#" class="filter-form">
							<fieldset>
								<h1>The Learning Center</h1>
								<h2>Browse our extensive library of marketing resources</h2>
								<div class="row">
									<div class="col-sm-10 col-sm-push-1">
										<div class="row">
											<div class="col-sm-3 col-xs-6">
												<select id="all-topics">
													<option value="*">All</option>
													<option value=".filter-branding">Branding</option>
													<option value=".filter-web">Web Design</option>
												</select>
											</div>
											<div class="col-sm-3 col-xs-6">
												<select id="type">
													<option value="*">All</option>
													<option value=".filter-logotype">Custom Logotype</option>
													<option value=".filter-identify">Brand identify</option>
													<option value=".filter-web">Web Design</option>
												</select>
											</div>
											<div class="col-sm-6 col-xs-12">
												<input type="search" placeholder="Search"
													class="form-control">
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="video-frame">
			<div class="video-box hidden-xs" data-width="720" data-height="406">
				<video class="mejs-wmp" width="720" height="406" controls="none"
					preload="none"
					poster="http://s3.amazonaws.com/ewa-upload/loop_girl.jpg"
					autoplay="autoplay" loop="loop">
					<source src="http://s3.amazonaws.com/ewa-upload/loop_girl.mp4" />
					<source src="http://s3.amazonaws.com/ewa-upload/loop_girl.webm" />
					<source src="http://s3.amazonaws.com/ewa-upload/loop_girl.ogv" />
				</video>
			</div>
			<div class="img-placeholder" data-width="720" data-height="406">
				<img src="images/img-video-01.jpg" alt="image description"
					width="1400" height="538" />
			</div>
		</div>
	</div>
</div>

<main id="main" role="main">
<section class="block studies-section">
	<div class="container">
		<h2>Case Studies</h2>
		<div class="row">
			<div class="isotop-items-holder">
				<div class="content-area">
					<div id="container" class="site-content">
						<div id="content" class="hentry">
							
							

						<?php $count = 0;
						if ( get_query_var( 'paged' ) ) {
							$paged = get_query_var( 'paged' );
						} elseif ( get_query_var( 'page' ) ) {
							$paged = get_query_var( 'page' );
						} else {
							$paged = 1;
						}
						$per_page = $showitems = get_option( 'posts_per_page' );
						$technologies = isset( $wp_query->query_vars["technologies"] ) ? $wp_query->query_vars["technologies"] : "";
						$executor_profile = isset( $wp_query->query_vars["portfolio_executor_profile"] ) ? $wp_query->query_vars["portfolio_executor_profile"] : "";
						if ( "" != $technologies ) {
							$args = array(
						'post_type' 		=> 'portfolio',
						'post_status' 		=> 'publish',
						'orderby' 			=> $portfolio_options['prtfl_order_by'],
						'order'			 	=> $portfolio_options['prtfl_order'],
						'posts_per_page'	=> $per_page,
						'paged' 			=> $paged,
						'tax_query' 		=> array(
							array(
								'taxonomy' 	=> 'portfolio_technologies',
								'field' 	=> 'slug',
								'terms' 	=> $technologies
							)
							)
							);
						} else if ( "" != $executor_profile ) {
							$args = array(
						'post_type' 		=> 'portfolio',
						'post_status' 		=> 'publish',
						'orderby'			=> $portfolio_options['prtfl_order_by'],
						'order' 			=> $portfolio_options['prtfl_order'],
						'posts_per_page' 	=> $per_page,
						'paged' 			=> $paged,
						'tax_query' 		=> array(
							array(
								'taxonomy' 	=> 'portfolio_executor_profile',
								'field' 	=> 'slug',
								'terms' 	=> $executor_profile
							)
							)
							);
						} else {
							$args = array(
						'post_type'			=>	'portfolio',
						'post_status'		=>	'publish',
						'orderby'			=>	$portfolio_options['prtfl_order_by'],
						'order'				=>	$portfolio_options['prtfl_order'],
						'posts_per_page'	=>	$per_page,
						'paged'				=>	$paged
							);
						}

						$second_query = new WP_Query( $args );

						$pdfprnt_options = get_option('pdfprnt_options_array');
						if ( function_exists( 'pdfprnt_show_buttons_for_bws_portfolio' ) &&  ( isset( $pdfprnt_options ) && is_array( $pdfprnt_options ) && true === in_array( 'portfolio', $pdfprnt_options['use_types_posts']) ) )
						echo pdfprnt_show_buttons_for_bws_portfolio();

						$request = $second_query->request;

						if ( $second_query->have_posts() ) :
						while ( $second_query->have_posts() ) : $second_query->the_post(); ?>
							<div class="portfolio_content entry-content">
								<div class="entry">								
									
								<?php $meta_values		=	get_post_custom( $post->ID );
								$post_thumbnail_id	=	get_post_thumbnail_id( $post->ID );
								if ( empty ( $post_thumbnail_id ) ) {
									$args = array(
										'post_parent'		=>	$post->ID,
										'post_type'			=>	'attachment',
										'post_mime_type'	=>	'image',
										'numberposts'		=>	1
									);
									$attachments		=	get_children( $args );
									$post_thumbnail_id	=	key( $attachments );
								}
								$image			=	wp_get_attachment_image_src( $post_thumbnail_id, 'portfolio-thumb' );
								$image_large	=	wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
								$image_alt		=	get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
								$image_desc 	=	get_post($post_thumbnail_id);
								$image_desc		=	$image_desc->post_content;

								if ( '1' == get_option( 'prtfl_postmeta_update' ) ) {
									$post_meta		=	get_post_meta( $post->ID, 'prtfl_information', true);
									$date_compl		=	$post_meta['_prtfl_date_compl'];
									if ( ! empty( $date_compl ) && 'in progress' != $date_compl) {
										$date_compl		= explode( "/", $date_compl );
										$date_compl		= date( get_option( 'date_format' ), strtotime( $date_compl[1] . "-" . $date_compl[0] . '-' . $date_compl[2] ) );
									}
									$link			=	$post_meta['_prtfl_link'];
									$short_descr	=	$post_meta['_prtfl_short_descr'];
								} else {
									$date_compl		=	get_post_meta( $post->ID, '_prtfl_date_compl', true );
									if ( ! empty( $date_compl ) && 'in progress' != $date_compl) {
										$date_compl		=	explode( "/", $date_compl );
										$date_compl		=	date( get_option( 'date_format' ), strtotime( $date_compl[1] . "-" . $date_compl[0] . '-' . $date_compl[2] ) );
									}
									$link			=	get_post_meta( $post->ID, '_prtfl_link', true );
									$short_descr	=	get_post_meta( $post->ID, '_prtfl_short_descr', true );
								} ?>
									<div class="portfolio_thumb">
										<a rel="bookmark" href="<?php echo get_permalink(); ?>"
											title="<?php echo get_the_title(); ?>"> <img
											src="<?php echo $image[0]; ?>"
											width="<?php echo $portfolio_options['prtfl_custom_size_px'][0][0]; ?>"
											height="<?php echo $portfolio_options['prtfl_custom_size_px'][0][1]; ?>"
											alt="<?php echo $image_alt; ?>" /> </a>
									</div>
									<!-- .portfolio_thumb -->
									<div class="portfolio_short_content">
										<div class="item_title">
											<p>
												<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php echo get_the_title(); ?>
												</a>
											</p>
										</div>
										<!-- .item_title -->
										
										
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
									if ( 1 == $portfolio_options['prtfl_shrdescription_additional_field'] ) { ?>
										<p><span class="lable"><?php echo $portfolio_options['prtfl_shrdescription_text_field']; ?></span> <?php echo $short_descr; ?></p>
									<?php } ?>
								</div>
									<!-- .portfolio_short_content -->
								</div>
								<!-- .entry -->
								<div class="entry_footer">
									<div class="read_more">
										<a href="<?php the_permalink(); ?>" rel="bookmark"><?php _e( 'Read more', 'portfolio' ); ?>
										</a>
									</div>
									<!-- .read_more -->
									
									
								<?php $terms = wp_get_object_terms( $post->ID, 'portfolio_technologies' );
								if ( is_array( $terms ) && 0 < count( $terms ) ) { ?>
									<div class="portfolio_terms">
										<?php echo $portfolio_options['prtfl_technologies_text_field'];
										$count = 0;
										foreach ( $terms as $term ) {
											if ( 0 < $count )
												echo ', ';
											echo '<a href="' . get_term_link( $term->slug, 'portfolio_technologies') . '" title="' . sprintf( __( "View all posts in %s" ), $term->name ) . '" ' . '>' . $term->name . '</a>';
											$count++;
										} ?>
									</div><!-- .portfolio_terms -->
								<?php } ?>
							</div>
								<!-- .entry_footer -->
							</div>
							<!-- .portfolio_content -->
							
							
					<?php endwhile;
				endif; 

				$count_all_albums = $second_query->found_posts;
				wp_reset_query(); 
				$request = $wp_query->request;
				$pages = intval( $count_all_albums / $per_page );
				if ( $count_all_albums % $per_page > 0 )
					$pages += 1;

				$range = 2;

				if ( ! $pages )
					$pages = 1;

				if ( 1 != $pages ) { ?>
					</div>
						<!-- #content -->
						
						<div id="portfolio_pagenation">
							<div class='pagination'>


							<?php
							if ( 2 < $paged && $paged > $range + 1 && $showitems < $pages )
							echo "<a href='" . get_pagenum_link( 1 ) . "'>&laquo;</a>";
							if ( 1 < $paged && $showitems < $pages )
							echo "<a href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo;</a>";

							for ( $i = 1; $i <= $pages; $i++ ) {
								if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
									echo ( $paged == $i ) ? "<span class='current'>" . $i . "</span>":"<a href='" . get_pagenum_link( $i ) . "' class='inactive' >" . $i . "</a>";
								}
							}
							if ( $paged < $pages && $showitems < $pages )
							echo "<a href='" . get_pagenum_link( $paged + 1 ) . "'>&rsaquo;</a>";
							if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages )
							echo "<a href='" . get_pagenum_link( $pages ) . "'>&raquo;</a>"; ?>
								<div class='clear'></div>
							</div>
							<!-- .pagination -->
						</div>
						<!-- #portfolio_pagenation -->
						
						
				<?php } else { ?>
					</div>
					<!-- #content -->
					
					
				<?php } 
			 ?>
		</div>
				<!-- #container -->
			</div>
			<!-- .content-area -->
		</div>
	</div>
	</div>
</section>
<div class="quote-block">
	<div class="holder">
		<blockquote class="quote">
			<q>“You see things with crisp, clear eyes and have enabled us to
				enter a new realm of professionalism. You have gone above and beyond
				to help us help others.”</q> <cite> Cheryl A. Trzcinski, CEO
				Master's Manna</cite>
		</blockquote>
		<div class="buttons-holder">
			<a href="http://www.mindtrustlabs.com/contact/"
				class="btn btn-default btn-contact">Contact Us</a>
		</div>
		<ul class="social-links">
			<li><a href="https://www.facebook.com/mindtrustlabs"><span
					class="icon icon-facebook"></span> </a></li>
			<li><a href="https://twitter.com/mindtrustlabs"><span
					class="icon icon-twitter"></span> </a></li>
			<li><a href="https://www.linkedin.com/company/mindtrust-labs"><span
					class="icon icon-linkedin"></span> </a></li>
			<li><a href="#"><span class="icon icon-rss"></span> </a></li>
		</ul>
	</div>
</div>
<div class="subscribe-block">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-push-1">
				<h3>Get insights and protips sent to your inbox</h3>
				<form action="#" class="subscribe-form">
					<fieldset>
						<div class="form-group">
							<input type="email" class="form-control"
								placeholder="Your email address...">
							<button type="submit" class="btn btn-default btn-subscribe">subscribe</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
</main>

	
<?php get_footer(); ?>