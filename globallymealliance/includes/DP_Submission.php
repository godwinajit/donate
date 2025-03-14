<?php
define('DP_API_KEY_URL', 'https://www.donorperfect.net/prod/xmlrequest.asp?apikey=' );
date_default_timezone_set('America/New_York');

if (is_wpe_gla_live()){
	define('DP_API_KEY', 'HFCBGrK8x8aiXpEu50tVH31W7akQaoPOiUtFpsHiXH%2fUKsFZQ4uX3L1gaDHsywRmHwzAsalBDEVpMDsIs56kM%2brGU%2b1SS%2fzQCZodcSq7c6hokQPh1VZPUBRXN9ULnmYp' );
	define('NOTIFICATION_TO_EMAIL','Casie.Richardson@globallymealliance.org');
	define('NOTIFICATION_BCC_EMAIL','goliver@mindtrustlabs.com');
}else{
	define('DP_API_KEY', 'CF49QhBgJI%2bqygkmvh6%2bXBg6diwGenLN21xqn4fRUE%2fXTyEWYYpi%2ffBD4lgGuid%2fzhOHWZtMNAgs9ozcsqwKuGKXBJ0Hz%2f4FOJp27tnur23CUXxrsLaSoltaSUxK5JiW' );
	define('NOTIFICATION_TO_EMAIL','goliver@mindtrustlabs.com');
	define('NOTIFICATION_BCC_EMAIL','goliver@mindtrustlabs.com');
}

