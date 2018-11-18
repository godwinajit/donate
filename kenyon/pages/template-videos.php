<?php

/*
Template Name: Videos Template
*/
get_header(); 

?>
<div class="container">
    <div class="video-section">
		<?php if (have_posts()) : the_post(); ?>
        <div class="">	
		<?php get_template_part('blocks/videos/videos-sidebar') ?>
            <?php the_content();  ?>			
		</div>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
 function setYouTubeShareURL(youTubeId){
		youTubeThumbnail = encodeURI("https://i.ytimg.com/vi/"+youTubeId+"/mqdefault.jpg");
	 	jQuery("#facebookYouTubeShare").attr("href", "https://www.facebook.com/sharer/sharer.php?u=http://www.youtube.com/watch?v="+youTubeId);
	 	jQuery("#pinterestYouTubeShare").attr("href", "https://pinterest.com/pin/create/button/?url=http://www.youtube.com/watch?v="+youTubeId+"&media="+youTubeThumbnail);
	 	jQuery("#twitterYouTubeShare").attr("href", "https://twitter.com/intent/tweet?url=http://www.youtube.com/watch?v="+youTubeId);
	 	jQuery("#googleYouTubeShare").attr("href", "https://plus.google.com/u/0/share?url=http://www.youtube.com/watch?v="+youTubeId);
	 	jQuery("#linkedinYouTubeShare").attr("href", "http://www.linkedin.com/shareArticle?url=http://www.youtube.com/watch?v="+youTubeId);
	 	jQuery("#youtubeYouTubeShare").attr("href", "http://www.youtube.com/watch?v="+youTubeId);	
	 	jQuery("#mailYouTubeShare").attr("href", "mailto:?Body=http://www.youtube.com/watch?v="+youTubeId);
	 }

function setYouTubeDescription(youTubeId){
	jQuery.getJSON('https://www.googleapis.com/youtube/v3/videos?part=snippet&id='+youTubeId+'&fields=items/snippet/description&key=AIzaSyCZ_xFqJF_Vrd0KDd10IRhOd-Q02JOCkjY',function(data,status,xhr){
	 jQuery('#ydesc').html(data.items[0].snippet.description);
});
}
			jQuery( document ).ready(function() {
				var intialVideoEmbedURL = jQuery('#ytcplayer1').attr('src');
				var youTubeGrabIdReg = new RegExp('(?:https?://)?(?:www\\.)?(?:youtu\\.be/|youtube\\.com(?:/embed/|/v/|/watch\\?v=))([\\w-]{10,12})', 'g');
				var initialYouTubeId = youTubeGrabIdReg.exec(intialVideoEmbedURL)[1]
				setYouTubeShareURL(initialYouTubeId);
				setYouTubeDescription(initialYouTubeId);
			});

			jQuery('.ytcthumb').click(function(){
				var youtubeid = jQuery(this).attr('href').split("watch?v=")[1];
				setYouTubeShareURL(youtubeid);
				setYouTubeDescription(youtubeid);
			});
</script>
<?php get_footer(); ?>