<?php

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "mysql";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT start_time, query_time, lock_time ,sql_text FROM user_slow_log";
$result = $conn->query($sql);
?>
<h3>Expensive Queries Information</h3>
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
}
} else {
    echo "0 results";
}

$rowcount=mysqli_num_rows($result);
  // Free result set
  mysqli_free_result($result);
// total execution time

$sql2="SELECT SEC_TO_TIME(Sum(TIME_TO_SEC(`query_time`))) AS query_time FROM user_slow_log ";
$res2 = mysqli_query($conn, $sql2);
$totalRow = mysqli_fetch_assoc($res2);
$total = $totalRow['query_time'];

 // avg execution time
 $sql3="SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(`query_time`))) AS query_time FROM user_slow_log ";
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
?>
