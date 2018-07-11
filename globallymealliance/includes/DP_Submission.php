<?php
// DP API Details
define('DP_API_KEY_LIVE', 'HFCBGrK8x8aiXpEu50tVH31W7akQaoPOiUtFpsHiXH%2fUKsFZQ4uX3L1gaDHsywRmHwzAsalBDEVpMDsIs56kM%2brGU%2b1SS%2fzQCZodcSq7c6hokQPh1VZPUBRXN9ULnmYp' );
define('DP_API_KEY_STAGING', 'je%2bXp6cgiCJxfTn0mJV03Nmxigk67oGD2RwFtAlAmjjHxyZYMHS1KhaMRZICl6hi0IhfD76St3UKnS74HUORHf48DNJB1OBs5KD2bGE5zGPbX8pQbuR5Vggp4STJvOXy' );
define('DP_API_KEY_URL', 'https://www.donorperfect.net/prod/xmlrequest.asp?apikey=' );

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
	$state = rgar( $entry, '18' );
	$postal = rgar( $entry, '19' );
	$dob_date_value = rgar( $entry, '4' );

	$donorDetails = saveDonor( null, $firstName, $lastName, $email, null, null, $country, $address1, null, $city, $cityStateProvince, $state, $postal, null );
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
}



function saveDonor( $title = null, $firstName = null, $lastName = null, $email = null, $isCorp = null, $companyName = null, $country = null, $address1 = null, $address2 = null, $city = null, $cityStateProvince = null, $state = null, $postal = null, $phone = null ){
    
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
    
    // Convert specific field's first character of each word to uppercase
    $firstName = gla_ucwords($firstName);
    $lastName = gla_ucwords($lastName);
    $address1 = gla_ucwords($address1);
    $address2 = gla_ucwords($address2);
    $city = gla_ucwords($city);
    
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
    
    $dpAPIKey = DP_API_KEY_STAGING;
    
    if (is_wpe()) {
        $dpAPIKey = DP_API_KEY_LIVE;
    }
    
    $request = DP_API_KEY_URL . $dpAPIKey;
    $request .= "&action=dp_savedonor&params=";
    $request .= "0,"; // @donor_id
	$firstName ? $request .= "'$firstName'," : $request .= "null,";// @first_name
	$lastName ? $request .= "'$lastName'," : $request .= "null,"; // @last_name
    $request .= "null,"; // @middle_name
    $request .= "null,"; // @suffix
	$title ? $request .= "'$title'," : $request .= "null,"; // @title
    $request .= "null,"; // @salutation
    $request .= "null,"; // @prof_title
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
	$dpAPIKey = DP_API_KEY_STAGING;
        
        if (is_wpe()) {
            $dpAPIKey = DP_API_KEY_LIVE;
        }
        
        $request = DP_API_KEY_URL . $dpAPIKey;
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
	
	$dpAPIKey = DP_API_KEY_STAGING;
       
	if (is_wpe()) {
		$dpAPIKey = DP_API_KEY_LIVE;
	}
       
	$request = DP_API_KEY_URL . $dpAPIKey;
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

function gla_ucwords($string)
{
    return str_replace("' ", "'", ucwords(str_replace("'", "' ", $string)));
}