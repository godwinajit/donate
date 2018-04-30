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
	
	$StateArray['AB']	= 'Alberta';
	$StateArray['BC']	= 'British Columbia';
	$StateArray['MB']	= 'Manitoba';
	$StateArray['NB']	= 'New Brunswick';
	$StateArray['NL']	= 'Newfoundland & Labrador';
	$StateArray['NT']	= 'Northwest Territories';
	$StateArray['NS']	= 'Nova Scotia';
	$StateArray['NU']	= 'Nunavut';
	$StateArray['ON']	= 'Ontario';
	$StateArray['PE']	= 'Prince Edward Island';
	$StateArray['QC']	= 'Quebec';
	$StateArray['SK']	= 'Saskatchewan';
	$StateArray['YT']	= 'Yukon';
	$StateArray['AL']	= 'Alabama';
	$StateArray['AK']	= 'Alaska';
	$StateArray['AZ']	= 'Arizona';
	$StateArray['AR']	= 'Arkansas';
	$StateArray['AA']	= 'Armed Forces America';
	$StateArray['AE']	= 'Armed Forces Other';
	$StateArray['AP']	= 'Armed Forces Pacific';
	$StateArray['CA']	= 'California';
	$StateArray['CO']	= 'Colorado';
	$StateArray['CT']	= 'Connecticut';
	$StateArray['DE']	= 'Delaware';
	$StateArray['FL']	= 'Florida';
	$StateArray['GA']	= 'Georgia';
	$StateArray['HI']	= 'Hawaii';
	$StateArray['ID']	= 'Idaho';
	$StateArray['IL']	= 'Illinois';
	$StateArray['IN']	= 'Indiana';
	$StateArray['IA']	= 'Iowa';
	$StateArray['KS']	= 'Kansas';
	$StateArray['KY']	= 'Kentucky';
	$StateArray['LA']	= 'Louisiana';
	$StateArray['ME']	= 'Maine';
	$StateArray['MD']	= 'Maryland';
	$StateArray['MA']	= 'Massachusetts';
	$StateArray['MI']	= 'Michigan';
	$StateArray['MN']	= 'Minnesota';
	$StateArray['MS']	= 'Mississippi';
	$StateArray['MO']	= 'Missouri';
	$StateArray['MT']	= 'Montana';
	$StateArray['NE']	= 'Nebraska';
	$StateArray['NV']	= 'Nevada';
	$StateArray['NH']	= 'New Hampshire';
	$StateArray['NJ']	= 'New Jersey';
	$StateArray['NM']	= 'New Mexico';
	$StateArray['NY']	= 'New York';
	$StateArray['NC']	= 'North Carolina';
	$StateArray['ND']	= 'North Dakota';
	$StateArray['OH']	= 'Ohio';
	$StateArray['OK']	= 'Oklahoma';
	$StateArray['OR']	= 'Ohio';
	$StateArray['PA']	= 'Pennsylvania';
	$StateArray['PR']	= 'Puerto Rico';
	$StateArray['RI']	= 'Rhode Island';
	$StateArray['SC']	= 'South Carolina';
	$StateArray['SD']	= 'South Dakota';
	$StateArray['TN']	= 'Tennessee';
	$StateArray['TX']	= 'Texas';
	$StateArray['UT']	= 'Utah';
	$StateArray['VT']	= 'Vermont';
	$StateArray['VA']	= 'Virginia';
	$StateArray['WA']	= 'Washington';
	$StateArray['DC']	= 'Washington DC';
	$StateArray['WV']	= 'West Virginia';
	$StateArray['WI']	= 'Wisconsin';
	$StateArray['WY']	= 'Wyoming';
	
	asort($StateArray);

	foreach ($StateArray  as $key => $value){
		$selected = '';
		if ($selectedState == $key)$selected = 'selected="selected"';
		$stateList .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
	}
	
	echo $stateList;
}

