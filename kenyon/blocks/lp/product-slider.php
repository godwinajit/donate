<?php

$title_shop = get_field('shop_section_title');



?>


<?php if( have_rows('product_lists') ): ?>
<div class="lp-slider-section">

    <div class="container">
                    <div class="row">
                        <h2><?php echo $title_shop; ?></h2>
    <div class="lp-slides-wrap">

    <?php while( have_rows('product_lists') ): the_row(); 

        // vars
        $image = get_sub_field('product_image');
        $title = get_sub_field('product_title');
        $price = get_sub_field('product_price');
        $content = get_sub_field('product_description');
        $link = get_sub_field('shop_now_link');

        ?>

        <div class="lp-slide-item">

            <div class="img-content" style="background-image:url('<?php echo $image['url']; ?>');"></div>
                <h3><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h3>
                <h4>$<?php echo $price; ?></h4>
            <p><?php echo $content; ?></p>
            <div class="lp-shop-cta"><a href="<?php echo $link; ?>">Shop Now</a></div>

       
    </div>

        

    <?php endwhile; ?>

    </div>
</div>
</div>
</div>
<?php endif; ?>

<script type="text/javascript">
  


(function($) {
$(document).ready(function(){
$slick = $('.lp-slider-section .lp-slides-wrap');
$slick.slick({
dots: false,
infinite: true,
speed: 500,
slidesToShow: 3,
slidesToScroll: 1,
autoplay: false,
autoplaySpeed: 2000,
responsive: [
{
breakpoint:767,
settings:{
slidesToShow: 1,
mobileFirst:true,
slidesToScroll: 1,
adaptiveHeight: true,
autoplay: true
}
}
]
});
});
}(jQuery));
</script>
<style type="text/css">
    .lp-slide-item:focus,
    .lp-slides-wrap button:focus {
    outline: none;
}
.lp-slides-wrap .slick-track {

}

.lp-slides-wrap .img-content {
    width: 100%;
    min-height: 190px;
    background-size: cover;
}
.lp-slide-item {
    margin: 0 16px;
}
.lp-slide-item h3 a {
    font-size: 24px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #f99400;
    margin: 24px 0;
    display: block;
}
.lp-slide-item h4 {
    font-size: 40px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #ffffff;
    margin: 0;
}
.lp-slide-item p {
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: 1.75;
    letter-spacing: normal;
    color: #b3b6b9;
    margin: 0 0;
}
.lp-shop-cta {
    padding-top: 24px;
}
.lp-shop-cta a {
    font-size: 16px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #ffffff;
    text-transform: uppercase;
    border-bottom: 2px solid #f99400;
    display: inline-block;
}

.lp-slides-wrap {
    padding-bottom: 80px;
}

.lp-slides-wrap button.slick-next.slick-arrow {
    position: absolute;
    bottom: 0;
    left: 52%;
    background-image: url(http://www.cookwithkenyon.com/wp-content/uploads/2019/06/right-grey-1.svg);
    font-size: 0;
    padding: 20px;
    background-color: transparent;
    border: 0;
    background-repeat: no-repeat;
}
.lp-slides-wrap button.slick-prev.slick-arrow {
    position: absolute;
    bottom: 0;
    left: 48%;
    font-size: 0;
    padding: 20px;
    background-color: transparent;
    border: 0;
    background-repeat: no-repeat;
    background-image: url(http://www.cookwithkenyon.com/wp-content/uploads/2019/06/left-grey.svg);
}
.lp-slides-wrap button.slick-next.slick-arrow:hover {
    background-image: url(http://www.cookwithkenyon.com/wp-content/uploads/2019/06/right.svg);
}
.lp-slides-wrap button.slick-prev.slick-arrow:hover {
    background-image: url(http://www.cookwithkenyon.com/wp-content/uploads/2019/06/left.svg);
}
</style>