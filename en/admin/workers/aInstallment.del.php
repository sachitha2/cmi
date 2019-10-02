<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
//print_r($_POST);

$arr = $DB->select("installment","where id = {$_POST['iId']}");

print_r($arr);



$conn->query("UPDATE installment SET rpayment = '0',status = '0' WHERE installment.id = {$arr[0]['id']};");


$conn->query("UPDATE deals SET rprice = rprice + {$arr[0]['rpayment']}, status = '0' WHERE deals.id = {$arr[0]['dealid']};");


?>
