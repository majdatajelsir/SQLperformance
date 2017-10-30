<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "mysql";
//include('GUI.html');
// Create connection
$time_array =array();
$date_array =array();
$total_execution_time;
$avg_execution_time;
$conn = new mysqli($servername, $username, $password, $dbname);
$conn2 = new mysqli($servername, $username, $password, "slow_db");
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}



$sql = "SELECT start_time ,q_num, avg_exe_time, tot_exe_time FROM queries_summary ";
$result = $conn2->query($sql);
$sql2 = "SELECT start_time FROM user_query_log_temp ";
$result2= $conn->query($sql2);
$row = $result2->fetch_assoc();
$query_date = $row["start_time"];
//$current_date=getdate(timestamp);
$queryCreatesummaryTable = "CREATE TABLE IF NOT EXISTS queries_summary(
    start_time date ,
    q_num int(10),
    avg_exe_time time(6) ,
    tot_exe_time  time(6))";

$conn2->query($queryCreatesummaryTable);

if(!$conn2->query($queryCreatesummaryTable)){
    echo "Table creation failed: (" . $conn2->errno . ") " . $conn2->error;
}

$current_date=date('Y-m-d H:i:s:ms');
for($x= 1;$x<=2;$x++){

    $last_date= date("Y-m-d H:i:s:ms",strtotime("-$x day"));
    /*****************avg execution time*****************/
    $sql_avg="SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(`query_time`))) AS query_time FROM user_query_log_temp where start_time ='$query_date'";
    $result2 = mysqli_query($conn, $sql_avg);
    $avgRow = mysqli_fetch_assoc($result2);
    $avg = $avgRow['query_time'];


    /***********total execution time*****************************/
  $sql_sum="SELECT SEC_TO_TIME(Sum(TIME_TO_SEC(`query_time`))) AS query_time FROM user_query_log_temp where start_time ='$query_date'";
  $result3 = mysqli_query($conn, $sql_sum);
  $totalRow = mysqli_fetch_assoc($result3);
  $total = $totalRow['query_time'];

  $rowcount2=mysqli_num_rows($result3);
    mysqli_free_result($result3);

    $rowcount3=mysqli_num_rows($res2);
      mysqli_free_result($res2);
    $tot_row = $rowcount2 +   $rowcount3 ;

/$queryInsertQueryInfo = "INSERT INTO  queries_summary(start_time,q_num,avg_exe_time,tot_exe_time) VALUES ('$query_date','$tot_row','$avg','$total');";
  $conn2->query($queryInsertQueryInfo);

  if(!$conn2->query($queryInsertQueryInfo)){
      echo "Insertion Failed: (" . $conn2->errno . ") " . $conn2->error;
  }
$query_date ='2017-10-06';

}

<?php

$conn->close();
$conn2->close();
?>
