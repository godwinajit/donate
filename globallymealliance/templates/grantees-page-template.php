<?php
/* Template Name: Grantees Page Template */
get_header();
?>
<!-- Top banner -->
<main class="mains">
<div class="inner-pages">
 <?php 
	if (has_post_thumbnail()) {
		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  
	}else {
		$banneurl = get_template_directory_uri().'/images/our-grantees.jpg';
	}
?>
 <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)">
  <div class="main">
   <div class="breadcrumb">
    <?php /* bcn_display(); */ ?>
   </div>
  </div>
 </div>
 <?php echo do_shortcode('[IconSlider]'); ?> 
 <!-- conatiner section -->
 <div class="container-section blog-pages">
  <div class="main main1196">
  <div class="boards">
   <div class="content-left content-section-height">
    <?php 
   $filter_using_year = get_field('filter_using_year');
	 if($filter_using_year == 'Select Year'){
		 echo '<h1 class="page-title">Our '.get_the_title().'</h1>';
		}else{
			echo '<h1 class="page-title">Our '.$filter_using_year.' '.get_the_title().'</h1>';
		}
    ?>
    <?php
			if (have_posts()): while (have_posts()): the_post();
			the_content(); 
			endwhile; endif;
 	 	?>
    <div class="grantees-list-container cf">
     <?php
							
							if($filter_using_year == 'Select Year'){
								$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
								$args = array( 'posts_per_page' => 5, 'post_type'=> 'grantees',  'paged' => $paged);	
							}else{
								$args = array( 'posts_per_page' => 5, 'post_type'=> 'grantees', 'meta_key' => 'grantee_year', 'meta_value'	=> $filter_using_year , 'paged' => $paged);	
							}
							$myposts = get_posts( $args );
							$wp_query = new WP_Query( $args );
							
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
							$id = get_the_ID();
					?>
     <section class="grantees-list">
      <figure class="grantees-left">
       <?php the_post_thumbnail('grantees-thumb'); ?>
      </figure>
      <div class="grantees-right">
       <h3>
        <?php the_title(); ?>
       </h3>
       <!-- <div class="share-div"><?php //echo do_shortcode('[sharethis]'); ?></div> -->
       <div class="clear"></div>
       <div class="entry-content">
        <p class="inline-content"><span class="normal-weight"><?php echo get_field('position'); ?></span> <br><?php echo get_the_content(); ?></p>
        <div class="expandable_hidden introtext<?php echo $id; ?>"> <?php echo get_field('hidden_content'); ?> </div>
        <div class="read-more"><a title="Read More" id="introtext<?php echo $id; ?>" href="javascript:{}" class="readmore1 more">More</a></div>
       </div>
      </div>
     </section>
     <?php endforeach; 
							wp_reset_postdata(); 
					?>
    </div>
    <?php wp_pagenavi(); ?>
   </div>
   
   <!-- aside section -->
   <div class="aside-right content-section-height">
    <?php dynamic_sidebar('blogvideo-sidebar'); ?>
    <?php dynamic_sidebar('ga-sidebar'); ?>
    <?php dynamic_sidebar('aboutgrant-sidebar'); ?>
   </div>
  </div>
 </div>
  </div>
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
                </section>
</div>
</main>
<?php get_footer(); ?>
