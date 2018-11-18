<?php 
/*
 * Template Name:Videos Template New
 */
 ?>
 <?php
$r = new WP_Query( array(
   'showposts' => 1,
   'no_found_rows' => true, /*suppress found row count*/
   'post_status' => 'publish',
   'post_type' => 'video',
   'ignore_sticky_posts' => true,
 /*'orderby' => 'post_date',*/
   'order' => 'DESC',
) );
$latestVideoPostId = 0;
if ($r->have_posts()) :
while ( $r->have_posts() ) : $r->the_post();
   $latestVideoPostId = get_the_ID();
endwhile; ?>
<?php
wp_reset_postdata();
endif; ?>
<?php
	wp_redirect( get_permalink( $latestVideoPostId ), 302 );
	exit;
?>