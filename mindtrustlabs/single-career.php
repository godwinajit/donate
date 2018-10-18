<?php
get_header ();
?>
<main id="main" role="main">
<section class="block family">
	<div class="container">
		<div class="quote-box">
			<article class="box">
				<div class="heading">
					<h3>
						<!-- <span class="name">Name</span> -->
						<span class="title"><?php the_title(); ?></span>
					</h3>
					<hr>
					<!-- <ul class="social-networks">
							<li><a href="#" class="icon icon-twitter"></a></li>
							<li><a href="#" class="icon icon-linkedin"></a></li>
						</ul> -->
				</div>
				<p><?php the_content(); ?></p>
				<!-- <a href="#" class="btn btn-lg btn-default">READ ARTICLES</a> -->
			</article>
		</div>
	</div>
</section>
<div class="quote-block">
	<div class="holder">
		<blockquote class="quote">
			<q>“Markets are changing faster than they ever have before.  To stay competitive, businesses today need to collaborate across disciplines, locations and organizations to invent the best solutions, faster.  Integrating multidimensional teams with agile software best-practices leads to new ideas and better products brought to market faster. We can build you a dream team, your “MindTrust”.</q>
<cite>Chris Errato, Founder/President</cite>
		</blockquote>
		<div class="buttons-holder">
			<a href="http://www.mindtrustlabs.com/contact/"
				class="btn btn-default btn-contact">Learn How</a>
		</div>
	</div>
</div>
<?php get_footer();	?>