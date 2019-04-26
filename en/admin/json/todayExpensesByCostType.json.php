<?php

date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");

require_once("../html/db.php");
require_once("../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("costtype","");

$totalCost = 0;
$x = 0;

foreach ($arr as $data) {
	
	$costArr = $DB->select("cost","WHERE costTypeId = ".$data['id'],"SUM(cost)");
	
	$costArray['type'][$x] = $data['costtype'];
	$costArray['value'][$x] = (int)$costArr[0]['SUM(cost)'];
	
	$totalCost +=  (int)$costArr[0]['SUM(cost)'];
	$x++;
	
}

$costArray['Total'] = $totalCost;
$json = json_encode($costArray);
echo($json);
?>