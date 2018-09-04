<?php

/* Template Name: Tick AWARE Prevention Program Template */

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
                        <div class="main">
                            <div class="boards content-left content-section-height">
                                <h2>Tick AWARE Prevention Program for Summer Camp and Other Outdoor Activities</h2>
                                <img src="/wp-content/uploads/2017/07/img-certified-camp.png" alt="Ivy Oaks Certified Camp" class="alignright">
                                <h3>Be Tick AWARE</h3>
                                <p>GLA has joined forces with <a href="https://www.ivyoaksanalytics.com/" target="_blank">Ivy Oaks Analytics</a> to prevent Lyme and other tick-borne diseases.<p>
                                <p>Our unique partnership provides a comprehensive tick prevention and Awareness program that combats the dangers of  ticks, mosquitoes, and poison Ivy to create a safer outdoor environment.</p>
                                <p><a href="/press-releases/global-lyme-alliance-ivy-oaks-analytics-safeguard-children-lyme-disease/">Learn more</a> about GLA and Ivy Oaks Analytics tick bite prevention program for summer camps </p>
                                <h3>High-Risk to Moderate Risk Outdoor Activities</h3>
                                <div class="ticks" data-value="4"><div></div></div>
                                <p>Any activity that exposes you to areas where ticks like to live like the woods, grassy or leafy areas, including beach grass. If you enjoy sitting in the grass for a concert, picnic, campfires, or to relax, take proper precautions to be tick safe. Remember ticks like <strong>moist, shaded areas.</strong></p>
                                <p>High-Risk Activities include, but are not limited to the following:</p>
                                <div class="list-style">
                                    <ul>
                                        <li>Camping</li>
                                        <li>Hiking</li>
                                        <li>Walking on trails</li>
                                        <li>Off-road biking</li>
                                        <li>Hunting</li>
                                        <li>Fishing</li>
                                        <li>Golf</li>
                                        <li>Baseball</li>
                                        <li>Gardening</li>
                                        <li>Playing in the leaves</li>
                                        <li>Horseback riding</li>
                                        <li>Grass Cutting</li>
                                    </ul>
                                </div>
                                <div class="ticks" data-value="3"><div></div></div>
                                <p><strong>Moderate outdoor activities include</strong> enjoying activities that put you in contact with grassy areas exposes you to ticks. Activities  like sitting in the grass for a concert, picnic, or gazing at the stars/moon, campfires, walks on the beach or in the  park, dog walking,  climbing sand dunes, cutting the grass, and many other activities that involve the great outdoors.</p>
                                <!-- <div class="ticks" data-value="2"><div></div></div>
                                <p><strong>Limited outdoor activities</strong> reduces your exposure, but if you have a pet or are exposed to animals, then you are at risk for ticks.</p> -->
                                <p>Pets and other outdoor animals increase your risk for a tick bite. Check your pets immediately when they come indoors.</p>
                                <p><strong><a href="/about-lyme/prevention/about-ticks/">Learn more about ticks</a></strong></p>
                            </div>
                            <!-- aside section -->
                            <div class="aside-right content-section-height">

                                <?php dynamic_sidebar('blogvideo-sidebar'); ?>

                                <?php dynamic_sidebar('aboutgrant-sidebar'); ?>

                                <?php dynamic_sidebar('bucket-sidebar'); ?>

                                <?php dynamic_sidebar('ga-sidebar'); ?>

                            </div>
                        </div>
                        <div class="main">
                            <div class="boards">
                                <section class="posts-panel">
                                    <h3>Tick Prevention Awareness Tools &amp; Resources</h3>
                                    <ul class="posts-grid">
                                        <li>
                                            <a href="/education-awareness/tick-aware-prevention-program-summer-camp-outdoor-activities/camp-professionals-youth-based-organizations/">
                                                <span class="pic"><img src="/wp-content/uploads/2017/07/pic01.jpg" alt=""></span>
                                                <span class="descript">
                                                    <strong class="title" title="Camps professionals">Camps professionals</strong>
                                                    <em class="txt">Learn more about Camps Professionals and other youth-based organizations</em>
                                                    <strong class="more">Learn more</strong>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/education-awareness/tick-aware-prevention-program-summer-camp-outdoor-activities/parents-need-know/">
                                                <span class="pic"><img src="/wp-content/uploads/2017/07/pic02.jpg" alt=""></span>
                                                <span class="descript">
                                                    <strong class="title" title="parents and Families">parents and Families</strong>
                                                    <em class="txt">Click here is you want to learn more about Parents tools and resources</em>
                                                    <strong class="more">Learn more</strong>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Subscribe CTA -->
                <?php get_template_part( 'newsletter', 'form' ); ?>
            </main>
<?php get_footer(); ?>
