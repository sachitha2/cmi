<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$id = $_POST['id'];
//3 is default value for cancelled orders
$sql = "UPDATE orderdata SET s = '3' WHERE orderdata.id = $id;";
$conn->query($sql);
?>