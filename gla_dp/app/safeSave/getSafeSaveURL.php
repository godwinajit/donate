<?php

require_once 'safeSaveLib.php';

// Initiate Step One: Now that we've collected the non-sensitive payment information, we can combine other order information and build the XML format.
$xmlRequest = new DOMDocument('1.0','UTF-8');

$xmlRequest->formatOutput = true;
$xmlSale = $xmlRequest->createElement('sale');

// Amount, authentication, and Redirect-URL are typically the bare minimum.
appendXmlNode($xmlRequest, $xmlSale,'api-key',$APIKey);
appendXmlNode($xmlRequest, $xmlSale,'redirect-url',$_SERVER['HTTP_REFERER']);
appendXmlNode($xmlRequest, $xmlSale, 'amount', '12.00');
appendXmlNode($xmlRequest, $xmlSale, 'ip-address', $_SERVER["REMOTE_ADDR"]);
//appendXmlNode($xmlRequest, $xmlSale, 'processor-id' , 'processor-a');
appendXmlNode($xmlRequest, $xmlSale, 'currency', 'USD');

// Some additonal fields may have been previously decided by user
appendXmlNode($xmlRequest, $xmlSale, 'order-id', '1234');
appendXmlNode($xmlRequest, $xmlSale, 'order-description', 'Small Order');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-1' , 'Red');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-2', 'Medium');
appendXmlNode($xmlRequest, $xmlSale, 'tax-amount' , '0.00');

/*if(!empty($_POST['customer-vault-id'])) {
 appendXmlNode($xmlRequest, $xmlSale, 'customer-vault-id' , $_POST['customer-vault-id']);
 }else {
 $xmlAdd = $xmlRequest->createElement('add-customer');
 appendXmlNode($xmlRequest, $xmlAdd, 'customer-vault-id' ,411);
 $xmlSale->appendChild($xmlAdd);
 }*/


// Set the Billing and Shipping from what was collected on initial shopping cart form
$xmlBillingAddress = $xmlRequest->createElement('billing');
appendXmlNode($xmlRequest, $xmlBillingAddress,'first-name', $_POST['step2_first_name']);
appendXmlNode($xmlRequest, $xmlBillingAddress,'last-name', $_POST['step2_last_name']);
appendXmlNode($xmlRequest, $xmlBillingAddress,'address1', $_POST['step2_address_1']);
appendXmlNode($xmlRequest, $xmlBillingAddress,'city', $_POST['step2_city']);
appendXmlNode($xmlRequest, $xmlBillingAddress,'state', $_POST['step2_state']);
appendXmlNode($xmlRequest, $xmlBillingAddress,'postal', $_POST['step2_postal_code']);
//billing-address-email
appendXmlNode($xmlRequest, $xmlBillingAddress,'country', $_POST['step2_country']);
appendXmlNode($xmlRequest, $xmlBillingAddress,'phone', $_POST['step2_telephone']);
appendXmlNode($xmlRequest, $xmlBillingAddress,'company', $_POST['step2_company_name']);
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


echo $formURL;