<?php

$title = get_sub_field('title');
$columns = get_sub_field('columns');

if ($columns) :

    switch (count($columns)) {
        case 1:
            $md_width = '12';
            $sm_width = '12';
            break;
        case 2:
            $md_width = '6';
            $sm_width = '6';
            break;
        case 3:
            $md_width = '4';
            $sm_width = '6';
            break;
        case 4:
            $md_width = '3';
            $sm_width = '6';
            break;
        default:
            $md_width = '6';
            $sm_width = '6';
    }

?>
<div class="container">
    <aside class="contact-block">
        <?php if ($title) : ?>
        <h2><?php echo $title; ?></h2>
        <?php endif; ?>

        <div class="row">
            <?php theme_print_each(); ?>
            <?php foreach ($columns as $column) : ?>
                <?php theme_print_each(2, '<div class="clearfix visible-sm"></div>'); ?>
                <div class="col-md-<?php echo $md_width ?> col-sm-<?php echo $sm_width ?>">
                    <?php if ($column['title']) : ?>
                    <h3><?php echo $column['title'] ?></h3>
                    <?php endif ?>

                    <?php echo $column['content'] ?>
                </div>
            <?php endforeach; ?>
        </div>
    </aside>
</div>
<?php endif; ?>