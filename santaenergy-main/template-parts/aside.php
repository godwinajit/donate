<?php
/**
 * The aside for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package santaenergy-main
 */

?>
<?php
	get_template_part( 'template-parts/service', 'section' );
?>
<?php
	get_template_part( 'template-parts/cta', 'section' );
?>
<?php
	get_template_part( 'template-parts/testimony', 'section' );
?>
<?php
if(get_field('quote_form_shortcode')){
?>
<section id="section-form" class="form-get mt-80 bg-gray">
  <div class="container container-wider">
    <div class="row">
      <div class="col-md-4 col-lg-3">
        <div class="section-header icon-logo">
          <h2><?php the_field('quote_title'); ?></h2>
          <?php the_field('quote_content'); ?>
        </div>
      </div>
      <div class="col-md-8 offset-lg-1">
        <div class="contact-form"><?php echo do_shortcode( get_field('quote_form_shortcode') ); ?></div>
      </div>
    </div>
  </div>
</section>
<?php }?>
<section id="news-section" class="news-section bg-darkblue">
	<?php get_template_part('template-parts/latestNewsPosts'); ?>
</section>
