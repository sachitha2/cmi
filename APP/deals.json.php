<?php
session_start();
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

$deals = $DB->select("deals","WHERE status=0");
//print_r($deals);
$x=0;
foreach($deals as $data){
	$arr["id"][$x] = $data['id'];
	$arr["date"][$x] = $data['date'];
	$arr["time"][$x] = $data['time'];
	$arr["fdate"][$x] = $data['fdate'];
	$arr["ftime"][$x] = $data['ftime'];
	$arr["tprice"][$x] = $data['tprice'];
	$arr["rprice"][$x] = $data['rprice'];
	$arr["status"][$x] = $data['status'];
	$arr["ni"][$x] = $data['ni'];
	$arr["cid"][$x] = $data['cid'];
	$arr["discount"][$x] = $data['discount'];
	$arr["agentId"][$x] = $data['agentId'];
	$x++;
}
//print_r($arr);
$json = json_encode($arr);
echo($json);

?>