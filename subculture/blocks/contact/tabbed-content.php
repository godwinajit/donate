<?php if (have_rows('tabs')) : ?>
<div class="col-sm-12">
    <div class="contact-block">
        <div class="holder">
            <?php while (have_rows('tabs')) : the_row(); ?>
            <div class="open-close">
                <a href="#" class="opener"><span><?php the_sub_field('title') ?></span></a>
                <div class="slide">
                    <div class="slide-content">
                        <?php the_sub_field('content') ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php endif; ?>