<?php

$video = get_field('youtube_video_link_id');

?>



<div id="lp-video" >
<div class="container">
                    <div class="row">
                        <div class="two-col-section intro<?php if($video){?> video <?php } ?>">
        <div class="video-sec">
            <iframe width="542" height="335" src="https://www.youtube.com/embed/<?php echo $video ?>" frameborder="0" allowfullscreen></iframe>
        </div>
</div>


</div>


</div>
</div>




