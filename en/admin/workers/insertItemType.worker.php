<?php 
require_once("db.php");
require_once("../methods/DB.class.php");
$DB = new DB;
$DB->conn = $conn;
$postData = json_decode($_POST['data'], true);
//print_r($postData);

$itemType = $postData['name'];
$date = $postData['date'];


if($DB->nRow("item_type"," WHERE name LIKE '$itemType'") == 0){
	$sql = "INSERT INTO `item_type` (`id`, `name`, `date`, `status`) VALUES (NULL, '$itemType', '$date', '1');";
	$conn->query($sql); 
	echo("Done");
}
else{
	echo("This Item Type is already available");
}


?>