<?php

$image = get_field('banner_background_image');
$title = get_field('banner_title');
$descr = get_field('banner_description');
$linktitle = get_field('banner_link_title');
$linkh = get_field('banner_link');



?>
<div class="home-hero-section">
  	<div class="hero-text-block">
        <div class="hero-block-holder">
            <h1><?php echo $title; ?></h1>
            <?php echo $descr; ?>
            <a href="<?php echo $linkh; ?>"><?php echo $linktitle; ?></a>
        </div>
    </div>

    <div class="hero-img-holder" style="background-image:url('<?php echo $image['url']; ?>');">
            <!-- <?php echo wp_get_attachment_image($image, 'full') ?> -->
    </div>
  


    

</div>

<div class="prod-category-mobile" style="display: none;">
    <div class="woocommerce columns-4">
	<?php
		if( have_rows('mobile_home_grid_select') ):
		    while ( have_rows('mobile_home_grid_select') ) : the_row();
				$img_id_mobile_section	= get_sub_field('mobile_home_grid_image');
				$img_src_mobile_section = wp_get_attachment_image_src( $img_id_mobile_section, 'homepage-promo-image' )[0];
			?>
				<div class="col-md-6 col-sm-6 box">
				    <div class="category-block">
						<a href="<?php echo the_sub_field('mobile_home_grid_link'); ?>">
			                <strong class="title">
								<a href="<?php echo the_sub_field('mobile_home_grid_link'); ?>">
					                <?php echo the_sub_field('mobile_home_grid_title'); ?>
								</a>
					        </strong>
							<div class="holder">
								<a href="<?php echo the_sub_field('mobile_home_grid_link'); ?>">
							        <img src="<?php echo $img_src_mobile_section;?>" alt="Cooktops" width="535" height="9999" />
								</a>
						    </div>
				        </a>
				    </div>
			    </div>
		    <?php endwhile;
		endif;
	?>
	</div>
</div>
