<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
if(isset($_POST['cash'])){
	

$cash = $_POST['cash'];
$DB = new DB;
$DB->conn = $conn;
if(isset($_SESSION['order']['bill'])){
//	echo("session available");
	///bill id
	$billid = $_SESSION['order']['bill']['id'];
//	echo("<br>bill id $billid<br>");
	$billData = $DB->select("orderdata","where dealid = $billid");
//	print_r($billData);
	$arr['data']['mainData']['total'] = 0;
	$arr['data']['mainData']['msg'] = "MSG here";
	$arr['data']['mainData']['invoiceN'] = $billid;
	$arr['data']['mainData']['cash'] = $cash;
	$arr['data']['cid'] = $billData[0]['cid'];
	
	$arrCus = $DB->select("customer","where id = {$billData[0]['cid']}");
	$arr['data']['customerName'] = $arrCus[0]['name'];
	$arr['data']['tp'] = $arrCus[0]['tp'];
	
	
	
	$x = 0;
	$billItems = $DB->select("orders","where dealId = {$billid}");
	foreach($billItems as $data){
		$prices = $DB->select("pendingprices","where itemId = {$data['itemId']}");
		$arr['data']['id'][$x] = $x + 1;
		$arr['data']['item'][$x] = $DB->getItemNameByStockId($data['itemId'],0);
		$arr['data']['QTY'][$x] =$data['amount'];
		$arr['data']['price'][$x] = $prices[0]['crePrice'];
		$arr['data']['total'][$x] = ($data['amount'] *  $prices[0]['crePrice']);
		
		$marketPrice = $prices[0]['mPrice'] * $data['amount'];
		
		$arr['data']['r'][$x] = ($marketPrice - $arr['data']['total'][$x]);
		$x++;
	}
	$total = 0;
//	print_r($total);
	$arr['data']['mainData']['total'] = 0;
	$arr['data']['mainData']['balance'] = 0;
	$json = json_encode($arr);
	$_SESSION['bill']['s'] = 0;
	echo($json);
}
else{
	echo("session not set");
}
	
	}
?>