<?php

$image = get_field('background_image');
$title = get_field('description');
$linkh = get_field('shop_now_link');



?>
<div id="third" class="home-shop-section" >
     <div class="container">
        <div class="row">
    <div class="shop-text-block">
        <div class="shop-block-holder">
            <p><?php echo $title; ?></p>
            <a class="btn btn-default btn-lg" href="<?php echo $linkh; ?>">Shop Now</a>
        </div>
    </div>
   </div>
    </div>


  


    

</div>

      <style>


#third{
  background:url('<?php echo $image['url']; ?>') 50% 0 no-repeat fixed;
  color: white;
    height: 330px;  
  background-size: cover;
   display: flex;
    display: -webkit-flex;
    -webkit-flex-direction: column;
    flex-direction: column;
    justify-content: center;
    -webkit-justify-content: center;
    justify-content: center;
}






    </style>


<script type="text/javascript" src="//ianlunn.co.uk/plugins/jquery-parallax/scripts/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="//ianlunn.co.uk/plugins/jquery-parallax/scripts/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="//ianlunn.co.uk/plugins/jquery-parallax/scripts/jquery.scrollTo-1.4.2-min.js"></script>


  <script >
      jQuery(document).ready(function($){
  $('.bg').parallax("50%", 0.4);
  $('#third').parallax("50%", 0.3);

})

    </script>
