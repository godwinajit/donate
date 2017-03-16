<?php 
require_once 'safeSave/safeSaveLib.php';

if (empty($_POST['DO_STEP_1']) && empty($_GET['token-id'])) {

	// Initiate Step One: Now that we've collected the non-sensitive payment information, we can combine other order information and build the XML format.
	$xmlRequest = new DOMDocument('1.0','UTF-8');

	$xmlRequest->formatOutput = true;
	$xmlSale = $xmlRequest->createElement('sale');

	// Amount, authentication, and Redirect-URL are typically the bare minimum.
	appendXmlNode($xmlRequest, $xmlSale,'api-key',$APIKey);
	appendXmlNode($xmlRequest, $xmlSale,'redirect-url','http://localhost/globallyme.staging.wpengine.com/wp-content/themes/gla/app/safeSaveSingle.php');
	appendXmlNode($xmlRequest, $xmlSale, 'amount', '12.00');
	appendXmlNode($xmlRequest, $xmlSale, 'ip-address', $_SERVER["REMOTE_ADDR"]);
	//appendXmlNode($xmlRequest, $xmlSale, 'processor-id' , 'processor-a');
	appendXmlNode($xmlRequest, $xmlSale, 'currency', 'USD');

	// Some additonal fields may have been previously decided by user
	appendXmlNode($xmlRequest, $xmlSale, 'order-id', '1234');
	appendXmlNode($xmlRequest, $xmlSale, 'order-description', 'Small Order');
	appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-1' , 'ReduRedu');
	appendXmlNode($xmlRequest, $xmlSale, 'gabriel-own-field' , 'Gabriel Oliver');
	appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-2', 'Medium');
	appendXmlNode($xmlRequest, $xmlSale, 'tax-amount' , '0.00');

	/*if(!empty($_POST['customer-vault-id'])) {
	 appendXmlNode($xmlRequest, $xmlSale, 'customer-vault-id' , $_POST['customer-vault-id']);
	 }else {
	 $xmlAdd = $xmlRequest->createElement('add-customer');
	 appendXmlNode($xmlRequest, $xmlAdd, 'customer-vault-id' ,411);
	 $xmlSale->appendChild($xmlAdd);
	 }*/

	$_data['billing-address-first-name'] = 'Godwin Ajith';
	$_data['billing-address-last-name'] = 'Dhas P';
	$_data['billing-address-address1'] = 'Nagercoi';
	$_data['billing-address-city'] = 'Punnai Nagar';
	$_data['billing-address-state'] = 'Tamil Naddu';
	$_data['billing-address-zip'] = '629004';
	$_data['billing-address-country'] = 'India';
	$_data['billing-address-email'] = 'godsin.ajit@gmail.com';
	$_data['billing-address-phone'] = '6097879060';
	$_data['billing-address-company'] = 'MTL';
	$_data['billing-address-address2'] = 'Address 2';
	$_data['billing-address-fax'] = 'fax 2';

	// Set the Billing and Shipping from what was collected on initial shopping cart form
	$xmlBillingAddress = $xmlRequest->createElement('billing');
	appendXmlNode($xmlRequest, $xmlBillingAddress,'first-name', $_data['billing-address-first-name']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'last-name', $_data['billing-address-last-name']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'address1', $_data['billing-address-address1']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'city', $_data['billing-address-city']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'state', $_data['billing-address-state']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'postal', $_data['billing-address-zip']);
	//billing-address-email
	appendXmlNode($xmlRequest, $xmlBillingAddress,'country', $_data['billing-address-country']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'email', $_data['billing-address-email']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'phone', $_data['billing-address-phone']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'company', $_data['billing-address-company']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'address2', $_data['billing-address-address2']);
	appendXmlNode($xmlRequest, $xmlBillingAddress,'fax', $_data['billing-address-fax']);
	$xmlSale->appendChild($xmlBillingAddress);


	$xmlRequest->appendChild($xmlSale);

	// Process Step One: Submit all transaction details to the Payment Gateway except the customer's sensitive payment information.
	// The Payment Gateway will return a variable form-url.
	$data = sendXMLviaCurl($xmlRequest,$gatewayURL);

	// Parse Step One's XML response
	$gwResponse = @new SimpleXMLElement($data);
	if ((string)$gwResponse->result ==1 ) {
		// The form url for used in Step Two below
		$formURL = $gwResponse->{'form-url'};
	} else {
		throw New Exception(print " Error, received " . $data);
	}

	// Initiate Step Two: Create an HTML form that collects the customer's sensitive payment information
	// and use the form-url that the Payment Gateway returns as the submit action in that form.
	print '  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';


	print '

        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Collect sensitive Customer Info </title>
        </head>
        <body>';
	// Uncomment the line below if you would like to print Step One's response
	// print '<pre>' . (htmlentities($data)) . '</pre>';
	print '
        <p><h2>Step Two: Collect sensitive payment information and POST directly to payment gateway<br /></h2></p>

        <form action="'.$formURL. '" method="POST">
        <h3> Payment Information</h3>
            <table>
                <tr><td>Credit Card Number</td><td><INPUT type ="text" name="billing-cc-number" value="4111111111111111"> </td></tr>
                <tr><td>Expiration Date</td><td><INPUT type ="text" name="billing-cc-exp" value="1012"> </td></tr>
                <tr><td>CVV</td><td><INPUT type ="text" name="cvv" > </td></tr>
                <tr><Td colspan="2" align=center><INPUT type ="submit" value="Submit Step Two"></td> </tr>
            </table>
        </form>
		<script src="js/jquery-1.11.2.min.js"></script>
        </body>
        </html>
        ';

} elseif (!empty($_GET['token-id'])) {

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
