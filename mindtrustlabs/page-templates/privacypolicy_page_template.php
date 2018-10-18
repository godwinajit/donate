<?php
/**
 * Template Name: Privacy Policy
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */ 
get_header(); ?>
<div class="top-section">
	<div class="video-section">
		<div class="holder inner">
			<div class="container">
				<div class="row">
					<h1>Privacy Policy</h1>
					<hr>
					<h2>We value your privacy.  Here's how.</h2>
				</div>
			</div>
		</div>
		<div class="video-frame">
			<div class="video-box hidden-xs" data-width="720" data-height="406">
				<video class="mejs-wmp" width="720" height="406" controls="none"
					preload="none"
					poster="<?php the_field('thumbnail_of_video'); ?>"
					autoplay="autoplay" loop="loop">
					<source src="<?php the_field('mp4_video_url'); ?>" />
					<source src="<?php the_field('webm_video_url'); ?>" />
					<source src="<?php the_field('ogv_video_url'); ?>" /> 
				</video>
			</div>
		</div>
	</div>
</div>
<main role="main" id="main">
		<section class="block">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
<p>
	Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.
</p>

<ul>
	<li>
		Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.
	</li>
	<li>
		We will collect and use of personal information solely with the objective of fulfilling those purposes specified by us and for other compatible purposes, unless we obtain the consent of the individual concerned or as required by law.		
	</li>
	<li>
		We will only retain personal information as long as necessary for the fulfillment of those purposes. 
	</li>
	<li>
		We will collect personal information by lawful and fair means and, where appropriate, with the knowledge or consent of the individual concerned. 
	</li>
	<li>
		Personal data should be relevant to the purposes for which it is to be used, and, to the extent necessary for those purposes, should be accurate, complete, and up-to-date. 
	</li>
	<li>
		We will protect personal information by reasonable security safeguards against loss or theft, as well as unauthorized access, disclosure, copying, use or modification.
	</li>
	<li>
		We will make readily available to customers information about our policies and practices relating to the management of personal information. 
	</li>
</ul>

<p>
	We are committed to conducting our business in accordance with these principles in order to ensure that the confidentiality of personal information is protected and maintained. 
</p>		

			
                       </div>
                 </div>
            </div>           
         </section>
<?php get_footer();	?>
