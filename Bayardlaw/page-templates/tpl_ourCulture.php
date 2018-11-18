<?php 
/*

  Template Name: Our Culture Page Template

 */

get_header('menubanner');
?>
	
<main id="main" role="main">
	<section class="section content-section section-intro">
		<div class="container container-alt">
			<div class="box-grid">
				<div class="box box-copy">
					<h2><?php the_title();?></h2>
					<?php the_content();?>
				</div><div class="box box-img">
					<div class="bg-stretch-retina">
						<span data-srcset="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumb153_153' )[0].', '.wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumb306_306' )[0].' 2x';?>"></span>
						<span data-srcset="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumb306_306' )[0].', '.wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumb612_612' )[0].' 2x';?>" data-media="(min-width: 768px)"></span>
					</div>
				</div>
				
				<div class="tiles">
					<div class="tile tile-t-1">
						<a title="<?php the_field('title1_top');?>" rel="lightbox[gallery1]" href="<?php echo wp_get_attachment_image_src( get_field('image1_top'), 'thumb612_1250' )[0]?>" class="lightbox">
						   <div class="bg-stretch-retina">
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image1_top'), 'thumb153_313' )[0] .', '. wp_get_attachment_image_src( get_field('image1_top'), 'thumb306_625' )[0].' 2x'	?>"></span>
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image1_top'), 'thumb306_625' )[0] .', '. wp_get_attachment_image_src( get_field('image1_top'), 'thumb612_1250' )[0].' 2x'?>" data-media="(min-width: 768px)"></span>
                            </div>
								<?php if (get_field('description1_top')){ ?>
							<div class="description">
								<h3>
								<?php the_field('description1_top'); ?>
								</h3>
							</div>
							<?php } ?>
						</a>
					</div>

					<div class="tile tile-t-2">
						<a title="<?php the_field('title2_top');?>" rel="lightbox[gallery1]" href="<?php echo wp_get_attachment_image_src( get_field('image2_top'), 'thumb612_1250' )[0]?>" class="lightbox">
						   <div class="bg-stretch-retina">
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image2_top'), 'thumb153_313' )[0] .', '. wp_get_attachment_image_src( get_field('image2_top'), 'thumb306_625' )[0].' 2x'	?>"></span>
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image2_top'), 'thumb306_625' )[0] .', '. wp_get_attachment_image_src( get_field('image2_top'), 'thumb612_1250' )[0].' 2x'?>" data-media="(min-width: 768px)"></span>
                            </div>
								<?php if (get_field('description2_top')){ ?>
							<div class="description">
								<h3>
								<?php the_field('description2_top'); ?>
								</h3>
							</div>
								<?php } ?>
						</a>
					</div>

					<div class="tile tile-w">
						<a title="<?php the_field('title3_top');?>" rel="lightbox[gallery1]" href="<?php echo wp_get_attachment_image_src( get_field('image3_top'), 'thumb1250_612' )[0]?>" class="lightbox">
						   <div class="bg-stretch-retina">
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image3_top'), 'thumb313_153' )[0] .', '. wp_get_attachment_image_src( get_field('image3_top'), 'thumb625_306' )[0].' 2x'	?>"></span>
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image3_top'), 'thumb625_306' )[0] .', '. wp_get_attachment_image_src( get_field('image3_top'), 'thumb1250_612' )[0].' 2x'?>" data-media="(min-width: 768px)"></span>
                            </div>
								<?php if (get_field('description3_top')){ ?>
							<div class="description">
								<h3>
								<?php the_field('description3_top'); ?>
								</h3>
							</div>
								<?php } ?>
						</a>
					</div>

					<div class="tile tile-sm-1">
						<a title="<?php the_field('title4_top');?>" rel="lightbox[gallery1]" href="<?php echo wp_get_attachment_image_src( get_field('image4_top'), 'thumb612_612' )[0]?>" class="lightbox">
						   <div class="bg-stretch-retina">
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image4_top'), 'thumb153_153' )[0] .', '. wp_get_attachment_image_src( get_field('image4_top'), 'thumb306_306' )[0].' 2x'	?>"></span>
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image4_top'), 'thumb306_306' )[0] .', '. wp_get_attachment_image_src( get_field('image4_top'), 'thumb612_612' )[0].' 2x'?>" data-media="(min-width: 768px)"></span>
                            </div>
								<?php if (get_field('description4_top')){ ?>
							<div class="description">
								<h3>
								<?php the_field('description4_top'); ?>
								</h3>
							</div>
								<?php } ?>
						</a>
					</div>
					<div class="tile tile-sm-2">
						<a title="<?php the_field('title5_top');?>" rel="lightbox[gallery1]" href="<?php echo wp_get_attachment_image_src( get_field('image5_top'), 'thumb612_612' )[0]?>" class="lightbox">
						   <div class="bg-stretch-retina">
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image5_top'), 'thumb153_153' )[0] .', '. wp_get_attachment_image_src( get_field('image5_top'), 'thumb306_306' )[0].' 2x'	?>"></span>
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image5_top'), 'thumb306_306' )[0] .', '. wp_get_attachment_image_src( get_field('image5_top'), 'thumb612_612' )[0].' 2x'?>" data-media="(min-width: 768px)"></span>
                            </div>
								<?php if (get_field('description5_top')){ ?>
							<div class="description">
								<h3>
								<?php the_field('description5_top'); ?>
								</h3>
							</div>
								<?php } ?>
						</a>
					</div>
				</div>
				
				<div class="tiles">
					<div class="tile tile-w tile-w-alt">
						<a title="<?php the_field('title1_middle');?>" rel="lightbox[gallery1]" href="<?php echo wp_get_attachment_image_src( get_field('image1_middle'), 'thumb1250_612' )[0]?>" class="lightbox">
						   <div class="bg-stretch-retina">
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image1_middle'), 'thumb313_153' )[0] .', '. wp_get_attachment_image_src( get_field('image1_middle'), 'thumb625_306' )[0].' 2x'	?>"></span>
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image1_middle'), 'thumb625_306' )[0] .', '. wp_get_attachment_image_src( get_field('image1_middle'), 'thumb1250_612' )[0].' 2x'?>" data-media="(min-width: 768px)"></span>
                            </div>
								<?php if (get_field('description1_middle')){ ?>
							<div class="description">
								<h3>
								<?php the_field('description1_middle'); ?>
								</h3>
							</div>
								<?php } ?>
						</a>
					</div>
					<div class="tile">
						<a title="<?php the_field('title2_middle');?>" rel="lightbox[gallery1]" href="<?php echo wp_get_attachment_image_src( get_field('image2_middle'), 'thumb612_612' )[0]?>" class="lightbox">
						   <div class="bg-stretch-retina">
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image2_middle'), 'thumb153_153' )[0] .', '. wp_get_attachment_image_src( get_field('image2_middle'), 'thumb306_306' )[0].' 2x'	?>"></span>
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image2_middle'), 'thumb306_306' )[0] .', '. wp_get_attachment_image_src( get_field('image2_middle'), 'thumb612_612' )[0].' 2x'?>" data-media="(min-width: 768px)"></span>
                            </div>
								<?php if (get_field('description2_middle')){ ?>
							<div class="description">
								<h3>
								<?php the_field('description2_middle'); ?>
								</h3>
							</div>
								<?php } ?>
						</a>
					</div>
					<div class="tile">
						<a title="<?php the_field('title3_middle');?>" rel="lightbox[gallery1]" href="<?php echo wp_get_attachment_image_src( get_field('image3_middle'), 'thumb612_612' )[0]?>" class="lightbox">
						   <div class="bg-stretch-retina">
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image3_middle'), 'thumb163_163' )[0] .', '. wp_get_attachment_image_src( get_field('image3_middle'), 'thumb306_306' )[0].' 2x'	?>"></span>
                                <span data-srcset="<?php echo wp_get_attachment_image_src( get_field('image3_middle'), 'thumb306_306' )[0] .', '. wp_get_attachment_image_src( get_field('image3_middle'), 'thumb612_612' )[0].' 2x'?>" data-media="(min-width: 768px)"></span>
                            </div>
								<?php if (get_field('description3_middle')){ ?>
							<div class="description">
								<h3>
								<?php the_field('description3_middle'); ?>
								</h3>
							</div>
								<?php } ?>
						</a>
					</div>
				</div>
				<div class="tiles">
