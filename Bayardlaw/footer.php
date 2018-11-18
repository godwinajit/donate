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
?><footer id="footer">

		<div class="footer-panel">
			<div class="container">
					<?php  if ( is_active_sidebar( 'news_letter' ) ) : 
								dynamic_sidebar( 'news_letter' );
						 endif;
						 ?>
			</div>
		</div>
			 
			 
		<div class="footer-section">
			<div class="container">
				<div class="row">
					<div class="logo-col col-lg-2">
						<a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-big.png" height="218" width="694" alt=""></a>
					</div>
					<div class="col-lg-10">
						<div class="footer-columns">
							<div class="holder">
								<div class="col">
									<?php  if ( is_active_sidebar( 'sidebar-8' ) ) : 
									   dynamic_sidebar( 'sidebar-8' );							
									 endif;?>	
								</div>
								<div class="col">
									<nav class="footer-nav">
									<?php  if ( is_active_sidebar( 'sidebar-4' ) ) : 
									   dynamic_sidebar( 'sidebar-4' );							
									 endif;?>									
									</nav>
								</div>
								<div class="col">
									<nav class="footer-nav">
										<?php  if ( is_active_sidebar( 'sidebar-5' ) ) : 
									   dynamic_sidebar( 'sidebar-5' );							
									 endif;?>
									</nav>
								</div>
								<div class="col">
									<nav class="footer-nav">
										<?php  if ( is_active_sidebar( 'sidebar-6' ) ) : 
									   dynamic_sidebar( 'sidebar-6' );							
									 endif;?>
									</nav>
									<div class="social-box">
										<?php  if ( is_active_sidebar( 'sidebar-7' ) ) : 
									   dynamic_sidebar( 'sidebar-7' );							
									 endif;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row copyright-row text-center">
					<div class="col-xs-12">
						<?php  if ( is_active_sidebar( 'sidebar-9' ) ) : 
									   dynamic_sidebar( 'sidebar-9' );							
									 endif;?>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<script type='text/javascript'>
(function (d, t) {
  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=etaysxa0gox4x73d2szifw';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script');
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.main.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.confirm.min.js"></script>
<?php 
if($_REQUEST['_mc4wp_form_submit']){
	?>
		 	<script type="text/javascript">
		 	$(document).ready(function() {
		 	 	$('html, body').animate({
		        	 scrollTop: $("#footer").offset().top
		     	}, 1000);
		 	});
		 	</script>
		 	<?php 
}
wp_footer();
?>
</body>
</html>