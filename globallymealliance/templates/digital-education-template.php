<?php

/* Template Name: Digital Education Template */

get_header();
global $post;
$post_slug = $post->post_name;
?>
            <main class="mains">
                <div class="inner-pages common-content-page">
                    <div class="container-section">
                        <div class="wrapper container-fluid">
                            <div class="row center-xs">
                                <div class="col-xs-12 col-sm-11 col-md-10">
                                    <div class="boards">
                                            <h1><?php the_title(); ?></h1>
                                            <div class="download-tab-description">
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

                                            <?php if (have_rows('download_sections')) : ?>
                                                <div class="download-tabset-holder">
                                                    <ul class="download-tabset">
                                                    <?php while (have_rows('download_sections')) : the_row(); ?>
                                                        <li><a href="#tab-<?php echo get_row_index(); ?>"><?php the_sub_field('download_section_title'); ?></a></li>
                                                    <?php endwhile; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>

            							    <?php if (have_rows('download_sections')) :
                                              while (have_rows('download_sections')) : the_row(); ?>
                                              <div class="download-tab" id="tab-<?php echo get_row_index(); ?>">
                                                <div class="download-tab-description">
            								        <?php the_sub_field('download_section_description'); ?>
                                                </div>
                                                <?php
                                                    if( have_rows('download_free_resources') ): ?>
            		                                <ul class="download-grid interactive-curriculum-ul">
            									<?php
                                                    while ( have_rows('download_free_resources') ) : the_row();
                                                        ?>
                                                            <li>
            		                                                    <div class="download-info">
                                                                            <div class="download-pic">
                                                                                <img src="<?php the_sub_field('download_resource_image');?>" alt="" height="235" />
                                                                            </div>
                			                                                <div class="holder">
                						                                        <strong class="title"><?php the_sub_field('download_resource_title');?></strong>
                								                                <?php the_sub_field('download_resource_description');?>
                															</div>
                                                                        </div>
                                                                        <div class="download-actions">
                															<?php if (get_sub_field('download_gated')): ?>
                																<?php if( get_sub_field('download_resource_link') ): ?>
                											            		<?php if(!isset($_COOKIE[$post_slug])) { ?>
                																    <a data-val="<?php the_sub_field('download_resource_link');?>" class="open-lightbox link-download-bt" href="#popup-download">Download</a>
                															    <?php } else { ?>
                																    <a class="open-lightbox link-download" target="_blank" href="<?php the_sub_field('download_resource_link');?>">Download</a>
                																<?php } ?>
                																<?php endif; ?>
                															<?php else:?>
                																<a class="link-download-bt" href="<?php the_sub_field('download_resource_path');?>" target="_blank" rel="noopener">Get Now</a>
                															<?php endif; ?>
                                                                        </div>


                                                            </li>
                                                            <?php
                                                    endwhile;
            										?>
            			                            </ul>
            										<?php
                                                else :
                                                    
                                                endif;
                                            ?>
                                        </div>
                                        <?php endwhile;
                                        else :
                                            echo "<p>Unfortunately, there are no downloads available at this time.</p>";
                                        endif; ?>

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
    <div class="lightbox lightbox-download" id="popup-download">
		<div class="visual" style="background-image: url(/wp-content/themes/globallymealliance/images/bg-popup.jpg);"></div>
		    <div class="lightbox-content">
				<?php the_field('pop_up_form_content');?>
	        </div>	
        </div>
    </div>
</div>
<?php get_footer(); ?><script>
$('.link-download-bt').click(function () {
	$('#input_13_7').val($(this).data('val'));
});
</script>