<!DOCTYPE html>
<html lang="en">
  <head>

    <script src="../../../lib/js/jquery.min.js"></script>
    <script src="../../../lib/js/chartphp.js"></script>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>visualization Normal query</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../lib/js/chartphp.css">

  </head>

  <body class="nav-md">
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
    $week2_tot_out;
    $conn = new mysqli($servername, $username, $password, $dbname);
    $current_date=date('Y-m-d H:i:s:ms');
    $variable=$_POST['topology']; //contains the value they chose from T1, etc.
     $counter2;
     $variable=3;
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


       $p->data = array(array(array($frist_date, (int)$query_num3),array($last_date, (int)$query_num)));
       $p->chart_type = "pie";
       $q_num_out = $p->render('c1');

       $p->data = array(array(array($frist_date, (int)$avg_exe),array($last_date, (int)$avg_exe3)));
       $p->chart_type = "pie";
       $avg_out = $p->render('c2');

       $p->data = array(array(array($frist_date, (int)$tot_exe),array($last_date, (int)$tot_exe3)));
       $p->chart_type = "pie";
       $tot_out = $p->render('c3');


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

      $p->data = array(array(array($lastweek[0], (int)$lastweek_data[0]),array($lastweek[1],(int)$lastweek_data[3]),array($lastweek[2],(int)$lastweek_data[6]),array($lastweek[3],(int)$lastweek_data[9]),array($lastweek[4],(int)$lastweek_data[12]),array($lastweek[5],(int)$lastweek_data[15]),array($lastweek[6],(int)$lastweek_data[18])));
      $p->chart_type = "pie";
      $week1_q_num_out = $p->render('c1');

      $p->data = array(array(array($lastweek[0], (int)$lastweek_data[1]),array($lastweek[1],(int)$lastweek_data[4]),array($lastweek[2],(int)$lastweek_data[7]),array($lastweek[3],(int)$lastweek_data[10]),array($lastweek[4],(int)$lastweek_data[13]),array($lastweek[5],(int)$lastweek_data[16]),array($lastweek[6],(int)$lastweek_data[19])));
      $p->chart_type = "pie";
      $week1_avg_out = $p->render('c2');

      $p->data = array(array(array($lastweek[0], (int)$lastweek_data[2]),array($lastweek[1],(int)$lastweek_data[5]),array($lastweek[2],(int)$lastweek_data[8]),array($lastweek[3],(int)$lastweek_data[11]),array($lastweek[4],(int)$lastweek_data[14]),array($lastweek[5],(int)$lastweek_data[17]),array($lastweek[6],(int)$lastweek_data[20])));
      $p->chart_type = "pie";
      $week1_tot_out = $p->render('c3');

      $p->data = array(array(array($lastweek2[0], (int)$lastweek2_data[0]),array($lastweek2[1],(int)$lastweek2_data[3]),array($lastweek2[2],(int)$lastweek2_data[6]),array($lastweek2[3],(int)$lastweek2_data[9]),array($lastweek2[4],(int)$lastweek2_data[12]),array($lastweek2[5],(int)$lastweek2_data[15]),array($lastweek2[6],(int)$lastweek2_data[18])));
      $p->chart_type = "pie";
      $week2_q_num_out = $p->render('c4');

      $p->data = array(array(array($lastweek2[0], (int)$lastweek2_data[1]),array($lastweek2[1],(int)$lastweek2_data[4]),array($lastweek2[2],(int)$lastweek2_data[7]),array($lastweek2[3],(int)$lastweek2_data[10]),array($lastweek2[4],(int)$lastweek2_data[13]),array($lastweek2[5],(int)$lastweek2_data[16]),array($lastweek2[6],(int)$lastweek2_data[19])));
      $p->chart_type = "pie";
      $week2_avg_out = $p->render('c5');

      $p->data = array(array(array($lastweek2[0], (int)$lastweek2_data[2]),array($lastweek2[1],(int)$lastweek2_data[5]),array($lastweek2[2],(int)$lastweek2_data[8]),array($lastweek2[3],(int)$lastweek2_data[11]),array($lastweek2[4],(int)$lastweek2_data[14]),array($lastweek2[5],(int)$lastweek2_data[17]),array($lastweek2[6],(int)$lastweek2_data[20])));
      $p->chart_type = "pie";
      $week2_tot_out = $p->render('c6');
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

      $p->data=array(array(array($lastmonth[0],(int)$lastmonth_data[0]),array($lastmonth[1],(int)$lastmonth_data[3]),array($lastmonth[2],(int)$lastmonth_data[6]),array($lastmonth[3],(int)$lastmonth_data[9]),array($lastmonth[4],(int)$lastmonth_data[12]),array($lastmonth[5],(int)$lastmonth_data[15]),array($lastmonth[6],(int)$lastmonth_data[18]),array($lastmonth[7],(int)$lastmonth_data[21]),array($lastmonth[8],(int)$lastmonth_data[24]),array($lastmonth[9],(int)$lastmonth_data[27]),array($lastmonth[10],(int)$lastmonth_data[30]),array($lastmonth[11],(int)$lastmonth_data[33]),array($lastmonth[12],(int)$lastmonth_data[36]),array($lastmonth[13],(int)$lastmonth_data[39]),array($lastmonth[14],(int)$lastmonth_data[42]),array($lastmonth[15],(int)$lastmonth_data[45]),array($lastmonth[16],(int)$lastmonth_data[48]),array($lastmonth[17],(int)$lastmonth_data[51]),array($lastmonth[18],(int)$lastmonth_data[54]),array($lastmonth[19],(int)$lastmonth_data[57]),array($lastmonth[20],(int)$lastmonth_data[60]),array($lastmonth[21],(int)$lastmonth_data[63]),array($lastmonth[22],(int)$lastmonth_data[66]),array($lastmonth[23],(int)$lastmonth_data[69]), array($lastmonth[24],(int)$lastmonth_data[72]),array($lastmonth[25],(int)$lastmonth_data[75]),array($lastmonth[26],(int)$lastmonth_data[78]),array($lastmonth[27],(int)$lastmonth_data[81]),array($lastmonth[28],(int)$lastmonth_data[84]),array($lastmonth[29],(int)$lastmonth_data[87]),array($lastmonth[30],(int)$lastmonth_data[90])));
      $p->chart_type = "pie";
      $month1_q_num_out = $p->render('c1');

      $p->data=array(array(array($lastmonth[0],(int)$lastmonth_data[0]),array($lastmonth[1],(int)$lastmonth_data[3]),array($lastmonth[2],(int)$lastmonth_data[6]),array($lastmonth[3],(int)$lastmonth_data[9]),array($lastmonth[4],(int)$lastmonth_data[12]),array($lastmonth[5],(int)$lastmonth_data[15]),array($lastmonth[6],(int)$lastmonth_data[18]),array($lastmonth[7],(int)$lastmonth_data[21]),array($lastmonth[8],(int)$lastmonth_data[24]),array($lastmonth[9],(int)$lastmonth_data[27]),array($lastmonth[10],(int)$lastmonth_data[30]),array($lastmonth[11],(int)$lastmonth_data[33]),array($lastmonth[12],(int)$lastmonth_data[36]),array($lastmonth[13],(int)$lastmonth_data[39]),array($lastmonth[14],(int)$lastmonth_data[42]),array($lastmonth[15],(int)$lastmonth_data[45]),array($lastmonth[16],(int)$lastmonth_data[48]),array($lastmonth[17],(int)$lastmonth_data[51]),array($lastmonth[18],(int)$lastmonth_data[54]),array($lastmonth[19],(int)$lastmonth_data[57]),array($lastmonth[20],(int)$lastmonth_data[60]),array($lastmonth[21],(int)$lastmonth_data[63]),array($lastmonth[22],(int)$lastmonth_data[66]),array($lastmonth[23],(int)$lastmonth_data[69]), array($lastmonth[24],(int)$lastmonth_data[72]),array($lastmonth[25],(int)$lastmonth_data[75]),array($lastmonth[26],(int)$lastmonth_data[78]),array($lastmonth[27],(int)$lastmonth_data[81]),array($lastmonth[28],(int)$lastmonth_data[84]),array($lastmonth[29],(int)$lastmonth_data[87]),array($lastmonth[30],(int)$lastmonth_data[90])));
      $p->chart_type = "pie";      $p->chart_type = "pie";
      $month1_avg_out = $p->render('c2');

      $p->data=array(array(array($lastmonth[0],(int)$lastmonth_data[0]),array($lastmonth[1],(int)$lastmonth_data[3]),array($lastmonth[2],(int)$lastmonth_data[6]),array($lastmonth[3],(int)$lastmonth_data[9]),array($lastmonth[4],(int)$lastmonth_data[12]),array($lastmonth[5],(int)$lastmonth_data[15]),array($lastmonth[6],(int)$lastmonth_data[18]),array($lastmonth[7],(int)$lastmonth_data[21]),array($lastmonth[8],(int)$lastmonth_data[24]),array($lastmonth[9],(int)$lastmonth_data[27]),array($lastmonth[10],(int)$lastmonth_data[30]),array($lastmonth[11],(int)$lastmonth_data[33]),array($lastmonth[12],(int)$lastmonth_data[36]),array($lastmonth[13],(int)$lastmonth_data[39]),array($lastmonth[14],(int)$lastmonth_data[42]),array($lastmonth[15],(int)$lastmonth_data[45]),array($lastmonth[16],(int)$lastmonth_data[48]),array($lastmonth[17],(int)$lastmonth_data[51]),array($lastmonth[18],(int)$lastmonth_data[54]),array($lastmonth[19],(int)$lastmonth_data[57]),array($lastmonth[20],(int)$lastmonth_data[60]),array($lastmonth[21],(int)$lastmonth_data[63]),array($lastmonth[22],(int)$lastmonth_data[66]),array($lastmonth[23],(int)$lastmonth_data[69]), array($lastmonth[24],(int)$lastmonth_data[72]),array($lastmonth[25],(int)$lastmonth_data[75]),array($lastmonth[26],(int)$lastmonth_data[78]),array($lastmonth[27],(int)$lastmonth_data[81]),array($lastmonth[28],(int)$lastmonth_data[84]),array($lastmonth[29],(int)$lastmonth_data[87]),array($lastmonth[30],(int)$lastmonth_data[90])));
      $p->chart_type = "pie";      $p->chart_type = "pie";
      $month1_tot_out = $p->render('c3');

     $p->data=array(array(array($lastmonth[0],(int)$lastmonth_data[0]),array($lastmonth[1],(int)$lastmonth_data[3]),array($lastmonth[2],(int)$lastmonth_data[6]),array($lastmonth[3],(int)$lastmonth_data[9]),array($lastmonth[4],(int)$lastmonth_data[12]),array($lastmonth[5],(int)$lastmonth_data[15]),array($lastmonth[6],(int)$lastmonth_data[18]),array($lastmonth[7],(int)$lastmonth_data[21]),array($lastmonth[8],(int)$lastmonth_data[24]),array($lastmonth[9],(int)$lastmonth_data[27]),array($lastmonth[10],(int)$lastmonth_data[30]),array($lastmonth[11],(int)$lastmonth_data[33]),array($lastmonth[12],(int)$lastmonth_data[36]),array($lastmonth[13],(int)$lastmonth_data[39]),array($lastmonth[14],(int)$lastmonth_data[42]),array($lastmonth[15],(int)$lastmonth_data[45]),array($lastmonth[16],(int)$lastmonth_data[48]),array($lastmonth[17],(int)$lastmonth_data[51]),array($lastmonth[18],(int)$lastmonth_data[54]),array($lastmonth[19],(int)$lastmonth_data[57]),array($lastmonth[20],(int)$lastmonth_data[60]),array($lastmonth[21],(int)$lastmonth_data[63]),array($lastmonth[22],(int)$lastmonth_data[66]),array($lastmonth[23],(int)$lastmonth_data[69]), array($lastmonth[24],(int)$lastmonth_data[72]),array($lastmonth[25],(int)$lastmonth_data[75]),array($lastmonth[26],(int)$lastmonth_data[78]),array($lastmonth[27],(int)$lastmonth_data[81]),array($lastmonth[28],(int)$lastmonth_data[84]),array($lastmonth[29],(int)$lastmonth_data[87]),array($lastmonth[30],(int)$lastmonth_data[90])));
      $p->chart_type = "pie";
      $p->chart_type = "pie";
      $month2_q_num_out = $p->render('c4');

      $p->data=array(array(array($lastmonth[0],(int)$lastmonth_data[0]),array($lastmonth[1],(int)$lastmonth_data[3]),array($lastmonth[2],(int)$lastmonth_data[6]),array($lastmonth[3],(int)$lastmonth_data[9]),array($lastmonth[4],(int)$lastmonth_data[12]),array($lastmonth[5],(int)$lastmonth_data[15]),array($lastmonth[6],(int)$lastmonth_data[18]),array($lastmonth[7],(int)$lastmonth_data[21]),array($lastmonth[8],(int)$lastmonth_data[24]),array($lastmonth[9],(int)$lastmonth_data[27]),array($lastmonth[10],(int)$lastmonth_data[30]),array($lastmonth[11],(int)$lastmonth_data[33]),array($lastmonth[12],(int)$lastmonth_data[36]),array($lastmonth[13],(int)$lastmonth_data[39]),array($lastmonth[14],(int)$lastmonth_data[42]),array($lastmonth[15],(int)$lastmonth_data[45]),array($lastmonth[16],(int)$lastmonth_data[48]),array($lastmonth[17],(int)$lastmonth_data[51]),array($lastmonth[18],(int)$lastmonth_data[54]),array($lastmonth[19],(int)$lastmonth_data[57]),array($lastmonth[20],(int)$lastmonth_data[60]),array($lastmonth[21],(int)$lastmonth_data[63]),array($lastmonth[22],(int)$lastmonth_data[66]),array($lastmonth[23],(int)$lastmonth_data[69]), array($lastmonth[24],(int)$lastmonth_data[72]),array($lastmonth[25],(int)$lastmonth_data[75]),array($lastmonth[26],(int)$lastmonth_data[78]),array($lastmonth[27],(int)$lastmonth_data[81]),array($lastmonth[28],(int)$lastmonth_data[84]),array($lastmonth[29],(int)$lastmonth_data[87]),array($lastmonth[30],(int)$lastmonth_data[90])));
      $p->chart_type = "pie";      $p->chart_type = "pie";
      $month2_avg_out = $p->render('c5');

      $p->data=array(array(array($lastmonth[0],(int)$lastmonth_data[0]),array($lastmonth[1],(int)$lastmonth_data[3]),array($lastmonth[2],(int)$lastmonth_data[6]),array($lastmonth[3],(int)$lastmonth_data[9]),array($lastmonth[4],(int)$lastmonth_data[12]),array($lastmonth[5],(int)$lastmonth_data[15]),array($lastmonth[6],(int)$lastmonth_data[18]),array($lastmonth[7],(int)$lastmonth_data[21]),array($lastmonth[8],(int)$lastmonth_data[24]),array($lastmonth[9],(int)$lastmonth_data[27]),array($lastmonth[10],(int)$lastmonth_data[30]),array($lastmonth[11],(int)$lastmonth_data[33]),array($lastmonth[12],(int)$lastmonth_data[36]),array($lastmonth[13],(int)$lastmonth_data[39]),array($lastmonth[14],(int)$lastmonth_data[42]),array($lastmonth[15],(int)$lastmonth_data[45]),array($lastmonth[16],(int)$lastmonth_data[48]),array($lastmonth[17],(int)$lastmonth_data[51]),array($lastmonth[18],(int)$lastmonth_data[54]),array($lastmonth[19],(int)$lastmonth_data[57]),array($lastmonth[20],(int)$lastmonth_data[60]),array($lastmonth[21],(int)$lastmonth_data[63]),array($lastmonth[22],(int)$lastmonth_data[66]),array($lastmonth[23],(int)$lastmonth_data[69]), array($lastmonth[24],(int)$lastmonth_data[72]),array($lastmonth[25],(int)$lastmonth_data[75]),array($lastmonth[26],(int)$lastmonth_data[78]),array($lastmonth[27],(int)$lastmonth_data[81]),array($lastmonth[28],(int)$lastmonth_data[84]),array($lastmonth[29],(int)$lastmonth_data[87]),array($lastmonth[30],(int)$lastmonth_data[90])));
      $p->chart_type = "pie";

      $month2_tot_out = $p->render('c6');



    }
  $variable=$_POST['topology'];
