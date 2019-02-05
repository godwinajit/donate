<?php

/* Template Name: Home Page */

get_header();

?>
    <!--==========================
      Intro Section
    ============================-->
	<section id="home-intro">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5">
					<?php the_content();?>
				</div>
				<div class="col-lg-7 col-md-7 hero-right-section"
				style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'full');?>');"></div>
			</div>
		</div>
	</section><!--==========================
     Home Section 2
    ============================-->
    <section id="home-section-2" class="default-padding home-section-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 text-center">
			<?php the_field('home_page_content_two_text');?>
          </div>
        </div>
      </div>
    </section><!--==========================
      Differenece  Section
    ============================-->
    <section id="difference-section" class=" left-title">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3">
            <div class="section-header">
              <?php the_field('home_page_content_three_text');?>
            </div>
          </div>
          <div class="col-lg-9 col-md-9">
		  <?php
			if( have_rows('home_page_content_three_repeater') ): ?>
				<ul class="faq-list">
			    <?php $collapsedCount = 1; while ( have_rows('home_page_content_three_repeater') ) : the_row();
					if ( $collapsedCount == 1 ) $collapsedContent = 'active'; else $collapsedContent = '';
					echo '<li class="faq-item '.get_sub_field('accordion_icon'). ' ' .$collapsedContent .'">';
					echo '<a href="#" class="faq-item-opener">'.get_sub_field('accordion_title').'<i class="icon icon-plus"></i><i class="icon icon-close"></i></a>';
					echo '<div class="faq-item-content">'.get_sub_field('accordion_content').'</div>';
					echo '</li>';
					$collapsedCount++;
				endwhile; ?>
	            </ul>
			<?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
      Product Section
    ============================-->
    <section id="product-section" class="left-title default-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-3">
            <div class="section-header">
              <img alt="santa" src="<?php echo get_template_directory_uri(); ?>/img/santa_home_symbol-logo.svg">
              <h2><?php the_field('home_page_content_four_title');?></h2>
	              <?php the_field('home_page_content_four_text');?>
            </div>
          </div>
          <div class="col-lg-9 col-md-9 right-product-section">
            <div class="product-area">
                <?php
                if( have_rows('home_page_content_four_repeater') ): ?>
                  <?php while ( have_rows('home_page_content_four_repeater') ) : the_row(); 
                    $content_four_image_id = get_sub_field('section_image');
                    $content_four_image_size = "santa-main-thumb-476-234";
                    $content_four_image = wp_get_attachment_image_src( $content_four_image_id, $content_four_image_size );
                    ?>
                        <div class="two-col-pro" style="background-image: url('<?php echo $content_four_image[0];?>');">
                      <a href="<?php echo get_sub_field('section_url');?>"><p><?php echo get_sub_field('section_title');?></p></a>
                          </div>
                  <?php endwhile; ?>
                <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
      Contact Form Section
    ============================-->

	<!--
    <section id="form-section" class="">
      <div class="container">
        <div class="row">
			<?php the_field('home_page_content_five_text');?>
        </div>
      </div>
    </section>
	-->

    <!--==========================
      News And Slider Section
    ============================-->
    <section class="news-section bg-darkblue mt-60">
      <div class="container">
        <div class="section-header text-center">
          <h2><?php the_field('news_section_title');?></h2>
        </div>
      </div>
      <div class="news-area">
        <div class="container">
          <div class="row mobile-slider">
  		<?php 
  			$latestNewsPosts = get_field('news_section_select');
  			if( $latestNewsPosts ): ?>
  				<?php foreach( $latestNewsPosts as $post):?>
  				<?php setup_postdata($post); 
  				?>
  				<div class="col-lg-4 col-md-4">
	            <div class="section-cat">
                <a href="<?php the_permalink(); ?>">
		              <div class="section-cat-img" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'santa-main-thumb-349-180'); ?>');"></div>
                  <div class="news-det">
			              <h3><?php the_title(); ?></h3>
						        <?php echo wp_trim_words( get_the_content(), 30, '...' ); ?>
					          <span class="news-link">page link</span>
                  </div>
                </a>
	            </div>
  				</div>
  			    <?php endforeach; ?>
  				<?php wp_reset_postdata();?>
  			<?php endif; ?> 
          </div>
        </div>
      </div>
      <div class="container">
          <div class="testimonial_slider">
            <div class="slides">

		  <?php
			if( have_rows('home_page_slider_section_repeater') ): ?>
				<?php while ( have_rows('home_page_slider_section_repeater') ) : the_row(); 
					$content_slider_image_id = get_sub_field('slider_image');
					$content_slider_image_size = "santa-main-thumb-350-180";
					$content_slider_image = wp_get_attachment_image_src( $content_slider_image_id, $content_slider_image_size );
					?>
					<div class="slider-item">
            <div class="slider-frame">
  						<!-- <div class="slide-image" style="background-image: url('<?php echo $content_slider_image[0];?>');"></div> -->
              <div class="testimonial-descr"><?php echo get_sub_field('slider_description');?></div>
              <div class="testimonial-details">
                 <p><?php echo get_sub_field('slider_title');?></p>
              </div>
            </div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
            </div>
          <div class="pagination-holder">
              <!-- pagination generated here -->
          </div>
        </div>
      </div>
    </section>


    <!--==========================
      Category Section
    ============================-->
    <section id="cateegory-section">
      <div class="container">
        <div class="row">

		  <?php
			if( have_rows('purpose_section_repeater') ): ?>
				<?php while ( have_rows('purpose_section_repeater') ) : the_row(); 
					$content_purpose_image_id = get_sub_field('purpose_image');
					$content_purpose_image_size = "santa-main-thumb-350-208";
					$content_purpose_image = wp_get_attachment_image_src( $content_purpose_image_id, $content_purpose_image_size );
					?>
					<div class="col-lg-4 col-md-4">
						<div class="section-cat-3">
              <a href="<?php echo get_sub_field('purpose_url');?>">
                <div class="section-cat-img" style="background-image: url('<?php echo $content_purpose_image[0];?>');">
                    <p ><?php echo get_sub_field('purpose_title');?></p>
                </div>
                <div class="section-details">
                  <ul>
                  <?php if( have_rows('purposes_repeater') ): ?>
                    <?php while ( have_rows('purposes_repeater') ) : the_row(); ?>
                      <li><?php echo get_sub_field('purposes');?></li>
                    <?php endwhile; ?>
                  <?php endif; ?>
                   </ul>
                   <span class="more">Learn More</span>
                </div>
              </a>
						</div>
				  </div>

				<?php endwhile; ?>
			<?php endif; ?>

        </div>
      </div>
    </section>

    <!--==========================
        MAP SECTION
  ============================-->
    <section id="home-map">
      <div class="map-container">
        <iframe allowfullscreen frameborder="0" height="563" src="<?php the_field('map_embed'); ?>" style="border:0" width="1440"></iframe>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 map-info">
            <?php the_field('map_content'); ?>
          </div>
        </div>
      </div>
    </section>


<?php get_footer();
