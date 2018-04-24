<?php
$environment	= "production"; // test or production

$dpConfig = [];

//Admin Email List
$emailList		= array('Casie Richardson' => 'Casie.Richardson@globallymealliance.org', 'Christine Llewellyn' => 'Christine.Llewellyn@globallymealliance.org', 'Gabriel Oliver' => 'goliver@mindtrustlabs.com');

//$emailList		= array('Sheni' => 'shenigodwin@gmail.com', 'Gabriel Oliver' => 'goliver@mindtrustlabs.com');

// Donor Email Bcc List
$donorEmailList	= array('Casie Richardson' => 'Casie.Richardson@globallymealliance.org', 'Christine Llewellyn' => 'Christine.Llewellyn@globallymealliance.org', 'Gabriel Oliver' => 'goliver@mindtrustlabs.com');

//$donorEmailList	= array('Godwin Ajit' => 'godwin.ajith@gmail.com', 'Sheni' => 'shenigodwin@gmail.com');

if ($environment == "test") {
	error_reporting(E_ERROR); ini_set('display_errors', 0);
	// DP API Key
	$dpAPIKey = '8qjqp2zU2%2fnCDsvvPQbuIVwJFf6WLqzLX5xyy1%2bZ3zSiAeqGsKSZR0aHzIgebJqXSs7GJx%2bp%2bQuKkRmu9717vylGLOVFVXwx7HzIIiAkY%2bYCO%2fnbfFhdnsuz0IvGqtZC';
	// Safe Save API Setup parameters
	$gatewayURL = 'https://secure.safesavegateway.com/api/v2/three-step';
	//The below URL is specific to DP Sandbox SafeSave
	//$gatewayURL = 'https://secure.nmi.com/api/v2/three-step/532h4c76';
	$APIKey = '2F822Rw39fx762MaV7Yy86jXGTC7sCDy';
	//Below API Key is specificc to SafeSave Sandbox associated with DP Sandbox
	$APIKey = 'cpJ78wsJ23FWTYkxAwMw8e33Tzfdhf6A';
	$dpConfig['code_id_memory'] = '661';
	$dpConfig['code_id_honor'] = '660';
	$dpConfig['sub_solicit_code'] = 'DONATION';
} elseif ($environment == "production") {
	error_reporting(E_ERROR); ini_set('display_errors', 0);
	// DP API Key
	$dpAPIKey = 'HFCBGrK8x8aiXpEu50tVH31W7akQaoPOiUtFpsHiXH%2fUKsFZQ4uX3L1gaDHsywRmHwzAsalBDEVpMDsIs56kM%2brGU%2b1SS%2fzQCZodcSq7c6hokQPh1VZPUBRXN9ULnmYp';
	// Safe Save API Setup parameters
	$gatewayURL = 'https://secure.safesavegateway.com/api/v2/three-step';
	$APIKey = 'H2T4fc3XKkWU243C2R6pj863P4ERS3mn';
	$dpConfig['code_id_memory'] = '481';
	$dpConfig['code_id_honor'] = '480';
	$dpConfig['sub_solicit_code'] = 'DON';	
}

$ipAaddress = $_SERVER ["REMOTE_ADDR"];

$donateWPPage = 4442;
$successWPPage = 4444;
