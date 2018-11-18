<?php get_header(); ?>

<div class="container">
    <?php while (have_posts()) : the_post(); ?>
    <div class="row">
        <?php the_title('<div class="col-md-12"><h1>', '</h1></div>'); ?>
        <div class="clearfix"></div>
        <?php

        $subnav = theme_sub_nav_menu(array(
            'main',
            'top',
            'footer_1',
            'footer_2',
            'bottom',
        ));

        if (!$subnav) : ?>
        <div class="col-md-12">
            <div id="content">
                <?php the_content(); ?>
            </div>
        </div>
        <?php else : ?>
            <div class="col-md-10 col-sm-9 col-md-push-2 col-sm-push-3">
                <div id="content">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-md-pull-10 col-sm-pull-9">
                <aside id="sidebar">
                    <?php echo $subnav ?>
                </aside>
            </div>
        <?php endif; ?>
    </div>
    <?php endwhile; ?>
</div>


<?php get_footer(); ?>