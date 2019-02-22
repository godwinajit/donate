<?php
/**
 * Template part for displaying posts in Loop
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package santaenergy-main
 */
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'santa-main-thumb-370-180'); 
?>

<div class="col-sm-6 col-lg-4">
   <article class="blog">
      <a href="<?php the_permalink();?>" class="blog-link">
         <div class="blog-pic">
            <div class="bg-stretch">
				<?php if($featured_img_url){?>
					<span data-srcset="<?php echo $featured_img_url; ?>"></span>
				<?php }else{?>
					<span data-srcset="/wp-content/uploads/2013/07/comm_petro_products.jpg"></span>
				<?php }?>
            </div>
            <?php santa_get_post_tags();?>
         </div>
         <div class="blog-content">
            <h3><?php the_title();?></h3>
            <p><?php echo wp_trim_words( get_the_excerpt(), 30, '...' );?></p>
            <i class="icon-next"></i>
         </div>
      </a>
   </article>
</div>
