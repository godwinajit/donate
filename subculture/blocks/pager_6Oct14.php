<?php if (function_exists('wp_pagenavi')) : ?>
    <?php theme_pagenavi() ?>
<?php else : ?>
    <?php if (get_next_posts_link() || get_previous_posts_link()) : ?>
        <div class="text-center">
            <ul class="pagination">
                <?php if (get_previous_posts_link()) : ?>
                    <li><?php previous_posts_link(__('&laquo; Newer Entries', 'kenyon')) ?></li>
                <?php endif; ?>
                <?php if (get_next_posts_link()) : ?>
                <li><?php next_posts_link(__('Older Entries &raquo;', 'kenyon')) ?></li>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>
<?php endif; ?>