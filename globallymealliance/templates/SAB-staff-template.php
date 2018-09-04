<?php
/* Template Name: SAB &amp; Staff Page Template */
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
                <div class="boards">
                    <h1><?php the_title(); ?></h1>
                    <?php if (have_rows('sab_sections')) :
                        while (have_rows('sab_sections')) : the_row(); ?>
                            <section class="panel">
                                <h3><?php the_sub_field('sab_section_title'); ?></h3>
                                <?php the_sub_field('sab_section_desctiption'); ?>
                                <ul class="grid">
                                    <?php if (have_rows('add_sab_staffs')):
                                        while (have_rows('add_sab_staffs')) : the_row();
                                            $sab_staff_Object = get_sub_field('select_sab_staff');
                                            if ($sab_staff_Object):
                                                $post = $sab_staff_Object;
                                                setup_postdata($post); ?>
                                                <li>
                                                    <a href="#popup-<?php echo $post->ID;?>" class="open-lightbox">
                                                        <span class="pic">
						    			                        <span class="cell">
                                                                    <?php echo get_the_post_thumbnail($post->ID,'blog-list-thumb'); ?>
                                                                </span>
                                                            <span class="more"></span>
                                                        </span>
                                                            <strong class="name"><?php the_title(); ?>&nbsp;<?php the_field('staff_last_name'); ?></strong>
                                                            <span class="degree"><?php the_field('degree'); ?></span>
                                                    </a>
                                                    <div class="popup-holder">
                                                        <div class="lightbox" id="popup-<?php echo $post->ID;?>">
                                                            <div class="info-box">
                                                                <div class="info-title">
                                                                    <div class="pic">
                                                                        <?php echo get_the_post_thumbnail($post->ID,'blog-list-thumb'); ?>
                                                                    </div>
                                                                    <div class="title">
                                                                        <h2>
                                                                            <?php the_field('staff_title'); ?><br> <?php the_title(); ?>&nbsp;<?php the_field('staff_last_name'); ?>
                                                                        </h2>
                                                                        <h3><?php the_field('degree'); ?></h3>
                                                                    </div>
                                                                </div>
                                                                <?php the_content(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php wp_reset_postdata();
                                            endif;
                                        endwhile;
                                    else :
                                        echo "<!-- <li>No Staff Assigned</li> -->";
                                    endif; ?>
                                </ul>
                            </section>
                        <?php endwhile;
                    else :
                        echo "<p>No Scientific advisory board sections available</p>";
                    endif; ?>
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
