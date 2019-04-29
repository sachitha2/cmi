<?php
require_once("../html/db.php");
require_once("../methods/DB.class.php");

$DB = new DB;
$DB->conn = $conn;
if(isset($_SESSION['bill'])){
//	echo("session available");
	///bill id
	$billid = $_SESSION['bill']['id'];
//	echo("<br>bill id $billid<br>");
	$billData = $DB->select("purchaseditems","where dealid = $billid");
//	print_r($billData);
	$arr['data']['mainData']['total'] = 2500;
	$arr['data']['mainData']['msg'] = "MSG here";
	$x = 0;
	foreach($billData as $data){
//		echo("<br>");
//		print_r($data);
//		echo("<br>");
		$arr['data']['id'][$x] = $data['id'];
		$arr['data']['item'][$x] = $DB->getItemNameByStockId($data['itemid'],0);
		$arr['data']['QTY'][$x] = $data['amount'];
		$arr['data']['price'][$x] = $data['uprice'];
		$arr['data']['total'][$x] = $data['amount'] * $data['uprice'];
		$arr['data']['r'][$x] = 25;
		$x++;
	}
	
	$json = json_encode($arr);
	$_SESSION['bill']['s'] = 0;
	echo($json);
}
else{
	echo("session not set");
}
?>