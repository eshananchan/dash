<?php
require_once('../includes/nps_dbcon.php');
header('Content-Type: application/json');
if($_GET['queues']=='wh')
	$queue= "and queue IN ('WebHosting-FL', 'WebHosting-Phone-FL', 'India-WebHosting-Phone-FL', 'India-WebHosting-FL')";
elseif ($_GET['queues']=='bm')
	$queue="and queue IN ('BusinessMail-Phone-FL', 'BusinessMail-FL', 'India-BusinessMail-FL', 'India-BusinessMail-Phone-FL')";
elseif ($_GET['queues']=='yd')
$queue="and queue IN ('Domains-FL', 'Domains-Phone-FL', 'India-Domains-FL', 'India-Domains-Phone-FL')";
elseif ($_GET['queues']=='ms')
	$queue="and queue IN ('MerchantSolutions-Phone-FL', 'MerchantSolutions-FL')";
elseif ($_GET['queues']=='ys')
	$queue="and queue IN ('Stores-Phone-FL', 'Stores-FL')";
elseif ($_GET['queues']=='lw')
	$queue="and queue IN ('Localworks-FL', 'Localworks-Phone-FL')";
elseif ($_GET['queues']=='cc')
	$queue="and queue IN ('Localworks-FL', 'Localworks-Phone-FL')";
elseif ($_GET['queues']=='et')
	$queue="and queue IN ('WebHosting-ET', 'Localworks-ET', 'MerchantSolutions-ET', 'Domains-ET', 'BusinessMail-ET', 'Stores-ET', 'HGMS-ET', 'DeveloperNetwork-ET')";
$where_clause=" and channel Like '".$_GET['channel']."%' AND `create_date` BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' AND location Like '".$_GET['site']."%' and flag=1 ";

