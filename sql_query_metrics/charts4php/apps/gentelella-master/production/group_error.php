<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Group error! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md footer_fixed">
    <?php
    $user_name=$_POST['user_name'];
    $myfile = fopen("/var/log/apache2/error.log.1", "r") or die("Unable to open file!");
    $error_types = array("Warning", "Parse", "Fatal");
    $fatal_array= array();
    $warning_array = array();
    $parse_array=array();

    while(!feof($myfile)) {
    //  echo fgets($myfile) . "<br>";
      $error_line = fgets($myfile);
      $error_date = substr($error_line,1,19);
      $error_msg  = substr($error_line,79,strlen($error_line));
    //  echo "$error_line";
              if (strpos( $error_line, "Fatal" ) !== false ){
                array_push($fatal_array,$error_date,$error_msg );

              }

              if (strpos( $error_line, "Warning" ) !== false ){
                array_push($warning_array,$error_date,$error_msg);

              }

              if (strpos( $error_line, "Parse" ) !== false ){
                array_push($parse_array,$error_date,$error_msg);

              }
    }


    for($x = 0; $x <sizeof($fatal_array) ; $x++){
    echo "$fatal_array[$x]";
    }



    fclose($myfile);
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
                <h2></h2>
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

                  <li><a><i class="fa fa-clone"></i>Visulaization <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="visul_normal_q.php">Normal Queries</a></li>
                      <li><a href="visul_slow_query.php">Slow Queries</a></li>
                    </ul>
                  </li>
                </ul>
              </div> <!-- end of section-->
            </div>   <!-- /sidebar menu -->


            <!-- /menu footer buttons -->
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
            <!-- /menu footer buttons -->
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
                    <img src="images/img.jpg" alt=""><?php echo $user_name?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
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
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Fatal Errors<small>Sessions</small></h2>
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
                  for($x = 0; $x <sizeof($fatal_array);){
                  //echo "$fatal_array[$x]"."$fatal_array[$x++]"."<br>";
                        $x=($x+2);
                  }




                    ?>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Errors Rate</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" >

                  <?php
                  $number_of_fatal_error = sizeof($fatal_array);
                  $number_of_warning_error = sizeof($warning_array);
                  $number_of_parse_error = sizeof($parse_array);
                  $tottal_error = $number_of_fatal_error + $number_of_warning_error + $number_of_parse_error ;
                  $fatal_rate = $number_of_warning_error/$tottal_error*100;
                  $warning_rate = $number_of_fatal_error/$tottal_error*100;
                  $parse_rate = $number_of_parse_error/$tottal_error*100;

                  echo "Fatal Error: $fatal_rate". "<br>";
                  echo "warning Error: $warning_rate". "<br>";
                  echo "Parse Error :$parse_rate". "<br>";
                  ?>
                </div>
              </div>
            </div>
          </div>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Warning Errors<small>Sessions</small></h2>
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
                <div class="x_content" style="height: 95px; overflow-y: scroll;">
                 <?php


                  echo "/*******************/";
                  for($x = 0; $x <sizeof($warning_array); $x++){
                  echo "$warning_array[$x]";
                  }
                  fclose($myfile);
                 ?>
                </div>
              </div>
            </div>


            <div class="col-md-8 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Parse Errors<small>Sessions</small></h2>
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

                  for($x = 0; $x <sizeof($parse_array) ; $x++){
                  echo "$parse_array[$x]";
                  }

?>
                </div>
              </div>
            </div>


          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
              <div class="pull-left"><b>Copyright </b></b>&copy; 2017</div>
							<div class="pull-right">admin system</div>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
