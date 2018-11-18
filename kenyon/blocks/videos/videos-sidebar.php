<div id="video-sidebar" class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="description-box">
        <h2>
            <?php _e('Share this Video', 'kenyon') ?>
        </h2>
		
		<aside id="ydesc" class="block widget_text">
			
		</aside>
        <script type="text/javascript">
			jQuery('.ytclink').click(function(){
				var youtubeid = jQuery(this).attr('href').split("watch?v=")[1];
				var ajax_url = "<?php echo admin_url( 'admin-ajax.php' );?>";
				var data = {
					action: 'get_youtube_video_data',
					youtubeid: youtubeid
				};
				jQuery.post( ajax_url, data, function( response ) {
					console.log( response );
					if( response == 0 ){
						response="";
					}
					jQuery('#ydesc').html(response);
				});
				//alert(youtubeid);
				return false;
			});

		</script>
		<div class="bottom-row">
				<ul class="social-networks">
					<li><a class="facebook" id="facebookYouTubeShare" target="_blank" href="https://www.facebook.com/cookwithkenyon">/cookwithkenyon</a></li>
					<li><a class="pinterest" id="pinterestYouTubeShare" target="_blank" href="http://www.pinterest.com/cookwithkenyon">CookWithKenyon</a></li>
					<li><a class="twitter" id="twitterYouTubeShare" target="_blank" href="https://twitter.com/cookwithkenyon">Cook With Kenyon</a></li>
					<li><a class="google" id="googleYouTubeShare" target="_blank" href="https://plus.google.com/u/0/108046442541044753196/about">Kenyon International</a></li>
					<li><a class="linkedin" id="linkedinYouTubeShare" target="_blank" href="https://www.linkedin.com/company/kenyon-international-inc.">Kenyon International, Inc.</a></li>
					<li><a class="youtube" id="youtubeYouTubeShare" target="_blank" href="https://www.youtube.com/user/CookWithKenyon">CookWithKenyon</a></li>
					<li><a class="mail_icon" id="mailYouTubeShare" href="mailto:?Body=https://www.youtube.com/user/CookWithKenyon">CookWithKenyon</a></li>
				</ul>
        </div>
        <?php dynamic_sidebar( 'videos-page-sidebar' ); ?>
    </div>
</div>