?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Web-base Apm!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
             <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

              <div class="menu_section">
                <h3>Services</h3>

                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      	 <li><a href="home.html">Requisites</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-edit"></i> Sql Performance <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="show_all_q.php">Show All Query</a></li>
                      <li><a href="show_slow_query.php">Show Slow Query</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-desktop"></i> Code Profiler <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="memory leak.html">Memory Leak</a></li>
                      <li><a href="function ex.html">Function Execution</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-table"></i> Erorr Tracking <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                        <li><a href="group_error.php"> Error Groups</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-bar-chart-o"></i> Predection <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="predection.html">predection</a></li>
                    </ul>
                  </li>

                 <li><a><i class="fa fa-clone"></i>Visualization<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="visul_normal_q.php">Normel query</a></li>
                      <li><a href="visul_slow_query.php">slow query</a></li>
                    </ul>
                  </li>
                </ul>
              </div> <!-- end of section-->
            </div>   <!-- /sidebar menu -->


            <!-- menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- top navigation -->

        <!-- page content -->
                <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Visualization<small>  Normal Query</small></h3>   </br>

              </div>
              <div class="page-title">
                <div class="title_left">
                  <h3>Users <small>Some examples to get you started</small></h3>
                </div>
                <form class="form-control" method="post" action="visul_normal_q.php">
                <div class="title_right">
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">


              <select class="form-control" name="topology" size="1">
              <option value="1" selected>Last tow days
              <option value="2">Last to weeks
              <option value="3">Last tow months
              </select>&nbsp;
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                      </span>
                    </div>
                  </div>
                </div>
                </form>
              </div>


            </div>

            <div class="clearfix"></div>
            <div class="row">

            <!-- chart -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Line graph<small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <?php
                     if($variable == 1){
                       echo $q_num_out;
                       echo $avg_out;
                      echo $tot_out;
                     }
                    if($variable == 2){
                       echo $week1_q_num_out;
                       echo $week1_avg_out;
                       echo $week1_tot_out;
                    }
                    if($variable == 3){
                      echo $month1_q_num_out;
                      echo $month1_avg_out;
                      echo $month1_tot_out;

                    }
                    ?>
                  </div>
                </div>
              </div><!--end chart -->

              <!-- chart -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bar graph <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                          <?php
                          if($variable == 1){
                            echo $q_num_out;
                            echo $avg_out;
                           echo $tot_out;
                          }
                         if($variable == 2){
                            echo $week2_q_num_out;
                            echo $week2_avg_out;
                            echo $week2_tot_out;
                         }
                         if($variable == 3){
                           echo $month2_q_num_out;
                           echo $month2_avg_out;
                           echo $month2_tot_out;
                         }
                          ?>


                    </div>
                      </div>
                  </div>
                </div>

                <div class="row">




                    </div>
              </div>
            </div><!--end chart -->

            <!--chart -->




            </div>
          </div>
        </div>  <!-- page content -->



        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <div class="pull-left"><b>Copyright </b></b>&copy; 2017</div>
			<div class="pull-right">admin system</div>
          </div>
          <div class="clearfix"></div>
        </footer> <!-- footer content -->

      </div>

    </div>


    <!-- jQuery -->

    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>
