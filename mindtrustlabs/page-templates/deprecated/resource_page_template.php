<?php
/**
 * Template Name: Resource
 *
 * @package Mindtrustlabs Template
 * @subpackage Mindtrustlabs
 * @since Mindtrustlabs 1.0
 */
get_header(); ?>
<div class="top-section">
	<div class="video-section">
		<div class="holder">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-push-1">
						<form action="#" class="filter-form">
							<fieldset>
							 <div class="title_design">
								<h1>The Learning Center</h1>
								<hr>
								<h2>Browse our extensive library of marketing resources</h2>
								</div>
								<div class="row">
									<div class="col-sm-10 col-sm-push-1">
										<div class="row">
											<!--<div class="col-sm-3 col-xs-6 col-xs-push-2">									
												<?php /*
												$field_key = "field_548ee9543df06";
												$field = get_field_object($field_key);												
												if( $field )
												{
													echo '<select id="all-topics" name="' . $field['key'] . '">
													      <option value="*">All</option>';
													foreach( $field['choices'] as $k => $v )
													{
														echo '<option value=".' . $k . '">' . $v . '</option>';
													}
													echo '</select>';
												} */?>																								
					
											</div>-->
											<!-- <div class="col-sm-3 col-xs-6">
												<?php /* 	
												$field_key = "field_548f02c24317c";
												$field = get_field_object($field_key);												
												if( $field )
												{
													echo '<select id="type" name="' . $field['key'] . '">
													      <option value="*">All</option>';
													foreach( $field['choices'] as $k => $v )
													{
														echo '<option value=".' . $k . '">' . $v . '</option>';
													}
													echo '</select>';
												}
												*/?>
											</div> -->
											<div class="col-sm-6 col-sm-push-3 col-xs-12">
												<input type="search" placeholder="Search"
													class="form-control">
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="video-frame">
			<div class="video-box" data-width="720" data-height="406">
				<video class="mejs-wmp" width="720" height="406" controls="none"
					preload="none"
					poster="<?php the_field('thumbnail_of_video'); ?>"
					autoplay="autoplay" loop="loop">
					<source src="<?php the_field('mp4_video_url'); ?>" />
					<source src="<?php the_field('webm_video_url'); ?>" />
					<source src="<?php the_field('ogv_video_url'); ?>" />
				</video>
			</div>
			 <div class="img-placeholder" data-width="720" data-height="406">
                 <img src="<?php echo get_template_directory_uri () ?>/images/img-video-01.jpg" alt="image description" width="1400" height="538" />
            </div> 
		</div>
	</div>
</div>
<main id="main" role="main">
<section class="block studies-section">
	<div class="container">
		<h2><?php the_title(); ?></h2>
 		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				                <?php the_content(); ?>
				        <?php endwhile; ?>
		<!-- <div class="row">  
			<div class="isotop-items-holder">
				<div class="col-sm-3 isotop-item filter-branding filter-web">
					<div class="item">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/17.png" alt="image description"
							width="260" height="196" />
							<div class="txt-info">
								<div class="text">
									<span class="name">CreateOne</span>
									<hr>
									<span class="duties">Branding &amp; Web Design</span>
								</div>
							</div> </a>
					</div>
				</div>
				<div class="col-sm-3 isotop-item filter-logotype">
					<div class="item">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/linkedin.png"
							alt="image description" width="260" height="196" />
							<div class="txt-info">
								<div class="text">
									<span class="name">Haywire</span>
									<hr>
									<span class="duties">Custom Logotype</span>
								</div>
							</div> </a>
					</div>
				</div>
				<div class="col-sm-3 isotop-item filter-web filter-branding">
					<div class="item">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/25.png" alt="image description"
							width="260" height="196" />
							<div class="txt-info">
								<div class="text">
									<span class="name">Katy Skelton</span>
									<hr>
									<span class="duties">Web Design &amp; Branding</span>
								</div>
							</div> </a>
					</div>
				</div>
				<div class="col-sm-3 isotop-item filter-logotype">
					<div class="item">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/the30greatest.png"
							alt="image description" width="260" height="196" />
							<div class="txt-info">
								<div class="text">
									<span class="name">Haywire</span>
									<hr>
									<span class="duties">Custom Logotype</span>
								</div>
							</div> </a>
					</div>
				</div>
				<div class="col-sm-3 isotop-item">
					<div class="item">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/metrics.png" alt="image description"
							width="260" height="196" />
							<div class="txt-info">
								<div class="text">
									<span class="name">Ted Todd</span>
									<hr>
									<span class="duties"></span>
								</div>
							</div> </a>
					</div>
				</div>
				<div class="col-sm-3 isotop-item filter-branding filter-ui-design">
					<div class="item">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/10seomistake.png"
							alt="image description" width="260" height="196" />
							<div class="txt-info">
								<div class="text">
									<span class="name">Share Practice</span>
									<hr>
									<span class="duties">Branding &amp; UI Design</span>
								</div>
							</div> </a>
					</div>
				</div>
				<div
					class="col-sm-3 isotop-item filter-identify filter-ui-design filter-web">
					<div class="item">
						<a href="#"> <img src="<?php echo get_template_directory_uri () ?>/images/howtocreate.png"
							alt="image description" width="260" height="196" />
							<div class="txt-info">
								<div class="text">
									<span class="name">Sebonic</span>
									<hr>
									<span class="duties">Brand Identity, UI Design, Web Design</span>
								</div>
							</div> </a>
					</div>
				</div>
				<div class="col-sm-3 isotop-item filter-logotype">
					<div class="item">
						<a href="#"> <img src="http://placehold.it/260x196"
							alt="image description" width="260" height="196" />
							<div class="txt-info">
								<div class="text">
									<span class="name">Haywire</span>
									<hr>
									<span class="duties">Custom Logotype</span>
								</div>
							</div> </a>
					</div>
				</div>
			</div>
		</div> -->
		
		
		
	</div>
</section>
<div class="quote-block">
	<div class="holder">
				<blockquote class="quote">
					<q>“You see things with crisp, clear eyes and have enabled us to enter a new realm of professionalism. You have gone above and beyond to help us help others.”</q>
					<cite> Cheryl A. Trzcinski, CEO Master's Manna</cite>
				</blockquote>>
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