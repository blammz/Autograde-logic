<?php
//Brandon Lam
//Individual Contributions: I was the middle guy so I didn't have too much to do, I just helped find
//resources for the curl and such.
$message = 'Bloop';
$url = "https://afsaccess4.njit.edu/~bl38/CS490/multitouch.php";
//Start Curl

$ch = curl_init( $url );
//OPTS
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-TypeLapplication/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Store and close
$result = curl_exec($ch);
print($result);
$message = 'Numba 2';
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-TypeLapplication/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
//$tester = json_decode($result, true);
//echo "TEST\n";
//echo "\necho----------------------------\n";
//Return
print($result);
print("\n");
?>