<?php
require_once 'config.php';
require_once 'safeSave.php';
require_once 'donorPerfect.php';

$isPaymentStep = false;
$isPaymentSsuccess = false;
$transactionDetails = "";
$transactionStatus = "";
$alertCSS = "";

log_dp("Initializing the donation");
	
if (! empty ( $_GET ['token-id'] )) {
	$tokenId =  $_GET ['token-id'];
	$isPaymentStep = true;
	$safeSave = new SafeSave($gatewayURL, $APIKey);
	$donorPerfect = new DonorPerfect($dpAPIKey);
	
	$transactionDetails = $safeSave->submitTransactionDetails ( $tokenId, $ipAaddress );

	log_dp("saving details to Doner Perfect");
	log_dp("Transaction result is ".$transactionDetails->{'result'});
	log_dp("Transaction result is ".$transactionDetails->{'result-text'});

	if ( ($transactionDetails->{'result'} == 1) && ($transactionDetails->{'result-text'} == 'SUCCESS') ){
		log_dp("saving details to Doner Perfect");
		log_dp($transactionDetails);
		$donorDetails = $donorPerfect->saveDonorDetails($transactionDetails);
		log_dp("saving donor details");
		//log_dp("New Donor Id is ".$donorDetails[0]);
		$transactionStatus = $transactionDetails->{'result-text'};
		header("Location: success.php?amount=".$transactionDetails->{'amount'}); /* Redirect browser */
		exit();
	}else{
		$transactionStatus = 'FAILED';
		$transactionDetails = "Transaction failed";
		$alertCSS = "alert-fail";
	}
}