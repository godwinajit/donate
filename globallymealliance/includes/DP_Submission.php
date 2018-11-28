<?php
define('DP_API_KEY_URL', 'https://www.donorperfect.net/prod/xmlrequest.asp?apikey=' );

if (is_wpe()) {
	define('DP_API_KEY', 'HFCBGrK8x8aiXpEu50tVH31W7akQaoPOiUtFpsHiXH%2fUKsFZQ4uX3L1gaDHsywRmHwzAsalBDEVpMDsIs56kM%2brGU%2b1SS%2fzQCZodcSq7c6hokQPh1VZPUBRXN9ULnmYp' );
	define('NOTIFICATION_TO_EMAIL','Casie.Richardson@globallymealliance.org');
	define('NOTIFICATION_BCC_EMAIL','goliver@mindtrustlabs.com');
}else{
	define('DP_API_KEY', 'je%2bXp6cgiCJxfTn0mJV03Nmxigk67oGD2RwFtAlAmjjHxyZYMHS1KhaMRZICl6hi0IhfD76St3UKnS74HUORHf48DNJB1OBs5KD2bGE5zGPbX8pQbuR5Vggp4STJvOXy' );
	define('NOTIFICATION_TO_EMAIL','goliver@mindtrustlabs.com');
	define('NOTIFICATION_BCC_EMAIL','goliver@mindtrustlabs.com');
}

