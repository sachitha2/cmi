<?php

date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");

require_once("../html/db.php");
require_once("../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("costtype","");


//////Today
$totalCostToday = 0;
$x = 0;

foreach ($arr as $data) {
	
	$costArr = $DB->select("cost","WHERE date = curdate() AND costTypeId = ".$data['id'],"SUM(cost)");
	
	$costArray['today']['type'][$x] = $data['costtype'];
	$costArray['today']['value'][$x] = (int)$costArr[0]['SUM(cost)'];
	
	$totalCostToday +=  (int)$costArr[0]['SUM(cost)'];
	$x++;
	
}

$costArray['today']['Total'] = $totalCostToday;
//////Today

//////Last Day
$totalCostLastDay = 0;
$x = 0;

foreach ($arr as $data) {
	
	$costArr = $DB->select("cost","WHERE date = curdate()-1 AND costTypeId = ".$data['id'],"SUM(cost)");
	
	$costArray['lDay']['type'][$x] = $data['costtype'];
	$costArray['lDay']['value'][$x] = (int)$costArr[0]['SUM(cost)'];
	
	$totalCostLastDay +=  (int)$costArr[0]['SUM(cost)'];
	$x++;
	
}

$costArray['lDay']['Total'] = $totalCostLastDay;
//////Last Day

$json = json_encode($costArray);
echo($json);
?>