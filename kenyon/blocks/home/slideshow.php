<?php if (have_rows('slides')) : ?>
<div  id="carousel" class="carousel slide" data-ride="carousel" data-interval="<?php echo (intval(get_field('slideshow_interval')) * 1000); ?>">
    <div class="carousel-inner">
        <?php $count=0;  while (have_rows('slides')) : the_row(); $count++; ?>
        <div class="item<?php theme_print_once(' active', 'slideshow'); ?>">
            <div class="image">
                <?php echo wp_get_attachment_image(get_sub_field('image'), 'homepage-slideshow'); ?>
            </div>
            <div class="carousel-caption">
                <?php
                    $title = get_sub_field('title');
                    $sub_title = get_sub_field('sub-title');
					$link = get_sub_field('link');
                if ($title || $sub_title) : ?>
                <strong class="title">
					<?php if ($link) : ?>
						<a href="<?php echo $link; ?>">
					<?php endif; ?>
					
					<span><?php echo $sub_title ?></span> <?php echo $title ?>
					
					<?php if ($link) : ?>
						</a>
					<?php endif; ?>
					
				</strong>
                <?php endif; ?>

                <?php if ($description = get_sub_field('description')) : ?>
                <div class="text-block">
					<?php if ($link) : ?>
						<a href="<?php echo $link; ?>">
					<?php endif; ?>

						<?php echo apply_filters('the_content', $description); ?>
						
					<?php if ($link) : ?>
						</a>
					<?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <ol class="carousel-indicators">
    <?php for($i=0; $i<$count; $i++){ ?>
        <li <?php echo $i ? '' : ' class="active"' ?> data-slide-to="<?php print $i; ?>" data-target="#carousel"></li>
    <?php } ?>
    </ol>
</div>
<?php endif; ?>