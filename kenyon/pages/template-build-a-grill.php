<?php

/*
Template Name: Build a Grill Template
*/


get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (have_posts()) : the_post(); ?>
            <section class="build-section" data-target="<?php echo add_query_arg('ajax', 'steps'); ?>">
                <h1><?php the_title() ?></h1>
                <div class="step-list-wrap">
                    <ul class="step-list">
                        <li rel="finish"><a href="<?php echo add_query_arg('ajax', 'result'); ?>" class="holder">Finish</a></li>
                    </ul>
                </div>
                <div class="step-content">
                    <div class="build-block ajax-holder" id="finish"></div>
                </div>
            </section>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php get_footer(); ?>