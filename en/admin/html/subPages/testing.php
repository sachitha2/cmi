<?php
require_once("../db.php");
require_once("../../methods/Main.class.php");
require_once("../../methods/DB.class.php");
$main = new Main;
$DB = new DB;
$DB->conn = $conn;

$arr = $DB->select("purchaseditems","WHERE cc = 1","DISTINCT dealid");

//print_r($arr);


foreach($arr as $data){
	
	if($DB->nRow("deals"," WHERE id = {$data['dealid']}") == 0){
		echo($data['dealid']."<br>");
	}
	
}
?>