<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");
if(isset($_POST['cash'])){
	

$cash = $_POST['cash'];
$DB = new DB;
$DB->conn = $conn;
if(isset($_SESSION['bill'])){
//	echo("session available");
	///bill id
	$billid = $_SESSION['bill']['id'];
//	echo("<br>bill id $billid<br>");
	$billData = $DB->select("purchaseditems","where dealid = $billid");
//	print_r($billData);
	$arr['data']['mainData']['total'] = 0;
	$arr['data']['mainData']['msg'] = "MSG here";
	$arr['data']['mainData']['invoiceN'] = $billid;
	$arr['data']['mainData']['cash'] = $cash;
	$arr['data']['customerName'] = "0";
	$arr['data']['cid'] = "0";
	$arr['data']['tp'] = "0";
	if(isset($_POST['cid'])){
		$arrCus = $DB->select("customer","where id = {$_POST['cid']}");
		$arr['data']['customerName'] = $arrCus[0]['name'];
		$arr['data']['cid'] = $_POST['cid'];
		$arr['data']['tp'] = $arrCus[0]['tp'];
	}
	
	
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
		
		$marketPrice = $DB->select("stock","where id = {$data['stockid']} ");
		
		$arr['data']['r'][$x] = $marketPrice[0]['marketPrice'] - $marketPrice[0]['cashPrice'];
		$x++;
	}
	$total = $DB->select("purchaseditems","where dealid = $billid","SUM(amount * uprice)");
//	print_r($total);
	$arr['data']['mainData']['total'] = $total[0]['SUM(amount * uprice)'];
	$arr['data']['mainData']['balance'] = $cash -  $total[0]['SUM(amount * uprice)'];
	$json = json_encode($arr);
	$_SESSION['bill']['s'] = 0;
	echo($json);
}
else{
	echo("session not set");
}
	
	}
?>