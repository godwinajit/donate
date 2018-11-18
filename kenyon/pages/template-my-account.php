<?php

/*
Template Name: My Account Template
*/

get_header(); ?>

<div class="container">
	<?php if (have_posts()) : the_post(); ?>
    <div class="row">
        <div class="col-md-12">
            <?php if ( is_user_logged_in() ) the_title('<h1>', '</h1>'); ?>
        </div>
        <div class="clearfix"></div>
		<div class="col-md-12">
			<?php  the_content(); ?>
		</div>
    </div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>