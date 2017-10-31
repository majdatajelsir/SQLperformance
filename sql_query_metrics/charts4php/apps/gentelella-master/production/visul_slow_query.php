<!DOCTYPE html>
<html>
<head>

  <script src="../../../lib/js/jquery.min.js"></script>
  <script src="../../../lib/js/chartphp.js"></script>
  <link rel="stylesheet" href="../../../lib/js/chartphp.css">


</head>
<body>

  <?php

  $servername = "localhost";
  $username = "root";
  $password = "123456";
  $dbname = "slow_db";
  //include('GUI.html');
  // Create connection
  include("../../../lib/inc/chartphp_dist.php");
  $p = new chartphp();
  $lastweek =array();
  $lastweek2 =array();
  $lastweek_data =array();
  $lastweek2_data =array();
  $lastmonth =array();
  $lastmonth2=array();
  $lastmonth_data =array();
  $lastmonth2_data =array();
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

  if($variable == 1){
    $frist_date= date("Y-m-d",strtotime("-4 day"));
    $last_date= date("Y-m-d",strtotime("-5 day"));
    $sql = "SELECT q_num, avg_exe_time, tot_exe_time  FROM queries_summary WHERE start_time='$frist_date';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $query_num = $row["q_num"];
    $avg_exe = date('H.i', strtotime($row["avg_exe_time"]));
    $tot_exe = date('H.i', strtotime($row["tot_exe_time"]));

    $sql3 = "SELECT q_num, avg_exe_time, tot_exe_time  FROM queries_summary WHERE start_time='$last_date';";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $query_num3 = $row3["q_num"];
    $avg_exe3 = date('H.i', strtotime($row3["avg_exe_time"]));
    $tot_exe3 = date('H.i', strtotime($row3["tot_exe_time"]));


     $p->data = array(array(array($frist_date, $query_num3),array($last_date, $query_num)));
     $p->chart_type = "pie";
     $q_num_out = $p->render('c1');

     $p->data = array(array(array($frist_date, 29),array($last_date, 65)));
     $p->chart_type = "pie";
     $avg_out = $p->render('c2');

     $p->data = array(array(array($frist_date, 20),array($last_date, 2)));
     $p->chart_type = "pie";
     $tot_out = $p->render('c3');
     ?>

       <div style="margin:10;width:40%; min-width:450px;">
     <?php echo $q_num_out;?>
     <?php echo $avg_out;?>
     <?php echo $tot_out;?>
   </div>
   <?php





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
      //frist week
      $sql = "SELECT q_num, avg_exe_time, tot_exe_time  FROM queries_summary WHERE start_time='$lastweek[$x]';";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $query_num = $row["q_num"];
      $avg_exe = date('H.i', strtotime($row["avg_exe_time"]));
      $tot_exe = date('H.i', strtotime($row["tot_exe_time"]));
      array_push($lastweek_data,$query_num,$avg_exe,$tot_exe);
      //second week
      $sql2 = "SELECT q_num, avg_exe_time, tot_exe_time  FROM queries_summary WHERE start_time='$lastweek2[$x]';";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $query_num2 = $row2["q_num"];
      $avg_exe2 = date('H.i', strtotime($row2["avg_exe_time"]));
      $tot_exe2 = date('H.i', strtotime($row2["tot_exe_time"]));
      array_push($lastweek2_data,$query_num2,$avg_exe2,$tot_exe2);


    }

    $p->data = array(array(array($lastweek[0], $lastweek_data[0]),array($lastweek[1],$lastweek_data[3]),array($lastweek[2],$lastweek_data[6]),array($lastweek[3],$lastweek_data[9]),array($lastweek[4],$lastweek_data[12]),array($lastweek[5],$lastweek_data[15])));
    $p->chart_type = "pie";
    $week1_q_num_out = $p->render('c1');

    $p->data = array(array(array($frist_date, 29),array($last_date, 65)));
    $p->chart_type = "pie";
    $week1_avg_out = $p->render('c2');

    $p->data = array(array(array($frist_date, 20),array($last_date, 2)));
    $p->chart_type = "pie";
    $week1_tot_out = $p->render('c3');

    $p->data = array(array(array($lastweek[0], $lastweek_data[0]),array($lastweek[1],$lastweek_data[3]),array($lastweek[2],$lastweek_data[6]),array($lastweek[3],$lastweek_data[9]),array($lastweek[4],$lastweek_data[12]),array($lastweek[5],$lastweek_data[15])));
    $p->chart_type = "pie";
    $week2_q_num_out = $p->render('c4');

    $p->data = array(array(array($frist_date, 29),array($last_date, 65)));
    $p->chart_type = "pie";
    $week2_avg_out = $p->render('c5');

    $p->data = array(array(array($frist_date, 20),array($last_date, 2)));
    $p->chart_type = "pie";
    $week2_tot_out = $p->render('c6');
    ?>
