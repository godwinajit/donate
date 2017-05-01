<?php
require_once 'config.php';
require_once 'safeSave.php';

$safeSave = new SafeSave($gatewayURL, $APIKey);

// Initiate Step One: Now that we've collected the non-sensitive payment information, we can combine other order information and build the XML format.
$xmlRequest = new DOMDocument('1.0','UTF-8');

$xmlRequest->formatOutput = true;
$xmlSale = $xmlRequest->createElement('sale');

// Amount, authentication, and Redirect-URL are typically the bare minimum.
$safeSave->appendXmlNode($xmlRequest, $xmlSale,'api-key',$APIKey);
$safeSave->appendXmlNode($xmlRequest, $xmlSale,'redirect-url',strtok($_SERVER["HTTP_REFERER"],'?'));
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'ip-address', $ipAaddress);

$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'amount', isset($_POST['donate']) ? $_POST['donate'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'billing-method', 'billing-method');
//$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'processor-id' , 'processor-a');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'currency', 'USD');

// Some additonal fields may have been previously decided by user
//$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'order-id', '1234');
//$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'order-description', 'Small Order');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-1' ,  isset($_POST['merchant-defined-field-1']) ? $_POST['merchant-defined-field-1'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-2' ,  isset($_POST['merchant-defined-field-2']) ? $_POST['merchant-defined-field-2'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-3' ,  isset($_POST['merchant-defined-field-3']) ? $_POST['merchant-defined-field-3'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-4' ,  isset($_POST['merchant-defined-field-4']) ? $_POST['merchant-defined-field-4'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-5' ,  isset($_POST['merchant-defined-field-5']) ? $_POST['merchant-defined-field-5'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-6' ,  isset($_POST['merchant-defined-field-6']) ? $_POST['merchant-defined-field-6'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-7' ,  isset($_POST['merchant-defined-field-7']) ? $_POST['merchant-defined-field-7'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-8' ,  isset($_POST['merchant-defined-field-8']) ? $_POST['merchant-defined-field-8'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-9' ,  isset($_POST['merchant-defined-field-9']) ? $_POST['merchant-defined-field-9'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-10' ,  isset($_POST['merchant-defined-field-10']) ? $_POST['merchant-defined-field-10'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-11' ,  isset($_POST['address2']) ? $_POST['address2'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-12' ,  isset($_POST['merchant-defined-field-12']) ? $_POST['merchant-defined-field-12'] : '');

$safeSave->appendXmlNode($xmlRequest, $xmlSale,'merchant-defined-field-14', isset($_POST['address1']) ? $_POST['address1'] : '');
//$safeSave->appendXmlNode($xmlRequest, $xmlSale,'address2', $_POST['address2']);
$safeSave->appendXmlNode($xmlRequest, $xmlSale,'merchant-defined-field-15', isset($_POST['city']) ? $_POST['city'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale,'merchant-defined-field-16', isset($_POST['state']) ? $_POST['state'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale,'merchant-defined-field-17', isset($_POST['postal']) ? $_POST['postal'] : '');
//billing-address-email
$safeSave->appendXmlNode($xmlRequest, $xmlSale,'merchant-defined-field-13', isset($_POST['country']) ? $_POST['country'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlSale,'merchant-defined-field-18', isset($_POST['phone']) ? $_POST['phone'] : '');
//$safeSave->appendXmlNode($xmlRequest, $xmlSale, 'tax-amount' , '0.00');

if(!empty($_POST['customer-vault-id'])) {
 $safeSave->appendXmlNode($xmlRequest, $xmlSale, 'customer-vault-id' , $_POST['customer-vault-id']);
 }else {
 $xmlAdd = $xmlRequest->createElement('add-customer');
 $safeSave->appendXmlNode($xmlRequest, $xmlAdd, 'customer-vault-id' ,'');
 $xmlSale->appendChild($xmlAdd);
 }


// Set the Billing and Shipping from what was collected on initial shopping cart form
$xmlBillingAddress = $xmlRequest->createElement('billing');
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'email', isset($_POST['email']) ? $_POST['email'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'first-name', isset($_POST['billing-first-name']) ? $_POST['billing-first-name'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'last-name', isset($_POST['billing-last-name']) ? $_POST['billing-last-name'] : '');
/* $safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'billing-cc-number', $_POST['billing-cc-number']);
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'billing-cc-exp', $_POST['billing-cc-exp']);
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'billing-cvv', $_POST['billing-cvv']);
 */
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'address1', isset($_POST['billing-address1']) ? $_POST['billing-address1'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'country', isset($_POST['billing-country']) ? $_POST['billing-country'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'city', isset($_POST['billing-city']) ? $_POST['billing-city'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'state', isset($_POST['billing-state']) ? $_POST['billing-state'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'postal', isset($_POST['billing-postal']) ? $_POST['billing-postal'] : '');
$safeSave->appendXmlNode($xmlRequest, $xmlBillingAddress,'company', isset($_POST['company']) ? $_POST['company'] : '');

$xmlSale->appendChild($xmlBillingAddress);


$xmlRequest->appendChild($xmlSale);

// Process Step One: Submit all transaction details to the Payment Gateway except the customer's sensitive payment information.
// The Payment Gateway will return a variable form-url.
$data = $safeSave->sendXMLviaCurl($xmlRequest,$gatewayURL);

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