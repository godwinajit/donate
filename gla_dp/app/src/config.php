<?php
$environment	= "test"; // test or production
$emailList		= 'goliver@mindtrustlabs.com';

if ($environment == "test") {
	// DP API Key
	$dpAPIKey = '8qjqp2zU2%2fnCDsvvPQbuIVwJFf6WLqzLX5xyy1%2bZ3zSiAeqGsKSZR0aHzIgebJqXSs7GJx%2bp%2bQuKkRmu9717vylGLOVFVXwx7HzIIiAkY%2bYCO%2fnbfFhdnsuz0IvGqtZC';
	// Safe Save API Setup parameters
	$gatewayURL = 'https://secure.safesavegateway.com/api/v2/three-step';
	$APIKey = '2F822Rw39fx762MaV7Yy86jXGTC7sCDy';
} elseif ($environment == "production") {
	// DP API Key
	$dpAPIKey = 'HFCBGrK8x8aiXpEu50tVH31W7akQaoPOiUtFpsHiXH%2fUKsFZQ4uX3L1gaDHsywRmHwzAsalBDEVpMDsIs56kM%2brGU%2b1SS%2fzQCZodcSq7c6hokQPh1VZPUBRXN9ULnmYp';
	// Safe Save API Setup parameters
	$gatewayURL = 'https://secure.safesavegateway.com/api/v2/three-step';
	$APIKey = 'H2T4fc3XKkWU243C2R6pj863P4ERS3mn';
}

$ipAaddress = $_SERVER ["REMOTE_ADDR"];

$donateWPPage = 4442;
$successWPPage = 4444;