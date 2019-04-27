<?php

date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");

require_once("../html/db.php");
require_once("../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("costtype","");

/////This month
$totalCostThisMonth = 0;
$x = 0;

foreach ($arr as $data) {
	
	$costArr = $DB->select("cost","WHERE (costTypeId = ".$data['id']." && MONTH(date) = MONTH(CURDATE()) && YEAR(date) = YEAR(CURDATE()))","SUM(cost)");
	
	$costArray['tMonth']['type'][$x] = $data['costtype'];
	$costArray['tMonth']['value'][$x] = (int)$costArr[0]['SUM(cost)'];
	
	$totalCostThisMonth +=  (int)$costArr[0]['SUM(cost)'];
	$x++;
	
}

$costArray['tMonth']['Total'] = $totalCostThisMonth;
/////This month

/////Last month
$totalCostLastMonth = 0;
$x = 0;

foreach ($arr as $data) {
	
	$costArr = $DB->select("cost","WHERE (costTypeId = ".$data['id']." && MONTH(date) = MONTH(CURDATE()) - 1 && YEAR(date) = YEAR(CURDATE()))","SUM(cost)");
	
	$costArray['lMonth']['type'][$x] = $data['costtype'];
	$costArray['lMonth']['value'][$x] = (int)$costArr[0]['SUM(cost)'];
	
	$totalCostLastMonth +=  (int)$costArr[0]['SUM(cost)'];
	$x++;
	
}

$costArray['lMonth']['Total'] = $totalCostLastMonth;
/////Last month
$json = json_encode($costArray);
echo($json);
?>