// Add your support group
add_action( 'gform_after_submission_17', 'add_your_support_group_to_dp', 10, 2 );
function add_your_support_group_to_dp( $entry, $form ) {

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
			$flagDetails = saveDPFlag($donorId, 'SG');
			error_log( 'add_your_support_group_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			$WEBUDFDetails = dp_save_udf_xml( $donorId, 'WEB', 'C', $website, null, null);
			error_log( 'add_your_support_group_to_dp_web after_submission: ' . print_r( $WEBUDFDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){
			$flagDetails = saveDPFlag($donorId, 'SG');
			error_log( 'add_your_support_group_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Apply NYC Marathon Form
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

			if (is_wpe()) {
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

// Contact GLA to request a company presentation
add_action( 'gform_after_submission_14', 'req_a_company_pre_to_dp', 10, 2 );
function req_a_company_pre_to_dp( $entry, $form ) {

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
			$flagDetails = saveDPFlag($donorId, 'EDB');
			error_log( 'req_a_company_pre_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			$EMPLOYERUDFDetails = dp_save_udf_xml( $donorId, 'EMPLOYER', 'C', $employer, null, null);
			error_log( 'req_a_company_pre_to_dp_employer after_submission: ' . print_r( $EMPLOYERUDFDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){
			$flagDetails = saveDPFlag($donorId, 'EDB');
			error_log( 'req_a_company_pre_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Contact Us
add_action( 'gform_after_submission_7', 'contact_us_to_dp', 10, 2 );
function contact_us_to_dp( $entry, $form ) {

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
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'contact_us_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
			$flagDetails = saveDPFlag($donorId, 'WSCNT');
			error_log( 'contact_us_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'contact_us_to_dp_flag after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){
			$flagDetails = saveDPFlag($donorId, 'WSCNT');
			error_log( 'contact_us_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'contact_us_to_dp_flag after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	}
}

// Digital Education Form
add_action( 'gform_after_submission_13', 'digital_education_form_to_dp', 10, 2 );
function digital_education_form_to_dp( $entry, $form ) {

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
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'digital_education_form_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
			
			$flagDetails = saveDPFlag($donorId, 'WSDIG');
			error_log( 'digital_education_form_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'digital_education_form_to_dp_iam after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){
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

// Download Teacher & Student Resources
add_action( 'gform_after_submission_11', 'down_teach_student_resources_to_dp', 10, 2 );
function down_teach_student_resources_to_dp( $entry, $form ) {

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
			$flagDetails = saveDPFlag($donorId, 'WSTCHSTD');
			error_log( 'download_free_resources_to_dp_flag after_submission: ' . print_r( $flagDetails, true ) );
		}
	}
}

// Find a Medical Professional Form
add_action( 'gform_after_submission_5', 'find_a_medical_pro_to_dp', 10, 2 );
function find_a_medical_pro_to_dp( $entry, $form ) {

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
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, $address2, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
			$flagDetails = saveDPFlag($donorId, 'WSFMED');
			error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){
			$flagDetails = saveDPFlag($donorId, 'WSFMED');
			error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $flagDetails, true ) );

			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'find_a_medical_pro_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	}
}

// View Video Resources Form
add_action( 'gform_after_submission_12', 'view_video_resources_to_dp', 10, 2 );
function view_video_resources_to_dp( $entry, $form ) {

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
	}

	$matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, $firstName, $lastName, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $iam);

	if( !count($matchingDonors) ){
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null, null );
		error_log( 'view_video_resources_to_dp after_submission: ' . print_r( $donorDetails, true ) );

		if (isset($donorDetails->{'record'}->{'field'}[0])) {
			$donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
	        $donorId = $donorDetails[0];
			$flagDetails = saveDPFlag($donorId, 'WSVID');
			error_log( 'view_video_resources_to_dp after_submission: ' . print_r( $flagDetails, true ) );
		
			if ($iamFlag != ''){
				$iAMflagDetails = saveDPFlag($donorId, $iamFlag);
				error_log( 'view_video_resources_to_dp after_submission: ' . print_r( $iAMflagDetails, true ) );
			}
		}
	} else {
		foreach($matchingDonors as $donorId){
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
		$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, null, null, null, null,null, null, null, null, null );
		error_log( 'dp_newsletter_to_dp after_submission: ' . print_r( $donorDetails, true ) );

	    if (isset($donorDetails->{'record'}->{'field'}[0])) {
		    $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
			$donorId = $donorDetails[0];
			//Newsletter Flag for DP is commented out i.e no flags will be added/updated in DP for Newsletter Form submissions
			/*$flagDetails = saveDPFlag($donorId, 'NLTR');
			error_log( 'dp_newsletter_to_dp after_submission: ' . print_r( $flagDetails, true ) );*/
		}
	} else {
		foreach($matchingDonors as $donorId){
			/*$flagDetails = saveDPFlag($donorId, 'NLTR');
			error_log( 'dp_newsletter_to_dp after_submission: ' . print_r( $flagDetails, true ) );*/
		}
	}
}

// DP Newsletter Form
add_action( 'gform_after_submission_8', 'dp_popup_newsletter_to_dp', 10, 2 );
function dp_popup_newsletter_to_dp( $entry, $form ) {

    $firstName = '';
    $lastName = rgar( $entry, '1' );
    $email = rgar( $entry, '1' );

    $matchingDonors = handleMatchingDonorByEmail($email, $form['title'], null, null, null, null, null, null, null, null, null,null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    if( !count($matchingDonors) ){
        $donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, null, null, null, null,null, null, null, null, null );
        error_log( 'dp_newsletter_to_dp after_submission: ' . print_r( $donorDetails, true ) );

        if (isset($donorDetails->{'record'}->{'field'}[0])) {
            $donorDetails = $donorDetails->{'record'}->{'field'}[0]->attributes()->{'value'};
            $donorId = $donorDetails[0];
            //Newsletter Flag for DP is commented out i.e no flags will be added/updated in DP for Newsletter Form submissions
            /*$flagDetails = saveDPFlag($donorId, 'NLTR');
            error_log( 'dp_newsletter_to_dp after_submission: ' . print_r( $flagDetails, true ) );*/
        }
    } else {
        foreach($matchingDonors as $donorId){
            /*$flagDetails = saveDPFlag($donorId, 'NLTR');
            error_log( 'dp_newsletter_to_dp after_submission: ' . print_r( $flagDetails, true ) );*/
        }
    }
}

// sponsor a Lyme prevention educational program Form
add_action( 'gform_after_submission_15', 'spon_a_lyme_prevention_edu_prog_to_dp', 10, 2 );
function spon_a_lyme_prevention_edu_prog_to_dp( $entry, $form ) {

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
				$flagDetails = saveDPFlag($donorId, 'SPNRED');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			if ($sponsorship2 != '') {
				$flagDetails = saveDPFlag($donorId, 'SPNRE');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			if ($sponsorship3 != '') {
				$flagDetails = saveDPFlag($donorId, 'SPNRRES');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}
	
			if ($sponsorship4 != '') {
				$flagDetails = saveDPFlag($donorId, 'SPNR');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			$EMPLOYERUDFDetails = dp_save_udf_xml( $donorId, 'EMPLOYER', 'C', $employer, null, null);
			error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $EMPLOYERUDFDetails, true ) );
		}
	} else {
		foreach($matchingDonors as $donorId){
			if ($sponsorship1 != '') {
				$flagDetails = saveDPFlag($donorId, 'SPNRED');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			if ($sponsorship2 != '') {
				$flagDetails = saveDPFlag($donorId, 'SPNRE');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}

			if ($sponsorship3 != '') {
				$flagDetails = saveDPFlag($donorId, 'SPNRRES');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}
	
			if ($sponsorship4 != '') {
				$flagDetails = saveDPFlag($donorId, 'SPNR');
				error_log( 'spon_a_lyme_prevention_edu_prog_to_dp after_submission: ' . print_r( $flagDetails, true ) );
			}
		}
	}
}

function saveDonor( $title = null, $firstName = null, $lastName = null, $email = null, $isCorp = null, $companyName = null, $country = null, $address1 = null, $address2 = null, $city = null, $cityStateProvince = null, $state = null, $postal = null, $phone = null , $professionalTitle = null){
    
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
    $firstName = gla_ucwords_gravity($firstName);
    $lastName = gla_ucwords_gravity($lastName);
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
    $request .= "'N',"; // @nomail
    $request .= "null,"; // @nomail_reason
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
	$UDFDetails;
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
	        error_log( 'nyc_marathon_form_to_dp_flag error after_submission: ' . print_r( $e, true ) );
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