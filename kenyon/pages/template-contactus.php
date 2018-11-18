<?php

/*
Template Name: Contact Us Template
*/

wp_enqueue_script('kenyon-google-maps', 'http://maps.google.com/maps/api/js?v=3.exp&sensor=false&language=en', array('jquery'));

get_header(); ?>

<div class="img-section contacts-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2><?php the_title(); ?></h2>
            </div>
            <div class="clearfix"></div>
			<?php while (have_rows('contact_us_all_fields')) : the_row(); ?>
            	<?php  get_template_part('blocks/contactus/section', get_row_layout()) ?>
            <?php endwhile; ?>
        </div>
		<?php if ($form = get_field('contact_form')) : ?>
		<div class="row">
			<div class="col-xs-12">
				<section class="contact-form">
					<?php echo $form; ?>
				</section>
			</div>
		</div>
		<?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>