<?php switch_to_blog( 1 );?>
  <div class="container">
    <div class="section-header text-center">
      <h2><?php the_field('news_section_title', get_option( 'page_on_front' ));?></h2>
    </div>
  </div>
<?php 
	$latestNewsPosts = get_field('news_section_select', get_option( 'page_on_front' ));
	if( $latestNewsPosts ): ?>
  <div class="news-area">
    <div class="container">
      <div class="row mobile-slider">
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
      </div>
    </div>
  </div>
<?php endif; ?> 
<?php restore_current_blog();?>
