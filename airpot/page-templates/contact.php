<?php 
/*
		Template Name:Contact Page
	*/
$content1 = get_field('content1');
$content2 = get_field('content2');
$content3 = get_field('content3');
$content4 = get_field('content4');
$content5 = get_field('content5');
?>
	<?php get_header ();?>	
		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
			<!--	<a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<div class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>Contact Us</h1>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p>Thank you for your interest in Airpot Corporation. Please fill out the following form and we will respond within 24 hours of the next business day.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">							
							<?php echo do_shortcode( '[contact-form-7 id="59" title="Contact form 1"]' );?>		
						</div>
						<div class="col-sm-8">
							<div class="well well-lg contact">
							<?php if($content1):?><?php echo $content1;?><?php endif;?>
							
							</div>
							<ul class="contact-list list-unstyled">
								<li class="icon-phone">
								<?php if($content2):?><?php echo $content2;?><?php endif;?>
								
								</li>
								<li class="icon-envelop">
								<?php if($content3):?><?php echo $content3;?><?php endif;?>
									
								</li>
								<li class="icon-phone">
								<?php if($content4):?><?php echo $content4;?><?php endif;?>
								
								</li>
								<li class="icon-fax">
								<?php if($content5):?><?php echo $content5;?><?php endif;?>
									
								</li>
							</ul>
							
							
<?php
$location = get_field('map');
if( ! empty($location) ):
?>
<div id="map" style="width: 100%; height: 450px;margin-bottom:20px;"></div>
<script src='http://maps.googleapis.com/maps/api/js?sensor=false' type='text/javascript'></script>

<script type="text/javascript">
  //<![CDATA[
	function load() {
	var lat = <?php echo $location['lat']; ?>;
	var lng = <?php echo $location['lng']; ?>;
// coordinates to latLng
	var latlng = new google.maps.LatLng(lat, lng);
// map Options
	var myOptions = {
	zoom: 14,
	center: latlng,
	mapTypeId: google.maps.MapTypeId.ROADMAP
   };
//draw a map
	var map = new google.maps.Map(document.getElementById("map"), myOptions);
	var marker = new google.maps.Marker({
	position: map.getCenter(),
	map: map
   });
}
// call the function
   load();
//]]>
</script>
<?php endif; ?> 

<?php if( have_rows('representative') ): ?>
							
							<div class="row">
								<div class="col-md-12">
								
								<?php while( have_rows('representative') ): the_row(); 
								$name = get_sub_field('name');
								$image = get_sub_field('image');
								$designation = get_sub_field('designation');
								$email = get_sub_field('email');
								?>							
									<div class="col-xs-6 col-sm-4 people-info">
										<div class="thumbnail">											
											<?php if($image):?> <img src="<?php echo $image;?>" height="169" width="139" alt="img"> <?php endif;?>
											<div class="caption">
												<h4><a href="#"><?php if($name):?><?php echo $name;?><?php endif;?></a></h4>
												<span class="position"><?php if($designation):?><?php echo $designation;?><?php endif;?></span>
												<a class="icon-envelop" href="mailto:<?php if($email):?><?php echo $email;?><?php endif;?>"><?php if($email):?><?php echo $email;?><?php endif;?></a>
											</div>
										</div>
									</div>									
									<?php endwhile; ?>
								</div>
							</div>
							
<?php endif;?>							
							<div class="two-column">
								<h3>Find a Representative or Distributor</h3>
								<p>Please select a product line and then click on country, state, or territory to find your local sales representative or distributor. All of our products can be purchased direct from the factory.</p>
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label for="a1" class="col-sm-2 control-label">Product Line:</label>
										<div class="col-sm-4">
											<select name="product_lines" id="product_lines" onChange="getContinentList();">
												<option value="default">Select</option>
												<option value="actuators">Actuators</option>
												<option value="airpel_ab_air_bearing_actuators">Airpel -AB Air Bearing Actuators</option>
												<option value="airpel_air_cylinders">Airpel Air Cylinders</option>
												<option value="airpel_plus">Airpel Plus</option>
												<option value="dashpots">Dashpots</option>
												<option value="ffr_filter_regulator_systems">FFR Filter Regulator Systems</option>
												<option value="floating_joints">Floating Joints</option>
												<option value="flow_controls">Flow Controls</option>
												<option value="piston_and_cylinder_sets">Piston and Cylinder Sets</option>
												<option value="snubbers">Snubbers</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="a2" class="col-sm-2 control-label">Location:</label>
										<div class="col-sm-4" id="continentListDiv">
											<select name="continentList" id="continentList" onChange="getCountryList(this.value);">
												
											</select>
										</div>
										<div class="col-sm-4"  id="countryListDiv">
											<select name="select" id="countryList" onChange="getRepresentativeList(this.value, <?php echo get_queried_object_id();?>);">
												
											</select>
										</div>
									</div>
								</form>
								<div id="representativeDetails" style="border : 2px solid #cacaca;padding : 10px 25px;display: none;">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
<?php get_footer ();?>