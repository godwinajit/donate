<?php
/* Template Name: Donate Content Page */
get_header();
?>

<?php /*HERE
<!-- Top banner -->
<div class="inner-pages donate-content-pages common-content-page">
 <?php 
	if (has_post_thumbnail()) {
		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  
	}else {
		$banneurl = get_template_directory_uri().'/images/donate-content-banner.jpg';
	}
?>
 <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)">
  <div class="main">
   <div class="breadcrumb">
    <?php bcn_display();?>
   </div>
  </div>
  <!-- banner Text -->
  <?php $banner_text = get_field('banner_text');
			if($banner_text){
				echo '<div class="main1196"><div class="top-banner-text"><div class="top-banner-text-inner">'.$banner_text.'</div></div></div>';	
			}
	 ?>
 </div>
 
 <!-- Other Ways to Give Links -->
 <div class="other-way-give">
  <div class="main1196 cf">
   <h1><?php echo the_title(); ?></h1>
   <?php $buttons_link = get_field('buttons_link');
		if($buttons_link){
			echo '<ul>';
			$i=0;
			foreach($buttons_link as $row){
				echo '<li><a href="javascript:void(0)" onclick="window.location=\''.$row['link'].'\'" title="'.strip_tags($row['title']).'"><span>'.$row['title'].'</span></a></li>';	
			$i++;
			}	
			echo '</ul>';
			
		}
	 ?>
  </div>
 </div>

 <?php echo do_shortcode('[IconSlider]'); ?> 

HERE*/?>

 <!-- conatiner section -->
 <div class="container-section">
  <div class="mains main main1196">
   <div class="content-left content-section-height boards">
      <h1 class="mobile-show page-title"><?php echo the_title(); ?></h1>
    <?php 
		$donate_content = get_field('donate_content');
		if($donate_content){
			$i=0;
			foreach($donate_content as $row){
				
				if($row['hidden_content_description']){
					echo '<article id="section'.$i.'" class="box"><h1>'.$row['content_title'].'</h1>'.$row['content_description'].'<div class="expandable_hidden doante_content'.$i.'">'.$row['hidden_content_description'].'</div><span class="read-more"><a class="readmore1 more" href="javascript:{}" id="doante_content'.$i.'" title="Read More">More</a></span></article>';
				}
				else{
					echo '<article id="section'.$i.'" class="box"><h1>'.$row['content_title'].'</h1>'.$row['content_description'].'</article>';
				}
				$i++;
			}	
		}
	?>
   </div>
   
   <!-- aside section -->
   <div class="aside-right content-section-height">
    <?php dynamic_sidebar('ga-sidebar'); ?>
   </div>
  </div>
 </div>
 <!-- Subscribe CTA -->
   <?php get_template_part( 'newsletter', 'form' ); ?>
</div>
<?php get_footer(); ?>
