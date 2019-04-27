<?php
date_default_timezone_set("Asia/Kolkata");

$dt_min = new DateTime("last saturday"); // Edit
$dt_min->modify('+1 day'); // Edit
$dt_max = clone($dt_min);
$dt_max->modify('+6 days');

$week = $dt_min->format('Y-m-d').' to '.$dt_max->format('Y-m-d').')';

require_once("../html/db.php");
require_once("../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("costtype","");

$totalCostThis = 0;
$totalCostLast = 0;
$x = 0;


///this week
foreach ($arr as $data) {
	
	$costArr = $DB->select("cost","WHERE (costTypeId = ".$data['id']." && WEEK(date) = WEEK(CURDATE()) && MONTH(date) = MONTH(CURDATE()) && YEAR(date) = YEAR(CURDATE()))","SUM(cost)");
	
	$costArray['thisWeek']['type'][$x] = $data['costtype'];
	$costArray['thisWeek']['value'][$x] = (int)$costArr[0]['SUM(cost)'];
	
	$totalCostThis +=  (int)$costArr[0]['SUM(cost)'];
	$x++;
	
}

$costArray['thisWeek']['Total'] = $totalCostThis;
////this week

///last week

$x = 0;
foreach ($arr as $data) {
	
	$costArr = $DB->select("cost","WHERE (costTypeId = ".$data['id']." && WEEK(date) = WEEK(CURDATE())-1 && MONTH(date) = MONTH(CURDATE()) && YEAR(date) = YEAR(CURDATE()))","SUM(cost)");
	
	$costArray['lastWeek']['type'][$x] = $data['costtype'];
	$costArray['lastWeek']['value'][$x] = (int)$costArr[0]['SUM(cost)'];
	
	$totalCostLast +=  (int)$costArr[0]['SUM(cost)'];
	$x++;
	
}

$costArray['lastWeek']['Total'] = $totalCostLast;
////last week


$json = json_encode($costArray);
echo($json);
?>