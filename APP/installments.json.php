<?php
session_start();
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;

$deals = $DB->select("installment","");
//print_r($deals);
$x=0;
foreach($deals as $data){
	$arr["id"][$x] = $data['id'];
	$arr["dealId"][$x] = $data['dealid'];
	$arr["installmentid"][$x] = $data['installmentid'];
	$arr["payment"][$x] = $data['payment'];
	$arr["time"][$x] = $data['time'];
	$arr["date"][$x] = $data['date'];
	$arr["rdate"][$x] = $data['rdate'];
	$arr["status"][$x] = $data['status'];
	$arr["rpayment"][$x] = $data['rpayment'];
	$arr["cid"][$x] = $data['cid'];
	$x++;
}
//print_r($arr);
$json = json_encode($arr);
echo($json);

?>