//L2 people Product Policy breakdown for promoters
if($_GET['type'] == 'L1Pro')
	{
	$query = "SELECT `level_1`, (count(*)/(select count(*) from csat_dump where (`NPS`=9 or `NPS`=10) ".$where_clause.$queue.")*100) as volume FROM `csat_dump` WHERE (`NPS`=9 or `NPS`=10) ".$where_clause.$queue." group by `level_1`";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	// get data and store in a json array
	$output ='[';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$output = $output . '["'. $row['level_1'] .'",'.number_format($row['volume'], 2, '.', '').'],';
	}
	$output = trim($output, ",") ."]";
	echo $output;
	}
	//L2 people Product Policy breakdown for passive
	if($_GET['type'] == 'L1Pas')
	{
	$query = "SELECT `level_1`, (count(*)/(select count(*) from csat_dump where (`NPS`=7 or `NPS`=8) ".$where_clause.$queue.")*100) as volume FROM `csat_dump` WHERE (`NPS`=7 or `NPS`=8) ".$where_clause.$queue." group by `level_1`";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	// get data and store in a json array
	$output ='[';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$output = $output . '["'. $row['level_1'] .'",'.number_format($row['volume'], 2, '.', '').'],';
	}
	$output = trim($output, ",") ."]";
	echo $output;
	}
	//L2 people Product Policy breakdown for detractors
	if($_GET['type'] == 'L1Det')
	{
	$query = "SELECT `level_1`, (count(*)/(select count(*) from csat_dump where `NPS`<7 ".$where_clause.$queue.")*100) as volume FROM `csat_dump` WHERE `NPS`<7 ".$where_clause.$queue." group by `level_1`";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	// get data and store in a json array
	$output ='[';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$output = $output . '["'. $row['level_1'] .'",'. number_format($row['volume'], 2, '.', '').'],';
	}
	$output = trim($output, ",") ."]";
	echo $output;
	}
	
	
	
	else if($_GET['type'] == 'L1TimePro')
	{
	$query = "SELECT `week_ending` as thisweek,`level_1`, (count(*)/(select count(*) from csat_dump where (`NPS`=9 or `NPS`=10) and `week_ending`=thisweek ".$where_clause.$queue.")*100) as volume FROM `csat_dump` WHERE (`NPS`=9 or `NPS`=10) ".$where_clause.$queue." group by `level_1`,`week_ending` order by `create_date`";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	// get data and store in a json array
			$week = array();
			$people = array();
			$product = array();
			$process = array();
			$nps=array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			array_push($week, $row['thisweek']);
			if($row['level_1']=="People"){
			array_push($people, $row['volume']);
			}else if($row['level_1']=="ProcessPolicy"){
			array_push($process, $row['volume']);
			} else if($row['level_1']=="Product"){
			array_push($product, $row['volume']);
			}
	}
	$week =array_unique($week);
	$output='[{ "name": "week", "data":[';
	foreach($week as $value)
		{
			$output =$output .'"' .$value.'",';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "People", "data":[';
		foreach($people as $value)
		{
			$output =$output .number_format($value, 2, '.', '').',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Product", "data":[';
		foreach($product as $value)
		{
			$output =$output .number_format($value, 2, '.', '').',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Process", "data":[';
		foreach($process as $value)
		{
			$output =$output .number_format($value, 2, '.', '').',';
		}
		$output = trim($output, ",") ."]}]";
		echo $output;
	}
	
	else if($_GET['type'] == 'L1TimePas')
	{
	$query = "SELECT `week_ending` as thisweek,`level_1`, (count(*)/(select count(*) from csat_dump where (`NPS`=7 or `NPS`=8) and `week_ending`=thisweek ".$where_clause.$queue.")*100) as volume FROM `csat_dump` WHERE (`NPS`=7 or `NPS`=8) ".$where_clause.$queue." group by `level_1`,`week_ending` order by `create_date`";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	// get data and store in a json array
			$week = array();
			$people = array();
			$product = array();
			$process = array();
			$nps=array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			array_push($week, $row['thisweek']);
			if($row['level_1']=="People"){
			array_push($people, $row['volume']);
			}else if($row['level_1']=="ProcessPolicy"){
			array_push($process, $row['volume']);
			} else if($row['level_1']=="Product"){
			array_push($product, $row['volume']);
			}
	}
	$week =array_unique($week);
	$output='[{ "name": "week", "data":[';
	foreach($week as $value)
		{
			$output =$output .'"' .$value.'",';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "People", "data":[';
		foreach($people as $value)
		{
			$output =$output .number_format($value, 2, '.', '').',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Product", "data":[';
		foreach($product as $value)
		{
			$output =$output .number_format($value, 2, '.', '').',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Process", "data":[';
		foreach($process as $value)
		{
			$output =$output .number_format($value, 2, '.', '').',';
		}
		$output = trim($output, ",") ."]}]";
		echo $output;
	}
	// get data time line for promoters
	else if($_GET['type'] == 'L1TimeDet')
	{
	$query = "SELECT `week_ending` as thisweek,`level_1`, (count(*)/(select count(*) from csat_dump where (`NPS`<7) and `week_ending`=thisweek ".$where_clause.$queue.")*100) as volume FROM `csat_dump` WHERE (`NPS`<7) ".$where_clause.$queue." group by `level_1`,`week_ending` order by `create_date`";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
			$week = array();
			$people = array();
			$product = array();
			$process = array();
			$nps=array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			array_push($week, $row['thisweek']);
			if($row['level_1']=="People"){
			array_push($people, $row['volume']);
			}else if($row['level_1']=="ProcessPolicy"){
			array_push($process, $row['volume']);
			} else if($row['level_1']=="Product"){
			array_push($product, $row['volume']);
			}
	}
	$week =array_unique($week);
	$output='[{ "name": "week", "data":[';
	foreach($week as $value)
		{
			$output =$output .'"' .$value.'",';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "People", "data":[';
		foreach($people as $value)
		{
			$output =$output .number_format($value, 2, '.', '').',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Product", "data":[';
		foreach($product as $value)
		{
			$output =$output .number_format($value, 2, '.', '').',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Process", "data":[';
		foreach($process as $value)
		{
			$output =$output .number_format($value, 2, '.', '').',';
		}
		$output = trim($output, ",") ."]}]";
		echo $output;
	}
	
?>