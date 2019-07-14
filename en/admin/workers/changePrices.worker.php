<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$data = $_GET['data'];
$data = json_decode($data,true);
print_r($data);
	if($data['sPrice'] != 0){
		$logic = "sprice = '{$data['sPrice']}'";
		$sql = "UPDATE stock SET $logic WHERE itemid = {$data['itemId']} AND status = 1;";
		$conn->query($sql);
	}
	if($data['cPrice'] != 0){
		$logic = "cashPrice = '{$data['cPrice']}'";
		$sql = "UPDATE stock SET $logic WHERE itemid = {$data['itemId']} AND status = 1;";
		$conn->query($sql);
	}
	
	if($data['mPrice'] != 0){
		$logic = "marketPrice = '{$data['mPrice']}'";
		$sql = "UPDATE stock SET $logic   WHERE itemid = {$data['itemId']} AND status = 1;";
		$conn->query($sql);
	}

?>