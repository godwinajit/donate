<?php
/* Template Name: Old Front Page Template */
get_header();
?>

<!--  Home Slider Start -->

<div class="home-banner">
  <div class="owl-topbanner">
    <?php 
    $home_page_slider = get_field('home_page_slider'); 
    if($home_page_slider){
      foreach($home_page_slider as $slider){
        if($slider['image']){
          echo '<div class="item"> <img src="'.$slider['image']['url'].'" alt="'.$slider['image']['alt'].'" title="'.$slider['image']['title'].'">';
					}else{
						echo '<div class="item"><img title="banner-img" alt="" src="'.get_template_directory_uri().'/images/banner-img.jpg" class="bannerimage">';
						}
                 echo '<div class="main">
                  <div class="banner-text">
                   '.$slider['title'].'
                   '.$slider['description'].'
                   <a class="gen-btn btnlikebanner" href="'.$slider['button_url'].'" title="Learn More">'.$slider['button_text'].'</a> </div>
                 </div>
                </div>';
					
      }	
    }
   ?>
  </div>
</div>

<!--  Icon Slider Start -->
<div class="icon-slider">
  <div class="main">
    <div class="owl-ico-slider">
      <?php 
			$icon_slider = get_field('icon_slider');
			if($icon_slider){
				foreach($icon_slider as $islider){
					if($islider['image']){
						echo '<div class="item"> 
										<a class="cf" href="'.$islider['link'].'" title="Donate">
											<div class="img-ico">
											 <img class="img-normal" src="'.$islider['image']['url'].'" alt="'.$islider['image']['alt'].'" title="'.$islider['image']['title'].'" />
											 <img class="img-hover" src="'.$islider['hover_image']['url'].'" alt="'.$islider['hover_image']['alt'].'" title="'.$islider['hover_image']['title'].'" /> 
											</div>
										<div class="icon-slider-title">'.$islider['text'].'<span><i class="off"></i><i class="on"></i></span></div>
										</a> 
									</div>';	
					}	
				}	
			}
		?>
    </div>
  </div>
</div>
<div class="events-blog-video">
  <div class="main cf">
    <div class="event-blog-left">
      <?php
		$upcoming_event_title = get_field('upcoming_event_title');
		$select_event = get_field('select_event');
	?>
      <!-- Event Section Start -->
      <div class="event-blog-cont cf">
        <h3><?php echo $upcoming_event_title; ?></h3>
        <?php 
			if( $select_event ){
				$post = $select_event;
				setup_postdata( $post ); 
				$thumbnail_image = get_field('thumbnail_image');
		?>
        <div class="event-blog-img"> <a href="<?php the_permalink(); ?>" title="<?php the_permalink(); ?>">
          <?php //the_post_thumbnail('home-blog-list-thumb');
						if($thumbnail_image){
							echo '<img src="'.$thumbnail_image['url'].'" alt="'.$thumbnail_image['alt'].'">';
						}
					 ?>
          </a> </div>
        <div class="event-blog-right-cont">
          <h4> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
            </a> </h4>
          <?php the_excerpt(); ?>
        </div>
        <?php
			}
			wp_reset_postdata();
		?>
      </div>
    </div>
    <div class="video-facebook-right cf"> 
      
      <!-- Watch Our Videos Section Start -->
      <?php 
	 	$watch_video_title = get_field('watch_video_title');
		$video_link = get_field('video_link');
		$youtube_video_id = get_field('youtube_video_id');
		$vimeo_video_id = get_field('vimeo_video_id');
		$video_image = get_field('video_image');
	 ?>
      <div class="watch-video">
        <h3><a href="<?php echo $video_link; ?>" target="_blank" title="Watch Our Videos"><?php echo $watch_video_title; ?></a></h3>
        <div class="video-popup">
          <?php 
			/*if($youtube_video_id != ""){
				echo '<img src="http://img.youtube.com/vi/'.$youtube_video_id.'/mqdefault.jpg" alt="Watch Our Videos" title="Watch Our Videos" />';
			}
			if($vimeo_video_id != ""){
				$homepage = file_get_contents('http://vimeo.com/api/v2/video/'.get_field( 'vimeo_video_id').'.json');
			  $phpArray = json_decode($homepage);
  			$video_img = $phpArray[0]->thumbnail_medium; 
				echo '<img src="'.$video_img.'" alt="Watch Our Videos" title="Watch Our Videos" />';
			}*/
		?>
          <?php if($video_image){ ?>
          <img src="<?php echo $video_image['url']; ?>" alt="Watch Our Videos" title="Watch Our Videos" />
          <?php } ?>
          <a href="<?php echo $video_link; ?>"  target="_blank" class="video-popup-open" title="Watch Our Videos"></a></div>
        <!-- <a href="<?php echo $video_link; ?>" class="video-popup-open" title="Watch Our Videos"></a>  --> 
      </div>
    </div>
    <div class="clear"></div>
    <div class="event-blog-left"> 
      <!-- Blog Section Start -->
      <div class="event-blog-cont cf">
        <h3>Latest From The Blog</h3>
        <?php 
	 	$args = array( 'posts_per_page' => 1);
		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post );
	 ?>
        <div class="event-blog-img"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <?php the_post_thumbnail('home-blog-list-thumb'); ?>
          </a> </div>
        <div class="event-blog-right-cont">
          <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
            </a></h4>
          <?php the_excerpt(); ?>
        </div>
        <?php
		endforeach; 
		wp_reset_postdata();
	 ?>
      </div>
    </div>
    <div class="video-facebook-right cf"> 
      
      <!-- Like Us On Facebook Section Start -->
      <?php
	 	$like_us_on_facebook_title = get_field('like_us_on_facebook_title');
		$like_us_on_facebook_image = get_field('like_us_on_facebook_image');
		$like_us_on_facebook_link = get_field('like_us_on_facebook_link');
	 ?>
      <div class="link-facebook">
        <h3> <a href="<?php echo $like_us_on_facebook_link; ?>" title="Like Us On Facebook" target="_blank" rel="nofollow"><?php echo $like_us_on_facebook_title; ?> <span class="fa fa-facebook"></span></a> </h3>
        <a href="<?php echo $like_us_on_facebook_link; ?>" title="Like Us On Facebook">
        <?php if($like_us_on_facebook_image){
				echo '<img src="'.$like_us_on_facebook_image['url'].'" alt="'.$like_us_on_facebook_image['alt'].'" title="'.$like_us_on_facebook_image['title'].'" />';	
			} ?>
        <div class="arrow-ico"></div>
        </a> </div>
    </div>
  </div>
