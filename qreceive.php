<?php
//Brandon Lam
//Recieve Question
$message = file_get_contents('php://input');
$url = "https://afsaccess4.njit.edu/~sm2686/CS490/questionBank.php";
//Start Curl

$ch = curl_init( $url );
//OPTS
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-TypeLapplication/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Store and close
$result = curl_exec($ch);
curl_close($ch);
//$tester = json_decode($result, true);
//echo "TEST\n";
//echo "\necho----------------------------\n";
//Return
print_r($result);
?>