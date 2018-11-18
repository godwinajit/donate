<?php 

/*

  Template Name: Contact Us Page Template

 */

get_header('menubanner');

/** getting custom field values :Meet our Attorneys  */

$office_heading_text = get_field('office_heading_text');
$office_description_text = get_field('office_description_text');
$map_section = get_field('map_section');
 ?>
	
	
	<main id="main" role="main">
		<div class="container">
			<section class="content-section">
				<header class="heading text-center">
					<div class="heading-frame">						
						<?php if($office_heading_text) echo "<h2>".$office_heading_text."</h2>"; ?>
						<div class="divider style-dark"><div></div></div>
					</div>
				</header>
				<div class="center-block intro-info-box text-center">
					<?php if($office_description_text) echo $office_description_text; ?>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-12">
					
					
					<?php while ( have_rows('address__details') ) : the_row();	
							$address = get_sub_field('address');							
							?>
							<div class="aside-box alt arrow-left">
									<?php echo $address ;?>
								</div>								
							<?php 	endwhile;
								?>	
						
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="map-box">
						<?php if($map_section) echo $map_section; ?>							
						</div>
					</div>
				</div>

				<?php 
				/** getting custom field values :Social Links  */
				$facebook = get_field('facebook');
				$twitter = get_field('twitter');
				$google_plus = get_field('google_plus');
				$linkedin = get_field('linkedin');
				?>
				
				<ul class="social-list">
					<?php if($facebook){?><li><a class="icon-facebook" href="<?php echo $facebook; ?>"></a></li><?php }?>
					<?php if($twitter){?><li><a class="icon-twitter" href="<?php echo $twitter; ?>"></a></li><?php }?>
					<?php if($google_plus){?><li><a class="icon-googleplus" href="<?php echo $google_plus; ?>"></a></li><?php }?>
					<?php if($linkedin){?><li><a class="icon-linkedin" href="<?php echo $linkedin; ?>"></a></li><?php }?>
				</ul>
				<div class="accordion" role="tablist" class="panel-group" id="accordion" aria-multiselectable="true">
					<div class="panel panel-default">
					
					
					<?php if( have_rows('tab_content') ):	
					
								$itemcount=1;
								while ( have_rows('tab_content') ) : the_row();														
								$heading_text = get_sub_field('heading_text');								
							?>
						<div id="collapseListGroupHeading<?php echo $itemcount;?>" role="tab" class="panel-heading">
							<h3 class="panel-title">
								<a class="opener" aria-controls="collapseListGroup<?php echo $itemcount;?>" aria-expanded="false" href="#collapseListGroup<?php echo $itemcount;?>" data-toggle="collapse" role="button" data-parent="#accordion"><?php echo $heading_text;?></a>
							</h3>
						</div>
						<div aria-labelledby="collapseListGroupHeading<?php echo $itemcount;?>" role="tabpanel" class="panel-collapse collapse" id="collapseListGroup<?php echo $itemcount;?>" aria-expanded="false">
							<ul class="list-group">
							
							<?php while ( have_rows('answer_text__details') ) : the_row();	
							$answer = get_sub_field('answer');							
							?>
							<li class="list-group-item">
									<?php echo $answer ;?>
								</li>								
							<?php 	endwhile;
								?>	
							</ul>
						</div>
						
						
						<?php   
									$itemcount++;
									endwhile;
									endif;
							 ?>	
						
						
						
						
					</div>
				</div>
			</section>
		</div>
		<a href="#wrapper" class="back-to-top anchor-link"><i class="glyphicon glyphicon-menu-up"></i>Scroll to top</a>
	</main>
	<?php get_footer();?>