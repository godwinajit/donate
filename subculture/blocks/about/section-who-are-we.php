<?php

$title = get_sub_field('title');
$sub_title = get_sub_field('sub-title');
$staff = get_sub_field('staff');

?>

<?php if ($title || $sub_title || $staff) : ?>
<section class="info-section">
    <div class="container">
        <div class="row">
            <div class="text-holder">
                <?php if ($title) : ?>
                <h1><?php echo $title ?></h1>
                <?php endif; ?>

                <?php if ($sub_title) : ?>
                <strong class="slogan"><?php echo $sub_title ?></strong>
                <?php endif; ?>

                <?php if ($staff) : ?>
                <ul class="about-list">
                    <?php foreach ($staff as $employee) : ?>
                    <li>
                        <?php /*?><?php if (isset($employee['name']) && !empty($employee['name'])) : ?>
                        <h2><?php echo $employee['name'] ?></h2>
                        <?php endif; ?>

                        <?php if (isset($employee['position']) && !empty($employee['position'])) : ?>
                            <h3><?php echo $employee['position'] ?></h3>
                        <?php endif; ?><?php */?>

                        <?php if (isset($employee['description']) && !empty($employee['description'])) : ?>
                            <?php echo $employee['description'] ?>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <!--<div class="btn-detail-holder btn-detail">Team bios coming soon</div>-->
            </div>
        </div>
    </div>
</section>
<?php endif; ?>