// Add your support group
add_action( 'gform_after_submission_17', 'add_your_support_group_to_dp', 10, 2 );
function add_your_support_group_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	$firstName = rgar( $entry, '7' );
	$lastName = rgar( $entry, '15' );
	$email = rgar( $entry, '8' );
	$country = rgar( $entry, '19' );
	$address1 = rgar( $entry, '11' );
	$city = rgar( $entry, '12' );
	$cityStateProvince = rgar( $entry, '18' );
	$state = rgar( $entry, '16' );
	$postal = rgar( $entry, '14' );
	$website = rgar( $entry, '10' );
	$homePhone = rgar( $entry, '9' );

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, $homePhone, null, $website, null, null, null, null, null, null, null, null, null, null, null, null);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, $homePhone, null );
		error_log( 'add_your_support_group_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];

			if(!isDonorFlagSet($donorId, "SG")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'SG_DT', 'D', null, $current_date_value, null);
				error_log( 'add_your_support_group_to_dp_flag First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'SG');
			error_log( 'add_your_support_group_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			$WEBUDFDetails = dp_save_udf_xml( $donorId, 'WEB', 'C', $website, null, null);
			error_log( 'add_your_support_group_to_dp_web after_submission: ' . print_r( $WEBUDFDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){

			if(!isDonorFlagSet($donorId, "SG")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'SG_DT', 'D', null, $current_date_value, null);
				error_log( 'add_your_support_group_to_dp_flag First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'SG');
			error_log( 'add_your_support_group_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Apply NYC Marathon Form 2018
add_action( 'gform_after_submission_16', 'nyc_marathon_form_to_dp', 10, 2 );
function nyc_marathon_form_to_dp( $entry, $form ) {

 	$firstName = rgar( $entry, '14' );
	$lastName = rgar( $entry, '15' );
	$email = rgar( $entry, '13' );
	$country = rgar( $entry, '16' );
	$address1 = rgar( $entry, '3' );
	$city = rgar( $entry, '17' );
	$cityStateProvince = rgar( $entry, '20' );
	$state = rgar( $entry, '21' );
	$postal = rgar( $entry, '19' );
	$dob_date_value = rgar( $entry, '4' );

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, $dob_date_value, null, null, null, null, null, null, null, null, null, null, null);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'nyc_marathon_form_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
			$flagDetails = saveDPFlag($donorId, 'NYMAP');
			error_log( 'nyc_marathon_form_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			if (is_wpe_gla_live()) {
				$UDFDetails = dp_save_udf_xml( $donorId, 'DOB', 'D', null, $dob_date_value, null);
				error_log( 'nyc_marathon_form_to_dp_dob after_submission: ' . print_r( $UDFDetails, true ) );
		    }else{
				$UDFDetails = dp_save_udf_xml( $donorId, 'BIRTHDATE', 'D', null, $dob_date_value, null);
				error_log( 'nyc_marathon_form_to_dp_dob after_submission: ' . print_r( $UDFDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){
			$flagDetails = saveDPFlag($donorId, 'NYMAP');
			error_log( 'nyc_marathon_form_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Apply NYC Marathon Form 2019
add_action( 'gform_after_submission_25', 'nyc_marathon_form_2019_to_dp', 10, 2 );
function nyc_marathon_form_2019_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	$firstName = rgar( $entry, '14' );
	$lastName = rgar( $entry, '15' );
	$email = rgar( $entry, '13' );
	$country = rgar( $entry, '16' );
	$address1 = rgar( $entry, '3' );
	$city = rgar( $entry, '17' );
	$cityStateProvince = rgar( $entry, '20' );
	$state = rgar( $entry, '21' );
	$postal = rgar( $entry, '19' );
	$dob_date_value = rgar( $entry, '4' );

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, $dob_date_value, null, null, null, null, null, null, null, null, null, null, null);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'nyc_marathon_form_2019_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];

			if(!isDonorFlagSet($donorId, "NYMAP")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'NYM_DT', 'D', null, $current_date_value, null);
				error_log( 'nyc_marathon_form_2019_to_dp_dob First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'NYMAP');
			error_log( 'nyc_marathon_form_2019_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			if (is_wpe_gla_live()) {
				$UDFDetails = dp_save_udf_xml( $donorId, 'DOB', 'D', null, $dob_date_value, null);
				error_log( 'nyc_marathon_form_2019_to_dp_dob after_submission: ' . print_r( $UDFDetails, true ) );
		    }else{
				$UDFDetails = dp_save_udf_xml( $donorId, 'BIRTHDATE', 'D', null, $dob_date_value, null);
				error_log( 'nyc_marathon_form_2019_to_dp_dob after_submission: ' . print_r( $UDFDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){

			if(!isDonorFlagSet($donorId, "NYMAP")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'NYM_DT', 'D', null, $current_date_value, null);
				error_log( 'nyc_marathon_form_2019_to_dp_dob First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'NYMAP');
			error_log( 'nyc_marathon_form_2019_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Contact GLA to request a company presentation
add_action( 'gform_after_submission_14', 'req_a_company_pre_to_dp', 10, 2 );
function req_a_company_pre_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '8' );
	$email = rgar( $entry, '3' );
	$country = rgar( $entry, '9' );
	$address1 = rgar( $entry, '10' );
	$city = rgar( $entry, '6' );
	$cityStateProvince = rgar( $entry, '12' );
	$state = rgar( $entry, '5' );
	$postal = rgar( $entry, '11' );
	$professionalTitle = rgar( $entry, '4' );
	$employer = rgar( $entry, '2' );

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, $professionalTitle, null, null, $employer, null, null, null, null, null, null, null, null, null, null);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, $professionalTitle );
		error_log( 'req_a_company_pre_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];

			if(!isDonorFlagSet($donorId, "EDB")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'EDB_DT', 'D', null, $current_date_value, null);
				error_log( 'req_a_company_pre_to_dp_flag First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'EDB');
			error_log( 'req_a_company_pre_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			$EMPLOYERUDFDetails = dp_save_udf_xml( $donorId, 'EMPLOYER', 'C', $employer, null, null);
			error_log( 'req_a_company_pre_to_dp_employer after_submission: ' . print_r( $EMPLOYERUDFDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){

			if(!isDonorFlagSet($donorId, "EDB")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'EDB_DT', 'D', null, $current_date_value, null);
				error_log( 'req_a_company_pre_to_dp_flag First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'EDB');
			error_log( 'req_a_company_pre_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Contact Us
add_action( 'gform_after_submission_7', 'contact_us_to_dp', 10, 2 );
function contact_us_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');

 	$firstName = rgar( $entry, '4' );
	$lastName = rgar( $entry, '13' );
	$email = rgar( $entry, '23' );
	$country = rgar( $entry, '38' );
	$address1 = rgar( $entry, '8' );
	$address2 = rgar( $entry, '9' );
	$city = rgar( $entry, '27' );
	$cityStateProvince = rgar( $entry, '39' );
	$state = rgar( $entry, '24' );
	$postal = rgar( $entry, '6' );
	$iam = rgar( $entry, '37' );
	$iamFlag = '';

	if ($iam == 'Lyme patient') {
		$iamFlag = 'PAT';
	} elseif ($iam == 'Caregiver: parent') {
		$iamFlag = 'CGP';
	} elseif ($iam == 'Caregiver: spouse') {
		$iamFlag = 'CGS';
	} elseif ($iam == 'Physician') {
		$iamFlag = 'PHY';
	} elseif ($iam == 'Nurse') {
		$iamFlag = 'NUR';
	} elseif ($iam == 'Psychiatrist/psychologist') {
		$iamFlag = 'PSY';
	} elseif ($iam == 'Pharma/Diagnostic Rep') {
		$iamFlag = 'PHRM';
	} elseif ($iam == 'Teacher') {
		$iamFlag = 'TCH';
	} elseif ($iam == 'Camp counselor') {
		$iamFlag = 'CMP';
	} elseif ($iam == 'Researcher') {
		$iamFlag = 'RSRCH';
	} elseif ($iam == 'Media') {
		$iamFlag = 'MDA';
	} elseif ($iam == 'Medical Representative') {
		$iamFlag = 'MR';
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'contact_us_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'contact_us_to_dp_flag after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if(!isDonorFlagSet($donorId, "WSCNT")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WCNT_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSCNT');
			error_log( 'contact_us_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'contact_us_to_dp_flag after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if(!isDonorFlagSet($donorId, "WSCNT")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WCNT_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSCNT');
			error_log( 'contact_us_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Digital Education Form
add_action( 'gform_after_submission_13', 'digital_education_form_to_dp', 10, 2 );
function digital_education_form_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '2' );
	$email = rgar( $entry, '3' );
	$country = rgar( $entry, '9' );
	$address1 = rgar( $entry, '11' );
	$city = rgar( $entry, '4' );
	$cityStateProvince = rgar( $entry, '10' );
	$state = rgar( $entry, '5' );
	$postal = rgar( $entry, '6' );
	$iam = rgar( $entry, '8' );
	$iamFlag = '';

	if ($iam == 'Lyme patient') {
		$iamFlag = 'PAT';
	} elseif ($iam == 'Caregiver: parent') {
		$iamFlag = 'CGP';
	} elseif ($iam == 'Caregiver: spouse') {
		$iamFlag = 'CGS';
	} elseif ($iam == 'Physician') {
		$iamFlag = 'PHY';
	} elseif ($iam == 'Nurse') {
		$iamFlag = 'NUR';
	} elseif ($iam == 'Psychiatrist/psychologist') {
		$iamFlag = 'PSY';
	} elseif ($iam == 'Pharma/Diagnostic Rep') {
		$iamFlag = 'PHRM';
	} elseif ($iam == 'Teacher') {
		$iamFlag = 'TCH';
	} elseif ($iam == 'Camp counselor') {
		$iamFlag = 'CMP';
	} elseif ($iam == 'Researcher') {
		$iamFlag = 'RSRCH';
	} elseif ($iam == 'Media') {
		$iamFlag = 'MDA';
	} elseif ($iam == 'Medical Representative') {
		$iamFlag = 'MR';
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'digital_education_form_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];

			if(!isDonorFlagSet($donorId, "WSDIG")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WDE_DT', 'D', null, $current_date_value, null);
				error_log( 'digital_education_form_to_dp_flag First date: ' . print_r( $UDFFirstDate, true ) );
			}
			
			$flagDetails = saveDPFlag($donorId, 'WSDIG');
			error_log( 'digital_education_form_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){

			if(!isDonorFlagSet($donorId, "WSDIG")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WDE_DT', 'D', null, $current_date_value, null);
				error_log( 'digital_education_form_to_dp_flag First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSDIG');
			error_log( 'digital_education_form_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	}
}

// Download Free Resources
add_action( 'gform_after_submission_9', 'download_free_resources_to_dp', 10, 2 );
function download_free_resources_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');

 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '2' );
	$email = rgar( $entry, '3' );
	$country = rgar( $entry, '9' );
	$address1 = rgar( $entry, '11' );
	$city = rgar( $entry, '4' );
	$cityStateProvince = rgar( $entry, '10' );
	$state = rgar( $entry, '5' );
	$postal = rgar( $entry, '6' );
	$iam = rgar( $entry, '8' );
	$iamFlag = '';

	if ($iam == 'Lyme patient') {
		$iamFlag = 'PAT';
	} elseif ($iam == 'Caregiver: parent') {
		$iamFlag = 'CGP';
	} elseif ($iam == 'Caregiver: spouse') {
		$iamFlag = 'CGS';
	} elseif ($iam == 'Physician') {
		$iamFlag = 'PHY';
	} elseif ($iam == 'Nurse') {
		$iamFlag = 'NUR';
	} elseif ($iam == 'Psychiatrist/psychologist') {
		$iamFlag = 'PSY';
	} elseif ($iam == 'Pharma/Diagnostic Rep') {
		$iamFlag = 'PHRM';
	} elseif ($iam == 'Teacher') {
		$iamFlag = 'TCH';
	} elseif ($iam == 'Camp counselor') {
		$iamFlag = 'CMP';
	} elseif ($iam == 'Researcher') {
		$iamFlag = 'RSRCH';
	} elseif ($iam == 'Media') {
		$iamFlag = 'MDA';
	} elseif ($iam == 'Medical Representative') {
		$iamFlag = 'MR';
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'download_free_resources_to after_submission 1: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'download_free_resources_to_dp_iam after_submission 3: ' . print_r( $iAMflagDetails, true ) );
			}

			if(!isDonorFlagSet($donorId, "WSDWNLD")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WDWLD_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSDWNLD');
			error_log( 'download_free_resources_to_dp_flag after_submission 2: ' . print_r( $flagDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'download_free_resources_to_dp_iam after_submission 5: ' . print_r( $iAMflagDetails, true ) );
			}

			if(!isDonorFlagSet($donorId, "WSDWNLD")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WDWLD_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSDWNLD');
			error_log( 'download_free_resources_to_dp_flag after_submission 4: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Download Teacher & Student Resources
add_action( 'gform_after_submission_11', 'down_teach_student_resources_to_dp', 10, 2 );
function down_teach_student_resources_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '2' );
	$email = rgar( $entry, '3' );
	$country = rgar( $entry, '12' );
	$address1 = rgar( $entry, '14' );
	$city = rgar( $entry, '4' );
	$cityStateProvince = rgar( $entry, '13' );
	$state = rgar( $entry, '5' );
	$postal = rgar( $entry, '6' );
	$occupation = rgar( $entry, '7' );
	$curriculum1 = rgar( $entry, '10.1' );
	$curriculum2 = rgar( $entry, '10.2' );
	$curriculum3 = rgar( $entry, '10.3' );
	$curriculum4 = rgar( $entry, '10.4' );
	$occupationCode = '';

	if ($occupation == 'Administrator') {
		$occupationCode = 'ADM';
	} elseif ($occupation == 'Teacher') {
		$occupationCode = 'TCH';
	} elseif ($occupation == 'Other Education') {
		$occupationCode = 'OED';
	} elseif ($occupation == 'School Nurse') {
		$occupationCode = 'NRS';
	} elseif ($occupation == 'Parent') {
		$occupationCode = 'PRT';
	} elseif ($occupation == 'Other') {
		$occupationCode = 'OTH';
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, $curriculum1, $curriculum2, $curriculum3, $curriculum4, $occupation , null, null, null, null, null);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'down_teach_student_resources_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];

			if(!isDonorFlagSet($donorId, "WSTCHSTD")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WTCHST_DT', 'D', null, $current_date_value, null);
				error_log( 'down_teach_student_resources_to_dp_flag First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSTCHSTD');
			error_log( 'down_teach_student_resources_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
	
			if ($curriculum1 != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'KNDGRTN', 'C', 'Y', null, null);
				error_log( 'down_teach_student_resources_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($curriculum2 != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'THRDG', 'C', 'Y', null, null);
				error_log( 'down_teach_student_resources_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($curriculum3 != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'SIXGRD', 'C', 'Y', null, null);
				error_log( 'down_teach_student_resources_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($curriculum4 != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'HSCHL', 'C', 'Y', null, null);
				error_log( 'down_teach_student_resources_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($occupationCode != ''){
				$UDFDetails = dp_save_udf_xml( $donorId, 'OCCCODE', 'C', $occupationCode, null, null);
				error_log( 'down_teach_student_resources_to_dp after_submission: ' . print_r( $UDFDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){

			if(!isDonorFlagSet($donorId, "WSTCHSTD")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WTCHST_DT', 'D', null, $current_date_value, null);
				error_log( 'down_teach_student_resources_to_dp_flag First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSTCHSTD');
			error_log( 'download_free_resources_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Find a Medical Professional Form
add_action( 'gform_after_submission_5', 'find_a_medical_pro_to_dp', 10, 2 );
function find_a_medical_pro_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');

 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '2' );
	$email = rgar( $entry, '20' );
	$country = rgar( $entry, '25' );
	$address1 = rgar( $entry, '4' );
	$address2 = rgar( $entry, '5' );
	$city = rgar( $entry, '22' );
	$cityStateProvince = rgar( $entry, '26' );
	$state = rgar( $entry, '16' );
	$postal = rgar( $entry, '8' );
	$iam = rgar( $entry, '23' );
	$iamFlag = '';

	if ($iam == 'Lyme patient') {
		$iamFlag = 'PAT';
	} elseif ($iam == 'Caregiver: parent') {
		$iamFlag = 'CGP';
	} elseif ($iam == 'Caregiver: spouse') {
		$iamFlag = 'CGS';
	} elseif ($iam == 'Physician') {
		$iamFlag = 'PHY';
	} elseif ($iam == 'Nurse') {
		$iamFlag = 'NUR';
	} elseif ($iam == 'Psychiatrist/psychologist') {
		$iamFlag = 'PSY';
	} elseif ($iam == 'Pharma/Diagnostic Rep') {
		$iamFlag = 'PHRM';
	} elseif ($iam == 'Teacher') {
		$iamFlag = 'TCH';
	} elseif ($iam == 'Camp counselor') {
		$iamFlag = 'CMP';
	} elseif ($iam == 'Researcher') {
		$iamFlag = 'RSRCH';
	} elseif ($iam == 'Media') {
		$iamFlag = 'MDA';
	} elseif ($iam == 'Medical Representative') {
		$iamFlag = 'MR';
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if(!isDonorFlagSet($donorId, "WSFMED")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WFMED_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSFMED');
			error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if(!isDonorFlagSet($donorId, "WSFMED")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WFMED_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSFMED');
			error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// View Video Resources Form
add_action( 'gform_after_submission_12', 'view_video_resources_to_dp', 10, 2 );
function view_video_resources_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '2' );
	$email = rgar( $entry, '3' );
	$country = rgar( $entry, '12' );
	$address1 = rgar( $entry, '15' );
	$city = rgar( $entry, '4' );
	$cityStateProvince = rgar( $entry, '13' );
	$state = rgar( $entry, '5' );
	$postal = rgar( $entry, '6' );
	$iam = rgar( $entry, '14' );
	$iamFlag = '';

	if ($iam == 'Lyme patient') {
		$iamFlag = 'PAT';
	} elseif ($iam == 'Caregiver: parent') {
		$iamFlag = 'CGP';
	} elseif ($iam == 'Caregiver: spouse') {
		$iamFlag = 'CGS';
	} elseif ($iam == 'Physician') {
		$iamFlag = 'PHY';
	} elseif ($iam == 'Nurse') {
		$iamFlag = 'NUR';
	} elseif ($iam == 'Psychiatrist/psychologist') {
		$iamFlag = 'PSY';
	} elseif ($iam == 'Pharma/Diagnostic Rep') {
		$iamFlag = 'PHRM';
	} elseif ($iam == 'Teacher') {
		$iamFlag = 'TCH';
	} elseif ($iam == 'Camp counselor') {
		$iamFlag = 'CMP';
	} elseif ($iam == 'Researcher') {
		$iamFlag = 'RSRCH';
	} elseif ($iam == 'Media') {
		$iamFlag = 'MDA';
	} elseif ($iam == 'Medical Representative') {
		$iamFlag = 'MR';
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'view_video_resources_to_dp after_submission: ' . print_r( $donorDetails, true ) );

		if (isset($donorDetails->{'record'}->{'field'}[0])) {
			$donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
	        $donorId = $donorDetails[0];

			if(!isDonorFlagSet($donorId, "WSVID")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WVID_DT', 'D', null, $current_date_value, null);
				error_log( 'view_video_resources_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSVID');
			error_log( 'view_video_resources_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'view_video_resources_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){

			if(!isDonorFlagSet($donorId, "WSVID")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WVID_DT', 'D', null, $current_date_value, null);
				error_log( 'view_video_resources_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WSVID');
			error_log( 'view_video_resources_to_dp after_submission: ' . print_r( $flagDetails, true ) );

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'view_video_resources_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	}
}

// DP Newsletter Form
add_action( 'gform_after_submission_19', 'dp_newsletter_to_dp', 10, 2 );
function dp_newsletter_to_dp( $entry, $form ) {

 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '2' );
	$email = rgar( $entry, '4' );

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, null, null, null, null, null, null, null, null,null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, null, null, null, null,null, null, null, null, null, 'Y', 'INSU' );
		error_log( 'dp_newsletter_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];

			$flagDetails = saveDPFlag($donorId, 'NL_DT');
			error_log( 'dp_newsletter_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){
			$flagDetails = saveDPFlag($donorId, 'NL_DT');
			error_log( 'dp_newsletter_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// DP Newsletter Form
add_action( 'gform_after_submission_8', 'dp_popup_newsletter_to_dp', 10, 2 );
function dp_popup_newsletter_to_dp( $entry, $form ) {

    $firstName = '';
    $lastName = rgar( $entry, '1' );
    $email = rgar( $entry, '1' );
	$current_date_value = date('m/d/Y');

    $matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, null, null, null, null, null, null, null, null,null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    if( !count($matchingDonors) ){
        $donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, null, null, null, null,null, null, null, null, null, 'Y', 'INSU' );
        error_log( 'dp_popup_newsletter_to_dp after_submission: ' . print_r( $donorDetails, true ) );

        if (isset($donorDetails->{'record'}->{'field'}[0])) {
            $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
            $donorId = $donorDetails[0];
			
			if(!isDonorFlagSet($donorId, "NLPU")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'NLP_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'NLPU');
            error_log( 'dp_popup_newsletter_to_dp after_submission: ' . print_r( $flagDetails, true ) );
        }
    } else {
        foreach($matchingDonors as $donorId){

			if(!isDonorFlagSet($donorId, "NLPU")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'NLP_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'NLPU');
            error_log( 'dp_popup_newsletter_to_dp after_submission: ' . print_r( $flagDetails, true ) );
        }
    }
}

// Tick table download
add_action( 'gform_after_submission_20', 'tick_table_download_to_dp', 10, 2 );
function tick_table_download_to_dp( $entry, $form ) {

 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '2' );
	$email = rgar( $entry, '3' );
	$country = rgar( $entry, '6' );
	$address1 = rgar( $entry, '5' );
	$city = rgar( $entry, '7' );
	$cityStateProvince = rgar( $entry, '10' );
	$state = rgar( $entry, '8' );
	$postal = rgar( $entry, '9' );
	if ($country != 'US') {
		$postal = rgar( $entry, '11' );
	}
	$iam = rgar( $entry, '12' );
	$iamFlag = '';

	if ($iam == 'Lyme patient') {
		$iamFlag = 'PAT';
	} elseif ($iam == 'Caregiver: parent') {
		$iamFlag = 'CGP';
	} elseif ($iam == 'Caregiver: spouse') {
		$iamFlag = 'CGS';
	} elseif ($iam == 'Physician') {
		$iamFlag = 'PHY';
	} elseif ($iam == 'Nurse') {
		$iamFlag = 'NUR';
	} elseif ($iam == 'Psychiatrist/psychologist') {
		$iamFlag = 'PSY';
	} elseif ($iam == 'Pharma/Diagnostic Rep') {
		$iamFlag = 'PHRM';
	} elseif ($iam == 'Teacher') {
		$iamFlag = 'TCH';
	} elseif ($iam == 'Camp counselor') {
		$iamFlag = 'CMP';
	} elseif ($iam == 'Researcher') {
		$iamFlag = 'RSRCH';
	} elseif ($iam == 'Media') {
		$iamFlag = 'MDA';
	} elseif ($iam == 'Medical Representative') {
		$iamFlag = 'MR';
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'nyc_marathon_form_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
			$flagDetails = saveDPFlag($donorId, 'WSDWNLD');
			error_log( 'download_free_resources_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'download_free_resources_to_dp_iam after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){
			$flagDetails = saveDPFlag($donorId, 'WSDWNLD');
			error_log( 'download_free_resources_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'download_free_resources_to_dp_iam after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	}
}

// sponsor a Lyme prevention educational program Form
add_action( 'gform_after_submission_15', 'spon_a_lyme_prevention_edu_prog_to_dp', 10, 2 );
function spon_a_lyme_prevention_edu_prog_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '11' );
	$email = rgar( $entry, '3' );
	$employer = rgar( $entry, '2' );
	$country = rgar( $entry, '12' );
	$address1 = rgar( $entry, '13' );
	$city = rgar( $entry, '4' );
	$cityStateProvince = rgar( $entry, '14' );
	$state = rgar( $entry, '6' );
	$postal = rgar( $entry, '7' );
	$sponsorship1 = rgar( $entry, '8.1' );
	$sponsorship2 = rgar( $entry, '8.2' );
	$sponsorship3 = rgar( $entry, '8.3' );
	$sponsorship4 = rgar( $entry, '8.4' );

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, null, $employer, null, null, null, null, null, $sponsorship1, $sponsorship2, $sponsorship3, $sponsorship4, null);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
		
			if ($sponsorship1 != '') {

				if(!isDonorFlagSet($donorId, "SPNRED")){
					$UDFFirstDate = dp_save_udf_xml( $donorId, 'SPED_DT', 'D', null, $current_date_value, null);
					error_log( 'spon_a_lyme_prevention_edu_prog_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
				}

				$flagDetails = saveDPFlag($donorId, 'SPNRED');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			if ($sponsorship2 != '') {

				if(!isDonorFlagSet($donorId, "SPNRE")){
					$UDFFirstDate = dp_save_udf_xml( $donorId, 'SPBE_DT', 'D', null, $current_date_value, null);
					error_log( 'spon_a_lyme_prevention_edu_prog_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
				}

				$flagDetails = saveDPFlag($donorId, 'SPNRE');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			if ($sponsorship3 != '') {

				if(!isDonorFlagSet($donorId, "SPNRRES")){
					$UDFFirstDate = dp_save_udf_xml( $donorId, 'SPR_DT', 'D', null, $current_date_value, null);
					error_log( 'spon_a_lyme_prevention_edu_prog_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
				}

				$flagDetails = saveDPFlag($donorId, 'SPNRRES');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}
	
			if ($sponsorship4 != '') {

				if(!isDonorFlagSet($donorId, "SPNR")){
					$UDFFirstDate = dp_save_udf_xml( $donorId, 'SPB_DT', 'D', null, $current_date_value, null);
					error_log( 'spon_a_lyme_prevention_edu_prog_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
				}

				$flagDetails = saveDPFlag($donorId, 'SPNR');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			$EMPLOYERUDFDetails = dp_save_udf_xml( $donorId, 'EMPLOYER', 'C', $employer, null, null);
			error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $EMPLOYERUDFDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){
			if ($sponsorship1 != '') {

				if(!isDonorFlagSet($donorId, "SPNRED")){
					$UDFFirstDate = dp_save_udf_xml( $donorId, 'SPED_DT', 'D', null, $current_date_value, null);
					error_log( 'spon_a_lyme_prevention_edu_prog_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
				}

				$flagDetails = saveDPFlag($donorId, 'SPNRED');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			if ($sponsorship2 != '') {

				if(!isDonorFlagSet($donorId, "SPNRE")){
					$UDFFirstDate = dp_save_udf_xml( $donorId, 'SPBE_DT', 'D', null, $current_date_value, null);
					error_log( 'spon_a_lyme_prevention_edu_prog_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
				}

				$flagDetails = saveDPFlag($donorId, 'SPNRE');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			if ($sponsorship3 != '') {

				if(!isDonorFlagSet($donorId, "SPNRRES")){
					$UDFFirstDate = dp_save_udf_xml( $donorId, 'SPR_DT', 'D', null, $current_date_value, null);
					error_log( 'spon_a_lyme_prevention_edu_prog_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
				}

				$flagDetails = saveDPFlag($donorId, 'SPNRRES');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}
	
			if ($sponsorship4 != '') {

				if(!isDonorFlagSet($donorId, "SPNR")){
					$UDFFirstDate = dp_save_udf_xml( $donorId, 'SPB_DT', 'D', null, $current_date_value, null);
					error_log( 'spon_a_lyme_prevention_edu_prog_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
				}

				$flagDetails = saveDPFlag($donorId, 'SPNR');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}
		}
	}
}

// Spin the wheel
add_action( 'gform_after_submission_24', 'spin_the_wheel_form_to_dp', 10, 2 );
function spin_the_wheel_form_to_dp( $entry, $form ) {

 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '2' );
	$email = rgar( $entry, '24' );
	$homePhone = rgar( $entry, '23' );
	$iam = rgar( $entry, '12' );
	$address1 = rgar( $entry, '19' );
	$country = rgar( $entry, '5' );
	$city = rgar( $entry, '6' );
	$cityStateProvince = rgar( $entry, '10' );
	$state = rgar( $entry, '8' );
	$postal = rgar( $entry, '9' );
	$iamFlag = '';

	if ($iam == 'Lyme patient') {
		$iamFlag = 'PAT';
	} elseif ($iam == 'Caregiver: parent') {
		$iamFlag = 'CGP';
	} elseif ($iam == 'Caregiver: spouse') {
		$iamFlag = 'CGS';
	} elseif ($iam == 'Physician') {
		$iamFlag = 'PHY';
	} elseif ($iam == 'Nurse') {
		$iamFlag = 'NUR';
	} elseif ($iam == 'Psychiatrist/psychologist') {
		$iamFlag = 'PSY';
	} elseif ($iam == 'Pharma/Diagnostic Rep') {
		$iamFlag = 'PHRM';
	} elseif ($iam == 'Teacher') {
		$iamFlag = 'TCH';
	} elseif ($iam == 'Camp counselor') {
		$iamFlag = 'CMP';
	} elseif ($iam == 'Researcher') {
		$iamFlag = 'RSRCH';
	} elseif ($iam == 'Media') {
		$iamFlag = 'MDA';
	} elseif ($iam == 'Medical Representative') {
		$iamFlag = 'MR';
	}

	
	$interested1 = rgar( $entry, '20.1' );
	$interested2 = rgar( $entry, '20.2' );
	$interested3 = rgar( $entry, '20.3' );
	$interested4 = rgar( $entry, '20.4' );
	$interested5 = rgar( $entry, '20.5' );

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, $homePhone, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'spin_the_wheel_form_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
			
			$flagDetails = saveDPFlag($donorId, 'STW');
			error_log( 'digital_education_form_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if ($interested1 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INED');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested2 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INFR');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested3 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INPS');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested4 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INEV');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested5 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INRN');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){
			$flagDetails = saveDPFlag($donorId, 'STW');
			error_log( 'digital_education_form_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if ($interested1 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INED');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested2 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INFR');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested3 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INPS');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested4 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INEV');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested5 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INRN');
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
		}
	}
}

// Survey Landing Page
add_action( 'gform_after_submission_21', 'survey_landing_page_to_dp', 10, 2 );
function survey_landing_page_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	$firstName = rgar( $entry, '1' );
	$lastName = rgar( $entry, '2' );
	$email = rgar( $entry, '24' );
	$homePhone = rgar( $entry, '23' );
	$iam = rgar( $entry, '12' );
	$address1 = rgar( $entry, '19' );
	$country = rgar( $entry, '5' );
	$city = rgar( $entry, '6' );
	$cityStateProvince = rgar( $entry, '10' );
	$state = rgar( $entry, '8' );
	$postal = rgar( $entry, '9' );
	$iamFlag = '';

	if ($iam == 'Lyme patient') {
		$iamFlag = 'PAT';
	} elseif ($iam == 'Caregiver: parent') {
		$iamFlag = 'CGP';
	} elseif ($iam == 'Caregiver: spouse') {
		$iamFlag = 'CGS';
	} elseif ($iam == 'Physician') {
		$iamFlag = 'PHY';
	} elseif ($iam == 'Nurse') {
		$iamFlag = 'NUR';
	} elseif ($iam == 'Psychiatrist/psychologist') {
		$iamFlag = 'PSY';
	} elseif ($iam == 'Pharma/Diagnostic Rep') {
		$iamFlag = 'PHRM';
	} elseif ($iam == 'Teacher') {
		$iamFlag = 'TCH';
	} elseif ($iam == 'Camp counselor') {
		$iamFlag = 'CMP';
	} elseif ($iam == 'Researcher') {
		$iamFlag = 'RSRCH';
	} elseif ($iam == 'Media') {
		$iamFlag = 'MDA';
	} elseif ($iam == 'Medical Representative') {
		$iamFlag = 'MR';
	}

	$interested1 = rgar( $entry, '20.1' );
	$interested2 = rgar( $entry, '20.2' );
	$interested3 = rgar( $entry, '20.3' );
	$interested4 = rgar( $entry, '20.4' );
	$interested5 = rgar( $entry, '20.5' );

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, $homePhone, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
			
			if(!isDonorFlagSet($donorId, "WE")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WE_DT', 'D', null, $current_date_value, null);
				error_log( 'survey_landing_page_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WE');
			error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if ($interested1 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INED');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested2 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INFR');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested3 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INPS');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested4 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INEV');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested5 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INRN');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){

			if(!isDonorFlagSet($donorId, "WE")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'WE_DT', 'D', null, $current_date_value, null);
				error_log( 'survey_landing_page_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'WE');
			error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $flagDetails, true ) );

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if ($interested1 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INED');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested2 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INFR');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested3 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INPS');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested4 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INEV');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
			if ($interested5 != ''){
				$interestedFlagDetails = saveDPFlag($donorId, 'INRN');
				error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $interestedFlagDetails, true ) );
			}
		}
	}
}

// Registration form - Professional Education
add_action( 'gform_after_submission_26', 'registration_form_professional_education_to_dp', 10, 2 );
function registration_form_professional_education_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	
	$firstName = rgar( $entry, '2' );
	$lastName = rgar( $entry, '3' );
	$email = rgar( $entry, '12' );
	$homePhone = '';
	$iam = rgar( $entry, '1' );
	$address1 = rgar( $entry, '5' );
	$country = rgar( $entry, '6' );
	$city = rgar( $entry, '7' );
	$cityStateProvince = rgar( $entry, '9' );
	$state = rgar( $entry, '8' );
	$postal = rgar( $entry, '10' );
	$speciality	= rgar( $entry, '13' );
	$degree	= rgar( $entry, '14' );
	$degreeOther = rgar( $entry, '15' );
	$yearsInPractice = rgar( $entry, '16' );
	$practiceType = rgar( $entry, '17' );
	
	$iamFlag = '';

	if ($iam == 'Lyme patient') {
		$iamFlag = 'PAT';
	} elseif ($iam == 'Caregiver: parent') {
		$iamFlag = 'CGP';
	} elseif ($iam == 'Caregiver: spouse') {
		$iamFlag = 'CGS';
	} elseif ($iam == 'Physician') {
		$iamFlag = 'PHY';
	} elseif ($iam == 'Nurse') {
		$iamFlag = 'NUR';
	} elseif ($iam == 'Psychiatrist/psychologist') {
		$iamFlag = 'PSY';
	} elseif ($iam == 'Pharma/Diagnostic Rep') {
		$iamFlag = 'PHRM';
	} elseif ($iam == 'Teacher') {
		$iamFlag = 'TCH';
	} elseif ($iam == 'Camp counselor') {
		$iamFlag = 'CMP';
	} elseif ($iam == 'Researcher') {
		$iamFlag = 'RSRCH';
	} elseif ($iam == 'Media') {
		$iamFlag = 'MDA';
	} elseif ($iam == 'Medical Representative') {
		$iamFlag = 'MR';
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, $homePhone, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if ($speciality != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'SPLTY', 'C', $speciality, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($yearsInPractice != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'YRS', 'C', $yearsInPractice, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($degreeOther != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'OTHDGR', 'C', $degreeOther, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($degree != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'DGR', 'C', $degree, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($practiceType != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'TPYP', 'C', $practiceType, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if(!isDonorFlagSet($donorId, "CMEPEDIATRIC")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'CMEPED_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'CMEPEDIATRIC');
			error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}

			if ($speciality != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'SPLTY', 'C', $speciality, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($yearsInPractice != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'YRS', 'C', $yearsInPractice, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($degreeOther != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'OTHDGR', 'C', $degreeOther, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($degree != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'DGR', 'C', $degree, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($practiceType != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'TPYP', 'C', $practiceType, null, null);
				error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if(!isDonorFlagSet($donorId, "CMEPEDIATRIC")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'CMEPED_DT', 'D', null, $current_date_value, null);
				error_log( 'dp_popup_newsletter_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'CMEPEDIATRIC');
			error_log( 'registration_form_professional_education_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// GLA Physician Referral Directory Landing Page
add_action( 'gform_after_submission_28', 'physician_referral_directory_landing_page_to_dp', 10, 2 );
function physician_referral_directory_landing_page_to_dp( $entry, $form ) {

	$current_date_value = date('m/d/Y');
 	$firstName = rgar( $entry, '51' );
	$lastName = rgar( $entry, '52' );
	$email = rgar( $entry, '18' );
	$homePhone = rgar( $entry, '20' );
	$address1 = rgar( $entry, '10' );
	$country = rgar( $entry, '12' );
	$city = rgar( $entry, '13' );
	$cityStateProvince = rgar( $entry, '16' );
	$state = rgar( $entry, '15' );
	$postal = rgar( $entry, '17' );
	$credentials = rgar( $entry, '53' );
	$yearsPractice = rgar( $entry, '54' );
	$typePractice = rgar( $entry, '27' );
	$typePracticeOther = rgar( $entry, '28' );

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, $homePhone, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'survey_landing_page_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];

			if(!isDonorFlagSet($donorId, "DRAPPL")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'DRAP_DT', 'D', null, $current_date_value, null);
				error_log( 'physician_referral_directory_landing_page_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}
			
			$flagDetails = saveDPFlag($donorId, 'DRAPPL');
			error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $flagDetails, true ) );

			if ($credentials != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'DGR', 'C', $credentials, null, null);
				error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($yearsPractice != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'YRS', 'C', $yearsPractice, null, null);
				error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($typePractice != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'TPYP', 'C', $typePractice, null, null);
				error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($typePracticeOther != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'TYPE', 'C', $typePracticeOther, null, null);
				error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			for ( $i = 0; $i <= 50; $i++ ){
				$specialty = rgar( $entry, '5.'.$i );
				if ($specialty != '') {
					$WEBUDFDetails = dp_savemultivalue_xml( $donorId, 'SPLTYCB', $specialty);
					error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
				}
			}
		}
	} else {
		foreach($matchingDonors as $donorId){

			if(!isDonorFlagSet($donorId, "DRAPPL")){
				$UDFFirstDate = dp_save_udf_xml( $donorId, 'DRAP_DT', 'D', null, $current_date_value, null);
				error_log( 'physician_referral_directory_landing_page_to_dp First date: ' . print_r( $UDFFirstDate, true ) );
			}

			$flagDetails = saveDPFlag($donorId, 'DRAPPL');
			error_log( 'digital_education_form_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
			
			if ($credentials != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'DGR', 'C', $credentials, null, null);
				error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($yearsPractice != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'YRS', 'C', $yearsPractice, null, null);
				error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($typePractice != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'TPYP', 'C', $typePractice, null, null);
				error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			if ($typePracticeOther != '') {
				$WEBUDFDetails = dp_save_udf_xml( $donorId, 'TYPE', 'C', $typePracticeOther, null, null);
				error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
			}

			for ( $i = 0; $i <= 50; $i++ ){
				$specialty = rgar( $entry, '5.'.$i );
				if ($specialty != '') {
					$WEBUDFDetails = dp_savemultivalue_xml( $donorId, 'SPLTYCB', $specialty);
					error_log( 'physician_referral_directory_landing_page_to_dp after_submission: ' . print_r( $WEBUDFDetails, true ) );
				}
			}
		}
	}
}

// Apply to be a mentor
add_action( 'gform_after_submission_29', 'apply_to_be_a_mentor_to_dp', 10, 2 );
function apply_to_be_a_mentor_to_dp( $entry, $form ) {
    
    $firstName = rgar( $entry, '1' );
    $lastName = rgar( $entry, '2' );
    $email = rgar( $entry, '13' );
    $country = rgar( $entry, '12' );
    $address1 = rgar( $entry, '3' );
    $address2 = rgar( $entry, '4' );
    $city = rgar( $entry, '5' );
    $cityStateProvince = rgar( $entry, '41' );
    $state = rgar( $entry, '40' );
    $postal = rgar( $entry, '7' );
	$homePhone = rgar( $entry, '14' );
	$dob_date_value = rgar( $entry, '62' );
    $iam = rgar( $entry, '43' );
    $iamFlag = '';
    
    if ($iam == 'Patient') {
        $iamFlag = 'PAT';
    } elseif ($iam == 'Caregiver') {
        $iamFlag = 'CGP';
    } elseif ($iam == 'Caregiver: spouse') {
        $iamFlag = 'CGS';
    } elseif ($iam == 'Physician') {
        $iamFlag = 'PHY';
    } elseif ($iam == 'Nurse') {
        $iamFlag = 'NUR';
    } elseif ($iam == 'Psychiatrist/psychologist') {
        $iamFlag = 'PSY';
    } elseif ($iam == 'Pharma/Diagnostic Rep') {
        $iamFlag = 'PHRM';
    } elseif ($iam == 'Teacher') {
        $iamFlag = 'TCH';
    } elseif ($iam == 'Camp counselor') {
        $iamFlag = 'CMP';
    } elseif ($iam == 'Researcher') {
        $iamFlag = 'RSRCH';
    } elseif ($iam == 'Media') {
        $iamFlag = 'MDA';
    } elseif ($iam == 'Medical Representative') {
        $iamFlag = 'MR';
    }
    
    $matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null, null, $dob_date_value, null, null, null, null, null, null, null, null, null, null, $iam);
    
    if( !count($matchingDonors) ){
        $donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, $homePhone, null );
        error_log( 'apply_to_be_a_mentor_to_dp after_submission: ' . print_r( $donorDetails, true ) );
        
        if (isset($donorDetails->{'record'}->{'field'}[0])) {
            $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
            $donorId = $donorDetails[0];
            
            if ($iamFlag != ''){
                $iAMflagDetails = saveDPFlag($donorId, $iamFlag);
                error_log( 'apply_to_be_a_mentor_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
            }
            
            $flagDetails = saveDPFlag($donorId, 'MENAP');
            error_log( 'apply_to_be_a_mentor_to_dp after_submission: ' . print_r( $flagDetails, true ) );

			if (is_wpe_gla_live()) {
				$UDFDetails = dp_save_udf_xml( $donorId, 'DOB', 'D', null, $dob_date_value, null);
				error_log( 'apply_to_be_a_mentor_to_dp after_submission: ' . print_r( $UDFDetails, true ) );
		    }else{
				$UDFDetails = dp_save_udf_xml( $donorId, 'BIRTHDATE', 'D', null, $dob_date_value, null);
				error_log( 'apply_to_be_a_mentor_to_dp after_submission: ' . print_r( $UDFDetails, true ) );
			}
        }
    } else {
        foreach($matchingDonors as $donorId){
            
            if ($iamFlag != ''){
                $iAMflagDetails = saveDPFlag($donorId, $iamFlag);
                error_log( 'apply_to_be_a_mentor_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
            }
            
            $flagDetails = saveDPFlag($donorId, 'MENAP');
            error_log( 'apply_to_be_a_mentor_to_dp after_submission: ' . print_r( $flagDetails, true ) );
        }
    }
}

// Request a peer mentor
add_action( 'gform_after_submission_30', 'request_a_peer_mentor_to_dp', 10, 2 );
function request_a_peer_mentor_to_dp( $entry, $form ) {
    
    $firstName = rgar( $entry, '1' );
    $lastName = rgar( $entry, '2' );
    $email = rgar( $entry, '13' );
    $country = rgar( $entry, '12' );
    $address1 = rgar( $entry, '3' );
    $address2 = rgar( $entry, '4' );
    $city = rgar( $entry, '5' );
    $cityStateProvince = rgar( $entry, '42' );
    $state = rgar( $entry, '41' );
    $postal = rgar( $entry, '7' );
	$homePhone = rgar( $entry, '14' );
	$dob_date_value = rgar( $entry, '61' );
    $iam = rgar( $entry, '24' );
    $iamFlag = '';
    
    if ($iam == 'patient') {
        $iamFlag = 'PAT';
    } elseif ($iam == 'patient_caregiver') {
        $iamFlag = 'CGP';
    } elseif ($iam == 'Caregiver: spouse') {
        $iamFlag = 'CGS';
    } elseif ($iam == 'Physician') {
        $iamFlag = 'PHY';
    } elseif ($iam == 'Nurse') {
        $iamFlag = 'NUR';
    } elseif ($iam == 'Psychiatrist/psychologist') {
        $iamFlag = 'PSY';
    } elseif ($iam == 'Pharma/Diagnostic Rep') {
        $iamFlag = 'PHRM';
    } elseif ($iam == 'Teacher') {
        $iamFlag = 'TCH';
    } elseif ($iam == 'Camp counselor') {
        $iamFlag = 'CMP';
    } elseif ($iam == 'Researcher') {
        $iamFlag = 'RSRCH';
    } elseif ($iam == 'Media') {
        $iamFlag = 'MDA';
    } elseif ($iam == 'Medical Representative') {
        $iamFlag = 'MR';
    }
    
    $matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null, null, $dob_date_value, null, null, null, null, null, null, null, null, null, null, $iam);
    
    if( !count($matchingDonors) ){
        $donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, $homePhone, null );
        error_log( 'request_a_peer_mentor_to_dp after_submission: ' . print_r( $donorDetails, true ) );
        
        if (isset($donorDetails->{'record'}->{'field'}[0])) {
            $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
            $donorId = $donorDetails[0];
            
            if ($iamFlag != ''){
                $iAMflagDetails = saveDPFlag($donorId, $iamFlag);
                error_log( 'request_a_peer_mentor_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
            }
            
            $flagDetails = saveDPFlag($donorId, 'PRAP');
            error_log( 'request_a_peer_mentor_to_dp after_submission: ' . print_r( $flagDetails, true ) );

			if (is_wpe_gla_live()) {
				$UDFDetails = dp_save_udf_xml( $donorId, 'DOB', 'D', null, $dob_date_value, null);
				error_log( 'apply_to_be_a_mentor_to_dp after_submission: ' . print_r( $UDFDetails, true ) );
		    }else{
				$UDFDetails = dp_save_udf_xml( $donorId, 'BIRTHDATE', 'D', null, $dob_date_value, null);
				error_log( 'apply_to_be_a_mentor_to_dp after_submission: ' . print_r( $UDFDetails, true ) );
			}
        }
    } else {
        foreach($matchingDonors as $donorId){
            
            if ($iamFlag != ''){
                $iAMflagDetails = saveDPFlag($donorId, $iamFlag);
                error_log( 'request_a_peer_mentor_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
            }
            
            $flagDetails = saveDPFlag($donorId, 'PRAP');
            error_log( 'request_a_peer_mentor_to_dp after_submission: ' . print_r( $flagDetails, true ) );
        }
    }
}

function saveDonor( $title = null, $firstName = null, $lastName = null, $email = null, $isCorp = null, $companyName = null, $country = null, $address1 = null, $address2 = null, $city = null, $cityStateProvince = null, $state = null, $postal = null, $phone = null , $professionalTitle = null, $nomail = 'N', $nomail_reason = null){
    
    $title = dp_clean($title);
    $firstName = dp_clean($firstName);
    $lastName = dp_clean($lastName);
    $email = dp_clean($email);
    $isCorp = dp_clean($isCorp);
    $companyName = dp_clean($companyName);
    $country = dp_clean($country);
    $address1 = dp_clean($address1);
    $address2 = dp_clean($address2);
    $city = dp_clean($city);
    $cityStateProvince = dp_clean($cityStateProvince);
    $state = dp_clean($state);
    $postal = dp_clean($postal);
    $phone = dp_clean($phone);
    $professionalTitle = dp_clean($professionalTitle);

    // Convert specific field's first character of each word to uppercase
    $firstName = gla_ucwords_gravity(strtolower($firstName));
    $lastName = gla_ucwords_gravity(strtolower($lastName));
    $address1 = gla_ucwords_gravity($address1);
    $address2 = gla_ucwords_gravity($address2);
    $city = gla_ucwords_gravity($city);
	$cityStateProvince = gla_ucwords_gravity($cityStateProvince);
    
    // Handle Corporate donation
    $donor_type = 'IN';
    $opt_line = ''; // Contact name
    
    if ($isCorp == 'Y') {
        $donor_type = 'OR';
        $opt_line = $firstName . ' ' . $lastName;
        $firstName = '';
        $lastName = $companyName;
        $title = '';
    }

	if ($country != 'US') {
		$city = $cityStateProvince;
	}
    
    $request = DP_API_KEY_URL . DP_API_KEY;
    $request .= "&action=dp_savedonor&params=";
    $request .= "0,"; // @donor_id
	$firstName ? $request .= "'$firstName'," : $request .= "null,";// @first_name
	$lastName ? $request .= "'$lastName'," : $request .= "null,"; // @last_name
    $request .= "null,"; // @middle_name
    $request .= "null,"; // @suffix
	$title ? $request .= "'$title'," : $request .= "null,"; // @title
    $request .= "null,"; // @salutation
    $professionalTitle? $request .= "'$professionalTitle'," : $request .= "null,"; // @prof_title
	$opt_line ? $request .= "'$opt_line'," : $request .= "null,";// @opt_line
	$address1 ? $request .= "'$address1'," : $request .= "null,";// @address
	$address2 ? $request .= "'$address2'," : $request .= "null,";// $address2
	$city ? $request .= "'$city'," : $request .= "null,";// @city
	$state ? $request .= "'$state'," : $request .= "null,";// @state
	$postal ? $request .= "'$postal'," : $request .= "null,";// @zip
	$country ? $request .= "'$country'," : $request .= "null,"; // @country
    $request .= "null,"; // @address_type
	$phone ? $request .= "'$phone'," : $request .= "null,"; // @home_phone
    $request .= "null,"; // @business_phone
    $request .= "null,"; // @fax_phone
    $request .= "'',"; // @mobile_phone
	$email ? $request .= "'$email'," : $request .= "null,";// @email
	$isCorp ? $request .= "'$isCorp'," : $request .= "null,";// @org_rec
	$donor_type ? $request .= "'$donor_type'," : $request .= "null,"; // @donor_type
	$nomail ? $request .= "'$nomail'," : $request .= "'N',";// @nomail
	$nomail_reason ? $request .= "'$nomail_reason'," : $request .= "null,";// @nomail_reason
    $request .= "null,"; // @narrative
    $request .= "'GLA API User'"; // @user_id
    
    $request = urlencode($request);
    
    $donorDetails;
    try {
        $donorDetails = simplexml_load_file($request);
    } catch (Exception $e) {
        error_log( 'nyc_marathon_form_to_dp error after_submission: ' . print_r( $e, true ) );
    }
    
    return $donorDetails;
}

function saveDPFlag($donorId, $flag)
{
        $request = DP_API_KEY_URL . DP_API_KEY;
        $request .= "&action=dp_saveflag_xml&params=";
        $request .= "'$donorId',"; // @donor_id
        $request .= "'$flag',"; // @flag
        $request .= "'GLA API User'"; // @user_id
        
        $request = urlencode($request);
        $flagDetails;
        try {
            $flagDetails = simplexml_load_file($request);
        } catch (Exception $e) {
	        error_log( 'nyc_marathon_form_to_dp_flag error after_submission: ' . print_r( $e, true ) );
        }
    
    return $flagDetails;
}

function dp_save_udf_xml( $matching_id, $field_name, $data_type, $char_value, $date_value, $number_value) {
 
	$request = DP_API_KEY_URL . DP_API_KEY;
	$request .= "&action=dp_save_udf_xml&params=";
	
	$request .= "'$matching_id',"; // @matching_id numeric Specify either a donor_id value if updating a donor record, a gift_id value if updating a gift record or an other_id value if updating a dpotherinfo table value (see dp_saveotherinfo)
	$request .= "'$field_name',"; // @field_name Nvarchar(20)
	$request .= "'$data_type',"; // @data_type Nvarchar(1) C- Character, D-Date, N- Numeric
	$char_value ? $request .= "'$char_value'," : $request .= "null,"; // @char_value Nvarchar(2000) Null if not a Character field
	$date_value ? $request .= "'$date_value'," : $request .= "null,"; // @date_value datetime Null if not a Date field
	$number_value ? $request .= "'$number_value'," : $request .= "null,";// @number_value numeric (18,4) Null if not a Number field
	$request .= "'GLA API User'"; // @user_id Nvarchar(20) We recommend that you use a name here, such as the name of your API application, for auditing purposes. The user_id value does not need to match the name of an actual DPO user account.
		
	$request = urlencode ( $request );
	$UDFDetails = '';
	try {
		$UDFDetails = simplexml_load_file ( $request );
	} catch ( Exception $e ) {
		error_log( 'nyc_marathon_form_to_dp_udf error after_submission: ' . print_r( $e, true ) );
	}
	
	return $UDFDetails;
}

function dp_savemultivalue_xml( $matching_id, $field_name, $code) {

    $request = DP_API_KEY_URL . DP_API_KEY;
    $request .= "&action=dp_savemultivalue_xml&params=";

    $request .= "'$matching_id',"; // @matching_id numeric Specify either a donor_id value if updating a donor record, a gift_id value if updating a gift record or an other_id value if updating a dpotherinfo table value (see dp_saveotherinfo)
    $request .= "'$field_name',"; // @field_name Nvarchar(20)
    $request .= "'$code',"; // @code Varchar(30)Enter the Code value of the checkbox entry you wish to set
    $request .= "'GLA API User'"; // @user_id Nvarchar(20) We recommend that you use a name here, such as the name of your API application, for auditing purposes. The user_id value does not need to match the name of an actual DPO user account.

    $request = urlencode ( $request );
    $UDFDetails = '';
    try {
        $UDFDetails = simplexml_load_file ( $request );
    } catch ( Exception $e ) {
        error_log( 'nyc_marathon_form_to_dp_udf error after_submission: ' . print_r( $e, true ) );
    }

    return $UDFDetails;
}

function handleMatchingDonorByEmail($email, $formTitle, $title = null, $firstName = null, $lastName = null, $isCorp = null, $companyName = null, $country = null, $address1 = null, $address2 = null, $city = null, $cityStateProvince = null, $state = null, $postal = null, $phone = null , $professionalTitle = null, $website = null, $dob_date_value = null, $employer = null, $curriculum1 = null, $curriculum2 = null, $curriculum3 = null, $curriculum4 = null, $occupationCode = null, $sponsorship1 = null, $sponsorship2 = null, $sponsorship3 = null, $sponsorship4 = null, $iam = null)
{
        $emailPost = $email . '%';

        $request = DP_API_KEY_URL . DP_API_KEY;
        $request .= "&action=SELECT donor_id from dp where email like ";
        $request .= "'$emailPost'";// @email
        $request = urlencode($request);

        $matchingDonor = array();
		$matchingDonorRecords;
        
		try {
            $matchingDonorRecords = simplexml_load_file($request);
        } catch (Exception $e) {
	        error_log( 'handleMatchingDonorByEmail error after_submission: ' . print_r( $e, true ) );
        }

		if(isset($matchingDonorRecords->record)){
			foreach($matchingDonorRecords->record as $record){
				if(isset($record->field)){
					//print_r((string)$record->field->attributes ()->value);
					//foreach($record->field->attributes() as $donor_id_key => $donor_id_value ){};
					$matchingDonor[] = (string)(string)$record->field->attributes()->value;
				}
			}
		}

		if(count($matchingDonor)){
			$to = NOTIFICATION_TO_EMAIL;
			$headers[] = 'From: Global Lyme Alliance <info@globallymealliance.org>';
			$headers[] = 'Bcc: '.NOTIFICATION_BCC_EMAIL;
			$subject = 'Duplicate Donor Submission from GLA Form';
			$message = 'Duplicate Donor Found for mail Id: '.$email."\n\n";
			$message .= 'Form Name: '.$formTitle."\n\n";
			$message .= 'Duplicate Donor Ids: '.implode (", ", $matchingDonor)."\n\n";
			$title ? $message .= 'Title: '.$title."\n\n" : '';
			$firstName ? $message .= 'First Name: '.$firstName."\n\n" : '';
			$lastName ? $message .= 'Last Name: '.$lastName."\n\n" : '';
			$isCorp ? $message .= 'Is Corp: '.$isCorp."\n\n" : '';
			$companyName ? $message .= 'Company Name: '.$companyName."\n\n" : '';
			$country ? $message .= 'Country: '.$country."\n\n" : '';
			$address1 ? $message .= 'Address1: '.$address1."\n\n" : '';
			$address2 ? $message .= 'Address2: '.$address2."\n\n" : '';
			$city ? $message .= 'City: '.$city."\n\n" : '';
			$cityStateProvince ? $message .= 'City/State/Province: '.$cityStateProvince."\n\n" : '';
			$state ? $message .= 'State: '.$state."\n\n" : '';
			$postal ? $message .= 'Postal: '.$postal."\n\n" : '';
			$phone ? $message .= 'Phone: '.$phone."\n\n" : '';
			$professionalTitle ? $message .= 'Professional Title: '.$professionalTitle."\n\n" : '';
			$website ? $message .= 'Website: '.$website."\n\n" : '';
			$dob_date_value ? $message .= 'DOB: '.$dob_date_value."\n\n" : '';
			$employer ? $message .= 'Employer: '.$employer."\n\n" : '';
			$curriculum1 ? $message .= 'Curriculum: '.$curriculum1."\n\n" : '';
			$curriculum2 ? $message .= 'Curriculum: '.$curriculum2."\n\n" : '';
			$curriculum3 ? $message .= 'Curriculum: '.$curriculum3."\n\n" : '';
			$curriculum4 ? $message .= 'Curriculum: '.$curriculum4."\n\n" : '';
			$occupationCode ? $message .= 'Occupation: '.$occupationCode."\n\n" : '';
			$sponsorship1 ? $message .= 'Sponsorship Interest: '.$sponsorship1."\n\n" : '';
			$sponsorship2 ? $message .= 'Sponsorship Interest: '.$sponsorship2."\n\n" : '';
			$sponsorship3 ? $message .= 'Sponsorship Interest: '.$sponsorship3."\n\n" : '';
			$sponsorship4 ? $message .= 'Sponsorship Interest: '.$sponsorship4."\n\n" : '';
			$iam ? $message .= 'I Am: '.$iam."\n\n" : '';


			wp_mail( $to, $subject, $message, $headers);
		}
    
    return $matchingDonor;
}

function isDonorFlagSet($donorId, $flagCode)
{
        $request = DP_API_KEY_URL . DP_API_KEY;
        $request .= "&action=SELECT * FROM DPFLAGS WHERE DONOR_ID = ";
        $request .= "$donorId";// @donorId
		$request .= "AND FLAG = ";
		$request .= "'$flagCode'";// @$flagCode
        $request = urlencode($request);

		$matchingDonorRecords;
        
		try {
            $matchingDonorRecords = simplexml_load_file($request);
        } catch (Exception $e) {
	        error_log( 'isDonorFlagSet error after_submission: ' . print_r( $e, true ) );
        }

		if(isset($matchingDonorRecords->record)){
			return true;
		}
    
    return false;
}

function dp_clean($string)
{
    $replaceArr = array(
        ',',
        '#',
        '&',
        '+'
    );
    
    // Replace single quotes with double single quotes as mentioned n http://api.warrenbti.com/?q=node/10
    $string = str_replace("'", "''", $string);
    return str_replace($replaceArr, "", $string);
}

function gla_ucwords_gravity($string)
{
    return str_replace("' ", "'", ucwords(str_replace("'", "' ", $string)));
}

function is_wpe_gla_live(){
	if ($_SERVER ['SERVER_NAME'] === 'globallymealliance.org'){
		return true;
	} else{
		return false;
	}
}

// Ambassador Form Backend DOB Combined for Export
add_filter( 'gform_export_field_value', 'set_gla_custom_export_values', 10, 4 );
function set_gla_custom_export_values( $value, $form_id, $field_id, $entry ) {
    
	if($form_id == 18 ){
		error_log(print_r($entry,true));
		if( $field_id == 45) {
			$value = $entry[4].'/'.$entry[3].'/'.$entry[5];
		}
	}
    return $value;
}
