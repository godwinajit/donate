<div class="subscribe-block">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-push-1 subscribe-form">
				<h3>Get insights and pro tips sent to your inbox</h3>
<!--[if lte IE 8]>
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
<![endif]-->
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
<script>
  hbspt.forms.create({ 
    css: '',
    portalId: '441110',
    formId: 'ceb5b192-ba0d-4033-b98e-1773d2cc3bf6'
  });
</script>





				<!--<form action="#" class="subscribe-form">
					<fieldset>
						<div class="form-group">
							<input type="email" class="form-control"
								placeholder="Your email address...">
							<button type="submit" class="btn btn-default btn-subscribe">subscribe</button>
						</div>
					</fieldset>
				</form>-->
			</div>
		</div>
	</div>
</div>
</main>
<footer id="footer">
		<div class="container">
			<div class="row">
				<?php dynamic_sidebar( 'sidebar-bottommenu' ); ?>
				<div class="col-sm-4">
					<div class="holder">
					<?php dynamic_sidebar( 'sidebar-career' ); ?>					
					</div>
				</div>
			</div>
			
		</div>
	</footer>
	<?php if(is_page('about')){
           echo ('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>'); 
        } ?>
	<?php wp_footer();?>
	
	<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri () ?>/js/jquery-1.11.1.min.js"><\/script>')</script>
	<script type="text/javascript">
	if (navigator.userAgent.match(/IEMobile\/10\.0/) || navigator.userAgent.match(/MSIE 10.*Touch/)) {
		var msViewportStyle = document.createElement('style')
			msViewportStyle.appendChild(
				document.createTextNode(
					'@-ms-viewport{width:auto !important}'
				)
			)
			document.querySelector('head').appendChild(msViewportStyle)
		}
</script>
<script src="<?php echo get_template_directory_uri ()?>/js/jquery.timelinr-0.9.54.js"></script>
<script>
		jQuery(function(){
			jQuery().timelinr({
				arrowKeys: 'true'
			})
		});
	</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="<?php echo get_template_directory_uri ()?>/js/acf.js"></script>
</div>
</body>
</html>