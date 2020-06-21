<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');


$itemId = $_GET['itemId'];
$amount = $_GET['amount'];

$arr = $DB->select("stock"," WHERE itemid = 1"," SUM(ramount) as remain");
echo json_encode($arr); 
?>