<?php echo do_shortcode( '[ajax_load_more preloaded="true" preloaded_amount="2" theme_repeater="acf-repeater-field.php" repeater="template_2" posts_per_page="2" pause="false" pause_override="true" scroll="false" button_label="Load More" button_loading_label="Loading..." acf="true" acf_field_type="repeater" acf_field_name="image_repeater" container_type="div" css_classes="" transition="fade"]'); ?>
</div>

			</div>
		</div>
	</section>
	<section class="section content-section section-quote">
		<div class="container">
			<blockquote cite="#">
				<p><?php the_field('first_quote'); ?></p>
				<?php if (get_field('first_author')){ ?>
                    <cite><?php the_field('first_author'); ?></cite>
                <?php } ?>
				</blockquote>
		</div>
	</section>
	<section class="section content-section section-social">
		<div class="container container-alt">
			<div class="center-block intro-info-box text-center">
				<div class="heading heading-alt">
					<div class="heading-frame">
						<h2><?php the_field('first_heading'); ?></h2>
						<p><?php the_field('first_para'); ?></p>
						<div class="divider style-dark">
							<div></div>
						</div>
					</div>
				</div>
			</div>
			<div class="items-grid four-cols">
<div class="items-grid four-cols">
<?php echo do_shortcode( '[ajax_load_more preloaded="true" preloaded_amount="4" theme_repeater="acf-repeater-field.php" repeater="template_1" posts_per_page="4" pause="false" pause_override="true" scroll="false" button_label="Load More" button_loading_label="Loading..." acf="true" acf_field_type="repeater" acf_field_name="middle_images" container_type="div" css_classes="" transition="fade"]'); ?>
</div>
			
			</div>
		</div>
	</section>
	<section class="section content-section section-quote">
		<div class="container">
			<blockquote cite="#">
				<p><?php the_field('second_quote'); ?></p>
				<?php if (get_field('second_author')){ ?>
                    <cite><?php the_field('second_author'); ?></cite>
                <?php } ?>
				</blockquote>
		</div>
	</section>
	<section class="section content-section section-social">
		<div class="container container-alt">
			<div class="center-block intro-info-box text-center">
				<div class="heading heading-alt">
					<div class="heading-frame">
						<h2><?php the_field('second_heading'); ?></h2>
						<p><?php the_field('second_para'); ?></p>
						<div class="divider style-dark">
							<div></div>
						</div>
					</div>
				</div>
			</div>
<div class="items-grid four-cols">
<?php echo do_shortcode( '[ajax_load_more preloaded="true" preloaded_amount="4" theme_repeater="acf-repeater-field.php" posts_per_page="4" pause="false" pause_override="true" scroll="false" button_label="Load More" button_loading_label="Loading..." acf="true" acf_field_type="repeater" acf_field_name="bottom_images" container_type="div" css_classes="" transition="fade"]'); ?>
</div>
		</div>
	</section>
	<section class="section content-section section-quote">
		<div class="container">
			<blockquote>
				<p><?php the_field('third_quote'); ?></p>
				<?php if (get_field('third_author')){ ?>
                    <cite><?php the_field('third_author'); ?></cite>
                <?php } ?>
			</blockquote>
		</div>
	</section>
	<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
</main>
<?php get_footer();?>