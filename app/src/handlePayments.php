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
$log->info ( "Donor Browser Information is: ". $_SERVER['HTTP_USER_AGENT'] );
$log->info ( "Donor Connecting IP is: ". $_SERVER['HTTP_CF_CONNECTING_IP'] );
$log->info ( "Donor Remote Address: ". $_SERVER['REMOTE_ADDR'] );
$log->info ( "Donor request time: ". $_SERVER['REQUEST_TIME'] );
	
if (! empty ( $_GET ['token-id'] )) {
	$tokenId =  $_GET ['token-id'];
	$isPaymentStep = true;
	$safeSave = new SafeSave($gatewayURL, $APIKey);
	$donorPerfect = new DonorPerfect($dpAPIKey, $log, $emailList, $donorEmailList, $dpConfig);
	
	$transactionDetails = $safeSave->submitTransactionDetails ( $tokenId, $ipAaddress );

	$log->info("Submitted the payment details");
	$log->info("Transaction result is ".print_r($transactionDetails, true));
	$log->info("The user input values are ".print_r($_SESSION, true));

	if ( $transactionDetails->{'result'} == 1 ){
		$transactionDetails->{'result-text'} = 'SUCCESS';
		$log->info("Saving details to Doner Perfect ...");
		$donorDetails = $donorPerfect->saveDonorDetails($transactionDetails, $_SESSION);
		$transactionStatus = $transactionDetails->{'result-text'};
		$transactionID = (string) $transactionDetails->{'transaction-id'};
		$_SESSION['transactionid'] = $transactionID;
		header("Location: success.php"); /* Redirect browser */
		exit();
	}else{
		$transactionStatus = $transactionDetails->{'result-text'};
		$transactionDetails = "Transaction failed";
		$alertCSS = "alert-fail";
		$donorPerfect->handleFailedDonorDetails($transactionStatus, $_SESSION);
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

function gla_ucwords($string) {
	return str_replace("' ","'",ucwords(str_replace("'","' ",$string)));
	//return preg_replace("/\w[\w']*/e", "ucwords('\\0')", $string);
}

function gla_get_card_type($cardNumber) {
    
    $cardFirstChar = mb_substr($cardNumber, 0, 1, "UTF-8");
    $cardType = '';
    
    //Visa Starts with 4 - VISA
    //MasterCard Starts with 5 - MASTERCARD
    //Amex (American Express) Starts with 3 - AMEX
    //Discover Starts with 6  -   DISCOVER
    if($cardFirstChar == '4'){
        $cardType = 'VISA';
    }elseif($cardFirstChar == '5'){
        $cardType = 'MASTERCARD';
    }elseif($cardFirstChar == '3'){
        $cardType = 'AMEX';
    }elseif($cardFirstChar == '6'){
        $cardType = 'DISCOVER';
    }
    
    return $cardType;
}
