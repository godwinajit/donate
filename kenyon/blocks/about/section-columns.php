<?php

$columns = get_sub_field('columns');

if ($columns) : ?>
<div class="container">
    <div class="row">
        <ul class="history-info">
            <?php foreach ($columns as $column) : ?>
            <li>
                <?php if ($column['title']) : ?>
                <h2><?php echo $column['title'] ?></h2>
                <?php endif ?>

                <?php echo $column['text'] ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif ?>