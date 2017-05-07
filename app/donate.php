<?php 
require_once 'src/handlePayments.php';
include('../../wp-load.php');
?>

<?php //get_header();?>
	<?php get_template_part( 'donateheader' ); ?>
		<main class="main">
		<div class="breadcrumbs">
			<div class="wrapper container-fluid">
				<div class="row center-xs">
					<div class="col-xs-10">
						<ul class="breadcrumbs-nav">
							<li><a href="home.html">Home</a></li>
							<li>Donate</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<form id="donate-form" action="" class="donate-form" method="post">
			<ul class="donate-form-nav">
				<li
					<?php if (!$isPaymentStep) { echo 'class="step-active"';}else echo 'class="step-passed"';?>>
					<a href="#"> <span class="title">Amount</span> <span class="number">1</span>
						<span class="badge"> <span class="icon icon-check"></span>
					</span>
				</a>
				</li>
				<li
					<?php if (!$isPaymentStep) { echo '';}else echo 'class="step-passed"';?>>
					<a href="#"> <span class="title">Details</span> <span
						class="number">2</span> <span class="badge"> <span
							class="icon icon-check"></span>
					</span>
				</a>
				</li>
				<li <?php if ( ($isPaymentStep) && ($transactionStatus != 'SUCCESS')) { echo 'class="step-active"';}?>><a
					href="#"> <span class="title">Payment</span> <span class="number">3</span>
						<span class="badge"> <span class="icon icon-check"></span>
					</span>
				</a></li>
				<li><a href="#"> <span class="title">Finish</span> <span
						class="number">4</span> <span class="badge"> <span
							class="icon icon-check"></span>
					</span>
				</a></li>
			</ul>
			<?php if ($transactionDetails){?>
				<div class="row center-xs <?php echo $alertCSS;?> vertical-center">
					<div id="formMessage" class="col-xs-10" style="margin-top: 10px;">
						<?php echo $transactionDetails. ' : '.$transactionStatus;?>
					</div>
				</div>
			<?php }?>
			<div
				class="donate-form-step <?php if (!$isPaymentStep) { echo 'active'; }?>">
				<div class="wrapper container-fluid">
					<div class="row center-xs">
						<div class="col-xs-11 col-md-10">
							<h1>
								<span>Step 1</span> Amount
							</h1>
							<h2>I want to make a</h2>
							<ul class="donate-options-list">
								<li><input type="radio" name="merchant-defined-field-12" id="rad01"
									value="single" <?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-12') == 'single' ) || !retriveDonorField($transactionStatus,'merchant-defined-field-12') ) echo 'checked';?>> <label for="rad01">Single donation</label></li>
								<li><input type="radio" name="merchant-defined-field-12" id="rad02"
									value="recurring" <?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-12') == 'recurring' ) && (retriveDonorField($transactionStatus,'merchant-defined-field-12') )) echo 'checked';?>> <label for="rad02">Monthly donation</label>
								</li>
							</ul>
							<div class="donate-sum">
								<div class="row">
									<div class="col-xs-12 col-md-4">
										<a href="#" class="donate-sum-box" data-donate-sum="50">
											<div class="image">
												<div class="bg-stretch"
													style="background: #fff url('images/bg-donate01.jpg') 50% 50% no-repeat; background-size: cover;"></div>
											</div>
											<div class="text">
												<span class="title">Prevention</span>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
													sed do.</p>
											</div> <span class="sum">+ $50</span>
										</a>
									</div>
									<div class="col-xs-12 col-md-4">
										<a href="#" class="donate-sum-box" data-donate-sum="100">
											<div class="image">
												<div class="bg-stretch"
													style="background: #fff url('images/bg-donate02.jpg') 50% 50% no-repeat; background-size: cover;"></div>
											</div>
											<div class="text">
												<span class="title">Ticks</span>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
													sed do.</p>
											</div> <span class="sum">+ $100</span>
										</a>
									</div>
									<div class="col-xs-12 col-md-4">
										<a href="#" class="donate-sum-box" data-donate-sum="250">
											<div class="image">
												<div class="bg-stretch"
													style="background: #fff url('images/bg-donate03.jpg') 50% 50% no-repeat; background-size: cover;"></div>
											</div>
											<div class="text">
												<span class="title">Investigation</span>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
													sed do.</p>
											</div> <span class="sum">+ $250</span>
										</a>
									</div>
								</div>
								<div class="donate-sum-choice-box02">
									<h3>Or donate another amount</h3>
									<div class="input-holder">
										<input id="donate-1" name="donate" type="number" min="1" value="<?php if( retriveDonorField($transactionStatus,'donate') ) echo retriveDonorField($transactionStatus,'donate');?>"
											 required> <a href="#" class="btn btn-blue js-btn-step-next">Donate</a>
									</div>
								</div>
							</div>
							<a href="#"
								class="btn btn-primary btn-primary-green btn-continue">Donate by
								mail</a>
							<div class="text-note">
								<p>Global Lyme Alliance is a 501(c)(3) charitable organization.
									Tax ID is 06-1559393.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="donate-form-step">
				<div class="wrapper container-fluid">
					<div class="row center-xs">
						<div class="col-xs-11 col-md-10">
							<h1>
								<span>Step 2</span> Details
							</h1>
							<div class="toggle-content expanded">
								<a href="#" class="toggle-content-opener">Your information <span
									class="icon icon-plus"></span><span class="icon icon-minus"></span></a>
								<div class="toggle-content-slide">
									<div class="row">
										<div class="col-xs-12 col-md-6 col-md-short">
											<label>Title</label> <select name="merchant-defined-field-3">
												<option value="" class="hideme">Select one</option>
												<option <?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-3') == 'Mr.' ) ) echo 'selected="selected"';?> value="Mr.">Mr.</option>
												<option <?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-3') == 'Mrs.' ) ) echo 'selected="selected"';?>value="Mrs.">Mrs.</option>
												<option <?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-3') == 'Ms.' ) ) echo 'selected="selected"';?>value="Ms.">Ms.</option>
												<option <?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-3') == 'Dr.' ) ) echo 'selected="selected"';?>value="Dr.">Dr.</option>
											</select>
											
											<label for="input01">* First name</label>
											<input type="text" id="input01" name="merchant-defined-field-1" required 
											value="<?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-1') ) ) echo retriveDonorField($transactionStatus,'merchant-defined-field-1');?>">
											
											<label for="input02">* Last name</label>
											<input type="text" id="input02" name="merchant-defined-field-2" required 
											value="<?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-2') ) ) echo retriveDonorField($transactionStatus,'merchant-defined-field-2');?>">
											
											<label for="input022">* Email</label>
											<input type="email" id="input022" name="email" required 
											value="<?php if( ( retriveDonorField($transactionStatus,'email') ) ) echo retriveDonorField($transactionStatus,'email');?>">
											
											<div class="checkbox-row">
												<input type="checkbox" id="check01" name="merchant-defined-field-4" value="Y"
												<?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-4') == 'Y' ) ) echo 'checked="checked"';?>>
												<label for="check01">This is a corporate donation</label>
											</div>
											
											<div class="checkbox-row">
												<input type="checkbox" id="check02" name="merchant-defined-field-5" value="YES"
												<?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-5') == 'YES' ) ) echo 'checked="checked"';?>>
												<label for="check02">My company has a <a href="#">matching gift program</a>
												</label>
											</div>
											
											<label for="input03">Company name</label> 
											<input type="text"  id="input03" name="company"
												value="<?php if( ( retriveDonorField($transactionStatus,'company') ) ) echo retriveDonorField($transactionStatus,'company');?>"> 
												<label>Country</label>
												<select name="country" required>												
													<?php getCountries(retriveDonorField($transactionStatus,'country'));?>
												</select>
										<!--  <input type="hidden"  id="country" name="country" value="US">  -->
										</div>
										<div class="col-xs-12 col-md-6 col-md-short">
											<label for="input04">* Address #1</label>
											<input type="text" id="input04" name="address1" required 
											value="<?php if( ( retriveDonorField($transactionStatus,'address1') ) ) echo retriveDonorField($transactionStatus,'address1');?>">
											
											<label for="input05">Address #2</label>
											<input type="text" id="input05" name="address2"
											value="<?php if( ( retriveDonorField($transactionStatus,'address2') ) ) echo retriveDonorField($transactionStatus,'address2');?>">
											
											<label for="input06">* City</label>
											<input type="text" id="input06" name="city" required 
											value="<?php if( ( retriveDonorField($transactionStatus,'city') ) ) echo retriveDonorField($transactionStatus,'city');?>">
											
											<label>* State/Province</label>
											<select name="state" required>
												<?php getStates(retriveDonorField($transactionStatus,'state'));?>
											</select>
											
											<label for="input07">* Zip/Postal code</label>
											<input type="text" name="postal" required 
											value="<?php if( ( retriveDonorField($transactionStatus,'postal') ) ) echo retriveDonorField($transactionStatus,'postal');?>">
											
											<label for="input08">Phone number</label>
											<input type="tel" id="input08" name="phone"
											value="<?php if( ( retriveDonorField($transactionStatus,'phone') ) ) echo retriveDonorField($transactionStatus,'phone');?>">
										</div>
										<div class="form-note" style="display: none">* Complete the
											required fields</div>
									</div>
								</div>
							</div>
							<div class="toggle-content">
								<a href="#" id="isATributeID" class="toggle-content-opener">IS THIS DONATION IN
									tribute OF SOMEONE?<span class="icon icon-plus"></span><span
									class="icon icon-minus"></span> <span class="answer md-visible">Yes</span>
								</a>
								<div class="toggle-content-slide">
									<div class="row">
										<div class="col-xs-12 col-md-6  col-md-short">
											<label>Type of Tribute</label>
											<input type="hidden"  id="tributeEnabled" name="tributeEnabled" value="NO">
											<select name="merchant-defined-field-9">
												<option value="" class="hideme">Select one</option>
												<option <?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-9') == 'M' ) ) echo 'selected="selected"';?> value="M">In Memory of</option>
												<option <?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-9') == 'H' ) ) echo 'selected="selected"';?> value="H">In Honor of</option>
											</select>
											<label for="input09">* First name</label>
											<input type="text" id="input09" name="merchant-defined-field-6" required 
											value="<?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-6') ) ) echo retriveDonorField($transactionStatus,'merchant-defined-field-6');?>">
											
											<label for="input10">Last Name</label>
											<input type="text" id="input10" name="merchant-defined-field-7"
											value="<?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-7') ) ) echo retriveDonorField($transactionStatus,'merchant-defined-field-7');?>">

											<label for="input0222">Email</label>
											<input type="email" id="input0222" name="tributeEmail"  
											value="<?php if( ( retriveDonorField($transactionStatus,'tributeEmail') ) ) echo retriveDonorField($transactionStatus,'tributeEmail');?>">
										</div>
										<div class="col-xs-12 col-md-6 col-md-short">
											<label for="input055">Address</label>
											<input type="text" id="input055" name="tributeAddress"
											value="<?php if( ( retriveDonorField($transactionStatus,'tributeAddress') ) ) echo retriveDonorField($transactionStatus,'tributeAddress');?>">
											
											<label for="input066">City</label>
											<input type="text" id="input066" name="tributeCity"  
											value="<?php if( ( retriveDonorField($transactionStatus,'tributeCity') ) ) echo retriveDonorField($transactionStatus,'tributeCity');?>">
											
											<label>State/Province</label>
											<select name="tributeState">
												<?php getStates(retriveDonorField($transactionStatus,'tributeState'));?>
											</select>
											
											<label for="input077">Zip/Postal code</label>
											<input type="text" name="tributePostal"  
											value="<?php if( ( retriveDonorField($transactionStatus,'tributePostal') ) ) echo retriveDonorField($transactionStatus,'tributePostal');?>">
											
										</div>
										<div class="form-note" style="display: none">* Complete the
											required fields</div>
									</div>
								</div>
							</div>
							<div class="donate-sum-choice-box">
								<label>Your Donation</label>
								<input id="donate-2" name="donate" type="number" min="1" required 
								value="<?php if( retriveDonorField($transactionStatus,'donate') ) echo retriveDonorField($transactionStatus,'donate');?>">
							</div>
							<input id="step2-submit" type="button" value="Continue" class="btn btn-default btn-continue js-btn-step-next">
							<div class="text-note">
								<p>Global Lyme Alliance is a 501(c)(3) charitable organization.
									Tax ID is 06-1559393.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="donate-form-step <?php if (($isPaymentStep)) { echo 'active';}?>">
				<div class="wrapper container-fluid">
					<div class="row center-xs">
						<div class="col-xs-11 col-md-10">
							<h1>
								<span>Step 3</span> Payment
							</h1>
							<div class="row">
								<div class="col-xs-12 col-md-6  col-md-short">
									<div class="toggle-content expanded static-expand">
										<a href="#" class="toggle-content-opener">Credit card
											information <span class="icon icon-plus"></span><span
											class="icon icon-minus"></span>
										</a>
										<div class="toggle-content-slide">
										<div class="checkbox-row">
												<input type="checkbox" id="check03" name="merchant-defined-field-10" 
												<?php if( ( retriveDonorField($transactionStatus,'merchant-defined-field-10') == 'on' ) ) echo 'checked="checked"';?>>
												<label for="check03">Same as personal details</label>
											</div>
											<label for="input11">* Card holder first name <img
												src="images/img-cards.jpg" alt=""></label>
											<input type="text" id="input11" name="billing-first-name" required 
											value="<?php if( retriveDonorField($transactionStatus,'billing-first-name') ) echo retriveDonorField($transactionStatus,'billing-first-name');?>">
											
											<label for="input111">* Card holder last name </label>
											<input type="text" id="input111" name="billing-last-name" required 
											value="<?php if( retriveDonorField($transactionStatus,'billing-last-name') ) echo retriveDonorField($transactionStatus,'billing-last-name');?>">
											
											<label for="input12">* Card account number</label>
											<input type="text" id="input12" name="billing-cc-number" required>
											
											<label>* Expiration date <i>( Format: MMYY )</i></label>
											<input type="text" id="input12" name="billing-cc-exp" required>
											<!-- 
                                                    <div class="row">
                                                       <div class="col-xs-6">
                                                            <select name="step3_card_exp_date">
                                                                <option class="hideme">Day</option>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <select name="step3_card_exp_year">
                                                                <option class="hideme">Year</option>
                                                                <option>2015</option>
                                                                <option>2016</option>
                                                                <option>2017</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                     -->
                                                     <!-- TM Add trigger Popup -->
											<label for="input13">* Security code click <a id="OpenCVV" href="#">here</a>
												for CVV2 information
											</label>
											<input type="password" id="input13" name="billing-cvv">
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-md-6  col-md-short">
									<div class="toggle-content expanded static-expand">
										<a href="#" class="toggle-content-opener">Billing address <span
											class="icon icon-plus"></span><span class="icon icon-minus"></span></a>
										<div class="toggle-content-slide">
											<label for="input14">* Address</label>
											<input type="text" id="input14" name="billing-address1" required 
											value="<?php if( retriveDonorField($transactionStatus,'billing-address1') ) echo retriveDonorField($transactionStatus,'billing-address1');?>"> 
											
											<label for="input15">* Country</label>
											<select name="billing-country" required>
												<?php getCountries(retriveDonorField($transactionStatus,'billing-country'));?>
											</select>
											<!-- <input type="hidden"  id="billing-country" name="country" value="billing-country"> -->
											<label for="input16">* City</label>
											<input type="text" id="input16" name="billing-city" required 
											value="<?php if( retriveDonorField($transactionStatus,'billing-city') ) echo retriveDonorField($transactionStatus,'billing-city');?>">
											
											<label>* State/Province</label>
											<select name="billing-state" required>
												<?php getStates(retriveDonorField($transactionStatus,'billing-state'));?>
											</select>
											
											<label for="input17">* Zip/Postal code</label>
											<input type="text" id="input17" name="billing-postal" required 
											value="<?php if( retriveDonorField($transactionStatus,'billing-postal') ) echo retriveDonorField($transactionStatus,'billing-postal');?>">
											<div class="checkbox-row">
												<input type="checkbox" id="check04" checked name="merchant-defined-field-dummy" required value="Y"  disabled="disabled" checked="checked">
												<input type="hidden" id="check05" name="merchant-defined-field-8" value="Y" />
												<label for="check04">I
													understand that by submitting a donation, my information
													will be automatically added to GLA's secure database.</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="donate-sum-choice-box">
								<label>Your Donation</label> <input id="donate-3" name="donate"
									type="number" min="1" disabled="disabled" value="<?php if( retriveDonorField($transactionStatus,'donate') ) echo retriveDonorField($transactionStatus,'donate');?>">
							</div>
							<input id="step3-submit" type="submit" value="Continue"
								class="btn btn-default btn-continue">
							<div class="text-note">
								<p>Global Lyme Alliance is a 501(c)(3) charitable organization.
									Tax ID is 06-1559393.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="donate-form-step">
				<div class="wrapper container-fluid">
					<div class="row center-xs">
						<div class="col-xs-11 col-md-10">
							<h1>
								<span>Step 4</span> Finish
							</h1>
							<div class="logo-finish">
								<img src="images/logo-finish.svg" alt="">
							</div>
							<h2>Thank You</h2>
							<div class="finish-text-holder">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
									do eiusmod tempor incididunt ut labore et dolore magna aliqua.
									Ut enim ad minim veniam, quis nostrud</p>
							</div>
							<div class="donation-summary">
								<div class="donation-summary-box personal-info">
									<div class="box-holder">
										<h3>Your Donation</h3>
										<span>Jesus Summers</span> <span>8 (495) 358-23-75</span> <span>French
											Southern Territories</span> <span>20090042</span> <span>52
											Little Valley Suite 117</span>
									</div>
								</div>
								<div class="donation-summary-box">
									<div class="total-sum">
										<span class="title">Total donated</span> <strong
											class="amount">$250</strong>
									</div>
									<div class="box-holder">
										<h3>Lorem ipsum dolor</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
											sed do eiusmod tempor incididunt ut labore et dolore magna
											aliqua. Ut enim ad minim veniam, quis nostrud exercitation
											ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
											aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint
											occaecat cupidatat non proident, sunt in culpa qui officia
											deserunt mollit anim id</p>
									</div>
									<div class="gla-info">
										<p>Global Lyme Alliance is a 501(c)(3) charitable
											organization. Tax ID is 06-1559393.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<section class="section-news">
					<div class="wrapper container-fluid">
						<div class="row center-xs">
							<div class="col-xs-10">
								<h2>Keep updated</h2>
								<h3>View the latest news today for Lyme disease.</h3>
							</div>
						</div>
					</div>
					<div class="news-block">
						<div class="row">
							<div class="col-xs-6 col-md-4">
								<a href="#" class="news-box news-box-image">
									<div class="bg-stretch"
										style="background: #fff url('images/bg-news01.jpg') 50% 50% no-repeat; background-size: cover;"></div>
								</a> <a href="#" class="news-box arrow-top"> <span
									class="text-holder"> <strong class="subtitle">BLOG</strong> <span
										class="title">Sweeping health measure, backed by Obama, passes
											senate</span>
								</span>
								</a> <a href="#" class="news-box news-box-video">
									<div class="bg-stretch"
										style="background: #fff url('images/bg-news03.jpg') 50% 50% no-repeat; background-size: cover;"></div>
									<span class="icon icon-play-circle"></span>
								</a>
							</div>
							<div class="col-xs-6 col-md-4">
								<a href="#" class="news-box arrow-bottom"> <span
									class="text-holder"> <strong class="subtitle">NEWS</strong> <span
										class="title">Yolanda Hadid talks Lyme disease on good day New
											York</span>
								</span>
								</a> <a href="#" class="news-box news-box-image news-box-high">
									<div class="bg-stretch"
										style="background: #fff url('images/bg-news02.jpg') 50% 50% no-repeat; background-size: cover;"></div>
								</a>
							</div>
							<div class="col-xs-12 col-md-4">
								<a href="#" class="news-box news-box-short news-box-image">
									<div class="bg-stretch"
										style="background: #fff url('images/bg-news04.jpg') 50% 50% no-repeat; background-size: cover;"></div>
								</a> <a href="#" class="news-box news-box-short arrow-right"> <span
									class="text-holder"> <strong class="subtitle">NEWS</strong> <span
										class="title">Gla partners with the mighty to increase
											awareness of Lyme disease</span>
								</span>
								</a> <a href="#" class="news-box news-box-blue md-visible"> <span
									class="text-holder"> <span class="icon icon-twitter"></span> <span
										class="title">Global Lyme Alliance</span> <span> 200 kids get
											<span class="text-dark-blue">#LymeDisease</span> every day.
											How many more R misdiagnosed? Donate 4 accurate diagnostic
											test <span class="text-dark-blue">#GivingTuesday</span> <span
											class="text-dark-blue">http://donate4lyme.com</span>
									</span>
								</span>
								</a>
							</div>
						</div>
						<div class="social-block">
							<div class="row">
								<div class="col-xs-4">
									<a href="#" class="social-box social-box-youtube"> <span
										class="social-holder"> <span class="icon icon-play-circle"></span>
											<strong class="title md-visible">Watch our videos</strong>
									</span>
									</a>
								</div>
								<div class="col-xs-4">
									<a href="#" class="social-box social-box-facebook"> <span
										class="social-holder"> <span class="icon icon-facebook-square"></span>
											<strong class="title md-visible">Like us on facebook</strong>
									</span>
									</a>
								</div>
								<div class="col-xs-4">
									<a href="#" class="social-box social-box-twitter"> <span
										class="social-holder"> <span class="icon icon-twitter"></span>
											<strong class="title md-visible">Follow us on Twitter</strong>
									</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="section-subscribe">
					<div class="wrapper container-fluid">
						<div class="row center-xs">
							<div class="col-xs-12 col-sm-11 col-md-10">
								<div class="subscribe-form">
									<span class="icon icon-mail sm-visible"></span>
									<h2>Subscribe and get involved with us</h2>
									<div class="form-row">
										<input type="email" placeholder="Insert your email here"> <input
											type="submit" value="Subscribe">
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</form>
		</main>
		</div>
		  <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/donate.js"></script>
	<script type="text/javascript">
            var currentActiveStep = 0;
            <?php if ($isPaymentStep) { echo 'currentActiveStep = 2;'; }?>
            <?php if (! empty ( $_GET ['token-id'] )) { ?>
                jQuery(function($) {
                    $.ajax({
                        type: "POST",
                        url: 'src/getSafeSaveURL.php',
                        data : $("#donate-form").serialize(),
                        success: function(data){
                            $('#donate-form').attr('action', data);
                        },
                        error: function(jqxhr) {
                            $("#register_area").text(jqxhr.responseText); // @text = response error, it is will be errors: 324, 500, 404 or anythings else
                        }
                    });
                });
        <?php }?>
    </script>
	<?php get_template_part( 'donatefooter' ); ?>
</body></html>
