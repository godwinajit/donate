<?php
/* Template Name: Front Page Template */
get_header();
?>
<!-- HERO BANNERS -->
   <main class="mains">
		

<!--  Home Slider Start -->
    <?php 
    $home_page_slider = get_field('home_page_slider'); 

    if($home_page_slider){
      foreach($home_page_slider as $slider){ 
		  if(!$slider['is_video']){
		  ?>
     <div class="home-banner announcements-page">
      <section class="section-intro">
	  <?php
        if($slider['large_image']){
          echo '<div class="bg-stretch">
                        <span data-srcset="'.$slider['mobile_image'].', '.$slider['smallest_image'].' 2x"></span>
                        <span data-srcset="'.$slider['ipad_image'].'" data-media="(min-width: 768px)"></span>
                        <span data-srcset="'.$slider['large_image'].'" data-media="(min-width: 1024px)"></span>
                    </div>';
					} else {
		 echo '<div class="bg-stretch">
                        <span data-srcset="'.get_template_directory_uri().'/images/bg-intro-small.jpg, '.get_template_directory_uri().'images/bg-intro-small-2x.jpg 2x"></span>
                        <span data-srcset="'.get_template_directory_uri().'/images/bg-intro-medium.jpg" data-media="(min-width: 768px)"></span>
                        <span data-srcset="'.get_template_directory_uri().'/images/bg-intro-large.jpg" data-media="(min-width: 1024px)"></span>
                    </div>';
		  }
                 echo '<div class="text-layer">
                        <div class="wrapper container-fluid">
                            <div class="row start-sm middle-xs">
                                <div class="col-xs-9 col-sm-6 col-sm-offset-1 col-md-6 col-lg-8">
                  <div class="text-box">
                   <h1>'.$slider['title'].'</h1>
                   '.$slider['description'].'
                   <a class="btn btn-primary" href="'.$slider['button_url'].'" title="Learn More">'.$slider['button_text'].'</a> </div>
                 </div>
                </div>';
					
      ?>
</section>
</div>
	  <?php
	  }else{?>
	  <section class="hero-video">
<?php
if($slider['large_image']){
          echo '<div class="bg-stretch">
                        <span data-srcset="'.$slider['mobile_image'].', '.$slider['smallest_image'].' 2x"></span>
                        <span data-srcset="'.$slider['ipad_image'].'" data-media="(min-width: 768px)"></span>
                        <span data-srcset="'.$slider['large_image'].'" data-media="(min-width: 1024px)"></span>
                    </div>';
					} else {
		 echo '<div class="bg-stretch">
                        <span data-srcset="'.get_template_directory_uri().'/images/bg-intro-small.jpg, '.get_template_directory_uri().'images/bg-intro-small-2x.jpg 2x"></span>
                        <span data-srcset="'.get_template_directory_uri().'/images/bg-intro-medium.jpg" data-media="(min-width: 768px)"></span>
                        <span data-srcset="'.get_template_directory_uri().'/images/bg-intro-large.jpg" data-media="(min-width: 1024px)"></span>
                    </div>';
		  }
	  ?>
	<div class="hero-video_frame">
      <div class="wrapper">
        <div class="row center-xs">
          <div class="col-xs-12 col-md-10">
            <div class="hero-video_title">
              <h1><?php echo $slider['title'];?></h1>
            </div>
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-10 col-sm-8 col-md-6">
            <div class="hero-video_button">
              <a href="<?php echo $slider['button_url'];?>" class="open-lightbox fancybox.iframe">
                <img src="./wp-content/themes/globallymealliance/temp/video01.jpg" srcset="./wp-content/themes/globallymealliance/temp/video01-2x.jpg 2x" alt="video description">
                <span class="icon"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
	  </section>
	  <?php }
    }
    }
   ?>