<div style="background-color: rgb(12, 134, 103);">
      <div style="margin:10;width:40%; min-width:450px;background-color: rgb(134, 225, 202);">
    <?php echo $week1_q_num_out;?>
    <?php echo $week1_avg_out;?>
    <?php echo $week1_tot_out;?>
  </div>
  <div style="margin:10;width:40%; min-width:450px;background-color:red;">

  <?php echo $week2_q_num_out;?>
  <?php echo $week2_avg_out;?>
  <?php echo $week2_tot_out;?>
    </div>
  </div>
<?php
  }
  if($variable == 3){

    for($x=1;$x<31;$x++){
      $frist_date= date("Y-m-d ",strtotime("-$x day"));
      array_push($lastmonth,$frist_date);

    }


    for($x=31;$x<61;$x++){
      $last_date= date("Y-m-d ",strtotime("-$x day"));
      array_push($lastmonth2,$last_date);
    }
    for($x=0;$x<30;$x++){
      //frist week
      $sql = "SELECT q_num, avg_exe_time, tot_exe_time  FROM queries_summary WHERE start_time='$lastmonth[$x]';";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $query_num = $row["q_num"];
      $avg_exe = date('H.i', strtotime($row["avg_exe_time"]));
      $tot_exe = date('H.i', strtotime($row["tot_exe_time"]));
      array_push($lastmonth_data,$query_num,$avg_exe,$tot_exe);
      //second week
      $sql2 = "SELECT q_num, avg_exe_time, tot_exe_time  FROM queries_summary WHERE start_time='$lastmonth2[$x]';";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $query_num2 = $row2["q_num"];
      $avg_exe2 = date('H.i', strtotime($row2["avg_exe_time"]));
      $tot_exe2 = date('H.i', strtotime($row2["tot_exe_time"]));
      array_push($lastmonth2_data,$query_num2,$avg_exe2,$tot_exe2);


    }

    $p->data = array(array(array($lastmonth[0], $lastmonth_data[0]),array($lastmonth[1],$lastmonth_data[3]),array($lastmonth[2],$lastmonth_data[6]),array($lastmonth[3],$lastmonth_data[9]),array($lastmonth[4],$lastmonth_data[12]),array($lastmonth[5],$lastmonth_data[15])));
    $p->chart_type = "pie";
    $month1_q_num_out = $p->render('c1');

    $p->data = array(array(array($frist_date, 29),array($last_date, 65)));
    $p->chart_type = "pie";
    $month1_avg_out = $p->render('c2');

    $p->data = array(array(array($frist_date, 20),array($last_date, 2)));
    $p->chart_type = "pie";
    $month1_tot_out = $p->render('c3');

    $p->data = array(array(array($lastmonth[0], $lastmonth_data[0]),array($lastmonth[1],$lastmonth_data[3]),array($lastweek[2],$lastmonth_data[6]),array($lastmonth[3],$lastweek_data[9]),array($lastmonth[4],$lastmonth_data[12]),array($lastmonth[5],$lastmonth_data[15])));
    $p->chart_type = "pie";
    $month2_q_num_out = $p->render('c4');

    $p->data = array(array(array($frist_date, 29),array($last_date, 65)));
    $p->chart_type = "pie";
    $month2_avg_out = $p->render('c5');

    $p->data = array(array(array($frist_date, 20),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 2),array($last_date, 26),array($last_date, 22),array($last_date, 15),array($last_date, 9),array($last_date, 4)));
    $p->chart_type = "pie";
    $month2_tot_out = $p->render('c6');
    ?>
  <div style="background-color: rgb(12, 134, 103);">
      <div style="margin:10;width:40%; min-width:450px;background-color: rgb(134, 225, 202);">
    <?php echo $month1_q_num_out;?>
    <?php echo $month1_avg_out;?>
    <?php echo $month1_tot_out;?>
  </div>
  <div style="margin:10;width:40%; min-width:450px;background-color:red;">

  <?php echo $month2_q_num_out;?>
  <?php echo $month2_avg_out;?>
  <?php echo $month2_tot_out;?>
    </div>
  </div>
  <?php
  }


  //converting data into charts
  // include and create object


  ?>

</body>
</html>