/* function getStates() {
	echo '<option value="AB|Alberta">Alberta</option>
				<option value="BC|British Columbia">British Columbia</option>
				<option value="MB|Manitoba">Manitoba</option>
				<option value="NB|New Brunswick">New Brunswick</option>
				<option value="NL|Newfoundland &amp; Labrador">Newfoundland &amp; Labrador</option>
				<option value="NT|Northwest Territories">Northwest Territories</option>
				<option value="NS|Nova Scotia">Nova Scotia</option>
				<option value="NU|Nunavut">Nunavut</option>
				<option value="ON|Ontario">Ontario</option>
				<option value="PE|Prince Edward Island">Prince Edward Island</option>
				<option value="QC|Quebec">Quebec</option>
				<option value="SK|Saskatchewan">Saskatchewan</option>
				<option value="YT|Yukon">Yukon</option>
				<option value="AL|Alabama">Alabama</option>
				<option value="AK|Alaska">Alaska</option>
				<option value="AZ|Arizona">Arizona</option>
				<option value="AR|Arkansas">Arkansas</option>
				<option value="AA|Armed Forces Americas">Armed Forces Americas</option>
				<option value="AE|Armed Forces Other">Armed Forces Other</option>
				<option value="AP|Armed Forces Pacific">Armed Forces Pacific</option>
				<option value="CA|California">California</option>
				<option value="CO|Colorado">Colorado</option>
				<option value="CT|Connecticut">Connecticut</option>
				<option value="DE|Delaware">Delaware</option>
				<option value="FL|Florida">Florida</option>
				<option value="GA|Georgia">Georgia</option>
				<option value="HI|Hawaii">Hawaii</option>
				<option value="ID|Idaho">Idaho</option>
				<option value="IL|Illinois">Illinois</option>
				<option value="IN|Indiana">Indiana</option>
				<option value="IA|Iowa">Iowa</option>
				<option value="KS|Kansas">Kansas</option>
				<option value="KY|Kentucky">Kentucky</option>
				<option value="LA|Louisiana">Louisiana</option>
				<option value="ME|Maine">Maine</option>
				<option value="MD|Maryland">Maryland</option>
				<option value="MA|Massachusetts">Massachusetts</option>
				<option value="MI|Michigan">Michigan</option>
				<option value="MN|Minnesota">Minnesota</option>
				<option value="MS|Mississippi">Mississippi</option>
				<option value="MO|Missouri">Missouri</option>
				<option value="MT|Montana">Montana</option>
				<option value="NE|Nebraska">Nebraska</option>
				<option value="NV|Nevada">Nevada</option>
				<option value="NH|New Hampshire">New Hampshire</option>
				<option value="NJ|New Jersey">New Jersey</option>
				<option value="NM|New Mexico">New Mexico</option>
				<option value="NY|New York">New York</option>
				<option value="NC|North Carolina">North Carolina</option>
				<option value="ND|North Dakota">North Dakota</option>
				<option value="OH|Ohio">Ohio</option>
				<option value="OK|Oklahoma">Oklahoma</option>
				<option value="OR|Oregon">Oregon</option>
				<option value="PA|Pennsylvania">Pennsylvania</option>
				<option value="PR|Puerto Rico">Puerto Rico</option>
				<option value="RI|Rhode Island">Rhode Island</option>
				<option value="SC|South Carolina">South Carolina</option>
				<option value="SD|South Dakota">South Dakota</option>
				<option value="TN|Tennessee">Tennessee</option>
				<option value="TX|Texas">Texas</option>
				<option value="UT|Utah">Utah</option>
				<option value="VT|Vermont">Vermont</option>
				<option value="VA|Virginia">Virginia</option>
				<option value="WA|Washington">Washington</option>
				<option value="DC|Washington DC">Washington DC</option>
				<option value="WV|West Virginia">West Virginia</option>
				<option value="WI|Wisconsin">Wisconsin</option>
				<option value="WY|Wyoming">Wyoming</option>';
}

	$StateArray['Alberta']					= 'Alberta';
	$StateArray['British Columbia']			= 'British Columbia';
	$StateArray['Manitoba']					= 'Manitoba';
	$StateArray['New Brunswick']			= 'New Brunswick';
	$StateArray['Newfoundland & Labrador']	= 'Newfoundland & Labrador';
	$StateArray['Northwest Territories']	= 'Northwest Territories';
	$StateArray['Nova Scotia']				= 'Nova Scotia';
	$StateArray['Nunavut']					= 'Nunavut';
	$StateArray['Ontario']					= 'Ontario';
	$StateArray['Prince Edward Island']		= 'Prince Edward Island';
	$StateArray['Quebec']					= 'Quebec';
	$StateArray['Saskatchewan']				= 'Saskatchewan';
	$StateArray['Yukon']					= 'Yukon';
	$StateArray['Alabama']					= 'Alabama';
	$StateArray['Alaska']					= 'Alaska';
	$StateArray['Arizona']					= 'Arizona';
	$StateArray['Arkansas']					= 'Arkansas';
	$StateArray['Armed Forces America']		= 'Armed Forces America';
	$StateArray['Armed Forces Other']		= 'Armed Forces Other';
	$StateArray['Armed Forces Pacific']		= 'Armed Forces Pacific';
	$StateArray['California']				= 'California';
	$StateArray['Colorado']					= 'Colorado';
	$StateArray['Connecticut']				= 'Connecticut';
	$StateArray['Delaware']					= 'Delaware';
	$StateArray['Florida']					= 'Florida';
	$StateArray['Georgia']					= 'Georgia';
	$StateArray['Hawaii']					= 'Hawaii';
	$StateArray['Idaho']					= 'Idaho';
	$StateArray['Illinois']					= 'Illinois';
	$StateArray['Indiana']					= 'Indiana';
	$StateArray['Iowa']						= 'Iowa';
	$StateArray['Kansas']					= 'Kansas';
	$StateArray['Kentucky']					= 'Kentucky';
	$StateArray['Louisiana']				= 'Louisiana';
	$StateArray['Maine']					= 'Maine';
	$StateArray['Maryland']					= 'Maryland';
	$StateArray['Massachusetts']			= 'Massachusetts';
	$StateArray['Michigan']					= 'Michigan';
	$StateArray['Minnesota']				= 'Minnesota';
	$StateArray['Mississippi']				= 'Mississippi';
	$StateArray['Missouri']					= 'Missouri';
	$StateArray['Montana']					= 'Montana';
	$StateArray['Nebraska']					= 'Nebraska';
	$StateArray['Nevada']					= 'Nevada';
	$StateArray['New Hampshire']			= 'New Hampshire';
	$StateArray['New Jersey']				= 'New Jersey';
	$StateArray['New Mexico']				= 'New Mexico';
	$StateArray['New York']					= 'New York';
	$StateArray['North Carolina']			= 'North Carolina';
	$StateArray['North Dakota']				= 'North Dakota';
	$StateArray['Ohio']						= 'Ohio';
	$StateArray['Oklahoma']					= 'Oklahoma';
	$StateArray['Oregon']					= 'Ohio';
	$StateArray['Pennsylvania']				= 'Pennsylvania';
	$StateArray['Puerto Rico']				= 'Puerto Rico';
	$StateArray['Rhode Island']				= 'Rhode Island';
	$StateArray['South Carolina']			= 'South Carolina';
	$StateArray['South Dakota']				= 'South Dakota';
	$StateArray['Tennessee']				= 'Tennessee';
	$StateArray['Texas']					= 'Texas';
	$StateArray['Utah']						= 'Utah';
	$StateArray['Vermont']					= 'Vermont';
	$StateArray['Virginia']					= 'Virginia';
	$StateArray['Washington']				= 'Washington';
	$StateArray['Washington DC']			= 'Washington DC';
	$StateArray['West Virginia']			= 'West Virginia';
	$StateArray['Wisconsin']				= 'Wisconsin';
	$StateArray['Wyoming']					= 'Wyoming';
 */
	
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
