<?php
class SafeSave {
	protected $gatewayURL;
	protected $APIKey;
	
	public function __construct($gatewayURL, $APIKey) {
		$this->gatewayURL = $gatewayURL;
		$this->APIKey = $APIKey;
	}
	
	function submitTransactionDetails($tokenId, $ipAaddress) {
		// Step Three: Once the browser has been redirected, we can obtain the token-id and complete
		// the transaction through another XML HTTPS POST including the token-id which abstracts the
		// sensitive payment information that was previously collected by the Payment Gateway.
		$xmlRequest = new DOMDocument ( '1.0', 'UTF-8' );
		$xmlRequest->formatOutput = true;
		$xmlCompleteTransaction = $xmlRequest->createElement ( 'complete-action' );
		$this->appendXmlNode ( $xmlRequest, $xmlCompleteTransaction, 'api-key', $this->APIKey );
		$this->appendXmlNode ( $xmlRequest, $xmlCompleteTransaction, 'token-id', $tokenId );
		$xmlRequest->appendChild ( $xmlCompleteTransaction );
		
		// Process Step Three
		$data = $this->sendXMLviaCurl ( $xmlRequest, $this->gatewayURL );
		
		$gwResponse = @new SimpleXMLElement ( ( string ) $data );
		
		return $gwResponse;
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
		
		if (( string ) $gwResponse->result == 1) {
			print " <p><h3> Transaction was Approved, XML response was:</h3></p>\n";
			print '<pre>' . (htmlentities ( $data )) . '</pre>';
		} elseif (( string ) $gwResponse->result == 2) {
			print " <p><h3> Transaction was Declined.</h3>\n";
			print " Decline Description : " . ( string ) $gwResponse->{'result-text'} . " </p>";
			print " <p><h3>XML response was:</h3></p>\n";
			print '<pre>' . (htmlentities ( $data )) . '</pre>';
		} else {
			print " <p><h3> Transaction caused an Error.</h3>\n";
			print " Error Description: " . ( string ) $gwResponse->{'result-text'} . " </p>";
			print " <p><h3>XML response was:</h3></p>\n";
			print '<pre>' . (htmlentities ( $data )) . '</pre>';
		}
		print "</body></html>";
	}
	
	function sendXMLviaCurl($xmlRequest) {
		// helper function demonstrating how to send the xml with curl
		$ch = curl_init (); // Initialize curl handle
		curl_setopt ( $ch, CURLOPT_URL, $this->gatewayURL ); // Set POST URL
		
		$headers = array ();
		$headers [] = "Content-type: text/xml";
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers ); // Add http headers to let it know we're sending XML
		$xmlString = $xmlRequest->saveXML ();
		curl_setopt ( $ch, CURLOPT_FAILONERROR, 1 ); // Fail on errors
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 ); // Allow redirects
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 ); // Return into a variable
		curl_setopt ( $ch, CURLOPT_PORT, 443 ); // Set the port number
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 ); // Times out after 30s
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $xmlString ); // Add XML directly in POST
		
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
		
		// This should be unset in production use. With it on, it forces the ssl cert to be valid
		// before sending info.
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		
		if (! ($data = curl_exec ( $ch ))) {
			print "curl error =>" . curl_error ( $ch ) . "\n";
			throw new Exception ( " CURL ERROR :" . curl_error ( $ch ) );
		}
		curl_close ( $ch );
		
		return $data;
	}
	
	// Helper function to make building xml dom easier
	function appendXmlNode($domDocument, $parentNode, $name, $value) {
		$childNode = $domDocument->createElement ( $name );
		$childNodeValue = $domDocument->createTextNode ( $value );
		$childNode->appendChild ( $childNodeValue );
		$parentNode->appendChild ( $childNode );
	}
	
	function setSessionData($data) {
		foreach ( $data as $param_name => $param_val ) {
			$_SESSION [$param_name] = $param_val;
		}
	}
}

