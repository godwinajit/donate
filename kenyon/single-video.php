<?php get_header ();
?> 
<section class="section">
	<div class="container">
		<div class="row">
			<div id="postcontent" class="col-xs-12 col-sm-7 col-md-8 col-main aside">
				<!--<header class="page-header">
					<h2>Car Spots</h2>
				</header>-->
			<?php	if (have_posts()) : while (have_posts()) : the_post();
                    $youtubeId = get_field('youtube_video_id')
				
			?> 
				<article class="post post-single post-youtube">				
					<div class="media">
						<iframe id="ytcplayer" width="560" height="315"
							src="https://www.youtube.com/embed/<?php echo $youtubeId ?>" frameborder="0"
							allowfullscreen></iframe>
					</div>
			<?php endwhile; endif; ?>	
					<div class="share-block">
						<ul class="share-list">
							<li><a href="https://www.facebook.com/sharer/sharer.php?u=http://www.youtube.com/watch?v=<?php echo $youtubeId ?>" target="_blank" id="facebookYouTubeShare" class="facebook"><span class='st_facebook_hcount'><em class="txt">Like</em> <span 	class="ico"><i class="icon-facebook"></i></span></span></a></li>
							<li><a href="https://twitter.com/intent/tweet?url=http://www.youtube.com/watch?v=<?php echo $youtubeId ?>" target="_blank"><span class='st_twitter_hcount'><em class="txt">Tweet</em><span class="ico"><i class="icon-twitter"></i></span></span></a></li>
							<li><a href="https://plus.google.com/u/0/share?url=http://www.youtube.com/watch?v=<?php echo $youtubeId ?>" target="_blank"><span class='st_googleplus_hcount'><em class="txt">Share</em><span class="ico"><i class="icon-google"></i></span></span></a></li>
							<li><a href="http://www.linkedin.com/shareArticle?url=http://www.youtube.com/watch?v=<?php echo $youtubeId ?>" target="_blank">
							<span class='st_linkedin_hcount'><em class="txt">Share</em>
							<span class="ico"><i class="icon-linkedin"></i></span></span></a></li>
							<li><a href="mailto:?Body=http://www.youtube.com/watch?v=<?php echo $youtubeId ?>" ><span class='st_email_hcount'><em class="txt">Share</em><span
									class="ico"><i class="icon-envelope"></i></span></span></a></li>
						</ul>
					</div>
					<h1><?php the_title();?></h1>
					<div id="youtube_desc"><?php the_content() ;?></div>
				</article>
				<?php comments_template( $file = '/video-comments.php', $separate_comments = true); ?>
				
			<!--	<section class="section">
					<header class="sub-headline">
						<h2>Comments</h2>
					</header>
					<ol class="comments-list">
						<li>
							<div class="post">
								<div class="pic">
									<a href="#"><img src="images/pic-no-avatar.jpg"
										srcset="images/pic-no-avatar-2x.jpg 2x" alt="no avatar"
										width="50" height="50"></a>
								</div>
								<div class="title">
									<a href="#" class="link">Reply</a>
									<h3>
										<a href="#">Matt Adams</a>
									</h3>
									<p class="info">
										<time datetime="2012-01-02T14:35">Jan 2nd, 2012 2:35 pm</time>
									</p>
								</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
									Integer nec odio. Praesent libero. Sed cursus ante dap ibus
									diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.
									Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed
									augue semper porta.</p>
							</div> <!-- <ol>
											<li>
												<div class="post">
													<div class="pic">
														<a href="#"><img src="images/pic-no-avatar.jpg" srcset="images/pic-no-avatar-2x.jpg 2x" alt="no avatar" width="50" height="50"></a>
													</div>
													<div class="title">
														<a href="#" class="link">Reply</a>
														<h3><a href="#">Matt Adams</a></h3>
														<p class="info"><time datetime="2012-01-02T14:35">Jan 2nd, 2012 2:35 pm</time></p>
													</div>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dap ibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.</p>
												</div>
											</li>
										</ol> -- >
						</li>
						<li>
							<div class="post">
								<div class="pic">
									<a href="#"><img src="images/pic-no-avatar.jpg"
										srcset="images/pic-no-avatar-2x.jpg 2x" alt="no avatar"
										width="50" height="50"></a>
								</div>
								<div class="title">
									<a href="#" class="link">Reply</a>
									<h3>
										<a href="#">Matt Adams</a>
									</h3>
									<p class="info">
										<time datetime="2012-01-02T14:35">Jan 2nd, 2012 2:35 pm</time>
									</p>
								</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
									Integer nec odio. Praesent libero. Sed cursus ante dap ibus
									diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.
									Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed
									augue semper porta.</p>
							</div>
						</li>
						<li>
							<div class="post">
								<div class="pic">
									<a href="#"><img src="images/pic-no-avatar.jpg"
										srcset="pic-no-avatar-2x.jpg 2x" alt="no avatar" width="50"
										height="50"></a>
								</div>
								<div class="title">
									<a href="#" class="link">Reply</a>
									<h3>
										<a href="#">Matt Adams</a>
									</h3>
									<p class="info">
										<time datetime="2012-01-02T14:35">Jan 2nd, 2012 2:35 pm</time>
									</p>
								</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
									Integer nec odio. Praesent libero. Sed cursus ante dap ibus
									diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.
									Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed
									augue semper porta.</p>
							</div>
						</li>
					</ol>
				</section>
				<section class="section section-contact">
					<h2>Add Your Comment</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
						nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.
						Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.</p>
					<div class="form-box contact-form">
						<form action="#">
							<div class="fieldset">
								<div class="row">
									<div class="col-xs-12 col-sm-8 col-md-6">
										<div class="control-wrap">
											<input type="text" class="form-control" placeholder="Name">
											<!-- <span class="wpcf7-not-valid-tip">Please fill the required field.</span> -- >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-8 col-md-6">
										<div class="control-wrap">
											<input type="text" class="form-control"
												placeholder="Email Address">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-8 col-md-6">
										<div class="control-wrap">
											<input type="text" class="form-control"
												placeholder="Website Url">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="control-wrap">
											<textarea class="form-control"></textarea>
										</div>
									</div>
								</div>
								<div class="action">
									<input type="submit" value="Submit" class="btn-round red sm">
								</div>
							</div>
						</form>
					</div>
				</section> -->
			</div>
			
	<?php
		$args = array(
		'post_type'		=> 'video',
		'post_status'   => 'publish',				
		'order'			=> 'DESC',
		'ignore_sticky_posts' => true,
		'showposts'		=> 5		
       ); 
	  $video_list = get_posts($args);
	  $videoCount = wp_count_posts('video')->publish;	 	
	?>			
			<div class="col-xs-12 col-sm-5 col-md-4 aside">
				<div class="box box-video">
					<!--<div class="heading">
						<h2>Videos From This Channel</h2>
					</div>-->
					<div class="video-more">
						<div class="thumbs" data-ajax-page="#postcontent">
				        <?php 
                            if(count($video_list)){
								foreach($video_list as $video){ 
								$youtubeVideoId  = get_post_meta( $video->ID, 'youtube_video_id', true );
								$videoURL = get_permalink( $video->ID);	?>						 
									<div class="thumb <?php echo (get_the_ID()==$video->ID)?"active":""; ?>">
										<a href="<?php echo $videoURL; ?>">
											<div class="pic">
												<img 
												src="https://i.ytimg.com/vi/<?php echo $youtubeVideoId;?>/mqdefault.jpg"   
												alt="image" width="120"	height="67">
											</div>
											<p><?php echo $video->post_title;?></p>
										</a>
									</div>
								<?php } 
							}else{ ?>
							<div class="thumb">No video found.</div>							
							<?php } ?>	
						<input type="hidden" id="pagination" name="pagination" value="10" />	
						</div>
					
						<?php  if($videoCount > 2){?>
						<div class="pager">
							<div><div style="display:none;" class="load-pre-con"></div></div>
							<a class="next-page btn btn-default"
								href="javascript:void(0)">Load More</a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
jQuery( document ).ready(function() {
                var youtubeDesc = "<?php the_content() ;?>";				
				var youtubeId = "<?php echo $youtubeId ?>";
				function setYouTubeDescription(youTubeId,youtubeDesc){	
                    var videoDesc = youtubeDesc;				
					if(videoDesc == ""){
						var intialVideoEmbedURL = "https://www.youtube.com/embed/"+youtubeId;					
						jQuery.getJSON('https://www.googleapis.com/youtube/v3/videos?part=snippet&id='+youTubeId+'&fields=items/snippet/description&key=AIzaSyCZ_xFqJF_Vrd0KDd10IRhOd-Q02JOCkjY',function(data,status,xhr){					
					 jQuery('#youtube_desc').html(data.items[0].snippet.description);
				    });
					}				
				}		
				setYouTubeDescription(youtubeId,youtubeDesc);	

            jQuery(".next-page").on("click", function() { 
			    jQuery(".load-pre-con").show();	
                jQuery(".next-page").hide();
			
			    var post_count = Number(jQuery('#pagination').val());	
				jQuery.ajax({
							type : 'post',
							url : "/wp-admin/admin-ajax.php",
							data : {
								action : 'get_videos_load_more',	 
								post_count : post_count,     
						
							},
						 
							success : function( response ) {	
                                jQuery(".next-page").show();							
								jQuery(".video-more .thumbs").html( response );	  
                                jQuery(".load-pre-con").hide();	
																
							}
						});	  
			});	
			   /*jQuery("#author,#email,#url,#comment").on("focus", function() { 
			     
				 var author =  jQuery('#author').val().trim();
				 var email =  jQuery('#email').val().trim();
				 var url =  jQuery('#url').val().trim();
				 var comment =  jQuery('#comment').val().trim();
				 
				 if(author!='' && email!='' && url !='' && comment!=''){
				 jQuery(".comment_submit").attr("disabled",false);
				 }else{
				 jQuery(".comment_submit").attr("disabled",true);
				  return false;
				 }				
				
			   });*/
				
});
</script>
<?php get_footer(); ?>