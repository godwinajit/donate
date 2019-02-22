<?php
$cta_desktop_image = get_field('call_to_action_background');
$cta_desktop_image_size = 'santa-main-thumb-1439-480';

$cta_mobile_image_size = 'santa-main-thumb-640-960';
if($cta_desktop_image){
?>
<section class="promo fs-md bg-image color-blue" id="cta-section">
  <div class="bg-stretch">
    <?php if( $cta_desktop_image ) {?>
		<span data-srcset="<?php echo $cta_desktop_image['sizes'][ $cta_desktop_image_size ];?>"></span>
	<?php }?>

	<?php if( $cta_desktop_image ) {?>
		<span data-srcset="<?php echo $cta_desktop_image['sizes'][ $cta_mobile_image_size ];?>" data-media="(max-width: 480px)"></span>
	<?php }?>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-9 col-sm-6">
        <h2><?php the_field('call_to_action_title'); ?></h2>
        <?php the_field('call_to_action_content'); ?>
        <div class="actions">
          <a href="<?php the_field('call_to_action_link'); ?>" class="button button-red button-lg" <?php echo trim(get_field('select_form_option')) ? 'data-selectval="'.trim(get_field('select_form_option')).'"' : '';?>><?php the_field('call_to_action_button_text'); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
}
