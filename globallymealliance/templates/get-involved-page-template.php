<?php
/* Template Name: Get Involved Page Template */
get_header();
?>
<!-- Top banner -->


<div class="inner-pages common-content-page">
 <?php 
	if (has_post_thumbnail()) {
		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  
	}else {
		$banneurl = get_template_directory_uri().'/images/template-banner.jpg';
	}
	
	$bbalurl = get_template_directory_uri().'/images/bite-back-against-lyme.gif';
?>
 <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)">
  <div class="main">
   <div class="breadcrumb">
    <?php /* bcn_display(); */ ?>
   </div>
   <div class="bbal" style="background-image:url(<?php echo $bbalurl; ?>)"></div>
  </div>
 </div>
 <?php echo do_shortcode('[IconSlider]'); ?> 
 <!-- conatiner section -->
 <div class="container-section">
  <div class="main main1196">
   
   <div class="content-left content-section-height"> 
    <div class="entry-content"> 
    	<?php echo the_content(); ?>
    	
			<?php
				echo '<div class="content-form cf">'.do_shortcode('[gravityform id=6 title=false description=false ajax=true tabindex=49]').'</div>';
				echo '<div class="bottom-event-address bottom-event-address-html">'.get_field('main_bottom_event_address').'</div>';	
			?>
    </div>
   </div>
   
   <!-- aside section -->
   <div class="aside-right content-section-height">
   	<?php dynamic_sidebar('blogvideo-sidebar'); ?>
    <?php dynamic_sidebar('aboutgrant-sidebar'); ?>
    <?php dynamic_sidebar('bucket-sidebar'); ?>
    <?php dynamic_sidebar('ga-sidebar'); ?>
   </div>
  </div>
 </div>

    <!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>
</div>
<?php get_footer(); ?>
