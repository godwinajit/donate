<?php

/* Template Name: Advisory Board Template */

get_header();

?>
    <main class="mains">
        <div class="inner-pages common-content-page">
            <?php 

                if (has_post_thumbnail()) {

                    $banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  

                }else {

                    $banneurl = get_template_directory_uri().'/images/scientific-advisory-board.jpg';

                }

            ?>
            <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)">
                <div class="container-section">
                    <div class="wrapper container-fluid">
                        <div class="row center-xs">
                            <div class="col-xs-12 col-sm-11 col-md-10">
                                <div class="boards">
                                    <h1><?php the_title(); ?></h1>
                                    <section class="panel">
                                        <h3>Chairman of the Board</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        <ul class="grid">
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava01.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </section>
                                    <section class="panel">
                                        <h3>Chairman of the Board</h3>
                                        <p>GLA’s Scientific Advisory Board (SAB) provides advice on overall research strategy to direct GLA’s grant funds into programs judged to have exceptional prospects of delivering measurable results. Comprised of top experts in multidisciplinary fields in Lyme and tick-borne diseases. The SAB holds an annual seminar for its grant recipients to foster brainstorming of new diagnostic and therapeutic measures, communication of ideas and collaboration.</p>
                                        <ul class="grid">
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava01.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava02.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava03.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava04.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava02.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava02.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava03.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava04.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </section>
                                    <section class="panel">
                                        <h3>Financial Review Committee</h3>
                                        <p>The Financial Review Committee of the SAB is composed of business leaders with extensive strategic, operational and senior management experience. Its priority is to bridge the gap between the research community and the marketplace with the goal of transitioning successful research programs into accessible treatments that are readily available to patients. The members of this Committee are:</p>
                                        <ul class="grid">
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava03.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#popup-01" class="open-lightbox">
                                                    <span class="pic">
                                                        <span class="cell"><img src="images/temp/ava04.jpg" alt="Name Last Name"></span>
                                                        <span class="more"></span>
                                                    </span>
                                                    <strong class="name">First &amp; Last Name,</strong>
                                                    <span class="degree">Degree</span>
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
            <section class="section-subscribe">
                    <div class="wrapper container-fluid">
                        <div class="row center-xs">
                            <div class="col-xs-12 col-sm-11 col-md-10">
                                <div class="subscribe-form">
                                    <span class="icon icon-mail sm-visible"></span>
                                    <h2><?php echo get_field('newsletter_text', 2); ?></h2>
                                    <div class="form-row">
	                                         <?php echo do_shortcode('[ctct form="7979"]'); ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
	</div>
    <div class="popup-holder">
        <div class="lightbox" id="popup-01">
            <div class="info-box">
                <div class="info-title">
                    <div class="pic">
                        <img src="images/temp/ava01-lg.jpg" alt="Dr. Brian Fallon">
                    </div>
                    <div class="title">
                        <h2>Dr.<br> Brian Fallon.</h2>
                        <h3>Director of Research and Science, Global Lyme Alliance</h3>
                    </div>
                </div>
                <p>Dr. Hsu received a Ph.D. in microbiology and immunology from McGill University. She received postdoctoral training at Rockefeller University in New York City and subsequently worked in infectious diseases research in the pharmaceutical industry, academia, and a non-governmental organization.</p>
                <p>As GLA’s Director of Research and Science, Dr. Hsu’s responsibilities are to coordinate the research grant program, scientific writing, and research development.</p>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
