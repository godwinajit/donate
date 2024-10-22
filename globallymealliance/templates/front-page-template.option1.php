<?php
/* Template Name: Front Page Template */
get_header();
?>
<!-- HERO BANNERS -->
   <main class="mains">
     <div class="home-banner announcements-page">
      <section class="section-intro intro-video">
		

<!--  Home Slider Start -->
    <?php 
    $home_page_slider = get_field('home_page_slider'); 

    if($home_page_slider){
      foreach($home_page_slider as $slider){
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
		  }?>
		  <?php if(!$slider['is_video']){?>
                 <div class="text-layer">
                        <div class="wrapper container-fluid">
                            <div class="row center-xs bottom-xs start-sm middle-sm">
                                <div class="col-xs-10 col-sm-6 col-md-6 col-lg-8 col-sm-offset-1">
                  <div class="text-box">
                   <?php echo $slider['title'];?>
                   <?php echo $slider['description'];?>
				   <?php if($slider['button_text']){?>
					   <?php if($slider['is_video']){?>
							   <a class="btn btn-default open-lightbox fancybox.iframe" title="" href="<?php echo $slider['button_url'];?>" target="_blank" rel="noopener"><?php echo $slider['button_text'];?></a>
					   <?php } else {?>
				               <a class="btn btn-primary" href="<?php echo $slider['button_url'];?>" title="<?php echo $slider['button_text'];?>"><?php echo $slider['button_text'];?></a>
					   <?php } ?>
				   <?php } ?>
				    </div>
                 </div>
                </div>
		<?php } else {?>

      <div class="text-layer video-layer">
        <div class="wrapper ">
          <div class="row center-xs middle-xs">
            <div class="col-xs-12 col-sm-6 col-lg-5">
              <div class="text-box pr-0 center-xs">
                <h1><span style="color: white;">Conquering Lyme Disease Through Research, Education and Awareness</span></h1>
                <p><span style="color: white"> GLA leadership and GLA-funded researchers share insights into living with Lyme and what GLA is doing to conquer Lyme and other tick-borne diseases.</span></p>
                <a id="play-yt-video" class="btn btn-primary" href="#" title="Watch Video">Watch Video</a>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-5">
              <div class="video-placeholder">
                <iframe id="yt-video" width="560" height="315" src="https://www.youtube.com/embed/vJI53PXOpMM?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                <script>
                  jQuery('#play-yt-video').on('click', function(e) {
                    e.preventDefault();

                    $("#yt-video")[0].src += "&autoplay=1";
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>

		<?php }?>					
      <?php }	
    }
   ?>
 
</section>
</div>
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
