<?php
//Getting all info
$message = file_get_contents('php://input');
$txt = json_decode($message, true);
$studentID = $txt['studentID'];
//$studentID = 1;
$answer = $txt['answer'];
//$answer = 'ef';
$examID = $txt['examID'];
//$createExamID = 8;
$questionID = $txt['questionID'];
//$questionID = 2;
$pointsWorth = $txt['pointsWorth'];
$grade = $txt['grade'];
$constraints = $txt['constraints'];
$run1 = "";
$run2 = "";
$run3 = "";
$run4 = "";
$run5 = "";
$pointsLost1 = 0;
$pointsLost2 = 0;
$pointsLost3 = 0;
$pointsLost4 = 0;
$pointsLost5 = 0;
$pointsLost6 = 0;
$pointsLost7 = 0;
$check1 = 0;
$check2 = 0;
$check3 = 0;
$check4 = 0;
$check5 = 0;
$check6 = 0;
$check7 = 0;
//Start at max and subtract down
$grade = $pointsWorth;

//Test Cases
$testcaser = $txt['testCaseResult1'];
$testc1 = $txt['testCase1'];
$testcaser2 = $txt['testCaseResult2'];
$testc2 = $txt['testCase2'];
$testcaser3 = $txt['testCaseResult3'];
$testc3 = $txt['testCase3'];
$testcaser4 = $txt['testCaseResult4'];
$testc4 = $txt['testCase4'];
$testcaser5 = $txt['testCaseResult5'];
$testc5 = $txt['testCase5'];
$comm = $txt['comment'];
$comment =$txt['comment'];
//Question Searching through
$funName = $txt['question'];

//Check if any of them are empty
$tc1 = true;
$tc2 = true;
$tc3 = true;
$tc4 = true;
$tc5 = true;
$ploss=5;
if(empty($testc1)){
$tc1 = false;
$ploss-=1;
}
if(empty($testc2)){
$tc2 = false;
$ploss-=1;
}
if(empty($testc3)){
$tc3 = false;
$ploss-=1;
}
if(empty($testc4)){
$tc4 = false;
$ploss-=1;
}
if(empty($testc5)){
$tc5 = false;
$ploss-=1;
}
//Check if there are multi args
$multi = '(,)';
$search = $testc1;
preg_match_all($multi, $search, $mul);
if($mul[0][0]== ',' || $mul[0][0][0] == ','){
$arg2 = true;
}
if($mul[0][1][0] == ','){
$arg3 = true;
}

//$funName = 'def my_function()';
$reg = '/def[ ]*[a-zA-Z][ ]*[a-zA-Z_\d]*[ ]*/';
preg_match_all($reg, $funName, $match);

//var_dump($match);
$anName = $txt['answer'];
//$anName = 'def my_function()';
$reg2 = '/def[ ]*[a-zA-Z][ ]*[a-zA-Z_\d]*[ ]*/';
preg_match_all($reg2, $anName, $match2);
//$anName = 'what the fuck';

//THIS IS WHERE THE FUNCTION NAME IS CHECKED!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//var_dump($match2);
$bloop = preg_replace('/\s+/', ' ', $match[0][0]);
$bloop2 = preg_replace('/\s+/', ' ', $match2[0][0]);
if($bloop==$bloop2){
//$comm = $comm."Function name fine";
$check6 = 1;
$funFlag = true;
//print_r('whoop');
}else{
//$comm = $comm."Function name is wrong";
$check6 = 2;
$grade -= 2;
$pointsLost6 = 2;
//print_r('not whoop');
}
$reg3 = '/[^?!(def) ][a-zA-Z][ ]*[a-zA-Z_\d]*[ ]*/';
preg_match_all($reg3, $match2[0][0], $match3);


$newC = "none";
$con = '/:[\s\S]*$/';
preg_match_all($con, $anName, $match5);
//Check for constraint in the answer!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if($constraints == 'For-loop'){
$newC = '/(for)/';
if(stripos($match5[0][0], 'for') !== false){
$check7 = 1;
}else{
$check7 = 2;
$pointsLost7 = 2;
$grade = $grade - $pointsLost7;
}
}

if($constraints == 'While-loop'){
$newC = '/(while)/';
if(stripos($match5[0][0], 'while') !== false){
$check7 = 1;
}else{
$check7 = 2;
$pointsLost7 = 2;
$grade = $grade - $pointsLost7;
}
}


if($constraints == 'Recursion'){
if(stripos($match5[0][0], $match3[0][0]) !== false){
$check7 = 1;
}else{
$check7 = 2;
$pointsLost7 = 2;
$grade = $grade - $pointsLost7;
}
}

