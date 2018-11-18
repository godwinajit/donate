<?php 

$images_folder = get_field('view360_folder');
$images_count = get_field('view360_count');
$images_mask = get_field('view360_mask');

if (!$images_folder || !$images_count || !$images_mask) return; 


?><!DOCTYPE html>
<html data-type="example" data-id="sprite-directional">
  <head>
    <title><?php the_title(); ?></title>
    <meta charset='utf-8' content='text/html' http-equiv='Content-type' />
    <script src='http://code.jquery.com/jquery-1.7.min.js' type='text/javascript'></script>
    <script src='http://code.vostrel.cz/jquery.reel-1.2-bundle.js' type='text/javascript'></script>
    <script>
      $(window).on('load', function(){ // when DOM ready
				$('#view360-image-<?php the_ID() ?>').reel({
					indicator: 2,
					speed: .2,
					loops: false,
					images: '<?php echo $images_mask; ?>',
					path: '<?php echo $images_folder; ?>/',
					frames: <?php echo intval($images_count); ?>
				});
				$('#view360-image-<?php the_ID() ?>').trigger('play').bind('frameChange', function(e, depr_frame, frame){
					if(frame == <?php echo intval($images_count); ?>){ $(this).trigger('stop'); }
				});
      });
    </script>
		<style type='text/css'>
			body{margin:0;}
			#rotate_wrapper{position:relative;border:1px solid #000;}
			#icon_360{background:url("<?php echo get_template_directory_uri(); ?>/images/360_icon.png") no-repeat 0 0;width:143px;height:29px;position:absolute;top:5px;right:5px;z-index:999;}
			a{color:#000;}
			a.example1{color:red;}
			.reel-overlay{
				width:100% !important;
				height:auto !important;
			}
			#rotate_wrapper img{
				height:auto;
				width:100%;
			}
		</style>    
  </head>
  <body>
		<div id='page'>
			<div id="rotate_wrapper">
				<div id='icon_360'></div>
				<img src='<?php echo $images_folder ?>/<?php echo str_replace('#', '1', $images_mask); ?>' id="view360-image-<?php the_ID() ?>" height='454' width='535' />    
				<div id='controls'></div>
			</div>
		</div>
  </body>
</html>