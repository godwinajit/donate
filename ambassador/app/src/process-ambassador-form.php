<?php
if (! ini_get ( 'display_errors' )) {
	ini_set ( 'display_errors', 0 );
}
// Report all PHP errors
error_reporting ( 0 );

include ('../../../wp-load.php');
require_once 'functions.php';
require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

// Wordpress Ambassador Form Backend Id
$form_id = 18;

// create a log channel
$log = new Logger ( 'Ambassador Log' );
$log->pushHandler ( new RotatingFileHandler ( '../logs/ambassador.log', 0, Logger::INFO ) );

$toEmail = '';
$bccEmailList = array (
		'Gabriel Oliver' => 'goliver@mindtrustlabs.com' 
);

if ($_SERVER ['SERVER_NAME'] === 'globallymealliance.org') {
	$toEmail = 'education@gla.org';
} else {
	$toEmail = 'goliver@mindtrustlabs.com';
}

$log->info ( "Submitting the Ambassador Form ...." );
$log->info ( "Ambassador Form Browser Information is: " . $_SERVER ['HTTP_USER_AGENT'] );
$log->info ( "Ambassador Form Connecting IP is: " . $_SERVER ['HTTP_CF_CONNECTING_IP'] );
$log->info ( "Ambassador Form Remote Address: " . $_SERVER ['REMOTE_ADDR'] );
$log->info ( "Ambassador Form request time: " . $_SERVER ['REQUEST_TIME'] );

if ($_SERVER ['REQUEST_METHOD'] === 'POST' && ! empty ( $_POST )) {
		
	if(count($_POST['language_1'])){
		$_POST['language_1'] = implode (", ", $_POST['language_1']);
	}else{
		$_POST['language_1'] = '';
	}

	try {
		$log->info ( "Ambassador Form POST information: " );
		$log->info ( print_r($_POST, true) );
	} catch ( Exception $e ) {
	}

	if (!$_POST['g-recaptcha-response'] || trim($_POST['g-recaptcha-response']) == ''){
		$log->info ( "Redirecting due to ivalid g-recaptcha-response ...." );
		redirect_to_url ( 'https://' . $_SERVER ['SERVER_NAME'] . '/ambassador/app/ambassador', true );
	}

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !filter_var($_POST['ref1_email'], FILTER_VALIDATE_EMAIL) || !filter_var($_POST['ref2_email'], FILTER_VALIDATE_EMAIL) || ( ( trim($_POST['ref3_email']) != '' ) && !filter_var($_POST['ref3_email'], FILTER_VALIDATE_EMAIL) ) ) {
		$log->info ( "Redirecting due to ivalid email ...." );
	  redirect_to_url ( 'https://' . $_SERVER ['SERVER_NAME'] . '/ambassador/app/ambassador', true );
	}

	if( isset($_POST['email']) && $_POST['email'] != '' && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		try {
			$messageBody = buildUserMessageBodyFromPost ( $_POST );
			$userMail = SimpleMail::make ()->setTo ( $_POST['email'], $_POST['first_name'] )->setFrom ( 'education@GLA.org', 'Global Lyme Alliance' )->setSubject ( 'Lyme Education Ambassador Submission' )->setMessage ( $messageBody )->setReplyTo ( 'education@GLA.org', 'Global Lyme Alliance' )->setBcc ( $bccEmailList )->setHtml ()->setWrap ( 100 );
			$userEmailSend = $userMail->send ();
		
			$log->info ( "Ambassador Form User Email Sent Status is: " . $userEmailSend );
		
		} catch ( Exception $e ) {
			$log->info ( "Ambassador Form User Email submission failed: " );
			$log->info ( $e );
		}
	}
	
	try {
		$messageBody = buildAdminMessageBodyFromPost ( $_POST );
		$adminMail = SimpleMail::make ()->setTo ( $toEmail, 'Global Lyme Alliance' )->setFrom ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setSubject ( 'New Ambassador Submission' )->setMessage ( $messageBody )->setReplyTo ( 'info@globallymealliance.org', 'Global Lyme Alliance' )->setBcc ( $bccEmailList )->setHtml ()->setWrap ( 100 );
		$send = $adminMail->send ();

		// Manually create entries with Gravity Forms
		$entry_id = insertEntryIntoWordpress ( $form_id, $_POST );
		// Create Donor in DP
		submit_form_to_dp( $_POST );
		
		$log->info ( "Ambassador Form  Admin Email Sent Status is: " . $send );
		
		if ($send) {
			redirect_to_url ( 'https://' . $_SERVER ['SERVER_NAME'] . '/ambassador/app/thankyou.php', true );
		} else {
			redirect_to_url ( 'https://' . $_SERVER ['SERVER_NAME'] . '/ambassador/app/failed.php', true );
		}
	} catch ( Exception $e ) {
		$log->info ( "Ambassador Form Admin Email submission failed: " );
		$log->info ( $e );
	}

} else {
	redirect_to_url ( 'https://' . $_SERVER ['SERVER_NAME'] . '/ambassador/app/ambassador', true );
}
