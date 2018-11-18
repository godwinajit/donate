<?php

/*
Template Name: Gallery Template
*/
get_header(); 

?>
<div class="se-pre-con"></div>
<div class="container">

	<div style="text-align:center">
		<h1><?php the_title(); ?></h1>
		<p><?php the_content(); ?></p>
	</div>
	
    <div class="gallery_page">
		<?php if (have_posts()) : the_post(); ?>
		
		
		<div id="grid">
        <div id="gallerys">
        
		         <div id="thumbnails">
		        <ul class="clearfix">
        
		<?php 
		
		if( have_rows('gallery') ):
		
					
				while ( have_rows('gallery') ) : the_row();
						$attachment_id = get_sub_field('image');
						$size = "medium";
						$image= wp_get_attachment_image_src( $attachment_id, $size );
						$size = "large";
						$image_original = wp_get_attachment_image_src( $attachment_id, $size );
						$title = get_sub_field("title");		
						
						
?>


				
				<div class="g_item"> 
				
				<li><a href="<?php echo $image_original[0];?>" title="<?php echo $title; ?>"><img src="<?php echo $image[0];?>" /></a><?php if(!empty($title)) {?>	<p><?php echo $title; ?></p> <?php }?></li>
				
			
				</div>
				
				<?php 
					endwhile;					
		endif;
		?>
		
			</ul>
			</div>
		
		

		 </div>
      </div>
		<?php endif; ?>
	</div>
	

</div>


<script>
jQuery(window).load(function() {
		// Animate loader off screen
		jQuery(".se-pre-con").fadeOut("slow");;
	});
</script>
<script type="text/javascript">
jQuery(function() {
	jQuery('#thumbnails a').lightBox();
});
</script>
<script
    type="text/javascript"
    async defer
    src="//assets.pinterest.com/js/pinit.js"
></script>
<?php get_footer(); ?>