<?php

require_once 'safeSaveLib.php';

// Initiate Step One: Now that we've collected the non-sensitive payment information, we can combine other order information and build the XML format.
$xmlRequest = new DOMDocument('1.0','UTF-8');

$xmlRequest->formatOutput = true;
$xmlSale = $xmlRequest->createElement('sale');

// Amount, authentication, and Redirect-URL are typically the bare minimum.
appendXmlNode($xmlRequest, $xmlSale,'api-key',$APIKey);
appendXmlNode($xmlRequest, $xmlSale,'redirect-url',$_SERVER ['HTTP_REFERER']);
appendXmlNode($xmlRequest, $xmlSale, 'ip-address', $ipAaddress);

appendXmlNode($xmlRequest, $xmlSale, 'amount', isset($_POST['donate']) ? $_POST['donate'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'billing-method', 'billing-method');
//appendXmlNode($xmlRequest, $xmlSale, 'processor-id' , 'processor-a');
appendXmlNode($xmlRequest, $xmlSale, 'currency', 'USD');

// Some additonal fields may have been previously decided by user
//appendXmlNode($xmlRequest, $xmlSale, 'order-id', '1234');
//appendXmlNode($xmlRequest, $xmlSale, 'order-description', 'Small Order');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-1' ,  isset($_POST['merchant-defined-field-1']) ? $_POST['merchant-defined-field-1'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-2' ,  isset($_POST['merchant-defined-field-2']) ? $_POST['merchant-defined-field-2'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-3' ,  isset($_POST['merchant-defined-field-3']) ? $_POST['merchant-defined-field-3'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-4' ,  isset($_POST['merchant-defined-field-4']) ? $_POST['merchant-defined-field-4'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-5' ,  isset($_POST['merchant-defined-field-5']) ? $_POST['merchant-defined-field-5'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-6' ,  isset($_POST['merchant-defined-field-6']) ? $_POST['merchant-defined-field-6'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-7' ,  isset($_POST['merchant-defined-field-7']) ? $_POST['merchant-defined-field-7'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-8' ,  isset($_POST['merchant-defined-field-8']) ? $_POST['merchant-defined-field-8'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-9' ,  isset($_POST['merchant-defined-field-9']) ? $_POST['merchant-defined-field-9'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-10' ,  isset($_POST['merchant-defined-field-10']) ? $_POST['merchant-defined-field-10'] : '');
appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-11' ,  isset($_POST['address2']) ? $_POST['address2'] : '');

appendXmlNode($xmlRequest, $xmlSale,'descriptor-address', isset($_POST['address1']) ? $_POST['address1'] : '');
//appendXmlNode($xmlRequest, $xmlSale,'address2', $_POST['address2']);
appendXmlNode($xmlRequest, $xmlSale,'descriptor-city', isset($_POST['city']) ? $_POST['city'] : '');
appendXmlNode($xmlRequest, $xmlSale,'descriptor-state', isset($_POST['state']) ? $_POST['state'] : '');
appendXmlNode($xmlRequest, $xmlSale,'descriptor-postal', isset($_POST['postal']) ? $_POST['postal'] : '');
//billing-address-email
appendXmlNode($xmlRequest, $xmlSale,'descriptor-country', isset($_POST['country']) ? $_POST['country'] : '');
appendXmlNode($xmlRequest, $xmlSale,'descriptor-phone', isset($_POST['phone']) ? $_POST['phone'] : '');
//appendXmlNode($xmlRequest, $xmlSale, 'tax-amount' , '0.00');

/*if(!empty($_POST['customer-vault-id'])) {
 appendXmlNode($xmlRequest, $xmlSale, 'customer-vault-id' , $_POST['customer-vault-id']);
 }else {
 $xmlAdd = $xmlRequest->createElement('add-customer');
 appendXmlNode($xmlRequest, $xmlAdd, 'customer-vault-id' ,411);
 $xmlSale->appendChild($xmlAdd);
 }*/


// Set the Billing and Shipping from what was collected on initial shopping cart form
$xmlBillingAddress = $xmlRequest->createElement('billing');
appendXmlNode($xmlRequest, $xmlBillingAddress,'email', isset($_POST['email']) ? $_POST['email'] : '');
appendXmlNode($xmlRequest, $xmlBillingAddress,'first-name', isset($_POST['billing-first-name']) ? $_POST['billing-first-name'] : '');
appendXmlNode($xmlRequest, $xmlBillingAddress,'last-name', isset($_POST['billing-last-name']) ? $_POST['billing-last-name'] : '');
/* appendXmlNode($xmlRequest, $xmlBillingAddress,'billing-cc-number', $_POST['billing-cc-number']);
appendXmlNode($xmlRequest, $xmlBillingAddress,'billing-cc-exp', $_POST['billing-cc-exp']);
appendXmlNode($xmlRequest, $xmlBillingAddress,'billing-cvv', $_POST['billing-cvv']);
 */
appendXmlNode($xmlRequest, $xmlBillingAddress,'address1', isset($_POST['billing-address1']) ? $_POST['billing-address1'] : '');
appendXmlNode($xmlRequest, $xmlBillingAddress,'country', isset($_POST['billing-country']) ? $_POST['billing-country'] : '');
appendXmlNode($xmlRequest, $xmlBillingAddress,'city', isset($_POST['billing-city']) ? $_POST['billing-city'] : '');
appendXmlNode($xmlRequest, $xmlBillingAddress,'state', isset($_POST['billing-state']) ? $_POST['billing-state'] : '');
appendXmlNode($xmlRequest, $xmlBillingAddress,'postal', isset($_POST['billing-postal']) ? $_POST['billing-postal'] : '');
appendXmlNode($xmlRequest, $xmlBillingAddress,'company', isset($_POST['company']) ? $_POST['company'] : '');

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
	$formURL = 'FAILED';
	throw New Exception(print " Error, received " . $data);
}


echo $formURL;