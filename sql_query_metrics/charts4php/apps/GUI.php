<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="../lib/js/jquery.min.js"></script>
  <script src="../lib/js/chartphp.js"></script>
  <link rel="stylesheet" href="../lib/js/chartphp.css">



        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

  			<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
  		  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="bootstrap.css" rel="stylesheet">
        <link href="GUI.css" rel="stylesheet">

        <script src="html5shiv.js"></script>
        <script src="respond.min.js"></script>





  </head>
  <body>

		<div class="container-fluid display-table">
			<div class="row display-table-row">

				<!-- side menu -->

				<div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="side-menu">
					<h1 class="hidden-sm hidden-xs">navigation </h1>
					<ul>
						<li class="linl active">
							<a href="#">
								<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
								<span>Dashbord</span>
							</a>
						</li>

						<li class="linl">
							<a href="#collapse-post" data-toggle="collapse" aria-control="collapse-post">
								<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
								<span class="hidden-sm hidden-xs">SQL Performance</span>

							</a>
							<ul class="collapse collapseable" id="collapse-post">
								<li><a href="new-sql performance.html">Show all querirs</a></li>
								<li><a href="new-sql performance.html">Show Slow queries <span class="label label-success pull-right hidden-sm hidden-xs">20</span></a></li>

							</ul>
						</li>



						<li class="linl">
							<a href="#collapse-code" data-toggle="collapse" aria-control="collapse-code">
								<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
								<span class="hidden-sm hidden-xs">Code Peofiling</span>

							</a>
							<ul class="collapse collapseable" id="collapse-code">
								<li><a href="new-code profiler.html">Memory leak</a></li>
								<li><a href="code profiler.html">Function execution<span class="label label-success pull-right hidden-sm hidden-xs">20</span></a></li>

							</ul>
						</li>

						<li class="linl">
							<a href="#collapse-error" data-toggle="collapse" aria-control="collapse-error">
								<span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>
								<span class="hidden-sm hidden-xs">Error Tracking</span>
							</a>
							<ul class="collapse collapseable" id="collapse-error">
								<li><a href="new-error tracking.html">Show error rate<span class="label label-warning pull-right hidden-sm hidden-xs">20</span></a></li>
								<li><a href="error tracking.html">Grouping </a></li>

							</ul>
						</li>

						<li class="linl">
							<a href="#">
								<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
								<span class="hidden-sm hidden-xs">Predection</span>
							</a>
						</li>

	            <li class="linl settings-btn">
							<a href="#">
								<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
								<span class="hidden-sm hidden-xs">Setting</span>
							</a>
						</li>
					</ul>
				</div>

				<!--main content area -->

				<div class="col-md-10 col-sm-11 display-table-cell valign-top">

						<div class="row">
						<header id="nav-header" class="clearfix">
							<div class="col-md-5">
								<div class="navbar-default pull-left">
								 <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas"
									data-target="#side-menu">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								 </button>
								</div>
							<input type="text" class="hidden-sm hidden-xs" id="header-search-field" placeholder="Search for somthing .." >
							</div>
							<div class="col-md-7">
								<ul class="pull-right">
									<li id="welcome" class="hidden-xs">Welcome to your administration area</li>
									<li class="fixed-width ">
										<a href="#">
											<span class="glyphicon glyphicon-bell" aria-hidden="true"></span>
											<span class="label label-warning">3</span>
										</a>
									</li>

									<li class="fixed-width ">
										<a href="#">
											<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
											<span class="label label-message">3</span>
										</a>
									</li>

									<li>
										<a href="#" class="logout">
											<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
											log out
										</a>
									</li>
								</ul>
							</div>
						</header>

					</div>
          <div>



            <form method="post" action="visul_slow_query.php">
<select name="topology" size="1">
<option value="1">Last tow days
<option value="2">Last to weeks
<option value="3">Last tow months
</select>&nbsp;
<input type="submit" name="submit" value="OK">
</form>


<?php  $query_num = 5;
$avg_exe = 50.20;
$tot_exe = 60.14;
include("../lib/inc/chartphp_dist.php");
$p = new chartphp();

$p->data = array(array(array('Heavy query', 0),array('Retail', 12), array('Light Industry', 3), array('Out of home', 5),array('Commuting', 6), array('Orientation', 2)));
$p->chart_type = "pie";

// Common Options
$p->title = "Pie Chart";

$out = $p->render('c1');?>
<div style="width:40%; min-width:450px;">

<?php echo $out; ?>
</div>
          </div>
					<div class="row">
						<footer id="admin-footer" class="clearfix">
							<div class="pull-left"><b>Copyright </b>&copy; 2017</div>
							<div class="pull-right">admin system</div>
						</footer>
					</div>





				</div>
			</div>
		</div>



  </body>
</html>
