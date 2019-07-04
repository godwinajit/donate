<?php get_header(); ?>

<?php get_template_part('blocks/header/header-image') ?>

<div class="main-holder">
    <div class="container">
        <section class="content-block showcase-block">
        	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
            
            <div class="heading text-center">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
            
            <?php $package_includes = get_field('package_includes');
			      $package_includes_heading = get_field('package_includes_heading');
				  $upgrades = get_field('upgrades');
				  $upgrades_heading = get_field('upgrades_heading'); ?>
                  
            <?php if($package_includes || $upgrades): ?>
            <div class="row block-holder text-center">
                <span class="fa fa-angle-right icon"></span>
                <?php if($package_includes || $package_includes_heading ): ?>
                <div class="col-sm-6">
                    <?php if($package_includes_heading): ?><h2><?php echo $package_includes_heading; ?></h2><?php endif; ?>
                    <?php if($package_includes): ?>
                    <div class="block">
                        <ul>
                        	<?php foreach($package_includes as $package_include): ?>
	                            <li><?php echo $package_include['package_title']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <?php if($upgrades || $upgrades_heading): ?>
                <div class="col-sm-6">
                    <?php if($upgrades_heading): ?><h2><?php echo $upgrades_heading; ?></h2><?php endif; ?>
                    <?php if($upgrades): ?>
                    <div class="block">
                        <ul>
                        	<?php foreach($upgrades as $upgrade): ?>
                            	<li><?php echo $upgrade['upgrade_title']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <?php $floorplans = get_field('floorplan');
			      $floorplan_heading = get_field('floorplan_heading');
				  $seating_detail_heading = get_field('seating_detail_heading');
				  $seating_details = get_field('seating_detail'); ?>
                  
            <?php if($floorplans || $seating_details): ?>
            <div class="row block-holder text-center image-block">
                
                <?php if($floorplans || $floorplan_heading): ?>
                <div class="col-sm-6">
                    <?php if($floorplan_heading): ?><h2><?php echo $floorplan_heading; ?></h2><?php endif; ?>
                    <?php foreach($floorplans as $floorplan): ?>
                    <div class="block">
                    	<?php echo wp_get_attachment_image($floorplan['id'], 'package-floorplan-thumbs-454x211');?>
                    </div>
                    <?php endforeach; ?>
                    
                </div>
                <?php endif; ?>
                
                <?php if($seating_detail_heading || $seating_details): ?>
                <div class="col-sm-6">
                    <?php if($seating_detail_heading): ?><h2><?php echo $seating_detail_heading; ?></h2><?php endif; ?>
                    
                    <?php foreach($seating_details as $seating_detail): ?>
                    <div class="block">
                    	<?php echo wp_get_attachment_image($seating_detail['id'], 'package-post-thumbs-350x167');?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
			<?php echo get_field('formstack_form'); ?>
            
			<?php endwhile; endif; ?>
        </section>
    </div>
</div>

<?php get_footer(); ?>