<?php

/*
 * Template Name: Private Events New Template
 */
theme_wrapper_class ( 'about-us-page event-d' );

get_header ();
?>

<?php if (have_posts()) : the_post(); ?>

<?php

	$image = get_field('header_image', get_queried_object_id());
	if (!$image) {
		$image = get_bloginfo('template_url') . '/images/img-12.jpg';
	} else {
		$image = wp_get_attachment_image_src($image, '1925px')[0];
	}
	
	$subtitle = get_field ( 'sub_title' );
	$subtitle_h2 = get_field ( 'sub_title_h2' );
	$title_description = get_field ( 'title_description' );
	?>
<div class="intro intro-alt">
	<div class="img-w" style="background-image: url('<?php echo $image;?>')"></div>

	<div class="title-holder top-banner-text">
		<div class="title-frame row">
			<div class="col-md-10 col-sm-12">
				<div class="breadcrumbs-frame">
					<nav class="breadcrumbs">
						<ul>
							<li><strong><?php the_title();?></strong></li>
						</ul>
					</nav>
				</div>
				<span class="subtitle"><?php echo $subtitle;?></span>
				<h2><?php echo $subtitle_h2;?></h2>
				<span class="title-description"><?php echo $title_description;?></span>
			</div>
		</div>
	</div>
</div>

<div class="main-holder">
	<div class="content-wrapper container">
		<div class="slider-holder">
			<div class="photo-gallery">
						<?php
	// check if the repeater field has rows of data
	if (have_rows ( 'top_slider' )) :
		// loop through the rows of data
		while ( have_rows ( 'top_slider' ) ) :
			the_row ();
			$image = get_sub_field ( 'top_slide_image' );
			$image = wp_get_attachment_image_src($image, 'package-floorplan-thumbs-454x211')[0];
			if ($image) {
				echo '<div class="slider-item">
						<a rel="lightbox[gallery1]" href="' . get_sub_field ( 'top_slide_large_image' ) . '">
							<img src="' . $image . '" alt="slider photo">
						</a>
					</div>';
			}
		endwhile
		;
	else :
		// no rows found
	endif;
	?>
                    </div>
		</div>
	</div>
</div>

<div class="floorplans">
	<div class="container">
		<h4><?php echo get_field('main_content_title');?></h4>
		<div class="row">
			<div class="col-md-6 col-sm-12">
                        <?php echo get_field('main_content_text');?>
                    </div>
			<div class="col-md-6 col-sm-12">
				<div class="floor-slider">
						<?php
	// check if the repeater field has rows of data
	if (have_rows ( 'main_content_slides' )) :
		// loop through the rows of data
		while ( have_rows ( 'main_content_slides' ) ) :
			the_row ();
			echo '<div class="floor-slider-item">
                                <img src="' . get_sub_field ( 'main_content_slide_image' ) . '" alt="">
                                <span>' . get_sub_field ( 'main_content_slide_text' ) . '</span>
                            </div>';
		endwhile
		;
	else :
		// no rows found
	endif;
	?>
                        </div>
			</div>
		</div>
	</div>
</div>

<div class="tech-specifications">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-12 picture">
			<?php
			$image3 = get_field ( 'main_content_2_image' );
			$image3 = wp_get_attachment_image_src($image3, 'about-image-gallery-557x364')[0];
			?>
				<img src="<?php echo $image3;?>" alt="">
			</div>
			<div class="col-md-6 col-sm-12 tech-list">
                        <?php echo get_field('main_content_2_content');?>
                        <?php if (get_field('main_content_2_link')){?>
							<a href="<?php echo get_field('main_content_2_link');?>"><span><?php echo get_field('main_content_2_link_text');?></span></a>
						<?php }?>
                    </div>
		</div>
	</div>
</div>
<div class="banner-with-text" style="background-image: url('<?php echo get_field('main_content_3_background');?>')">
	<div class="container banner-description">
                <?php echo get_field('main_content_3_description');?>
            </div>
</div>

<div class="testimonials">
	<div class="container">
		<h4><?php echo get_field('bottom_content_title');?></h4>
                        <?php
	// check if the repeater field has rows of data
	if (have_rows ( 'bottom_content_images' )) :
		// loop through the rows of data ?>
							<div class="testimonials-row">
							<?php
		while ( have_rows ( 'bottom_content_images' ) ) :
			the_row ();
			echo '<div class="testimonials-item">
			                            <img src="' . get_sub_field ( 'bottom_content_image' ) . '">
						            </div>';
		endwhile
		;
		?>
							</div>
							<?php
	else :
		// no rows found
	endif;
	?>
                </div>
	<div class="testimonials-slider">
                <?php
	// check if the repeater field has rows of data
	if (have_rows ( 'bottom_slider' )) :
		// loop through the rows of data
		while ( have_rows ( 'bottom_slider' ) ) :
			the_row ();
			echo '<div class="testimonial-slide">
											<div class="quote">' . get_sub_field ( 'bottom_slider_content' ) . '</div>
					                        <span class="quote-author">' . get_sub_field ( 'bottom_slider_title' ) . '</span>
										    <span class="prof">' . get_sub_field ( 'bottom_slider_sub_title' ) . '</span>
				                    </div>';
		endwhile
		;
	else :
		// no rows found
	endif;
	?>
            </div>
</div>
<div class="contact" style="padding-bottom: 0px !important;">
	<div class="container">
		<h4><?php echo get_field('bottom_content_2_title');?></h4>
                                        <?php echo get_field('bottom_content_2');?>
                </div>
</div>


<?php endif; ?>

<?php get_footer(); ?>