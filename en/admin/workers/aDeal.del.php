<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;

//
//print_r($_POST);
//reset stock
$arrPurchasedItems = $DB->select("purchaseditems","where dealid = {$_POST['dealId']}");
foreach($arrPurchasedItems as $pData){
	$stockId = $pData['stockid'];
	$amount = $pData['amount'];
	//readd item to the stock

	$sql = "UPDATE stock SET ramount = ramount + $amount , status = '1'  WHERE stock.id = $stockId;";
	$conn->query($sql);
}

//delete purchased items
$DB->delete("purchaseditems","where dealId = {$_POST['dealId']}");








//delete installments
$DB->delete("installment","where dealid = {$_POST['dealId']}");


//delete deal
$DB->delete("deals","where id = {$_POST['dealId']}");


//New code to delete collecction data from database
$DB->delete("collection"," WHERE dealid = {$_POST['dealId']}");


$main->createSettionError("Deleted a Deal -> {$_POST['dealId']} ");


$_SESSION['credit']['bill']['s'] = 0;
?>