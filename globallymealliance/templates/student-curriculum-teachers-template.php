<?php

/* Template Name: Student Curriculum Template */

get_header();
global $post;
$post_slug = $post->post_name;
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
                                            
                                            <?php 
                                            // check if the videos repeater field has rows of data
											if( have_rows('lyme_disease_prevention_videos') ):
												
											 	// loop through the rows of data
											    while ( have_rows('lyme_disease_prevention_videos') ) : the_row();
												?>
										        <div class="block">
										        	<?php 
										        	if(!isset($_COOKIE[$post_slug])) { ?>
														<a href="#popup-video" class="open-lightbox">
													<?php } else { ?>
														<a href="<?php the_sub_field('lyme_disease_youtube_embed_url');?>" class="open-lightbox fancybox.iframe">
													<?php } 
													?>													
														<span class="pic video">
															<img src="<?php the_sub_field('lyme_disease_video_thumbnail');?>" alt="">
														</span>
														<span class="descript">
															<strong><?php the_sub_field('lyme_disease_video_description');?></strong>
															<em><?php the_sub_field('lyme_disease_video_sub_description');?></em>
														</span>
													</a>
												</div>
												<?php 
										    	endwhile;

											endif;
											?>
											
                                        </div>
                                        <section class="posts-panel">
                                            <h3>Free Lyme Disease Prevention Student Curriculum and Teachers Workbooks</h3>
                                            <ul class="posts-grid pics">
                                                <li>
                                                    <a href="/education-awareness/download-teacher-student-resources/">
                                                        <span class="pic"><img src="/wp-content/uploads/2017/09/teacher_with_students-604x270.jpg" alt="description"></span>
                                                        <span class="descript">
                                                            <strong class="title" title="Free printables for the classroom">Free printables for the<br> classroom</strong>
                                                            <em class="txt">Access student guides and teacher's workbooks. Grades: K-12</em>
                                                            <strong class="more">Learn more</strong>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/education-awareness/digital-education/">
                                                        <span class="pic"><img src="/wp-content/uploads/2017/07/pic04.jpg" alt="description"></span>
                                                        <span class="descript">
                                                            <strong class="title" title="Digital Education">Digital Education</strong>
                                                            <em class="txt">Interactive educational activities for students. Grades: K-8</em>
                                                            <strong class="more">Learn more</strong>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.youtube.com/embed/Zq91BUVkbIM" class="open-lightbox fancybox.iframe">
                                                        <span class="pic"><img src="/wp-content/uploads/2017/08/Fundamentals_of_Lyme_Disease_Prevention_-_Global_Lyme_Alliance-604x270.png" alt="description"></span>
                                                        <span class="descript">
                                                            <strong class="title" title="Living the Lyme Life [VIDEO]">Living the Lyme Life [VIDEO]</strong>
                                                            <em class="txt">Great for grades 7 - 12<br> Duration: 15:34 minutes</em>
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
                    </div>
                </div>
                <!-- Subscribe CTA -->
                <?php get_template_part( 'newsletter', 'form' ); ?>
            </main>
            <div class="popup-holder">
    <div class="lightbox lightbox-download" id="popup-video">
		<div class="visual" style="background-image: url(/wp-content/themes/globallymealliance/images/bg-popup.jpg);"></div>
		    <div class="lightbox-content">
				<?php the_field('lyme_disease_popup_content');?>
	        </div>	
        </div>
    </div>
</div>
<?php get_footer(); ?>