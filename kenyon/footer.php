            <!-- <?php get_template_part('blocks/footer/button'); ?> -->
		</main>
	




<footer id="footer">
			<div class="footer-holder">
				<div class="container">
					<div class="row">
                        <?php get_template_part('blocks/footer/menu'); ?>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-6 col-sm-6 footer-contact-us">
							<strong class="title"><?php _e('Connect with us', 'kenyon') ;?></strong>

                            <?php get_template_part('blocks/footer/newsletter'); ?>

                            <?php get_template_part('blocks/social-links'); ?>
						</div>

                        <?php get_template_part('blocks/footer/contact-us'); ?>
					</div>
				</div>
			</div>
            <?php if(has_nav_menu('bottom')) : ?>
			<div class="footer-frame">
				<div class="container">
                    <?php wp_nav_menu( array(
                        'container' => false,
                        'fallback_cb' => false,
                        'theme_location' => 'bottom',
                        'items_wrap' => '<ul class="footer-list">%3$s</ul>',
                        'depth' => 1,
                    )); ?>
				</div>
			</div>
            <?php endif; ?>
		</footer>
	</div>
	<?php wp_footer(); ?>




	</div>
	<?php wp_footer(); ?>
</body>
</html>