<?php

/*
Template Name: About Us New Template
*/

theme_wrapper_class('about-us-page');

get_header(); ?>

<?php if (have_posts()) : the_post(); ?>

<?php

$image = get_field('header_image', get_queried_object_id());
if (!$image) {
    $image = get_bloginfo('template_url') . '/images/img-12.jpg';
} else {
    $image = wp_get_attachment_image_src($image, '1925px')[0];
}

$subtitle = get_field('sub_title');
$subtitle_h2 = get_field('sub_title_h2');
$title_description = get_field('title_description');
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
            <div class="container">
                <div class="row content-image">
                    <div class="col-md-6 col-sm-12 image">
					<?php
						$image1 = get_field('image_one');
						$image1 = wp_get_attachment_image_src($image1, 'about-image-gallery-557x364')[0];
					?>
                        <img src="<?php echo $image1;?>" alt="picture">
                    </div>
                    <div class="col-md-6 col-sm-12 description">
                        <?php echo get_field('content_one');?>
                    </div>
                </div>
                <div class="row content-image">
                    <div class="col-md-6 col-sm-12 image">
					<?php
						$image2 = get_field('image_two');
						$image2 = wp_get_attachment_image_src($image2, 'about-image-gallery-557x364')[0];
					?>
                        <img src="<?php echo $image2;?>" alt="picture">
                    </div>
                    <div class="col-md-6 col-sm-12 description">
                        <?php echo get_field('content_two');?>
                    </div>
                </div>
                <div class="row content-image">
                    <div class="col-md-6 col-sm-12 image">
					<?php
						$image3 = get_field('image_three');
						$image3 = wp_get_attachment_image_src($image3, 'about-image-gallery-557x364')[0];
					?>
                        <img src="<?php echo $image3;?>" alt="picture">
                    </div>
                    <div class="col-md-6 col-sm-12 description">
                        <?php echo get_field('content_three');?>
                    </div>
                </div>
            </div>
            <div class="testimonials">
                <div class="container">
                    <h4><?php echo get_field('bottom_content_title');?></h4>
                    <div class="testimonials-row">
                        <?php
						// check if the repeater field has rows of data
						if( have_rows('bottom_content_images') ):
						 	// loop through the rows of data
						    while ( have_rows('bottom_content_images') ) : the_row();
							if (get_sub_field('bottom_content_link')) {
								echo '<div class="testimonials-item">
			                            <a href="'.get_sub_field('bottom_content_link').'" target="_blank"><img src="'.get_sub_field('bottom_content_image').'"></a>
						            </div>';
							}else{
							echo '<div class="testimonials-item">
			                            <img src="'.get_sub_field('bottom_content_image').'">
						            </div>';
							}
						    endwhile;
						else :
						    // no rows found
						endif;
						?>
                    </div>
                </div>
                <div class="testimonials-slider">
				<?php
						// check if the repeater field has rows of data
						if( have_rows('bottom_slider') ):
						 	// loop through the rows of data
						    while ( have_rows('bottom_slider') ) : the_row();
								echo '<div class="testimonial-slide">
											<span class="quote">'.get_sub_field('bottom_slider_content').'</span>
					                        <span class="quote-author">'.get_sub_field('bottom_slider_title').'</span>
										    <span class="prof">'.get_sub_field('bottom_slider_sub_title').'</span>
				                    </div>';
						    endwhile;
						else :
						    // no rows found
						endif;
						?>
                </div>
            </div>
        </div>


<?php endif; ?>

<?php get_footer(); ?>