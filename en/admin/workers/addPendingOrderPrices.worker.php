<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$data = $_GET['data'];
$json  = json_decode($data,TRUE);

//print_r($json);
if($DB->nRow("pendingprices"," WHERE itemId = {$json['itemId']}") == 0){	
	
	$sql = "INSERT INTO pendingprices (id, itemId, mPrice, cPrice, crePrice) VALUES (NULL, '{$json['itemId']}', '{$json['mPrice']}', '{$json['cPrice']}', '{$json['crePrice']}');";
	
	$conn->query($sql);
	
	$main->createSettionError("Created a Pending Price for Item ->{$json['itemId']}");
	echo("done");
}
else{
	echo("Pending Prices Row is already available. Edit It to change Prices");
}
?>