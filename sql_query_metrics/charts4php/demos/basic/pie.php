<?php
/**
 * Charts 4 PHP
 *
 * @author Shani <support@chartphp.com> - http://www.chartphp.com
 * @version 1.2.3
 * @license: see license.txt included in package
 */

include("../../lib/inc/chartphp_dist.php");

$query_num = 5;
$avg_exe = 50.20;
$tot_exe = 60.14;

$p = new chartphp();

$p->data = array(array(array('Heavy query', $query_num),array('Retail', $query_num), array('Light Industry', $avg_exe), array('Out of home', $avg_exe),array('Commuting', $tot_exe), array('Orientation', $tot_exe)));
$p->chart_type = "pie";

// Common Options
$p->title = "Pie Chart";

$out = $p->render('c1');
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="../../lib/js/jquery.min.js"></script>
		<script src="../../lib/js/chartphp.js"></script>
		<link rel="stylesheet" href="../../lib/js/chartphp.css">

	<style>
		/* white color data labels */
		.jqplot-data-label{color:white;}
	</style>
	</head>

	<body>
		<div style="width:40%; min-width:450px;">
		<?php echo $out; ?>
		</div>
	</body>
</html>
