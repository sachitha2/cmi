<?php
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$postData = json_decode($_POST['data'], true);
//print_r($postData);
$itemId = $postData['itemId'];
$qty = $postData['qty'];
$pId = $postData['pId'];

///Duplicate checking

if($DB->isAvailable("packitems","WHERE pid = $pId AND itemid = $itemId") > 0){
	echo("Duplicate Error");
}else{
	$conn->query("INSERT INTO packitems (id, pid, itemid, amount) VALUES (NULL, '$pId', '$itemId', '$qty');");
	echo("Done");
}
?>