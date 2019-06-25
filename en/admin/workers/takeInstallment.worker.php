<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$data = $_POST['data'];
$data = json_decode($data,true);
print_r($data);

//Save installment
//find unfinished jobs available or not
$deal = $DB->select("deals","where id = {$data['dealId']}");
$ni = $deal[0]['ni'];

$installment = $DB->select("installment","WHERE id = {$data['ID']}");

//print_r($installment);

if($data['IID'] == 2){
	if($installment[0]['payment'] == $data['amount']){
		$sql = "UPDATE installment SET rdate = curdate(), status = '1', rpayment = {$data['amount']} WHERE installment.id = {$data['ID']};";
		$sqlDeal = "UPDATE deals SET rprice = rprice - {$data['amount']} WHERE deals.id = {$data['dealId']};";
	}else{
		
//		$sql = "UPDATE installment SET rdate = curdate(), status = '1', rpayment = {$data['amount']} WHERE installment.id = {$data['ID']};";
	}
	
}else {
	if($installment[0]['payment'] == $data['amount']){
		$sql = "UPDATE installment SET rdate = curdate(), status = '1', rpayment = {$data['amount']} WHERE installment.id = {$data['ID']};";
		$sqlDeal = "UPDATE deals SET rprice = rprice - {$data['amount']} WHERE deals.id = {$data['dealId']};";
	}else{
//		$sql = "UPDATE installment SET rdate = curdate(), status = '1', rpayment = {$data['amount']} WHERE installment.id = {$data['ID']};";
	}
}

$conn->query($sql);
$conn->query($sqlDeal);
	
	//if commands in mysql
//update deal status if it is final




$deal = $DB->select("deals","where id = {$data['dealId']}");
if($deal[0]['rprice'] <= 0){
	$conn->query("UPDATE deals SET status = '1' WHERE deals.id = {$data['dealId']} ;");
}

print_r($deal);



?>