<?php
/* Template Name: Meet Our Sponsors Page Template */
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
        <div class="inner-banner"
             style="background-image: url(<?php echo $banneurl; ?>)"></div>
        <div class="container-section">
            <div class="main main1196">
                <div class="boards sponsors_page">
                    <h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
                    <?php if (have_rows('sponsors_sections')) :
						$sponsorsSectionCount = 0;
                        while (have_rows('sponsors_sections')) : the_row(); 
						$sponsorsSectionCount++;
						$logo_layout = get_sub_field('logo_layout');
						?>
                            <section class="<?php echo $sponsorsSectionCount % 2 == 0 ? 'panel' : 'panel';?>">
                                <h3><?php the_sub_field('sponsors_section_title'); ?></h3>
                                <div class="sponsors-desc"><?php the_sub_field('sponsors_section_description'); ?></div>
								<div class="sponsor-col1 <?php if(is_array($logo_layout) && in_array('yes', $logo_layout)) echo "sponsors-logo-layout";
																		else echo 'sponsors-text-layout';?>">
                                <ul class="grid-sm">
                                    <?php if (have_rows('add_sponsors')):
										$sponsorCount = 0;
                                        while (have_rows('add_sponsors')) : the_row();
										$sponsorCount++;
                                            $sab_staff_Object = get_sub_field('sponsor_image');
                                            if ( ($sab_staff_Object) && is_array($logo_layout) && in_array('yes', $logo_layout) ):?>
                                                <li>
												<?php if ( get_sub_field('sponsor_description') ) { ?>
													<a href="#popup-<?php echo $sponsorCount;?>" class="open-lightbox">
		                                                <img src="<?php echo $sab_staff_Object['url']; ?>" title="<?php the_sub_field('sponsor_title'); ?>">
													</a>
													<div class="popup-holder">
                                                        <div class="lightbox" id="popup-<?php echo $sponsorCount;?>">
                                                            <div class="info-box">
                                                                <div class="info-title">
                                                                    <div class="popup-sponsor-content">
                                                                        <h2>
                                                                            <?php the_sub_field('sponsor_title'); ?>
                                                                        </h2>
																		<br>
                                                                        <div><?php the_sub_field('sponsor_description'); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
												<?php }else{?>
													<img src="<?php echo $sab_staff_Object['url']; ?>" title="<?php the_sub_field('sponsor_title'); ?>">
												<?php }?>
                                                </li>
                                                <?php 
												else: ?>
												<li class="text-sponsor-li" style="line-height: 200px;">
														<span class="text-sponsor-cell">
															<?php the_sub_field('sponsor_title'); ?>
														</span>
                                                </li>
												<?php endif;
												wp_reset_postdata();
                                        endwhile;
                                    else :
                                        echo "<!-- <li>No Sponsor Assigned</li> -->";
                                    endif; 
									if ( is_array($logo_layout) && in_array('yes', $logo_layout) && get_field('become_a_sponsor_link') && ($sponsorsSectionCount == 1)) {
									?>
										<!--<li class="sponsor-right-col"><a title="Become a Sponsor" class="open-lightbox become-link" href="#popup-widget2"><i class="ico-plus"></i> Become a Sponsor</a></li> -->
									<?php }?>
									</ul>
									</div>
                            </section>
							<hr><br>
                        <?php endwhile;
                    else :
                        echo "<p>No Sponcers available</p>";
                    endif; ?>
					<?php the_field('become_a_sponsor_form');?>
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part( 'newsletter', 'form' ); ?>
</main>
<div class="popup popup-nav">
    <div class="panel-close">
        <a href="#" class="popup-close">Close</a>
    </div>
    <div class="accordion-nav">
        <div class="wrapper container-fluid">
            <div class="row center-xs">
                <div class="col-xs-11 col-md-10">
                    <ul class="accordion">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="popup popup-search">
    <div class="panel-close">
        <a href="#" class="popup-close">Close</a>
    </div>
    <div class="wrapper container-fluid">
        <div class="row center-xs">
            <div class="col-xs-11 col-md-10">
                <form action="#" class="search-form">
                    <label>What are you looking for?</label>
                    <div class="search-input">
                        <span class="icon icon-search"></span> <input type="text"
                                                                      placeholder="Lyme Prevention">
                    </div>
                    <ul class="results-list">
                        <li><span class="number">55</span> <a href="#"><span
                                        class="highlighted">Lyme</span> Prevention</a></li>
                        <li><span class="number">33</span> <a href="#"><span
                                        class="highlighted">Lyme</span> Disease</a></li>
                        <li><span class="number">55</span> <a href="#">What is <span
                                        class="highlighted">Lyme</span> disease?
                            </a></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php get_footer(); ?>
