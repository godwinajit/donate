<?php

/* Template Name: Thank You Page*/

get_template_part( 'header' );

?>
<div class="page-header text-center bg-red thank-page-head">
  <div class="container">
    <div class="breadcrumbs">
      <a href="/" class="go-back d-md-none"><i class="icon-back"></i>Home</a>
      <ul class="d-none d-md-block">
        <li><a href="#">Home</a></li>
        <li>Thanks</li>
      </ul>
    </div>
    <h1>Thanks!</h1>
    <p>We received your request. We'll reach out to you within 1-2 business days.</p>
  </div>
</div>

<section id="news-section" class="lp-news-sec" style="background-color: #fff;">
      <div class="container">
        <div class="section-header text-center">
          <h2>In the meantime, you might find these interesting:</h2>
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
      
    </section>

<div class="lp-join-sec">
  <div class="container">
          <div class="row ">
<div class="map-social">
<h3>Join the Santa Family</h3>
<ul>
<li><a href="https://www.facebook.com/SantaEnergyCorp" title="Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
<li><a href="http://www.twitter.com/santaenergy" title="Twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
<li><a href="https://www.linkedin.com/company/765920?trk=tyah&amp;trkInfo=clickedVertical%3Acompany%2CclickedEntityId%3A765920%2Cidx%3A2-1-2%2CtarId%3A1476894006524%2Ctas%3ASanta%20Energy" title="LinkedIn" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
<li><a href="https://www.youtube.com/channel/UCOLZ5bBpmnnAlYNtFpSNqaA" title="YouTube" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
</ul>
</div>
</div>
</div>
</div>


<?php get_footer();
