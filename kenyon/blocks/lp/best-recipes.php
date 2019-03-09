<?php
$title = get_field('best_recipes_section_title');


$image1 = get_field('best_recipes_section_1_image');
$title1 = get_field('best_recipes_section_1_title');
$description1 = get_field('best_recipes_section_1_description');


$image2 = get_field('best_recipes_section_2_image');
$title2 = get_field('best_recipes_section_2_title');
$description2 = get_field('best_recipes_section_2_description');


$image3 = get_field('best_recipes_section_3_image');
$title3 = get_field('best_recipes_section_3_title');
$description3 = get_field('best_recipes_section_3_description');

?>


<div id="lp-third" class="lp-best-recipes" >
     <div class="container">
        <div class="row">

            <div class="best-recipes-section-title"><h2><?php echo $title; ?></h2></div>
            <div class="three-col-adjust-wrapper">
                <div class="three-col-adjust">
                    <div class="img-se" style="background-image:url('<?php echo $image1['url']; ?>');"></div>
                    <div class="lp-third-details"><h3><?php echo $title1; ?></h3>
                    <p><?php echo $description1; ?></p></div>
                </div>
                <div class="three-col-adjust">
                    <div class="img-se" style="background-image:url('<?php echo $image2['url']; ?>');"></div>
                    <div class="lp-third-details"><h3><?php echo $title2; ?></h3>
                    <p><?php echo $description2; ?></p></div>
                </div>
                <div class="three-col-adjust">
                    <div class="img-se" style="background-image:url('<?php echo $image3['url']; ?>');"></div>
                    <div class="lp-third-details"><h3><?php echo $title3; ?></h3>
                    <p><?php echo $description3; ?></p></div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css">
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script>
    jQuery(document).ready(function( $ ) {
        var breakpointMobile = 767;
        var isChanging = false;
        var isFiltered = false;

        $('.three-col-adjust-wrapper').on('init breakpoint', function(event, slick){
            if ( !isChanging ) {

                isChanging = true;

                if ( slick.activeBreakpoint && slick.activeBreakpoint <= breakpointMobile) {
                    if ( !isFiltered ) {
                        slick.slickFilter(':not(.video)');
                        isFiltered = true;
                    }
                } else {
                    if ( isFiltered ) {
                        slick.slickUnfilter();
                        isFiltered = false;
                    }
                }

                isChanging = false;
            }
        }).slick({
            slidesToShow: 1,
            responsive: [
                {
                    breakpoint: 9999,
                    settings: "unslick"
                },
                {
                    breakpoint: 767,
                    settings: {
                        dots: true,
                        arrows :false,
                        slidesToShow: 1,
                        centerMode: true
                    }
                }
            ]
        });
    });

</script>


<style type="text/css">
@media(max-width: 767px){

.three-col-adjust-wrapper .slick-list.draggable {
    padding: 0!important;
    width: calc(100% - 20px);
    margin: 0 auto;
}
body .three-col-adjust {
    margin: 0 auto;
    display: block;
}
body .three-col-adjust-wrapper {
    display: block;
    margin-right: 0;
    padding: 0 20px;
}
ul.slick-dots {
    margin: 0 auto;
    text-align: center;
    margin-top: 30px;
}
ul.slick-dots li {
    margin: 0 7px;
    display: inline-block;
    line-height: 1;
    font-size: 0;
}
ul.slick-dots li button {
    font-size: 0;
    border: 0;
    width: 16px;
    height: 16px;
    border-radius: 4px;
    cursor: pointer;
    background-color: rgba(179, 182, 185, 0.85);
}
ul.slick-dots li.slick-active button {
    background-color:  #8a8a8a;
}
ul.slick-dots li button:focus,
.slick-slide:focus,
.home-section-2>.two-col-section:focus {
    outline: none;
}

ul.slick-dots li button:focus,
.slick-slide:focus,
.three-col-adjust:focus {
    outline: none;
}
}
.three-col-adjust:focus {
    outline: none;
}
</style>