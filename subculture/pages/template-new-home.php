<?php

/*
 * Template Name: New Home Page
 */
theme_wrapper_class ( 'home' );

get_header ();
?>


<div class="carousel alt">
	<div class="mask">
		<div class="slideset">
			<?php
			$bannerSliderCount = count ( get_field ( 'banner_images' ) );
			if (have_rows ( 'banner_images' )) :
				while ( have_rows ( 'banner_images' ) ) :
					the_row ();
					?>
					<div class="slide">
				<div class="img-bg" style="background-image: url(<?php the_sub_field('banner_image')?>);"></div>
			</div>
					<?php
				endwhile
				;
			else :
				echo "No Slider Assigned";
			endif;
			?>
		</div>
	</div>
	<?php if( $bannerSliderCount > 1 ){ ?>
	<div class="btn-holder">
		<div class="btn-frame">
			<a class="btn-prev" href="#">Prev</a> <a class="btn-next" href="#">Next</a>
		</div>
	</div>
	<?php }?>
	<a href="#main-container" class="link-down"></a>
</div>

<div class="main-container" id="main-container">
	<div class="headline">
		<div class="container">
			<?php the_field('main_content');?>
		</div>
	</div>

	<section class="container preview-boxes alt">
		<div class="row">
		<?php
		if (have_rows ( 'bottom_boxes' )) :
			while ( have_rows ( 'bottom_boxes' ) ) : the_row ();
				$image = get_sub_field ( 'image' );
				?>
			<article class="box col-sm-4">
				<div class="box-holder">
					<?php if (get_sub_field('title')) {?>
						<h2><?php the_sub_field('title');?></h2>
					<?php }?>
					<div class="visual">
					<?php if (get_sub_field('content_link')) {?>
						<a href="<?php the_sub_field('content_link')?>">
							<?php if ( is_array($image) && isset($image ['sizes'] ['home-boxes-374x230']) ) {?>
								<img src="<?php echo $image ['sizes'] ['home-boxes-374x230'];?>" alt="image description" width="376" height="230" />
							<?php }?>
						</a>
					<?php }else{?>
							<?php if ( is_array($image) && isset($image ['sizes'] ['home-boxes-374x230']) ) {?>
								<img src="<?php echo $image ['sizes'] ['home-boxes-374x230'];?>" alt="image description" width="376" height="230" />
							<?php }?>
					<?php }?>
					<?php if (get_sub_field('main_description')) {?>
						<div class="description">
							<span class="name"><?php the_sub_field('main_description')?></span>
							<time datetime="2014-05-25" class="date"><?php the_sub_field('sub_description')?></time>
						</div>
					<?php }?>
					</div>
				</div>
			</article>
		<?php
			endwhile
			;
		else :
			echo "No Bottom content Assigned";
		endif;
		?>
		</div>
	</section>
</div>

<?php get_footer(); ?>