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
$arr = $DB->select("item","where id = $id");
$itemNAme = $DB->getItemNameByStockId($arr[0]['id'],0);
$DB->delete("item","where id = $id");

$main->createSettionError("Deleted a Item -> $itemNAme ");
?>