<!-- Announcements Section Start-->
<section class="section-announcements posts-panel">
  <div class="main">
      <div class="heading">
        <h2><?php the_field('announcements_section_title');?></h2>
        <?php the_field('announcements_section_description');?>
      </div>
      <ul class="posts-grid">
      <?php
      if( have_rows('announcements_section_content') ):
        while ( have_rows('announcements_section_content') ) : the_row();
		  ?>
          <li class="">
            <a href="<?php echo esc_url( get_sub_field('announcements_link') ); ?>">
              <span class="pic">
              <?php 
				$announcementImageId = get_sub_field('announcements_image');
				$announcementImage = wp_get_attachment_image_src( $announcementImageId , 'grantees-thumb' );
			  ?>
                <img src="<?php echo $announcementImage[0];?>" alt="<?php echo get_sub_field('announcements_content');?>">
              </span>
              <span class="descript">
                <span class="category"><?php echo get_sub_field('announcements_category')?></span>
                <strong class="title" title="<?php echo get_sub_field('announcements_title')?>"><?php echo get_sub_field('announcements_title');?></strong>
              </span>
            </a>
          </li>
        <?php
        endwhile;
      endif;
      ?>
      </ul>
  </div>
</section>
<!-- Announcements Section End-->
                
                <!-- Get Involved -->
                <?php 
                  $get_involved_title = get_field('get_involved_title');
                  $get_involved_desc = get_field('get_involved_desc');
                  $donate_icon = get_field('donate_icon');
                  $blog_icon = get_field('blog_icon');
                  $blog_icon = 'icon-blog'; // TODO this is temporarily hardcoded, must come from the backend admin custom field
                  $icon_donate_text = get_field('icon_donate_text');
                  $icon_donate_link = get_field('icon_donate_link');
                  $doctors_icon = get_field('doctors_icon');
                  $icon_doctors_text = get_field('icon_doctors_text');
                  $icon_doctors_link = get_field('icon_doctors_link');
                  $news_icon = get_field('news_icon');
                  $icon_news_text = get_field('icon_news_text');
                  $icon_news_link = get_field('icon_news_link');
                  $research_icon = get_field('research_icon');
                  $icon_research_text = get_field('icon_research_text');
                  $icon_research_link = get_field('icon_research_link');
                  $participate_icon = get_field('participate_icon');
                  $icon_participate_text = get_field('icon_participate_text');
                  $icon_participate_link = get_field('icon_participate_link');
                  $education_icon = get_field('education_icon');
                  $icon_education_text = get_field('icon_education_text');
                  $icon_education_link = get_field('icon_education_link');

                ?>
                <section class="section-involved">
                    <div class="wrapper container-fluid">
                        <div class="row center-xs">
                            <div class="col-xs-10">
                                <h2><?php echo $get_involved_title; ?></h2>
                                <h3><?php echo $get_involved_desc; ?></h3>
                            </div>
                            <div class="col-xs-12 col-md-11">
                                <div class="involve-options">
                                    <div class="row center-xs between-md">
                                        <div class="col-xs-3 col-md">
                                            <a href='<?php echo $icon_donate_link; ?>' title="<?php echo $icon_donate_text; ?>" class="involve-options-item">
                                                <span class='icon <?php echo $donate_icon; ?>'></span>
                                                <span><?php echo $icon_donate_text; ?></span>
                                            </a>
                                        </div>
                                        <div class="col-xs-4 col-md">
                                            <a href='<?php echo $icon_doctors_link; ?>' title="<?php echo $icon_doctors_text; ?>" class="involve-options-item">
                                                <span class='icon <?php echo $blog_icon; ?>'></span>
                                                <span><?php echo $icon_doctors_text; ?></span>
                                            </a>
                                        </div>
                                        <div class="col-xs-3 col-md">
                                            <a href='<?php echo $icon_news_link; ?>' title="<?php echo $icon_news_text; ?>" class="involve-options-item">
                                                <span class='icon <?php echo $news_icon; ?>'></span>
                                                <span><?php echo $icon_news_text; ?></span>
                                            </a>
                                        </div>
                                        <div class="col-xs-3 col-md">
                                            <a href='<?php echo $icon_research_link; ?>' title="<?php echo $icon_research_text; ?>" ' class="involve-options-item">
                                                <span class='icon <?php echo $research_icon; ?>'></span>
                                                <span><?php echo $icon_research_text; ?></span>
                                            </a>
                                        </div>
                                        <div class="col-xs-4 col-md">
                                            <a href='<?php echo $icon_participate_link; ?>' title="<?php echo $icon_participate_text; ?>" ' class="involve-options-item">
                                                <span class='icon <?php echo $participate_icon; ?>'></span>
                                                <span><?php echo $icon_participate_text; ?></span>
                                            </a>
                                        </div>
                                        <div class="col-xs-3 col-md">
                                            <a href='<?php echo $icon_education_link; ?>' title="<?php echo $icon_education_text; ?>" ' class="involve-options-item">
                                                <span class='icon <?php echo $education_icon; ?>'></span>
                                                <span><?php echo $icon_education_text; ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                

                <!-- Section News -->
                 <section class="section-news">
                    <div class="wrapper container-fluid">
                        <div class="row center-xs">
                            <div class="col-xs-10 col-md-8 col-lg-7">
                                <h2><?php the_field('news_section_title');?></h2>
                            </div>
                        </div>
                    </div>

                    <!-- News Block -->
                    <div class="news-items">
                        <div class="wrapper">
                            <div class="row">
                                <?php
                                if( have_rows('news_section_content') ):
                                    while ( have_rows('news_section_content') ) : the_row();
                                ?>
                                <div class="item col-xs-6 col-md-3">
                                   <div class="pic" style="background-image: url('<?php the_sub_field('news_image'); ?>');"></div>
                                   <strong class="category">
                                       <?php if( get_sub_field('news_category_url') != '' ) {?>
                                       <a href="<?php the_sub_field('news_category_url'); ?>"><?php the_sub_field('news_category'); ?></a>
                                       <?php } else {?>
                                           <?php the_sub_field('news_category'); ?>
                                       <?php }?>
                                   </strong>
                                   <h3>
                                       <?php if( get_sub_field('news_link') != '' ) {?>
                                       <a href="<?php the_sub_field('news_link'); ?>"><?php the_sub_field('news_title'); ?></a>
                                       <?php } else {?>
                                           <?php the_sub_field('news_title'); ?>
                                       <?php }?>
                                   </h3>
                                </div>
                                <?php
                                    endwhile;
                                endif;
                                ?>
                            </div>


                            <!-- Social Block -->
                              <?php
                                $like_us_on_facebook_title = get_field('like_us_on_facebook_title');
                                $like_us_on_facebook_link = get_field('like_us_on_facebook_link');
                                $twitter_title = get_field('twitter_title');
                                $twitter_button_link = get_field('twitter_button_link');
                                $watch_video_title = get_field('watch_video_title');
                                $video_link = get_field('video_link');
                                $instagram_title = get_field('instagram_title');
                                $instagram_link = get_field('instagram_link');
                             ?>
                            <div class="social-block">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <a href="<?php echo $video_link; ?>" title="<?php echo $watch_video_title; ?>" class="social-box social-box-youtube">
                                            <span class="social-holder">
                                                <span class="icon icon-play-circle"></span>
                                                <strong class="title md-visible"><?php echo  $watch_video_title; ?></strong>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="<?php echo $like_us_on_facebook_link; ?>" title="<?php echo $like_us_on_facebook_title; ?>" target="_blank" rel="nofollow" class="social-box social-box-facebook">
                                            <span class="social-holder">
                                                <span class="icon icon-facebook-square"></span>
                                                <strong class="title md-visible"><?php echo $like_us_on_facebook_title; ?> </strong>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="<?php echo $twitter_button_link; ?>" title="<?php echo $twitter_title; ?>" target="_blank" rel="nofollow" class="social-box social-box-twitter">
                                            <span class="social-holder">
                                                <span class="icon icon-twitter"></span>
                                                <strong class="title md-visible"><?php echo $twitter_title; ?></strong>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="<?php echo $instagram_link; ?>"  title="<?php echo $instagram_title; ?>" target="_blank" rel="nofollow" class="social-box social-box-instagram">
                                            <span class="social-holder">
                                                <span class="icon icon-instagram"></span>
                                                <strong class="title md-visible"><?php echo $instagram_title; ?></strong>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                  <!-- Subscribe CTA -->
                  <?php get_template_part( 'newsletter', 'form' ); ?>
</main>
<?php get_footer(); ?>
