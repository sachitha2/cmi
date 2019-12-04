<?php
session_start();
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;


$data = $_GET['data'];

$dataArr = json_decode($data,true);

$installmentData = $dataArr['iData'];
$dealsData = $dataArr['dealsData'];
$collectionData = $dataArr['collection'];


$x = 0;

$arr['s'][0] = 0;

foreach($installmentData as $tmpData){
	$sql = "UPDATE installment SET status = '{$tmpData['status']}', rpayment = '{$tmpData['rpayment']}',rdate = curdate() WHERE installment.id = {$tmpData['iid']};";
	$conn->query($sql);
	
	$arr['data'][$x++] = $tmpData['iid'];
	$arr['s'][0] = 1;
}

$x = 0;
foreach($dealsData as $tmpData){
	$sql = "UPDATE deals SET rprice = '{$tmpData['rprice']}',status = {$tmpData['s']} WHERE deals.id = {$tmpData['id']};";
	$conn->query($sql);
	
	$arr['dealId'][$x++] = $tmpData['id'];
}

$x = 0;
foreach($collectionData as $tmpData){
	$sql = "INSERT INTO collection (id, userId, installmentId, dealid, payment, date, time, dateTime) VALUES (NULL, '{$tmpData['userId']}', '{$tmpData['installmentId']}', '{$tmpData['dealid']}', '{$tmpData['payment']}', curdate(), curtime(), CURRENT_TIMESTAMP);";
	$conn->query($sql);
	
	$arr['collection'][$x++] = $tmpData['id'];
}


//print_r($deals);


//print_r($arr);
$json = json_encode($arr);
echo($json);

?>