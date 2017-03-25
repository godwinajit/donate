<?php
require_once 'safeSaveLib.php';

// Set all the post data in the session for future use

setSessionData($_POST);


//$results = print_r($b, true); // $results now contains output from print_r


file_put_contents('filename.txt', print_r($_SESSION, true));
/* echo '<pre>';
print_r($_SESSION);
exit; */