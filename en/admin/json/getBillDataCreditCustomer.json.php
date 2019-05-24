<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
if(isset($_POST['cash'])){
	

$cash = $_POST['cash'];
$DB = new DB;
$DB->conn = $conn;
if(isset($_SESSION['credit']['bill'])){
	
	///make installments
		
	
	
	
	
	///make installments
	
	
	
	
//	echo("session available");
	///bill id
	$billid = $_SESSION['credit']['bill']['id'];
//	echo("<br>bill id $billid<br>");
	$billData = $DB->select("purchaseditems","where dealid = $billid");
	
	//update status of deal
	$dealSql = "UPDATE deals SET `status` = '1' WHERE deals.id = $billid;";
	$conn->query($dealSql);
	
	
	
//	print_r($billData);
	$arr['data']['mainData']['total'] = 0;
	$arr['data']['mainData']['msg'] = "MSG here";
	$arr['data']['mainData']['cash'] = $cash;
	
	
	
	$x = 0;
	foreach($billData as $data){
//		echo("<br>");
//		print_r($data);
//		echo("<br>");
		$arr['data']['id'][$x] = $x + 1;
		$arr['data']['item'][$x] = $DB->getItemNameByStockId($data['itemid'],0);
		$arr['data']['QTY'][$x] = $data['amount'];
		$arr['data']['price'][$x] = $data['uprice'];
		$arr['data']['total'][$x] = $data['amount'] * $data['uprice'];
		$arr['data']['r'][$x] = 00;
		$x++;
	}
	$total = $DB->select("purchaseditems","where dealid = $billid","SUM(amount * uprice)");
//	print_r($total);
	$arr['data']['mainData']['total'] = $total[0]['SUM(amount * uprice)'];
	$arr['data']['mainData']['balance'] = $cash -  $total[0]['SUM(amount * uprice)'];
	$json = json_encode($arr);
	$_SESSION['credit']['bill']['s'] = 0;
	echo($json);
}
else{
	echo("session not set");
}
	
	}
?>