<?php 
/*
		Template Name:Single product line Page
	*/
?>
	<?php get_header ();?>	
		<main role="main" id="main">
			<div class="link-group inner">
				<!-- <a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri () ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<ol class="breadcrumb">
						<li><a href="#"><i class="icon-prev"></i> Product lines </a></li>
						<li><a href="#">Airpel Anti-Stiction Air Cylinders</a></li>
						<li><a href="#">Metric Models</a></li>
						<li class="active">Double Acting</li>
					</ol>
					<p>Airpel Anti-Stiction Air Cylinders are available as double acting units. The cylinder rods can be extended and retracted positively with air pressure or vacuum. Airpel Air Cylinders have a pressure range of full vacuum to 100 psi.</p>
					<p>Available in universal and front stud mount configurations, the cylinders exhibit low friction and a high level of accurate force control.</p>
					<div class="table-holder">
						<table class="table table-striped table-sm">
							<tr>
								<th>
									<span class="color-primary">FACTOR</span>
								</th>
								<th>
									<span class="color-primary">
										E9 Double Acting <br /> Bore Size (inch): 0.366
										<a href="#" class="btn-view">VIEW PRODUCT GROUP</a>
									</span>
								</th>
								<th>
									<span class="color-primary">
										E16 Double Acting <br /> Bore Size (inch): 0.627
										<a href="#" class="btn-view">VIEW PRODUCT GROUP</a>
									</span>
								</th>
								<th>
									<span class="color-primary">
										E24 Double Acting <br /> Bore Size (inch): 0.945
										<a href="#" class="btn-view">VIEW PRODUCT GROUP</a>
									</span>
								</th>
							</tr>
							<tr>
								<td >BORE (inches) NOTE: 1281" Bore Available in Metric</td>
								<td><strong>.366</strong></td>
								<td><strong>.627</strong></td>
								<td><strong>.945</strong></td>
							</tr>
							<tr>
								<td>PISTON AREA (sq. inch)</td>
								<td>.105</td>
								<td>.307</td>
								<td>.701</td>
							</tr>
							<tr>
								<td>PRESSURE RANGE: FULL VACUUM TO - (PSI)</td>
								<td>100</td>
								<td>100</td>
								<td>100</td>
							</tr>
							<tr>
								<td>FORCE OUTPUT AT MAX PRESSURE ON REAR SIDE (lbs)</td>
								<td>10.5</td>
								<td>30.7</td>
								<td>70.1</td>
							</tr>
							<tr>
								<td>FORCE OUTPUT AT MAX PRESSURE ON ROD SIDE (lbs)</td>
								<td>9.3</td>
								<td>27.6</td>
								<td>65.2</td>
							</tr>
							<tr>
								<td>FORCE FACTOR REAR SIDE (factor x pressure-force out- put)</td>
								<td>.105</td>
								<td>.307</td>
								<td>.701</td>
							</tr>
							<tr>
								<td>FORCE FACTOR ROD SIDE (factor x pressure-force output)</td>
								<td>.093</td>
								<td>.276</td>
								<td>652</td>
							</tr>
							<tr>
								<td>MIN PRESSURE DIFFERENTIAL REQD FOR ACTUATION (PSI)</td>
								<td>&lt;.2</td>
								<td>&lt;.2</td>
								<td>&lt;.2</td>
							</tr>
							<tr>
								<td>PISTON FRICTION AS % OF LOAD (without side load)</td>
								<td>1%-2%</td>
								<td>1%-2%</td>
								<td>1%-2%</td>
							</tr>
							<tr>
								<td>OPERATING TEMPERATURE RANGE</td>
								<td>-55&deg;C to +150&deg;C</td>
								<td>.627</td>
								<td>.945</td>
							</tr>
							<tr>
								<td>PISTON/ROD ASSY WEIGHT(grams): <br/>Single rod end models <br/>Double rod end models</td>
								<td>4.5+(1.36 x STROKE) <br/>9.93+(3.24 x STROKE)</td>
								<td>16+(3.6 x STROKE) <br/>29.08+(8.00 x STROKE)</td>
								<td>40.64+(6.46 x STROKE) <br/>73.28+(12.92 x STROKE)</td>
							</tr>
							<tr>
								<td>WEIGHT OF COMPLETE UNIT (grams) <br/>Single rod end models <br/>Double rod end models</td>
								<td>31.7+(9.52 x STROKE) <br/>38.46+(11.74 x STROKE)</td>
								<td>64.6+(15.8 x STROKE) <br/>84.49+(21.68 x STROKE)</td>
								<td>156.42+(31.12 x STROKE) <br/>203.9+(37.58 x STROKE)</td>
							</tr>
							<tr>
								<td>MAX LEAK RATE at 50 PSI - by Piston: SL / min</td>
								<td>1.16</td>
								<td>1.39</td>
								<td>2.2</td>
							</tr>
							<tr>
								<td>MAX LEAK RATE at 50 PSI - by Rod: SL / min</td>
								<td>2.2</td>
								<td>2.6</td>
								<td>2.6</td>
							</tr>
						</table>
					</div>
				</div>
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
			<?php get_footer ();?>