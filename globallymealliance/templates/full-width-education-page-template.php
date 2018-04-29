<?php

/* Template Name: Full-Width Education Page Template */

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