<?php

/* Template Name: Download Resources Template */

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
                            <section class="download-tab" id="tab-<?php echo get_row_index(); ?>">
                                <div class="download-tab-description">
                                    <?php the_sub_field('download_section_description'); ?>
                                </div>
                                <ul class="download-grid">
                                            <?php
                                    if( have_rows('download_free_resources') ):
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
											                <?php if( get_sub_field('download_resource_link') ): ?>
											            	<?php 
												            if(!isset($_COOKIE[$post_slug])) { ?>
													            <a data-val="<?php the_sub_field('download_resource_link');?>" class="open-lightbox link-download-bt" href="#popup-download">Download</a>
														    <?php } else { ?>
															    <a class="open-lightbox link-download" target="_blank" href="<?php the_sub_field('download_resource_link');?>">Download</a>
	                                                        <?php } ?>
														    <?php endif; ?>
                                                            </div>
                                                </li>
                                                <?php
                                        endwhile;

                                    else :
                                        
                                    endif;
                                        
                                ?>
                            </ul>
                        </section>
                        <?php endwhile;
                    else :
                        echo "<p>Unfortunately, there are no downloads available at this time.</p>";
                    endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<?php get_footer(); ?>
<script>
$('.link-download-bt').click(function () {
	$('#input_9_7').val($(this).data('val'));
});
</script>
