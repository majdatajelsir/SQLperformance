<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "slow_db";
//include('GUI.html');
// Create connection
$time_array =array();
$date_array =array();
$total_execution_time;
$avg_execution_time;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
}



$sql = "SELECT start_time ,q_num, avg_exe_time, tot_exe_time FROM queries_summary ";
$result = $conn->query($sql);
?>
<h3>Normal Queries Information</h3>
<table style="display: block; text-align: center; border: 1px solid green; height: 330px;color:black; width: 700px; overflow-y: scroll;margin-top:70px;margin-left:100px;background-color:#DAE9E6;" >
  <tr>
              <th style="border: 1px solid black;"><center>Queries Number</center></th>
              <th style="border: 1px solid black;"><center>Average Execution time</center></th>
              <th style="border: 1px solid black;"><center>Total Execution time</center></th>

   </tr>

<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>

<tr>
    <td  style="border: 1px solid black;"><?php echo $row["q_num"];?></td>
    <td  style="border: 1px solid black;"><?php echo $row["avg_exe_time"];?></td>
    <td  style="border: 1px solid black;"><?php echo $row["tot_exe_time"];?></td>

</tr>
<?php
 array_push($date_array,$row["start_time"]);
 array_push($time_array,$row["query_time"]);

}

} else {
    echo "0 results";
}

$variable=$_POST['topology']; //contains the value they chose from T1, etc.

if($variable == 1){

}
/*if($variable == 2){
  $frist_date= date("Y-m-d",strtotime("-5 day"));
  $last_date= date("Y-m-d",strtotime("-6 day"));
  $sql = "SELECT start_time ,q_num, avg_exe_time, tot_exe_time  FROM queries_summary WHERE start_time='$frist_date';";
  $result = mysqli_query($conn, $sql);
  $row = m.etch_assoc($result);
  $query_num = $row["q_num"];
  $avg_exe = date('H.i', strtotime($row["avg_exe_time"]));
  $tot_exe = date('H.i', strtotime($row["tot_exe_time"]));

  $sql3 = "SELECT stat_time ,q_num, avg_exe_time, tot_exe_time  FROM queries_summary WHERE start_time='$last_date';";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_assoc($result3);
  $query_num3 = $row3["q_num"];
  $avg_exe3 = date('H.i', strtotime($row3["avg_exe_time"]));
  $tot_exe3 = date('H.i', strtotime($row3["tot_exe_time"]));
  ?>

  <table style="display: block; text-align: center; border: 1px solid green; height: 330px;color:black; width: 700px; overflow-y: scroll;margin-top:70px;margin-left:100px;background-color:#DAE9E6;" >
    <tr>
                <th style="border: 1px solid black;"><center>Queries Number</center></th>
                <th style="border: 1px solid black;"><center>Average Execution time</center></th>
                <th style="border: 1px solid black;"><center>Total Execution time</center></th>

     </tr>

  <?php
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
  ?>

  <tr>
      <td  style="border: 1px solid black;"><?php echo $row["q_num"];?></td>
      <td  style="border: 1px solid black;"><?php echo $row["avg_exe_time"];?></td>
      <td  style="border: 1px solid black;"><?php echo $row["tot_exe_time"];?></td>

  </tr>
  <?php
   array_push($date_array,$row["start_time"]);
   array_push($time_array,$row["query_time"]);

  }

  } else {
      echo "0 results";
  }

}*/
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

$conn->close();

?>