function getStates($selectedState) {
	$stateList = "";

    $StateArray['AL']  = 'Alabama';
    $StateArray['AK']  = 'Alaska';
    $StateArray['AZ']  = 'Arizona';
    $StateArray['AR']  = 'Arkansas';
    $StateArray['CA']  = 'California';
    $StateArray['CO']  = 'Colorado';
    $StateArray['CT']  = 'Connecticut';
    $StateArray['DE']  = 'Delaware';
    $StateArray['DC']  = 'District of Columbia';
    $StateArray['FL']  = 'Florida';
    $StateArray['GA']  = 'Georgia';
    $StateArray['HI']  = 'Hawaii';
    $StateArray['ID']  = 'Idaho';
    $StateArray['IL']  = 'Illinois';
    $StateArray['IN']  = 'Indiana';
    $StateArray['IA']  = 'Iowa';
    $StateArray['KS']  = 'Kansas';
    $StateArray['KY']  = 'Kentucky';
    $StateArray['LA']  = 'Louisiana';
    $StateArray['ME']  = 'Maine';
    $StateArray['MD']  = 'Maryland';
    $StateArray['MA']  = 'Massachusetts';
    $StateArray['MI']  = 'Michigan';
    $StateArray['MN']  = 'Minnesota';
    $StateArray['MS']  = 'Mississippi';
    $StateArray['MO']  = 'Missouri';
    $StateArray['MT']  = 'Montana';
    $StateArray['NE']  = 'Nebraska';
    $StateArray['NV']  = 'Nevada';
    $StateArray['NH']  = 'New Hampshire';
    $StateArray['NJ']  = 'New Jersey';
    $StateArray['NM']  = 'New Mexico';
    $StateArray['NY']  = 'New York';
    $StateArray['NC']  = 'North Carolina';
    $StateArray['ND']  = 'North Dakota';
    $StateArray['OH']  = 'Ohio';
    $StateArray['OK']  = 'Oklahoma';
    $StateArray['OR']  = 'Oregon';
    $StateArray['PA']  = 'Pennsylvania';
    $StateArray['RI']  = 'Rhode Island';
    $StateArray['SC']  = 'South Carolina';
    $StateArray['SD']  = 'South Dakota';
    $StateArray['TN']  = 'Tennessee';
    $StateArray['TX']  = 'Texas';
    $StateArray['UT']  = 'Utah';
    $StateArray['VT']  = 'Vermont';
    $StateArray['VA']  = 'Virginia';
    $StateArray['WA']  = 'Washington';
    $StateArray['WV']  = 'West Virginia';
    $StateArray['WI']  = 'Wisconsin';
    $StateArray['WY']  = 'Wyoming';
    $StateArray['AA']  = 'Armed Forces Americas';
    $StateArray['AE']  = 'Armed Forces Europe';
    $StateArray['AP']  = 'Armed Forces Pacific';
	
	//asort($StateArray);

	foreach ($StateArray  as $key => $value){
		$selected = '';
		if ($selectedState == $key)$selected = 'selected="selected"';
		$stateList .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
	}
	
	echo $stateList;
}
	
