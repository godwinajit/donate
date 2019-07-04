<?php

$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$content = get_sub_field('content');
$gallery = get_sub_field('gallery');

?>

<?php if ($title || $sub_title || $content || $gallery) : ?>
<section class="info-section">
    <div class="container">
        <div class="row">
            <?php if ($title || $sub_title || $content) : ?>
            <div class="text-holder">
                <h1><?php echo $title ?></h1>
                <strong class="slogan"><?php echo $sub_title ?></strong>
                <?php echo $content ?>
            </div>
            <?php endif; ?>

            <?php if (is_array($gallery) && count($gallery)) : ?>
            <div class="img-gallery">
                <?php while (is_array($gallery) && count($gallery)) : ?>
                    <?php if ($image = array_shift($gallery)) :  ?>
                    <div class="col-sm-8 box">
                        <?php theme_gallery_image($image, '750x484') ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($image = array_shift($gallery)) :  ?>
                    <div class="col-sm-4 box">
                        <?php theme_gallery_image($image, '360x484') ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($image = array_shift($gallery)) :  ?>
                    <div class="col-sm-6 box double-image">
                        <?php theme_gallery_image($image, '557x360') ?>
                        <?php if ($image = array_shift($gallery)) :  ?>
                            <?php theme_gallery_image($image, '557x364') ?>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($image = array_shift($gallery)) :  ?>
                    <div class="col-sm-6 box">
                        <?php theme_gallery_image($image, '556x745') ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($image = array_shift($gallery)) :  ?>
                    <div class="col-sm-4 box">
                        <?php theme_gallery_image($image, '360x484') ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($image = array_shift($gallery)) :  ?>
                    <div class="col-sm-8 box">
                        <?php theme_gallery_image($image, '750x484') ?>
                    </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>