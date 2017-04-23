<?php
// API Setup parameters
$gatewayURL = 'https://secure.safesavegateway.com/api/v2/three-step';
$APIKey = '2F822Rw39fx762MaV7Yy86jXGTC7sCDy';
$ipAaddress = $_SERVER ["REMOTE_ADDR"];

function submitTransactionDetails($tokenId , $APIKey, $ipAaddress, $gatewayURL) {
	// Step Three: Once the browser has been redirected, we can obtain the token-id and complete
	// the transaction through another XML HTTPS POST including the token-id which abstracts the
	// sensitive payment information that was previously collected by the Payment Gateway.
	
	$xmlRequest = new DOMDocument ( '1.0', 'UTF-8' );
	$xmlRequest->formatOutput = true;
	$xmlCompleteTransaction = $xmlRequest->createElement ( 'complete-action' );
	appendXmlNode ( $xmlRequest, $xmlCompleteTransaction, 'api-key', $APIKey );
	appendXmlNode ( $xmlRequest, $xmlCompleteTransaction, 'token-id', $tokenId );
	$xmlRequest->appendChild ( $xmlCompleteTransaction );
	
	// Process Step Three
	$data = sendXMLviaCurl ( $xmlRequest, $gatewayURL );
	
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

function sendXMLviaCurl($xmlRequest,$gatewayURL) {
	// helper function demonstrating how to send the xml with curl


	$ch = curl_init(); // Initialize curl handle
	curl_setopt($ch, CURLOPT_URL, $gatewayURL); // Set POST URL

	$headers = array();
	$headers[] = "Content-type: text/xml";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Add http headers to let it know we're sending XML
	$xmlString = $xmlRequest->saveXML();
	curl_setopt($ch, CURLOPT_FAILONERROR, 1); // Fail on errors
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Allow redirects
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return into a variable
	curl_setopt($ch, CURLOPT_PORT, 443); // Set the port number
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Times out after 30s
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString); // Add XML directly in POST

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);


	// This should be unset in production use. With it on, it forces the ssl cert to be valid
	// before sending info.
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	if (!($data = curl_exec($ch))) {
		print  "curl error =>" .curl_error($ch) ."\n";
		throw New Exception(" CURL ERROR :" . curl_error($ch));

	}
	curl_close($ch);

	return $data;
}

// Helper function to make building xml dom easier
function appendXmlNode($domDocument, $parentNode, $name, $value) {
	$childNode      = $domDocument->createElement($name);
	$childNodeValue = $domDocument->createTextNode($value);
	$childNode->appendChild($childNodeValue);
	$parentNode->appendChild($childNode);
}


function setSessionData($data){
	foreach ($data as $param_name => $param_val) {
		$_SESSION[$param_name] = $param_val;
	}

}

function getStates(){
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

function log_dp($content){
	$file=fopen("DPLog.txt","a+") or exit("Unable to open file!");
	
	if ($content)
	{
		fwrite($file,print_r($content,true));
		fwrite($file,"\n");
	}
	
	fclose($file);
}