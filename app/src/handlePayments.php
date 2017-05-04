<?php
if(!isset($_SESSION)){session_start();}
require __DIR__ . '/vendor/autoload.php';
require_once 'config.php';
require_once 'safeSave.php';
require_once 'donorPerfect.php';

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

// create a log channel
$log = new Logger('Donor Log');
$log->pushHandler(new RotatingFileHandler('logs/donate.log', 0, Logger::INFO));

$isPaymentStep = false;
$isPaymentSsuccess = false;
$transactionDetails = "";
$transactionStatus = "";
$alertCSS = "";

$log->info("Initializing the donation");

$message = ' <div>
  Dear Go Oliver,

  <p>
  Thank you very much for your donation.  It is through the generosity of people like you that we are able to continue our work.  Your support truly makes a difference!! 
  </p>
   <p>
	Your contribution is tax-deductible to the extent allowed by law. No goods or services were received for this donation. Global Lyme Alliance, Inc. is a tax exempt charitable organization under Section 501(c)3 of the Internal Revenue Service Code. Our tax ID number is 06-1559393. Please save or print this receipt for your records.  
  </p>

  <h2>Donor Information</h2>
  <table>
  <tr>
	<td>Donor First Name</td>
	<td>Godwin Ajit</td>
  </tr>
  <tr>
	<td>Donor Last Name</td>
	<td>Paul thanga</td>
  </tr>
  <tr>
	<td>Company Name</td>
	<td>COmpany name</td>
  </tr>
  <tr>
	<td>Donor Address</td>
	<td>300 Messacust anvena</td>
  </tr>
    <tr>
	<td>Address 2</td>
	<td>300 Messacust anvena</td>
  </tr>
   </tr>
  <tr>
	<td>City</td>
	<td>300 Messacust anvena</td>
  </tr>
  <tr>
	<td>Donor State/Province</td>
	<td>300 Messacust anvena</td>
  </tr>
  <tr>
	<td>Donor Zip/Postal Code</td>
	<td>300 Messacust anvena</td>
  </tr>
  <tr>
	<td>Home Phone</td>
	<td>300 Messacust anvena</td>
  </tr>
  <tr>
	<td>Cell Phone</td>
	<td>300 Messacust anvena</td>
  </tr>
  <tr>
	<td>Work Phone</td>
	<td>300 Messacust anvena</td>
  </tr>
  <tr>
	<td>Donor Email</td>
	<td>300 Messacust anvena</td>
  </tr>
  </table>

  <h2>Items selected for Godwin Ajit</h2>
  <table>
  <tr>
	<td>One Time Donation</td>
	<td>50$</td>
  </tr>
  </table>

  <h2>Details for Godwin Ajit</h2>
  <table>
  <tr>
	<td>Item</td>
	<td>Make a Donation</td>
  </tr>
  <tr>
	<td>Amount</td>
	<td>50$</td>
  </tr>
  <tr>
	<td>Type of Donation</td>
	<td>One Time Donation</td>
  </tr>
  </table>

  <h2>Tribute Details</h2>
  <table>
  <tr>
	<td>Type of Tribute</td>
	<td>In Memory Of</td>
  </tr>
  <tr>
	<td>Does your company has a matching gift program?</td>
	<td>Yes</td>
  </tr>
  <tr>
	<td>Tribute/Honoree First Name</td>
	<td>first anme</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Last Name</td>
	<td>last name</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Address</td>
	<td>address</td>
  </tr>
  <tr>
	<td>Tribute/Honoree City</td>
	<td>CIty</td>
  </tr>
  <tr>
	<td>Tribute/Honoree State/Province</td>
	<td>State</td>
  </tr>
  <tr>
	<td>Tribute/Honoree Zip/Postal Code</td>
	<td>1234</td>
  </tr>
  </table>
</div>';

$donateMail = SimpleMail::make()
    ->setTo($emailList, 'Goliver Godli')
    ->setFrom('info@globallymealliance.org', 'Global Lyme Alliance')
    ->setSubject('Thank you from Global Lyme Alliance')
    ->setMessage($message)
    ->setReplyTo($replyEmail, $replyName)
  //  ->setCc(['Bill Gates' => 'bill@example.com'])
    ->setBcc(['Godwin Ajit' => 'godwin.ajith@gmail.com'])
    ->setHtml()
    ->setWrap(100);
$send = $donateMail->send();
    
echo ($send) ? $log->info('Email sent successfully') : $log->info('Could not send email');
	
if (! empty ( $_GET ['token-id'] )) {
	$tokenId =  $_GET ['token-id'];
	$isPaymentStep = true;
	$safeSave = new SafeSave($gatewayURL, $APIKey);
	$donorPerfect = new DonorPerfect($dpAPIKey, $log, $emailList);
	
	$transactionDetails = $safeSave->submitTransactionDetails ( $tokenId, $ipAaddress );

	$log->info("Submitted the payment details");
	$log->info("Transaction result is ".print_r($transactionDetails, true));

	if ( ($transactionDetails->{'result'} == 1) && ($transactionDetails->{'result-text'} == 'SUCCESS') ){
		$log->info("Saving details to Doner Perfect");
		$donorDetails = $donorPerfect->saveDonorDetails($transactionDetails);
		$transactionStatus = $transactionDetails->{'result-text'};
		header("Location: success.php"); /* Redirect browser */
		exit();
	}else{
		$transactionStatus = $transactionDetails->{'result-text'};
		$transactionDetails = "Transaction failed";
		$alertCSS = "alert-fail";
	}
}/* else{
	session_destroy();
} */


function retriveDonorField($transactionStatus, $fieldName ){
	if ( (isset($_SESSION[$fieldName])) && ($transactionStatus) && ($transactionStatus != 'SUCCESS'))
	{
		return $_SESSION[$fieldName];
	}else return '';
}