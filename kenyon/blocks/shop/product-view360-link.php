<?php 

$isImages360View = 1;
$images_folder = get_field('view360_folder');
$images_count = get_field('view360_count');
$images_mask = get_field('view360_mask');
$images_video = get_field('360_video_path');
if($images_video != '') $isImages360View = 0;

if ( (!$images_folder || !$images_count || !$images_mask) && !$images_video) return; 


?>

<a class="view-360 iframe-lightbox iframe" data-width="553" data-height="330"  href="<?php echo get_site_url().add_query_arg('view360', $isImages360View); ?>"><?php _e('360 view', 'kenyon'); ?></a>