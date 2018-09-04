<?php

/* Template Name: Be Tick Aware Page Template */

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
                                            <?php

                                                /* translators: %s: Name of current post */

                                                if(is_home()){

                                                    the_excerpt(); 

                                                }else{

                                                    the_content( sprintf(

                                                    __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),

                                                    the_title( '<span class="screen-reader-text">', '</span>', false )

                                                ) );



                                                wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );  

                                                }

                                                

                                            ?>
                                        </div>
                                        <!-- aside section -->
                                        <div class="aside-right content-section-height">

                                            <?php dynamic_sidebar('blogvideo-sidebar'); ?>

                                            <?php dynamic_sidebar('aboutgrant-sidebar'); ?>

                                            <?php dynamic_sidebar('bucket-sidebar'); ?>

                                            <?php dynamic_sidebar('ga-sidebar'); ?>

                                        </div>
                                        <section class="posts-panel">
                                            <h3>Tick Prevention &amp; Awareness Tools and Resources</h3>
                                            <ul class="posts-grid">
                                                <li>
                                                    <a href="/education-awareness/camp-professionals-youth-based-organizations/">
                                                        <span class="pic"><img src="/wp-content/uploads/2017/08/camp-professionals.jpg" alt="Camp Professionals"></span>
                                                        <span class="descript">
                                                            <strong class="title" title="Camps professionals">Camps professionals</strong>
                                                            <em class="txt">Learn more about Camps Professionals and other youth-based organizations</em>
                                                            <!-- <strong class="more">Learn more</strong> -->
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/education-awareness/parents-need-know/">
                                                        <span class="pic"><img src="/wp-content/uploads/2017/09/gettyimages-129302035_1024.jpg" alt="Parents &amp; Families"></span>
                                                        <span class="descript">
                                                            <strong class="title" title="parents and Families">parents and Families</strong>
                                                            <em class="txt">Click here if you want to learn more about Parents tools and resources</em>
                                                            <!-- <strong class="more">Learn more</strong> -->
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Subscribe CTA -->
                <?php get_template_part( 'newsletter', 'form' ); ?>
            </main>
            <div class="popup-holder">
            <div class="lightbox lightbox-download" id="popup-download">
                <div class="visual" style="background-image: url(/wp-content/themes/globallymealliance/images/bg-popup.jpg);"></div>
                <div class="lightbox-content">
                    <h2 class="lightbox-title">Download Free resources</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis ntrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p>Subscribe to download your bundle right now!</p>
                    <?php echo do_shortcode('[gravityform id="9" title="false" ajax="true" tabindex="149"]'); ?>
					<p class="note"><i class="ico-lock"></i> We won’t spam you or share your information with any other third party. Promised!</p>
                </div>
            </div>
        </div>
<?php get_footer(); ?>
