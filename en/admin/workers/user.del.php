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
$arr = $DB->select("user","where id = $id"," username");
$DB->delete("user","where id = $id");
$DB->delete("userdata","where id = $id");

$main->createSettionError("Deleted a User -> {$arr[0]['username']}");
?>