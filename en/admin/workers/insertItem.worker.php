<?php 
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$postData = json_decode($_POST['data'], true);
//print_r($postData);

$itemTypeId = $postData['itemTypeId'];
$date = $postData['date'];
$item = $postData['item'];


	$sql = "INSERT INTO `item` (`id`, `itemTypeId`, `name`, `sDate`, `status`) VALUES (NULL, '$itemTypeId', '$item', '$date', '1');";
	$conn->query($sql); 
	echo("Done");
$conn->close();
?>