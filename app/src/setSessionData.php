<?php
// Set all the post data in the session for future use
if(!isset($_SESSION)){session_start();}
setSessionData($_POST);


function setSessionData($post){
	foreach ($_POST as $key => $value){
		$_SESSION[$key] = $value;
	}
	
	$_SESSION['billing-cc-number'] = "";
	$_SESSION['billing-cc-exp']  = "";
	$_SESSION['billing-cvv']  = "";
}

//file_put_contents('filename.txt', print_r($_SESSION, true));