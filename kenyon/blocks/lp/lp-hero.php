<?php

$image = get_field('hero_section_background_image');
$title = get_field('hero_section_title');
$descr = get_field('hero_section_description');



?>
<div class="lp-hero-section" style="background-image:url('<?php echo $image['url']; ?>');">
	<div class="container">
        <div class="row">
  	<div class="lp-text-block">
        <div class="lp-block-holder">
            <h1><?php echo $title; ?></h1>
            <p><?php echo $descr; ?></p>
                    </div>
    </div>
        </div>
    </div>

  
  


    

</div>


