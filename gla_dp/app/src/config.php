<?php
$environment	= "test"; // test or production
$emailList		= '';

if ($environment == "test") {
	// DP API Key
	$dpAPIKey = '8qjqp2zU2%2fnCDsvvPQbuIVwJFf6WLqzLX5xyy1%2bZ3zSiAeqGsKSZR0aHzIgebJqXSs7GJx%2bp%2bQuKkRmu9717vylGLOVFVXwx7HzIIiAkY%2bYCO%2fnbfFhdnsuz0IvGqtZC';
	// Safe Save API Setup parameters
	$gatewayURL = 'https://secure.safesavegateway.com/api/v2/three-step';
	$APIKey = '2F822Rw39fx762MaV7Yy86jXGTC7sCDy';
} elseif ($environment == "production") {
	// DP API Key
	$dpAPIKey = '';
	// Safe Save API Setup parameters
	$gatewayURL = 'https://secure.safesavegateway.com/api/v2/three-step';
	$APIKey = '';
}

$ipAaddress = $_SERVER ["REMOTE_ADDR"];