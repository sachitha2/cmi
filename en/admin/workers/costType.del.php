<?php
require_once("db.php");
require_once("../methods/DB.class.php");
require_once("../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;
$id = $_POST['id'];
//echo($area);
$arr = $DB->select("costtype","where id = $id");
echo($id);
$DB->delete("costtype","where id = $id");
$main->createSettionError("Deleted a Cost Type -> {$arr[0]['costtype']} ");
?>