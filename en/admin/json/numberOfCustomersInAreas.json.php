<?php

date_default_timezone_set("Asia/Kolkata");
$Date = date("Y-m-d");

require_once("../html/db.php");
require_once("../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
$arr = $DB->select("area","");

$x = 0;

foreach ($arr as $data) {
	
	$numOfActives = $DB->nRow("customer","WHERE (areaid = ".$data['id'].' && status = 1)');
	$numOfInactives = $DB->nRow("customer","WHERE (areaid = ".$data['id'].' && status = 0)');
	
	$customersArray['areaId'][$x] = $data['id'];
	$customersArray['area'][$x] = $data['name'];
	$customersArray['activeCustomers'][$x] = $numOfActives;
	$customersArray['inactiveCustomers'][$x] = $numOfInactives;
	
	$x++;
	
}

$json = json_encode($customersArray);
echo($json);
?>