<?php

/* Template Name: Table Template */

get_header();

?>
            <main class="mains">
                <div class="inner-pages common-content-page">
                    <?php 

                        if (has_post_thumbnail()) {

                            $banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  

                        }else {

                            $banneurl = get_template_directory_uri().'/images/template-banner.jpg';

                        }

                    ?>
                    <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)"></div>
                    <div class="container-section">
                        <div class="wrapper container-fluid">
                            <div class="row center-xs">
                                <div class="col-xs-12 col-sm-11 col-md-10">
                                    <div class="boards">
                                        <div class="content-left content-section-height">
                                            <h1><?php the_title(); ?></h1>
                                            <!-- Place the main content HTML here -->
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
											<table>
												<tr>
													<th>Lorem ipsum</th>													<th>Lorem ipsum</th>													<th>Lorem ipsum</th>													<th>Lorem ipsum</th>												</tr>
												<tr>
													<td>Lorem ipsum</td>													<td></td>													<td>
														<div class="popup">
															<a href="#" class="opener">open help text</a>
															<div class="description">
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
															</div>
														</div>
													</td>													<td></td>
												</tr>
												<tr>
													<td>Lorem ipsum</td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>Lorem ipsum</td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>Lorem ipsum</td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>Lorem ipsum</td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>Lorem ipsum</td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>Lorem ipsum</td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>Lorem ipsum</td>
													<td>
														<div class="popup">
															<a href="#" class="opener">open help text</a>
															<div class="description">
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
															</div>
														</div>
													</td>
													<td></td>
													<td></td>
												</tr>
											</table>
											<a class="btn btn-blue" href="#">Download table</a>
                                        </div>
                                        <!-- aside section -->
                                        <div class="aside-right content-section-height">

                                            <?php dynamic_sidebar('blogvideo-sidebar'); ?>

                                            <?php dynamic_sidebar('aboutgrant-sidebar'); ?>

                                            <?php dynamic_sidebar('bucket-sidebar'); ?>

                                            <?php dynamic_sidebar('ga-sidebar'); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Subscribe CTA -->
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
                </section>  
            </main>
<?php get_footer(); ?>
