<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package santaenergy-main
 */
$desktop_featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'santa-main-thumb-1177-677');
$mobile_featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'santa-main-thumb-280-460');
?>

<div class="blog single-blog">
   <div class="blog-pic">
      <div class="bg-stretch">
         <?php if( $desktop_featured_img_url ) {?>
			<span data-srcset="<?php echo $desktop_featured_img_url;?>"></span>
		<?php }else{?>
			<span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img03.jpg"></span>
		<?php }?>

		<?php if( $mobile_featured_img_url ) {?>
			<span data-srcset="<?php echo $mobile_featured_img_url;?>" data-media="(max-width: 480px)"></span>
		<?php }else{?>
            <span data-srcset="<?php echo get_template_directory_uri(); ?>/img/product-page/img03-m.jpg" data-media="(max-width: 480px)"></span>
		<?php }?>
     </div>
   </div>
   <h2><?php the_title();?></h2>
   <?php the_content();?>
</div>
