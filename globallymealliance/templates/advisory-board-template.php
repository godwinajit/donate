<?php

/* Template Name: Advisory Board Template */

get_header();

?>

<!-- Top banner -->

<div class="mains inner-pages">
 <?php 

	if (has_post_thumbnail()) {

		$banneurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  

	}else {

		$banneurl = get_template_directory_uri().'/images/scientific-advisory-board.jpg';

	}

?>

 <div class="inner-banner" style="background-image:url(<?php echo $banneurl; ?>)">

  <div class="main">

   <div class="breadcrumb">

    <?php /* bcn_display(); */ ?>

   </div>

  </div>

 </div>

 <?php //echo do_shortcode('[Icon Slider]'); ?> 

 <!-- conatiner section -->

 <div class="container-section advisory-board">

  <div class="main main1196">

   <div class="content-left content-section-height"> 

    

    <!-- Sab Committee Members Section Start -->

    <div>

     <h1 class="page-title">

      <?php the_title(); ?>

     </h1>

     <?php $sab_committee_members_title = get_field('sab_committee_members_title');

      $sab_committee_members_description = get_field('sab_committee_members_description');

      $select_sub_committee_members = get_field('select_sub_committee_members');			

      ?>

     <h3><?php echo $sab_committee_members_title; ?></h3>

     <?php echo $sab_committee_members_description ?>

     <?php 

        if( have_rows('select_sub_committee_members') ){

          echo '<div class="committee-members-cont sub-committee-members cf">';

            while ( have_rows('select_sub_committee_members') ) : the_row();

          

              $post_object = get_sub_field('select_sab_members');

              $post = $post_object;

              setup_postdata( $post );

							 if(get_field( 'degree' )){

									$degree = ', '.get_field( 'degree' );

								}else{

									 $degree = ''; 

								}

						

			  $post_id = get_the_ID();

         

			echo '<div class="committee-members-data"><a class="committee-members-name-img" href="javascript:{}" title="'.get_the_title().'">'.get_the_post_thumbnail($post->ID,'category-thumb').'<div class="dis-table"><div class="committee-members-name">'.get_the_title() .$degree.' <span>></span></div></div> </a>

			  <div class="hidden-description"><div class="hidden-description-inner">'.get_the_content_with_formatting().'</div></div>

			  </div>';

              wp_reset_postdata();

             

            endwhile;

          echo '</div>';

        }

    	?>

    </div>

    

    <!-- Financial Committee Members Section Start -->

    <div>

     <?php $financial_review_committee_title = get_field('financial_review_committee_title');

      $financial_review_committee_description = get_field('financial_review_committee_description');

      $select_financial_committee_members = get_field('select_financial_committee_members');			

      ?>

     <h3><?php echo $financial_review_committee_title; ?></h3>

     <?php echo $financial_review_committee_description ?>

     <?php 

        if( have_rows('select_financial_committee_members') ){

          echo '<div class="committee-members-cont financial-committee-members cf">';

            while ( have_rows('select_financial_committee_members') ) : the_row();

          

              $post_object = get_sub_field('select_financial_members');

              $post = $post_object;

              setup_postdata( $post );

							if(get_field( 'degree' )){

									$degree = ', '.get_field( 'degree' );

								}else{

									 $degree = ''; 

								}

              echo '<div class="committee-members-data"><a class="committee-members-name-img" href="javascript:{}" title="'.get_the_title().'">'.get_the_post_thumbnail($post->ID,'category-thumb').'<div class="dis-table"><div class="committee-members-name">'.get_the_title() .$degree.' <span>></span></div></div> </a>

			  <div class="hidden-description"><div class="hidden-description-inner">'.get_the_content_with_formatting().'</div></div>

			  </div>';

              wp_reset_postdata();

             

            endwhile;

          echo '</div>';

        }

    	?>

    </div>

   </div>

   

   <!-- aside section -->

   

   <div class="aside-right content-section-height">

    <?php dynamic_sidebar('ga-sidebar'); ?>

   </div>

  </div>

 </div>

   <!-- Subscribe CTA -->
    <?php get_template_part( 'newsletter', 'form' ); ?>

    </div>

   </div>

  </div>

 <!--/div-->

</div>
</main>


<?php get_footer(); ?>

