<?php 
require_once('db.php');
require_once('../methods/DB.class.php');
$DB = new DB;
$DB->conn = $conn;
$postData = json_decode($_POST['data'], true);
print_r($postData);
$cost = $postData['cost'];
$date = $postData['date'];
$purpose = $postData['purpose'];
$costTypeId = $postData['costTId'];

$conn->query("INSERT INTO `cost` (`cost`, `purpose`, `date`, `id`, `costTypeId`) VALUES ('$cost', '$purpose', '$date', NULL, '$costTypeId');");
$conn->close();
?>
