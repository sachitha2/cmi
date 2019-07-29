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
$cPrice = $_GET['cPrice'];
$type = $_GET['type'];



print_r($_GET);


$DB->conn = $conn;
//$postData = json_decode($_POST['data'], true); 
//print_r($postData);
$conn->query("INSERT INTO `stock` (`id`, `itemid`, `bprice`, `sprice`, `amount`,`ramount`, `adate`, `mfd`, `exdate`, `status`,`marketPrice`,`cashPrice`,`type`) VALUES (NULL, '$id', '$bPrice', '$sPrice', '$amount','$amount', curdate(), '$mfd', '$exDate', '1','{$_GET['mPrice']}',$cPrice,$type);");
//$DB->insert($table,$col,$val);
$itemName = $DB->getItemNameByStockId($id,0);
$purpose = "For buy $amount of Item $itemName ($id) at rate of $bPrice";
$sql = "INSERT INTO `cost` (`cost`, `purpose`, `date`, `id`, `costTypeId`) VALUES ('".$amount * $bPrice."', '$purpose', curdate(), NULL, '1');";
$conn->query($sql);


$conn->close();


?>