function getCountries($selectedCountry) {
	$countryList = "";

	$CountryArray['US']	= 'United States';
	$CountryArray['AF']	= 'Afghanistan';
	$CountryArray['AL']	= 'Albania';
    $CountryArray['DZ']	= 'Algeria';
    $CountryArray['AS']	= 'American Samoa';
	$CountryArray['AD']	= 'Andorra';
	$CountryArray['AO']	= 'Angola';
	$CountryArray['AI']	= 'Anguilla';
	$CountryArray['AQ']	= 'Antarctica';
	$CountryArray['AG']	= 'Antigua And Barbuda';
	$CountryArray['AR']	= 'Argentina';
	$CountryArray['AM']	= 'Armenia';
	$CountryArray['AW']	= 'Aruba';
	$CountryArray['AU']	= 'Australia';
	$CountryArray['AT']	= 'Austria';
	$CountryArray['AZ']	= 'Azerbaijan';
	$CountryArray['BS']	= 'Bahamas';
	$CountryArray['BH']	= 'Bahrain';
	$CountryArray['BD']	= 'Bangladesh';
	$CountryArray['BB']	= 'Barbados';
	$CountryArray['BY']	= 'Belarus';
	$CountryArray['BE']	= 'Belgium';
	$CountryArray['BZ']	= 'Belize';
	$CountryArray['BJ']	= 'Benin';
	$CountryArray['BM']	= 'Bermuda';
	$CountryArray['BT']	= 'Bhutan';
	$CountryArray['BO']	= 'Bolivia';
	$CountryArray['BA']	= 'Bosnia And Herzegovina';
	$CountryArray['BW']	= 'Botswana';
	$CountryArray['BV']	= 'Bouvet Island';
	$CountryArray['BR']	= 'Brazil';
	$CountryArray['BN']	= 'Brunei Darussalam';
	$CountryArray['BG']	= 'Bulgaria';
	$CountryArray['BF']	= 'Burkina Faso';
	$CountryArray['BI']	= 'Burundi';
	$CountryArray['KH']	= 'Cambodia';
	$CountryArray['CM']	= 'Cameroon';
	$CountryArray['CA']	= 'Canada';
	$CountryArray['CV']	= 'Cape Verde';
	$CountryArray['KY']	= 'Cayman Islands';
	$CountryArray['CF']	= 'Central African Republic';
	$CountryArray['TD']	= 'Chad';
	$CountryArray['CL']	= 'Chile';
	$CountryArray['CN']	= 'China';
	$CountryArray['CX']	= 'Christmas Island';
	$CountryArray['CC']	= 'Cocos (Keeling) Islands';
	$CountryArray['CO']	= 'Colombia';
	$CountryArray['KM']	= 'Comoros';
	$CountryArray['CG']	= 'Congo';
	$CountryArray['CK']	= 'Cook Islands';
	$CountryArray['CR']	= 'Costa Rica';
	$CountryArray['CI']	= 'Cote Divoire';
	$CountryArray['HR']	= 'Croatia';
	$CountryArray['CU']	= 'Cuba';
	$CountryArray['CY']	= 'Cyprus';
	$CountryArray['CZ']	= 'Czech Republic';
	$CountryArray['DK']	= 'Denmark';
	$CountryArray['DJ']	= 'Djibouti';
	$CountryArray['DM']	= 'Dominica';
	$CountryArray['DO']	= 'Dominican Republic';
	$CountryArray['EC']	= 'Ecuador';
	$CountryArray['EG']	= 'Egypt';
	$CountryArray['SV']	= 'El Salvador';
	$CountryArray['GQ']	= 'Equatorial Guinea';
	$CountryArray['ER']	= 'Eritrea';
	$CountryArray['EE']	= 'Estonia';
	$CountryArray['ET']	= 'Ethiopia';
	$CountryArray['FK']	= 'Falkland Islands';
	$CountryArray['FO']	= 'Faroe Islands';
	$CountryArray['FJ']	= 'Fiji';
	$CountryArray['FI']	= 'Finland';
	$CountryArray['FR']	= 'France';
	$CountryArray['GA']	= 'Gabon';
	$CountryArray['GM']	= 'Gambia';
	$CountryArray['GE']	= 'Georgia';
	$CountryArray['DE']	= 'Germany';
	$CountryArray['GH']	= 'Ghana';
	$CountryArray['GI']	= 'Gibraltar';
	$CountryArray['GR']	= 'Greece';
	$CountryArray['GL']	= 'Greenland';
	$CountryArray['GD']	= 'Grenada';
	$CountryArray['GP']	= 'Guadeloupe';
	$CountryArray['GU']	= 'Guam';
	$CountryArray['GT']	= 'Guatemala';
	$CountryArray['GG']	= 'Guernsey';
	$CountryArray['GN']	= 'Guinea';
	$CountryArray['GW']	= 'Guinea-Bissau';
	$CountryArray['GY']	= 'Guyana';
	$CountryArray['HT']	= 'Haiti';
	$CountryArray['HM']	= 'Heard Islands';
	$CountryArray['HN']	= 'Honduras';
	$CountryArray['HK']	= 'Hong Kong';
	$CountryArray['HU']	= 'Hungary';
	$CountryArray['IS']		= 'Iceland';
	$CountryArray['IN']	= 'India';
	$CountryArray['ID']	= 'Indonesia';
	$CountryArray['IR']	= 'Iran';
	$CountryArray['IQ']	= 'Iraq';
	$CountryArray['IE']	= 'Ireland';
	$CountryArray['IM']	= 'Isle Of Man';
	$CountryArray['IL']	= 'Israel';
	$CountryArray['IT']	= 'Italy';
	$CountryArray['JM']	= 'Jamaica';
	$CountryArray['JP']	= 'Japan';
	$CountryArray['JE']	= 'Jersey';
	$CountryArray['JO']	= 'Jordan';
	$CountryArray['KZ']	= 'Kazakhstan';
	$CountryArray['KE']	= 'Kenya';
	$CountryArray['KI']	= 'Kiribati';
	$CountryArray['KP']	= 'Korea, North';
	$CountryArray['KR']	= 'Korea, South';
	$CountryArray['KW']	= 'Kuwait';
	$CountryArray['KG']	= 'Kyrgyzstan';
    $CountryArray['LA']	= 'Lao';
	$CountryArray['LV']	= 'Latvia';
	$CountryArray['LB']	= 'Lebanon';
	$CountryArray['LS']	= 'Lesotho';
	$CountryArray['LR']	= 'Liberia';
	$CountryArray['LY']	= 'Libya';
	$CountryArray['LI']	= 'Liechtenstein';
	$CountryArray['LT']	= 'Lithuania';
	$CountryArray['LU']	= 'Luxembourg';
	$CountryArray['MO']	= 'Macao';
	$CountryArray['MK']	= 'Macedonia';
	$CountryArray['MG']	= 'Madagascar';
	$CountryArray['MW']	= 'Malawi';
	$CountryArray['MY']	= 'Malaysia';
	$CountryArray['MV']	= 'Maldives';
	$CountryArray['ML']	= 'Mali';
	$CountryArray['MT']	= 'Malta';
	$CountryArray['MH']	= 'Marshall Islands';
	$CountryArray['MQ']	= 'Martinique';
	$CountryArray['MR']	= 'Mauritania';
	$CountryArray['MU']	= 'Mauritius';
	$CountryArray['YT']	= 'Mayotte';
	$CountryArray['MX']	= 'Mexico';
	$CountryArray['FM']	= 'Micronesia';
	$CountryArray['MD']	= 'Moldova';
	$CountryArray['MC']	= 'Monaco';
	$CountryArray['MN']	= 'Mongolia';
	$CountryArray['ME']	= 'Montenegro';
	$CountryArray['MS']	= 'Montserrat';
	$CountryArray['MA']	= 'Morocco';
	$CountryArray['MZ']	= 'Mozambique';
	$CountryArray['MM']	= 'Myanmar';
	$CountryArray['NA']	= 'Namibia';
	$CountryArray['NR']	= 'Nauru';
	$CountryArray['NP']	= 'Nepal';
	$CountryArray['NL']	= 'Netherlands';
	$CountryArray['AN']	= 'Netherlands Antilles';
	$CountryArray['NC']	= 'New Caledonia';
	$CountryArray['NZ']	= 'New Zealand';
	$CountryArray['NI']	= 'Nicaragua';
	$CountryArray['NE']	= 'Niger';
	$CountryArray['NG']	= 'Nigeria';
	$CountryArray['NU']	= 'Niue';
	$CountryArray['NF']	= 'Norfolk Island';
	$CountryArray['NO']	= 'Norway';
	$CountryArray['OM']	= 'Oman';
	$CountryArray['PK']	= 'Pakistan';
	$CountryArray['PW']	= 'Palau';
	$CountryArray['PA']	= 'Panama';
	$CountryArray['PG']	= 'Papua New Guinea';
	$CountryArray['PY']	= 'Paraguay';
	$CountryArray['PE']	= 'Peru';
	$CountryArray['PH']	= 'Philippines';
	$CountryArray['PN']	= 'Pitcairn';
	$CountryArray['PL']	= 'Poland';
	$CountryArray['PT']	= 'Portugal';
	$CountryArray['PR']	= 'Puerto Rico';
	$CountryArray['QA']	= 'Qatar';
	$CountryArray['RE']	= 'Reunion';
	$CountryArray['RO']	= 'Romania';
	$CountryArray['RU']	= 'Russian Federation';
	$CountryArray['RW']	= 'Rwanda';
	$CountryArray['SH']	= 'Saint Helena';
	$CountryArray['KN']	= 'Saint Kitts';
	$CountryArray['LC']	= 'Saint Lucia';
	$CountryArray['MF']	= 'Saint Martin';
	$CountryArray['PM']	= 'Saint Pierre';
	$CountryArray['VC']	= 'Saint Vincent';
	$CountryArray['WS']	= 'Samoa';
	$CountryArray['SM']	= 'San Marino';
	$CountryArray['ST']	= 'Sao Tome And Principe';
	$CountryArray['SA']	= 'Saudi Arabia';
	$CountryArray['SN']	= 'Senegal';
	$CountryArray['RS']	= 'Serbia';
	$CountryArray['SC']	= 'Seychelles';
	$CountryArray['SL']	= 'Sierra Leone';
	$CountryArray['SG']	= 'Singapore';
	$CountryArray['SK']	= 'Slovakia';
	$CountryArray['SI']	= 'Slovenia';
	$CountryArray['SB']	= 'Solomon Islands';
	$CountryArray['SO']	= 'Somalia';
	$CountryArray['ZA']	= 'South Africa';
	$CountryArray['GS']	= 'South Georgia';
	$CountryArray['ES']	= 'Spain';
	$CountryArray['LK']	= 'Sri Lanka';
	$CountryArray['SD']	= 'Sudan';
	$CountryArray['SR']	= 'Suriname';
	$CountryArray['SJ']	= 'Svalbard';
	$CountryArray['SZ']	= 'Swaziland';
	$CountryArray['SE']	= 'Sweden';
	$CountryArray['CH']	= 'Switzerland';
	$CountryArray['SY']	= 'Syrian Arab Republic';
	$CountryArray['TW']	= 'Taiwan';
	$CountryArray['TJ']	= 'Tajikistan';
	$CountryArray['TZ']	= 'Tanzania';
	$CountryArray['TH']	= 'Thailand';
	$CountryArray['TG']	= 'Togo';
	$CountryArray['TK']	= 'Tokelau';
	$CountryArray['TO']	= 'Tonga';
	$CountryArray['TT']	= 'Trinidad And Tobago';
	$CountryArray['TN']	= 'Tunisia';
	$CountryArray['TR']	= 'Turkey';
	$CountryArray['TM']	= 'Turkmenistan';
	$CountryArray['TC']	= 'Turks And Caicos Islands';
	$CountryArray['TV']	= 'Tuvalu';
	$CountryArray['UG']	= 'Uganda';
	$CountryArray['UA']	= 'Ukraine';
	$CountryArray['AE']	= 'United Arab Emirates';
	$CountryArray['GB']	= 'United Kingdom';
	$CountryArray['UY']	= 'Uruguay';
	$CountryArray['UZ']	= 'Uzbekistan';
	$CountryArray['VU']	= 'Vanuatu';
	$CountryArray['VE']	= 'Venezuela';
	$CountryArray['VN']	= 'Viet Nam';
	$CountryArray['VI']	= 'Virgin Islands';
	$CountryArray['EH']	= 'Western Sahara';
	$CountryArray['YE']	= 'Yemen';
	$CountryArray['ZM']	= 'Zambia';
	$CountryArray['ZW']	= 'Zimbabwe';

	foreach ($CountryArray  as $key => $value){
		$selected = '';
		if ($selectedState == $key)$selected = 'selected="selected"';
		$CountryList .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
	}

	echo $CountryList;
}
