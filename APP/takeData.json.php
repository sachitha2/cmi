<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
include("../en/admin/html/db.php");
$_SESSION['login']['status'] = 1;
require_once("../en/admin/methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;


$date = new DateTime("now", new DateTimeZone('Asia/Colombo') );

	$arr['s'][0] = 0;
if(!isset($_POST['data'])){
	$arr['error'] = "not defined"; 
}else{

$data = $_POST['data'];

$dataArr = json_decode($data,true);

$installmentData = $dataArr['iData'];
$dealsData = $dataArr['dealsData'];
$collectionData = $dataArr['collection'];


$x = 0;



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
	
	if(!$DB->isAvailable("collection"," WHERE id LIKE '{$tmpData['id']}'")){
		$sql = "INSERT INTO collection (id, userId, installmentId, dealid, payment, date, time, dateTime) VALUES ('{$tmpData['id']}', '{$tmpData['userId']}', '{$tmpData['installmentId']}', '{$tmpData['dealid']}', '{$tmpData['payment']}', '{$date->format('Y-m-d')}', '{$date->format("H:i:s")}', '{$date->format('Y-m-d H:i:s')}');";
		$conn->query($sql);
	}
	$arr['collection'][$x] = $tmpData['id'];
	$x++;
}


//print_r($deals);
}

//print_r($arr);
$json = json_encode($arr);
echo($json);

?>