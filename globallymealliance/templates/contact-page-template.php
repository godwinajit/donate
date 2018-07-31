<?php

/* Template Name: Contact Page Template */

get_header();

?>

<!-- Top banner -->




<main class="mains">
<div class="inner-pages common-content-page">

 <?php 

	if (has_post_thumbnail()) {

		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  

	}else {

		$banneurl = get_template_directory_uri().'/images/template-banner.jpg';

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

 <div class="container-section">

  <div class="main main1196">

   

   <div class="content-left content-section-height"> 

    <div class="entry-content"> 

    	<?php echo the_content(); ?>

    	

			<?php

				echo '<div class="content-form cf">'.do_shortcode('[gravityform id=7 title=false description=false ajax=true tabindex=149]').'</div>';

				echo '<div class="bottom-event-address bottom-event-address-html">';

				the_field('gla_mailing_address');

				echo '</div>';	

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
</main>
<?php get_footer(); ?>

