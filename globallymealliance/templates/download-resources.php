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
                            <?php if (have_rows('download_sections')) :
                                while (have_rows('download_sections')) : the_row(); ?>
                            <section class="panel-2">
                                <h2 class="sm-h2-header"><?php the_sub_field('download_section_title'); ?></h2>								
                                <ul class="download-list">
								<li><?php the_sub_field('download_section_description'); ?></li>
                                            <?php
                                    if( have_rows('download_free_resources') ):
                                        while ( have_rows('download_free_resources') ) : the_row();
                                            ?>
                                                <li>
		                                                    <img src="<?php the_sub_field('download_resource_image');?>" alt="" width="150" height="150" />
															
			                                            	<div class="holder">
						                                    	<strong class="title"><?php the_sub_field('download_resource_title');?></strong>
								                            	<?php the_sub_field('download_resource_description');?>
															</div>
											                <?php if( get_sub_field('download_resource_link') ): ?>
											            	<?php 
												            if(!isset($_COOKIE[$post_slug])) { ?>
													            <a data-val="<?php the_sub_field('download_resource_link');?>" class="open-lightbox link-download-bt" href="#popup-download">Download</a>
														    <?php } else { ?>
															    <a class="open-lightbox link-download" target="_blank" href="<?php the_sub_field('download_resource_link');?>">Download</a>
	                                                    <?php } ?>
														<?php endif; ?>
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
