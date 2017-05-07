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
