<?php

/* Template Name: Full width bottom two box Template */

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
									<?php if(!empty(get_the_content())){?>
                                        <div class="content-left content-section-height">
                                            <h1><?php the_title(); ?></h1>
											<div class="row">&nbsp;</div>
                                            <?php the_content();?>
											<div class="row">&nbsp;</div>
                                        </div>
									<?php }?>
                                        <!-- aside section -->
                                        <div class="aside-right content-section-height">

                                            <?php dynamic_sidebar('ga-sidebar'); ?>

                                            <?php dynamic_sidebar('blogvideo-sidebar'); ?>

                                            <?php dynamic_sidebar('aboutgrant-sidebar'); ?>

                                            <?php dynamic_sidebar('bucket-sidebar'); ?>

                                        </div>

										<?php if(get_field('left_content')){ ?>
										<section class="posts-panel">										
											<?php echo get_field('left_content');  ?>
										</section>
										<?php }?>
									   <?php
											while ( the_flexible_field ( 'add_flexible_content' ) ) {
												if (get_row_layout () == '2_column_section') {
													$content_left = get_sub_field ( 'content_left' );
													$content_right = get_sub_field ( 'content_right' );
										?>
										   <section class="posts-panel">
                                            <ul class="posts-grid">
                                                <?php echo $content_left;?>
                                                <?php echo $content_right;?>
                                            </ul>
                                        </section>
                                        <?php 
												}
											}
										?>
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
