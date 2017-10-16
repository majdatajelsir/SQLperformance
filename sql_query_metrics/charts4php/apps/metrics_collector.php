<!DOCTYPE html>
<html>
<head>

  <script src="../lib/js/jquery.min.js"></script>
  <script src="../lib/js/chartphp.js"></script>
  <link rel="stylesheet" href="../../lib/js/chartphp.css">

</head>
<body>

<?php
include "connection.php";
include "mysql_settings.php";


$sql = "SELECT start_time, query_time, lock_time ,sql_text FROM slow_log WHERE db='slow_db' AND (sql_text like '%INSERT INTO%' OR sql_text like '%DELETE%' OR sql_text like 'UPDATE%' OR sql_text like '%SELECT * FROM%')";
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
//converting data into charts

// include and create object
include("../lib/inc/chartphp_dist.php");
$p = new chartphp();

// set few params
$p->data =array(array(50,85,75,75,40,92,200,),array(68,75,85,185,250,450,500));
$p->chart_type = "area";

// render chart and get html/js output
$out = $p->render('c1');

?>
<div style="margin:10px">

<!-- display chart here -->
<?php echo $out?>
<!-- display chart here -->

</di

</body>
</html>
