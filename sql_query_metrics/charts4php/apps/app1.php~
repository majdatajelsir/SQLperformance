<!DOCTYPE html>
<html>
<head>

  <script src="../lib/js/jquery.min.js"></script>
  <script src="../lib/js/chartphp.js"></script>
  <link rel="stylesheet" href="../../lib/js/chartphp.css">

</head>
<body>

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
if($conn->query($query)==true){
 echo "DONE";
} else {
echo "ERROR";
}





$sql = "SELECT start_time, query_time, lock_time ,sql_text FROM slow_log WHERE db='tam2air' AND (sql_text like '%INSERT INTO%' OR sql_text like '%DELETE%' OR sql_text like 'UPDATE%' OR sql_text like '%SELECT * FROM%')";
$result = $conn->query($sql);
?>
<table style="border: 1px solid black;" >
  <tr>
              <th>Strat Time</th>
              <th>Query Time</th>
              <th>Lock Time</th>
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
    <td  style="border: 1px solid black;"><?php echo $row["sql_text"];?></td>


</tr>


 <?php

$queryCreateUsersTable1 = "CREATE TABLE IF NOT EXISTS user_slow_log (
    start_time time(6) ,
    query_time  time(6),
    lock_time time(6) ,
    sql_text  text(150))";

$conn->query($queryCreateUsersTable1);

if(!$conn->query($queryCreateUsersTable1)){
    echo "Table creation failed: (" . $conn->errno . ") " . $conn->error;
}


$queryCreateUsersTable2 = "CREATE TABLE IF NOT EXISTS user_query_log (
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


<?php
//converting data into charts

// include and create object
include("../lib/inc/chartphp_dist.php");
$p = new chartphp();

// set few params
$p->data =array(array(3,7,9,1,4,6,8,2,5),array(5,3,8,2,6,2,9,2,6));
$p->chart_type = "area";

// render chart and get html/js output
$out = $p->render('c1');

?>
<div style="margin:10px">

<!-- display chart here -->
<?php echo $out?>
<!-- display chart here -->

</div>	
</body>
</html>
