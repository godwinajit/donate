<?php

/* Template Name: About Page */

get_header();
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'santa-main-thumb-370-180');
?>
<div class="page-header text-center bg-red">
  <div class="container">
	<?php get_template_part('template-parts/breadcrumbs'); ?>
    <?php get_template_part('template-parts/topcta'); ?>
  </div>
</div>

<div class="main-cols">
  <div class="container container-wider">
    <div class="row">
      <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?> 
		<div class="col-md-4 col-lg-3">
			<?php get_sidebar(); ?>
		</div>
     <?php } ?>
      <div class="col-md-8 offset-lg-1">
	    <?php if($featured_img_url){?>
		  <div class="blog-pic">
		  <div class="bg-stretch">
				<span data-srcset="<?php echo $featured_img_url; ?>"></span>
		  </div>
		  </div>
        <?php }?>
		  <?php if(get_field('show_page_title_in_page') == 'yes'): ?><h2><?php the_title();?></h2><?php endif;?>
          <?php the_content(); ?>
		  <?php
	if( have_rows('statistics_repeater') ):
?>
<section class="stats mt-80 fs-sm">
  <div class="container container-wider">
    <div class="stats-area bg-darkblue">
      <div class="stats-list">
        <div class="row gap-54">
  				<?php
  				while ( have_rows('statistics_repeater') ) : the_row();
  				?>
  				<div class="col-sm-6 col-md-3 stats-box">
  				<strong class="title"> <?php the_sub_field('statistics_number'); ?> </strong>
  				<?php the_sub_field('statistics_description'); ?>
  				</div>
  				<?php
  				endwhile;
  				?>
    		</div>
      </div>
    </div>
  </div>
</section>
<?php
	endif;
?>
<section>
<div class="container">
<div class="text-center">
<?php the_field('estimate_title');?>
<?php 
$estimate_link = get_field('estimate_link');
$estimate_text=get_field('estimate_text');
if( $estimate_link ): ?>
	
	<a class="button" href="<?php echo $estimate_link;?>"> <?php echo $estimate_text; ?></a>

<?php endif; ?>
</div>
<?php the_field('estimate_content');?>

</div>
</section>
       </div>
    </div>
  </div>
</div>


<section class="team pt-80">
  <div class="container">
    <div class="headline icon-logo text-center">
      <h2><?php the_field ('team_title'); ?> </h2>
    </div>
    <?php if( have_rows('team_repeater') ): ?>
    <div class="team-panel">
        <div class="team-holder">
         <?php while( have_rows('team_repeater') ): the_row(); 
		 $about_image = get_sub_field('image');
		 $about_image_size = 'santa-main-thumb-300-300';
		 ?>
          <div class="slide" id="panel-<?php echo get_row_index(); ?>">
            <div class="row align-items-center">
              <div class="col-md-4 col-lg-3">
                <div class="member-info">
				<?php if( $about_image ) {?>
                  <div class="avatar" title="<?php the_sub_field('designation'); ?> <?php the_sub_field('name'); ?>)" style="background-image: url('<?php echo $about_image['sizes'][$about_image_size ];?>');">
                  </div>
				  <?php
					}
				  ?>
                  <div class="title">
                    <em><?php the_sub_field('designation'); ?></em>
                    <h3><?php the_sub_field('name'); ?></h3>
                  </div>
                  <i class="icon-next"></i>
                  <span class="close">Close</span>
                </div>
              </div>
              <div class="col-md-8 col-lg-9">
                <div class="member-details">
                  <div class="title">
                    <em><?php the_sub_field('designation'); ?></em>
                    <h3><?php the_sub_field('name'); ?></h3>
                  </div>
                  <p><?php the_sub_field('description'); ?></p>
                </div>
              </div>
            </div>
          </div>
          <?php endwhile; ?>

        </div>
        <ul class="team-grid row">
        
        <?php while( have_rows('team_repeater') ): the_row(); 
		 $about_image = get_sub_field('image');
		 $about_image_size = 'santa-main-thumb-300-300';
		 ?>
          <li class="col-md-4 col-lg-3">
            <a href="#panel-<?php echo get_row_index(); ?>" class="opener">
              <div class="member-info">
			    <?php if( $about_image ) {?>
                <div class="avatar" title="<?php the_sub_field('designation'); ?> <?php the_sub_field('name'); ?>" style="background-image: url('<?php echo $about_image['sizes'][$about_image_size ];?>');">
                </div>
				<?php
					}
				?>
                <div class="title">
                  <em><?php the_sub_field('designation'); ?></em>
                  <h3><?php the_sub_field('name'); ?></h3>
                </div>
                <i class="icon-next"></i>
                <span class="close">Close</span>
              </div>
            </a>
            <div class="slide" data-id="panel-1">
            </div>
          </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <?php endif; ?>
    </div>
</section>

<?php
    get_template_part( 'template-parts/testimony', 'section' );
?>

<section class="pb-30">
  <div class="container">
    <div class="text-center">
    <h3><?php the_field('quote_title');?></h3>
    <?php 
    $quote_link = get_field('quote_link');
    $quote_text=get_field('quote_text');
    if( $quote_link ): ?>

      <a class="button button-red" href="<?php echo $quote_link; ?>"> <?php echo $quote_text; ?></a>

    <?php endif; ?>
    </div>
  </div>
</section>

<?php
    get_template_part( 'template-parts/cta', 'section' );
?>


<?php get_footer();
