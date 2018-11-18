<?php

$image = get_field('column_1_image');
$title = get_field('column_1_title');
$description = get_field('column_1_description');
$video = get_field('youtube_video_id');
$image3 = get_field('column_3_image');
$title3 = get_field('column_3_title');
$description3 = get_field('column_3_description');
$image4 = get_field('column_4_image');
$title4 = get_field('column_4_title');
$description4 = get_field('column_4_description');

?>



<div class="visible-mobile" style="display: none;">
    <div class="two-col-section intro<?php if($video){?> video<?php } ?>">
        <div class="video-sec">
            <iframe width="542" height="335" src="https://www.youtube.com/embed/<?php echo $video ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div class="container">
                    <div class="row">
<div class="home-section-2">
<div class="two-col-section ">
    <?php if ($image) : ?>
	<a href="<?php echo get_field('column_1_link'); ?>">
    <div class="img-content" style="background-image:url('<?php echo $image['url']; ?>');">
       
    </div>
	</a>
    <?php endif; ?>

   
    <div class="text-block">
        <div class="section-2-content">
            <h2><a href="<?php echo get_field('column_1_link'); ?>"><?php echo $title; ?></a></h2>
            <p><?php echo $description; ?></p>
        </div>

    </div>
   
</div>

<div class="two-col-section intro<?php if($video){?> video <?php } ?>">
        <div class="video-sec">
            <iframe width="542" height="335" src="https://www.youtube.com/embed/<?php echo $video ?>" frameborder="0" allowfullscreen></iframe>
        </div>
</div>

<div class="two-col-section">
    <?php if ($image) : ?>
	<a href="<?php echo get_field('column_3_link'); ?>">
    <div class="img-content" style="background-image:url('<?php echo $image3['url']; ?>');">
       
    </div>
	</a>
    <?php endif; ?>

   
    <div class="text-block">
        <div class="section-2-content">
            <h2><a href="<?php echo get_field('column_3_link'); ?>"><?php echo $title3; ?></a></h2>
            <p><?php echo $description3; ?></p>
        </div>

    </div>
   
</div>



<div class="two-col-section ">
    <?php if ($image) : ?>
	<a href="<?php echo get_field('column_4_link'); ?>">
    <div class="img-content" style="background-image:url('<?php echo $image4['url']; ?>');">
       
    </div>
	</a>
    <?php endif; ?>

   
    <div class="text-block">
        <div class="section-2-content">
          <h2><a href="<?php echo get_field('column_4_link'); ?>"><?php echo $title4; ?></a></h2>
            <p><?php echo $description4; ?></p>
        </div>

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

		$('.home-section-2').on('init breakpoint', function(event, slick){
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
			slidesToShow: 5,
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
						centerMode: true,
						centerPadding: '15%'
					}
				}
			]
		});
	});

</script>


<style type="text/css">
@media(max-width: 767px){
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
body .visible-mobile {
    display: block!important;
    padding: 30px 20px 0;
}
.visible-mobile iframe,
.home-section-2 iframe {
    height: auto!important;
}
.visible-mobile iframe {
    width: 100%;
}

.slick-initialized .slick-slide {
    margin: 0 10px;
}
.two-col-section .text-block {
    display: none;
}
.slick-slide[aria-hidden="false"] .text-block {
    display: block;
}

}
ul.slick-dots li button:focus,
.slick-slide:focus,
.home-section-2>.two-col-section:focus {
    outline: none;
}
</style>