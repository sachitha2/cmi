<?php
session_start();
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

$deals = $DB->select("collection","");
//print_r($deals);
$x=0;
foreach($deals as $data){
	$arr["id"][$x] = $data['id'];
	$arr["userId"][$x] = $data['userId'];
	$arr["installmentId"][$x] = $data['installmentId'];
	$arr["dealid"][$x] = $data['dealid'];
	$arr["payment"][$x] = $data['payment'];
	$arr["date"][$x] = $data['date'];
	$arr["time"][$x] = $data['time'];
	$arr["dateTime"][$x] = $data['dateTime'];
	$x++;
}
//print_r($arr);
$json = json_encode($arr);
echo($json);

?>