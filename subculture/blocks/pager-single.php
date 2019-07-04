<?php if (get_next_post_link() || get_previous_post_link()) : ?>
    <div class="text-center">
        <ul class="pagination">
            <?php if (get_next_post_link()) : ?>
                <li><?php next_post_link('%link', '&laquo; %title') ?></li>
            <?php endif; ?>
            <?php if (get_previous_post_link()) : ?>
                <li><?php previous_post_link('%link', '%title &raquo;') ?></li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>