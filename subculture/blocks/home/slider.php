<?php if ($images = get_field('slideshow')) : ?>
<div class="carousel">
    <div class="mask">
        <div class="slideset">
            <?php foreach ($images as $image) : ?>
            <div class="slide">
                <div class="img-w">
                    <div class="img-w1">
                        <div class="img-w2">
                            <?php echo wp_get_attachment_image($image['id'], 'home-slideshow') ?>
                        </div>
                    </div>
                </div>
                <div class="title-holder">
                    <div class="title-frame">
                        <strong class="title"><?php echo $image['title']; ?></strong>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="btn-holder">
        <div class="btn-frame">
            <a class="btn-prev" href="#"><?php _e('Prev', 'subculture') ; ?></a>
            <a class="btn-next" href="#"><?php _e('Next', 'subculture') ; ?></a>
        </div>
    </div>
</div>
<?php endif; ?>
<nav class="breadcrumbs"></nav>