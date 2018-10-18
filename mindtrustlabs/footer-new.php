<div class="subscribe-block">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-push-1 subscribe-form">
				<h3>Get insights and pro tips sent to your inbox</h3>
								<script charset="utf-8" src="//js.hsforms.net/forms/current.js"></script>
<script>
  hbspt.forms.create({
    portalId: '441110',
    formId: '58025002-d16f-41b0-b879-e6eaa95accd2',
	css:'',
	validationOptions: {
        validation: {
        	inputValidate: {
                matcher: 'input[type="email"]',
                errorMessages: 'Please enter a valid email address.',
                validator: function($inputElement, inputValue) {
                  // some logic that returns true or false
                  if( inputValue.length === 0 ) {
                	  return false;
    				}  else {
						return true;
					}
                }
            }
  		}
	}
  });

</script>

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
	<div class="popup-holder">
		<div id="popup-work-1" class="lightbox-work">
			<div class="popup-main">
				<div class="text-block">
					<h3>CVS Health</h3>
					<ul class="list-inline">
						<li>Email</li>
						<li>Conversion Rate Optimization</li>
					</ul>
				</div>
			</div>
			<div class="img-holder">
				<img src="<?php echo get_template_directory_uri () ?>/images/img-cvs-health-2.jpg" width="949" height="550" alt="#">
			</div>
		</div>
		<div id="popup-work-2" class="lightbox-work">
			<div class="popup-main">
				<div class="text-block">
					<h3>Datto</h3>
					<ul class="list-inline">
						<li>Video</li>
						<li>Web Development</li>
						<li>Marketing Automation</li>
					</ul>
				</div>
			</div>
			<div class="video-holder">
				<img src="<?php echo get_template_directory_uri () ?>/images/img-datto-wirh-button.jpg" width="946" height="546" alt="#">
				<a href="#" data-src="https://player.vimeo.com/video/112072608?autoplay=1" class="btn-play"></a>
				<iframe src="" width="946" height="546" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
			<div class="img-holder">
				<img src="<?php echo get_template_directory_uri () ?>/images/DattoLightbox.jpg" width="948" height="2197" alt="#">
			</div>
		</div>
		<div id="popup-work-3" class="lightbox-work">
			<div class="popup-main">
				<div class="text-block">
					<h3>Shell</h3>
					<ul class="list-inline">
						<li>Web Design &amp; Development</li>
						<li>Social Media</li>
						<li>Conversion Rate Optimization</li>
					</ul>
				</div>
			</div>
			<div class="img-holder">
				<img src="<?php echo get_template_directory_uri () ?>/images/Shell_Lightbox.jpg" width="949" height="550" alt="#">
			</div>
		</div>
		<div id="popup-work-4" class="lightbox-work">
			<div class="popup-main">
				<div class="text-block">
					<h3>Level 3</h3>
					<ul class="list-inline">
						<li>Web Design &amp; Development</li>
					</ul>
				</div>
			</div>
			<div class="img-holder opacity">
				<img src="<?php echo get_template_directory_uri () ?>/images/img-level3-2.jpg" width="949" height="550" alt="#">
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri ()?>/js/jquery-1.11.1.min.js"><\/script>')</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri ()?>/js/mediaelement-and-player.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri ()?>/js/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri ()?>/js/jquery.main.js"></script>
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
</body>
</html>
