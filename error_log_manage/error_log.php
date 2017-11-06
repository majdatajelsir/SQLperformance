<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "slow_db";
$user_dbname ="";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$queryCreateErrorTable1 = "CREATE TABLE IF NOT EXISTS Error_log (
    error_date datetime,
    error_client text(150),
    error_msg  text(150))";

$conn->query($queryCreateErrorTable1);

if(!$conn->query($queryCreateErrorTable1)){
    echo "Table creation failed: (" . $conn->errno . ") " . $conn->error;
}
$myfile = fopen("/var/log/apache2/error.log", "r") or die("Unable to open file!");
$error_line = fgets($myfile);

$error_date = substr($error_line,0,19);
echo "$error_date";
$error_client = substr($error_line,55,69);
$error_msg  = substr($error_line,79,strlen($error_line));
$error_msg2 ;
$error_client2;
for($x=0;$x<strlen($error_msg);$x++){
  if($error_msg[$x] != "'"){
    $error_msg2.="$error_msg[$x]";
  }
}

for($x=0;$x<strlen($error_client);$x++){
  if($error_client[$x] != "'"){
    $error_client2.="$error_client[$x]";
  }
}
//$queryInsertErrorInfo = "INSERT INTO  Error_log(error_date,error_client,error_msg) VALUES ('$error_date','$error_client2','$error_msg2');";

/*if(!$conn->query($queryInsertErrorInfo)){
  echo "Insertion Failed: (" . $conn->errno . ") " . $conn->error;
}*/
while(!feof($myfile)) {
  $error_line = fgets($myfile);
  $error_date = substr($error_line,0,19);
  echo $error_date;
  $error_client = substr($error_line,55,69);
  $error_msg  = substr($error_line,79,strlen($error_line));
  for($x=0;$x<strlen($error_msg);$x++){
    if($error_msg[$x] != "'"){
      $error_msg2.="$error_msg[$x]";
    }
  }
/*  $result = $conn->query($sql);
if ($result->num_rows > 0){
  echo "data Exist";
}*/
//else{
  $queryInsertErrorInfo = "INSERT INTO  Error_log(error_date,error_client,error_msg) VALUES ('$error_date','$error_client2','$error_msg2');";

  if(!$conn->query($queryInsertErrorInfo)){
    echo "Insertion Failed: (" . $conn->errno . ") " . $conn->error;
  //}
}

}

/*
for($x = 0; $x <sizeof($fatal_array) ; $x++){
echo "$fatal_array[$x]";
}

for($x = 0; $x <sizeof($warning_array); $x++){
echo "$warning_array[$x]";
}

for($x = 0; $x <sizeof($parse_array) ; $x++){
echo "$parse_array[$x]";
}


fclose($myfile);

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

*/
$conn->close();
?>
