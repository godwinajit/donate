<?php
/* Template Name: Donate Form Success Template */
get_header();
?>

    <main class="mains">
      <section>
       <div class="breadcrumbs">
            <div class="wrapper container-fluid">
              <div class="row center-xs">
                <div class="col-xs-10">
                  <ul class="breadcrumbs-nav">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Global Lyme Alliance">Home</a></li>
                    <li>Donate</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
      </section>
      <!-- Section <-->
        <section>
             <div class="wrapper container-fluid">
              <div class="row center-xs">
                <div class="col-xs-10">
                 <h1>Add Donate Thank You Page</h1>
                 <p>Add Donate Form Success Form on this page here</p>
                 </div>
             </div>
          </div>
        </section>

   <!-- Section News -->
                <?php
                  $recent_news_title = get_field('recent_news_title');
                  $recent_news_desc = get_field('recent_news_desc');
                  $recent_news_image_1 = get_field('recent_news_image_1');
                  $recent_news_image_2 = get_field('recent_news_image_2');
                  $recent_news_image_3 = get_field('recent_news_image_3');
                  $recent_news_image_4 = get_field('recent_news_image_4');

                ?>
                 <section class="section-news">
                    <div class="wrapper container-fluid">
                        <div class="row center-xs">
                            <div class="col-xs-10">
                                <h2><?php echo $recent_news_title; ?></h2>
                                <h3><?php echo $recent_news_desc; ?></h3>
                            </div>
                        </div>
                    </div>

                <!-- News Block -->
                    <div class="news-block">
                        <div class="row">
                            <div class="col-xs-6 col-md-4">
                               <?php $select_blog_title = get_field('select_blog_title');
                                  $select_blog = get_field('select_blog'); ?>
                                
                                  <?php 
                                  if( $select_blog ){
                                    $post = $select_blog;
                                    setup_postdata( $post );
                                    $thumbnail_image = get_field('thumbnail_image');
                                  ?>   
                                    <a class="news-box-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <div class="news-box news-box-image">
                                      <div class="bg-stretch" style="background: #fff url('<?php echo $recent_news_image_1; ?>')  50% 50% no-repeat;  background-size: cover;"></div>                                 
                                      </div>
                                    <div class="news-box arrow-top">
                                    <span class="text-holder">
                                        <strong class="subtitle"><?php echo $select_blog_title; ?></strong>
                                        <span class="title"><?php the_title(); ?></span>
                                    </span>
                                    </div>
                                    </a>

                               <?php
                                  }
                                  wp_reset_postdata();
                                ?>

                                <a href="<?php echo get_field('video_link'); ?>" class="news-box news-box-video">
<div class="bg-stretch" style="background: #fff url('<?php echo $recent_news_image_4; ?>')  50% 50% no-repeat; background-size: cover;"></div>
                                    <span class="icon icon-play-circle"></span>
                                </a>
                            </div>




                            <div class="col-xs-6 col-md-4">
                            <?php $select_news_title = get_field('select_news_title');
                            $select_news = get_field('select_news'); ?>
                                
                                  <?php 
                                  if( $select_news ){
                                    $post = $select_news;
                                    setup_postdata( $post );
                                    $thumbnail_image = get_field('thumbnail_image');
                                  ?>                                
                                    <a href="<?php the_permalink(); ?>" class="news-box-link">
                                    <div class="news-box arrow-bottom">
                                      <span class="text-holder">
                                         <strong class="subtitle"><?php echo $select_news_title; ?></strong>
                                         <span class="title"><?php the_title(); ?></span>
                                      </span>
                                    </div>
                                    <div class="news-box news-box-high news-box-image">
                                          <div class="bg-stretch" style="background: #fff url('<?php echo $recent_news_image_3 ?>')  50% 50% no-repeat; background-size: cover;"></div>
                                   </div>
                                  </a>
                                 
                                  <?php
                                  }
                                  wp_reset_postdata();
                                ?>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                    <?php $select_news_title_2 = get_field('select_news_title_2');
                                    $select_news_2 = get_field('select_news_2'); ?>
                                            <?php 
                                        if( $select_news_2 ){
                                          $post = $select_news_2;
                                          setup_postdata( $post );
                                          $thumbnail_image = get_field('thumbnail_image');
 
                                       ?>
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="news-box-link">
                                              <div class="news-box news-box-short news-box-image">
                                                  <div class="bg-stretch" style="background: #fff url('<?php echo $recent_news_image_2; ?>') 50% 50% no-repeat; background-size: cover;">
                                                    
                                                  </div>
                                              </div>
                                               <div class="news-box news-box-short arrow-top">
                                                  <span class="text-holder">
                                                       <strong class="subtitle"><?php echo $select_news_title_2; ?></strong>
                                                       <span class="title"><?php the_title(); ?></span>
                                                  </span>
                                              </div>
                                         

                                              </a>
                                          
                                            <?php
                                          }
                                          wp_reset_postdata();
                                        ?>

                                  <!-- twitter box -->
                                <?php
                                                if(is_active_sidebar('twitter-home')){
                                                  dynamic_sidebar('twitter-home');
                                                }
                                              ?>
                            </div>
                        </div>


                        <!-- Social Block -->
                          <?php
                            $like_us_on_facebook_title = get_field('like_us_on_facebook_title');
                            $like_us_on_facebook_link = get_field('like_us_on_facebook_link');
                            $twitter_title = get_field('twitter_title');
                            $twitter_button_link = get_field('twitter_button_link');
                            $watch_video_title = get_field('watch_video_title');
                            $video_link = get_field('video_link');
                         ?>
                        <div class="social-block">
                            <div class="row">
                                <div class="col-xs-4">
                                    <a href="<?php echo $video_link; ?>" class="social-box social-box-youtube">
                                        <span class="social-holder">
                                            <span class="icon icon-play-circle"></span>
                                            <strong class="title md-visible"><?php echo  $watch_video_title; ?></strong>
                                        </span>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="<?php echo $like_us_on_facebook_link; ?>" title="Like Us On Facebook" target="_blank" rel="nofollow" class="social-box social-box-facebook">
                                        <span class="social-holder">
                                            <span class="icon icon-facebook-square"></span>
                                            <strong class="title md-visible"><?php echo $like_us_on_facebook_title; ?> </strong>
                                        </span>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="<?php echo $twitter_button_link; ?>" class="social-box social-box-twitter">
                                        <span class="social-holder">
                                            <span class="icon icon-twitter"></span>
                                            <strong class="title md-visible"><?php echo $twitter_title; ?></strong>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                  <!-- Subscribe CTA -->
                <section class="section-subscribe">
                    <div class="wrapper container-fluid">
                        <div class="row center-xs">
                            <div class="col-xs-12 col-sm-11 col-md-10">
                                <div class="subscribe-form">
                                    <span class="icon icon-mail sm-visible"></span>
                                    <h2><?php echo get_field('newsletter_text', 2); ?></h2>
                                    <div class="form-row">
	                                         <?php echo do_shortcode('[ctct form="7979"]'); ?> 
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
</main>


<?php get_footer(); ?>
