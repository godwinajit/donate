<?php

theme_wrapper_class('contacts');

get_header(); ?>

<?php if (have_posts()) : the_post(); ?>

    <?php get_template_part('blocks/header/header-image') ?>

    <div class="main-holder">
        <div class="container">
			<?php get_template_part('blocks/page/gallery'); ?>
			
            <div class="row">
                <section class="contact-section">
                    <div class="col-sm-12">
                        <div class="boxes">
                            <?php the_content() ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php get_footer(); ?>