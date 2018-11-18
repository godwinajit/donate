<?php

$title = get_sub_field('title');
$columns = get_sub_field('columns');

if ($columns) :

switch (count($columns)) {
    case 1:
        $sm_width = '12';
        break;
    case 2:
        $sm_width = '6';
        break;
    case 3:
        $sm_width = '4';
        break;
    case 4:
        $sm_width = '3';
        break;
    default:
        $sm_width = '6';
}

?>
<section class="dealers-holder">
    <div class="container">
        <?php if ($title) : ?>
        <header class="heading">
            <h1><?php echo $title ?></h1>
        </header>
        <?php endif; ?>

        <div class="row">
            <?php theme_print_each(); ?>
            <?php foreach ($columns as $column) : ?>
                <div class="col-sm-<?php echo $sm_width ?>">
                    <?php if ($column['image']) : ?>
                    <div class="image-block">
                        <div class="holder">
                            <?php if ($column['link']) : ?>
                            <a href="<?php echo $link ?>">
                            <?php endif ?>
                                <?php echo wp_get_attachment_image($column['image'], 'about-awards-logo') ?>
                            <?php if ($column['link']) : ?>
                            </a>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php echo $column['text'] ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<?php endif; ?>