<?php
$message = file_get_contents('php://input');
$string= "Examplestuffwhoop";
$txt = $message;
$test = fopen("newtest.py", "w") or die("Unable to open file!");

fwrite($test, $txt);
fclose($test);

$pyout = shell_exec('python newtest.py ' . $string);
echo $pyout;

?>