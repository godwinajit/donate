<?php

$image = get_field('image_1');
$image1 = get_field('image_section_3');
$image2 = get_field('image_section_4');
$image3 = get_field('image_1_(mobile)');
$image4 = get_field('image_section_3_(mobile)');
$image5 = get_field('image_section_4_(mobile)');
$title = get_field('box_2_title');
$linkh = get_field('build_a_grill_link');



?>




<div class="home-recent-post">
	<div class="container">
		<div class="row">
			<h2><?php the_field('select_post_title');?></h2>



			<div class="recent-post-item-section">
				<?php
					$recent_posts = get_field('select_post');
					if( $recent_posts ): ?>
					    <?php foreach( $recent_posts as $recent_post):?>
						<?php 
							$recent_post_image = get_the_post_thumbnail_url($recent_post->ID,'full');
							if(get_post_type($recent_post->ID) == 'video'){
								$recent_post_image = 'https://i.ytimg.com/vi/'.get_field('youtube_video_id', $recent_post->ID).'/mqdefault.jpg';
							}
						?>
					        <div class="recent-post-item">
								<h4><?php echo get_post_type($recent_post->ID) == 'post' ? 'NEWS' : get_post_type($recent_post->ID);?></h4>
								<a href="<?php echo get_the_permalink($recent_post->ID);?>">
									<div class="recent-post-bg" style="background-image:url('<?php echo $recent_post_image?>');"></div>
								</a>
								<h3><a href="<?php echo get_the_permalink($recent_post->ID);?>"><?php echo get_the_title($recent_post->ID);?></a></h3>
							</div>
					    <?php endforeach; ?>
					<?php endif; ?>
			</div>
		</div>
	</div>
</div>



<div class="home-build-section" >
  <div class="container">
    <div class="row">
      <div class="image-section-build build-1" ></div>
      <div class="image-section-build build-2"><h2><?php echo $title; ?></h2></div>
      <div class="image-section-build build-3" ></div>
      <div class="image-section-build build-4" ></div>
      <div class="image-section-build build-5" ><a class="btn btn-default btn-lg" href="<?php echo $linkh; ?>">Build a Grill</a></div>
    </div>
  </div>
</div>


<style type="text/css">
.build-1{
	background-image: url('<?php echo $image['url']; ?>');
}
.build-3{
	background-image: url('<?php echo $image1['url']; ?>');
}
.build-4{
	background-image: url('<?php echo $image2['url']; ?>');
}
	@media(max-width: 767px){
		body .build-1{
			background-image: url('<?php echo $image3['url']; ?>');
		}
		body .build-3{
			background-image: url('<?php echo $image4['url']; ?>');
		}
		body .build-4{
			background-image: url('<?php echo $image5['url']; ?>');
		}

	}
</style>



