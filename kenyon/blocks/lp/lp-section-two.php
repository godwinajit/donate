<?php

$image = get_field('product_image');
$title = get_field('product_title');
$description = get_field('product_description');

?>




<div class="lp-section-2">
<div class="container">
                    <div class="row">

<div class="lp-two-col-section ">
  

   
    <div class="text-block">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $description; ?></p>
        

    </div>
   
</div>

<div class="lp-two-col-section ">
  <?php if ($image) : ?>
    <div class="lp-img-content" style="background-image:url('<?php echo $image['url']; ?>');">
       
    </div>
    
    <?php endif; ?>
</div>









</div>

</div>


</div>



