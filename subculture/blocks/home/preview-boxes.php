<section class="container preview-boxes">
    <div class="row">
		<?php $boxes = get_field('boxes',$post->ID); ?>
		<?php if($boxes): ?>
    	<?php foreach($boxes as $box): ?>
        <article class="box col-sm-4">
            <div class="box-holder">
                <?php if($box['box_title']): ?><h2><?php echo $box['box_title']; ?></h2><?php endif; ?>
                <div class="visual">
                    <?php if($box['box_image']): ?>
                    <a href="<?php if($box['box_image_link']): echo filter_site_url($box['box_image_link']); else: echo '#'; endif; ?>">
                    	<?php echo wp_get_attachment_image($box['box_image'], 'home-boxes-374x230');?>
                     </a>
                    <?php endif; ?>
                    
                    <?php $box_short_info = $box['box_short_info'] ;
					      $box_date = $box['box_date']; ?>
                    
                    <?php if($box_short_info): ?>
                    <div class="description">
                        <?php if($box_short_info): ?><span class="name"><?php echo $box_short_info; ?></span><?php endif; ?>
                        <?php if($box_date): ?><time datetime="2014-05-25" class="date"><?php echo $box_date; ?></time ><?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
