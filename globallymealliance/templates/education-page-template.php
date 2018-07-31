<?php

/* Template Name: Education Page Template */

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
                                            <h3>GLA Be Tick AWARE Information</h3>
                                            <p>Be Tick AWARE! Reduce the risk of Lyme and other tick-borne diseases. Take important steps to educate your staff  about the importance of tick bite prevention.</p>
                                            <ul class="posts-grid sm icons">
                                                <li>
                                                    <a href="#popup-download" class="open-lightbox">
                                                        <span class="pic blue"><img src="/wp-content/uploads/2017/07/icon01.png" alt="icon" width="50" height="53"></span>
                                                        <span class="descript">
                                                            <strong class="title" title="Download free resources">Download free resources</strong>
                                                            <!-- <em class="txt">Lorem ipsum dolor sit amet, consectetur sed.</em> -->                      <strong class="more">Download</strong>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://interland3.donorperfect.net/weblink/weblink.aspx?name=timeforlyme&id=59">
                                                        <span class="pic dark"><img src="/wp-content/uploads/2017/07/icon02.png" alt="icon" width="50" height="58"></span>
                                                        <span class="descript">
                                                            <strong class="title" title="Order Physical kit">Order Be Tick AWARE Lyme Prevention Kit</strong>
                                                            <!-- <em class="txt">Lorem ipsum dolor sit amet, consectetur sed.</em> -->                      <strong class="more">Learn more</strong>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="pic green"><img src="/wp-content/uploads/2017/07/icon03.png" alt="icon" width="50" height="46"></span>
                                                        <span class="descript">
                                                            <strong class="title" title="Educational Activities for Kids and Teens">Educational Tools and Activities for Kids and Teens</strong>
                                                            <!-- <em class="txt">Lorem ipsum dolor sit amet, consectetur sed.</em> -->                      <strong class="more">Learn more</strong>
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
