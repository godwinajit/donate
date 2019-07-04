<?php

$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$content = get_sub_field('content');
$image = get_sub_field('image');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link');

global $section_counter; $section_counter++; 
?>

<?php if ($title || $sub_title || $content || $image || $button_link) : ?>
<section class="section" id="section<?php echo $section_counter; ?>">
    <?php if ($title || $sub_title || $content) : ?>
    <div class="container">
        <div class="row">
            <div class="text-holder">
                <?php if ($title) : ?>
                <h1><?php echo $title ?></h1>
                <?php endif; ?>

                <?php if ($sub_title) : ?>
                <strong class="title"><?php echo  $sub_title ?></strong>
                <?php endif; ?>

                <?php echo $content ?>

                <?php if ($button_link) : ?>
                <div class="btn-detail-holder">
                    <a href="<?php echo $button_link ?>" class="btn-detail"><?php echo $button_text ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($image) : ?>
    <div class="bg-stretch">
        <?php echo wp_get_attachment_image($image, '1925px') ?>
    </div>
    <?php endif; ?>
</section>
<?php endif; ?>