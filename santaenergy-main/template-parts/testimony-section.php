<?php
	if( have_rows('testimony_list') ):
?>
<section class="testimonials color-blue mt-80">
  <div class="container">
    <div class="headline icon-logo text-center">
      <h2><?php the_field('testimony_section_title'); ?></h2>
    </div>
    <div class="row gap-54 mobile-gallery">
	<?php
		while ( have_rows('testimony_list') ) : the_row();
	?>
      <div class="col-md-4">
        <blockquote cite="#" class="quotes">
          <div class="quote-area icon-quotes">
            <?php the_sub_field('testimony_content'); ?>
          </div>
          <cite><?php the_sub_field('testimony_title'); ?></cite>
        </blockquote>
      </div>
	<?php
		endwhile;
	?>
    </div>
  </div>
</section>
<?php
	endif;
