<?php

$linkh = get_field('gallery_page_link');



?>
<div class="home-insta-section" >
     <div class="container">
        <div class="row">
          <h2>#CookWithKenyon</h2>
          <p>Kenyon Electric Grills Indoor/Outdoor Electric Grills ⚾️Official Grill of the Boston Red Sox 🇺🇸Made in the USA Grilling season never ends when you <a href="#">#CookWithKenyon</a></p>

   </div>
    </div>

    <div class="insta-text-block">
        <div class="insta-block-holder">
            <div id="instafeed"></div>
            <a class="btn btn-default btn-lg" href="<?php echo $linkh; ?>">View full gallery</a>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/instafeed.js/1.4.1/instafeed.min.js"></script>

<script type="text/javascript">
var feed = new Instafeed({
get: 'user',
userId: '298567524',
accessToken:'298567524.9681520.81a6cffa3ea84b4585520fc19cc9e38f',
limit: 4,
resolution: 'standard_resolution'
});
feed.run();
</script>

<script>

setInterval(function(){
jQuery(function($) {
var images = $("#instafeed a").find("img");
$.each(images, function (index, item) {
var $item = $(item),
src = $item.attr('src'),
cont = $item.closest('#instafeed a').css('background-image', 'url(' + src + ')');
});
$("#instafeed a").attr("target", "_blank");
});
}, 3000);

</script>

  


    

</div>








