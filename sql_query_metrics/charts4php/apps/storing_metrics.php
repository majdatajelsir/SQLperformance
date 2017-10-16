<?php
include "metrics_collector.php";
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

$ThatTime ="00:00:1.111111";
if (strtotime($exec_time)<= strtotime($ThatTime)) {

  $queryInsertQueryInfo = "INSERT INTO user_query_log_temp(start_time,query_time,lock_time) VALUES ('$start_time','$exec_time','$lock_time');";

$conn->query($queryInsertQueryInfo);

if(!$conn->query($queryInsertQueryInfo)){
    echo "Insertion Failed: (" . $conn->errno . ") " . $conn->error;
}
else{
echo"success";
}
}

    }
} else {
    echo "0 results";
}

$conn->close();
?>
