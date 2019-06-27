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
$arr = $DB->select("area","where id = $id","name ");
$DB->delete("area","where id = $id");
$main->createSettionError("Deleted a area -> {$arr[0]['name']}");
?>