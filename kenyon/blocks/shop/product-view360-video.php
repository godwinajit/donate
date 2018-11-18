<?php 

$images_folder = get_field('view360_folder');
$images_count = get_field('view360_count');
$images_mask = get_field('view360_mask');
$images_video = get_field('360_video_path');

if ( (!$images_folder || !$images_count || !$images_mask) && !$images_video) return; 


?><!DOCTYPE html>
<html data-type="example" data-id="sprite-directional">
  <head>
    <title><?php the_title(); ?></title>
    <meta charset='utf-8' content='text/html' http-equiv='Content-type' />
  </head>
  <body>
		<div id='page'>
			 <video width="100%" height="100%" autoplay="autoplay" loop="loop">
  				<source src="<?php the_field('360_video_path');?>" type="video/mp4">
  				Your browser does not support the video tag.
			</video> 
		</div>
  </body>
</html>