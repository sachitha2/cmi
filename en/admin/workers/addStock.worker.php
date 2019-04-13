<?php
require_once('db.php');
require_once('../methods/DB.class.php');
$DB = new DB;

$amount = $_GET['amount'];
$id = $_GET['id'];
$bPrice = $_GET['bPrice'];
$exDate = $_GET['exDate'];
$sPrice = $_GET['sPrice'];
$mfd = $_GET['mfd'];
print_r($_GET);


$DB->conn = $conn;
//$postData = json_decode($_POST['data'], true); 
//print_r($postData);
$conn->query("INSERT INTO `stock` (`id`, `itemid`, `bprice`, `sprice`, `amount`, `adate`, `mfd`, `exdate`, `status`) VALUES (NULL, '$id', '$bPrice', '$sPrice', '$amount', curdate(), '$mfd', '$exDate', '1');");
//$DB->insert($table,$col,$val);

$conn->close();


?>