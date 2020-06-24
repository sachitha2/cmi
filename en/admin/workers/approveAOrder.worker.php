<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$id = $_POST['id'];
//1 is default value for approved orders
$sql = "UPDATE orderdata SET s = '1' WHERE orderdata.id = $id;";
$conn->query($sql);
?>