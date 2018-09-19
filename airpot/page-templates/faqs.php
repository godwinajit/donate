<?php 
/*
		Template Name:Faqs Page
	*/
?>
	<?php get_header ();?>
	

		<main role="main" id="main">
			<div class="link-group">
				<a href="/product-category/product-lines"><span>Product Lines</span></a>
			<!--	<a href="<?php echo  get_home_url(); ?>/generate-3d-model" class="model3d-link"><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico04.png" alt="image description">Create Your Own 3D Model</span></a> -->
			</div>
			<section class="main-section inner">
				<div class="container">
					<div class="headline text-uppercase">
						<h1>Support</h1>
					</div>
					<div class="row">
						<div class="col-sm-9 col-md-9 col-sm-push-3" id="content">
							<div class="content-section">
								<h2 class="h3">FREQUENTLY ASKED QUESTIONS</h2>
								<div role="tabpanel" class="tabs-default">
								<ul class="nav nav-tabs same-holder" role="tablist">
									<li role="presentation" class="active"><a class="same-height" href="#tab-01" aria-controls="tab-01" role="tab" data-toggle="tab"><span>AIRPOT</span></a></li>
									<li role="presentation"><a class="same-height" href="#tab-02" aria-controls="tab-02" role="tab" data-toggle="tab"><span>AIRPEL</span></a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="tab-01">
									<!--<div role="tabpanel-edit" class="tab-pane-edit active" id="tab-01-edit">-->
										<form action="#" class="form form-horizontal" role="form">
											<fieldset>
											
												<div class="form-group">	
												
													<label for="lbl01" class="col-sm-4 col-md-3 col-lg-2 control-label">Select Category</label>
													<div class="col-sm-5 col-md-5">																							
														<?php //echo do_shortcode( '[contact-form-7 id="78" title="Airpot Faqs Category Form"]' );?>
														
													<form action="<?php bloginfo('url'); ?>" method="get">
    <?php
    
    global $post;    
    if ( is_page() && $post->post_parent )
    {
    	$currPage = ( is_page() ) ? $post->ID : 0;
    $select = wp_dropdown_pages('show_option_none=Select a Topic&option_none_value='.$post->post_parent.'&sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&selected=' . $currPage . '&echo=0' );
    }
    else 
	{
	$select = wp_dropdown_pages( 'show_option_none=Select a Topic&sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	}

    echo str_replace('<select ', '<select onchange="this.form.submit()" ', $select);
    ?>		
    </div>
    							
												</div>
											</fieldset>
										</form>
										<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
											
												<?php if( have_rows('airpot_faq_section') ):
													$rows = get_field('airpot_faq_section' ); // get all the rows
													$rowcount=count($rows);										
													$i=1;						
												 		while( have_rows('airpot_faq_section') ): the_row(); ?>
												 		<div class="panel panel-primary">
												 		<div class="panel-heading" role="tab" id="heading0<?php echo $i;?>">
															<h4 class="panel-title">
																<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse0<?php echo $i;?>" aria-expanded="false" aria-controls="collapse0<?php echo $i;?>">
																	<?php echo get_sub_field('questions');?>
																</a>
															</h4>
														</div>
														<div id="collapse0<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading0<?php echo $i;?>">
															<div class="panel-body">
                                                             	<?php echo get_sub_field('answers');?>
															</div>
														</div>	
													</div>												 		
												<?php 	$i++; endwhile;?>
											    <?php endif; ?>							
											
											
										</div>
										<div class="row">
											<div class="divider"></div>
										</div>
										<div class="row">
											<div class="col-sm-5">
												<h3>Can't find an answer? Ask Us!</h3>												
													<?php echo do_shortcode( '[contact-form-7 id="76" title="Airpot Faq Form" html_class="form"]' );?>
												
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="tab-02">
										<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
											<?php if( have_rows('airpel_faq_section') ):
													$rows = get_field('airpel_faq_section' ); // get all the rows
													$rowcount=count($rows);										
													$i=100;						
												 		while( have_rows('airpel_faq_section') ): the_row(); ?>
												 		<div class="panel panel-primary">
												 		<div class="panel-heading" role="tab" id="heading0<?php echo $i;?>">
															<h4 class="panel-title">
																<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse0<?php echo $i;?>" aria-expanded="false" aria-controls="collapse0<?php echo $i;?>">
																	<?php echo get_sub_field('questions');?>
																</a>
															</h4>
														</div>
														<div id="collapse0<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading0<?php echo $i;?>">
															<div class="panel-body">
                                                             	<?php echo get_sub_field('answers');?>
															</div>
														</div>	
													</div>												 		
												<?php 	$i++; endwhile;?>
											    <?php endif; ?>				
										</div>
										<div class="row">
											<div class="divider"></div>
										</div>
										<div class="row">
											<div class="col-sm-5">
												<h3>Can't find an answer? Ask Us!</h3>												
													<?php echo do_shortcode( '[contact-form-7 id="77" title="Airpel Faqs Form" html_class="form"]' );?>												
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
						<aside class="col-sm-3 col-sm-pull-9">
							<?php wp_nav_menu(array(
							'container'       => 'nav',
							'container_class' => 'add-nav',
							'container_id'    => '',
								'menu' => 'Left Menu', 	
								'menu_class'      => 'list-unstyled'						
							)); ?>
						</aside>
					</div>
				</div>
			</section>
			<?php dynamic_sidebar( 'sidebar-contactus' );?>
		</main>
<?php get_footer ();?>