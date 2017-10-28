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
  $dbname = "slow_db";
  //include('GUI.html');
  // Create connection
  include("../lib/inc/chartphp_dist.php");
  $lastweek =array();
  $lastweek2 =array();
  $lastweek_data =array();
  $lastweek2_data =array();
  $total_execution_time;
  $avg_execution_time;
  $conn = new mysqli($servername, $username, $password, $dbname);
  $current_date=date('Y-m-d H:i:s:ms');
  $variable=$_POST['topology']; //contains the value they chose from T1, etc.
   $counter2;
  switch ($variable) {
    case '1':
      $counter = 2;
      break;
    case '2':
      $counter =14;
      break;
      case '3':
      $counter =60;
        break;

  }
  for($x= 0;$x<=$counter;$x++)
  if($variable == 1){
    $frist_date= date("Y-m-d",strtotime("-1 day"));
    $last_date= date("Y-m-d",strtotime("-2 day"));
    $sql = "SELECT q_num, avg_exe_time, tot_exe_time  FROM queries_summary WHERE start_time='$frist_date';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $query_num = $row["q_num"];
    $avg_exe = $row["avg_exe_time"];
    $tot_exe = $row["tot_exe_time"];
     $avg_exe =date('H.i', strtotime($tot_exe));
     $tot_exe =date('H.i', strtotime($tot_exe));

     $p = new chartphp();
     ?>
     <div style="margin:10px">

     <!-- display chart here -->
     <?php echo $out?>
   </div>
     <!-- display chart here -->
   <?php
     // set few params
     $p->data =array(array($avg_exe,$tot_exe,$avg_exe),array(50));
     $p->chart_type = "area";

     // render chart and get html/js output
     $out = $p->render('c1');
  }
  if($variable == 2){
    for($x=1 ;$x<8;$x++){
      $frist_date= date("Y-m-d ",strtotime("-$x day"));
      array_push($lastweek,$frist_date);
    }

    for($x=8;$x<15;$x++){
      $last_date= date("Y-m-d ",strtotime("-$x day"));
      array_push($lastweek2,$last_date);
    }
    for($x=0;$x<8;$x++){
      $lastweek_data= date("Y-m-d ",strtotime("-$x day"));
      array_push($lastweek2,$last_date);
    }


  }
  if($variable == 3){
    $frist_date= date("Y-m-d ",strtotime("-30 day"));
    $last_date= date("Y-m-d ",strtotime("-60 day"));
      echo $frist_date."<br>".$last_date;
  }
  if($variable == 4){
    $frist_date= date("Y-m-d",strtotime("-1 year"));
    $last_date= date("Y-m-d ",strtotime("-2 year"));
      echo $frist_date."<br>".$last_date;
  }


  //converting data into charts
  // include and create object


  ?>

</body>
</html>
