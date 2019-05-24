<?php
session_start();
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

$area = $DB->select("customer","");
//print_r($area);
$x=0;
foreach($area as $data){
	$arr["id"][$x] = $data['id'];
	$arr["name"][$x] = $data['name'];
	$arr["address"][$x] = $data['address'];
	$arr["tp"][$x] = $data['tp'];
	$arr["regdate"][$x] = $data['regdate'];
	$arr["areaid"][$x] = $data['areaid'];
	$arr["nic"][$x] = $data['nic'];
	$arr["status"][$x] = $data['status'];
	$arr["route"][$x] = $data['route'];
	$arr["dob"][$x] = $data['dob'];
	$arr["areaAgent"][$x] = $data['areaAgent'];
	$x++;
}
//print_r($arr);
$json = json_encode($arr);
echo($json);

?>