<?php
include ('../../wp-load.php');
?>

<?php //get_header();?>
	<?php get_template_part( 'ambassadorheader' ); ?>
<main class="main maxwidth-100">
<div class="breadcrumbs">
	<div class="wrapper container-fluid">
		<div class="row center-xs">
			<div class="col-xs-10">
				<ul class="breadcrumbs-nav">
					<li><a href="https://globallymealliance.org/">Home</a></li>
					<li>Ambassador program</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="inner-banner"
	style="background-image: url(images/ambassador-hero2.jpg)"></div>
<div class="container-section" style="display:none;">
					<div class="wrapper container-fluid">
		<div class="row center-xs">
			<div class="col-xs-12 col-sm-11 col-md-10">
				<div class="page-title" id="page-title">
								<h2 class="row"
						style="color: green !important; text-align: center;">
						<strong>Thank you for your application to become a Lyme Education Ambassador. A representative from GLA will follow up within the next two weeks.</strong>
					</h2>
                                </div>
			</div>
		</div>
	</div>				
                </div>
</main>
<!-- Subscribe CTA 
<section class="section-subscribe">
	<div class="wrapper container-fluid">
		<div class="row center-xs">
			<div class="col-xs-12 col-sm-11 col-md-10">
				<div class="subscribe-form">
					<span class="icon icon-mail sm-visible"></span>
					<h2><?php echo get_field('educational_pages_newsletter_text', 4185); ?></h2>
					<div class="form-row">
	                                         <?php echo do_shortcode('[ctct form="7979"]'); ?> 
                                    </div>
				</div>
			</div>
		</div>
	</div>
</section> -->
<a class="btn btn-default open-lightbox" title="" href="#popup-widget2" style="display:none;"></a>
<div class="popup-holder">
		<div class="lightbox lightbox-download" id="popup-widget2">
		Thank you for your application to become a Lyme Education Ambassador.<br> A representative from GLA will follow up within the next two weeks.
	</div>
</div>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="/ambassador/app/js/main.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //$(".open-lightbox").fancybox().trigger('click');
		$('.open-lightbox').fancybox({
			afterClose: function () {
				window.location.href = "/";
	        }
		}).trigger('click');
    });
</script>
<?php get_template_part( 'ambassadorfooter' ); ?>
