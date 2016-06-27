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
	$queue=" and queue IN ('WebHosting-ET', 'Localworks-ET', 'MerchantSolutions-ET', 'Domains-ET', 'BusinessMail-ET', 'Stores-ET', 'HGMS-ET', 'DeveloperNetwork-ET')";
	$where_clause=" channel Like '".$_GET['channel']."%' AND `create_date` BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' AND location Like '".$_GET['site']."%' and flag=1 ";
	//getting the overall data
	if($_GET['type'] == 's1')
	{
	$query = "SELECT SUM(CASE WHEN `NPS` < 7 THEN 1 ELSE 0 END)/count(`NPS`)*100 as detractors, SUM(CASE WHEN `NPS` = 7 OR `NPS` = 8 THEN 1 ELSE 0 END)/count(`NPS`)*100 as passives, SUM(CASE WHEN `NPS` = 9 or `NPS` = 10 THEN 1 ELSE 0 END)/count(`NPS`)*100 as promoters, ((((SUM(CASE WHEN `NPS` = 9 or `NPS` = 10 THEN 1 ELSE 0 END)/count(`NPS`))*100) - (SUM(CASE WHEN `NPS` < 7 THEN 1 ELSE 0 END)/count(`NPS`))*100)) as NPS from csat_dump where channel Like '".$_GET['channel']."%' AND `create_date` BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' AND location Like '".$_GET['site']."%'".$queue;
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	// get data and store in a json array
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo '[["NPS",'. number_format($row['NPS'], 2, '.', '') .'],["Promoters",'. $row['promoters'].'],["Passives",'. $row['passives'].'],["Detractors",'. $row['detractors'].']]';
	}
	}
		//getting the overall data weekly
	else if($_GET['type'] == 's2')
	{
	$query = "SELECT `week_ending`, SUM(CASE WHEN `NPS` < 7 THEN 1 ELSE 0 END)/count(`NPS`)*100 as detractors, SUM(CASE WHEN `NPS` = 7 OR `NPS` = 8 THEN 1 ELSE 0 END)/count(`NPS`)*100 as passives, SUM(CASE WHEN `NPS` = 9 or `NPS` = 10 THEN 1 ELSE 0 END)/count(`NPS`)*100 as promoters,((((SUM(CASE WHEN `NPS` = 9 or `NPS` = 10 THEN 1 ELSE 0 END)/count(`NPS`))*100) - (SUM(CASE WHEN `NPS` < 7 THEN 1 ELSE 0 END)/count(`NPS`))*100)) as NPS from csat_dump where channel Like '".$_GET['channel']."%' AND `create_date` BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' AND location Like '".$_GET['site']."%'" .$queue." group by `week_ending` order by create_date";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	// get data and store in a json array
			$week = array();
			$promoters = array();
			$passives = array();
			$detractors = array();
			$nps=array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			array_push($week, $row['week_ending']);
			array_push($promoters, $row['promoters']);
			array_push($passives, $row['passives']);
			array_push($detractors, $row['detractors']);
			array_push($nps, $row['NPS']);
	}
	$output='[{ "name": "week", "data":[';
	foreach($week as $value)
		{
			$output =$output .'"' .$value.'",';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Promoters", "type":"column", "data":[';
		foreach($promoters as $value)
		{
			$output =$output .number_format($value, 1, '.', '').',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Passives", "type":"column", "data":[';
		foreach($passives as $value)
		{
			$output =$output .number_format($value, 1, '.', '').',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Detractors", "type":"column", "data":[';
		foreach($detractors as $value)
		{
			$output =$output .number_format($value, 1, '.', '').',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "NPS", "type":"line", "data":[';
		foreach($nps as $value)
		{
			$output =$output .number_format($value, 1, '.', '').',';
		}
		$output = trim($output, ",") ."]}]";
		echo $output;
	}
	else if($_GET['level'] == 'top10')
	{
		
			$query ="SELECT `level_2`, count(`level_2`) as count, SUM(CASE WHEN `NPS` < 7 THEN 1 ELSE 0 END) as detractors, SUM(CASE WHEN `NPS` = 7 OR `NPS` = 8 THEN 1 ELSE 0 END) as passives, SUM(CASE WHEN `NPS` = 9 or `NPS` = 10 THEN 1 ELSE 0 END) as promoters from csat_dump where `level_1`='".$_GET['L1']."' AND ".$where_clause.$queue." GROUP BY `level_2` order by ".$_GET['ppd']." desc limit 8";
	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	// get data and store in a json array
			$l2 = array();
			$promoters = array();
			$passives = array();
			$detractors = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
		{
			array_push($l2, $row['level_2']);
			array_push($promoters, $row['promoters']);
			array_push($passives, $row['passives']);
			array_push($detractors, $row['detractors']);
		}
		$output='[{ "name": "Comments", "data":[';
	foreach($l2 as $value)
		{
			$output =$output .'"' .$value.'",';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Promoters", "data":[';
		foreach($promoters as $value)
		{
			$output =$output .$value.',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Passives", "data":[';
		foreach($passives as $value)
		{
			$output =$output .$value.',';
		}
		$output = trim($output, ",") ."]},";
		echo $output;
		$output='{ "name": "Detractors", "data":[';
		foreach($detractors as $value)
		{
			$output =$output .$value.',';
		}
		$output = trim($output, ",") ."]}]";
		echo $output;
	}
	?>