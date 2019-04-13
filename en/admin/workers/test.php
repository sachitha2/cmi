<?php 
require_once('db.php');
require_once('../methods/DB.class.php');
$DB = new DB;
$DB->conn = $conn;
$date = "2019-03-15";
$arr = $DB->select("installment","WHERE date = '$date'");
print_r($arr);
$conn->close();
?>