$test = fopen("newtest.py", "w") or die("Unable to open file!");
//$funny = "#!/usr/bin/env python\n"."import sys\n".$txt['answer']."\n"."\n"."name = \"".$testc1."\";"."\n".$match3[0][0].'('.'name'.')'.";";
$funny = "#!/usr/bin/env python\n"."import sys\n".$txt['answer']."\n";
if($constraints == 'Recursion'){
$funny = $funny."print(";
}
$funny = $funny.$match3[0][0].'('.'sys.argv[1]';//.')'.";";
if(!empty($arg2)){
$funny = $funny.', sys.argv[2]';
}
if(!empty($arg3)){
$funny = $funny.', sys.argv[3]';
}
$funny = $funny.')';
if($constraints == 'Recursion'){
$funny = $funny.")";
}
$funny = $funny.';';

//."\n".$match[0][0]."\n".$match2[0][0]
//."\n"."\n".$studentID."\n".$examID."\n".$questionID."\n".$what."\n".$what2."\n".$comment."\n".$pointsWorth."\n".$grade."\n".$testcaser."\n".$testc1
fwrite($test, $funny);
fclose($test);
//TC1
if($arg2== true){
$tests = explode(',', $testc1);

//TC2
$tests2 = explode(',', $testc2);

//TC3
$tests3 = explode(',', $testc3);

//TC4
$tests4 = explode(',', $testc4);

//TC5
$tests5 = explode(',', $testc5);
}
//Flags for tests cases if any were wrong
$tcflag1 = true;
$tcflag2 = true;
$tcflag3 = true;
$tcflag4 = true;
$tcflag5 = true;



//TestCase1
$command = 'python newtest.py ';
if($arg2 == true && $arg3 == false){
$command = $command.$tests[0].' ';
$command = $command.$tests[1];
}else if($arg2 == true && $arg3 == true){
$command = $command.$tests[0].' ';
$command = $command.$tests[1].' ';
$command = $command.$tests[2];
}else{
$command = $command.$testc1;
}
//$pyout = shell_exec('python newtest.py '.$tests[0].' '.$tests[1].' '.$tests[2]);
$pyout = shell_exec($command);
//Fix weird random space
$pyout = str_replace(array("\n", "\r"), '', $pyout);
//Save output to run
$run1 = $pyout;
//print_r($pyout);
$whatishappen = $pyout;
if(strcmp($pyout, $testcaser)){
$comm = $comm."\nTest Case 1 Failed";
$tcflag1 = false;
$pointsLost1 = ($pointsWorth/$ploss);
$grade = $grade - $pointsLost1;
$check1 = 2;
}else{
$comm = $comm."\nTest Case 1 Success";
$check1 = 1;
}



if($tc2==true){
//TestCase2
$command = 'python newtest.py ';
if($arg2 == true && $arg3 == false){
$command = $command.$tests2[0].' ';
$command = $command.$tests2[1];
}else if($arg2 == true && $arg3 == true){
$command = $command.$tests2[0].' ';
$command = $command.$tests2[1].' ';
$command = $command.$tests2[2];
}else{
$command = $command.$testc2;
}
//$pyout = shell_exec('python newtest.py '.$tests[0].' '.$tests[1].' '.$tests[2]);
$pyout = shell_exec($command);
//Fix weird random space
$pyout = str_replace(array("\n", "\r"), '', $pyout);
//print_r($pyout);
//Save output to run
$run2 = $pyout;
if(strcmp($pyout, $testcaser2)){
$comm = $comm."\nTest Case 2 Failed";
$tcflag2 = false;
$pointsLost2 = ($pointsWorth/$ploss);
$grade = $grade - $pointsLost2;
$check2 = 2;
}else{
$comm = $comm."\nTest Case 2 Success";
$check2 = 1;
}
}


if($tc3==true){
//TestCase3
$command = 'python newtest.py ';
if($arg2 == true && $arg3 == false){
$command = $command.$tests3[0].' ';
$command = $command.$tests3[1];
}else if($arg2 == true && $arg3 == true){
$command = $command.$tests3[0].' ';
$command = $command.$tests3[1].' ';
$command = $command.$tests3[2];
}else{
$command = $command.$testc3;
}
//$pyout = shell_exec('python newtest.py '.$tests[0].' '.$tests[1].' '.$tests[2]);
$pyout = shell_exec($command);
//Fix weird random space
$pyout = str_replace(array("\n", "\r"), '', $pyout);
//print_r($pyout);
//Save output to run
$run3 = $pyout;
if(strcmp($pyout, $testcaser3)){
$comm = $comm."\nTest Case 3 Failed";
$tcflag3 = false;
$pointsLost3 = ($pointsWorth/$ploss);
$grade = $grade - $pointsLost3;
$check3 = 2;
}else{
$comm = $comm."\nTest Case 3 Success";
$check3 = 1;
}
}


