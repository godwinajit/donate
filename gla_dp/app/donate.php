<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Global Lyme Alliance</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css">
	</head>
	<body>
	<?php 
		$isPaymentStep = false;
		if (!empty($_GET['token-id'])) { $isPaymentStep = true; }
		require_once 'safeSave/safeSaveLib.php';
	?>
		<div class="page">
            <header class="header">
                <div class="wrapper container-fluid">
                    <div class="row center-xs">
                        <div class="col-xs-11 col-lg-10">
                            <a href="#" class="logo">Global Lyme Alliance</a>
                            <div class="right-holder">
                                <a href="#" class="search-opener">
                                    <span class="icon-search"></span>
                                </a>
                                <a href="#" class="nav-opener">
                                    <span class="icon-burger"></span>
                                </a>
                            </div>
                            <nav class="nav">
                                <ul class="nav-list">
                                    <li class="accordion-active">
                                        <a href="#" class="accordion-opener">UNDERSTANDING LYME</a>
                                        <div class="accordion-slide">
                                            <ul>
                                                <li class="accordion-active">
                                                    <a href="#" class="accordion-opener">Prevention</a>
                                                    <div class="accordion-slide">
                                                        <ul>
                                                            <li><a href="#">About Ticks</a></li>
                                                            <li><a href="#">Other Tick-Borne Diseases (TBDS)</a></li>
                                                            <li><a href="#">Tick Removal</a></li>
                                                            <li><a href="#">Product to Protect You</a></li>
                                                            <li><a href="#">Pets</a></li>
                                                            <li><a href="#">Children</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#" class="accordion-opener">Diagnosis</a>
                                                    <div class="accordion-slide">
                                                        <ul>
                                                            <li><a href="#">Lorem ipsum dolor</a></li>
                                                            <li><a href="#">sit amet, consectetur adipisicing</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#">culpa dicta ducimus</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#" class="accordion-opener">Treatment</a>
                                                    <div class="accordion-slide">
                                                        <ul>
                                                            <li><a href="#">Lorem ipsum dolor</a></li>
                                                            <li><a href="#">sit amet, consectetur adipisicing</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#">culpa dicta ducimus</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" class="accordion-opener">OUR RESEARCH</a>
                                        <div class="accordion-slide">
                                            <ul>
                                                <li class="accordion-active">
                                                    <a href="#" class="accordion-opener">Lipsum</a>
                                                    <div class="accordion-slide">
                                                        <ul>
                                                            <li><a href="#">Lorem ipsum dolor</a></li>
                                                            <li><a href="#">sit amet, consectetur adipisicing</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#">culpa dicta ducimus</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" class="accordion-opener">Our Impact</a>
                                        <div class="accordion-slide">
                                            <ul>
                                                <li class="accordion-active">
                                                    <a href="#" class="accordion-opener">Lipsum</a>
                                                    <div class="accordion-slide">
                                                        <ul>
                                                            <li><a href="#">Lorem ipsum dolor</a></li>
                                                            <li><a href="#">sit amet, consectetur adipisicing</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#">culpa dicta ducimus</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" class="accordion-opener">Get Help</a>
                                        <div class="accordion-slide">
                                            <ul>
                                                <li class="accordion-active">
                                                    <a href="#" class="accordion-opener">Lipsum</a>
                                                    <div class="accordion-slide">
                                                        <ul>
                                                            <li><a href="#">Lorem ipsum dolor</a></li>
                                                            <li><a href="#">sit amet, consectetur adipisicing</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#">culpa dicta ducimus</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#" class="accordion-opener">Get Involved</a>
                                        <div class="accordion-slide">
                                            <ul>
                                                <li class="accordion-active">
                                                    <a href="#" class="accordion-opener">Lipsum</a>
                                                    <div class="accordion-slide">
                                                        <ul>
                                                            <li><a href="#">Lorem ipsum dolor</a></li>
                                                            <li><a href="#">sit amet, consectetur adipisicing</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#"> Animi consequuntur</a></li>
                                                            <li><a href="#">culpa dicta ducimus</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
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
                        <li <?php if (!$isPaymentStep) { echo 'class="step-active"';}else echo 'class="step-passed"';?>>
                            <a href="#">
                                <span class="title">Amount</span>
                                <span class="number">1</span>
                                <span class="badge">
                                    <span class="icon icon-check"></span>
                                </span>
                            </a>
                        </li>
                        <li <?php if (!$isPaymentStep) { echo '';}else echo 'class="step-passed"';?>>
                            <a href="#">
                                <span class="title">Details</span>
                                <span class="number">2</span>
                                <span class="badge">
                                    <span class="icon icon-check"></span>
                                </span>
                            </a>
                        </li>
                        <li <?php if ($isPaymentStep) { echo 'class="step-active"';}?>>
                            <a href="#">
                                <span class="title">Payment</span>
                                <span class="number">3</span>
                                <span class="badge">
                                    <span class="icon icon-check"></span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="title">Finish</span>
                                <span class="number">4</span>
                                <span class="badge">
                                    <span class="icon icon-check"></span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="donate-form-step <?php if (!$isPaymentStep) { echo 'active'; }?>">
                        <div class="wrapper container-fluid">
                            <div class="row center-xs">
                                <div class="col-xs-11 col-md-10">
                                    <h1><span>Step 1</span> Amount</h1>
                                    <h2>I want to make a</h2>
                                    <ul class="donate-options-list">
                                        <li>
                                            <input type="radio" name="donate-option" id="rad01" value="OTG" checked>
                                            <label for="rad01">Single donation</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="donate-option" id="rad02" value="RG">
                                            <label for="rad02">Monthly donation</label>
                                        </li>
                                    </ul>
                                    <div class="donate-sum">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                <a href="#" class="donate-sum-box" data-donate-sum="50">
                                                    <div class="image">
                                                        <div class="bg-stretch" style="background: #fff url('images/bg-donate01.jpg') 50% 50% no-repeat; background-size: cover;"></div>
                                                    </div>
                                                    <div class="text">
                                                        <span class="title">Prevention</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
                                                    </div>
                                                    <span class="sum">+ $50</span>
                                                </a>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <a href="#" class="donate-sum-box" data-donate-sum="100">
                                                    <div class="image">
                                                        <div class="bg-stretch" style="background: #fff url('images/bg-donate02.jpg') 50% 50% no-repeat; background-size: cover;"></div>
                                                    </div>
                                                    <div class="text">
                                                        <span class="title">Ticks</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
                                                    </div>
                                                    <span class="sum">+ $100</span>
                                                </a>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <a href="#" class="donate-sum-box" data-donate-sum="250">
                                                    <div class="image">
                                                        <div class="bg-stretch" style="background: #fff url('images/bg-donate03.jpg') 50% 50% no-repeat; background-size: cover;"></div>
                                                    </div>
                                                    <div class="text">
                                                        <span class="title">Investigation</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
                                                    </div>
                                                    <span class="sum">+ $250</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="donate-sum-choice-box02">
                                            <h3>Or donate another amount</h3>
                                            <div class="input-holder">
                                                <input id="donate-1" name="donate" type="number" min="1" required>
                                                <a href="#" class="btn btn-blue js-btn-step-next">Donate</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-primary-green btn-continue">Donate by mail</a>
                                    <div class="text-note">
                                        <p>Global Lyme Alliance is a 501(c)(3) charitable organization. Tax ID is 06-1559393.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="donate-form-step">
                        <div class="wrapper container-fluid">
                            <div class="row center-xs">
                                <div class="col-xs-11 col-md-10">
                                    <h1><span>Step 2</span> Details</h1>
                                    <div class="toggle-content expanded">
                                        <a href="#" class="toggle-content-opener">Your information <span class="icon icon-plus"></span><span class="icon icon-minus"></span></a>
                                        <div class="toggle-content-slide">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6 col-md-short">
                                                    <label>Title</label>
                                                    <select name="donor_title">
                                                        <option class="hideme">Select one</option>
                                                        <option>Title 1</option>
                                                        <option>Title 2</option>
                                                        <option>Title 3</option>
                                                    </select>
                                                    <label for="input01">* First name</label>
                                                    <input type="text" id="input01" name="step2_first_name" required>
                                                    <label for="input02">* Last name</label>
                                                    <input type="text" id="input02" name="step2_last_name" required>
                                                    <div class="checkbox-row">
                                                        <input type="checkbox" id="check01" name="step2_is_corporate">
                                                        <label for="check01">This is a corporate donation</label>
                                                    </div>
                                                    <div class="checkbox-row">
                                                        <input type="checkbox" id="check02" name="step2_company_matching">
                                                        <label for="check02">My company has a <a href="#">matching gift program</a></label>
                                                    </div>
                                                    <label for="input03">Company name</label>
                                                    <input type="text" id="input03" name="step2_company_name">
                                                    <label>Country</label>
                                                    <select name="step2_country">
                                                        <option class="hideme">Select one</option>
                                                        <option>Country 1</option>
                                                        <option>Country 2</option>
                                                        <option>Country 3</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-md-6 col-md-short">
                                                    <label for="input04">* Address #1</label>
                                                    <input type="text" id="input04" name="step2_address_1" required>
                                                    <label for="input05">Address #2</label>
                                                    <input type="text" id="input05" name="step2_address_2">
                                                    <label for="input06">* City</label>
                                                    <input type="text" id="input06" name="step2_city" required>
                                                    <label>State/Province</label>
                                                    <select name="step2_state">
                                                        <option value="" class="hideme">Select one</option>
                                                        <option value="State 1">State 1</option>
                                                        <option value="State 2">State 2</option>
                                                        <option value="State 3">State 3</option>
                                                    </select>
                                                    <label for="input07">* Zip/Postal code</label>
                                                    <input type="text" name="step2_postal_code" name="input07" required>
                                                    <label for="input08">Phone number</label>
                                                    <input type="tel" id="input08" name="step2_telephone">
                                                </div>
                                                <div class="form-note" style="display: none">* Complete the required fields</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="toggle-content">
                                        <a href="#" class="toggle-content-opener">IS THIS DONATION IN tribute OF SOMEONE?<span class="icon icon-plus"></span><span class="icon icon-minus"></span> <span class="answer md-visible">Yes</span></a>
                                        <div class="toggle-content-slide">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6  col-md-short">
                                                    <label for="input09">* Some title</label>
                                                    <input type="text" id="input09" name="step2_tribute_title1" required>
                                                    <label for="input10">Some title</label>
                                                    <input type="text" id="input10" name="step2_tribute_title2">
                                                </div>
                                                <div class="form-note" style="display: none">* Complete the required fields</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="donate-sum-choice-box">
                                        <label>Your Donation</label>
                                        <input id="donate-2" name="donate" type="number" min="1" required>
                                    </div>
                                    <input id="step2-submit" type="button" value="Continue" class="btn btn-default btn-continue js-btn-step-next">
                                    <div class="text-note">
                                        <p>Global Lyme Alliance is a 501(c)(3) charitable organization. Tax ID is 06-1559393.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="donate-form-step <?php if ($isPaymentStep) { echo 'active';}?>">
                        <div class="wrapper container-fluid">
                            <div class="row center-xs">
                                <div class="col-xs-11 col-md-10">
                                    <h1><span>Step 3</span> Payment</h1>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6  col-md-short">
                                            <div class="toggle-content expanded static-expand">
                                                <a href="#" class="toggle-content-opener">Credit card information <span class="icon icon-plus"></span><span class="icon icon-minus"></span></a>
                                                <div class="toggle-content-slide">
                                                    <label for="input11">* Card holder name <img src="images/img-cards.jpg" alt=""></label>
                                                    <input type="text" id="input11" name="step3_card_holder_name" required>
                                                    <label for="input12">* Card account number</label>
                                                    <input type="text" id="input12" name="step3_card_account_no" required>
                                                    <label>Expiration date</label>
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
                                                    <label for="input13">* Security code click <a href="#">here</a> for CVV2 information </label>
                                                    <input type="password" id="input13" name="step3_card_cvv" required>
                                                </div>
                                            </div>
                                            <?php 
                                            
                                            if (!empty($_GET['token-id'])) {
                                            
                                            	// Step Three: Once the browser has been redirected, we can obtain the token-id and complete
                                            	// the transaction through another XML HTTPS POST including the token-id which abstracts the
                                            	// sensitive payment information that was previously collected by the Payment Gateway.
                                            	$tokenId = $_GET['token-id'];
                                            	$xmlRequest = new DOMDocument('1.0','UTF-8');
                                            	$xmlRequest->formatOutput = true;
                                            	$xmlCompleteTransaction = $xmlRequest->createElement('complete-action');
                                            	appendXmlNode($xmlRequest, $xmlCompleteTransaction,'api-key',$APIKey);
                                            	appendXmlNode($xmlRequest, $xmlCompleteTransaction,'token-id',$tokenId);
                                            	$xmlRequest->appendChild($xmlCompleteTransaction);
                                            
                                            
                                            	// Process Step Three
                                            	$data = sendXMLviaCurl($xmlRequest,$gatewayURL);
                                            
                                            
                                            	$gwResponse = @new SimpleXMLElement((string)$data);
                                            	print '  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
                                            	print '
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Step Three - Complete Transaction</title>
      </head>
      <body>';
                                            
                                            	print "
        <p><h2>Step Three: Script automatically completes the transaction <br /></h2></p>";
                                            
                                            	if ((string)$gwResponse->result == 1 ) {
                                            		print " <p><h3> Transaction was Approved, XML response was:</h3></p>\n";
                                            		print '<pre>' . (htmlentities($data)) . '</pre>';
                                            
                                            	} elseif((string)$gwResponse->result == 2)  {
                                            		print " <p><h3> Transaction was Declined.</h3>\n";
                                            		print " Decline Description : " . (string)$gwResponse->{'result-text'} ." </p>";
                                            		print " <p><h3>XML response was:</h3></p>\n";
                                            		print '<pre>' . (htmlentities($data)) . '</pre>';
                                            	} else {
                                            		print " <p><h3> Transaction caused an Error.</h3>\n";
                                            		print " Error Description: " . (string)$gwResponse->{'result-text'} ." </p>";
                                            		print " <p><h3>XML response was:</h3></p>\n";
                                            		print '<pre>' . (htmlentities($data)) . '</pre>';
                                            	}
                                            	print "</body></html>";
                                            
                                            
                                            
                                            } else {
                                            	print "ERROR IN SCRIPT<BR>";
                                            }
                                            ?>
                                        </div>
                                        <div class="col-xs-12 col-md-6  col-md-short">
                                            <div class="toggle-content expanded static-expand">
                                                <a href="#" class="toggle-content-opener">Billing address <span class="icon icon-plus"></span><span class="icon icon-minus"></span></a>
                                                <div class="toggle-content-slide">
                                                    <div class="checkbox-row">
                                                        <input type="checkbox" id="check03" name="step3_same_address">
                                                        <label for="check03">Same as mailing address</label>
                                                    </div>
                                                    <label for="input14">* Address</label>
                                                    <input type="text" id="input14" name="step3_address" required>
                                                    <label for="input15">* Country</label>
                                                    <input type="text" id="input15" name="step3_country" required>
                                                    <label for="input16">* City</label>
                                                    <input type="text" id="input16" name="step3_city" required>
                                                    <label>State/Province</label>
                                                    <select name="step3_state">
                                                        <option value="" class="hideme">Select one</option>
                                                        <option value="State 1">State 1</option>
                                                        <option value="State 2">State 2</option>
                                                        <option value="State 3">State 3</option>
                                                    </select>
                                                    <label for="input17">* Zip/Postal code</label>
                                                    <input type="text" id="input17" name="step3_postal_code" required>
                                                    <div class="checkbox-row">
                                                        <input type="checkbox" id="check04" checked name="step3_confirm">
                                                        <label for="check04">I understand that by submitting a donation, my information will be automatically added to GLA's secure database.</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="donate-sum-choice-box">
                                        <label>Your Donation</label>
                                        <input id="donate-3" name="donate" type="number" min="1" disabled="disabled">
                                    </div>
                                    <INPUT type ="text" name="billing-cc-number" value="4111111111111111">
                                    <INPUT type ="text" name="billing-cc-exp" value="1012">
                                    <INPUT type ="text" name="billing-first-name" value="shenikutty">
                                    <input id="step3-submit" type="submit" value="Continue" class="btn btn-default btn-continue">
                                    <div class="text-note">
                                        <p>Global Lyme Alliance is a 501(c)(3) charitable organization. Tax ID is 06-1559393.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="donate-form-step">
                        <div class="wrapper container-fluid">
                            <div class="row center-xs">
                                <div class="col-xs-11 col-md-10">
                                    <h1><span>Step 4</span> Finish</h1>
                                    <div class="logo-finish"><img src="images/logo-finish.svg" alt=""></div>
                                    <h2>Thank You</h2>
                                    <div class="finish-text-holder">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                                    </div>
                                    <div class="donation-summary">
                                        <div class="donation-summary-box personal-info">
                                            <div class="box-holder">
                                                <h3>Your Donation</h3>
                                                <span>Jesus Summers</span>
                                                <span>8 (495) 358-23-75</span>
                                                <span>French Southern Territories</span>
                                                <span>20090042</span>
                                                <span>52 Little Valley Suite 117</span>
                                            </div>
                                        </div>
                                        <div class="donation-summary-box">
                                            <div class="total-sum">
                                                <span class="title">Total donated</span>
                                                <strong class="amount">$250</strong>
                                            </div>
                                            <div class="box-holder">
                                                <h3>Lorem ipsum dolor</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id </p>
                                            </div>
                                            <div class="gla-info">
                                                <p>Global Lyme Alliance is a 501(c)(3) charitable organization. Tax ID is 06-1559393.</p>
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
                                            <div class="bg-stretch" style="background: #fff url('images/bg-news01.jpg')  50% 50% no-repeat;  background-size: cover;"></div>
                                        </a>
                                        <a href="#" class="news-box arrow-top">
                        <span class="text-holder">
                            <strong class="subtitle">BLOG</strong>
                            <span class="title">Sweeping health measure, backed by Obama, passes senate</span>
                        </span>
                                        </a>
                                        <a href="#" class="news-box news-box-video">
                                            <div class="bg-stretch" style="background: #fff url('images/bg-news03.jpg')  50% 50% no-repeat; background-size: cover;"></div>
                                            <span class="icon icon-play-circle"></span>
                                        </a>
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <a href="#" class="news-box arrow-bottom">
                        <span class="text-holder">
                            <strong class="subtitle">NEWS</strong>
                            <span class="title">Yolanda Hadid talks Lyme disease on good day New York</span>
                        </span>
                                        </a>
                                        <a href="#" class="news-box news-box-image news-box-high">
                                            <div class="bg-stretch" style="background: #fff url('images/bg-news02.jpg')  50% 50% no-repeat; background-size: cover;"></div>
                                        </a>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <a href="#" class="news-box news-box-short news-box-image">
                                            <div class="bg-stretch" style="background: #fff url('images/bg-news04.jpg') 50% 50% no-repeat; background-size: cover;"></div>
                                        </a>
                                        <a href="#" class="news-box news-box-short arrow-right">
                        <span class="text-holder">
                            <strong class="subtitle">NEWS</strong>
                            <span class="title">Gla partners with the mighty to increase awareness of Lyme disease</span>
                        </span>
                                        </a>
                                        <a href="#" class="news-box news-box-blue md-visible">
                        <span class="text-holder">
                            <span class="icon icon-twitter"></span>
                            <span class="title">Global Lyme Alliance</span>
                            <span>
                                200 kids get <span class="text-dark-blue">#LymeDisease</span> every day.
                                How many more R misdiagnosed? Donate 4 accurate diagnostic test
                                <span class="text-dark-blue">#GivingTuesday</span>
                                <span class="text-dark-blue">http://donate4lyme.com</span>
                            </span>
                        </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="social-block">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <a href="#" class="social-box social-box-youtube">
                            <span class="social-holder">
                                <span class="icon icon-play-circle"></span>
                                <strong class="title md-visible">Watch our videos</strong>
                            </span>
                                            </a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a href="#" class="social-box social-box-facebook">
                            <span class="social-holder">
                                <span class="icon icon-facebook-square"></span>
                                <strong class="title md-visible">Like us on facebook</strong>
                            </span>
                                            </a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a href="#" class="social-box social-box-twitter">
                            <span class="social-holder">
                                <span class="icon icon-twitter"></span>
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
                                                <input type="email" placeholder="Insert your email here">
                                                <input type="submit" value="Subscribe">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </form>
            </main>
			<footer class="footer">
                <div class="wrapper container-fluid">
                    <div class="row center-xs">
                        <div class="col-xs-11 col-md-10">
                            <div class="footer-columns">
                                <div class="footer-column footer-column-logo">
                                    <a href="#" class="logo">Global Lyme Alliance</a>
                                    <div class="copyright-block md-visible">
                                        <div>Global Lyme Alliance <address>222 Railroad Ave. #2B Greenwich, CT 06830</address></div>
                                        <div>2017 &copy; Copyright Global Lyme Alliance. All rights reserved.</div>
                                    </div>
                                </div>
                                <div class="footer-column footer-column-nav">
                                    <ul class="sub-nav sub-nav-bold border-md">
                                        <li><a href="#">Donate</a></li>
                                        <li><a href="#">Research</a></li>
                                        <li><a href="#">Participate</a></li>
                                        <li><a href="#">Doctors</a></li>
                                        <li><a href="#">News</a></li>
                                        <li><a href="#">Education</a></li>
                                    </ul>
                                </div>
                                <div class="footer-column footer-column-nav02">
                                    <ul class="sub-nav">
                                        <li><a href="#">Understanding Lyme</a></li>
                                        <li><a href="#">Our Research</a></li>
                                        <li><a href="#">Our Impact</a></li>
                                        <li><a href="#">Get Help</a></li>
                                        <li><a href="#">Get Involved</a></li>
                                    </ul>
                                </div>
                                <div class="footer-column footer-column-contact">
                                    <h3>Subscribe to our news</h3>
                                    <div class="contact-block">
                                        <h3>Contact Us</h3>
                                        <dl class="contact-list">
                                            <dt>P:</dt>
                                            <dd><a href="callto:2039691333">203.969.1333</a></dd>
                                            <dt>M:</dt>
                                            <dd><a href="mailto:info@gla.org">info@gla.org</a></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="footer-column footer-column-social">
                                    <h3>Follow us</h3>
                                    <ul class="social-list">
                                        <li><a href="#"><span class="icon icon-facebook-square"></span> Facebook</a></li>
                                        <li><a href="#"><span class="icon icon-twitter"></span> Twitter</a></li>
                                        <li><a href="#"><span class="icon icon-instagram"></span> Instagram</a></li>
                                        <li><a href="#"><span class="icon icon-linkedin-square"></span> LinkedIn</a></li>
                                    </ul>
                                </div>
                                <div class="footer-column footer-column-copyright md-hidden">
                                    <div>Global Lyme Alliance <address>222 Railroad Ave. #2B Greenwich, CT 06830</address></div>
                                    <div>2017 &copy; Copyright Global Lyme Alliance. All rights reserved.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</footer>
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
                                    <span class="icon icon-search"></span>
                                    <input type="text" placeholder="Lyme Prevention">
                                </div>
                                <ul class="results-list">
                                    <li>
                                        <span class="number">55</span>
                                        <a href="#"><span class="highlighted">Lyme</span> Prevention</a>
                                    </li>
                                    <li>
                                        <span class="number">33</span>
                                        <a href="#"><span class="highlighted">Lyme</span> Disease</a>
                                    </li>
                                    <li>
                                        <span class="number">55</span>
                                        <a href="#">What is <span class="highlighted">Lyme</span> disease?</a>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/donate.js"></script>
		<script type="text/javascript">
			var currentActiveStep = 0;
			<?php if ($isPaymentStep) { echo 'currentActiveStep = 2;'; }?>
		</script>
	</body>
</html>
