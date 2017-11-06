<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "mysql";
$user_dbname ="";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query="SET @@GLOBAL.long_query_time =0;";
$conn->query($query);


$sql = "SELECT start_time, query_time, lock_time ,sql_text FROM slow_log WHERE db='slow_db' AND (sql_text like '%INSERT INTO%' OR sql_text like '%DELETE%' OR sql_text like 'UPDATE%' OR sql_text like '%SELECT * FROM%')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

$queryCreateUsersTable1 = "CREATE TABLE IF NOT EXISTS user_slow_log (
    start_time time(6) ,
    query_time  time(6),
    lock_time time(6) ,
    sql_text  text(150))";

$conn->query($queryCreateUsersTable1);

if(!$conn->query($queryCreateUsersTable1)){
    echo "Table creation failed: (" . $conn->errno . ") " . $conn->error;
}


$queryCreateUsersTable2 = "CREATE TABLE IF NOT EXISTS user_query_log_temp (
    start_time time(6) ,
    query_time  time(6),
    lock_time time(6) ,
    sql_text  text(150))";

$conn->query($queryCreateUsersTable2);

if(!$conn->query($queryCreateUsersTable2)){
    echo "Table creation failed: (" . $conn->errno . ") " . $conn->error;
}
$exec_time = $row["query_time"];
$start_time = $row["start_time"];
$lock_time = $row["lock_time"];
$sql_text = $row["sql_text"];
$sql_text2="";
for($x=0;$x<strlen($sql_text);$x++){
  if($sql_text[$x] != "'"){
    $sql_text2.="$sql_text[$x]";
  }
}
echo"$sql_text2";
$exec_time="00:00:1.0001";
$userTime ="00:00:1.0000";
if (strtotime($exec_time)<strtotime($userTime)) {


  $queryInsertQueryInfo = "INSERT INTO  user_query_log_temp(start_time,query_time,lock_time,sql_text) VALUES ('$start_time','$exec_time','$lock_time');";

$conn->query($queryInsertQueryInfo);

if(!$conn->query($queryInsertQueryInfo)){
    echo "Insertion Failed: (" . $conn->errno . ") " . $conn->error;
}

}
else{
  $queryInsertQueryInfo = "INSERT INTO  user_slow_log(start_time,query_time,lock_time,sql_text) VALUES ('$start_time','$exec_time','$lock_time','$sql_text2');";

$conn->query($queryInsertQueryInfo);

if(!$conn->query($queryInsertQueryInfo)){
    echo "Insertion Failed: (" . $conn->errno . ") " . $conn->error;
}
}

    }

} else {
    echo "0 results";
}

$conn->close();


?>
