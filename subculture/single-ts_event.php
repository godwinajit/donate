<?php

get_template_part('blocks/events/related-events-ajax');

get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
    <?php get_template_part('blocks/events/filters') ?>
    
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    
    <div class="container">
        <article class="content-block">
            <div class="block-holder">
                <div class="row">
                	<?php get_template_part('blocks/events/single-content') ?>
                </div>
            </div>
        </article>
    </div>
    
    <?php //get_template_part('blocks/events/related-events') ?>
    
    <?php endwhile; endif; ?>
</div>


<?php get_footer(); ?>