<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$id = $_POST['id'];
//echo($area);
echo($id);
$arr=$DB->select("pack","where id = $id");

$DB->delete("pack","where id = $id");

$main->createSettionError("Deleted a Pack -> {$arr[0]['name']}");
?>