if($tc4==true){
//TestCase4
$command = 'python newtest.py ';
if($arg2 == true && $arg3 == false){
$command = $command.$tests4[0].' ';
$command = $command.$tests4[1];
}else if($arg2 == true && $arg3 == true){
$command = $command.$tests4[0].' ';
$command = $command.$tests4[1].' ';
$command = $command.$tests4[2];
}else{
$command = $command.$testc4;
}
//$pyout = shell_exec('python newtest.py '.$tests[0].' '.$tests[1].' '.$tests[2]);
$pyout = shell_exec($command);
//Fix weird random space
$pyout = str_replace(array("\n", "\r"), '', $pyout);
//print_r($pyout);
//Save output to run
$run4 = $pyout;
if(strcmp($pyout, $testcaser4)){
$comm = $comm."\nTest Case 4 Failed";
$tcflag1 = false;
$pointsLost4 = ($pointsWorth/$ploss);
$grade = $grade - $pointsLost4;
$check4 = 2;
}else{
$comm = $comm."\nTest Case 4 Success";
$check4 = 1;
}
}



if($tc5==true){
//TestCase5
$command = 'python newtest.py ';
if($arg2 == true && $arg3 == false){
$command = $command.$tests5[0].' ';
$command = $command.$tests5[1];
}else if($arg2 == true && $arg3 == true){
$command = $command.$tests5[0].' ';
$command = $command.$tests5[1].' ';
$command = $command.$tests5[2];
}else{
$command = $command.$testc5;
}
//$pyout = shell_exec('python newtest.py '.$tests[0].' '.$tests[1].' '.$tests[2]);
$pyout = shell_exec($command);
//Fix weird random space
$pyout = str_replace(array("\n", "\r"), '', $pyout);
//print_r($pyout);
//Save output to run
$run5 = $pyout;
if(strcmp($pyout, $testcaser5)){
$comm = $comm."\nTest Case 5 Failed";
$tcflag5 = false;
$pointsLost5 = ($pointsWorth/$ploss);
$grade = $grade - $pointsLost5;
$check5 = 2;
}else{
$comm = $comm."\nTest Case 5 Success";
$check5 = 1;
}
}

//$test = fopen("newtest2.py", "w") or die("Unable to open file!");
//$funny = "import sys\n".$txt['answer']."\n"."\n".$studentID."\n".$examID."\n".$questionID.$comment."\n".$pointsWorth."\n".$grade."\n".$testcaser."\n".$testc1."\n".$pyout."\n".$comm."\n".$constraints.$check1.$check2.$check3.$check4.$check5.$check6.$check7.$bloop;
//fwrite($test, $funny);
//fclose($test);


$url="https://afsaccess4.njit.edu/~sm2686/CS490/answerExamGrader.php";


$data = array("grade" => $grade,
//              "comment" => $comm,
              "comment"=> $comment,
              "answer" => $answer,
              "createExamID" => $examID,
              "questionID" => $questionID,
              "studentID" => $studentID,
              "run1" => $run1,
              "run2" => $run2,
              "run3" => $run3,
              "run4" => $run4,
              "run5" => $run5,
              "pointsLost1" => $pointsLost1,
              "pointsLost2" => $pointsLost2,
              "pointsLost3" => $pointsLost3,
              "pointsLost4" => $pointsLost4,
              "pointsLost5" => $pointsLost5,
              "pointsLost6" => $pointsLost6,
              "pointsLost7" => $pointsLost7,
              "check1" => $check1,
              "check2" => $check2,
              "check3" => $check3,
              "check4" => $check4,
              "check5" => $check5,
              "check6" => $check6,
              "check7" => $check7,
            );

$ch = curl_init( $url );

#Setup request to send json via POST.
$payload = json_encode($data);

curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );

curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$eResult = curl_exec($ch);
curl_close($ch);

//Result and decision on where to go
//$result = json_decode($eResult, true);
//print_r($result);






$url="https://afsaccess4.njit.edu/~sm2686/CS490/getFinalGrade.php";

//echo "Visited";

$data = array(
            "studentID" => $studentID,
            "examID" => $examID,
            );

//$questionID = $data['createQuestion'];
//$examID = $data['createTopic'];
//$pointsWorth = $data['createCat'];

$ch = curl_init( $url );

#Setup request to send json via POST.
$payload = json_encode($data);

curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$eResult = curl_exec($ch);
curl_close($ch);

//Result and decision on where to go
$result = json_decode($eResult, true);


$totalPoints = (int)$result;
$totalPoints += $grade;


$url="https://afsaccess4.njit.edu/~sm2686/CS490/setFinalGrade.php";

//echo "Visited";

$data = array(            
            "studentID" => $studentID,
            "examID" => $examID,
            "finalGrade" => $totalPoints,
            );

//$questionID = $data['createQuestion'];
//$examID = $data['createTopic'];
//$pointsWorth = $data['createCat'];

$ch = curl_init( $url );

#Setup request to send json via POST.
$payload = json_encode($data);

curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
# Send request.
$eResult = curl_exec($ch);
curl_close($ch);

//Result and decision on where to go
$result = json_decode($eResult, true);

?>

