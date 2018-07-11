<?php

/* Template Name: Table Template */

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
                        <div class="wrapper no-maxwidth container-fluid">
                            <div class="row center-xs">
                                <div class="col-xs-12 col-lg-10">
                                    <div class="boards">
                                            <h1><?php the_title(); ?></h1>
											<p><?php the_content(); ?></p>
<?php
$table = get_field( 'table_template' );

if ( $table ) {
echo '<div class="table-1-container">';
    echo '<table  class="table-1">';

        if ( $table['header'] ) {

           echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th>';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

           echo '</thead>';
        }

       echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';

$columnCount = 0;
					foreach ( $tr as $td ) {
                        echo '<td data-label="'.$table['header'][$columnCount] ['c'].'">';
                            if ( ($td['c'] != '') && ($columnCount) && (strpos($td['c'], '[NOPOPUP]') !== false)){
							?>
							<img src="/wp-content/themes/globallymealliance/images/icon-check.svg" style="width: 20px;">	
							<?php
							}elseif ( ($td['c'] != '') && ($columnCount)){
							?>
							<div class="popup-1">
								<a href="#" class="opener">Click for Details</a>
								<div class="description">
									<p><?php echo $td['c'];?></p>
								</div>
							</div>	
							<?php
							}else{
							echo $td['c'];
							}
                        echo '</td>';
						$columnCount++;
					}

                echo '</tr>';
            }

       echo '</tbody>';

    echo '</table>';
echo '</div>';
	echo '<a class="btn btn-blue-alt" href="'.get_permalink().'pdf" target="_blank">Download table</a>';
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
