<?php
$con = '/:[\s\S]*$/';
$constraints = 'Recursion';
$check7= 0;
$grade = 10;
$pointsLost7 = 0;
$bloop = 'test';
$test = 'ajdklsjfakjsdlfkjakjdslkj:12345whiletest';
preg_match_all($con, $test, $match4);


if($constraints == 'For'){
$newC = '/(for)/';
if(stripos($match4[0][0], 'for') !== false){
$check7 = 1;
}else{
$check7 = 2;
$pointsLost7 = 2;
$grade = $grade - $pointsLost7;
}
}

if($constraints == 'While'){
$newC = '/(while)/';
if(stripos($match4[0][0], 'while') !== false){
$check7 = 1;
}else{
$check7 = 2;
$pointsLost7 = 2;
$grade = $grade - $pointsLost7;
}
}


if($constraints == 'Recursion'){

if(stripos($match4[0][0], $bloop) !== false){
$check7 = 1;
}else{
$check7 = 2;
$pointsLost7 = 2;
$grade = $grade - $pointsLost7;
}
}

print_r($match4[0][0]);
print_r($grade);
print_r($constraints);
print_r($pointsLost7);
print_r($check7);

?>