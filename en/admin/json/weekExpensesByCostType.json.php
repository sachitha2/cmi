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

$totalCost = 0;
$x = 0;

foreach ($arr as $data) {
	
	$costArr = $DB->select("cost","WHERE (costTypeId = ".$data['id']." && WEEK(date) = WEEK(CURDATE()) && MONTH(date) = MONTH(CURDATE()) && YEAR(date) = YEAR(CURDATE()))","SUM(cost)");
	
	$costArray['type'][$x] = $data['costtype'];
	$costArray['value'][$x] = (int)$costArr[0]['SUM(cost)'];
	
	$totalCost +=  (int)$costArr[0]['SUM(cost)'];
	$x++;
	
}

$costArray['Total'] = $totalCost;
$json = json_encode($costArray);
echo($json);
?>