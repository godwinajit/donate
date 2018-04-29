<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<!-- footer starts here -->
<footer id="colophon" class="site-footer" role="contentinfo">
 <div class="main">
  <?php $footer_image = get_field('footer_image' , 'options');
	$footer_text = get_field('footer_text' , 'options');
		echo $footer_text;
	 ?>
  </div>
</footer>
<!-- #colophon -->
<div class="preload"> <img src="<?php echo get_template_directory_uri(); ?>/images/minus.png" alt="Preload" /> </div>
</div>
<!-- #page -->
<?php //get_sidebar( 'main' ); ?>
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/css_browser_selector.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.equalheight.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/placeholder.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.selectbox-0.2.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.magnific-popup.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/menu.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/general.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.screwdefaultbuttonsV2.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/main.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/jquery.openclose.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/jquery.accordion.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/retina-cover.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/pie-chart.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/steps.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/enquire.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/src/_plugins/custom-forms.js" type="text/javascript"></script>








<script type="text/javascript">
$(window).load(function(e) {
    if($(".wp-social-login-provider-facebook").length){
		$(".wp-social-login-provider-facebook img").attr('src',"<?php echo get_template_directory_uri(); ?>/images/comment-fb.png");
	}
	if($(".wp-social-login-provider-twitter").length){
		$(".wp-social-login-provider-twitter img").attr('src',"<?php echo get_template_directory_uri(); ?>/images/comment-tw.png");
	}
	if($(".wp-social-login-provider-google").length){
		$(".wp-social-login-provider-google img").attr('src',"<?php echo get_template_directory_uri(); ?>/images/comment-gplus.png");
	}
});
</script>
<!-- Constant Contact Start -->
<script type='text/javascript'>
   var localizedErrMap = {};
   localizedErrMap['required'] = 		'This field is required.';
   localizedErrMap['ca'] = 			'An unexpected error occurred while attempting to send email.';
   localizedErrMap['email'] = 			'Please enter your email address in name@email.com format.';
   localizedErrMap['birthday'] = 		'Please enter birthday in MM/DD format.';
   localizedErrMap['anniversary'] = 	'Please enter anniversary in MM/DD/YYYY format.';
   localizedErrMap['custom_date'] = 	'Please enter this date in MM/DD/YYYY format.';
   localizedErrMap['list'] = 			'Please select at least one email list.';
   localizedErrMap['generic'] = 		'This field is invalid.';
   localizedErrMap['shared'] = 		'Sorry, we could not complete your sign-up. Please contact us to resolve this.';
   localizedErrMap['state_mismatch'] = 'Mismatched State/Province and Country.';
	localizedErrMap['state_province'] = 'Select a state/province';
   localizedErrMap['selectcountry'] = 	'Select a country';
   var postURL = 'https://visitor2.constantcontact.com/api/signup';
</script>
<script type='text/javascript' src='https://static.ctctcdn.com/h/contacts-embedded-signup-assets/1.0.2/js/signup-form.js'></script>
<!-- Constant Contact Start -->
</body></html>