</div>
<div class="follow-us-twitter tac">
  <?php $twitter_title = get_field('twitter_title');
		$twitter_button_text = get_field('twitter_button_text');
		$twitter_button_link = get_field('twitter_button_link');
	
?>
  <div class="main"> <span class="fa fa-twitter"></span>
    <div class="twitter-title" rel="nofollow"><?php echo $twitter_title; ?></div>
    <?php dynamic_sidebar('twitter-sidebar'); ?>
    <?php if($twitter_button_text) { ?>
    <a class="gen-btn follow-us-twitt" href="<?php echo $twitter_button_link; ?>" target="_blank" rel="nofollow" title="Follow Us"><?php echo $twitter_button_text; ?></a>
    <?php } ?>
  </div>
</div>
<div class="sign-up-news-t">
  <div class="main">
   <div class="sign-up-news-container cf">
    <div class="sign-uplabel"><?php echo get_field('newsletter_text', 2); ?></div>
    <div class="gf_browser_gecko gform_wrapper"> 
     
     <!-- Constant Contact Start --> 
	                                         <?php echo do_shortcode('[ctct form="7979"]'); ?> 
     
     <!-- Constant Contact End --> 
      </div>
    </div>
  </div>
</div>
<div class="recent-event-fund">
  <div class="main">
    <?php $recent_events_title = get_field('recent_events_title');
		$select_recent_event_post = get_field('select_recent_event_post'); ?>
    <div class="imgoverlap-content cf">
      <div class="img-overlap">
        <div class="imgoverlap-title"><?php echo $recent_events_title; ?></div>
        <?php 
			if( $select_recent_event_post ){
				$post = $select_recent_event_post;
				setup_postdata( $post );
				$thumbnail_image = get_field('thumbnail_image');
				
		?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php //the_post_thumbnail('home-blog-list-thumb');
					if($thumbnail_image){
						echo '<img src="'.$thumbnail_image['url'].'" alt="'.$thumbnail_image['alt'].'">';	
					}
				 ?>
        </a> </div>
      <div class="overlap-content">
        <div class="text-title-date-share">
          <div class="text-title-link"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
            </a></div>
          <div class="date-n-share cf"> <span class="dateofevent">
            <?php //the_time('m.d.Y');
					$event_date = get_field('event_date');
								echo date('m.d.Y',strtotime($event_date));
			 ?>
            </span>
            <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>
          </div>
        </div>
        <div class="event-description">
          <?php the_excerpt(); ?>
        </div>
      </div>
      <?php
			}
			wp_reset_postdata();
		?>
    </div>
    <div class="imgoverlap-content cf">
      <div class="img-overlap">
        <?php $funding_grants_title = get_field('funding_&_grants_title');
		$select_funding_grants_post = get_field('select_funding_&_grants_post'); ?>
        <?php 
    if( $select_funding_grants_post ){
      $post = $select_funding_grants_post;
      setup_postdata( $post ); 
	 ?>
        <div class="imgoverlap-title"><?php echo $funding_grants_title; ?></div>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_post_thumbnail('home-blog-list-thumb'); ?>
        </a> </div>
      <div class="overlap-content">
        <div class="text-title-date-share">
          <div class="text-title-link"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
            </a></div>
          <div class="date-n-share cf"> <span class="dateofevent">
            <?php the_time('m.d.Y'); ?>
            </span>
            <div class="share-div"><?php echo do_shortcode('[sharethis]'); ?></div>
          </div>
        </div>
        <div class="event-description">
          <?php the_excerpt(); ?>
        </div>
        <?php
			}
			wp_reset_postdata();
		?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
