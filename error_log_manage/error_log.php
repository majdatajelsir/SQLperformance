<?php
$myfile = fopen("/var/log/apache2/error.log.1", "r") or die("Unable to open file!");
$error_types = array("Warning", "Parse", "Fatal");
$fatal_array= array();
$warning_array = array();
$parse_array=array();

while(!feof($myfile)) {
//  echo fgets($myfile) . "<br>";
  $error_line = fgets($myfile);
//  echo "$error_line";
          if (strpos( $error_line, "Fatal" ) !== false ){
            array_push($fatal_array,$error_line);

          }

          if (strpos( $error_line, "Warning" ) !== false ){
            array_push($warning_array,$error_line);

          }

          if (strpos( $error_line, "Parse" ) !== false ){
            array_push($parse_array,$error_line);

          }
}

echo "/*******************/";
for($x = 0; $x <sizeof($fatal_array) ; $x++){
echo "$fatal_array[$x]";
}
echo "/*******************/";
for($x = 0; $x <sizeof($warning_array); $x++){
echo "$warning_array[$x]";
}
echo "/*******************/";
for($x = 0; $x <sizeof($parse_array) ; $x++){
echo "$parse_array[$x]";
}


fclose($myfile);
/***************************Get Error Rate**************************/
$number_of_fatal_error = sizeof($fatal_array);
$number_of_warning_error = sizeof($warning_array);
$number_of_parse_error = sizeof($parse_array);
$tottal_error = $number_of_fatal_error + $number_of_warning_error + $number_of_parse_error ;
$fatal_rate = $number_of_warning_error/$tottal_error*100;
$warning_rate = $number_of_fatal_error/$tottal_error*100;
$parse_rate = $number_of_parse_error/$tottal_error*100;

echo "$fatal_rate". "<br>";
echo "$warning_rate". "<br>";
echo "$parse_rate". "<br>";




$to = 'majdaeltaj@gmail.com';

$subject = ' php code test';

$message = 'sending error to email';

$from = 'majdaeltaj_1994@hotmail.com';



mail("$to, $subject, $message");

if(mail($to, $subject, $message)){

    echo 'Your mail has been sent successfully.';

} else{

    echo 'Unable to send email. Please try again.';

}


?>
