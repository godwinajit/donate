<?php
/**
 * Template Name: Legal Stuff
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */
get_header(); ?>
<div class="top-section contact">
	<div class="video-section">
		<div class="holder inner">
			<div class="container">
				<div class="row">
					<h1>Mindtrustlabs Legal Stuff</h1>
					<hr>
				</div>
			</div>
		</div>
		<div class="video-frame">
			<div class="video-box" data-width="720" data-height="406">
				<video class="mejs-wmp" width="720" height="406" controls="none"
					preload="none" poster="<?php the_field('thumbnail_of_video'); ?>"
					autoplay="autoplay" loop="loop">
					<source src="<?php the_field('mp4_video_url'); ?>" />
					<source src="<?php the_field('webm_video_url'); ?>" />
					<source src="<?php the_field('ogv_video_url'); ?>" />
				</video>
			</div>
		</div>
	</div>
</div>
<main id="main" role="main">
<section class="block">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<h2>
				Web Site Terms and Conditions of Use
			</h2>
			<h3>
				1. Terms
			</h3>
			<p>
				By accessing this web site, you are agreeing to be bound by these web site Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this web site are protected by applicable copyright and trademark law.
			</p>
			<h3>
				2. Use License
			</h3>
			<ol type="a">
				<li>
					Permission is granted to temporarily download one copy of the materials (information or software) on the MindTrust Labs web site for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
					<ol type="i">
						<li>modify or copy the materials;</li>
						<li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
						<li>attempt to decompile or reverse engineer any software contained on the MindTrust Labs web site;</li>
						<li>remove any copyright or other proprietary notations from the materials; or</li>
						<li>transfer the materials to another person or "mirror" the materials on any other server.</li>
					</ol>
				</li>
				<li>
					This license shall automatically terminate if you violate any of these restrictions and may be terminated by MindTrust Labs at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
				</li>
			</ol>
			<h3>
				3. Disclaimer
			</h3>
			<ol type="a">
				<li>
					The materials on the MindTrust Labs web site are provided "as is". MindTrust Labs makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, MindTrust Labs does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.
				</li>
			</ol>
			<h3>
				4. Limitations
			</h3>
			<p>
				In no event shall MindTrust Labs or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on MindTrust Labs's Internet site, even if MindTrust Labs or a MindTrust Labs authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.
			</p>			
			<h3>
				5. Revisions and Errata
			</h3>
			<p>
				The materials appearing on the MindTrust Labs web site could include technical, typographical, or photographic errors. MindTrust Labs does not warrant that any of the materials on its web site are accurate, complete, or current. MindTrust Labs may make changes to the materials contained on its web site at any time without notice. MindTrust Labs does not, however, make any commitment to update the materials.
			</p>
			<h3>
				6. Links
			</h3>
			<p>
				MindTrust Labs has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by MindTrust Labs of the site. Use of any such linked web site is at the user's own risk.
			</p>
			<h3>
				7. Site Terms of Use Modifications
			</h3>
			<p>
				MindTrust Labs may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.
			</p>
			<h3>
				8. Governing Law
			</h3>
			<p>
				Any claim relating to the MindTrust Labs web site shall be governed by the laws of the State of Connecticut without regard to its conflict of law provisions.
			</p>
			</div>
		</div>
	</div>
</section>
<div class="quote-block">
	<div class="holder">
		<blockquote class="quote">
			<q>“You see things with crisp, clear eyes and have enabled us to
				enter a new realm of professionalism. You have gone above and beyond
				to help us help others.”</q> <cite> Cheryl A. Trzcinski, CEO
				Master's Manna</cite>
		</blockquote>
		<div class="buttons-holder">
			<a href="http://www.mindtrustlabs.com/contact/"
				class="btn btn-default btn-contact">Contact Us</a>
		</div>
		<ul class="social-links">
			<li><a href="https://www.facebook.com/mindtrustlabs"><span
					class="icon icon-facebook"></span> </a></li>
			<li><a href="https://twitter.com/mindtrustlabs"><span
					class="icon icon-twitter"></span> </a></li>
			<li><a href="https://www.linkedin.com/company/mindtrust-labs"><span
					class="icon icon-linkedin"></span> </a></li>
			<li><a href="#"><span class="icon icon-rss"></span> </a></li>
		</ul>
	</div>
</div>
<?php get_footer();	?>