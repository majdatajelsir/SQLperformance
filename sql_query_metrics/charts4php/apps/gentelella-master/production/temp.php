<!DOCTYPE html>
<html lang="en">
  <head>

    <script src="../../../lib/js/jquery.min.js"></script>
    <script src="../../../lib/js/chartphp.js"></script>
    <link rel="stylesheet" href="../../../lib/js/chartphp.css">
</head>
<body>
  <?php  $query_num = 5;
  $avg_exe = 50.20;
  $tot_exe = 60.14;
include("../../../lib/inc/chartphp_dist.php");
  $p = new chartphp();

  $p->data = array(array(array('Heavy query', 0),array('Retail', 12), array('Light Industry', 3), array('Out of home', 5),array('Commuting', 6), array('Orientation', 2)));
  $p->chart_type = "pie";

  // Common Options
  $p->title = "Pie Chart";

  $out = $p->render('c1');?>
  <div style="width:40%; min-width:450px;">
    <p>jgjhgjhvghfhfh</p>
  <?php echo $out; ?>
  </div>
</body>
</html>
