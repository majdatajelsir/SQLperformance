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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT start_time, query_time, lock_time ,sql_text FROM user_query_log_temp ";
$result = $conn->query($sql);
?>
<h3>Normal Queries Information</h3>
<table style="display: block; text-align: center; border: 1px solid green; height: 330px;color:black; width: 700px; overflow-y: scroll;margin-top:70px;margin-left:100px;background-color:#DAE9E6;" >
  <tr>
              <th style="border: 1px solid black;"><center>Strat Time</center></th>
              <th style="border: 1px solid black;"><center>Query Time</center></th>
              <th style="border: 1px solid black;"><center>Lock Time</center></th>
              <th>Sql Text</th>

   </tr>

<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>

<tr>
    <td  style="border: 1px solid black;"><?php echo $row["start_time"];?></td>
    <td  style="border: 1px solid black;"><?php echo $row["query_time"];?></td>
    <td  style="border: 1px solid black;"><?php echo $row["lock_time"];?></td>
    <td style="border: 1px solid black;"><?php echo $row["sql_text"];?></td>



</tr>
<?php
 array_push($date_array,$row["start_time"]);
 array_push($time_array,$row["query_time"]);

}

} else {
    echo "0 results";
}
queries_summary
$sql2 = "SELECT start_time FROM user_query_log_temp ";
$result2= $conn->query($sql2);
$row = $result2->fetch_assoc();
$query_date = $row["start_time"];

echo $query_date;
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

/*  $queryInsertQueryInfo = "INSERT INTO  queries_summary(start_time,q_num,avg_exe_time,tot_exe_time) VALUES ('$query_date','$tot_row','$avg','$total');";
  $conn2->query($queryInsertQueryInfo);

  if(!$conn2->query($queryInsertQueryInfo)){
      echo "Insertion Failed: (" . $conn2->errno . ") " . $conn2->error;
  }*/
$query_date ='2017-10-06';

}


$variable=$_POST['topology']; //contains the value they chose from T1, etc.

if($variable == 1){
  $frist_date= date("Y-m-d H:i:s:ms",strtotime("-1 day"));
  $last_date= date("Y-m-d H:i:s:ms",strtotime("-2 day"));
  echo $frist_date."<br>".$last_date;

}
if($variable == 2){
  $frist_date= date("Y-m-d H:i:s:ms",strtotime("-7 day"));
  $last_date= date("Y-m-d H:i:s:ms",strtotime("-14 day"));
    echo $frist_date."<br>".$last_date;
}
if($variable == 3){
  $frist_date= date("Y-m-d H:i:s:ms",strtotime("-30 day"));
  $last_date= date("Y-m-d H:i:s:ms",strtotime("-60 day"));
    echo $frist_date."<br>".$last_date;
}
if($variable == 4){
  $frist_date= date("Y-m-d H:i:s:ms",strtotime("-1 year"));
  $last_date= date("Y-m-d H:i:s:ms",strtotime("-2 year"));
    echo $frist_date."<br>".$last_date;
}



// total number of normal queries

$rowcount=mysqli_num_rows($result);
  // Free result set
  mysqli_free_result($result);

// total execution time

$sql2="SELECT SEC_TO_TIME(Sum(TIME_TO_SEC(`query_time`))) AS query_time FROM user_query_log_temp ";
$res2 = mysqli_query($conn, $sql2);
$totalRow = mysqli_fetch_assoc($res2);
$total = $totalRow['query_time'];

 // avg execution time
 $sql3="SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(`query_time`))) AS query_time FROM user_query_log_temp ";
 $res3 = mysqli_query($conn, $sql3);
 $avgRow = mysqli_fetch_assoc($res3);
 $avg = $avgRow['query_time'];
 ?>
 <table class="zebra" style="display: block;  text-align: center;margin-top:30px;margin-left:230px;border: 1px solid green; height: 95px;background-color:#DAE9E6; width:400px; overflow-y: scroll;color:black;" >
   <tr>
               <th style="border: 1px solid black;"><center>Total Numbre</center></th>
               <th style="border: 1px solid black;"><center>Average Execution Time</center></th>
               <th style="border: 1px solid black;"><center>Total Execution Time</center></th>


    </tr>

 <tr>
     <td  style="border: 1px solid black;"><?php echo $rowcount?></td>
     <td  style="border: 1px solid black;"><?php echo $avg?></td>
     <td  style="border: 1px solid black;"><?php echo $total?></td>

 </tr>
 </table>
<?php

$conn->close();
$conn2->close();
?>
