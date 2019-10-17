<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
    /**
     * woocommerce_before_single_product hook
     *
     * @hooked wc_print_notices - 10
     */
     do_action( 'woocommerce_before_single_product' );

     if ( post_password_required() ) {
        echo get_the_password_form();
        return;
     }
?>

    <div class="col-md-8 col-sm-8">
        <div class="product-gallery-wrapper">


<div class="pro-image-slider">
<?php  get_template_part('blocks/shop/product-video'); ?>
            <?php
    global $product;

    $attachment_ids = $product->get_gallery_image_ids();

    foreach( $attachment_ids as $attachment_id ) {
        $image_link = wp_get_attachment_url( $attachment_id );
        echo '<div><a href="'.$image_link.'" data-options="zoomPosition: inner" class="MagicZoom"><img height="auto" width="100%" max-width="620px" src="'.$image_link.'"></a></div>'; 
        

    }
?>
</div>
<script src="//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.css">
<script>





var tag = document.createElement('script');
        tag.id = 'iframe-demo';
        tag.src = 'https://www.youtube.com/iframe_api';
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var player;
        function onYouTubeIframeAPIReady() {
            var elems1 = document.getElementsByClassName('yt-player');
            for(var i = 0; i < elems1.length; i++) {
                
                player = new YT.Player(elems1[i], {
                    events: {
                        //'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }
        }
        function onPlayerReady(event) {
            
        }
        function handleVideo(playerStatus) {
            if (playerStatus == -1) {
                // unstarted
                $('.pro-image-slider').slick('slickPause');
            } else if (playerStatus == 0) {
                // ended
                $('.pro-image-slider').slick('slickPlay');
                
            } else if (playerStatus == 1) {
                // playing = green
                $('.pro-image-slider').slick('slickPause');                
            } else if (playerStatus == 2) {
                // paused = red
                $('.pro-image-slider').slick('slickPlay');
            } else if (playerStatus == 3) {
                // buffering = purple
            } else if (playerStatus == 5) {
                // video cued
            }
        }
        function onPlayerStateChange(event) {
            handleVideo(event.data);
        }
        
        jQuery(function() {
            jQuery('.pro-image-slider').slick({
         dots: false,
            infinite: false,
            nextArrow: '<div class="slick-next"><img src="http://www.cookwithkenyon.com/wp-content/uploads/2018/06/right.svg"></div>',
prevArrow: '<div class="slick-prev"><img src="http://www.cookwithkenyon.com/wp-content/uploads/2018/06/left.svg"></div>',

            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
            responsive: [
{
breakpoint:1024,
settings:{
arrows :true,
slidesToShow:1
}
},
{
breakpoint:768,
settings:{
arrows :true,
slidesToShow:1
}
}
]
            });

        });
        
        jQuery('.pro-image-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
            jQuery('.yt-player').each(function(){
                this.contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*')
            });
        });


   jQuery(document).ready(function($){$('.pro-image-slider').on('setPosition', function () {
      $(this).find('.slick-slide').height('auto');
      var slickTrack = $(this).find('.slick-track');
      var slickTrackHeight = $(slickTrack).height();
      $('.video-wrapper ').css('height', slickTrackHeight + 'px');
      });
});

    </script>

    <style type="text/css">

    div#MagicToolboxSelectors {
    display: none;
}

div.MagicToolboxMessage {
    text-align: center;
    display: none;
}
a#MagicZoomPlusImage_Main {
    display: block!important;
    width: 100%;
    height: 100%;
}

.MagicToolboxContainer {
    max-width: 100%!important;
}


        .product-gallery-wrapper .images,
        .product-gallery-wrapper a.view-360.iframe-lightbox.iframe{
            display: none;
        }
        .video-wrapper {
            position: relative;
            padding-top: 25px;
            height: 0;
            padding: 4% 0 4.8%;
        }
        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .pro-image-slider { 
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease;
            -webkit-transition: opacity 1s ease; }
        .pro-image-slider.slick-initialized { 
            visibility: visible;
            opacity: 1;
        }
    </style>



            <?php woocommerce_show_product_sale_flash(); ?>
            <?php woocommerce_show_product_images(); ?>

    <?php
        if(have_rows('product_gallery')){
            $image_link = '<div id="MagicToolboxSelectors" class="MagicToolboxSelectorsContainer" style="margin-top: 5px">';
        while ( have_rows('product_gallery') ) : the_row();
            
            $video_url = get_sub_field('product_gallery_video_id');
            $image_title = get_sub_field('product_gallery_image')['title'];
            $image_set = get_sub_field('product_gallery_image');
            if($image_set){
                $image_url = get_sub_field('product_gallery_image')['url'];
                $image_size_urls = get_sub_field('product_gallery_image')['sizes'];
                $gallery_image_url = $image_size_urls['product-image-with-video'];
                }else
                {
                $gallery_image_url ='https://i.ytimg.com/vi/'.$video_url.'/mqdefault.jpg';
                }   
    //? ><pre><?php //print_r( $gallery_image_url); ? ></pre> < ?php
        if($video_url != "" || $image_set != ""){

            if($video_url == ""){
                $image_link .= '<a class="MagicThumb-swap" style="outline: 0px none; display: inline-block; margin: 4px;" href="'.$image_url.'" rel="zoom-id: MagicZoomPlusImage_Main;caption-source: a:title;" rev="'.$image_url.'" id="mt-1149005125887"><img src="'.$gallery_image_url.'" alt="'.$image_title.'" style="max-height: 56px; max-width: 90px;" ></a>';
            }else
                {
                    $image_link .= '<a class="product-video-btn  iframe-lightbox iframe main-image" href="http://www.youtube.com/embed/'.$video_url.'" style=" margin: 4px;"><img alt="'.$image_title.'" src="'.$gallery_image_url.'" style="max-height: 56px; max-width: 90px;"><span class="ico-play"></span></a>';
                }
            }

            endwhile;
            $image_link .= '</div>';
        }   
        
    
         ?>
                
            <script type="text/javascript">
            jQuery('.images .MagicToolboxContainer .MagicToolboxContainer #MagicToolboxSelectors').remove();

            var ImagesLink = '<?php echo $image_link; ?>';      
                            
                jQuery('.images .MagicToolboxContainer .MagicToolboxContainer').append(ImagesLink);
                          </script>
                <?php get_template_part('blocks/shop/product-view360-link'); ?>
                          </div>


        <?php // get_template_part('blocks/shop/product-video'); ?>

         <?php woocommerce_output_product_data_tabs(); ?>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="product-info">
            <?php do_action( 'woocommerce_before_single_product_summary' ); ?>

            <header>
                <?php woocommerce_template_single_title() ?>
                <?php get_template_part('blocks/shop/product-destination') ?>
                <div class="meta-block clearfix">
                    <?php woocommerce_template_single_rating() ?>
                </div>
            </header>

            <?php do_action( 'woocommerce_single_product_summary' ); ?>

            <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
            
            <meta itemprop="url" content="<?php the_permalink(); ?>" />
        </div>

        <?php dynamic_sidebar('shop-product-sidebar') ?>
    </div>



<?php do_action( 'woocommerce_after_single_product' ); ?>
