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

$result = $conn2->query($sql);
$sql2 = "SELECT start_time FROM user_slow_log ";
$result2= $conn->query($sql2);
$row = $result2->fetch_assoc();
$query_date = $row["start_time"];
//$current_date=getdate(timestamp);
$queryCreatesummaryTable = "CREATE TABLE IF NOT EXISTS slow_queries_summary(
    start_time date ,
    q_num int(10),
    avg_exe_time time(6) ,
    tot_exe_time  time(6))";

$conn2->query($queryCreatesummaryTable);

if(!$conn2->query($queryCreatesummaryTable)){
    echo "Table creation failed: (" . $conn2->errno . ") " . $conn2->error;
}

$current_date=date('Y-m-d');
$startTimeStamp = strtotime("2011-07-02");
$endTimeStamp = strtotime("2011-07-17");
$dateDiff = abs(strtotime($current_date) - strtotime($query_date));
$numberDays = $dateDiff/86400;  // 86400 seconds in one day
$numberDays = intval($numberDays);
for($x= 1;$x<=$numberDays;$x++){
    $last_date= date("Y-m-d",strtotime("-$x day"));
    /*****************avg execution time*****************/
    $sql_avg="SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(`query_time`))) AS query_time FROM user_slow_log where start_time ='$last_dat'";
    $result2 = mysqli_query($conn, $sql_avg);
    $avgRow = mysqli_fetch_assoc($result2);
    $avg = $avgRow['query_time'];

    /***********total execution time*****************************/
  $sql_sum="SELECT SEC_TO_TIME(Sum(TIME_TO_SEC(`query_time`))) AS query_time FROM user_slow_log where start_time ='$last_date'";
  $result3 = mysqli_query($conn, $sql_sum);
  $totalRow = mysqli_fetch_assoc($result3);
  $total = $totalRow['query_time'];

  $rowcount2=mysqli_num_rows($result3);
    mysqli_free_result($result3);

    $rowcount3=mysqli_num_rows($result2);
      mysqli_free_result($result2);
    $tot_row = $rowcount2 + $rowcount3 ;


$queryInsertQueryInfo = "INSERT INTO  slow_queries_summary(start_time,q_num,avg_exe_time,tot_exe_time) VALUES ('$last_date','$tot_row','$avg','$total');";
  $conn2->query($queryInsertQueryInfo);
}



$conn->close();
$conn2->close();
?>
